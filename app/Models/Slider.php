<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = ['subtitle_text', 'subtitle_size', 'subtitle_color', 'subtitle_anime', 'title_text', 'title_size', 'title_color', 'title_anime', 'details_text', 'details_size', 'details_color', 'details_anime', 'photo', 'position', 'link', 'language_id', 'is_ad', 'is_payment_success', 'is_approved', 'ad_from', 'add_to'];
    public $timestamps = false;

    public function language()
    {
        return $this->belongsTo('App\Models\Language', 'language_id')->withDefault();
    }
}