<!-- 项目列表-项目经理可见 -->
@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>编辑项目</h3>
                    </div>
                    <div class="panel-body">
                        {!! Form::model($project,['method'=>'PATCH','files'=>true,'url'=>route('project.update',['id'=>$project->id])]) !!}
                        <div class="form-group">
                            {!! Form::label('name','项目名称',['class'=>'form-label']) !!}
                            {!! Form::text('name',null,['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('body','项目简介',['class'=>'form-label']) !!}
                            {!! Form::textarea('body',null,['class'=>'form-control','style'=>'height:150px;']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('manager','项目经理',['class'=>'form-label']) !!}
                            {!! Form::text('manager',$project->user->name.'         -'.$project->user->duty->name,['class'=>'form-control','readonly']) !!}
                            {!! Form::hidden('user_id',null,['id'=>'user_id']) !!}
                            {!! Form::button('选择',['class'=>'btn btn-primary btn-sm ','data-toggle'=>'modal','data-target'=>'#user_list','style'=>'margin-top:20px;']) !!}
                        </div>
                        @isset($project->img)
                            <div class="form-group" id="showImg">
                                <img src="{{$project->img}}" alt="" class="img-thumbnail"
                                     style="height: 200px;width: 200px;">
                            </div>
                        @endisset
                        <div class="form-group">
                            {!! Form::label('img','项目封面',['class'=>'form-label']) !!}
                            {!! Form::file('img',['class'=>'']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::submit('确定',['class'=>'btn btn-success btn-sm btn-block']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('module.all_users')
    @push('javascript')
        <script>
            $(function (e) {
                $('#img').change(function () {
                    $('#showImg').hide()
                })
            });
        </script>
    @endpush
@endsection