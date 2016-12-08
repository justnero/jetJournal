<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Cathedra
 *
 * @property integer $id
 * @property string $name
 * @property integer $institute_id
 * @property string $site
 * @property string $email
 * @property string $phone
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \App\Institute $institute
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Group[] $groups
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Teacher[] $teachers
 * @method static \Illuminate\Database\Query\Builder|\App\Cathedra whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Cathedra whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Cathedra whereInstituteId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Cathedra whereSite($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Cathedra whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Cathedra wherePhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Cathedra whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Cathedra whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Cathedra whereDeletedAt($value)
 * @mixin \Eloquent
 */
class Cathedra extends Model
{
    use SoftDeletes;

    protected $table = 'cathedra';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'site'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function institute() {
        return $this->belongsTo('App\Institute');
    }

    public function groups() {
        return $this->hasMany('App\Group');
    }

    public function teachers() {
        return $this->belongsToMany('App\Teacher');
    }
}
