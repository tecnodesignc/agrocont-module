<?php

namespace Modules\Agrocont\Events\Lots;

use Modules\Core\Contracts\EntityIsChanging;
use Modules\Core\Events\AbstractEntityHook;

class LotIsCreating extends AbstractEntityHook implements EntityIsChanging
{
}
