<!-- 版本项目信息- 所有人均可见 -->
@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>{{$version->name}} - {{$version->project->name}}</h3><span class="label label-primary ">版本</span>
                    </div>
                    <div class="panel-body">
                        <ul id="myTab" class="nav nav-tabs">
                            <li class="active">
                                <a href="#introduce" data-toggle="tab">
                                    简介
                                </a>
                            </li>
                            <li class=" ">
                                <a href="#users" data-toggle="tab">
                                    参与人员
                                </a>
                            </li>

                            <li class=" ">
                                <a href="#data" data-toggle="tab">
                                    数据统计
                                </a>
                            </li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                            <div class="tab-pane fade in  active" id="introduce" style="margin-top: 15px;">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="margin-top-10">版本管理员：{{$version->user->name}}
                                            -{{$version->user->duty->name}}</div>
                                        <div class="margin-top-10">创建时间：{{$version->created_at->toDateString()}}</div>
                                        <div class="margin-top-10">上线时间：{{$version->end_time->toDateString()}}</div>
                                    </div>
                                    <div class="col-md-8 margin-top-10">
                                        <p>{{$version->body}}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade in  " id="users" style="margin-top: 15px;">
                                <ul class="list-group">
                                    @forelse($users as $value)
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-md-2"> {{$value->name}}</div>
                                                <div class="col-md-3"><span
                                                            class="label label-default ">{{$value->duty->name}}</span>
                                                </div>
                                                <div class="col-md-3">
                                                    总工作时长：{{$value->records->sum('work_time')}}  小时 </div>
                                                <div class="col-md-3"></div>
                                            </div>
                                        </li>
                                    @empty
                                    @endforelse
                                </ul>
                            </div>
                            <div class="tab-pane fade in " id="data" style="margin-top: 15px;">
                                <ul class="list-group">
                                    <li class="list-group-item"><span
                                                class="glyphicon glyphicon-time margin-right-10 "></span>工时总计：{{$version->records->sum('work_time')}}
                                        <span class="label label-info">小时</span></li>
                                    <li class="list-group-item"><span
                                                class="glyphicon glyphicon-user margin-right-10 "></span>参与人员总计：{{$version->records->groupBy('user_id')->count()}}<span class="label label-info margin-left-10">个</span>
                                    </li>
                                    <li class="list-group-item"><span
                                                class="glyphicon glyphicon-book margin-right-10 "></span>工作记录总计：{{$version->records->count()}}
                                        <span class="label label-info margin-left-10">条</span></li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
                {{--{{$list->links()}}--}}
            </div>
        </div>
    </div>
@endsection