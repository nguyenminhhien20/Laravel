<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Post extends Model
{
    use SoftDeletes;

    protected $table = 'post';

    public function topic()
    {
        return $this->belongsTo(Topic::class, 'topic_id');
    }
}
