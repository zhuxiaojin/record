<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

//    public function before(User $currentUser) {
    //        if ($currentUser->type == 1) {
    //            return true;
    //    }
    //    }

    /**
     * Determine whether the user can view the project.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Project $project
     * @return mixed
     */
    public function view(User $user, Project $project)
    {
        //
        return true;
    }

    /**
     * Determine whether the user can create projects.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
        return in_array($user->type, User::MANAGE_TYPE);
    }

    /**
     * Determine whether the user can update the project.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function update(User $user)
    {
        //
        return in_array($user->type, User::MANAGE_TYPE);
    }

    /**
     * Determine whether the user can delete the project.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Project $project
     * @return mixed
     */
    public function delete(User $user, Project $project)
    {
        //
        $versions = $project->versions;
        return in_array($user->type, User::MANAGE_TYPE) && empty($versions);
    }
}
