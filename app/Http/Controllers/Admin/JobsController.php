<?php

namespace App\Http\Controllers\Admin;

use App\Models\Job;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\JobRequest;
use App\Http\Controllers\Controller;
use App\Models\JobApplication;

class JobsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.jobs.index', ['data' => Job::with('category')->orderBy('updated_at', 'desc')->paginate(8)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.jobs.create', ['categories' => Category::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
            'department' => $request->department ?? 'Development',
            'salary' => $request->salary ?? 'N/A',
            'inery_description' => $request->inery_description ?? 'We are Inery',
            'position_description' => $request->position_description ?? null,
            'slug' => Str::random(24)
        ];

        if ($job = Job::create($data)) {

            return redirect()->route('jobs.index')->with('message',  'Job created successfuly');
        } else {

            return redirect()->back()->with('message', 'Something went wrong');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {

        return view('admin.jobs.show', ['data' => Job::where('slug', $slug)->first()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $categories = Category::all();
        $job = Job::where('slug', $slug)->first();

        return view('admin.jobs.edit', ['data' => $job, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(JobRequest $request, $slug)
    {
        $job = Job::where('slug', $slug)->first();

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'position_description' => $request->position_description,
            'location' => $request->location ?? 'Remote',
            'job_requiretments' => $request->job_requiretments,
            'level' => $request->level ?? 'Any',
            'type' => $request->type ?? 'Full-Time',
            'department' => $request->department ?? 'Department',
            'salary' => $request->salary ?? 'N/A',
            'inery_description' => $request->inery_description
        ];

        if ($job->update($data)) {

            return redirect()->route('jobs.index')->with('message', 'Job edited successfuly');
        } else {

            return redirect()->back()->with('message', 'Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $job = Job::where('slug', $slug)->first();
        if ($job->delete()) {

            return redirect()->route('jobs.index')->with('message', 'Job deleted successfuly.');
        } else {

            return redirect()->route('jobs.index')->with('message', 'Something went wrong.');
        }
    }

    public function jobApplications()
    {
        $data = JobApplication::orderBy('updated_at', 'desc')->get();

        return view('admin.jobs.applications', ['data' => $data]);
    }
}
