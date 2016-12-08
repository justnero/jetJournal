@extends('layouts.app')

@section('title', 'Занятия на '.$today->format('d.m.Y'))

@section('content')
    <div id="class-index" class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <ol class="breadcrumb">
                            <li><a href="/">Главная</a></li>
                            <li class="active">Занятия</li>
                        </ol>
                        <div class="panel-controls btn-group pull-right">
                            <a href="{{ route('class.create')  }}" class="btn btn-primary"
                               title="Создать"><i class="fa fa-plus"></i></a>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="container-fluid">
                            <div class="row" id="days">
                                <div class="col-md-4 col-sm-4 col-xs-4">
                                    <a href="{{ route('class.index', ['date' => $yesterday->format('d.m.Y')]) }}"><i class="fa fa-arrow-left"></i> {{ $yesterday->format('d.m.Y') }} ({{ $dayOfWeek($yesterday->format('N')) }})</a>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-4">
                                    {{ $today->format('d.m.Y') }} ({{ $dayOfWeek($today->format('N')) }})
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-4">
                                    <a href="{{ route('class.index', ['date' => $tomorrow->format('d.m.Y')]) }}">{{$tomorrow->format('d.m.Y') }} ({{ $dayOfWeek($tomorrow->format('N')) }}) <i class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12" id="classes">
                                    @forelse($classes as $class)
                                        @include('class.parts.index-class')
                                    @empty
                                        <h4 class="text-center text-success">Занятий нет</h4>
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
