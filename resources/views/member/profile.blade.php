@extends('layouts.frontend.app')

@section('title', 'Профиль')

@section('css')
    <style type="text/css">
        .margin-bottom {
            margin-bottom: 5px;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h2 class="page-head-line">Профиль</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-3">
                <div class="margin-bottom"><a class="btn btn-primary" href="{{ url('member/profile/edit') }}"
                                              title="Редактировать" style="width: 100%;"><i
                                class="fa fa-2 fa-pencil"></i> Редактировать профиль</a></div>
                <img src="{{ asset($user->avatar) }}" class="img-responsive img-circle margin-bottom"
                     alt="{{ $user->name }}">
            </div>
            <div class="col-md-9">
                <div class="table-responsive no-padding">
                    <table class="table">
                        <tbody>
                          <tr>
                            <td style="width: 30%;">
                                <span>Имя:</span>
                            </td>
                            <td><b class="text-info">{{ $user->name }}</b></td>
                        </tr>
                        <tr>
                            <td>
                                <span>Email:</span>
                            </td>
                            <td><b class="text-info">{{ $user->email }}</b></td>
                        </tr>
                        <tr>
                            <td>
                                <span>Должность:</span>
                            </td>
                            <td>
                                <b class="text-info">{{ isset($user->job_title) && !empty($user->job_title) ? $user->job_title : '-' }}</b>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Телефон:</span>
                            </td>
                            <td>
                                <b class="text-info">{{ isset($user->mobile) && !empty($user->mobile) ? $user->mobile : '-' }}</b>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">

    </script>
@endsection
