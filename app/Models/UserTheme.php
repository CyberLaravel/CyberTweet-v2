<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserTheme extends Model
{
    use HasFactory;

    protected $fillable = [
        'primary_color',
        'secondary_color',
        'background_image_path',
        'profile_neon_effect',
        'dark_mode'
    ];

    protected $casts = [
        'dark_mode' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
} 