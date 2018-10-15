<?php

namespace Modules\Agrocont\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Crops extends Model
{
    use Translatable;

    protected $table = 'agrocont__crops';
    public $translatedAttributes = [];
    protected $fillable = [];
}
