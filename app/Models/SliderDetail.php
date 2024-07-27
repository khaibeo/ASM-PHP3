<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SliderDetail extends Model
{
    use HasFactory;
    protected $table ="sliders_detail";
    protected $fillable = [
        'slider_id',
        'image_url',
        'link_url',
        'position',
    ];

    public function slider()
    {
        return $this->belongsTo(Slider::class);
    }
}
