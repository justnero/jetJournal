@extends('layouts.app')

@section('title', 'Группы')

@section('content')
    <div id="group-index" class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <ol class="breadcrumb">
                            <li><a href="/">Главная</a></li>
                            <li class="active">Группы</li>
                        </ol>
                        <div class="panel-controls btn-group pull-right">
                            <a href="{{ route('group.create')  }}" class="btn btn-primary"
                               title="Создать"><i class="fa fa-plus"></i></a>
                        </div>
                    </div>

                    <table class="table table-bordered table-responsive table-striped table-hover panel-body">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Название</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($groups as $group)
                            <tr>
                                <td>{{ $group->id  }}</td>
                                <td>
                                    <a href="{{ route('group.show', $group->id)  }}">{{ $group->name  }}</a>
                                    @if($group->steward_id == $student->id)
                                        <div class="steward-controls btn-group pull-right">
                                            <a href="{{ route('group.stat', $group->id) }}"
                                               class="btn btn-info" title="Статистика посещений">
                                                <i class="fa fa-bar-chart"></i></a>
                                            <a href="{{ route('group.list', $group->id) }}"
                                               class="btn btn-success" title="Изменить список">
                                                <i class="fa fa-list"></i></a>
                                            <a href="{{ route('group.edit', $group->id) }}"
                                               class="btn btn-warning" title="Редактировать">
                                                <i class="fa fa-edit"></i></a>
                                            <a href="{{ route('group.delete', $group->id) }}"
                                               class="btn btn-danger" title="Удалить">
                                                <i class="fa fa-trash"></i></a>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
