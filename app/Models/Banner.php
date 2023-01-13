<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = ['photo','link','type' , 'is_ad' , 'is_payment_success' , 'is_approved' ,'ad_from' ,'ad_to' , 'slot'];
    public $timestamps = false;

}
