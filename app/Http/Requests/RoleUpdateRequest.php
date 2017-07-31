<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RoleUpdateRequest extends Request
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
        $id=$this->role;
        return [
            'name' => 'required|text|max:255|unique:roles,name,' . $id,
            'display_name' => 'required|text|max:255|unique:roles,display_name,' . $id,
            'description' => 'text|max:255'

        ];
    }
}
