<?php

namespace Modules\Crm\Events;


use Modules\Media\Contracts\DeletingMedia;

class AccountWasDeleted implements DeletingMedia
{

    /**
     * @var string
     */
    private string $account_class;


    /**
     * @var int
     */
    private int $account_id;


    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($account_id, $account_class)
    {
        $this->account_class=$account_class;
        $this->account_id=$account_id;
    }


    public function getEntityId()
    {
       return $this->account_id;
    }

    public function getClassName()
    {
        return $this->account_class;
    }
}
