@extends('layouts.frontend.app')

@section('title', 'Забыли пароль')

@section('css')

@endsection

@section('content')
    <div class="row auth_page">
		<div class="main_width">
			<div class="auth_form request_form">
				<div class="form_title"> Забыли пароль, не беспокойтесь:</strong></div>
            <br/>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                {!! csrf_field() !!}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <div class="input-group">
                            <input type="email" class="form_control" name="email" value="{{ old('email') }}"  placeholder="E-Mail">
                        </div>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif

                </div>
                <div class="form-group row">
                        <button type="submit" class="btn btn-primary" style="width:100%;margin:10px 0 0;">
                            Отправить ссылку и сбрость пароль
                        </button>
                </div>
            </form>
			</div>
        </div>
    </div>
@endsection
