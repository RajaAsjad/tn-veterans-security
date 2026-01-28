<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceRelationship extends Model
{
    protected $table = 'service_relationships';

    protected $fillable = [
        'parent_service_id',
        'linked_service_id',
        'order',
    ];

    protected $casts = [
        'order' => 'integer',
    ];

    /**
     * Parent service (the one that “links to” others).
     */
    public function parentService(): BelongsTo
    {
        return $this->belongsTo(Service::class, 'parent_service_id');
    }

    /**
     * Linked service (the one being linked).
     */
    public function linkedService(): BelongsTo
    {
        return $this->belongsTo(Service::class, 'linked_service_id');
    }
}
