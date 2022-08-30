<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSubscription extends Model
{
   protected $fillable = ['user_id', 'subscription_id', 'title', 'currency', 'currency_code', 'price', 'days', 'allowed_products', 'details', 'method', 'txnid', 'charge_id', 'created_at', 'updated_at', 'status','subscription_type','banner_type','main_banner_1','main_banner_2','side_banner_1','side_banner_2'];

    public function user()
    {
        return $this->belongsTo('App\Models\User')->withDefault(function ($data) {
			foreach($data->getFillable() as $dt){
				$data[$dt] = __('Deleted');
			}
		});
    }
}
