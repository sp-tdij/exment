@extends('exment::install.layout') 
@section('content')
        <p class="login-box-msg">{{ trans('admin.setting') }}(2/3) : データベース設定</p>

        <form action="{{ admin_url('install') }}" method="post">
            <div class="form-group has-feedback {!! !$errors->has('connection') ?: 'has-error' !!}">

                @if($errors->has('connection')) @foreach($errors->get('connection') as $message)
                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{{$message}}</label></br>
                @endforeach @endif

                <label>データベース種類:</label>
                <select name="connection" class="form-control">
                    @foreach($connection_options as $key => $value)
                        <option value="{{$key}}" {{ $key == $connection_default ? 'selected' : '' }}>{{$value}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group has-feedback {!! !$errors->has('host') ?: 'has-error' !!}">

                @if($errors->has('host')) @foreach($errors->get('host') as $message)
                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{{$message}}</label></br>
                @endforeach @endif

                <label>ホスト名:</label>
                <input type="text" class="form-control" name="host" value="{{ array_get($database_connection, 'host') }}" required />
            </div>

            <div class="form-group has-feedback {!! !$errors->has('port') ?: 'has-error' !!}">

                @if($errors->has('port')) @foreach($errors->get('port') as $message)
                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{{$message}}</label></br>
                @endforeach @endif

                <label>ポート:</label>
                <input type="text" class="form-control" name="port" value="{{ array_get($database_connection, 'port') }}" required />
            </div>

            <div class="form-group has-feedback {!! !$errors->has('database') ?: 'has-error' !!}">
                @if($errors->has('database')) @foreach($errors->get('database') as $message)
                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{{$message}}</label></br>
                @endforeach @endif

                <label>データベース:</label>
                <input type="text" class="form-control" name="database" value="{{ array_get($database_connection, 'database') }}" required />
            </div>

            <div class="form-group has-feedback {!! !$errors->has('username') ?: 'has-error' !!}">
                @if($errors->has('username')) @foreach($errors->get('username') as $message)
                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{{$message}}</label></br>
                @endforeach @endif

                <label>ユーザー名:</label>
                <input type="text" class="form-control" name="username" value="{{ array_get($database_connection, 'username') }}" required />
            </div>

            <div class="form-group has-feedback {!! !$errors->has('password') ?: 'has-error' !!}">
                @if($errors->has('password')) @foreach($errors->get('password') as $message)
                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{{$message}}</label></br>
                @endforeach @endif

                <label>パスワード:</label>
                <input type="password" class="form-control" name="password" value="{{ array_get($database_connection, 'password') }}" required />
            </div>

            <div class="row">
                <!-- /.col -->
                <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">{{ trans('admin.submit') }}</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
        
@endsection