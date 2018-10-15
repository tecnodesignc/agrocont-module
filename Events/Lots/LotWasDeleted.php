<?php

namespace Modules\Agrocont\Events\Lots;

use Modules\Agrocont\Entities\Lots;

class LotWasDeleted
{
    /**
     * @var Lot
     */
    public $land;

    public function __construct($land)
    {
        $this->land = $land;
    }
}
