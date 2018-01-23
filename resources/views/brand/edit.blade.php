@extends('layouts.default')
@section('content')

    <h2>Edit Brand</h2>

    @include('includes.errors')

    {!! Form::model($model, ['action' => ['BrandController@update', 'id' => $model->id], 'method' => 'PUT']) !!}

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
        {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}

@stop
