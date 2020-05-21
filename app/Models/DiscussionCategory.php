<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class DiscussionCategory extends Model
{
    use HasTranslations;
    protected $table='discussion_categories';
    protected $fillable=['name','created_by', 'updated_by','img','icon'];
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
}
