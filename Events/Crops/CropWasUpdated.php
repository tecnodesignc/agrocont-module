<?php

namespace Modules\Agrocont\Events\Crops;

use Modules\Media\Contracts\StoringMedia;
use Modules\Agrocont\Entities\Crops;

class CropWasUpdated implements StoringMedia
{
    /**
     * @var array
     */
    public $data;
    /**
     * @var Crop
     */
    public $land;

    public function __construct(Crops $land, array $data)
    {
        $this->data = $data;
        $this->land = $land;
    }

    /**
     * Return the entity
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getEntity()
    {
        return $this->land;
    }

    /**
     * Return the ALL data sent
     * @return array
     */
    public function getSubmissionData()
    {
        return $this->data;
    }
}
