@extends('layouts.admin.app')

@section('title', 'Отзывы')

@section('css')
    <!-- iCheck for checkboxes and radio inputs -->
    {!! Html::style('assets/plugins/iCheck/all.css') !!}
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-list-alt"></i> {{ isset($review) ? 'Редактировать' : 'Добавить' }} отзвыв
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Панель управления</a></li>
            <li><a href="{{ url('admin/reviews') }}"><i class="fa fa-list-alt"></i> Отзвывы</a></li>
            <li class="active"><i
                        class="fa {{ isset($review) ? 'fa-pencil' : 'fa-plus' }}"></i> {{ isset($review) ? 'Редактировать' : 'Добавить' }}
                отзыв
            </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Форма данных отзыва</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body">
                <p>* - обязательные поля</p>
                {!! Form::open(['url' => isset($review) ? URL::to('admin/reviews/' . $review->id )  :  URL::to('admin/reviews') , 'method' => isset($review) ? 'put': 'post', 'class' => 'form-horizontal', 'id'=>'validate']) !!}
                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('message', 'Комментарий *', ['class' => 'control-label col-md-2']) !!}
                        <div class="col-md-4">
                            {!! Form::textarea('message', old('message', isset($review) ? $review->message : null), ['class' => 'form-control validate[required]', 'placeholder'=>'Комментарий']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('status', 'Опубликован', ['class' => 'control-label col-md-2']) !!}
                        <div class="col-md-4">
                            <label class="check">{!! Form::checkbox('published',1,  old('status' , (isset($review) && ($review->getOriginal('published') == 1) ) ? true : false ) ,['class'=>'minimal']) !!}
                                Да</label>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-2">
                            {!! Form::submit( (isset($review) ? 'Обновить': 'Добавить') . '', ['class'=>'btn btn-primary']) !!}
                        </div>
                    </div>
                </div><!-- .col-md-12 -->
                {!! Form::close() !!}
            </div><!-- /.box-body -->
            <div class="box-footer">
            </div><!-- /.box-footer-->
        </div><!-- /.box -->
    </section><!-- /.content -->
@endsection


@section('js')

    <!-- iCheck 1.0.1 -->
    {!! Html::script('assets/plugins/iCheck/icheck.min.js') !!}

    {!! Html::script('assets/plugins/validationengine/languages/jquery.validationEngine-ru.js') !!}

    {!! Html::script('assets/plugins/validationengine/jquery.validationEngine.js') !!}

    <script type="text/javascript">
        $(document).ready(function () {

            $('input[type="checkbox"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue'
            });

            //Initialize Select2 Elements
            $(".select2").select2();

            // Validation Engine init
            var prefix = 's2id_';
            $("form[id^='validate']").validationEngine('attach',
                {
                    promptPosition: "bottomRight", scroll: false,
                    prettySelect: true,
                    usePrefix: prefix
                });
        });
    </script>
@endsection		