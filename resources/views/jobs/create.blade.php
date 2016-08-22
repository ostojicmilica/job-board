@extends('app')

@section('content')

    <h1>Publish a job offer</h1>
    <hr>

    {!! Form::open(['url' => 'jobs']) !!}

        <div class="form-group">

            {{ Form::label('title', 'Title:') }}
            {{ Form::text('title', null, ['class' => 'form-control']) }}

        </div>

        <div class="form-group">

            {{ Form::label('description', 'Description:') }}
            {{ Form::textarea('description', null, ['class' => 'form-control']) }}

        </div>

        <div class="form-group">

            {{ Form::label('email', 'Email:') }}
            {{ Form::email('email', null, ['class' => 'form-control']) }}

        </div>

        <div class="form-group">

            {{ Form::submit('Publish', ['class' => 'btn btn-primary form-control']) }}

        </div>

    {!! Form::close() !!}



@stop