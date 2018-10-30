<!-- 项目列表-项目经理可见 -->
@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>创建版本</h3>
                    </div>
                    <div class="panel-body">
                        {!! Form::open(['url' => route('version.store')]) !!}
                        <div class="form-group">
                            {!! Form::label('project','归属项目',['class'=>'form-label']) !!}
                            {!! Form::text('project',old('project'),['class'=>'form-control ','readonly','placeholder'=>'请选择项目']) !!}
                            {!! Form::hidden('project_id',old('project_id'),['id'=>'project_id']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::button('选择',['class'=>'btn btn-primary btn-sm ','data-toggle'=>'modal','data-target'=>'#project_list']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('end_time','上线时间',['class'=>'form-label']) !!}
                            {!! Form::date('end_time','',['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('name','版本名称',['class'=>'form-label']) !!}
                            {!! Form::text('name','',['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('body','简介',['class'=>'form-label']) !!}
                            {!! Form::textarea('body','',['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('manager','版本管理员',['class'=>'form-label']) !!}
                            {!! Form::text('manager','',['class'=>'form-control','readonly']) !!}
                            {!! Form::hidden('user_id','',['id'=>'user_id']) !!}
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