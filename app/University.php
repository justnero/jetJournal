<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\University
 *
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $site
 * @property string $email
 * @property string $phone
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Institute[] $institutes
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Cathedra[] $cathedras
 * @method static \Illuminate\Database\Query\Builder|\App\University whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\University whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\University whereAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\University whereSite($value)
 * @method static \Illuminate\Database\Query\Builder|\App\University whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\University wherePhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\University whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\University whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\University whereDeletedAt($value)
 * @mixin \Eloquent
 */
class University extends Model
{
    use SoftDeletes;

    protected $table = 'university';

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

    public function institutes() {
        return $this->hasMany('App\Institute');
    }

    public function cathedras() {
        return $this->hasManyThrough('App\Cathedra', 'App\Institute');
    }
}
