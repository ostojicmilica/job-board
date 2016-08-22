@extends('app')

@section('content')

    <h1>Job Board</h1>
    <hr>

    @foreach($jobs as $job)

    <div>
        <h3>
            <a href="{{ url('/jobs', $job->id) }}"> {{ $job->title }} </a>
        </h3 >

        <div class="description">{{ $job->description }}</div>

        <a href="mailto:{{$job->email}}">Contact: {{$job->email}}</a>
    </div>

    @endforeach

@stop