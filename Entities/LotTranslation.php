<?php

namespace Modules\Agrocont\Entities;

use Illuminate\Database\Eloquent\Model;

class LotTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name'];
    protected $table = 'agrocont__lots_translations';
}
