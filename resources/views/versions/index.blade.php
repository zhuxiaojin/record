<!-- 项目列表-项目经理可见 -->
@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>版本列表</h3>
                        <div class="small text-muted" style="">
                            只展示加入的版本列表
                        </div>
                    </div>
                    <div class="panel-body">
                        <ul id="myTab" class="nav nav-tabs">
                            <li class="@if($type=='all') active @endif">
                                <a href="{{route('version.index',['type'=>'all'])}}">
                                    全部
                                </a>
                            </li>
                            <li class=" @if($type=='current') active @endif">
                                <a href="{{route('version.index',['type'=>'current'])}}">
                                    进行中
                                </a>
                            </li>

                            <li class="@if($type=='end') active @endif">
                                <a href="{{route('version.index',['type'=>'end'])}}">
                                    已完结
                                </a>
                            </li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                            <div class="tab-pane fade in active" id="all" style="margin-top: 15px;">
                                <ul class="list-group">
                                    @forelse($list as $item)
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-md-3"><a
                                                            href="{{route('version.show',['id'=>$item['id']])}}">{{$loop->iteration}}
                                                        .{{$item->name}}</a></div>
                                                <div class="col-md-3 text-right">
                                                    <span class="label label-info">{{$item->project->name}}</span>
                                                    @if(Auth::id()==$item->user->id)
                                                        <span class="label label-warning" title="你是版本管理员">版本管理员</span>
                                                    @endif
                                                </div>
                                                <div class="col-md-3 text-right">
                                                    <button title="结束时间" href=""
                                                            class="button button-tiny button-rounded">{{$item->end_time->toDateString()}}</button>
                                                </div>
                                                <div class="col-md-3 text-right">
                                                    <div class="row ">
                                                        <div class="col-md-3 ">
                                                            @can('update',\App\Models\Version::class)
                                                                <a class="btn btn-primary btn-sm"
                                                                   href="{{route('version.edit',['id'=>$item['id']])}}">编辑</a>
                                                            @endcan</div>
                                                        <div class="col-md-3">
                                                        <a class="btn btn-success btn-sm"
                                                           href="{{route('version.show',['id'=>$item['id']])}}">查看</a>
                                                        </div>
                                                        <div class="col-md-3">
                                                        @can('delete',$item)
                                                            {!! Form::open(['url'=>route('version.destroy',['id'=>$item['id']]),'method'=>'delete'])!!}
                                                            {!! Form::submit('关闭',['class'=>"btn btn-danger btn-sm"]) !!}
                                                            {{Form::close()}}
                                                        @endcan
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @empty
                                        <li class="list-group-item">暂无数据</li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="pagination">
                    {{$list->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection