<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClassSchedule extends Model
{
    protected $fillable = [
        'service_id',
        'class_date',
        'start_time',
        'end_time',
        'duration_hours',
        'max_students',
        'min_students',
        'current_students',
        'room',
        'location',
        'instructor',
        'can_overlap',
        'status',
        'notes',
    ];

    protected $casts = [
        'class_date' => 'date',
        'start_time' => 'string', // Store as time string (H:i:s)
        'end_time' => 'string', // Store as time string (H:i:s)
        'duration_hours' => 'integer',
        'max_students' => 'integer',
        'min_students' => 'integer',
        'current_students' => 'integer',
        'can_overlap' => 'boolean',
    ];

    /**
     * Get the service that owns this schedule.
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * Get all bookings for this class schedule.
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(ServiceBooking::class, 'class_schedule_id');
    }

    /**
     * Get confirmed bookings for this class schedule.
     */
    public function confirmedBookings()
    {
        return $this->bookings()
            ->whereIn('status', ['pending', 'confirmed'])
            ->where('payment_status', '!=', 'refunded');
    }

    /**
     * Check if class has available spots.
     */
    public function hasAvailableSpots(): bool
    {
        return $this->current_students < $this->max_students && $this->status === 'scheduled';
    }

    /**
     * Get available spots count.
     */
    public function getAvailableSpots(): int
    {
        return max(0, $this->max_students - $this->current_students);
    }

    /**
     * Check if class meets minimum students requirement.
     */
    public function meetsMinimumStudents(): bool
    {
        return $this->current_students >= $this->min_students;
    }

    /**
     * Check if class is full.
     */
    public function isFull(): bool
    {
        return $this->current_students >= $this->max_students;
    }

    /**
     * Increment student count.
     */
    public function incrementStudentCount($count = 1): void
    {
        $this->increment('current_students', $count);
        
        // Check if class is now full
        if ($this->current_students >= $this->max_students) {
            $this->update(['status' => 'full']);
        }
    }

    /**
     * Decrement student count.
     */
    public function decrementStudentCount($count = 1): void
    {
        $this->decrement('current_students', $count);
        
        // Update status if not full anymore
        if ($this->status === 'full' && $this->current_students < $this->max_students) {
            $this->update(['status' => 'scheduled']);
        }
    }
}
