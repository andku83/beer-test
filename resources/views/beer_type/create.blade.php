@extends('layouts.default')
@section('content')

    <h2>Create Beer Type</h2>

    @include('includes.errors')

    {!! Form::open(['action' => 'BeerTypeController@store', 'method' => 'POST']) !!}

    <div class="form-group">
        {!! Form::label('name') !!}
        {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
    </div>

    <div class="form-group">
        {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}

@stop
