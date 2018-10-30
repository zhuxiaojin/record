<?php
/**
 * Created by PhpStorm.
 * User: storm 朱晓进 qhj1989@qq.com
 * Date: 2018/9/15
 * Time: 下午8:38
 */

namespace App\Http\ViewComposers;


use App\Models\User;
use Illuminate\View\View;

class UsersComposer
{
    /**
     * 将数据绑定到视图。
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view) {
        $view->with('users', User::with(['duty'])->get());
    }
}