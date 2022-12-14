<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AffilateFrom extends Model
{
    use HasFactory;

    protected $fillable = ['name' , 'logo' , 'byAdmin'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
