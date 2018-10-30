<?php
/**
 * Created by PhpStorm.
 * User: storm 朱晓进 qhj1989@qq.com
 * Date: 2018/9/15
 * Time: 下午8:34
 */

namespace App\Providers;


use App\Http\ViewComposers\CalendarComposer;
use App\Http\ViewComposers\ProjectsComposer;
use App\Http\ViewComposers\StepsComposer;
use App\Http\ViewComposers\UsersComposer;
use Carbon\Laravel\ServiceProvider;
use Illuminate\Support\Facades\View;

class ComposerServiceProvider extends ServiceProvider
{
    public function boot() {
        View::composer('module.all_users', UsersComposer::class);
        View::composer('module.all_projects', ProjectsComposer::class);
        View::composer('module.all_steps', StepsComposer::class);
        View::composer('module.calendar', CalendarComposer::class);
    }

}