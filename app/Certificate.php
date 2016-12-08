<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Certificate
 *
 * @property integer $id
 * @property integer $student_id
 * @property string $date_from
 * @property string $date_to
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \App\Student $student
 * @method static \Illuminate\Database\Query\Builder|\App\Certificate whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Certificate whereStudentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Certificate whereDateFrom($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Certificate whereDateTo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Certificate whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Certificate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Certificate whereDeletedAt($value)
 * @mixin \Eloquent
 */
class Certificate extends Model
{
    use SoftDeletes;

    protected $table = 'certificate';

    protected $fillable = [
        'date_from',
        'date_to'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function student() {
        return $this->belongsTo('App\Student');
    }
}
