<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function area(): HasMany
    {
        return $this->hasMany(Area::class);
    }

    public function groups(): HasMany
    {
        return $this->hasMany(Group::class);
    }
}
