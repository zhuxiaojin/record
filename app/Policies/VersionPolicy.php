<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Version;
use Illuminate\Auth\Access\HandlesAuthorization;

class VersionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the version.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Version $version
     * @return mixed
     */
    public function view(User $user, Version $version) {
        //
        return !empty($user->id);
    }

    /**
     * Determine whether the user can create versions.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function create(User $user) {
        //
        return in_array($user->type, User::MANAGE_TYPE);
    }

    /**
     * Determine whether the user can update the version.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Version $version
     * @return mixed
     */
    public function update(User $user) {
        //
        return in_array($user->type, User::MANAGE_TYPE);
    }

    /**
     * Determine whether the user can delete the version.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Version $version
     * @return mixed
     */
    public function delete(User $user, Version $version) {
        //
        $records = $version->records;
        return in_array($user->type, User::MANAGE_TYPE) && empty($records);
    }
}
