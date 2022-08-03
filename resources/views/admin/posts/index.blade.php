@extends('layouts.app')

@section('content')

{{-- @if(Session::has('message'))
    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif --}}

<a class="btn btn-info mt-3" href="{{ route('posts.create') }}" style="background-color: rgba(71, 151, 151, 0.555)">Add new post</a>

<div class="row">
    
    @forelse ($data as $post)

        <div class="card col-md-6 col-sm-12 col-lg-6 m-3 p-4 d-flex justify-content-start align-items-stretch" style="width: 18rem; height:auto">
            <div class="card-header">
                <h4 class="card-title">{{ $post->title }}</h4>
            </div>
            <div class="card-body d-flex flex-column align-items-stretch justify-content-start align-items-start">
                <img class="card-img-top w-100" src="@if ($post->image != '') {{ asset('posts/' . $post->image) }} @else {{ asset('posts/no-image.png') }}@endif" alt="Card image cap" style="height:auto; margin:0 auto">

            </div>
            <span class="p-2"><b>URL link: </b> {{ $post->link_to_details }}</span>
            <div class="p-2">
                <p>{{ Str::limit($post->short_content, 120) }} </p>
                
                <a href="{{ route('posts.show', $post->slug) }}" class="badge btn-info align-self-end">Show more</a>
            </div>
            <div class="card-footer align-items-stretch">
                <div class="d-flex align-self-center">
                    <a href="{{ route('posts.edit', $post->slug) }}" class="btn btn-warning" style="width:100px;margin-right:5px;background-color:rgb(189, 221, 221)">Edit</a>
                    <form action="{{ route('posts.destroy', $post->slug) }}" method="POST" class="form">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-danger form-control" style="width:100px;" onclick="return confirm('Are You sure ?')">Delete</button>
                    </form>
                </div>
                <p class="mt-1 mb-0"> Posted by: <b>{{ $post->user->name }}</b></p>
                <p class="card-text"><small class="text-muted">Updated {{ $post->updated_at }}</small></p>
            </div>
        </div>
    @empty
        <div class="mt-3">
            <h4>Currently there are no posts.</h4>
        </div>

    @endforelse

</div>
    <div class="d-flex justify-content-center">
        <span>
            {{ $data->links() }}
        </span>
    </div>
@endsection