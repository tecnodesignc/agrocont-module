<?php

namespace Modules\Agrocont\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Lots extends Model
{
    use Translatable;

    protected $table = 'agrocont__lots';
    public $translatedAttributes = [];
    protected $fillable = [];
}
