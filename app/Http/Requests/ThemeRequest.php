<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ThemeRequest extends Request
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
            'name' => 'required|string|min:3|max:100',
            'number' => 'required|string|max:12',
            'audiences_count' => 'required|integer|min:1|max:3',
            'teachers_count' => 'required|integer|min:1|max:3',
            'duration' => 'required|integer|min:1|max:6',
            'term' => 'required|integer',
            'discipline_id' => 'required|integer'
        ];
    }
}
