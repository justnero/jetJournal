@extends('layouts.app')

@section('title', 'Удаление занятия')

@section('content')
    <div id="class-delete" class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <ol class="breadcrumb">
                            <li><a href="/">Главная</a></li>
                            <li><a href="{{ route('class.index') }}">Группы</a></li>
                            <li><a href="{{ route('class.show', $class) }}">{{ $class->discipline->name }}</a></li>
                            <li class="active">Удаление</li>
                        </ol>
                    </div>

                    <div class="panel-body">
                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger">
                                {{ $error }}
                            </div>
                        @endforeach
                        {!! Form::model($class, ['route' => ['class.destroy', $class], 'method' => 'delete']) !!}
                            <div class="form-group">
                                {!! Form::label('group', 'Группа') !!}
                                {!! Form::text('group', $class->group->name, ['class'=>'form-control', 'disabled']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('discipline', 'Дисциплина') !!}
                                {!! Form::text('discipline', $class->discipline->name, ['class'=>'form-control', 'disabled']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('teacher', 'Преподаватель') !!}
                                {!! Form::text('teacher', $class->teacher ? $class->teacher->name : '', ['class'=>'form-control', 'disabled']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('date', 'Дата') !!}
                                {!! Form::datetimeLocal('date', $class->date, ['class'=>'form-control', 'disabled']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('duration', 'Длительность') !!}
                                {!! Form::time('duration', $class->duration->format('H:i:s'), ['class'=>'form-control', 'disabled']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('location', 'Кабинет') !!}
                                {!! Form::text('location', $class->location, ['class'=>'form-control', 'disabled']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('type', 'Тип занятия') !!}
                                {!! Form::text('type', $class->type, ['class'=>'form-control', 'disabled']) !!}
                            </div>
                        {!! Form::submit('Удалить', ['class'=>'btn btn-danger btn-block']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
