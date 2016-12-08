<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Attendance
 *
 * @property integer $id
 * @property integer $student_id
 * @property integer $class_id
 * @property integer $mark
 * @property boolean $presence
 * @property string $reason
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \App\Student $student
 * @property-read \App\Clazz $clazz
 * @method static \Illuminate\Database\Query\Builder|\App\Attendance whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Attendance whereStudentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Attendance whereClassId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Attendance whereMark($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Attendance wherePresence($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Attendance whereReason($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Attendance whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Attendance whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Attendance whereDeletedAt($value)
 * @mixin \Eloquent
 */
class Attendance extends Model
{
    use SoftDeletes;

    protected $table = 'attendance';

    protected $fillable = [
        'mark',
        'presence',
        'reason'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function student() {
        return $this->belongsTo('App\Student');
    }

    public function clazz() {
        return $this->belongsTo('App\Clazz');
    }
}
