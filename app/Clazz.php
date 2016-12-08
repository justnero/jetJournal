<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Clazz
 *
 * @property integer $id
 * @property integer $discipline_id
 * @property integer $teacher_id
 * @property integer $group_id
 * @property string $location
 * @property \Carbon\Carbon $date
 * @property \Carbon\Carbon $duration
 * @property string $type
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \App\Teacher $teacher
 * @property-read \App\Group $group
 * @property-read \App\Discipline $discipline
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Attendance[] $attendances
 * @method static \Illuminate\Database\Query\Builder|\App\Clazz whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Clazz whereDisciplineId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Clazz whereTeacherId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Clazz whereGroupId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Clazz whereLocation($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Clazz whereDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Clazz whereDuration($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Clazz whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Clazz whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Clazz whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Clazz whereDeletedAt($value)
 * @mixin \Eloquent
 */
class Clazz extends Model
{
    use SoftDeletes;

    protected $table = 'class';

    protected $fillable = [
        'date',
        'duration',
        'location',
        'type',
    ];

    protected $dates = [
        'date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function scopeOrdered($query) {
        return $query->orderBy('date', 'asc');
    }

    /**
     * Get the duration attribute.
     *
     * @param  string  $value
     * @return Carbon
     */
    public function getDurationAttribute($value)
    {
        $dur = Carbon::parse($value);
        /* @var Carbon $dt */
        $dt = $this->date->copy();
        return $dt->addHours($dur->hour)->addMinute($dur->minute)->addSecond($dur->second);
    }

    /**
     * Set the date attribute.
     *
     * @param  string|Carbon  $value
     * @return void
     */
    public function setDateAttribute($value)
    {
        if($value instanceof Carbon) {
            $this->attributes['date'] = $value;
        } else {
            $this->attributes['date'] = Carbon::createFromFormat('Y-m-d\TH:i', $value)->format('Y-m-d H:i:s');
        }
    }

    /**
     * Set the duration attribute.
     *
     * @param  string  $value
     * @return void
     */
    public function setDurationAttribute($value)
    {
        if($value instanceof Carbon) {
            $this->attributes['duration'] = $value;
        } else {
            $this->attributes['duration'] = Carbon::parse($value)->format('H:i:s');
        }
    }

    /**
     * Get the type.
     *
     * @param  string  $value
     * @return string
     */
    public function getTypeAttribute($value)
    {
        switch ($value) {
            case 'lection':
                return 'Лекция';
            case 'laboratory':
                return 'Лабораторная работа';
            case 'practice':
                return 'Практическое занятие';
            case 'seminar':
                return 'Семинар';
            case 'course':
                return 'Курсовая работа';
            default:
                return 'Неизвестный тип занятия';
        }
    }

    public function teacher() {
        return $this->belongsTo('App\Teacher');
    }

    public function group() {
        return $this->belongsTo('App\Group');
    }

    public function discipline() {
        return $this->belongsTo('App\Discipline');
    }

    public function attendances() {
        return $this->hasMany('App\Attendance', 'class_id');
    }

    public function students() {
        return $this->group->students();
    }
}
