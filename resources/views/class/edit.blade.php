@extends('layouts.app')

@section('title', 'Редактирование группы')

@section('content')
    <div id="class-edit" class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <ol class="breadcrumb">
                            <li><a href="/">Главная</a></li>
                            <li><a href="{{ route('class.index') }}">Занятия</a></li>
                            <li><a href="{{ route('class.show', $class) }}">{{ $class->discipline->name }}</a></li>
                            <li class="active">Редактирование</li>
                        </ol>
                    </div>

                    <div class="panel-body">
                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger">
                                {{ $error }}
                            </div>
                        @endforeach
                        {!! Form::model($class, ['route' => ['class.update', $class], 'method' => 'patch']) !!}
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
                            {!! Form::datetimeLocal('date', $class->date, ['class'=>'form-control', 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('duration', 'Длительность') !!}
                            {!! Form::time('duration', \Carbon\Carbon::parse($class->getOriginal('duration'))->format('H:i:s'), ['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('location', 'Кабинет') !!}
                            {!! Form::text('location', null, ['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('type', 'Тип занятия') !!}
                            {!! Form::select('type', $types, $class->getOriginal('type'), ['class'=>'form-control']) !!}
                        </div>
                        {!! Form::submit('Сохранить', ['class'=>'btn btn-primary btn-block']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
