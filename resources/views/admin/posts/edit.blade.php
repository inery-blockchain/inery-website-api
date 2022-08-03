@extends('layouts.app')

@section('title', 'Edit post')

@section('content')

    <div class="container">
    
        <h3 class="h3 offset-4 mt-3">Edit post</h3>
        @if($errors)
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger col-md-6  offset-2 offset-2">{{ $error }}</div>
            @endforeach
        @endif

        <form action="{{route('posts.update', $data->slug)}}" method="POST" class="form" enctype='multipart/form-data'>
            @csrf
            @method('PUT')
            <div class="mb-3 col-md-6  offset-2">
                <label for="name" class="form-label">Post title</label>
                <input type="name" class="form-control @error('title') border border-danger border-2 @enderror" name="title" id="name" value="{{ $data['title'] }}">
            </div>

            <div>
                @error('title')
                    <span class="text-danger offset-2 offset-2 mb-3">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3 col-md-6 offset-2">
                <label for="name" class="form-label">Post url slug</label>
                <input type="text" class="form-control @error('link_to_details') border border-danger border-2 @enderror" name="link_to_details" id="link_to_details" placeholder="Enter post slug here" value="{{ $data['link_to_details'] }}">
                <p class="mt-1"><mark><i>You can only use letters, numbers, hyphens, and dashes.</i><mark></p>
            </div>

            <div class="mb-5">
                @error('link_to_details')
                    <span class="text-danger offset-2 offset-2 mb-3">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3 col-md-6  offset-2">
                <label for="content" class="form-label">Post content</label>
                <textarea class="form-control tinymce-editor"  name="content" id="description"><?php echo $data['content'] ?></textarea>
            </div>

            <div>
                @error('content')
                    <span class="text-danger offset-2 offset-2 mb-3">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3 col-md-6  offset-2">
                <label for="short-content" class="form-label">Short Content</label>
                <textarea  rows="9" class="form-control" maxlength="255" name="short_content" id="short_content" value="{{ $data['short_content'] }}">{{ $data['short_content'] }}</textarea>
            </div>

            @error('short_content')
                <span class="text-danger offset-2 offset-2 mb-3">{{ $message }}</span>
            @enderror

             <div class="mb-3 col-md-6  offset-2">
                <label for="user" class="form-label">Posted By</label>
                <select id="user" name="user_id" class="form-control">
                    @foreach ($users as $user)
                        <option value="{{ $user->id}}" @if($user->id == $data->user_id) selected @endif>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3 col-md-6  offset-2">
                <label for="image" class="form-label">Upload image</label>
                <input type="file" name="image" class="form-control mb-3" id="image" onchange="preview() ">
                <input type="hidden" id="delete-image-input" name="remove_image" value="0">
             
                <img id="frame" src="@if ($data['image'] != null) {{ asset('posts/' . $data['image']) }} @else @endif" class="img-fluid" />
                <div>
                    <button onclick="clearImage()" type="button" id="remove-img-btn" class="btn btn-danger mt-3 @if ($data['image'] == null) d-none" @else " @endif >Remove image</button>
                </div>
            </div>

            <div class="form-check mb-3 col-md-6 offset-2">
                <label for="trending" class="form-check-label">In trending ? </label>

                <input type="checkbox" id="trending" class="form-check-input" name="trending"  @if ($data['trending'] == 1) checked @endif>
            </div>

            <div class="mb-3 col-md-6  offset-2">
                <input type="submit" class="btn btn-primary" value="Update Post"/> 
            </div>

        </form>
    </div>
@endsection
