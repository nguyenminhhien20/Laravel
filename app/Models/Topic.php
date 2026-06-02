<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Topic extends Model
{
    protected $table = 'topic';
    use softDeletes;

       public function post()
    {
        return $this->hasMany(Post::class, 'topic_id');
    }
}
