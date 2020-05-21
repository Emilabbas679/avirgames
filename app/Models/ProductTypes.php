<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductTypes extends Model
{
    protected $table='product_types';
    protected $fillable=['product_id','type'];
    public $timestamps=true;

}
