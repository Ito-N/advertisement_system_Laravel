<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Childcategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'subcategory_id', 'slug'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function subcategory ()
    {
        return $this->belongsTo(Subcategory::class, 'subcategory_id', 'id');
    }

    public function advertisements()
    {
        return $this->hasMany(Advertisement::class);
    }
}
