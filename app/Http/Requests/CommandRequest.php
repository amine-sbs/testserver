<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommandRequest extends FormRequest
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
        return  [
            'nom_ar' => 'required|max:50|unique:commands,nom_ar',
            'nom_en' => 'required|max:50|unique:commands,nom_en',
            'prix' => 'required|numeric',
            'article_ar' => 'required',
            'article_en' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nom_ar.required'=>__('messages.commands nom required'),
            'nom_en.required'=>__('messages.commands nom required'),
            'nom.unique'=>__('messages.commands nom most be unique'),
            'prix.required'=>'Price command is required.',
            'prix.numeric'=>'Price command is integer.',
            'article_ar.required'=>'Item is required.',
            'article_en.required'=>'Item is required.',

        ];
    }
}
