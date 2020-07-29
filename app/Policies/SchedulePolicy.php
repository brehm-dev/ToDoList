<?php

namespace App\Policies;

use App\User;
use App\Schedule;
use Illuminate\Auth\Access\HandlesAuthorization;

class SchedulePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any schedules.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->isRoleUser();
    }

    /**
     * Determine whether the user can view the schedule.
     *
     * @param  \App\User  $user
     * @param  \App\Schedule  $schedule
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->isRoleAdmin();
//        dd($user);
//        dd($schedule);
//        return $schedule->getOwner();
    }

    /**
     * Determine whether the user can create schedules.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isRoleUser();
    }

    /**
     * Determine whether the user can update the schedule.
     *
     * @param  \App\User  $user
     * @param  \App\Schedule  $schedule
     * @return mixed
     */
    public function update(User $user, Schedule $schedule)
    {
        return $user->isRoleUser();
    }

    /**
     * Determine whether the user can delete the schedule.
     *
     * @param  \App\User  $user
     * @param  \App\Schedule  $schedule
     * @return mixed
     */
    public function delete(User $user, Schedule $schedule)
    {
        return $user->isRoleUser();
    }

    /**
     * Determine whether the user can restore the schedule.
     *
     * @param  \App\User  $user
     * @param  \App\Schedule  $schedule
     * @return mixed
     */
    public function restore(User $user, Schedule $schedule)
    {
        return $user->isRoleUser();
    }

    /**
     * Determine whether the user can permanently delete the schedule.
     *
     * @param  \App\User  $user
     * @param  \App\Schedule  $schedule
     * @return mixed
     */
    public function forceDelete(User $user, Schedule $schedule)
    {
        //
    }
}
