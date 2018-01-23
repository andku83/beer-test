@extends('layouts.default')
@section('content')
    <h2>Brand view {{ $model->name }}</h2>
    <ul>
        <li>Name: {{ $model->name }}</li>
        <li>Status: {{ $model->getStatus() }}</li>
    </ul>
    <a class="btn btn-success" href="{{ action('BrandController@edit', ['id' => $model->id]) }}">Edit</a>
@stop
