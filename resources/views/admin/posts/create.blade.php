@extends('layouts.app')

@section('title', 'Create new post')

@section('content')

    <div class="container">
    
        <h3 class="h3 offset-4 mt-3">Create new post</h3>

        @if($errors)
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger col-md-6 offset-2 offset-2">{{ $error }}</div>
            @endforeach
        @endif

        <form action="{{ route('posts.store')}}" method="POST" class="form" enctype='multipart/form-data'>
            @csrf

            <div class="mb-3 col-md-6  offset-2">
                <label for="name" class="form-label">Post title</label>
                <input type="title" class="form-control @error('title') border border-danger border-2 @enderror" name="title" id="exampleFormControlInput1" placeholder="Enter post title here" value="{{ old('title') }}">
            </div>

            <div class="mb-3">
                @error('title')
                    <span class="text-danger offset-2 offset-2 mb-3">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3 col-md-6 offset-2">
                <label for="name" class="form-label">Url slug</label>
                <input type="text" class="form-control @error('link_to_details') border border-danger border-2 @enderror" name="link_to_details" id="link_to_details" placeholder="Enter post title here" value="{{ old('link_to_details') }}">
                <p class="mt-1"><mark><i>You can only use letters, numbers, hyphens, and dashes.</i><mark></p>
            </div>
            <div class="mb-5">
                @error('link_to_details')
                    <span class="text-danger offset-2 offset-2 mb-3">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3 col-md-6 offset-2">
                <label for="content" class="form-label">Post Content</label>
                <textarea class="form-control tinymce-editor"  name="content" id="content">{{ old('content') }}</textarea>
            </div>

            @error('content')
                <span class="text-danger offset-2 offset-2 mb-3">{{ $message }}</span>
            @enderror

            <div class="mb-3 col-md-6 offset-2">
                <label for="short-content" class="form-label">Short Content</label>
                <textarea maxlength="255"  class="form-control"  name="short_content" id="short_content">{{ old('short_content') }}</textarea>
            </div>

            @error('short_content')
                <span class="text-danger offset-2 offset-2 mb-3">{{ $message }}</span>
            @enderror

            <div class="mb-3 col-md-6  offset-2">
                <label for="image" class="form-label">Upload image</label>
                <input type="file" name="image" class="form-control" id="image" onchange="preview()">
                <img id="frame" src="" class="img-fluid mt-3" />
                <p><button onclick="clearImage()" type="button" id="remove-img-btn" class="btn btn-danger mt-3 d-none">Remove image</button></p>
            </div>

            <div class="form-check mb-3 col-md-6 offset-2">
                <input type="checkbox" id="trending" class="form-check-input" name="trending"> 
                <label for="trending" class="form-check-label">In trending ? </label>
            </div>

            <div class="mb-3 mt-3 col-md-6  offset-2">
                <input type="submit" class=" btn btn-primary" value="Save Post"/> 
            </div>

        </form>
    </div>
@endsection

{{-- <script>

    function preview(e) {
        // e.preventDefault();
        frame.src = URL.createObjectURL(event.target.files[0]);
    }
    
    function clearImage(e) {
        // e.preventDefault();
        document.getElementById('image').value = null;
        frame.src = "";
    }
</script> --}}