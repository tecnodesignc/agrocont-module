<?php

namespace Modules\Agrocont\Entities;

use Illuminate\Database\Eloquent\Model;

class ActivitiesTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [];
    protected $table = 'agrocont__activities_translations';
}
