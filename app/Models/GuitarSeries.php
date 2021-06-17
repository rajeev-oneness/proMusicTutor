<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GuitarSeries extends Model
{
    use HasFactory,SoftDeletes;

    public function category()
    {
        return $this->belongsTo('App\Models\GuitarSeriesCategory','categoryId','id');
    }
}
