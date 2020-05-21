<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class PaymentMethod extends Model
{
    use HasTranslations;
    protected $table='payment_methods';
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
}
