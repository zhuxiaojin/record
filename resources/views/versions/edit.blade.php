@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>编辑版本</h3>
                    </div>
                    <div class="panel-body">
                        {!! Form::model($version,['method'=>'PATCH','url' => route('version.update',['id'=>$version->id])]) !!}
                        <div class="form-group">
                            {!! Form::label('project','归属项目',['class'=>'form-label']) !!}
                            {!! Form::text('project',$version->project->name,['class'=>'form-control ','readonly','placeholder'=>'请选择项目']) !!}
                            {!! Form::hidden('project_id',null,['id'=>'project_id']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::button('选择',['class'=>'btn btn-primary btn-sm ','data-toggle'=>'modal','data-target'=>'#project_list']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('end_time','上线时间',['class'=>'form-label']) !!}
                            {!! Form::date('end_time',$version->end_time->toDateString(),['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('name','版本名称',['class'=>'form-label']) !!}
                            {!! Form::text('name',null,['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('body','简介',['class'=>'form-label']) !!}
                            {!! Form::textarea('body',null,['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('manager','版本管理员',['class'=>'form-label']) !!}
                            {!! Form::text('manager',$version->user->name.'     -'.$version->user->duty->name,['class'=>'form-control','readonly']) !!}
                            {!! Form::hidden('user_id',null,['id'=>'user_id']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::button('选择',['class'=>'btn btn-primary btn-sm ','data-toggle'=>'modal','data-target'=>'#user_list']) !!}
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
    @include('module.all_projects')
@endsection