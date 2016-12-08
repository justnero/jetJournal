<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Student
 *
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $email
 * @property string $phone
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Group[] $groups
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Attendance[] $attendances
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Certificate[] $certificates
 * @property-read \App\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Clazz[] $classes
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Group[] $stewarded
 * @method static \Illuminate\Database\Query\Builder|\App\Student whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Student whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Student whereAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Student whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Student wherePhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Student whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Student whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Student whereDeletedAt($value)
 * @mixin \Eloquent
 */
class Student extends Model
{
    use SoftDeletes;

    protected $table = 'student';

    protected $fillable = [
        'name',
        'address',
        'email',
        'phone'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function groups() {
        return $this->belongsToMany('App\Group');
    }

    public function attendances() {
        return $this->hasMany('App\Attendance');
    }

    public function certificates() {
        return $this->hasMany('App\Certificate');
    }

    public function user() {
        return $this->hasOne('App\User');
    }

    public function stewarded() {
        return $this->hasMany('App\Group', 'steward_id');
    }
}
