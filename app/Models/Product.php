<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasSlug;

    protected $table='product';
    protected $fillable=['name','slug','user_id','category_id','platform_id','ads_type','deadline_premium','condition',
        'city_id','description','type','sell_price','hire_period_id','hire_description','barter_type',
        'barter_money','status','created_by', 'updated_by'];
    public $timestamps=true;


    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['name','id'])
            ->saveSlugsTo('slug');
    }

    public function types()
    {
        return $this->hasMany(ProductTypes::class, 'product_id','id');
    }
    public function category()
    {
        return $this->hasOne(Category::class, 'id','category_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id','id');
    }
    public function platform()
    {
        return $this->hasOne(Platform::class, 'id','platform_id');
    }
    public function city()
    {
        return $this->hasOne(City::class, 'id','city_id');
    }
    public function period()
    {
        return $this->hasOne(Period::class, 'id','hire_period_id');
    }
    public function updatedBy()
    {
        return $this->hasOne(User::class, 'id','updated_by');
    }
    public function user()
    {
        return $this->hasOne(User::class, 'id','user_id');
    }
    public function createdBy()
    {
        return $this->hasOne(User::class, 'id','created_by');
    }
}
