<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class JobRequest extends FormRequest
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
        return [
            'name' => 'required|min:5|max:50',
            'description' => 'required|min:10|max:10000',
            'position_description' => 'required|min:10|max:10000',
            'category_id' => 'required|integer',
            'type' => 'string',
            'job_requiretments' => 'required|string|max:10000',
            'level' => 'string'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Job name field is required',
            'description.required' => 'Job description field is required',
            'position.required' => 'Position description field is required',
            'job_requiretments.required' => 'Job requiretments field is required'
        ];
    }
}
