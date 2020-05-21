<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class DiscussionComments extends Model
{
    use HasTranslations;
    protected $table='discussion_comments';
    protected $fillable=['content','created_by','discussion_id'];
    public $timestamps=true;

    public function discussion(){
        return $this->hasOne(Discussion::class, 'id', 'discussion_id');
    }
    public function createdby(){
        return $this->hasOne(User::class, 'id', 'created_by');
    }
}
