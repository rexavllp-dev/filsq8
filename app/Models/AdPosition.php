<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdPosition extends Model
{
    protected $fillable = ['name', 'price'];

    use HasFactory;
}