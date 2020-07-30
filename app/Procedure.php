<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static where(array $array)
 */
class Procedure extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'schedule_id', 'content_type', 'content', 'state', 'activated_at', 'paused_at', 'finished_at', 'creator_id'
    ];

    const CONTENT_TYPE_TODO = 'todo';
//    const CONTENT_TYPE_TASK = 'task';
    const STATE_ACTIVE = 'active';
    const STATE_PAUSE = 'pause';
    const STATE_FINISH = 'finish';
    const ACTIVATED_AT = 'activated_at';


    public function getCreator()
    {
        return $this->belongsTo(User::class, 'creator_id')->getResults();
    }

    /**
     * @return bool
     */
    public function setActive()
    {
        return $this->setState(self::STATE_ACTIVE, 'activated_at');
    }

    /**
     * @return bool
     */
    public function setPaused()
    {
        return $this->setState(self::STATE_PAUSE, 'paused_at');
    }

    /**
     * @return bool
     */
    public function setFinished()
    {
        return $this->setState(self::STATE_FINISH, 'finished_at');
    }

    /**
     * @param string $state
     * @param string $timestampAttribute
     * @return bool
     */
    private function setState(string $state, string $timestampAttribute)
    {
        return $this->update([
            'state' => $state,
            $timestampAttribute => now()
        ]);
    }
}
