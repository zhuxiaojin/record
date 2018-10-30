<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Record;
use Illuminate\Auth\Access\HandlesAuthorization;

class RecordPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the record.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Record $record
     * @return mixed
     */
    public function view(User $user, Record $record) {
        //
        return !empty($user->id);
    }

    /**
     * Determine whether the user can create records.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function create(User $user) {
        //
        return !empty($user->id);
    }

    /**
     * Determine whether the user can update the record.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Record $record
     * @return mixed
     */
    public function update(User $user, Record $record) {
        //
        return $user->id === $record->user_id;
    }

    /**
     * Determine whether the user can delete the record.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Record $record
     * @return mixed
     */
    public function delete(User $user, Record $record) {
        //
        return in_array($user->type, User::MANAGE_TYPE) && $record->user_id == $user->id;
    }
}
