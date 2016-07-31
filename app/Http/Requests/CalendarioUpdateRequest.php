<?php

namespace TuFracc\Http\Requests;
use TuFracc\Http\Requests\Request;

class CalendarioUpdateRequest extends Request
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
            'title' => 'required',
            'start' => 'required|date_format:Y-m-d|date',
            'end' => 'date_format:Y-m-d',
        ];
    }
}