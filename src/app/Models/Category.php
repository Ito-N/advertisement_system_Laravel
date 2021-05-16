<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image', 'slug'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }

    public function advertisements()
    {
        return $this->hasMany(Advertisement::class);
    }

    public function scopeCategoryCar($query)
    {
        return $query->where('name', '車')->first();
    }

    public function scopeCategoryElectronic($query)
    {
        return $query->where('name', '電機')->first();
    }
}
