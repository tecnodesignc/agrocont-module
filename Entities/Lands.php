<?php

namespace Modules\Agrocont\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Lands extends Model
{
    use Translatable;

    protected $table = 'agrocont__lands';
    public $translatedAttributes = ['name', 'description'];
    protected $fillable = ['name', 'description', 'address', 'type', 'user_id'];
    protected $fakeColumns = ['options'];
    /**
     * The attributes that should be casted to native types
     * @var array
     */
    protected $casts = [
        'options' => 'array'
    ];

    /**
     * @return mixed
     */
    public function user()
    {
        $driver = config('asgard.user.config.driver');

        return $this->belongsTo("Modules\\User\\Entities\\{$driver}\\User");
    }


    /**
     * @param $value
     * @return mixed
     */
    public function getOptionsAttribute($value) {

        return json_decode(json_decode($value));

    }

    /**
     * Relation Lots Entities
     * @return mixed
     */
    public function lots()
    {
        return $this->hasMany(Lots::class);
    }

    /**
     * Relation Products Entities
     * @return mixed
     */
    public function Products()
    {
        return $this->hasMany(Lots::class);
    }

}
