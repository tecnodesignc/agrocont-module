<?php

namespace Modules\Agrocont\Events\Crops;

use Modules\Core\Contracts\EntityIsChanging;
use Modules\Core\Events\AbstractEntityHook;

class CropIsCreating extends AbstractEntityHook implements EntityIsChanging
{
}
