<!-- 项目列表-项目经理可见 -->
@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>记录列表 </h3>
                        <div class="small text-muted">
                            只展示自己的记录
                        </div>
                    </div>
                    <div class="panel-body">
                        <ul id="myTab" class="nav nav-tabs">
                            <li class="@if($type=='all') active @endif">
                                <a href="{{route('record.index',['type'=>'all'])}}">
                                    全部
                                </a>
                            </li>

                            <li class="@if($type=='month') active @endif">
                                <a href="{{route('record.index',['type'=>'month'])}}">
                                    本月
                                </a>
                            </li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                            <div class="tab-pane fade in active" id="all" style="margin-top: 15px;">
                                <!-- 全部记录 -->
                                @if($type=='all')
                                    <ul class="list-group">
                                        @forelse($list as $item)
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-md-4"> {{$loop->iteration}}
                                                        .{{$item->body}} </div>
                                                    <div class="col-md-3 text-right">
                                                        <span class="label label-info">{{$item->project->name}}</span>-
                                                        <span class="label label-success">{{$item->version->name}}</span>
                                                    </div>
                                                    <div class="col-md-3 text-right">
                                                        {{$item->created_at->toDateString()}}
                                                    </div>

                                                    <div class="col-md-2 text-right">
                                                        {!! Form::open(['method'=>'delete','url'=>route('record.destroy',['id'=>$item->id])]) !!}
                                                        <a href="{{route('record.edit',['id'=>$item->id])}} "
                                                           class="btn btn-primary btn-sm">编辑</a>
                                                        {!! Form::submit('删除',['class'=>'btn btn-danger btn-sm']) !!}
                                                        {!! Form::close() !!}
                                                    </div>
                                                </div>
                                            </li>
                                        @empty
                                            <li class="list-group-item">暂无数据</li>
                                        @endforelse
                                    </ul>
                                @endif
                            <!-- 日历记录 -->
                                @if($type=='month')
                                    <ul class="list-group">
                                        @forelse($list as $item)
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-md-4"> {{$loop->iteration}}
                                                        .{{$item->body}} </div>
                                                    <div class="col-md-3 text-right">
                                                        <span class="label label-info">{{$item->project->name}}</span>-
                                                        <span class="label label-success">{{$item->version->name}}</span>
                                                    </div>
                                                    <div class="col-md-3 text-right">
                                                        {{$item->created_at->toDateString()}}
                                                    </div>

                                                    <div class="col-md-2 text-right">
                                                        {!! Form::open(['method'=>'delete','url'=>route('record.destroy',['id'=>$item->id])]) !!}
                                                        <a href="{{route('record.edit',['id'=>$item->id])}} "
                                                           class="btn btn-primary btn-sm">编辑</a>
                                                        {!! Form::submit('删除',['class'=>'btn btn-danger btn-sm']) !!}
                                                        {!! Form::close() !!}
                                                    </div>
                                                </div>
                                            </li>
                                        @empty
                                            <li class="list-group-item">暂无数据</li>
                                        @endforelse
                                    </ul>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
                <div class="pagination">
                    @if($list->links())
                        {{$list->links()}}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection