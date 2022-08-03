@extends('layouts.app')

@section('title', 'Index')

@section('content')

    @if(Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
    @endif

    <h3 class="mt-5" style="margin: auto 400px; width:auto">Currently opened positions</h3>

    <a class="btn btn-info" href="{{ route('jobs.create') }}">Add new job</a>
    
    <div class="row">
    
        @foreach ($data as $job)

            <div class="card col-md-6 col-sm-12 col-lg-6 m-3 p-4 d-flex" style="width: 18rem;">
                <img class="card-img-top" src="{{ asset($job->category->image) }}" alt="Card image cap" style="width:auto; height:150px; margin:0 20px">
                <div class="card-body">
                    <h4 class="card-title"><a href="{{ route('jobs.show', $job->slug) }}" class="badge btn-info">{{ $job->name }}</a></h4>
                    <p class="card-text"><?php echo $job->position_description ?></p>
                </div>
                <p class="card-text"><small class="text-muted">{{ Carbon\Carbon::parse($job->updated_at)->diffForHumans() }}</small></p>

                <div class="d-flex align-self-center">
                    <a href="{{ route('jobs.edit', $job->slug) }}" class="btn btn-warning form-control" style="margin-right:20px">Edit</a>
                    <form action="{{ route('jobs.destroy', $job->slug) }}" method="POST" class="form">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-danger form-control">Delete</button>
                    </form>
                </div>

            </div>

        @endforeach
    </div>
    <div class="d-flex justify-content-center">
        <span>
            {{ $data->links() }}
        </span>
    </div>
@endsection
