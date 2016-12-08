<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Institute
 *
 * @property integer $id
 * @property string $name
 * @property integer $university_id
 * @property string $site
 * @property string $email
 * @property string $phone
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \App\University $university
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Cathedra[] $cathedras
 * @method static \Illuminate\Database\Query\Builder|\App\Institute whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Institute whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Institute whereUniversityId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Institute whereSite($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Institute whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Institute wherePhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Institute whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Institute whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Institute whereDeletedAt($value)
 * @mixin \Eloquent
 */
class Institute extends Model
{
    use SoftDeletes;

    protected $table = 'institute';

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

    public function university() {
        return $this->belongsTo('App\University');
    }

    public function cathedras() {
        return $this->hasMany('App\Cathedra');
    }
}
