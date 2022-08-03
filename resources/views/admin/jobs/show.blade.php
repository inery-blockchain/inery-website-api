@extends('layouts.app')

@section('title', "Show job content")

@section('content')
    <div class="container mt-5">
        <h4>{{ $data->name }}</h4>
        <p> Job Description: <?php echo $data->description ?> </p>
        <p> Job requiretments: <?php echo $data->job_requiretments ?> </p>
        <p> Position description: <?php echo $data->position_description ?> </p>
        <p> Inery description: <?php echo $data->inery_description ?> </p>
        <p> Location: {{ $data->location }} </p>
        <p> Seniority level: {{ $data->level }} </p>
        <p> Employment type: {{ $data->type }} </p>
        <p> Department: {{ $data->department }} </p>
        <p> Salary: {{ $data->salary }} </p>
        <p> Category: {{ $data->category->name }}</p>
        {{ \Carbon\Carbon::parse($data['updated_at'])->diffForHumans() }} 

    </div>
@endsection
