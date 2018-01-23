@extends('layouts.default')
@section('content')
    <h2>Beer view {{ $model->name }}</h2>
    <ul>
        <li>Name: {{ $model->name }}</li>
        <li>Brand: {{ $model->brand->name }}</li>
        <li>Type: {{ $model->type->name }}</li>
        <li>Status: {{ $model->getStatus() }}</li>
    </ul>
    <a class="btn btn-success" href="{{ action('BeerController@edit', ['id' => $model->id]) }}">Edit</a>
@stop
