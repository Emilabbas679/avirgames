<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Platform extends Model
{
    use HasTranslations;
    protected $table='platform';
    protected $fillable=['name','created_by', 'updated_by', 'img'];
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
    public function selfPlatform()
    {
        return $this->belongsTo(self::class, 'parent');

    }


    public function products()
    {
        $products = $this->hasMany(Product::class);
        $products->getQuery()->where('status','=', 'accepted');
        return $products;
    }
}
