<?php

namespace Modules\History\Repositories\Eloquent;

use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;
use Modules\History\Repositories\HistoryRepository;

final class EloquentHistoryRepository extends EloquentBaseRepository implements HistoryRepository
{
    /**
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function latestForUser($userId)
    {
        return $this->model->whereUserId($userId)->whereIsRead(false)->orderBy('created_at', 'desc')->take(10)->get();
    }

    /**
     * Mark the given history id as "read"
     * @param int $historyId
     * @return bool
     */
    public function markHistoryAsRead($historyId)
    {
        $history = $this->find($historyId);
        $history->is_read = true;

        return $history->save();
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * Get all the histories for the given user id
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function allForUser($userId)
    {
        return $this->model->whereUserId($userId)->orderBy('created_at', 'desc')->get();
    }

    /**
     * Get all the read histories for the given user id
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function allReadForUser($userId)
    {
        return $this->model->whereUserId($userId)->whereIsRead(true)->orderBy('created_at', 'desc')->get();
    }

    /**
     * Get all the unread histories for the given user id
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function allUnreadForUser($userId)
    {
        return $this->model->whereUserId($userId)->whereIsRead(false)->orderBy('created_at', 'desc')->get();
    }

    /**
     * Delete all the histories for the given user
     * @param int $userId
     * @return bool
     */
    public function deleteAllForUser($userId)
    {
        return $this->model->whereUserId($userId)->delete();
    }

    /**
     * Mark all the histories for the given user as read
     * @param int $userId
     * @return bool
     */
    public function markAllAsReadForUser($userId)
    {
        return $this->model->whereUserId($userId)->update(['is_read' => true]);
    }
    public function getItemsBy($params = false)
    {
        /*== initialize query ==*/
        $query = $this->model->query();

        /*== RELATIONSHIPS ==*/
        if (in_array('*', $params->include)) {//If Request all relationships
            $query->with(['user','account']);
        } else {//Especific relationships
            $includeDefault = [];//Default relationships
            if (isset($params->include))//merge relations with default relationships
                $includeDefault = array_merge($includeDefault, $params->include);
            $query->with($includeDefault);//Add Relationships to query
        }

        /*== FILTERS ==*/
        if (isset($params->filter)) {
            $filter = $params->filter;//Short filter

            if (isset($filter->read)) {
                $query->whereIsRead($filter->read);
            }
            if (isset($filter->me) || isset($filter->user)) {
                if (isset($filter->me)) {
                    if ($filter->me) {
                        $query->where(function ($query) use ($params) {
                            $query->where('user_id', $params->user->id);
                            $query->orWhere('user_id', null);
                            $query->orWhere('account_id',$params->user->account->id??null);
                        });
                    } else {
                        $query->where('user_id', null);
                    }
                }
                if (isset($filter->user)) {
                    if ($params->user->hasAccess('history.histories.manage')) {
                        $query->where('user_id', null);
                    } else {
                        $query->whereUserId($filter->user);
                    }
                }
            } else {
                $query->where('user_id', null);
            }

            //Filter by date
            if (isset($filter->date)) {
                $date = $filter->date;//Short filter date
                $date->field = $date->field ?? 'created_at';
                if (isset($date->from))//From a date
                    $query->whereDate($date->field, '>=', $date->from);
                if (isset($date->to))//to a date
                    $query->whereDate($date->field, '<=', $date->to);
            }

            //Order by
            if (isset($filter->order)) {
                $orderByField = $filter->order->field ?? 'created_at';//Default field
                $orderWay = $filter->order->way ?? 'desc';//Default way
                $query->orderBy($orderByField, $orderWay);//Add order to query
            }


        }
        /*== FIELDS ==*/
        if (isset($params->fields) && count($params->fields))
            $query->select($params->fields);

        /*== REQUEST ==*/
        if (isset($params->page) && $params->page) {
            return $query->paginate($params->take);
        } else {
            $params->take ? $query->take($params->take) : false;//Take
            return $query->get();
        }
    }

    public function getItem($criteria, $params = false)
    {
        //Initialize query
        $query = $this->model->query();

        /*== RELATIONSHIPS ==*/
        if (in_array('*', $params->include)) {//If Request all relationships
            $query->with(['user']);
        } else {//Especific relationships
            $includeDefault = ['user'];//Default relationships
            if (isset($params->include))//merge relations with default relationships
                $includeDefault = array_merge($includeDefault, $params->include);
            $query->with($includeDefault);//Add Relationships to query
        }

        /*== FILTER ==*/
        if (isset($params->filter)) {
            $filter = $params->filter;

            if (isset($filter->field))//Filter by specific field
                $field = $filter->field;
        }

        /*== FIELDS ==*/
        if (isset($params->fields) && count($params->fields))
            $query->select($params->fields);

        /*== REQUEST ==*/
        return $query->where($field ?? 'id', $criteria)->first();
    }

}
