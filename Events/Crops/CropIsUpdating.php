<?php

namespace Modules\Agrocont\Events\Crops;

use Modules\Core\Contracts\EntityIsChanging;
use Modules\Core\Events\AbstractEntityHook;
use Modules\Agrocont\Entities\Crops;

class CropIsUpdating extends AbstractEntityHook implements EntityIsChanging
{
    /**
     * @var Crop
     */
    private $land;

    public function __construct(Crops $land, array $attributes)
    {
        $this->land = $land;
        parent::__construct($attributes);
    }

    /**
     * @return Crop
     */
    public function getCrop()
    {
        return $this->land;
    }
}
