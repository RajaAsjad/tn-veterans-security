<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceBooking extends Model
{
    protected $fillable = [
        'customer_id',
        'service_id',
        'booking_date',
        'booking_time',
        'status',
        'notes',
    ];

    protected $casts = [
        'booking_date' => 'date',
        'booking_time' => 'datetime',
    ];

    /**
     * Get the customer that owns the booking.
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the service that belongs to the booking.
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
