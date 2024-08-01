<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'catalogue_id', 'slug','sku', 'thumbnail', 'sale_price','regular_price','short_description', 'description','is_active','is_featured'];

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function galleries(){
        return $this->hasMany(ProductGallery::class);
    }

    public function catalogue(){
        return $this->belongsTo(Catalogue::class);
    }
    public function scopeSearchByName($query, $name)
    {
        return $query->where('name', 'like', "%{$name}%");
    }
}
