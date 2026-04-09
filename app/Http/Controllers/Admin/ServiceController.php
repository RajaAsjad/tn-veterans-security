<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassSchedule;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class ServiceController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::withCount(['classSchedules', 'bookings'])
            ->orderBy('order')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $allServices = Service::where('is_active', true)->orderBy('order')->orderBy('title')->get();
        return view('admin.services.create', compact('allServices'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:100|unique:services,slug|regex:/^[a-z0-9\-]+$/',
            'short_description' => 'nullable|string|max:500',
            'requirements' => 'nullable|string',
            'sub_titles' => 'nullable|array',
            'sub_titles.*' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'nullable|integer|min:0',
            'min_students' => 'nullable|integer|min:1',
            'max_students' => 'nullable|integer|min:1',
            'is_active' => 'boolean',
            // Category fields (multiple)
            'categories' => 'nullable|array',
            'categories.*' => 'string|in:' . implode(',', array_keys(config('service_categories', []))),
            'subcategory' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'requires_dallas_law' => 'boolean',
            'requires_active_shooter' => 'boolean',
            // Pricing fields
            'price' => 'nullable|numeric|min:0',
            'deposit_amount' => 'nullable|numeric|min:0',
            // Class configuration
            'class_type' => 'nullable|in:group,one-on-one',
            'has_online_parts' => 'boolean',
            'testing_in_person' => 'boolean',
            'linked_services' => 'nullable|array',
            'linked_services.*' => 'integer|exists:services,id',
            'schedules' => 'nullable|array',
            'schedules.*.id' => 'nullable|integer',
            'schedules.*.class_date' => 'nullable|date',
            'schedules.*.start_time' => 'nullable',
            'schedules.*.duration_hours' => 'nullable|integer|min:1|max:48',
            'schedules.*.max_students' => 'nullable|integer|min:1|max:100',
            'schedules.*.min_students' => 'nullable|integer|min:1|max:100',
            'schedules.*.location' => 'nullable|string|max:255',
            'schedules.*.room' => 'nullable|string|max:255',
            'schedules.*.instructor' => 'nullable|string|max:255',
            'schedules.*.notes' => 'nullable|string|max:2000',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('services', 'public');
        }

        $validated['slug'] = $request->filled('slug') ? strtolower(trim($request->slug)) : null;
        $validated['is_active'] = $request->has('is_active');
        $validated['has_online_parts'] = $request->has('has_online_parts');
        $validated['testing_in_person'] = $request->has('testing_in_person', true); // Default true
        $validated['requires_dallas_law'] = $request->has('requires_dallas_law');
        $validated['requires_active_shooter'] = $request->has('requires_active_shooter');

        $linkedIds = $request->input('linked_services', []);
        unset($validated['linked_services']);

        $validated['categories'] = array_values(array_filter($request->input('categories', [])));
        $validated['sub_titles'] = array_values(array_filter(array_map('trim', $request->input('sub_titles', []))));

        $service = Service::create($validated);

        $this->syncClassSchedulesFromRequest($service, $request, true);

        if (! empty($linkedIds)) {
            $sync = [];
            foreach (array_values(array_filter($linkedIds)) as $i => $id) {
                $sync[$id] = ['order' => $i];
            }
            $service->linkedServices()->sync($sync);
        }

        return redirect()->route('admin.services.index')
            ->with('success', 'Service created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        return view('admin.services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        $service->load(['linkedServices', 'classSchedules' => function ($q) {
            $q->orderBy('class_date')->orderBy('start_time');
        }]);
        $allServices = Service::where('is_active', true)->where('id', '!=', $service->id)->orderBy('order')->orderBy('title')->get();
        return view('admin.services.edit', compact('service', 'allServices'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:100|unique:services,slug,' . $service->id . '|regex:/^[a-z0-9\-]+$/',
            'short_description' => 'nullable|string|max:500',
            'requirements' => 'nullable|string',
            'sub_titles' => 'nullable|array',
            'sub_titles.*' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'nullable|integer|min:0',
            'min_students' => 'nullable|integer|min:1',
            'max_students' => 'nullable|integer|min:1',
            'is_active' => 'boolean',
            // Category fields (multiple)
            'categories' => 'nullable|array',
            'categories.*' => 'string|in:' . implode(',', array_keys(config('service_categories', []))),
            'subcategory' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'requires_dallas_law' => 'boolean',
            'requires_active_shooter' => 'boolean',
            // Pricing fields
            'price' => 'nullable|numeric|min:0',
            'deposit_amount' => 'nullable|numeric|min:0',
            // Class configuration
            'class_type' => 'nullable|in:group,one-on-one',
            'has_online_parts' => 'boolean',
            'testing_in_person' => 'boolean',
            'linked_services' => 'nullable|array',
            'linked_services.*' => 'integer|exists:services,id',
            'schedules' => 'nullable|array',
            'schedules.*.id' => 'nullable|integer',
            'schedules.*.class_date' => 'nullable|date',
            'schedules.*.start_time' => 'nullable',
            'schedules.*.duration_hours' => 'nullable|integer|min:1|max:48',
            'schedules.*.max_students' => 'nullable|integer|min:1|max:100',
            'schedules.*.min_students' => 'nullable|integer|min:1|max:100',
            'schedules.*.location' => 'nullable|string|max:255',
            'schedules.*.room' => 'nullable|string|max:255',
            'schedules.*.instructor' => 'nullable|string|max:255',
            'schedules.*.notes' => 'nullable|string|max:2000',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($service->image) {
                Storage::disk('public')->delete($service->image);
            }
            $validated['image'] = $request->file('image')->store('services', 'public');
        }

        $validated['slug'] = $request->filled('slug') ? strtolower(trim($request->slug)) : null;
        $validated['is_active'] = $request->has('is_active');
        $validated['has_online_parts'] = $request->has('has_online_parts');
        $validated['testing_in_person'] = $request->has('testing_in_person', true); // Default true
        $validated['requires_dallas_law'] = $request->has('requires_dallas_law');
        $validated['requires_active_shooter'] = $request->has('requires_active_shooter');

        $linkedIds = $request->input('linked_services', []);
        unset($validated['linked_services']);

        $validated['categories'] = array_values(array_filter($request->input('categories', [])));
        $validated['sub_titles'] = array_values(array_filter(array_map('trim', $request->input('sub_titles', []))));

        $service->update($validated);

        $this->syncClassSchedulesFromRequest($service, $request, false);

        $linkedIds = array_filter(array_map('intval', $linkedIds));
        $sync = [];
        foreach (array_values($linkedIds) as $i => $id) {
            if ($id !== (int) $service->id) {
                $sync[$id] = ['order' => $i];
            }
        }
        $service->linkedServices()->sync($sync);

        return redirect()->route('admin.services.index')
            ->with('success', 'Service updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        // Delete image if exists
        if ($service->image) {
            Storage::disk('public')->delete($service->image);
        }

        $service->delete();

        return redirect()->route('admin.services.index')
            ->with('success', 'Service deleted successfully.');
    }

    /**
     * Create, update, or remove class_schedules rows submitted with the service form.
     */
    protected function syncClassSchedulesFromRequest(Service $service, Request $request, bool $isNewService): void
    {
        if (! $request->has('sync_schedules')) {
            return;
        }

        $rows = $request->input('schedules', []);
        if (! is_array($rows)) {
            return;
        }

        $rows = array_values(array_filter($rows, function ($row) {
            if (! is_array($row)) {
                return false;
            }

            return ! empty($row['class_date']) && $row['start_time'] !== null && $row['start_time'] !== '';
        }));

        if ($rows === []) {
            foreach ($service->classSchedules as $existing) {
                if ($existing->bookings()->exists()) {
                    throw ValidationException::withMessages([
                        'schedules' => ['Cannot remove all sessions: some have bookings. Edit or cancel those bookings first.'],
                    ]);
                }
                $existing->delete();
            }

            return;
        }

        foreach ($rows as $i => $row) {
            if (! empty($row['id'])) {
                $exists = ClassSchedule::where('id', (int) $row['id'])
                    ->where('service_id', $service->id)
                    ->exists();
                if (! $exists) {
                    throw ValidationException::withMessages([
                        "schedules.{$i}.id" => ['Invalid session for this class.'],
                    ]);
                }
            } elseif (! $isNewService && Carbon::parse($row['class_date'])->lt(now()->startOfDay())) {
                throw ValidationException::withMessages([
                    "schedules.{$i}.class_date" => ['New sessions must be on or after today.'],
                ]);
            } elseif ($isNewService && Carbon::parse($row['class_date'])->lt(now()->startOfDay())) {
                throw ValidationException::withMessages([
                    "schedules.{$i}.class_date" => ['Session date must be on or after today.'],
                ]);
            }
        }

        $submittedIds = collect($rows)->pluck('id')->filter()->map(fn ($id) => (int) $id);

        foreach ($service->classSchedules()->get() as $existing) {
            if ($submittedIds->contains($existing->id)) {
                continue;
            }
            if ($existing->bookings()->exists()) {
                throw ValidationException::withMessages([
                    'schedules' => ['Cannot remove a session that has bookings ('
                        .$existing->class_date->format('M j, Y').'). Remove bookings first or leave the session in the list.'],
                ]);
            }
            $existing->delete();
        }

        foreach ($rows as $row) {
            $durationHours = (int) ($row['duration_hours'] ?? 8);
            $maxStudents = (int) ($row['max_students'] ?? 10);
            $minStudents = (int) ($row['min_students'] ?? 1);
            if ($minStudents > $maxStudents) {
                throw ValidationException::withMessages([
                    'schedules' => ['Minimum students cannot exceed maximum for a session.'],
                ]);
            }

            $startTime = Carbon::createFromFormat('Y-m-d H:i', $row['class_date'].' '.$row['start_time']);
            $endTime = $startTime->copy()->addHours($durationHours);

            $location = $row['location'] ?? null;
            $location = $location === '' ? null : $location;

            $payload = [
                'class_date' => $row['class_date'],
                'start_time' => Carbon::parse($row['start_time'])->format('H:i:s'),
                'end_time' => $endTime->format('H:i:s'),
                'duration_hours' => $durationHours,
                'max_students' => $maxStudents,
                'min_students' => $minStudents,
                'room' => $row['room'] ?? null,
                'location' => $location,
                'instructor' => $row['instructor'] ?? null,
                'can_overlap' => ! empty($row['can_overlap']),
                'notes' => $row['notes'] ?? null,
            ];

            if (! empty($row['id'])) {
                $schedule = ClassSchedule::where('id', (int) $row['id'])
                    ->where('service_id', $service->id)
                    ->firstOrFail();

                if ($schedule->current_students > $maxStudents) {
                    throw ValidationException::withMessages([
                        'schedules' => ['Max students cannot be below current enrollment ('.$schedule->current_students.') for a session.'],
                    ]);
                }

                $status = $schedule->status;
                if ($schedule->current_students >= $maxStudents) {
                    $status = 'full';
                } elseif ($status === 'full' && $schedule->current_students < $maxStudents) {
                    $status = 'scheduled';
                }
                $payload['status'] = $status;
                $schedule->update($payload);
            } else {
                ClassSchedule::create(array_merge($payload, [
                    'service_id' => $service->id,
                    'current_students' => 0,
                    'status' => 'scheduled',
                ]));
            }
        }
    }
}
