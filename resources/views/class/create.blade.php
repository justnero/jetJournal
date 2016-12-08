@extends('layouts.app')

@section('title', 'Добавление занятия')

@section('content')
    <div id="class-create" class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <ol class="breadcrumb">
                            <li><a href="/">Главная</a></li>
                            <li><a href="{{ route('class.index') }}">Занятия</a></li>
                            <li class="active">Добавление</li>
                        </ol>
                    </div>

                    <div class="panel-body">
                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger">
                                {{ $error }}
                            </div>
                        @endforeach
                        {!! Form::model($class, ['route' => ['class.store'], 'method' => 'post']) !!}
                            <div class="form-group">
                                {!! Form::label('group_id', 'Группа') !!}
                                {!! Form::select('group_id', $groups, null, ['class'=>'form-control', 'required']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('discipline_id', 'Дисциплина') !!}
                                {!! Form::select('discipline_id', $disciplines, null, ['class'=>'form-control', 'required']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('teacher_id', 'Преподаватель') !!}
                                {!! Form::select('teacher_id', $teachers, null, ['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('date', 'Дата') !!}
                                {!! Form::datetimeLocal('date', \Carbon\Carbon::now()->format('Y-m-d\TH:i'), ['class'=>'form-control', 'required']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('duration', 'Длительность') !!}
                                {!! Form::time('duration', '01:30:00', ['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('location', 'Кабинет') !!}
                                {!! Form::text('location', null, ['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('type', 'Тип занятия') !!}
                                {!! Form::select('type', $types, null, ['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group" id="repeat">
                                {!! Form::label('repeat', 'Повторять') !!}
                                {!! Form::select('repeat', $repeats, null, ['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group" id="repeat_till">
                                {!! Form::label('repeat_till', 'До') !!}
                                {!! Form::date('repeat_till', null, ['class'=>'form-control']) !!}
                            </div>
                        {!! Form::submit('Сохранить', ['class'=>'btn btn-primary btn-block']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
