<?php
/**
 * Created by PhpStorm.
 * User: storm 朱晓进 qhj1989@qq.com
 * Date: 2018/9/29
 * Time: 下午3:07
 */

namespace App\Http\ViewComposers;


use Carbon\Carbon;
use Illuminate\View\View;

class CalendarComposer
{
    /**
     * 将数据绑定到视图。
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view) {
        //获取当前时间
        $now = Carbon::now();
        $data['title'] = $now->year . '年' . $now->month . '月';
        $data['year'] = $now->year;
        $data['month'] = $now->month;
//        $data['first_day'] = $now->startOfMonth()->toDateString();
        //哪一天
        $data['today'] = $now->day;

        //周几
        $data['week_day'] = $now->startOfMonth()->dayOfWeek ?: 7;
        //本月一共多少天
        $data['month_days'] = $now->daysInMonth;

        $view->with('data', $data);
    }
}