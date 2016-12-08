@extends('layouts.app')

@section('title', $group->name.' удаление')

@section('content')
    <div id="group-delete" class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <ol class="breadcrumb">
                            <li><a href="/">Главная</a></li>
                            <li><a href="{{ route('group.index') }}">Группы</a></li>
                            <li><a href="{{ route('group.show', [$group->id]) }}">{{ $group->name }}</a></li>
                            <li class="active">Удаление</li>
                        </ol>
                    </div>

                    <div class="panel-body">
                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger">
                                {{ $error }}
                            </div>
                        @endforeach
                        {!! Form::model($group, ['route' => ['group.destroy', $group], 'method' => 'delete']) !!}
                            <div class="form-group">
                                {!! Form::label('name', 'Название группы') !!}
                                {!! Form::text('name', null, ['class'=>'form-control', 'disabled']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('course', 'Номер курса') !!}
                                {!! Form::number('course', null, ['class'=> 'form-control', 'disabled']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('super.name', 'Родительская группа') !!}
                                {!! Form::text('super.name', $group->super ? $group->super->name : 'НЕТ', ['class'=>'form-control', 'disabled']) !!}
                            </div>
                        {!! Form::submit('Удалить', ['class'=>'btn btn-danger btn-block']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
