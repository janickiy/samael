<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <title>Печать комплектации</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            outline: none;
        }

        body {
            background: #ffffff;
            font-family: 'Roboto', Arial, Helvetica, sans-serif;
            font-size: 14px;
            color: #000000;
            padding: 25px;
        }

        .row:after {
            clear: both;
            display: table;
            content: "";
            line-height: 0;
        }

        a {
            font-weight: bold;
        }

        p {
            padding: 0 0 5px;
        }

        table {
            border-collapse: collapse;
            margin-bottom: 2em;
        }

        .double td:first-child {
            width: 49%;
        }

        table tr td {
            vertical-align: top;
        }

        ul.line {
            padding-left: 20px;
        }

        ul.line li {
            margin-bottom: 10px;
            position: relative;
            list-style-type: none;
            font-size: 12px;
            padding-right: 25px;
        }

        ul.line li:before {
            content: '';
            position: absolute;
            left: -20px;
            width: 10px;
            height: 1px;
            background: #25aae1;
            top: 10px;
        }
    </style>
</head>
<body class="">
<table width="100%">
    <tr>
        <td style="border-bottom: none;">
            <a href="/" style="margin-bottom:10px;"><img src="/images/logo.png"></a>
            <h2>{!! $car->mark !!}</h2>
            <h3>{!! $car->model !!} 1.4 6МТ (100 л.с.)</h3>
        </td>
        <td style="border-bottom: none; text-align: right; vertical-align: top;">
            <p style="padding: 0;">{!! getSetting('FRONTEND_ADDRESS') !!}</p>
            <p>
                <small>{!! getSetting('FRONTEND_TIMES') !!}</small>
            </p>
            <h4>{!! getSetting('TELEPHONE_1') !!}</h4>
            <h4>{!! getSetting('TELEPHONE_2') !!}</h4>
        </td>
    </tr>
</table>

<p style="text-align: center;"><a href="javascript:;" onclick="init();" style="color:#25aae1">Распечатать</a></p>
<div style="border: 1px solid #C3C3C3;color: #f96b0f;font-size: 20px;padding: 10px;font-weight: bold;text-align: center;margin-bottom: 15px;">
    Комплектация {!! $complectation['name'] !!}</div>
<table width="100%">
    <tbody>
    <tr>
        <td colspan="2">
            <p style="color: #25aae1; font-weight: bold; margin-bottom: 5px;">
                Характеристики
            </p>
            <ul class="line">
                @foreach($options as $key => $value)

                    <li style="width: 50%;float: left;">
                        {!! $value !!}:
                        {!! $complectation[$key] !!}
                    </li>

                @endforeach
            </ul>
        </td>
    </tr>
    <tr class="double">

        @foreach($parameter_categories as $parameter_category)

            @if(count(getParameterValues($parameter_category['id'], $complectation['id'])) > 0)

                <td>
                    <div style="padding-right:35px;">
                        <p style="color: #25aae1; font-weight: bold;margin-bottom: 5px;    margin-top: 10px;">
                            {!! $parameter_category['name'] !!}
                        </p>
                    </div>
                    <ul class="line">
                        @foreach(getParameterValues($parameter_category['id'], $complectation['id']) as $parameterValue)

                            <li>

                                {!! $parameterValue['name'] !!}

                            </li>
                        @endforeach
                    </ul>
                </td>

            @endif

        @endforeach
    </tr>


    @foreach($parameter_packs as $parameter_pack)

        <tr>
            <td colspan="2">
                <p style="color: #f96b0f; font-weight: bold; margin-bottom: 5px;    margin-top: 10px;">

                    {!! $parameter_pack['name'] !!} @if(!empty($parameter_pack['price']))
                        +{!! number_format($parameter_pack['price'], 0, '', ' ') !!} руб. @endif

                </p>

                @foreach(getPackValue($parameter_pack['id']) as $pack)

                    <p style="font-size: 12px; padding: 0 0 0.5em 2em; position: relative;">
                        <span style="color: #25aae1; position: absolute; left: 0; top: 0;">—</span>
                        {!! $pack['name'] !!}
                    </p>

                @endforeach

            </td>
        </tr>
    @endforeach


    </tbody>
</table>

<p style="text-align: center;"><a href="javascript:;" onclick="init();" style="color:#25aae1">Распечатать</a></p>

<p style="text-align: center;"><a href="javascript:;" onclick="window.close();" style="color:#25aae1">Закрыть окно</a>
</p>

<script type="text/javascript">
    var nIE4Win;
    var nCanPrint;
    var printed;

    function init() {
        printed = "no";
        if (window.print) {
            nCanPrint = "yes";
        }
        else {
            nCanPrint = "no";
        }

        var agt = navigator.userAgent.toLowerCase()

        nVersion = parseInt(navigator.appVersion);
        nIE = (agt.indexOf("msie") != -1);
        nWin = ( (agt.indexOf("win") != -1) || (agt.indexOf("16bit") != -1) );
        nMac = (agt.indexOf("mac") != -1);
        nIE4Win = (nIE && (nVersion == 4) && nWin);

        doPrint();
    }

    function doPrint() {
        if (nCanPrint == "yes") {
            printed = "yes";
            window.print();

        }
        else if (nIE4Win) {
            printed = "yes";
            IEPrint();
        }
        else if (nWin) {
            alert("Нажмите на печать!");
        }
    }
</script>
</body>
</html>