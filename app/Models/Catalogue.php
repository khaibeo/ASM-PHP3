<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Catalogue extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image',
        'parent_id',
        'is_active'
    ];

    public function children()
    {
        return $this->hasMany(Catalogue::class, 'parent_id');
    }
    
    
    public function parent()
    {
        return $this->belongsTo(Catalogue::class, 'parent_id');
    }
}
