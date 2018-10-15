<?php

namespace Modules\Agrocont\Entities;

use Illuminate\Database\Eloquent\Model;

class CropsTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name','description'];
    protected $table = 'agrocont__crops_translations';
}
