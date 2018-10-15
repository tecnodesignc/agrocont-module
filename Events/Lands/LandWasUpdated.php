<?php

namespace Modules\Agrocont\Events\Lands;

use Modules\Media\Contracts\StoringMedia;
use Modules\Agrocont\Entities\Land;

class LandWasUpdated implements StoringMedia
{
    /**
     * @var array
     */
    public $data;
    /**
     * @var Land
     */
    public $land;

    public function __construct(Land $land, array $data)
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
