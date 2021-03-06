<?php

namespace Modules\Agrocont\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreateLotsRequest extends BaseFormRequest
{
    public function rules()
    {
        return [];
    }

    public function translationRules()
    {
        return [ 'name'=>'required',];
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
        return ['name.required' => trans('agrocont::common.messages.name is required'),
            'name.min2'=>trans('agrocont::common.messages.name is min '),];
    }
}
