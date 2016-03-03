<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AudienceRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:3|max:100',
            'building' => 'required|integer',
            'number' => 'required|integer'
        ];
    }
}