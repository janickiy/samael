@extends('layouts.frontend.app')

@section('title', 'Сервис недоступен')

@section('css')

@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h4 class="page-head-line">Сервис недоступен</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger text-center">
                <h1>503 Error</h1>
                <p>Сервис недоступен! Пожалуйста, повторите попытку позже.</p>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">

    </script>
@endsection
