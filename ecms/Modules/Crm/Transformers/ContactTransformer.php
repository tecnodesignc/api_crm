<?php

namespace Modules\Crm\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\User\Transformers\UserProfileTransformer;

class ContactTransformer extends JsonResource
{

    public function toArray($request)
    {
        $data = [
            'id' => $this->when($this->id, $this->id),
            'salutation'=> $this->when($this->salutation, $this->salutation),
            'first_name'=> $this->when($this->first_name, $this->first_name),
            'last_name'=> $this->when($this->last_name, $this->last_name),
            'email'=> $this->when($this->email, $this->email),
            'phone'=> $this->when($this->phone, $this->phone),
            'mobile'=> $this->when($this->mobile, $this->mobile),
            'other_phone'=> $this->when($this->other_phone, $this->other_phone),
            'secondary_email'=> $this->when($this->secondary_email, $this->secondary_email),
            'street'=> $this->when($this->street, $this->street),
            'city'=> $this->when($this->city, $this->city),
            'state'=> $this->when($this->state, $this->state),
            'country'=> $this->when($this->country, $this->country),
            'zip'=> $this->when($this->zip, $this->zip),
            'reporting_to'=> $this->when($this->reporting_to, $this->reporting_to),
            'approved'=> $this->when($this->approved, $this->approved),
            'lead_source'=> $this->when($this->lead_source, $this->lead_source),
            'created_by'=> $this->when($this->created_by, $this->created_by),
            'description'=> $this->when($this->description, $this->description),
            'department'=> $this->when($this->department, $this->department),
            'assistant'=> $this->when($this->assistant, $this->assistant),
            'asst_phone'=> $this->when($this->asst_phone, $this->asst_phone),
            'modified_by'=> $this->when($this->modified_by, $this->modified_by),
            'skype_id'=> $this->when($this->skype_id, $this->skype_id),
            'unsubscribed_mode'=> $this->when($this->unsubscribed_mode, $this->unsubscribed_mode),
            'unsubscribed_time'=> $this->when($this->unsubscribed_time, $this->unsubscribed_time),
            'options'=> $this->when($this->options, $this->options),
        ];
    }

}
