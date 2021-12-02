<?php

namespace Modules\Crm\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreateAccountRequest extends BaseFormRequest
{
    public function rules()
    {
        return ['account_name'=>'required|min:2'];
    }

    public function translationRules()
    {
        return [];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [];
    }

    public function translationMessages()
    {
        return [];
    }
}
