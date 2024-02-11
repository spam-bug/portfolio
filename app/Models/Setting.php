<?php

namespace App\Models;

use App\Enums\Settings;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'data',
    ];

    protected $casts = [
        'name' => Settings::class,
        'data' => 'object'
    ];
}
