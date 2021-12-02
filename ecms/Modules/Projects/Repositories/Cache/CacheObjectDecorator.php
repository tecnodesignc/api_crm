<?php

namespace Modules\Projects\Repositories\Cache;

use Modules\Projects\Repositories\ObjectRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheObjectDecorator extends BaseCacheDecorator implements ObjectRepository
{
    public function __construct(ObjectRepository $object)
    {
        parent::__construct();
        $this->entityName = 'projects.objects';
        $this->repository = $object;
    }
}
