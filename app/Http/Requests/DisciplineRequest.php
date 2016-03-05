<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class DisciplineRequest extends Request
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
            'full_name' => 'required|string|min:3|max:100',
            'short_name' => 'required|string|min:2|max:100'
        ];
    }
}
