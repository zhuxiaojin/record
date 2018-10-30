@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>总览</h3>
                    </div>
                    <div class="panel-body">
                        <div>
                            <h5>
                                创建
                            </h5>
                            <div><a href="{{route('record.create')}}" class="btn btn-primary btn-sm">创建日志</a> 
                                @can('create',\App\Models\Project::class)
                                    <a href="{{route('project.create')}}" class="btn btn-success btn-sm">创建项目</a> @endcan
                                @can('create',\App\Models\Version::class)
                                    <a href="{{route('version.create')}}" class="btn btn-info btn-sm">创建版本</a> @endcan
                            </div>
                        </div>
                        <div>
                            <h5>
                                本月概览
                            </h5>
                            @include('module.calendar')
                        </div>
                        <div class="divider"></div>
                        <div>
                            <h4>
                                我参与的
                            </h4>
                            <table class="table table-condensed">
                                <tbody>
                                <tr>
                                    <th>#ID</th>
                                    <th>项目</th>
                                    <th>版本</th>
                                    <th>状态</th>
                                    <th>操作</th>
                                </tr>
                                @forelse($my_list as $value)
                                    <tr>
                                        <td>{{$value->id}}</td>
                                        <td>{{$value->project->name}}</td>
                                        <td>{{$value->name}}</td>
                                        <td>
                                            @if($value->is_end)
                                                <span class="label label-danger">已关闭</span>
                                            @elseif($value->end_time>\Carbon\Carbon::now())
                                                <span class="label label-primary">进行中</span>
                                            @else
                                                <span class="label label-default">已结束</span>
                                            @endif
                                        </td>
                                        <td><a href=""><span class="glyphicon glyphicon-edit"></span></a></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">暂无数据</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div>
                            <h4>
                                最新
                            </h4>
                            <table class="table table-condensed">
                                <tbody>
                                <tr>
                                    <th>#ID</th>
                                    <th>项目</th>
                                    <th>版本</th>
                                    <th>状态</th>
                                    <th>操作</th>
                                </tr>
                                @forelse($versions as $value)
                                    <tr>
                                        <td>{{$value->id}}</td>
                                        <td>{{$value->project->name}}</td>
                                        <td>{{$value->name}}</td>
                                        <td>
                                            @if($value->is_end)
                                                <span class="label label-danger">已关闭</span>
                                            @elseif($value->end_time>\Carbon\Carbon::now())
                                                <span class="label label-primary">进行中</span>
                                            @else
                                                <span class="label label-default">已结束</span>
                                            @endif
                                        </td>
                                        <td><a href=""><span class="glyphicon glyphicon-edit"></span></a></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">暂无数据</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
