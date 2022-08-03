<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title' => 'required|min:3',
            'content' => 'required|min:10',
            'short_content' => 'required|min:3',
            'link_to_details' => 'required|unique:posts|min:3|regex:/^[a-zA-Z0-9 \-\_]+$/',
            'image' => 'file|mimes:jpg,png,jpeg|max:2000',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Post title field is required',
            'link_to_details.unique' => 'This post url slug is already taken.',
            'link_to_details.required' => 'The post url slug field is reqiured.',
            'link_to_details.min' => 'The post url slug field must have at least 3 characters',
            'link_to_details.regex' => 'You can only use letters, numbers, hyphens, and dashes.'
        ];
    }
}
