<?php

namespace Modules\History\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\Core\Http\Controllers\Api\BaseApiController;
use Modules\History\Http\Requests\CreateHistoryRequest;
use Modules\History\Repositories\HistoryRepository;
use Modules\History\Transformers\HistoryTransformer;
use Modules\History\Services\History;

class HistoriesApiController extends BaseApiController
{
    /**
     * @var HistoryRepository
     */
    private $history;

    /**
     * @var History
     */
    private $serviceHistory;


    public function __construct(HistoryRepository $history, History $serviceHistory)
    {
        $this->history = $history;
        $this->serviceHistory = $serviceHistory;
    }

    public function markAsRead(Request $request)
    {
        $updated = $this->history->markHistoryAsRead($request->get('id'));

        return response()->json(compact('updated'));
    }

    /**
     * GET ITEMS
     *
     * @return mixed
     */
    public function index(Request $request)
    {
        try {

            //Get Parameters from URL.
            $params = $this->getParamsRequest($request);

            //Validate permissions
            $this->validatePermission($params, 'history.histories.index');
            //Request to Repository
            $histories = $this->history->getItemsBy($params);

            //Response
            $response = ["data" => HistoryTransformer::collection($histories)];

            //If request pagination add meta-page
            $params->page ? $response["meta"] = ["page" => $this->pageTransformer($histories)] : false;
        } catch (\Exception $e) {
            \Log::Error($e);
            $status = $this->getStatusError($e->getCode());
            $response = ["errors" => $e->getMessage()];
        }

        //Return response
        return response()->json($response ?? ["data" => "Request successful"], $status ?? 200);
    }

    /**
     * GET A ITEM
     *
     * @param $criteria
     * @return mixed
     */
    public function show($criteria, Request $request)
    {
        try {
            //Validate permissions
            $this->validatePermission($request, 'history.histories.index');
            //Get Parameters from URL.
            $params = $this->getParamsRequest($request);

            //Request to Repository
            $history = $this->history->getItem($criteria, $params);

            //Break if no found item
            if (!$history) throw new \Exception(trans('history:messages.messages.history not found'), 404);

            //Response
            $response = ["data" => new HistoryTransformer($history)];

        } catch (\Exception $e) {
            \Log::error($e);
            $status = $this->getStatusError($e->getCode());
            $response = ["errors" => $e->getMessage()];
        }

        //Return response
        return response()->json($response, $status ?? 200);
    }

    /**
     * CREATE A ITEM
     *
     * @param Request $request
     * @return mixed
     */
    public function create(Request $request)
    {
        \DB::beginTransaction();
        try {
            //Validate permissions


            $params = $this->getParamsRequest($request);
            $data = $request->input('attributes') ?? [];//Get data
            // $this->validatePermission($params, 'history.histories.create');
            $data['ip'] = $request->getClientIp();

            $data['user_id'] = $data['user_id']??$params->user->id;

            //Validate Request
            $this->serviceHistory->account($data['account_id'])->to($data['user_id'])->push($data['title'], $data['message'] ?? '', $data['lat']??null, $data['lng']??null,$data['type']??null,$data['ip']??null);

            //Response
            $response = ["data" => ['msg' => trans('history:messages.messages.history created')]];
            \DB::commit(); //Commit to Data Base
        } catch (\Exception $e) {
            \Log::Error($e);
            \DB::rollback();//Rollback to Data Base
            $status = $this->getStatusError($e->getCode());
            $response = ["errors" => $e->getMessage()];
        }
        //Return response
        return response()->json($response ?? ["data" => "Request successful"], $status ?? 200);
    }

    /**
     * UPDATE ITEM
     *
     * @param $criteria
     * @param Request $request
     * @return mixed
     */
    public function update($criteria, Request $request)
    {
        \DB::beginTransaction(); //DB Transaction
        try {
            //Validate permissions
            $this->validatePermission($request, 'history.histories.edit');
            //Get data
            $data = $request->input('attributes') ?? [];//Get data

            //Validate Request
            $this->validateRequestApi(new CreateHistoryRequest($data));

            //Get Parameters from URL.
            $params = $this->getParamsRequest($request);

            //Request to Repository
            $history = $this->history->getItem($criteria, $params);

            //Break if no found item
            if (!$history) throw new \Exception(trans('history:messages.messages.history not found'), 404);

            //Request to Repository
            $this->history->update($history, $data);

            //Response
            $response = ["data" => ['msg' => trans('history:messages.messages.history updated')]];
            \DB::commit();//Commit to DataBase
        } catch (\Exception $e) {
            \Log::error($e);
            \DB::rollback();//Rollback to Data Base
            $status = $this->getStatusError($e->getCode());
            $response = ["errors" => $e->getMessage()];
        }

        //Return response
        return response()->json($response ?? ["data" => "Request successful"], $status ?? 200);
    }

    /**
     * DELETE A ITEM
     *
     * @param $criteria
     * @return mixed
     */
    public function delete($criteria, Request $request)
    {
        \DB::beginTransaction();
        try {
            //Validate permissions
            $this->validatePermission($request, 'history.histories.delete');
            //Get params
            $params = $this->getParamsRequest($request);

            //Request to Repository
            $history = $this->history->getItem($criteria, $params);

            //Break if no found item
            if (!$history) throw new \Exception(trans('history:messages.messages.history not found'), 404);

            //call Method delete
            $this->history->destroy($history);

            //Response
            $response = ["data" => ['msg' => trans('history:messages.messages.history destroy')]];
            \DB::commit();//Commit to Data Base
        } catch (\Exception $e) {
            \Log::error($e);
            \DB::rollback();//Rollback to Data Base
            $status = $this->getStatusError($e->getCode());
            $response = ["errors" => $e->getMessage()];
        }

        //Return response
        return response()->json($response ?? ["data" => "Request successful"], $status ?? 200);
    }

    public function marksAsRead(Request $request)
    {
        try {
            $params = $this->getParamsRequest($request);

            // $this->validatePermission($params, 'history.histories.create');

            $data = $request->input('attributes') ?? [];//Get data
            //Validate Request
            foreach ($data['ids'] as $item) {
                $this->history->markHistoryAsRead($item);
            }
        } catch (\Exception $e) {
            \Log::error($e);
            \DB::rollback();//Rollback to Data Base
            $status = $this->getStatusError($e->getCode());
            $response = ["errors" => $e->getMessage()];
        }
        //Return response
        return response()->json($response ?? ["data" => "Request successful"], $status ?? 200);
    }

}
