<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    protected $table='period';
    protected $fillable=['count','created_by', 'updated_by','period'];
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
