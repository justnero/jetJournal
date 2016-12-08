<div class="form-group student {{ (!is_string($el) ? $el->presence : true) ? 'present' : '' }}">
    <div class="input-group">
        <div class="input-group-btn">
            <a href="{{ route('student.show', $stud_id) }}" target="_blank"
               class="btn btn-default btn-block link">{{ str_pad($loop->iteration, ceil(log10($loop->count)), '0', STR_PAD_LEFT) }}
                . {{ !is_string($el) ? $el->student->name : $el }} <i
                        class="fa fa-external-link-square pull-right"></i></a>
        </div>
        <span class="input-group-addon">
            {!! Form::checkbox('student['.$stud_id.'][presence]', 'true', !is_string($el) ? $el->presence : true, ['class'=>'presence','autocomplete'=>'off','tabindex'=>$loop->iteration, !$canEdit ? 'disabled' : '']) !!}
        </span>
        {!! Form::select('student['.$stud_id.'][reason]', $reasons, !is_string($el) ? $el->reason : null, ['class'=>'form-control reason', 'placeholder'=> 'Причина','tabindex'=>$loop->count+$loop->iteration*2-1, !$canEdit ? 'disabled' : '']) !!}
        {!! Form::text('student['.$stud_id.'][mark]', !is_string($el) ? $el->mark : null, ['class'=>'form-control mark', 'placeholder'=> 'Оценка','tabindex'=>$loop->count+$loop->iteration*2, !$canEdit ? 'disabled' : '']) !!}
    </div>
</div>