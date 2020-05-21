<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasTranslations;
    protected $table='category';
    protected $fillable=['name','created_by', 'updated_by','parent_id', 'img'];
    public $timestamps=true;
    public $translatable = ['name'];


    public function updatedBy()
    {
        return $this->hasOne(User::class, 'id','updated_by');
    }
    public function createdBy()
    {
        return $this->hasOne(User::class, 'id','created_by');
    }

    public function selfCategory()
    {
        return $this->belongsTo(self::class, 'parent_id');

    }

    public function products()
    {
        $products = $this->hasMany(Product::class);
        $products->getQuery()->where('status','=', 'accepted');
        return $products;
    }

}
