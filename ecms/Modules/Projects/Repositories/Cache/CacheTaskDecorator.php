<?php

namespace Modules\Projects\Repositories\Cache;

use Modules\Projects\Repositories\TaskRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheTaskDecorator extends BaseCacheDecorator implements TaskRepository
{
    public function __construct(TaskRepository $task)
    {
        parent::__construct();
        $this->entityName = 'projects.tasks';
        $this->repository = $task;
    }
}
