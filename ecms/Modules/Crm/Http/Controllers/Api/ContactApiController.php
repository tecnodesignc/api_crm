<?php

namespace Modules\Crm\Http\Controllers\Api;

use App\Http\Requests\Request;
use Modules\Crm\Transformers\ContactTransformer;
use Modules\Core\Http\Controllers\Api\BaseApiController;
use Modules\Crm\Http\Requests\CreateContactRequest;
use Modules\Crm\Repositories\ContactRepository;

class ContactApiController extends BaseApiController
{

    /**
     * @var ContactRepository
     */
    private ContactRepository $account;

    public function __construct(ContactRepository $account)
    {
        parent::__construct();
        $this->account=$account;
    }

    public function index(Request $request){

        try {
            //Get Parameters from URL.
            $params=$this->getParamsRequest($request);

            //Request to Repository
            $accounts=$this->account->getItemsBy($params);

            //Response
            $response=['data'=>ContactTransformer::collection($accounts)];

            //If request pagination add meta-page
            $params->page ? $response["meta"] = ["page" =>$this->pageTransformer($accounts)]:false;

        }catch (\Exception $e){
            \Log::Error($e);
            $status = $this->getStatusError($e->getCode());
            $response = ["errors" => $e->getMessage()];
        }

        //Return response
        return response()->json($response ?? ["data" => "Request successful"], $status ?? 200);

    }

    public function show($criteria,Request $request)
    {
        try {
            //Get Parameters from URL.
            $params=$this->getParamsRequest($request);

            //Request to Repository
            $account=$this->account->getItem($criteria,$params);

            //Break if no found item
            if (!$account) throw new \Exception(trans('crm::accounts.messages.account not found'),404);

            //Response
            $response=['data'=>new ContactTransformer($account)];

        }catch (\Exception $e){
            \Log::Error($e);
            $status = $this->getStatusError($e->getCode());
            $response = ["errors" => $e->getMessage()];
        }

        //Return response
        return response()->json($response ?? ["data" => "Request successful"], $status ?? 200);
    }

    public function create(Request $request)
    {
        \DB::beginTransaction();
        try {

            //Validate permissions
            $this->validatePermission($request, 'crm.accounts.create');

            $data = $request->input('attributes') ?? [];//Get data
            //Validate Request
            $this->validateRequestApi(new CreateContactRequest($data));

            //Create item
            $account = $this->account->create($data);

            //Response
            $response = ["data" => ['msg' => trans('crm::accounts.messages.account created')]];
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


    public function update($criteria, Request $request)
    {
        \DB::beginTransaction(); //DB Transaction
        try {
            //Validate permissions
            $this->validatePermission($request, 'crm.accounts.edit');
            //Get data
            $data = $request->input('attributes') ?? [];//Get data

            //Validate Request
            $this->validateRequestApi(new CreateContactRequest($data));

            //Get Parameters from URL.
            $params = $this->getParamsRequest($request);

            //Request to Repository
            $account = $this->account->getItem($criteria, $params);

            //Break if no found item
            if(!$account) throw new \Exception(trans('crm::accounts.messages.account not found'),404);

            //Request to Repository
            $this->account->update($account, $data);

            //Response
            $response = ["data" => ['msg' => trans('crm::accounts.messages.account updated')]];
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


    public function delete($criteria, Request $request)
    {
        \DB::beginTransaction();
        try {
            //Validate permissions
            $this->validatePermission($request, 'crm.accounts.delete');
            //Get params
            $params = $this->getParamsRequest($request);

            //Request to Repository
            $account = $this->account->getItem($criteria, $params);

            //Break if no found item
            if(!$account) throw new \Exception(trans('crm::accounts.messages.account not found'),404);

            //call Method delete
            $this->account->destroy($account);

            //Response
            $response = ["data" => ['msg' => trans('company::accounts.messages.account destroy')]];
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



}
