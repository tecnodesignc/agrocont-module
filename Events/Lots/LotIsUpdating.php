<?php

namespace Modules\Agrocont\Events\Lots;

use Modules\Core\Contracts\EntityIsChanging;
use Modules\Core\Events\AbstractEntityHook;
use Modules\Agrocont\Entities\Lot;

class LotIsUpdating extends AbstractEntityHook implements EntityIsChanging
{
    /**
     * @var Lot
     */
    private $land;

    public function __construct(Lot $land, array $attributes)
    {
        $this->land = $land;
        parent::__construct($attributes);
    }

    /**
     * @return Lot
     */
    public function getLot()
    {
        return $this->land;
    }
}
