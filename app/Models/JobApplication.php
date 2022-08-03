<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;

    protected $table = 'job_applications';

    protected $fillable = ['job_title', 'path_cv', 'path_cl', 'first_name', 'last_name', 'email', 'phone', 'company', 'location', 'linkedin_url', 'twitter_url', 'instagram_url', 'github_url', 'other_url', 'general_question', 'additional_info'];
}
