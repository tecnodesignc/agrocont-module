<?php

namespace Modules\Agrocont\Repositories\Cache;

use Modules\Agrocont\Repositories\CropsRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheCropsDecorator extends BaseCacheDecorator implements CropsRepository
{
    public function __construct(CropsRepository $crops)
    {
        parent::__construct();
        $this->entityName = 'agrocont.crops';
        $this->repository = $crops;
    }
}
