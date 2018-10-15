<?php

namespace Modules\Agrocont\Events\Lands;

use Modules\Media\Contracts\StoringMedia;
use Modules\Agrocont\Entities\Lands;

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

    public function __construct(Lands $land, array $data)
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
