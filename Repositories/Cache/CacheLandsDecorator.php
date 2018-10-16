<?php

namespace Modules\Agrocont\Repositories\Cache;

use Modules\Agrocont\Repositories\LandsRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheLandsDecorator extends BaseCacheDecorator implements LandsRepository
{
    public function __construct(LandsRepository $lands)
    {
        parent::__construct();
        $this->entityName = 'agrocont.lands';
        $this->repository = $lands;
    }

    public function whereFilter($page, $take, $filter, $include)
    {
        return $this->remember(function ($page, $take, $filter, $include) {
            return $this->repository->whereFilter($page, $take, $filter, $include);
        });
    }
}
