@extends('layouts.frontend.app')

@section('title', 'Все марки')
@section('meta_desc', '')
@section('meta_keywords','')

@section('css')

@endsection

@section('marks')

@endsection


@section('content')
    <section>
        <h1>Все марки</h1>

        <div class="main_marks row">
            <table width="100%">

                <?php $i = 0; ?>
                @foreach($marks as $mark)
                    @if($i == 0)
                        <tr> @endif
                            <td>
                                <a href="{!! url('/auto/used/' .  $mark->slug) !!}">{!! $mark->name !!}</a><span> {!! $mark->countusedcars !!} </span>
                            </td>
                            <?php $i++; ?>
                            @if($i == 6) </tr> <?php $i = 0; ?> @endif
                @endforeach

            </table>

        </div>

    </section>
@endsection

@section('js')
    <script type="text/javascript">

    </script>
@endsection