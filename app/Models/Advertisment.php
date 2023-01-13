<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisment extends Model
{
    protected $fillable = ['ad_position_id', 'ad_id' , 'ad_rate' , 'is_payment_success' , 'is_deleted' , 'ad_by_id'];
    use HasFactory;
}
