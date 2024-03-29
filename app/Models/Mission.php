<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    protected $fillable = [
        'name',
        'image',
        'description',
        'is_active'
    ];

    public function scopeActive($query) {
        return $query->where('is_active', 1)->get();
    }
}
