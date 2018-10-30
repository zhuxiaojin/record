<?php
/**
 * Created by PhpStorm.
 * User: storm 朱晓进 qhj1989@qq.com
 * Date: 2018/9/15
 * Time: 下午8:38
 */

namespace App\Http\ViewComposers;


use App\Models\Step;
use Illuminate\View\View;

class StepsComposer
{
    /**
     * 将数据绑定到视图。
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view) {
        $view->with('steps', Step::all());
    }
}