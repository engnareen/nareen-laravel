<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValditionRequestArticle extends FormRequest
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
        switch ($this->method()) {
            case 'POST':
            {
                return [
                    'title' => 'required|string|min:3|max:20|unique:articles',
                    'summary'=> 'required|min:20|max:100',
                    'description'=> 'required',
                    'image_path' => 'required|mimes:png,jpg,jpeg|max:5048',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'title' => 'required|string|min:3|max:20|unique:articles,title,'.$this->route()->article->id,
                    'summary'=> 'required|min:20|max:100',
                    'description'=> 'required',
                    'image_path' => 'nullable|mimes:png,jpg,jpeg|max:5048',
                ];
            }
            default: break;
        }

    }
}
