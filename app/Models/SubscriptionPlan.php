<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubscriptionPlan extends Model
{
    use HasFactory,SoftDeletes;

    public function features()
    {
        return $this->hasMany('App\Models\SubscriptionPlanFeature','subscriptionPlanId','id');
    }
}
