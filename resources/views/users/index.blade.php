<!-- 项目列表-项目经理可见 -->
@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-4"><h3>用户列表</h3>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div>
                            <a href="{{route('user.create')}}" class="btn btn-success btn-sm margin-right-10">新增用户</a>
                        </div>
                        <div class="margin-top-10">
                            <ul class="list-group">
                                @forelse($users as $user)
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-4">    {{ $loop->iteration}}. {{$user->name }}</div>
                                            <div class="col-md-4"><span
                                                        class="label label-default"> {{$user->duty->name }}
                                                </span></div>
                                            <div class="col-md-4">
                                                <div class="row">
                                                    {{--<div class="col-md-3">--}}
                                                        {{--<a href="{{route('user.edit',['id'=>$user->id])}}"--}}
                                                           {{--class="btn btn-primary btn-sm">编辑</a>--}}
                                                    {{--</div>--}}
                                                    <div class="col-md-5">
                                                        @if($user->type==3)
                                                            <a href="{{route('user.manager',['user'=>$user->id,'type'=>2])}}"
                                                               class="btn btn-info btn-sm">设置为项目经理</a>
                                                        @elseif($user->type==2)
                                                            <a href="{{route('user.manager',['id'=>$user->id,'type'=>3])}}"
                                                               class="btn btn-danger btn-sm">取消项目经理</a>
                                                            @else
                                                            <button
                                                               class="btn btn-default btn-sm">超级管理员</button>
                                                        @endif
                                                    </div>
                                                    {{--<div class="col-md-3">--}}
                                                        {{--{!! Form::open(['url'=>route('user.destroy',['id'=>$user->id]),'method'=>'delete']) !!}--}}
                                                        {{--{!! Form::submit('删除',['class'=>'btn btn-danger btn-sm']) !!}--}}
                                                        {{--{!! Form::close() !!}--}}
                                                    {{--</div>--}}
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
        </div>
        {{$users->links()}}
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