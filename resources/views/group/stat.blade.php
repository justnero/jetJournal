@extends('layouts.app')

@section('title', $group->name.' пропуски')

@section('content')
    <div id="group-stat" class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <ol class="breadcrumb">
                            <li><a href="/">Главная</a></li>
                            <li><a href="{{ route('group.index') }}">Группы</a></li>
                            <li><a href="{{ route('group.show', [$group->id]) }}">{{ $group->name }}</a></li>
                            <li class="active">Статистика пропусков</li>
                        </ol>
                    </div>
                    <table class="panel-body table table-bordered table-responsive table-striped table-hover">
                        <thead>
                        <tr>
                            <th rowspan="2">Топ</th>
                            <th rowspan="2" colspan="2">Студент</th>
                            @if (count($weeks))
                                <th colspan="{{ count($weeks) }}">Недели</th>
                            @endif
                            <th rowspan="2">Всего</th>
                        </tr>
                        <tr>
                            @foreach($weeks as $week)
                                <th title="{{ $week['start']->format('d.m.Y') }} – {{ $week['end']->format('d.m.Y') }}">{{ $loop->iteration }}</th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($students as $student)
                            <tr class="{{ $stats[$student->id]['pos'] <= 5 ? 'top' : '' }}">
                                <td rowspan="2">{{ $stats[$student->id]['pos'] }}</td>
                                <td rowspan="2"><a href="{{ route('student.show', $student) }}" target="_blank"
                                                   class="">{{ $student->name }}</a></td>
                                <td>Без ув.</td>
                                @foreach($weeks as $week => $week_data)
                                    <td>{{ $stats[$student->id]['weeks'][$week]['no_reason']*2 }}</td>
                                @endforeach
                                <td>{{ $stats[$student->id]['total']['no_reason']*2 }}</td>
                            </tr>
                            <tr class="{{ $stats[$student->id]['pos'] <= 5 ? 'top' : '' }}">
                                <td>Всего</td>
                                @foreach($weeks as $week => $week_data)
                                    <td>{{ $stats[$student->id]['weeks'][$week]['total']*2 }}</td>
                                @endforeach
                                <td>{{ $stats[$student->id]['total']['total']*2 }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
