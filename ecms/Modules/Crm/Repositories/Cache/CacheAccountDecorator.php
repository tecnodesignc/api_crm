<?php

namespace Modules\Crm\Repositories\Cache;

use Modules\Crm\Repositories\AccountRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheAccountDecorator extends BaseCacheDecorator implements AccountRepository
{
    public function __construct(AccountRepository $account)
    {
        parent::__construct();
        $this->entityName = 'crm.accounts';
        $this->repository = $account;
    }
}
