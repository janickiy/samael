@extends('layouts.frontend.app')

@section('title', 'Авторизация')

@section('css')

@endsection

@section('content')
    <div class="row auth_page">
		<div class="main_width">
			<div class="auth_form request_form">
				<div class="form_title"> Login with <strong>{{ getSetting('SITE_TITLE') }} Аккаунт :</strong></div>
				<form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
					{!! csrf_field() !!}

					<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
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
								<span class="input-group-addon"><i class="fa fa-lock"></i></span>
								<input type="password" class="form_control" name="password" placeholder="Пароль">
							</div>
							@if ($errors->has('password'))
								<span class="help-block">
											<strong>{{ $errors->first('password') }}</strong>
										</span>
							@endif
					</div>
					<div class="form-group">
						<div class="tradein_check">
							 <input type="checkbox" name="remember" id="remember" class="checkbox"><label for="remember">Запомнить меня</label>
						</div>
					</div>
					<div class="form-group row">
							<button type="submit" class="btn btn-primary">Войти</button>
							<a class="btn btn-link" href="{{ url('/password/reset') }}">Забыли пароль?</a>
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
