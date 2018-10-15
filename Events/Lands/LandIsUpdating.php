<?php

namespace Modules\Agrocont\Events\Lands;

use Modules\Core\Contracts\EntityIsChanging;
use Modules\Core\Events\AbstractEntityHook;
use Modules\Agrocont\Entities\Lands;

class LandIsUpdating extends AbstractEntityHook implements EntityIsChanging
{
    /**
     * @var Land
     */
    private $land;

    public function __construct(Lands $land, array $attributes)
    {
        $this->land = $land;
        parent::__construct($attributes);
    }

    /**
     * @return Land
     */
    public function getLand()
    {
        return $this->land;
    }
}
