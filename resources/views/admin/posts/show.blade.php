@extends('layouts.app')

@section('title', "Post single")

@section('content')

    <div class="container mt-5">
        <h4>{{ $data->title }}</h4>
        <div class="mt-3">
            <p class="mb-3"> <b>Url link-slug: </b>{{ $data['link_to_details']  }} </p>
            <img src="{{ asset('posts/' . $data->image) }}" alt="">
            <p class="mb-5 mt-5"><b>Short content: </b> <?php echo $data->short_content ?></p>

            <p class="mt-5"><b>Full content: </b> <?php echo $data->content ?></p>
            <p class=" m-3"><b>In trending:</b> @if ($data->trending == '1') <span>Yes</span> @else <span>No</span> @endif</p>
            <i>Posted by: <b>{{ $data->postedBy }}</b></i>
        </div>
            <div> {{ $data['updated_at'] }} </div>

    </div>
@endsection
