<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Discipline
 *
 * @property integer $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Clazz[] $classes
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Teacher[] $teachers
 * @method static \Illuminate\Database\Query\Builder|\App\Discipline whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Discipline whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Discipline whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Discipline whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Discipline whereDeletedAt($value)
 * @mixin \Eloquent
 */
class Discipline extends Model
{
    use SoftDeletes;

    protected $table = 'discipline';

    protected $fillable = [
        'name'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function classes() {
        return $this->hasMany('App\Clazz');
    }

    public function teachers() {
        return $this->belongsToMany('App\Teacher');
    }
}
