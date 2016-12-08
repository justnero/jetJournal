<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Group
 *
 * @property integer $id
 * @property string $name
 * @property integer $course
 * @property integer $cathedra_id
 * @property integer $steward_id
 * @property integer $super_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Clazz[] $classes
 * @property-read \App\Student $steward
 * @property-read \App\Cathedra $cathedra
 * @property-read \App\Group $super
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Group[] $sub
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Student[] $students
 * @method static \Illuminate\Database\Query\Builder|\App\Group whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Group whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Group whereCourse($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Group whereCathedraId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Group whereStewardId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Group whereSuperId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Group whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Group whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Group whereDeletedAt($value)
 * @mixin \Eloquent
 */
class Group extends Model
{
    use SoftDeletes;

    protected $table = 'group';

    protected $fillable = [
        'name',
        'course'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function classes() {
        return $this->hasMany('App\Clazz');
    }

    public function steward()
    {
        return $this->belongsTo('App\Student', 'steward_id');
    }

    public function cathedra()
    {
        return $this->belongsTo('App\Cathedra');
    }

    public function super()
    {
        return $this->belongsTo('App\Group', 'super_id');
    }

    public function sub() {
        return $this->hasMany('App\Group', 'super_id');
    }

    public function students() {
        return $this->belongsToMany('App\Student');
    }

    public static function roots() {
        return self::whereNull('super_id')->get();
    }
}
