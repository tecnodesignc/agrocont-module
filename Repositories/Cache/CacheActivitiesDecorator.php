<?php

namespace Modules\Agrocont\Repositories\Cache;

use Modules\Agrocont\Repositories\ActivitiesRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheActivitiesDecorator extends BaseCacheDecorator implements ActivitiesRepository
{
    public function __construct(ActivitiesRepository $activities)
    {
        parent::__construct();
        $this->entityName = 'agrocont.activities';
        $this->repository = $activities;
    }
}
