<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdSlot extends Model
{
    protected $fillable = ['slotname' , 'available_date'];
    use HasFactory;
}
