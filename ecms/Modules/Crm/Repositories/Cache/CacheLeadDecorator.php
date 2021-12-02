<?php

namespace Modules\Crm\Repositories\Cache;

use Modules\Crm\Repositories\LeadRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheLeadDecorator extends BaseCacheDecorator implements LeadRepository
{
    public function __construct(LeadRepository $lead)
    {
        parent::__construct();
        $this->entityName = 'crm.leads';
        $this->repository = $lead;
    }
}
