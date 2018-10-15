<?php

namespace Modules\Agrocont\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Activities extends Model
{
    use Translatable;

    protected $table = 'agrocont__activities';
    public $translatedAttributes = [];
    protected $fillable = [];
}
