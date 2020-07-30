<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, string $string1)
 * @method static create(string[] $array)
 */
class Schedule extends Model
{
    const TYPE_PRIVATE = 'private';
    const TYPE_GLOBAL = 'global';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'type', 'owner_id'
    ];


    /**
     * @return mixed
     */
    public function getOwner()
    {
        return $this->belongsTo('App\User', 'owner_id')->getResults();
    }

    /**
     * @return mixed
     */
    public function getProcedures()
    {
        return $this->hasMany('App\Procedure')->getResults();
    }

    /**
     * @return mixed
     */
    public static function getGlobalSchedules()
    {
        $schedules = self::select('*')
            ->where('type', self::TYPE_GLOBAL)
            ->whereNotIn('owner_id', [auth()->user()->id])
            ->get();
        if ($schedules->isEmpty()) return false;
        foreach ($schedules as $schedule) {
            $schedule->owner = User::find($schedule->owner_id);
            $schedule->todos = Procedure::where(['schedule_id' => $schedule->id])->count();
        }
        return $schedules;
    }

    /**
     * @return mixed
     */
    public static function getOwnGlobalSchedules()
    {
        $schedules = self::where([
            'owner_id' => auth()->user()->getAuthIdentifier(),
            'type' => self::TYPE_GLOBAL
        ])->get();
        if ($schedules->isEmpty()) return false;
        foreach ($schedules as $schedule) {
            $schedule->owner = User::find($schedule->owner_id);
            $schedule->todos = Procedure::where(['schedule_id' => $schedule->id])->count();
        }
        return $schedules;
    }

    /**
     * @return mixed
     */
    public static function getPrivateSchedules()
    {
        $schedules = self::where([
            'owner_id' => auth()->user()->getAuthIdentifier(),
            'type' => self::TYPE_PRIVATE
        ])->get();
        if ($schedules->isEmpty()) return false;
        foreach ($schedules as $schedule) {
            $schedule->owner = User::find($schedule->owner_id);
            $schedule->todos = Procedure::where(['schedule_id' => $schedule->id])->count();
        }
        return $schedules;
    }

}
