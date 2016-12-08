@extends('layouts.app')

@section('title', $group->name.' редактирование')

@section('content')
    <div id="group-create" class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <ol class="breadcrumb">
                            <li><a href="/">Главная</a></li>
                            <li><a href="{{ route('group.index') }}">Группы</a></li>
                            <li><a href="{{ route('group.show', $group->id) }}">{{ $group->name }}</a></li>
                            <li class="active">Редактирование</li>
                        </ol>
                    </div>

                    <div class="panel-body">
                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger">
                                {{ $error }}
                            </div>
                        @endforeach
                        {!! Form::model($group, ['route' => ['group.update', $group], 'method' => 'patch']) !!}
                        <div class="form-group">
                            {!! Form::label('name', 'Название группы') !!}
                            {!! Form::text('name', null, ['class'=>'form-control', 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('course', 'Номер курса') !!}
                            {!! Form::number('course', null, ['class'=> 'form-control', 'required', 'min'=>1, 'max'=>9, 'step'=>1]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('super.name', 'Родительская группа') !!}
                            {!! Form::text('super.name', $group->super_id != 0 ? $group->super->name : 'Корневая группа', ['class'=>'form-control', 'disabled']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('university.name', 'Университет') !!}
                            {!! Form::text('university.name', $group->cathedra->institute->university->name, ['class'=>'form-control', 'disabled']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('institute.name', 'Институт') !!}
                            {!! Form::text('institute.name', $group->cathedra->institute->name, ['class'=>'form-control', 'disabled']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('cathedra.name', 'Кафедра') !!}
                            {!! Form::text('cathedra.name', $group->cathedra->name, ['class'=>'form-control', 'disabled']) !!}
                        </div>
                        {!! Form::submit('Сохранить', ['class'=>'btn btn-primary btn-block']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
