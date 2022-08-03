@extends('layouts.app')

@section('title', 'Edit job content')

@section('content')

    <div class="container">
    
        <h3 class="h3 offset-4">Edit job</h3>
        @if($errors)
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger col-md-6  offset-2 offset-2">{{ $error }}</div>
            @endforeach
        @endif


        <form action="{{route('jobs.update', $data->slug)}}" method="POST" class="form">
            @csrf
            @method('PUT')
            <div class="mb-3 col-md-6  offset-2">
                <label for="name" class="form-label">Job Name</label>
                <input type="name" class="form-control" name="name" id="name" placeholder="Enter job name here" value="{{ $data['name'] }}">
            </div>
            <div>
                {{-- @if ($errors->name)
                    <span>{{ $errors->name }}</span>
                @endif --}}
            </div>

            <div class="mb-3 col-md-6  offset-2">
                <label for="description" class="form-label">Job Description</label>
                <textarea class="form-control tinymce-editor"  name="description" id="description">
                    <?php echo $data['description'] ?>
                </textarea>
            </div>

            <div class="mb-3 col-md-6  offset-2">
                <label for="description" class="form-label">Position Description</label>
                <textarea class="form-control tinymce-editor"  name="position_description" id="description">
                    <?php echo $data->position_description ?>
                </textarea>
            </div>
            

            <div class="mb-3 col-md-6  offset-2">
                <label for="job_requiretments" class="form-label">Job requiretments</label>
                <textarea class="form-control tinymce-editor"  name="job_requiretments" id="job_requiretments">
                    <?php echo $data['job_requiretments'] ?>
                </textarea>
            </div>

            <div class="mb-3 col-md-6  offset-2">
                <label for="inery_description" class="form-label">Inery description</label>
                <textarea class="form-control tinymce-editor"  name="inery_description" id="inery_description">
                    <?php echo $data['inery_description'] ?>
                </textarea>
            </div>

            <div class="mb-3 col-md-6  offset-2">
                <label for="location" class="form-label"  value="{{ $data['location'] }}">Location</label>
                <input type="text" id="location" name="location" class="form-control" placeholder="Enter job location here" value="{{ $data['location'] }}">
            </div>

            <div class="mb-3 col-md-6  offset-2">
                <label for="level" class="form-label">Level</label>
                <select id="level" name="level" class="form-control" placeholder="Enter job seniority"  value="{{ $data['level'] }}">
                    <option value="Any" @if ($data['level'] == 'Any') selected @endif>Any</option>
                    <option value="Junior" @if ($data['level'] == 'Junior') selected @endif>Junior</option>
                    <option value="Medior" @if ($data['level'] == 'Medior') selected @endif>Medior</option>
                    <option value="Senior" @if ($data['level'] == 'Senior') selected @endif>Senior</option>
                </select>
            </div>

            <div class="mb-3 col-md-6  offset-2">
                <label for="type" class="form-label">Type employment</label>
                <select id="type" name="type" class="form-control" placeholder="Enter job seniority"  value="{{ $data['type'] }}">
                    <option value="Full-Time" @if ($data['type'] == 'Full-Time') selected @endif>Full-Time</option>
                    <option value="Part-Time" @if ($data['type'] == 'Part-Time') selected @endif>Part-Time</option>
                    <option value="Temporary" @if ($data['type'] == 'Temporary') selected @endif>Temporary</option>
                    <option value="Seasonal" @if ($data['type'] == 'Seasonal') selected @endif>Seasonal</option>
                </select>
            </div>

            <div class="mb-3 col-md-6  offset-2">
                <label for="category" class="form-label">Category</label>
                <select id="category" name="category_id" class="form-control">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id}}" @if($category->id == $data->category_id) selected @endif>{{ $category->name }}</option>
                    @endforeach
                    
                </select>
            </div>

            <div class="mb-3 col-md-6  offset-2">
                <label for="department" class="form-label"  value="{{ old('location') }}">Department</label>
                <input type="text" id="department" name="department" class="form-control" placeholder="Enter job department here"  value="{{ $data['department'] }}">
            </div>

            <div class="mb-3 col-md-6  offset-2">
                <label for="salary" class="form-label"  value="{{ old('location') }}">Salary</label>
                <input type="text" id="salary" name="salary" class="form-control" placeholder="Enter job salary here"  value="{{ $data['salary'] }}">
            </div>

            <div class="mb-3 col-md-6  offset-2">
                <input type="submit" class="form-control btn btn-primary" value="Update"/> 
            </div>

        </form>
    </div>
@endsection