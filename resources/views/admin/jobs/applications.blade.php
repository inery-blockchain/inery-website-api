@extends('layouts.app')

@section('title', 'Job applications')

@section('content')

<table class="table table-striped mt-4 table-light w-auto table-bordered">
    <h3 class="h3 mt-5" style="margin-left:400px">Job applications</h3>
    <thead class="table-dark">
        <th>Job title</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Phone</th>
        <th>Location</th>
        <th>Company</th>
        <th>Linkedin</th>
        <th>Instagram</th>
        <th>Twitter</th>
        <th>Doc</th>
        <th class="col-md-2">General Question</th>
    </thead>
    
    @foreach ($data as $apl)
        <tr>
            <td >{{ $apl->job_title }}</td>
            <td>{{ $apl->first_name }}</td>
            <td>{{ $apl->last_name }}</td>
            <td>{{ $apl->phone }}</td>
            <td>{{ $apl->location }}</td>
            <td>{{ $apl->company }}</td>
            <td><a href="{{ $apl->linkedin_url }}">URL</a></td>
            <td>@if(!empty($apl->instagram_url)) <a href="{{ $apl->instagram_url }}">URL</a> @else N/A @endif</td>
            <td>@if(!empty($apl->twitter_url)) <a href="{{ $apl->twitter_url }}">URL</a> @else N/A @endif</td>
            <td>
                <a class="btn btn-sm" href="{{ asset($apl->path_cv) }}" style="background-color:rgb(125, 158, 190); width: 100px; margin: 5px 5px" target="_blank"> C V </a>
                @if (!empty($apl->path_cl))
                    <a class="btn btn-sm" href="{{ asset($apl->path_cl) }}" style="background-color:rgb(125, 157, 188); width: 100px; margin: 5px 5px" target="_blank"> Cover Letter </a>
                @endif
            </td>
            <td class="col-md-2">{{ Illuminate\Support\Str::limit($apl->general_question, 50) }}</td>
        </tr>
    @endforeach


</table>

@endsection