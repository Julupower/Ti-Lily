<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProduct extends FormRequest
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
     * "/^[0-9]+(\.[0-9][0-9]?)?$/" is the regular expression for a double/float value
     *
     * @return array
     */
    public function rules()
    {
        return [
            'thumbnail' => 'required|mimes:jpeg,jpg,png,gif|max:1024',
            'product-name' => 'required|string',
            'description' => 'required',
            'price' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/'
        ];
    }
    
    public function messages()
    {
        return[
            'thumbnail.mimes' => 'Only Jpeg, PNG, and GIF image types are allowed',
            'thumbnail.max' => 'the maximum file size is 1MB',
        ];
    }
}
