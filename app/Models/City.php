<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class City extends Model
{
    use HasTranslations;
    protected $table='city';
    protected $fillable=['name','created_by', 'updated_by'];
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
