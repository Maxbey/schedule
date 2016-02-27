<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class TeacherRequest extends Request
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
            'firstname' => 'required|string|max:100',
            'lastname' => 'required|string|max:100',
            'middlename' => 'required|string|max:100',
            'work_hours_limit' => 'required|integer',
            'military_rank' => 'required|string'
        ];
    }
}
