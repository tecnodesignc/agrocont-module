<?php

namespace Modules\Agrocont\Repositories;

use Modules\Core\Repositories\BaseRepository;

interface LotsRepository extends BaseRepository
{
    public function whereFilter($page, $take, $filter, $include);
}
