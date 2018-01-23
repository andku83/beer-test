@extends('layouts.default')
@section('content')

    <h2>Create Brand</h2>

    @include('includes.errors')

    {!! Form::open(['action' => 'BrandController@store', 'method' => 'POST']) !!}

    <div class="form-group">
        {!! Form::label('name') !!}
        {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('status') !!}
        {!! Form::hidden('status', 0) !!}
        {!! Form::checkbox('status') !!}
    </div>

    <div class="form-group">
        {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}

@stop
