<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    protected $fillable = [
        'title',
        'short_description',
        'description',
        'image',
        'order',
        'is_active',
        // Class/Service pricing
        'price',
        'deposit_amount',
        // Class configuration
        'duration_hours',
        'max_students',
        'min_students',
        'class_type',
        'has_online_parts',
        'testing_in_person',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
        'price' => 'decimal:2',
        'deposit_amount' => 'decimal:2',
        'duration_hours' => 'integer',
        'max_students' => 'integer',
        'min_students' => 'integer',
        'has_online_parts' => 'boolean',
        'testing_in_person' => 'boolean',
    ];

    /**
     * Get all class schedules for this service.
     */
    public function classSchedules(): HasMany
    {
        return $this->hasMany(ClassSchedule::class);
    }

    /**
     * Get all bookings for this service.
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(ServiceBooking::class);
    }

    /**
     * Get upcoming available class schedules.
     */
    public function availableSchedules()
    {
        return $this->classSchedules()
            ->where('status', 'scheduled')
            ->where('class_date', '>=', now()->toDateString())
            ->whereRaw('current_students < max_students')
            ->orderBy('class_date')
            ->orderBy('start_time');
    }

    /**
     * Check if service has available spots in upcoming classes.
     */
    public function hasAvailableSpots(): bool
    {
        return $this->availableSchedules()->exists();
    }

    /**
     * Get next available class date.
     */
    public function getNextAvailableDate()
    {
        $schedule = $this->availableSchedules()->first();
        return $schedule ? $schedule->class_date : null;
    }
}
