<?php
/**
 * Created by PhpStorm.
 * User: storm 朱晓进 qhj1989@qq.com
 * Date: 2018/9/6
 * Time: 上午10:36
 */
/**
 * @name:getDutyMapByProjectId
 * @param $id
 * @return mixed
 * @author:Storm 朱晓进 <qhj1989@qq.com>
 */
function getDutyMapByProjectId($id) {
    $duties = \App\Models\Duty::orderBy('name', 'desc');
    $result['times'] = [];
    foreach ($duties->get() as $k => $value) {
        $count = \App\Models\Record::with(['user'])->where('project_id', $id)->get()->reject(function ($item) use ($value) {
            return $item->user->duty_id != $value->id;
        })->sum('work_time');
        $result['times'][$k]['name'] = $value->name;
        $result['times'][$k]['count'] = $count;
    }
    $result['duties'] = array_column($duties->get(['name'])->toArray(), 'name');
    return $result;
}

/**
 * @name:getStepMapById
 * @param $id
 * @param $type
 * @return mixed
 * @author:Storm 朱晓进 <qhj1989@qq.com>
 */
function getStepMapById($id, $type) {
    $steps = \App\Models\Step::orderBy('name', 'desc');
    $result['times'] = [];
    $model = ($type == 'project') ? $type : 'version';
    foreach ($steps->get() as $k => $value) {
        $count = \App\Models\Record::with(['user'])->where($model . '_id', $id)->where('step_id', $value->id)->sum('work_time');
        $result['times'][$k]['name'] = $value->name;
        $result['times'][$k]['count'] = $count;
    }
    $result['steps'] = array_column($steps->get(['name'])->toArray(), 'name');
    return $result;
}

/**
 * @name:getHoliday
 * @param $date
 * @return bool|mixed
 * @author:Storm 朱晓进 <qhj1989@qq.com>
 */
function getHoliday($date) {
    $cache = Cache::has($date);
    if ($cache) {
        return Cache::get($date);
    } else {
        $holiday = app('holiday')->holidayData($date);
        Cache::forever($date, $holiday);
        return $holiday;
    }
}

/**
 * @name:holidayStatus
 * @param $holiday
 * @return int
 * @author:Storm 朱晓进 <qhj1989@qq.com>
 */
function holidayStatus($holiday) {
    //null 说明不是节假日
    if ($holiday->holiday === null) {
        return 0;
    }
    // false 说明为补班情况
    if ($holiday->holiday->holiday === false) {
        return 2;
    }
    //true 说明为法定节假日
    if ($holiday->holiday->holiday === true) {
        return 1;
    }
}

function isDayOfWeek($date) {
    $day = \Carbon\Carbon::parse($date)->dayOfWeek;
    switch ($day) {
        case '1':
            return '周一';
            break;
        case '2':
            return '周二';
            break;
        case '3':
            return '周三';
            break;
        case '4':
            return '周四';
            break;
        case '5':
            return '周五';
            break;
        case '6':
            return '周六';
            break;
        case '0':
            return '周日';
            break;
    }
}