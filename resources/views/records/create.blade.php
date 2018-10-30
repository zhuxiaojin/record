<!-- 项目列表-项目经理可见 -->
@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>工时记录  </h3><span class="label label-success  ">{{$data['current_time']?:date('Y-m-d')}}-{{isDayOfWeek($data['current_time'])}}</span>
                        @isset($holiday->holiday)
                            @if($holiday->holiday->holiday===false)
                                <span class="    margin-left-10">{{$holiday->holiday->name}}-补班</span>
                            @elseif ($holiday->holiday->holiday===true)
                                <span class="   margin-left-10">法定节假日-{{$holiday->holiday->name}}</span>
                            @endif
                            @endisset

                    </div>
                    <div class="panel-body">
                        {!! Form::open(['url' => route('record.store')]) !!}
                        <div class="form-group">
                            {!! Form::label('project','选择项目',['class'=>'form-label']) !!}
                            {!! Form::text('project',old('project'),['class'=>'form-control ','readonly']) !!}
                            {!! Form::hidden('project_id',old('project_id'),['id'=>'project_id']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::button('选择',['class'=>'btn btn-primary btn-sm ','data-toggle'=>'modal','data-target'=>'#project_list']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('project','选择版本',['class'=>'form-label']) !!}
                            {!! Form::text('version',old('version'),['class'=>'form-control ','readonly']) !!}
                            {!! Form::hidden('version_id',old('version_id'),['id'=>'version_id']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::button('选择',['class'=>'btn btn-primary btn-sm ','data-toggle'=>'modal','data-target'=>'#versions_list','id'=>'version_list']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('project','选择阶段',['class'=>'form-label']) !!}
                            {!! Form::text('step',old('step'),['class'=>'form-control ', 'readonly']) !!}
                            {!! Form::hidden('step_id',old('step_id'),['id'=>'step_id']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::button('选择',['class'=>'btn btn-primary btn-sm ','data-toggle'=>'modal','data-target'=>'#step_list']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('work_time','工作时长',['class'=>'form-label']) !!}
                            {!! Form::select('work_time',[1=>'1小时',2=>'2小时',3=>'3小时',4=>'4小时',5=>'5小时',6=>'6小时',7=>'7小时',8=>'8小时',9=>'9小时',10=>'10小时',],'8',['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('current_time','发布日期',['class'=>'form-label']) !!}
                            {!! Form::date('current_time',$data['current_time']?:\Carbon\Carbon::now()->toDateString(),['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('body','工作内容',['class'=>'form-label']) !!}
                            {!! Form::textarea('body','',['class'=>'form-control','style'=>'height:100px;']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::submit('确定',['class'=>'btn btn-success btn-sm btn-block']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>web
    @push('javascript')
        <script>
            $('#project_list').change(function () {
                //处理版本信息
                $("#version_id").val();
                $("input[name='version']").text();

            });
            $('#version_list').click(function () {
                let p_id = $('#project_id').val();
                if (!p_id) {
                    alert('请选择项目');
                    return false;
                }
                let current_id = $('#version_id').val();

                $.ajax({
                    url: "{{route('project.getVersions')}}",
                    type: 'get',
                    async: false,
                    data: {
                        'id': p_id,
                        '_token': "{{csrf_token()}}"
                    },
                    success: function (result) {
                        if (result.length > 0) {
                            //循环数组信息
                            let li = '';
                            $.each(result, function (index, value) {
                                li += "<li class='list-group-item' id='" + value.id + "' onclick='versionCheck(this)'>";
                                li += " <input type='radio' name='checkVersion' value='" + value.id + "' style='margin-right: 15px;'>";
                                li += "<span>" + value.name + "</span></li>";
                            });
                            $('#versions_ul').html(li);
                            if (current_id) {
                                $("#versions_ul #" + current_id + " input[type='radio']").attr('checked', 'checked');
                            }
                        } else {
                            $('#versions_ul').html("<li class='list-group-item'>暂无版本信息</li>'")
                        }
                    }
                })
            });

            function versionCheck(obj) {
                $(obj).find("input[name='checkVersion']").prop('checked', 'checked')
            }
        </script>
    @endpush
    @include('module.all_users')
    @include('module.all_projects')
    @include('module.all_steps')
    @include('module.project_versions')

@endsection