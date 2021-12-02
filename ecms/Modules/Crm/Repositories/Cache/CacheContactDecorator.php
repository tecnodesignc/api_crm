<?php

namespace Modules\Crm\Repositories\Cache;

use Modules\Crm\Repositories\ContactRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheContactDecorator extends BaseCacheDecorator implements ContactRepository
{
    public function __construct(ContactRepository $contact)
    {
        parent::__construct();
        $this->entityName = 'crm.contacts';
        $this->repository = $contact;
    }
}
