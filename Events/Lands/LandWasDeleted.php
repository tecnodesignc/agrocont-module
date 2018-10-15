<?php

namespace Modules\Agrocont\Events\Lands;

use Modules\Agrocont\Entities\Lands;

class LandWasDeleted
{
    /**
     * @var Land
     */
    public $land;

    public function __construct($land)
    {
        $this->land = $land;
    }
}
