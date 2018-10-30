<!-- 项目列表 -->
@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-4"><h3>项目列表</h3>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <ul id="myTab" class="nav nav-tabs">
                            <li class=" @if($type=='all') active @endif">
                                <a href="{{route('project.index',['type'=>'all'])}}">
                                    全部
                                </a>
                            </li>
                            <li class=" @if($type=='mine') active @endif">
                                <a href="{{route('project.index',['type'=>'mine'])}}">
                                    我发起的
                                </a>
                            </li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                            <div class="tab-pane fade in  active" style="margin-top: 15px;">
                                <ul class="list-group">
                                    @forelse($list as $item)
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-md-4"><a
                                                            href="{{route('project.show',['id'=>$item['id']])}}">{{$loop->iteration}}
                                                        .{{$item->name}}</a></div>
                                                <div class="col-md-4 text-right">{{$item->created_at->diffForHumans()}}</div>
                                                <div class="col-md-4 text-right">
                                                    @if($type=='mine')
                                                        <a class="btn btn-primary btn-sm"
                                                           href="{{route('project.edit',['id'=>$item['id']])}}">编辑</a>
                                                    @endif
                                                    <a class="btn btn-success btn-sm"
                                                       href="{{route('project.show',['id'=>$item['id']])}}">查看</a>

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
                {{$list->links()}}
            </div>
        </div>
    </div>
@endsection
@push('javascript')
    <script>
        $(document).ready(function () {
        })
    </script>
@endpush