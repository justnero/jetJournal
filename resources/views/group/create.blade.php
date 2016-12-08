@extends('layouts.app')

@section('title', 'Добавление группы')

@section('content')
    <div id="group-create" class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <ol class="breadcrumb">
                            <li><a href="/">Главная</a></li>
                            <li><a href="{{ route('group.index') }}">Группы</a></li>
                            <li class="active">Добавление</li>
                        </ol>
                    </div>

                    <div class="panel-body">
                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger">
                                {{ $error }}
                            </div>
                        @endforeach
                        {!! Form::model($group, ['route' =>['group.store'], 'method' => 'post']) !!}
                        <div class="form-group">
                            {!! Form::label('name', 'Название группы') !!}
                            {!! Form::text('name', null, ['class'=>'form-control', 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('course', 'Номер курса') !!}
                            {!! Form::number('course', null, ['class'=> 'form-control', 'required', 'min'=>1, 'max'=>9, 'step'=>1]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('super_id', 'Родительская группа') !!}
                            {!! Form::select('super_id', $supers, null, ['class'=>'form-control', 'required', 'id'=>'group-create-super']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('university_id', 'Университет') !!}
                            {!! Form::select('university_id', $universities, null, ['class'=>'form-control', 'id'=>'group-create-university']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('institute_id', 'Институт') !!}
                            {!! Form::select('institute_id', [], null, ['class'=>'form-control', 'disabled', 'id'=>'group-create-institute']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('cathedra_id', 'Кафедра') !!}
                            {!! Form::select('cathedra_id', [], null, ['class'=>'form-control', 'disabled', 'id'=>'group-create-cathedra']) !!}
                        </div>
                        {!! Form::submit('Сохранить', ['class'=>'btn btn-primary btn-block']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
