<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 */
class Procedure extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'schedule_id', 'content_type', 'content', 'state', 'activated_at', 'paused_at', 'finished_at'
    ];

    const CONTENT_TYPE_TODO = 'todo';
//    const CONTENT_TYPE_TASK = 'task';
    const STATE_ACTIVE = 'active';
    const STATE_PAUSE = 'pause';
    const STATE_FINISH = 'finish';
    const ACTIVATED_AT = 'activated_at';

    /**
     * @param Procedure $procedure
     * @return bool
     */
    public function setActive(Procedure $procedure)
    {
        return $this->setState($procedure, self::STATE_ACTIVE, 'activated_at');
    }

    /**
     * @param Procedure $procedure
     * @return bool
     */
    public function setPaused(Procedure $procedure)
    {
        return $this->setState($procedure, self::STATE_PAUSE, 'paused_at');
    }

    /**
     * @param Procedure $procedure
     * @return bool
     */
    public function setFinished(Procedure $procedure)
    {
        return $this->setState($procedure, self::STATE_FINISH, 'finished_at');
    }

    /**
     * @param Procedure $procedure
     * @param string $state
     * @param string $timestampAttribute
     * @return bool
     */
    private function setState(Procedure $procedure, string $state, string $timestampAttribute)
    {
        return $procedure->update([
            'state' => $state,
            $timestampAttribute => now()
        ]);
    }
}
