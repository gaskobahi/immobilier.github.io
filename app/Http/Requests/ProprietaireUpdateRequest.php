<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProprietaireUpdateRequest extends FormRequest
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
        $id=$this->id;
        return [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'sexe' => 'required|string|max:10',
            'phone1' => 'required|string|max:20|unique:proprietaires,phone1,'.$id,
            'phone2' => 'string|max:20|unique:proprietaires,phone2,'.$id,
            'ville_id' => 'required',

        ];
    }
}
