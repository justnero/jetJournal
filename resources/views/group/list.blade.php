@extends('layouts.app')

@section('title', 'Список '.$group->name)

@section('content')
    <div id="group-list" class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <ol class="breadcrumb">
                            <li><a href="/">Главная</a></li>
                            <li><a href="{{ route('group.index') }}">Группы</a></li>
                            <li><a href="{{ route('group.show', [$group->id]) }}">{{ $group->name }}</a></li>
                            <li class="active">Изменение списка</li>
                        </ol>
                    </div>

                    <div class="panel-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    {!! Form::open(['route'=>['group.list',$group], 'method'=>'patch']) !!}
                                    @foreach($available as $el)
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">
                                                {!! Form::checkbox('student-'.$el->id, 'true', $isSelected($el->id), ['autocomplete'=>'off']) !!}
                                            </span>
                                            <a href="{{ route('student.show', $el) }}" target="_blank" class="btn btn-default form-control">{{ $el->name }} <i class="fa fa-external-link-square pull-right"></i></a>
                                        </div>
                                    @endforeach
                                    {!! Form::submit('Сохранить', ['class'=>'btn btn-primary btn-block']) !!}
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
