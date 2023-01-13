<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooterBanner extends Model
{
    protected $fillable = ['photo', 'link', 'is_approved' , 'ad_from' , 'ad_to' , 'is_payment_success'];
    use HasFactory;
}
