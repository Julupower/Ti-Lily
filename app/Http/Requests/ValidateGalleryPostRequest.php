<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateGalleryPostRequest extends FormRequest
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
            'image' => 'required|mimes:jpeg,jpg,png,gif|max:1024',
            'title' => 'required|string',
            'desc' => 'required'
        ];
    }
    
    public function messages()
    {
        return[
            'image.mimes' => 'Only Jpeg, PNG, and GIF image types are allowed',
            'image.max' => 'the maximum file size is 1MB',
            'desc' => 'You must fill out a description of the image'
        ];
    }
}
