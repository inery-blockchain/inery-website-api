<?php

namespace App\Http\Requests;

use Illuminate\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class JobApplicationRequest extends FormRequest
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
            'job_title' => 'required',
            'cv' => 'required|mimes:pdf,doc,docx|max:10000',
            'cover_letter' => 'mimes:doc,docx,pdf|max:10000',
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'email' => 'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'phone' => 'required|string',
            'company' => 'string|nullable|max:50',
            'location' => 'string|nullable',
            'linkedin_url' => 'nullable|url|nullable',
            'website_url' => 'string|url|nullable',
            'twitter_url' => 'string|url|nullable',
            'instagram_url' => 'string|url|nullable',
            'github_url' => 'string|url|nullable',
            'other_url' => 'string|url|nullable',
            'general_question' => 'string|nullable|max:500',
            'referred_by' => 'string|nullable',
            'english_level' => 'string|nullable',
            'banking_sector_expirience' => 'string|nullable',
            'motivation_answer' => 'string|nullable',
            '2y_experience' => 'string|nullable',
            'previous_work' => 'string|nullable',
            'list_blockchain_companies' => 'string|nullable',
            'teams_spread' => 'string|nullable',
            'blockchain_exp' => 'string|nullable',
            'start_working_date' => 'date|after:today|nullable',
            'three_examples_benefits' => 'string|nullable',
            'additional_info' => 'string|nullable'
        ];
    }
}
