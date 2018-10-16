<?php

namespace Modules\Agrocont\Repositories\Cache;

use Modules\Agrocont\Repositories\LotsRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheLotsDecorator extends BaseCacheDecorator implements LotsRepository
{
    public function __construct(LotsRepository $lots)
    {
        parent::__construct();
        $this->entityName = 'agrocont.lots';
        $this->repository = $lots;
    }
    public function whereFilter($page, $take, $filter, $include)
    {
        return $this->remember(function ($page, $take, $filter, $include) {
            return $this->repository->whereFilter($page, $take, $filter, $include);
        });
    }
}
