<?php

namespace App\Providers;

use App\Models\Project;
use App\Models\Record;
use App\Models\User;
use App\Models\Version;
use App\Policies\ProjectPolicy;
use App\Policies\RecordPolicy;
use App\Policies\UserPolicy;
use App\Policies\VersionPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        // 版本权限控制
        Version::class => VersionPolicy::class,
        // 项目控制
        Project::class => ProjectPolicy::class,
        // 日志控制
        Record::class => RecordPolicy::class,
        // 用户管理
        User::class => UserPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot() {
        $this->registerPolicies();

        //
    }
}
