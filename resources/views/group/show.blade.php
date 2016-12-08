@extends('layouts.app')

@section('title', $group->name)

@section('content')
    <div id="group-show" class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <ol class="breadcrumb">
                            <li><a href="/">Главная</a></li>
                            <li><a href="{{ route('group.index') }}">Группы</a></li>
                            <li class="active">{{ $group->name }}</li>
                        </ol>
                        @if($canEdit)
                            <div class="panel-controls btn-group pull-right">
                                <a href="{{ route('group.stat', $group->id) }}" class="btn btn-info"
                                   title="Статистика посещений"><i class="fa fa-bar-chart"></i></a>
                                <a href="{{ route('group.list', $group->id) }}" class="btn btn-success"
                                   title="Изменить список"><i class="fa fa-list"></i></a>
                                <a href="{{ route('group.edit', $group->id) }}" class="btn btn-warning"
                                   title="Редактировать"><i class="fa fa-edit"></i></a>
                                <a href="{{ route('group.delete', $group->id) }}" class="btn btn-danger"
                                   title="Удалить"><i class="fa fa-trash"></i></a>
                            </div>
                        @endif
                    </div>

                    <div id="panel-member" class="panel-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            {{ $group->cathedra->institute->university->name }}
                                        </li>
                                        <li class="list-group-item">
                                            {{ $group->cathedra->institute->name }}
                                        </li>
                                        <li class="list-group-item">
                                            {{ $group->cathedra->name }}
                                        </li>
                                    </ul>

                                    <table class="table table-bordered table-responsive table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>ФИО</th>
                                            @if($canEdit)
                                                <th>E-mail</th>
                                                <th>Телефон</th>
                                            @endif
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php $i = 1; ?>
                                        @foreach($group->students as $std)
                                            <tr class="{{ $studentColor($std->id) }}">
                                                <td>{{ $i++  }}</td>
                                                <td>
                                                    <a href="{{ route('student.show', $std) }}"><i
                                                                class="fa fa-address-card"></i></a> {{ $std->name  }}
                                                </td>
                                                @if($canEdit)
                                                    <td>{{ $std->email }}</td>
                                                    <td>{{ $std->phone }}</td>
                                                @endif
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
