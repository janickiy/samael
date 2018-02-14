@extends('layouts.frontend.app')

@section('title', 'Регистрация')

@section('css')

@endsection

@section('content')
    <div class="row auth_page">
		<div class="main_width">
			<div class="auth_form request_form">
           <div class="form_title"> {{ getSetting('SITE_TITLE') }} :</div>
            <br/>
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                {!! csrf_field() !!}

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <div class="input-group">
                            <input type="text" class="form_control" name="name" value="{{ old('name') }}" placeholder="Ваше имя">
                        </div>
                        @if ($errors->has('name'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                        @endif
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <div class="input-group">
                            <input type="email" class="form_control" name="email" value="{{ old('email') }}" placeholder="E-Mail">
                        </div>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <div class="input-group">
                            <input type="password" class="form_control" name="password" placeholder="Пароль" >
                        </div>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                </div>

                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <div class="input-group">
  
                            <input type="password" class="form_control" name="password_confirmation" placeholder="Подтверждение пароля" >
                        </div>
                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                             </span>
                        @endif
                </div>

                <div class="form-group row">
                        <button type="submit" class="btn btn-primary" style="width:100%;margin:10px 0 0;">
                            Зарегистрироваться
                        </button>
                 </div>
            </form>
			  </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">

    </script>
@endsection
