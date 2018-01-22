@extends('layouts.frontend.app')

@section('title', '404 Страница не найдена')

@section('css')

@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h4 class="page-head-line">Страница не найдена</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger text-center">
                <h1>404 Страница не найден</h1>
                <p>Запрошенная вами страница не найдена!</p>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">

    </script>
@endsection
