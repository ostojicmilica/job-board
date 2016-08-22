@extends('app')

@section('content')

    <h1>{{ $job->title }}</h1>

    <div>

        <div class="description">{{ $job->description }}</div>
        <a href="mailto:{{$job->email}}">Contact: {{$job->email}}</a>

    </div>

@stop