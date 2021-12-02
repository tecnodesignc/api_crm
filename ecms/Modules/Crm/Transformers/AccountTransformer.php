<?php

namespace Modules\Crm\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\User\Transformers\UserProfileTransformer;

class AccountTransformer extends JsonResource
{

    public function toArray($request)
    {
        $data = [
            'id' => $this->when($this->id, $this->id),
            'account_image'=>$this->accountImage,
            'account_name' => $this->when($this->account_name, $this->account_name),
            'parent_account_id' => $this->when($this->parent_account, $this->parent_account),
            'parent_account' => new AccountTransformer($this->whenLoaded('parent')),
            'children_accounts' => AccountTransformer::collection($this->whenLoaded('parent')),
            'fax' => $this->when($this->fax, $this->fax),
            'phone' => $this->when($this->phone, $this->phone),
            'owner_id' => $this->when($this->owner_id, $this->owner_id),
            'owner'=> new UserProfileTransformer($this->whenLoaded('owner')),
            'industry' => $this->when($this->industry, $this->industry),
            'account_site' => $this->when($this->account_site, $this->account_site),
            'state' => $this->when($this->state, $this->state),
            'process_flow' => $this->when($this->process_flow, $this->process_flow),
            'billing_street' => $this->when($this->billing_street, $this->billing_street),
            'billing_code' => $this->when($this->billing_code, $this->billing_code),
            'billing_state' => $this->when($this->billing_state, $this->billing_state),
            'billing_country' => $this->when($this->billing_country, $this->billing_country),
            'shipping_city' => $this->when($this->shipping_city, $this->shipping_city),
            'shipping_street' => $this->when($this->shipping_street, $this->shipping_street),
            'shipping_state' => $this->when($this->shipping_state, $this->shipping_state),
            'shipping_country' => $this->when($this->shipping_country, $this->shipping_country),
            'shipping_code' => $this->when($this->shipping_code, $this->shipping_code),
            'approved ' => boolval($this->approved),
            'twitter' => $this->when($this->twitter, $this->twitter),
            'facebook' => $this->when($this->facebook, $this->facebook),
            'instagram' => $this->when($this->instagram, $this->instagram),
            'linkedin' => $this->when($this->linkedin, $this->linkedin),
            'status' => $this->when($this->status, $this->status),
            'created_by' => $this->when($this->created_by, $this->created_by),
            'user_created'=> new UserProfileTransformer($this->whenLoaded('created')),
            'annual_revenue' => $this->when($this->annual_revenue, $this->annual_revenue),
            'ownership' => $this->when($this->ownership, $this->ownership),
            'description' => $this->when($this->description, $this->description),
            'rating' => $this->when($this->rating, $this->rating),
            'website' => $this->when($this->website, $this->website),
            'employees' => $this->when($this->employees, $this->employees),
            'modified_by' => $this->when($this->modified_by, $this->modified_by),
            'user_modified'=> new UserProfileTransformer($this->whenLoaded('modified')),
            'review' => $this->when($this->review, $this->review),
            'options'=> $this->when($this->options, $this->options)
        ];
    }

}
