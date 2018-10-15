<?php

namespace Modules\Agrocont\Events\Crops;

use Modules\Agrocont\Entities\Crops;

class CropWasDeleted
{
    /**
     * @var Crop
     */
    public $land;

    public function __construct($land)
    {
        $this->land = $land;
    }
}
