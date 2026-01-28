<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassSchedule;
use App\Models\Service;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ClassScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Group schedules by service_id
        $schedules = ClassSchedule::with('service')
            ->orderBy('class_date', 'asc')
            ->orderBy('start_time', 'asc')
            ->get()
            ->groupBy('service_id');
        
        return view('admin.class-schedules.index', compact('schedules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Service::where('is_active', true)
            ->orderBy('title')
            ->get();
        
        return view('admin.class-schedules.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $scheduleType = $request->input('schedule_type', 'single');
        
        // Common validation rules
        $commonRules = [
            'service_id' => 'required|exists:services,id',
            'duration_hours' => 'required|integer|min:1',
            'max_students' => 'required|integer|min:1|max:10',
            'min_students' => 'required|integer|min:1|max:4',
            'room' => 'nullable|string|max:255',
            'instructor' => 'nullable|string|max:255',
            'can_overlap' => 'boolean',
            'notes' => 'nullable|string',
        ];

        // Check if multiple schedules are being submitted
        if ($scheduleType === 'multiple' && $request->has('schedules') && is_array($request->input('schedules'))) {
            $schedulesArray = $request->input('schedules');
            
            // Filter out empty schedules (where date or time is missing)
            $schedulesArray = array_filter($schedulesArray, function($schedule) {
                return !empty($schedule['class_date']) && !empty($schedule['start_time']);
            });
            
            // Multiple schedules validation
            if (count($schedulesArray) > 0) {
                $request->validate([
                    ...$commonRules,
                    'schedules' => 'required|array|min:1',
                    'schedules.*.class_date' => 'required|date|after_or_equal:today',
                    'schedules.*.start_time' => 'required',
                ]);

                $schedules = [];
                $durationHours = (int) $request->input('duration_hours');
                
                foreach ($schedulesArray as $scheduleData) {
                    // Skip empty schedules
                    if (empty($scheduleData['class_date']) || empty($scheduleData['start_time'])) {
                        continue;
                    }
                    
                    $startTime = Carbon::createFromFormat('Y-m-d H:i', $scheduleData['class_date'] . ' ' . $scheduleData['start_time']);
                    $endTime = $startTime->copy()->addHours($durationHours);
                    
                    $schedules[] = [
                        'service_id' => $request->input('service_id'),
                        'class_date' => $scheduleData['class_date'],
                        'start_time' => Carbon::parse($scheduleData['start_time'])->format('H:i:s'),
                        'end_time' => $endTime->format('H:i:s'),
                        'duration_hours' => $durationHours,
                        'max_students' => $request->input('max_students'),
                        'min_students' => $request->input('min_students'),
                        'room' => $request->input('room'),
                        'instructor' => $request->input('instructor'),
                        'can_overlap' => $request->has('can_overlap'),
                        'current_students' => 0,
                        'status' => 'scheduled',
                        'notes' => $request->input('notes'),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }

                // Only insert if we have valid schedules
                if (count($schedules) > 0) {
                    ClassSchedule::insert($schedules);

                    return redirect()->route('admin.class-schedules.index')
                        ->with('success', count($schedules) . ' class schedule(s) created successfully.');
                }
            }
        }
        
        // Single schedule validation (only process if not multiple or multiple failed)
        $validated = $request->validate([
            ...$commonRules,
            'class_date' => 'required|date|after_or_equal:today',
            'start_time' => 'required',
        ]);

        // Calculate end_time from start_time + duration
        $durationHours = (int) $validated['duration_hours'];
        $startTime = Carbon::createFromFormat('Y-m-d H:i', $validated['class_date'] . ' ' . $validated['start_time']);
        $endTime = $startTime->copy()->addHours($durationHours);
        
        $validated['end_time'] = $endTime->format('H:i:s');
        $validated['start_time'] = Carbon::parse($validated['start_time'])->format('H:i:s');
        $validated['duration_hours'] = $durationHours;
        $validated['can_overlap'] = $request->has('can_overlap');
        $validated['current_students'] = 0;
        $validated['status'] = 'scheduled';

        ClassSchedule::create($validated);

        return redirect()->route('admin.class-schedules.index')
            ->with('success', 'Class schedule created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ClassSchedule $classSchedule)
    {
        $classSchedule->load('service', 'bookings.customer');
        return view('admin.class-schedules.show', compact('classSchedule'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClassSchedule $classSchedule)
    {
        $services = Service::where('is_active', true)
            ->orderBy('title')
            ->get();
        
        return view('admin.class-schedules.edit', compact('classSchedule', 'services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ClassSchedule $classSchedule)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'class_date' => 'required|date',
            'start_time' => 'required',
            'duration_hours' => 'required|integer|min:1',
            'max_students' => 'required|integer|min:1|max:10',
            'min_students' => 'required|integer|min:1|max:4',
            'room' => 'nullable|string|max:255',
            'instructor' => 'nullable|string|max:255',
            'can_overlap' => 'boolean',
            'status' => 'required|in:scheduled,full,cancelled,completed',
            'notes' => 'nullable|string',
        ]);

        // Calculate end_time from start_time + duration
        $durationHours = (int) $validated['duration_hours']; // Ensure it's an integer
        $startTime = Carbon::createFromFormat('Y-m-d H:i', $validated['class_date'] . ' ' . $validated['start_time']);
        $endTime = $startTime->copy()->addHours($durationHours);
        
        $validated['end_time'] = $endTime->format('H:i:s');
        // Store start_time as time string
        $validated['start_time'] = Carbon::parse($validated['start_time'])->format('H:i:s');
        $validated['duration_hours'] = $durationHours; // Store as integer
        $validated['can_overlap'] = $request->has('can_overlap');

        // Don't allow updating current_students if it would exceed max_students
        if ($classSchedule->current_students > $validated['max_students']) {
            return redirect()->back()
                ->with('error', 'Cannot set max students below current enrolled students (' . $classSchedule->current_students . ').');
        }

        // Update status to 'full' if current_students >= max_students
        if ($classSchedule->current_students >= $validated['max_students']) {
            $validated['status'] = 'full';
        }

        $classSchedule->update($validated);

        return redirect()->route('admin.class-schedules.index')
            ->with('success', 'Class schedule updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClassSchedule $classSchedule)
    {
        // Check if there are any bookings
        if ($classSchedule->bookings()->count() > 0) {
            return redirect()->route('admin.class-schedules.index')
                ->with('error', 'Cannot delete class schedule with existing bookings. Please cancel bookings first.');
        }

        $classSchedule->delete();

        return redirect()->route('admin.class-schedules.index')
            ->with('success', 'Class schedule deleted successfully.');
    }
}
