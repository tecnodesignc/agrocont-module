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

class Lot extends Model
{
    use Translatable, MediaRelation, PresentableTrait, NamespacedEntity;

    protected $table = 'agrocont__lots';
    public $translatedAttributes = ['name'];
    protected $fillable = ['name', 'status', 'area', 'slope', 'texture', 'thickness', 'land_id'];
    protected $fakeColumns = ['options'];
    protected $presenter = LandPresenter::class;
    protected static $entityNamespace = 'encorecms/lot';
    /**
     * The attributes that should be casted to native types
     * @var array
     */
    protected $casts = [
        'status' => 'int',
        'type' => 'int',
    ];
    /**
     * Relation Products Entities
     * @return mixed
     */
    public function Lands()
    {
        return $this->belongsTo(Land::class);
    }

    public function Crops()
    {
        return $this->hasMany(Crops::class);
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
        $config = implode('.', ['asgard.agrocont.config.lot.relations', $method]);
        #i: Relation method resolver
        if (config()->has($config)) {
            $function = config()->get($config);
            return $function($this);
        }
        #i: No relation found, return the call to parent (Eloquent) to handle it.
        return parent::__call($method, $parameters);
    }

}
