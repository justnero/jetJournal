@extends('layouts.app')

@section('title', 'Занятие по '.$class->discipline->name)

@section('content')
    <div id="class-show" class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <ol class="breadcrumb">
                            <li><a href="/">Главная</a></li>
                            <li class="active">Занятия</li>
                        </ol>
                        @if($canEdit)
                            <div class="panel-controls btn-group pull-right">
                                <a href="{{ route('class.edit', $class)  }}" class="btn btn-warning"
                                   title="Редактировать"><i class="fa fa-edit"></i></a>
                                <a href="{{ route('class.delete', $class)  }}" class="btn btn-danger"
                                   title="Удалить"><i class="fa fa-trash"></i></a>
                            </div>
                        @endif
                    </div>

                    <div class="panel-body">
                        <div class="container-fluid">
                            <div class="row" id="days">
                                <div class="col-md-4 col-md-offset-4">
                                    {{ $class->date->format('d.m.Y') }} ({{ $dayOfWeek($class->date->format('N')) }})
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12" id="classes">
                                    @include('class.parts.show-class')
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12" id="attendance">
                                    {!! Form::open(['route'=>['class.attendance',$class], 'method'=>'patch']) !!}
                                    @foreach($students as $stud_id => $el)
                                        @include('class.parts.show-attendance')
                                    @endforeach
                                    @if($canEdit)
                                        {!! Form::submit('Сохранить', ['class'=>'btn btn-primary btn-block']) !!}
                                    @endif
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
