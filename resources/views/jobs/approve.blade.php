@extends('app')

@section('content')

    <h1>Approve or reject {{ $email }}</h1>
    <hr>

    {!! Form::open(['url' => 'approve']) !!}

    <div class="form-group">

        {{ Form::select('offer', array('Approve' => 'Approve', 'Reject' => 'Reject',)) }}

    </div>

    <div class="form-group">

        {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
        {{ Form::hidden('email', $email) }}

    </div>

    {!! Form::close() !!}

@stop
