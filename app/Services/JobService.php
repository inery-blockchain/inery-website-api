<?php

namespace App\Services;

use Validator;
use App\Models\Job;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class JobService
{
    public static function getAllJobs()
    {
        return Job::all();
    }

    public static function getAllJobsWithCategories()
    {
        return Job::with('category')->orderBy('updated_at', 'desc')->get();
    }

    public static function getJobsByLocation($location)
    {
        return Job::where('location', $location)->orderBy('updated_at', 'desc')->get();
    }

    public static function getSingleJob($id)
    {
        $job = Job::findOrFail($id);
        if ($job) {
            return $job;
        } else {
            return false;
        }
    }
    
    public static function getJobsByCategory($id)
    {
        if ($jobs = Job::where('category_id', $id)->get()) {
            return $jobs;
        } else {
            return false;
        }
    }
}