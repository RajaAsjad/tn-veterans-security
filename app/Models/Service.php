<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
        // Category and organization (categories = JSON array for multi-select)
        'categories',
        'subcategory',
        'location',
        'requires_dallas_law',
        'requires_active_shooter',
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
        'categories' => 'array',
        'is_active' => 'boolean',
        'order' => 'integer',
        'price' => 'decimal:2',
        'deposit_amount' => 'decimal:2',
        'duration_hours' => 'integer',
        'max_students' => 'integer',
        'min_students' => 'integer',
        'has_online_parts' => 'boolean',
        'testing_in_person' => 'boolean',
        'requires_dallas_law' => 'boolean',
        'requires_active_shooter' => 'boolean',
    ];

    /**
     * Services linked from this one (e.g. Unarmed → Less Lethal, Dallas Law).
     * Pivot: service_relationships (parent_service_id, linked_service_id, order).
     */
    public function linkedServices(): BelongsToMany
    {
        return $this->belongsToMany(
            Service::class,
            'service_relationships',
            'parent_service_id',
            'linked_service_id'
        )
            ->withPivot('order')
            ->withTimestamps()
            ->orderByPivot('order');
    }

    /**
     * Services that link to this one (reverse of linkedServices).
     */
    public function linkedFromServices(): BelongsToMany
    {
        return $this->belongsToMany(
            Service::class,
            'service_relationships',
            'linked_service_id',
            'parent_service_id'
        )
            ->withPivot('order')
            ->withTimestamps()
            ->orderByPivot('order');
    }

    /**
     * Primary category (first of multiple) for backward compatibility.
     */
    public function getCategoryAttribute(): ?string
    {
        $cats = $this->categories ?? [];
        return is_array($cats) && count($cats) > 0 ? $cats[0] : null;
    }

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
