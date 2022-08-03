<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\MailService;
use App\Models\JobApplication;
use App\Http\Requests\JobRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\JobApplicationRequest;
use Illuminate\Support\Facades\Storage;

class JobsController extends Controller
{

    public function index()
    {
        $data['categories'] = Category::select('id', 'slug', 'name', 'created_at', 'updated_at')
            ->has('jobs')
            ->get();
        $data['jobs'] = Job::select('slug', 'name', 'position_description', 'location', 'type', 'level', 'salary', 'department', 'category_id', 'created_at', 'updated_at')
            ->with('category')
            ->orderBy('updated_at', 'desc')
            ->get();

        if ($data) {

            return response()->json(['data' => $data, 'success' => true, 'msg' => ''], 200);
        } else {

            return response()->json(['data' => [], 'success' => false, 'msg' => 'No data found'], 400);
        }
    }

    public function store(JobRequest $request)
    {
        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'location' => $request->location ?? 'Remote',
            'job_requiretments' => $request->job_requiretments,
            'level' => $request->level ?? 'Senior',
            'type' => $request->type ?? 'Full-Time',
            'department' => $request->department ?? 'Tech',
            'salary' => $request->salary ?? 'N/A',
            'inery_description' => $request->inery_description ?? 'We are Inery',
            'slug' => Str::random(24)
        ];

        if ($job = Job::create($data)) {

            return response()->json(['data' => $job,  'success' => true, 'msg' => 'Job created successfuly.'], 201);
        } else {

            return response()->json(['data' => [], 'success' => false, 'msg' => 'Something went wrong.']);
        }
    }

    public function update(JobRequest $request, $slug)
    {
        $job = Job::where('slug', $slug)->first();

        if ($job->update($request->validated())) {

            return response()->json(['data' => $job, 'success' => true, 'msg' => 'Job updated successfuly'], 200);
        } else {

            return response()->json(['data' => [], 'success' => false, 'msg' => 'Something went wrong.']);
        }
    }

    public function show(Request $request)
    {
        $slug = $request->slug;

        if ($slug != '' && !empty($slug)) {
            $job = Job::select('slug', 'name', 'inery_description', 'description', 'location', 'job_requiretments', 'type', 'category_id', 'level', 'department', 'salary', 'created_at', 'updated_at')
                ->with('category')
                ->where('slug', $slug)
                ->first();

            if (!empty($job)) {
                $similarJobs = Job::select('slug', 'name', 'position_description', 'location', 'level', 'type', 'department', 'salary', 'category_id', 'created_at', 'updated_at')
                    ->with('category')->where('category_id', $job->category_id)
                    ->where('slug', '!=', $slug)
                    ->get()
                    ->shuffle()
                    ->take(4);

                return response()->json(['data' => $job, 'similar_jobs' => $similarJobs, 'success' => true, 'msg' => ''], 200);
            } else {

                return response()->json(['data' => [], 'success' => false, 'msg' => 'Not found'], 404);
            }
        } else {

            return response()->json(['data' => [], 'success' => false, 'msg' => 'Bad request'], 400);
        }
    }

    public function byCategory(Request $request)
    {
        $id = $request->id;

        if ($id != '' || !is_numeric($id)) {
            $category = Category::where('id', $id)->first();
            $jobs = Job::select('slug', 'name', 'position_description', 'location', 'level', 'type', 'department', 'salary', 'created_at', 'updated_at', 'category_id')
                ->with('category')
                ->where('category_id', $category->id)
                ->orderBy('updated_at', 'desc')
                ->get();

            if (!empty($jobs) && count($jobs) > 0) {

                return response()->json(['data' => $jobs, 'success' => true, 'msg' => ''], 200);
            } else {

                return response()->json(['data' => [], 'success' => true, 'msg' => 'No jobs found for that category.'], 404);
            }
        } else {

            return response()->json(['data' => [], 'success' => false, 'msg' => 'Bad request'], 400);
        }
    }

    public function jobAplication(JobApplicationRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('cv')) {

            $file = $request->file('cv');
            $fileName = time() . $file->getClientOriginalName();

            if (Storage::disk('local')->putFileAs('public/uploads/cvs', $file, $fileName)) {

                $data['path1'] = storage_path('app/public/uploads/cvs/' . $fileName);
                $data['path_cv'] = 'cvs/' . $fileName;
                unset($data['cv']);
            }
        }

        if ($request->hasFile('cover_letter')) {

            $file = $request->file('cover_letter');
            $fileName = time() . $file->getClientOriginalName();

            if (Storage::disk('local')->putFileAs('public/uploads/cvs', $file, $fileName)) {

                $data['path2'] = storage_path('app/public/uploads/cvs/' . $fileName);
                $data['path_cl'] = 'cvs/' . $fileName;
                unset($data['cover_letter']);
            }
        }

        MailService::sendMail($data);

        /* If needed to delete uploaded files
        MailService::deleteUploadedFile($data['path1']);

        if (isset($data['path2'])) {

            MailService::deleteUploadedFile($data['path2']);
        }
        */

        JobApplication::create($data);

        return response()->json(['msg' => 'Job application sent', 'success' => true], 200);
    }
}
