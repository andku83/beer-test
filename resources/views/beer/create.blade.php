@extends('layouts.default')
@section('content')

    <h2>Create Beer</h2>

    @include('includes.errors')

    {!! Form::open(['action' => 'BeerController@store', 'method' => 'POST']) !!}

    <div class="form-group">
        {!! Form::label('name') !!}
        {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('text') !!}
        {!! Form::textarea('text', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('brand') !!}
        {!! Form::select('brand_id', \App\Brand::orderBy('name')->pluck('name', 'id'), null, ['class' => 'form-control', 'required']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('type') !!}
        {!! Form::select('type_id', \App\BeerType::orderBy('name')->pluck('name', 'id'), null, ['class' => 'form-control', 'required']) !!}
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
