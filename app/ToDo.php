<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


/**
 * @method static create(string[] $array)
 * @method static where(string $string, $todoKey)
 */
class ToDo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'creator_user_id', 'target_user_id', 'delegated', 'title', 'description', 'schedule_id'
    ];

    protected $table = 'todos';

    public static function getForSchedule(Schedule $schedule)
    {
        return self::all()->where('schedule_id', $schedule->id);
    }

    public function creatorUser()
    {
        return $this->belongsTo('App\User', 'creator_user_id')->getResults();
    }

    public function targetUser()
    {
        return $this->belongsTo('App\User', 'target_user_id')->getResults();
    }

    public function schedule()
    {
        return $this->belongsTo('App\Schedule', 'schedule_id')->getResults();
    }
}
