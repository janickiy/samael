@extends('layouts.admin.app')

@section('title', 'Импорт')

@section('css')

@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-download"></i> Импорт
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Панель  управления</a></li>
            <li class="active"><i class="fa fa-download"></i> Импорт</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Импорт</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">
                <p>* - обязательны для заполнения</p>
                {!! Form::open(['url' => URL::to('admin/carmarks/imporcarmarks' ), 'method' => 'post', 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal', 'id'=>'validate']) !!}
                <div class="col-md-12">

                    <div class="form-group">
                        {!! Form::label('file', 'Импорт марок и моделей (xml)*', ['class' => 'control-label col-md-2']) !!}
                        <div class="col-md-4">
                            {!! Form::file('file', old('file', null), ['class' => 'form-control validate[required]']) !!}
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-2">
                            {!! Form::submit('Добавить', ['class'=>'btn btn-primary']) !!}
                        </div>
                    </div>
                </div><!-- .col-md-12 -->
                {!! Form::close() !!}
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </section><!-- /.content -->
@endsection

@section('js')
<script type="text/javascript">

</script>
@endsection
