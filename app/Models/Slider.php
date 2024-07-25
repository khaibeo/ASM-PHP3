<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function details()
    {
        return $this->hasMany(SliderDetail::class);
    }

  
}
