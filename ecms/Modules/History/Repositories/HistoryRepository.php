<?php

namespace Modules\History\Repositories;

use Modules\Core\Repositories\BaseRepository;

/**
 * Interface HistoryRepository
 * @package Modules\History\Repositories
 */
interface HistoryRepository extends BaseRepository
{
    /**
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function latestForUser($userId);

    /**
     * Mark the given history id as "read"
     * @param int $historyId
     * @return bool
     */
    public function markHistoryAsRead($historyId);

    /**
     * Get all the histories for the given user id
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function allForUser($userId);

    /**
     * Get all the unread histories for the given user id
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function allUnreadForUser($userId);

    /**
     * Get all the read histories for the given user id
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function allReadForUser($userId);

    /**
     * Delete all the histories for the given user
     * @param int $userId
     * @return bool
     */
    public function deleteAllForUser($userId);

    /**
     * Mark all the histories for the given user as read
     * @param int $userId
     * @return bool
     */
    public function markAllAsReadForUser($userId);
}
