<?php

namespace Modules\Agrocont\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Modules\Agrocont\Presenters\LandPresenter;
use Modules\Core\Traits\NamespacedEntity;
use Modules\Media\Entities\File;
use Modules\Media\Support\Traits\MediaRelation;

class Land extends Model
{
    use Translatable, MediaRelation, PresentableTrait, NamespacedEntity;

    protected $table = 'agrocont__lands';
    public $translatedAttributes = ['name', 'description'];
    protected $fillable = ['name', 'description', 'status','address', 'type', 'user_id'];
    protected $fakeColumns = ['options'];
    protected $presenter = LandPresenter::class;
    protected static $entityNamespace = 'encorecms/lands';
    /**
     * The attributes that should be casted to native types
     * @var array
     */
    protected $casts = [
        'options' => 'array',
        'address'=>'array',
        'status' => 'int',
        'type' => 'int',
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
     * Relation Lot Entities
     * @return mixed
     */
    public function lots()
    {
        return $this->hasMany(Lot::class);
    }

    /**
     * Relation Products Entities
     * @return mixed
     */
    public function Products()
    {
        return $this->hasMany(Lot::class);
    }
    /**
     * Get the thumbnail image for the current blog post
     * @return File|string
     */
    public function getThumbnailAttribute()
    {
        $thumbnail = $this->files()->where('zone', 'thumbnail')->first();
        if ($thumbnail === null) {
            return '';
        }
        return $thumbnail;
    }
    /**
     * Check if the post is in draft
     * @param Builder $query
     * @return Builder
     */
    public function scopeActive(Builder $query)
    {
        return $query->whereStatus(Status::ACTIVE);
    }
    /**
     * Check if the post is pending review
     * @param Builder $query
     * @return Builder
     */
    public function scopeInactive(Builder $query)
    {
        return $query->whereStatus(Status::INACTIVE);
    }

    /**
     * @param $method
     * @param $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        #i: Convert array to dot notation
        $config = implode('.', ['asgard.agrocont.config.land.relations', $method]);
        #i: Relation method resolver
        if (config()->has($config)) {
            $function = config()->get($config);
            return $function($this);
        }
        #i: No relation found, return the call to parent (Eloquent) to handle it.
        return parent::__call($method, $parameters);
    }

}
