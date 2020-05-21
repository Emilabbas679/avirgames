<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table='product_image';
    protected $fillable=['product_id','created_by', 'updated_by','img', 'default'];
    public $timestamps=true;

    public function updatedBy()
    {
        return $this->hasOne(User::class, 'id','updated_by');
    }
    public function createdBy()
    {
        return $this->hasOne(User::class, 'id','created_by');
    }
}
