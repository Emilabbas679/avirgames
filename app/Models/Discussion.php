<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Discussion extends Model
{
    use HasTranslations;
    use HasSlug;
    protected $table='discussion';
    protected $fillable=['title','slug','content','category_id','created_by', 'views','likes','comments'];
    public $timestamps=true;

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['title','id'])
            ->saveSlugsTo('slug');
    }

    public function createdBy()
    {
        return $this->hasOne(User::class, 'id','created_by');
    }

    public function category()
    {
        return $this->hasOne(DiscussionCategory::class,'id', 'category_id');
    }
}
