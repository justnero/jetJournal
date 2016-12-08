<div class="class container-fluid">
    <div class="row">
        <div class="col-md-2 col-sm-2 col-xs-2 time">
            {!! $class->date->format('H') !!}<span class="minutes">{!! $class->date->format('i') !!}</span>
            – {!! $class->duration->format('H') !!}<span class="minutes">{!! $class->duration->format('i') !!}</span>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-4 type">
            {{ $class->type }}
        </div>
        <div class="col-md-5 col-md-offset-1 col-sm-6 col-xs-6 teachers text-right">
            {{ $class->teacher ? $class->teacher->name : 'Преподаватель неизвестен' }}
        </div>
    </div>
    <div class="row">
        <div class="col-md-2 col-sm-2 col-xs-2 location">
            @if($class->location)
                <i class="fa fa-map-marker"></i>
                {{ $class->location }}
            @endif
        </div>
        <div class="col-md-9 col-sm-10 col-xs-10 discipline">
            {{ $class->discipline->name }}
        </div>
    </div>
</div>