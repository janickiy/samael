@extends('layouts.frontend.app')

@section('title', isset($title) ? $title : '' )

@section('meta_desc', isset($meta_desc) ? $meta_desc : '')

@section('meta_keywords', isset($meta_keywords) ? $meta_keywords : '')

@section('css')

@endsection


@section('marks')

@endsection

@section('content')
    <section>
        <h1>Автомобили с пробегом</h1>

        <div class="main_marks row">
            <table width="100%">


                <?php $i=0; ?>
                @foreach($models as $model)
                    @if($i == 0) <tr> @endif
                        <td><a href="{!! url('/auto/' . $model->slug . '/used') !!}">{!! $model->name !!}</a><span> 0 </span></td>
                        <?php $i++; ?>
                        @if($i == 6) </tr> <?php $i=0; ?> @endif
                @endforeach

            </table>

        </div>
    </section>
@endsection

@section('js')
    <script type="text/javascript">

    </script>
@endsection







