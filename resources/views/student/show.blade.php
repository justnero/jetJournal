@extends('layouts.app')

@section('title', 'Страница студента '.$student->name)

@section('content')
    <div id="student-show" class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <ol class="breadcrumb">
                            <li><a href="/">Главная</a></li>
                            <li><a href="{{ route('student.index') }}">Студенты</a></li>
                            <li class="active">{{ $student->name }}</li>
                        </ol>
                    </div>

                    <ul class="panel-body list-group">
                        @if(!empty($student->phone))
                            <li class="list-group-item">
                                <b>E-mail:</b><br>
                                <span>{{ $student->email }}</span>
                            </li>
                        @endif
                        @if(!empty($student->phone))
                            <li class="list-group-item">
                                <b>Телефон:</b><br>
                                <span>{{ $student->phone }}</span>
                            </li>
                        @endif
                        @if(!empty($student->address))
                            <li class="list-group-item">
                                <b>Адрес:</b><br>
                                <span>{{ $student->address }}</span>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
