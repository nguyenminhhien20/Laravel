<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Menu extends Model
{
    protected $table ='menu';
    use softDeletes;
}
