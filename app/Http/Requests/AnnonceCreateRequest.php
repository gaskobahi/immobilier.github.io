<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnnonceCreateRequest extends FormRequest
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
        $rules =[
            'titre' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            //'nombrepiece' => 'integer',
            //'superficie' => 'integer',
            'prix' => 'required|string|max:255',
            'typeannonce_id' => 'required',
            'categorie_id' => 'required',
            'titrepropriete_id' => 'required',
            'ville_id' => 'required',
        ];

        //verifier si la categorie terrain est selection ou celle de terrain
            $photos = count($this->input('photos'));
            if($photos>0){
                foreach(range(0, $photos) as $index) {
                    $rules['photos.' . $index] = 'image|mimes:jpeg,png|max:2000';
                }
            }else{
                $rules['photos'] = 'required';
            }

        /*$photos = count($this->input('photos'));
        foreach(range(0, $photos) as $index) {
              $rules['photos.' . $index] = 'required|image|mimes:jpeg,bmp,png|max:2000';
        }*/

        return $rules;
    }
}
