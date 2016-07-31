<?php

namespace TuFracc\Http\Requests;
use TuFracc\Http\Requests\Request;

class UtilCreateRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'concept' => 'required',
            //'phone_num' => 'required',
            //'address' => 'required',
            //'category' => 'required',
        ];
    }
}