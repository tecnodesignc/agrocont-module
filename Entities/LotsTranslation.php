<?php

namespace Modules\Agrocont\Entities;

use Illuminate\Database\Eloquent\Model;

class LotsTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [];
    protected $table = 'agrocont__lots_translations';
}
