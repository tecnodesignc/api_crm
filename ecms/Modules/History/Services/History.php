<?php

namespace Modules\History\Services;

interface History
{
    /**
     * Push a history on the dashboard
     * @param string $title
     * @param string $message
     * @param string|null $lat
     * @param string|null $lng
     * @param string|null $type
     * @param string|null $ip
     */
    public function push(string $title, string $message, string $lat = null, string $lng = null, string $type = null, string $ip = null);

    /**
     * Set a user id to set the history to a specific user
     * @param int $user_id
     * @return $this
     */
    public function to(int $user_id);

    /**
     * Set a user id to set the history to
     * @param int|null $account_id
     * @return $this
     */

    public function account(int $account_id=null);
}
