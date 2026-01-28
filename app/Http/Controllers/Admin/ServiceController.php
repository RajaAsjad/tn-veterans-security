<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
            // Category fields
            'category' => 'nullable|string|max:255',
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
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('services', 'public');
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['has_online_parts'] = $request->has('has_online_parts');
        $validated['testing_in_person'] = $request->has('testing_in_person', true); // Default true
        $validated['requires_dallas_law'] = $request->has('requires_dallas_law');
        $validated['requires_active_shooter'] = $request->has('requires_active_shooter');

        $linkedIds = $request->input('linked_services', []);
        unset($validated['linked_services']);

        $service = Service::create($validated);

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
        $service->load('linkedServices');
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
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
            // Category fields
            'category' => 'nullable|string|max:255',
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
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($service->image) {
                Storage::disk('public')->delete($service->image);
            }
            $validated['image'] = $request->file('image')->store('services', 'public');
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['has_online_parts'] = $request->has('has_online_parts');
        $validated['testing_in_person'] = $request->has('testing_in_person', true); // Default true
        $validated['requires_dallas_law'] = $request->has('requires_dallas_law');
        $validated['requires_active_shooter'] = $request->has('requires_active_shooter');

        $linkedIds = $request->input('linked_services', []);
        unset($validated['linked_services']);

        $service->update($validated);

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
}
