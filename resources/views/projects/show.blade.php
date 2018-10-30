<!-- 项目列表-项目经理可见 -->
@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>{{$project->name}}</h3><span class="label label-success ">项目</span>
                    </div>
                    <div class="panel-body">
                        <ul id="myTab" class="nav nav-tabs">
                            <li class="@if($check=='introduce') active @endif ">
                                <a href="#introduce"  id="introduce_map" data-toggle="tab">
                                    简介
                                </a>
                            </li>
                            <li class="@if($check=='versions') active @endif  ">
                                <a href="#versions"   id="versions_map" data-toggle="tab">
                                    迭代版本
                                </a>
                            </li>

                            <li class="@if($check=='data') active @endif   ">
                                <a href="#data" id="data_map" data-toggle="tab">
                                    数据统计
                                </a>
                            </li>

                        </ul>
                        <div id="myTabContent" class="tab-content">
                            <div class="tab-pane fade in @if($check=='introduce') active @endif " id="introduce" style="margin-top: 15px;">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div>
                                            @if($project->img)
                                                <img src="{{$project->img}}" class="img-thumbnail"
                                                     alt="{{$project->name}}">
                                            @else
                                                <h3>{{$project->name}}</h3>
                                            @endif


                                        </div>
                                        <div class="margin-top-10">项目经理：{{$project->user->name}}
                                            -{{$project->user->duty->name}}</div>
                                        <div class="margin-top-10">创建时间：{{$project->created_at->toDateString()}}</div>
                                    </div>
                                    <div class="col-md-8 margin-top-10">
                                        <p>{{$project->body}}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade in  @if($check=='versions') active @endif " id="versions" style="margin-top: 15px;">
                                <ul class="list-group">
                                    @forelse($project->versions as $item)
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-md-4"><a href="{{route('version.show',['id'=>$item->id])}}">{{$loop->iteration}}. {{$item->name}} </a></div>
                                                <div class="col-md-3"><span
                                                            class="label label-info">{{$item->user->name}}</span></div>
                                                <div class="col-md-2">
                                                    @if($item->is_end)
                                                        <span class="label label-danger">已关闭</span>
                                                    @elseif($item->end_time>\Carbon\Carbon::now())
                                                        <span class="label label-success">进行中</span>
                                                    @else
                                                        <span class="label label-warning">已结束</span>
                                                    @endif
                                                </div>
                                                <div class="col-md-3">   {{$item->created_at->toDateString()}} </div>
                                            </div>
                                        </li>
                                    @empty
                                        <li class="list-group-item">暂无版本</li>
                                    @endforelse
                                </ul>
                            </div>

                            <div class="tab-pane fade in   @if($check=='data') active @endif " id="data" style="margin-top: 15px;">
                                <ul class="list-group">
                                    <li class="list-group-item"><span
                                                class="glyphicon glyphicon-time margin-right-10 "></span>工时总计：{{$project->records->sum('work_time')}}
                                        <span class="label label-info">小时</span></li>
                                    <li class="list-group-item"><span
                                                class="glyphicon glyphicon-list margin-right-10 "></span>版本总计：{{$project->versions->count()}}
                                        <span class="label label-info margin-left-10">个</span></li>
                                    <li class="list-group-item"><span
                                                class="glyphicon glyphicon-user margin-right-10 "></span>参与人员总计：
                                        {{$users->groupBy('user_id')->count()}} <span
                                                class="label label-info margin-left-10">个</span></li>
                                    </li>
                                    <li class="list-group-item"><span
                                                class="glyphicon glyphicon-book margin-right-10 "></span>工作记录总计：{{$project->records->count()}}
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
    @include('module.charts')
@endsection
@push('javascript')
    <script>
        $(document).ready(function () {
            $("#map_show").hide();
            $('#data_map').click(function () {
                $("#map_show").show()
            });
            $('#introduce_map ').click(function () {
                $("#map_show").hide()
            });
            $('#versions_map ').click(function () {
                $("#map_show").hide()
            })
        })
    </script>
@endpush