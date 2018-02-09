<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Печать комплектации</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }
        body {
            font: 14px/1.25em Arial, Helvetica, sans-serif;
            padding: 0.5em 1em;
        }
        a {
            font-weight: bold;
        }
        p {
            padding: 0 0 1em;
        }
        table {
            border-collapse: collapse;
            margin-bottom: 2em;
        }
        table tr th {
            border: 1px solid black;
            color: #f96b0f;
            font-size: 150%;
            padding: 0.5em;
        }
        table tr td {
            padding: 1em 2em 0 0;
            vertical-align: top;
        }
    </style>
</head>
<body class="">
<table width="100%">
    <tr>
        <td style="border-bottom: none;">
            <a href="/"><img src="/images/logo.png"></a>
            <h2>{!! $car->mark !!}</h2>
            <h3>{!! $car->model !!} 1.4 6МТ (100 л.с.)</h3>
        </td>
        <td style="border-bottom: none; text-align: right; vertical-align: top;">
            <p style="padding: 0;">{!! getSetting('FRONTEND_ADDRESS') !!}</p>
            <p><small>{!! getSetting('FRONTEND_TIMES') !!}</small></p>
            <h4>{!! getSetting('TELEPHONE_1') !!}</h4>
            <h4>{!! getSetting('TELEPHONE_2') !!}</h4>
        </td>
    </tr>
</table>

<p style="text-align: center;"><a href="javascript:;" onclick="init();">Распечатать</a></p>

<table width="100%">
    <thead>
    <tr>
        <th colspan="2">Комплектация {!! $complectation['name'] !!}</th>
    </tr>
    </thead>
    <tbody>
    <tr>
    <tr>
        <td width="50%">
            <p style="border-bottom: 1px solid #C3C3C3; color: #356BB2; font-weight: bold; margin-bottom: 1em;">
                Характеристики
            </p>

            @foreach($options as $key => $value)

            <p style="font-size: 12px; padding: 0 0 0.5em 2em; position: relative;">
                <span style="color: #356BB2; position: absolute; left: 0; top: 0;">—</span>
                {!! $value !!}:
                {!! $complectation[$key] !!}
            </p>

            @endforeach



        </td>
    </tr><tr>
        <td width="50%">
            <p style="border-bottom: 1px solid #C3C3C3; color: #356BB2; font-weight: bold; margin-bottom: 1em;">
                Экстерьер
            </p>
            <p style="font-size: 12px; padding: 0 0 0.5em 2em; position: relative;">
                <span style="color: #356BB2; position: absolute; left: 0; top: 0;">—</span>
                Передние и задние брызговики</p>
            <p style="font-size: 12px; padding: 0 0 0.5em 2em; position: relative;">
                <span style="color: #356BB2; position: absolute; left: 0; top: 0;">—</span>
                Стальные диски 15&quot; с шинами 185/65 R15</p>
            <p style="font-size: 12px; padding: 0 0 0.5em 2em; position: relative;">
                <span style="color: #356BB2; position: absolute; left: 0; top: 0;">—</span>
                Наружные зеркала и ручки дверей в цвет кузова</p>
        </td>
        <td width="50%">
            <p style="border-bottom: 1px solid #C3C3C3; color: #356BB2; font-weight: bold; margin-bottom: 1em;">
                Интерьер
            </p>
            <p style="font-size: 12px; padding: 0 0 0.5em 2em; position: relative;">
                <span style="color: #356BB2; position: absolute; left: 0; top: 0;">—</span>
                Электростеклоподъемники передние с подсветкой кнопок</p>
            <p style="font-size: 12px; padding: 0 0 0.5em 2em; position: relative;">
                <span style="color: #356BB2; position: absolute; left: 0; top: 0;">—</span>
                Датчик наружной температуры</p>
            <p style="font-size: 12px; padding: 0 0 0.5em 2em; position: relative;">
                <span style="color: #356BB2; position: absolute; left: 0; top: 0;">—</span>
                Складываемый задний ряд сидений 60:40</p>
            <p style="font-size: 12px; padding: 0 0 0.5em 2em; position: relative;">
                <span style="color: #356BB2; position: absolute; left: 0; top: 0;">—</span>
                Воздуховоды к ногам задних пассажиров</p>
            <p style="font-size: 12px; padding: 0 0 0.5em 2em; position: relative;">
                <span style="color: #356BB2; position: absolute; left: 0; top: 0;">—</span>
                Макияжные зеркальца в солнцезащитных козырьках с крышками</p>
            <p style="font-size: 12px; padding: 0 0 0.5em 2em; position: relative;">
                <span style="color: #356BB2; position: absolute; left: 0; top: 0;">—</span>
                Карманы в задних дверях</p>
            <p style="font-size: 12px; padding: 0 0 0.5em 2em; position: relative;">
                <span style="color: #356BB2; position: absolute; left: 0; top: 0;">—</span>
                Аудиоподготовка 4 динамика, антенна</p>
            <p style="font-size: 12px; padding: 0 0 0.5em 2em; position: relative;">
                <span style="color: #356BB2; position: absolute; left: 0; top: 0;">—</span>
                Внутренняя обшивка крышки багажника</p>
            <p style="font-size: 12px; padding: 0 0 0.5em 2em; position: relative;">
                <span style="color: #356BB2; position: absolute; left: 0; top: 0;">—</span>
                Воздушный фильтр салона</p>
            <p style="font-size: 12px; padding: 0 0 0.5em 2em; position: relative;">
                <span style="color: #356BB2; position: absolute; left: 0; top: 0;">—</span>
                Две розетки 12В на центральной консоли</p>
        </td>
    </tr><tr>
        <td width="50%">
            <p style="border-bottom: 1px solid #C3C3C3; color: #356BB2; font-weight: bold; margin-bottom: 1em;">
                Комфорт
            </p>
            <p style="font-size: 12px; padding: 0 0 0.5em 2em; position: relative;">
                <span style="color: #356BB2; position: absolute; left: 0; top: 0;">—</span>
                Тройное мигание поворотников при неполном нажатии рычага</p>
            <p style="font-size: 12px; padding: 0 0 0.5em 2em; position: relative;">
                <span style="color: #356BB2; position: absolute; left: 0; top: 0;">—</span>
                Регулировка сиденья водителя по высоте</p>
            <p style="font-size: 12px; padding: 0 0 0.5em 2em; position: relative;">
                <span style="color: #356BB2; position: absolute; left: 0; top: 0;">—</span>
                Карман в спинке кресла переднего пассажира</p>
            <p style="font-size: 12px; padding: 0 0 0.5em 2em; position: relative;">
                <span style="color: #356BB2; position: absolute; left: 0; top: 0;">—</span>
                Полноразмерное запасное колесо </p>
            <p style="font-size: 12px; padding: 0 0 0.5em 2em; position: relative;">
                <span style="color: #356BB2; position: absolute; left: 0; top: 0;">—</span>
                Увеличенный до 160мм дорожный просвет</p>
        </td>
    </tr>
    <tr>
    </tr>
    </tbody>
</table>

<p style="text-align: center;"><a href="javascript:;" onclick="init();">Распечатать</a></p>

<p style="text-align: center;"><a href="javascript:;" onclick="window.close();">Закрыть окно</a></p>

<script type="text/javascript">
    var nIE4Win;
    var nCanPrint;
    var printed;

    function init()
    {
        printed = "no";
        if (window.print)
        {
            nCanPrint = "yes";
        }
        else
        {
            nCanPrint = "no";
        }

        var agt = navigator.userAgent.toLowerCase()

        nVersion = parseInt(navigator.appVersion);
        nIE  = (agt.indexOf("msie") != -1);
        nWin   = ( (agt.indexOf("win")!=-1) || (agt.indexOf("16bit")!=-1) );
        nMac = (agt.indexOf("mac") != -1);
        nIE4Win  = (nIE && (nVersion == 4) && nWin);

        doPrint();
    }

    function doPrint()
    {
        if (nCanPrint == "yes")
        {
            printed = "yes";
            window.print();

        }
        else if (nIE4Win)
        {
            printed = "yes";
            IEPrint();
        }
        else if (nWin)
        {
            alert("Нажмите на печать!");
        }
    }
</script>
</body>
</html>