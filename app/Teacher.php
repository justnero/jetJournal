<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Teacher
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Discipline[] $disciplines
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Clazz[] $classes
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Cathedra[] $cathedras
 * @method static \Illuminate\Database\Query\Builder|\App\Teacher whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Teacher whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Teacher whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Teacher wherePhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Teacher whereAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Teacher whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Teacher whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Teacher whereDeletedAt($value)
 * @mixin \Eloquent
 */
class Teacher extends Model
{
    use SoftDeletes;

    protected $table = 'teacher';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function disciplines() {
        return $this->belongsToMany('App\Discipline');
    }

    public function classes() {
        return $this->hasMany('App\Clazz');
    }

    public function cathedras() {
        return $this->belongsToMany('App\Cathedra');
    }
}
