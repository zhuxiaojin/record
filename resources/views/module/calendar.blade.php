<div class="month">
    <ul>
        <li style="text-align:center">
            <span style="font-size:18px">{{$data['title']}}</span>
        </li>
    </ul>
    <div class="pull-right"><span class="label label-info margin-right-10">节假日</span><span
                class="label label-success margin-right-10">加班</span><span class="label label-primary margin-right-10">有记录</span><span
                class="label label-danger">无记录</span></div>
</div>

<ul class="weekdays">
    <li>周一</li>
    <li>周二</li>
    <li>周三</li>
    <li>周四</li>
    <li>周五</li>
    <li>周六</li>
    <li>周日</li>
</ul>

<ul class="days">
    @for($i=2-$data['week_day'];$i<=$data['month_days'];$i++)
        @if($i<=0)
            <li></li>
        @elseif($i>$data['today'])
            <li> {{$i}} </li>
        @else
            @php
                $time=\Carbon\Carbon::createFromDate($data['year'],$data['month'],$i);
                $is_holiday=getHoliday($time->toDateString());
                $record=Auth::user()->records()->whereBetween('current_time',[$time->startOfDay()->toDateTimeString(),$time->endOfDay()->toDateTimeString()])->sum('work_time');
            @endphp
            {{-- 工作时长超过10小时 算作加班--}}
            @if($record>=10)
                <li><a class="over-time" href="{{route('record.index')}}">{{$i}}</a></li>
                {{-- 法定节假日有工作记录 算作加班--}}
            @elseif(holidayStatus($is_holiday)==1 &&$record)
                <li><a class="over-time" href="{{route('record.index')}}">{{$i}}</a></li>
                {{-- 双休日 并且不是补班 有工作记录 算作加班--}}
            @elseif($time->isWeekend()&& holidayStatus($is_holiday)==2 && $record)
                <li><a class="over-time" href="{{route('record.create')}}">{{$i}}</a></li>
            @elseif(holidayStatus($is_holiday)==1)
                <li><a class="holiday" href="{{route('record.create',['data[current_time]'=>$time->toDateString()])}}">{{$i}}</a></li>
            @elseif($time->isWeekend())
                <li><a class="holiday" href="{{route('record.create',['data[current_time]'=>$time->toDateString()])}}">{{$i}}</a></li>
            @elseif($record)
                <li><a class="active" href="{{route('record.index')}}">{{$i}}</a></li>
            @else
                <li><a class="no-active"
                       href="{{route('record.create',['data[current_time]'=>$time->toDateString()])}}">{{$i}}</a></li>
            @endif
        @endif
    @endfor

</ul>