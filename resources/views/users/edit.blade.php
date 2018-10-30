@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">编辑</div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('user.update',['id'=>Auth::id()]) }}">
                            <input type="hidden" name="_method" value="patch">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">姓名</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name"
                                           value="{{ $user->name }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">邮箱</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email"
                                           value="{{$user->email}}" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="duty" class="col-md-4 control-label">职务</label>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="checkbox checkbox">
                                                <input type="radio" name="duty_id" id="radio1" value="1"
                                                       @if($user->duty_id==1) checked @endif >
                                                <label for="radio1">
                                                    PHP
                                                </label>
                                            </div>
                                            <div class="checkbox checkbox-success">
                                                <input type="radio" name="duty_id" id="radio2" value="2"
                                                       @if($user->duty_id==2) checked @endif>
                                                <label for="radio2">
                                                    Android
                                                </label>
                                            </div>
                                            <div class="checkbox checkbox-danger">
                                                <input type="radio" name="duty_id" id="radio3" value="3"
                                                       @if($user->duty_id==3) checked @endif>
                                                <label for="radio3">
                                                    IOS
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkbox checkbox-info">
                                                <input type="radio" name="duty_id" id="radio4" value="4"
                                                       @if($user->duty_id==4) checked @endif>
                                                <label for="radio4">
                                                    Java
                                                </label>
                                            </div>
                                            <div class="checkbox checkbox-warning">
                                                <input type="radio" name="duty_id" id="radio5" value="5"
                                                       @if($user->duty_id==5) checked @endif>
                                                <label for="radio5">
                                                    测试
                                                </label>
                                            </div>
                                            <div class="checkbox checkbox-primary">
                                                <input type="radio" name="duty_id" id="radio6" value="6"
                                                       @if($user->duty_id==6) checked @endif>
                                                <label for="radio6">
                                                    前端
                                                </label>
                                            </div>
                                        </div>
                                        @if ($errors->has('duty_id'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('duty_id') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">密码</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password"  >

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="col-md-4 control-label">确认密码</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation"  >
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                      确认
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('javascript')
    <script type="text/javascript">
        function changeState(el) {
            if (el.readOnly) el.checked = el.readOnly = false;
            else if (!el.checked) el.readOnly = el.indeterminate = true;
        }
    </script>
@endpush
