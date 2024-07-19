<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

class catalogues extends Model
{
    use HasFactory;

    protected $filltable = [
        'name',
        'image',
        'parent_id',
        'is_active'
    ];

    public function children()
    {
        return $this->hasMany(catalogues::class, 'parent_id')->with('children');
    }
    
    public function parent()
    {
        return $this->belongsTo(catalogues::class, 'parent_id');
    }
}
