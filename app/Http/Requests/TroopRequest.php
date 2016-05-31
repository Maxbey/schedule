<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class TroopRequest extends Request
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
            'code' => 'required|string|min:3|max:100',
            'term' => 'required|integer',
            'day'  => 'required|integer|min:1|max:5',
            'specialty_id' => 'required|integer'
        ];
    }
}
