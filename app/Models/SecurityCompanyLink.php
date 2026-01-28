<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SecurityCompanyLink extends Model
{
    protected $fillable = [
        'name',
        'description',
        'url',
        'logo',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];
}
