<?php

namespace Modules\Projects\Repositories\Cache;

use Modules\Projects\Repositories\ActivityRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheActivityDecorator extends BaseCacheDecorator implements ActivityRepository
{
    public function __construct(ActivityRepository $activity)
    {
        parent::__construct();
        $this->entityName = 'projects.activities';
        $this->repository = $activity;
    }
}
