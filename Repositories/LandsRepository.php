<?php

namespace Modules\Agrocont\Repositories;

use Modules\Core\Repositories\BaseRepository;

interface LandsRepository extends BaseRepository
{
    public function whereFilter($page, $take, $filter, $include);

    /**
     * @param $id
     * @return mixed
     */
    public function wherebyUser($id);
}
