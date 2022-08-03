@extends('layouts.app')

@section('title', 'Create job content')

@section('content')

    <div class="container">
    
        <h3 class="h3  offset-4">Create new job</h3>

        {{-- @if($errors)
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger col-md-6  offset-2 offset-2">{{ $error }}</div>
            @endforeach
        @endif --}}

        <form action="{{route('jobs.store')}}" method="POST" class="form">
            @csrf

            <div class="mb-3 col-md-6  offset-2">
                <label for="name" class="form-label">Job Name</label>
                <input type="name" class="form-control @error('name') border border-danger border-2 @enderror" name="name" id="exampleFormControlInput1" placeholder="Enter job name here" value="{{ old('name') }}">
            </div>
            <div>

                @error('name')
                    <span class="text-danger offset-2 offset-2 mb-3">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3 col-md-6  offset-2">
                <label for="description" class="form-label">Job Description</label>
                <textarea class="form-control tinymce-editor"  name="description" id="description" value="{{ old('description') }}"></textarea>
            </div>

            @error('description')
                <span class="text-danger offset-2 offset-2 mb-3">{{ $message }}</span>
            @enderror

            <div class="mb-3 col-md-6  offset-2">
                <label for="job_requiretments" class="form-label">Job requiretments</label>
                <textarea class="form-control tinymce-editor"  name="job_requiretments" id="job_requiretments" value="{{ old('job_requiretments') }}"></textarea>
            </div>

            @error('job_requiretments')
                <span class="text-danger offset-2 offset-2 mb-3">{{ $message }}</span>
            @enderror

            <div class="mb-3 col-md-6  offset-2">
                <label for="inery_description" class="form-label">Inery description</label>
                <textarea class="form-control tinymce-editor"  name="inery_description" id="inery_description" value="{{ old('inery_description') }}"></textarea>
            </div>

            @error('inery_description')
                <span class="text-danger offset-2 offset-2 mb-3">{{ $message }}</span>
            @enderror

            <div class="mb-3 col-md-6  offset-2">
                <label for="position_description" class="form-label">Position description</label>
                <textarea class="form-control tinymce-editor"  name="position_description" id="position_description" value="{{ old('position_description') }}"></textarea>
            </div>

            @error('position_description')
                <span class="text-danger offset-2 offset-2 mb-5">{{ $message }}</span>
            @enderror

            <div class="mb-3 col-md-6  offset-2">
                <label for="location" class="form-label"  value="{{ old('location') }}">Location</label>
                <input type="text" id="location" name="location" class="form-control" placeholder="Enter job location here" >
            </div>

            <div class="mb-3 col-md-6  offset-2">
                <label for="level" class="form-label">Level</label>
                <select id="level" name="level" class="form-control" placeholder="Enter job seniority"  value="{{ old('level') }}">
                    <option value="any">Any</option>
                    <option value="junior">Junior</option>
                    <option value="medior">Medior</option>
                    <option value="senior">Senior</option>
                </select>
            </div>

            <div class="mb-3 col-md-6  offset-2">
                <label for="type" class="form-label">Type employment</label>
                <select id="type" name="type" class="form-control" placeholder="Enter job seniority"  value="{{ old('type') }}">
                    <option value="Full-Time">Full-Time</option>
                    <option value="Part-Time">Part-Time</option>
                    <option value="Temporary">Temporary</option>
                    <option value="Seasonal">Seasonal</option>
                </select>
            </div>

            <div class="mb-3 col-md-6  offset-2">
                <label for="category" class="form-label">Category</label>
                <select id="category" name="category_id" class="form-control">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id}}">{{ $category->name }}</option>
                    @endforeach
                    
                </select>
            </div>

            <div class="mb-3 col-md-6  offset-2">
                <label for="department" class="form-label"  value="{{ old('location') }}">Department</label>
                <input type="text" id="department" name="department" class="form-control" placeholder="Enter job department here" >
            </div>

            <div class="mb-3 col-md-6  offset-2">
                <label for="salary" class="form-label"  value="{{ old('location') }}">Salary</label>
                <input type="text" id="salary" name="salary" class="form-control" placeholder="Enter job salary here" >
            </div>

            <div class="mb-3 col-md-6  offset-2">
                <input type="submit" class="form-control btn btn-primary" value="Save"/> 
            </div>

        </form>
    </div>
@endsection