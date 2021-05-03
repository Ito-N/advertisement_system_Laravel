<?php

namespace App\Models;

use Cohensive\Embed\Facades\Embed;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function childcategory()
    {
        return $this->hasOne(Childcategory::class, 'id', 'childcategory_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function displayVideoFromLink()
    {
        $embed = Embed::make($this->link)->parseUrl();
        if (!$embed) {
            return;
        }

        $embed->setAttribute(['width' => 500]);
        return $embed->getHtml();
    }

    public function scopeFirstFourAdsInCaurosel($query, $categoryId)
    {
        return $query->where('category_id', $categoryId)
            ->orderByDesc('id')->take(4)->get();
    }

    public function scopeSecondFourAdsInCaurosel($query, $categoryId)
    {
        $firstAds = $this->scopeFirstFourAdsInCaurosel($query, $categoryId);

        return $query->where('category_id', $categoryId)
            ->whereNotIn('id', $firstAds->pluck('id')->toArray())
            ->take(4)->get();
    }

    public function scopeFirstFourAdsInCauroselForElectronic($query, $categoryId)
    {
        return $query->where('category_id', $categoryId)
            ->orderByDesc('id')->take(4)->get();
    }

    public function scopeSecondFourAdsInCauroselForElectronic($query, $categoryId)
    {
        $firstAds = $this->scopeFirstFourAdsInCaurosel($query, $categoryId);

        return $query->where('category_id', $categoryId)
            ->whereNotIn('id', $firstAds->pluck('id')->toArray())
            ->take(4)->get();
    }
}
