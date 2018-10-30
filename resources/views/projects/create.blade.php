<!-- 项目列表-项目经理可见 -->
@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>创建项目</h3>
                    </div>
                    <div class="panel-body">
                        {!! Form::open(['url' => route('project.store'),'enctype'=>"multipart/form-data"]) !!}
                        <div class="form-group">
                            {!! Form::label('name','项目名称',['class'=>'form-label']) !!}
                            {!! Form::text('name','',['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('body','项目简介',['class'=>'form-label']) !!}
                            {!! Form::textarea('body','',['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('manager','项目经理',['class'=>'form-label']) !!}
                            {!! Form::text('manager','',['class'=>'form-control','readonly']) !!}
                            {!! Form::hidden('user_id','',['id'=>'user_id']) !!}
                            {!! Form::button('选择',['class'=>'btn btn-primary btn-sm ','data-toggle'=>'modal','data-target'=>'#user_list','style'=>'margin-top:20px;']) !!}
                        </div>
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
@endsection