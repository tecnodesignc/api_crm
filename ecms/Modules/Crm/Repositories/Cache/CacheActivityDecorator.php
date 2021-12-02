<?php

namespace Modules\Crm\Repositories\Cache;

use Modules\Crm\Repositories\ActivityRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheActivityDecorator extends BaseCacheDecorator implements ActivityRepository
{
    public function __construct(ActivityRepository $activity)
    {
        parent::__construct();
        $this->entityName = 'crm.activities';
        $this->repository = $activity;
    }
}
