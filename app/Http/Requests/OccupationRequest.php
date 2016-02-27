<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class OccupationRequest extends Request
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
            'date_of' => 'required|date',
            'teacher_id' => 'required|integer',
            'troop_id' => 'required|integer',
            'theme_id' => 'required|integer',
            'discipline_id' => 'required|integer',
            'audience_id' => 'required|integer'
        ];
    }
}
