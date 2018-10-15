<?php

namespace Modules\Agrocont\Events\Lots;

use Modules\Media\Contracts\StoringMedia;
use Modules\Agrocont\Entities\Lot;

class LotWasCreated implements StoringMedia
{
    /**
     * @var array
     */
    public $data;
    /**
     * @var Lot
     */
    public $land;

    public function __construct(Lot $land, array $data)
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
