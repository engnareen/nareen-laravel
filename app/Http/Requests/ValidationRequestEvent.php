<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidationRequestEvent extends FormRequest
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
                    'title' => 'required|string|min:10|max:50|unique:events',
                    'summary'=> 'required|min:20|max:200',
                    'date'=> 'required|date',
                    'time'=> 'required',
                    'image_path' => 'required|mimes:png,jpg,jpeg|max:5048',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'title' => 'required|string|min:10|max:50|unique:events,title,'.$this->route()->event->id,
                    'summary'=> 'required|min:50|max:200',
                    'date'=> 'required',
                    'time'=> 'required',
                    'image_path' => 'nullable|mimes:png,jpg,jpeg|max:5048',
                ];
            }
            default: break;
        }

    }
}
