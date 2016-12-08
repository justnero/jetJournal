@extends('layouts.app')

@section('title', 'Пары на сегодня')

@section('content')
<div id="home-dashboard" class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <ol class="breadcrumb">
                        <li class="active">Главная</li>
                    </ol>
                </div>

                <div class="panel-body">
                    <div class="container-fluid">
                        <div class="row" id="intro">
                            <div class="col-md-4 col-md-offset-4">
                                Занятия на сегодня
                            </div>
                        </div>
                        <div class="row" id="today">
                            <div class="col-md-4 col-md-offset-4">
                                {{ $today->format('d.m.Y') }} ({{ $dayOfWeek($today->format('N')) }})
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" id="classes">
                                @forelse($classes as $class)
                                    @include('class.parts.index-class')
                                @empty
                                    <h4 class="text-center text-success">Отсутствуют</h4>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
