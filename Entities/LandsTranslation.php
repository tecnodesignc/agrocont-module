<?php

namespace Modules\Agrocont\Entities;

use Illuminate\Database\Eloquent\Model;

class LandsTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'description'];
    protected $table = 'agrocont__lands_translations';
}
