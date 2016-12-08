@extends('layouts.app')

@section('title', 'Упс... 403')

@section('content')
    <div id="error-403" class="error-page">
        <h1>{{ $exception->getMessage() }}</h1>
    </div>
@endsection