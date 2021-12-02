<?php

namespace Modules\Crm\Events;

use Modules\Crm\Entities\Account;
use Modules\Media\Contracts\StoringMedia;

class AccountWasCreated implements StoringMedia
{

    /**
     * @var array
     */
    public array $data;

    /**
     * @var Account
     */
    public Account $account;


    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Account $account, array $data)
    {
       $this->data=$data;
       $this->account=$account;
    }


    public function getEntity()
    {
       return $this->account;
    }

    public function getSubmissionData()
    {
        return $this->data;
    }
}
