<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ClassSchedule;

class ServicePageController extends Controller
{
    /**
     * Show service detail by ID (e.g. /training-services/42).
     */
    public function showById($id)
    {
        $service = Service::with('linkedServices')
            ->where('is_active', true)
            ->findOrFail($id);

        return $this->serviceDetailResponse($service);
    }

    /**
     * Show service detail by slug (e.g. /service/asp) for direct/uncategorized services.
     */
    public function showBySlug(string $slug)
    {
        $service = Service::with('linkedServices')
            ->where('is_active', true)
            ->where('slug', $slug)
            ->firstOrFail();

        return $this->serviceDetailResponse($service);
    }

    /**
     * Build booking data and return service-details view.
     */
    protected function serviceDetailResponse(Service $service): \Illuminate\View\View
    {
        $linkedServices = $service->linkedServices->where('is_active', true);
        $relatedServices = $linkedServices->isNotEmpty()
            ? $linkedServices
            : Service::where('is_active', true)
                ->where('id', '!=', $service->id)
                ->orderBy('order')
                ->limit(3)
                ->get();

        $bookingLocations = ClassSchedule::where('service_id', $service->id)
            ->where('status', 'scheduled')
            ->where('class_date', '>=', now()->toDateString())
            ->whereRaw('current_students < max_students')
            ->distinct()
            ->orderBy('location')
            ->pluck('location')
            ->map(fn ($loc) => $loc ?: 'No Specific Location')
            ->unique()
            ->values();

        $availableDates = ClassSchedule::where('service_id', $service->id)
            ->where('status', 'scheduled')
            ->where('class_date', '>=', now()->toDateString())
            ->whereRaw('current_students < max_students')
            ->orderBy('class_date')
            ->get()
            ->pluck('class_date')
            ->map(fn ($d) => $d->format('Y-m-d'))
            ->unique()
            ->values()
            ->toArray();

        $schedule = ClassSchedule::where('service_id', $service->id)
            ->where('status', 'scheduled')
            ->where('class_date', '>=', now()->toDateString())
            ->whereRaw('current_students < max_students')
            ->orderBy('class_date')
            ->first();

        return view('service-details', compact(
            'service',
            'relatedServices',
            'linkedServices',
            'bookingLocations',
            'availableDates',
            'schedule'
        ));
    }
}
