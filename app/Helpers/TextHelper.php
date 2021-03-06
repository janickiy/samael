<?php

function ru2Lat($text)
{
    $cyr = [
            'А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й',
            'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф',
            'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я',
            'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й',
            'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф',
            'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я'
    ];

    $lat = [
            'A', 'B', 'V', 'G', 'D', 'E', 'IO', 'ZH', 'Z', 'I', 'I',
            'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F',
            'H', 'C', 'CH', 'SH', 'SH', '`', 'Y', '`', 'E', 'IU', 'IA',
            'a', 'b', 'v', 'g', 'd', 'e', 'io', 'zh', 'z', 'i', 'i',
            'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f',
            'h', 'c', 'ch', 'sh', 'sh', '`', 'y', '`', 'e', 'iu', 'ia'
    ];

    $text = str_replace($cyr, $lat, $text);
    $text = str_replace("_"," ",$text);

    return $text;
}

function formatMarkNames($text)
{
    $text = str_replace("_"," ",$text);
    return mb_strlen($text, 'UTF-8') > 3 ? ucfirst_utf8(mb_strtolower($text)) : $text;
}

function ucfirst_utf8($str)
{
    return mb_substr(mb_strtoupper($str, 'utf-8'), 0, 1, 'utf-8') . mb_substr($str, 1, mb_strlen($str)-1, 'utf-8');
}


function Lat2ru($string)
{
    $cyr = [
        "Щ", "Ш", "Ч","Ц", "Ю", "Я", "Ж","А","Б","В",
        "Г","Д","Е","Ё","З","И","Й","К","Л","М","Н",
        "О","П","Р","С","Т","У","Ф","Х","Ь","Ы","Ъ",
        "Э","Є", "Ї","І","В",
        "щ", "ш", "ч","ц", "ю", "я", "ж","а","б","в",
        "г","д","е","ё","з","и","й","к","л","м","н",
        "о","п","р","с","т","у","ф","х","ь","ы","ъ",
        "э","є", "ї","і","в"
    ];

    $lat = [
        "Shch","Sh","Ch","C","Yu","Ya","J","A","B","V",
        "G","D","E","E","Z","I","y","K","L","M","N",
        "O","P","R","S","T","U","F","H","",
        "Y","" ,"E","E","Yi","I","W",
        "shch","sh","ch","c","Yu","Ya","j","a","b","v",
        "g","d","e","e","z","i","y","k","l","m","n",
        "o","p","r","s","t","u","f","h",
        "", "y","" ,"e","e","yi","i","w"
    ];

    $string = str_replace($lat,$cyr,$string);
    $string = str_replace("_"," ",$string);
    return $string;
}

function slug($text)
{
    $text = trim($text);

    $tr = [
        "А" => "A",
        "Б" => "B",
        "В" => "V",
        "Г" => "G",
        "Д" => "D",
        "Е" => "E",
        "Ё" => "E",
        "Ж" => "J",
        "З" => "Z",
        "И" => "I",
        "Й" => "Y",
        "К" => "K",
        "Л" => "L",
        "М" => "M",
        "Н" => "N",
        "О" => "O",
        "П" => "P",
        "Р" => "R",
        "С" => "S",
        "Т" => "T",
        "У" => "U",
        "Ф" => "F",
        "Х" => "H",
        "Ц" => "TS",
        "Ч" => "CH",
        "Ш" => "SH",
        "Щ" => "SCH",
        "Ъ" => "",
        "Ы" => "YI",
        "Ь" => "",
        "Э" => "E",
        "Ю" => "YU",
        "Я" => "YA",
        "а" => "a",
        "б" => "b",
        "в" => "v",
        "г" => "g",
        "д" => "d",
        "е" => "e",
        "ё" => "e",
        "ж" => "j",
        "з" => "z",
        "и" => "i",
        "й" => "y",
        "к" => "k",
        "л" => "l",
        "м" => "m",
        "н" => "n",
        "о" => "o",
        "п" => "p",
        "р" => "r",
        "с" => "s",
        "т" => "t",
        "у" => "u",
        "ф" => "f",
        "х" => "h",
        "ц" => "ts",
        "ч" => "ch",
        "ш" => "sh",
        "щ" => "sch",
        "ъ" => "y",
        "ы" => "yi",
        "ь" => "",
        "э" => "e",
        "ю" => "yu",
        "я" => "ya",
        "«" => "",
        "»" => "",
        "№" => "",
        "Ӏ" => "",
        "’" => "",
        "ˮ" => "",
        "_" => "-",
        "'" => "",
        "`" => "",
        "^" => "",
        "\." => "",
        "," => "",
        ":" => "",
        ";" => "",
        "<" => "",
        ">" => "",
        "!" => "",
        "\(" => "",
        "\)" => ""
    ];

    foreach ($tr as $ru => $en) {
        $text = mb_eregi_replace($ru, $en, $text);
    }

    $text = mb_strtolower($text);
    $text = str_replace(' ', '-', $text);
    return $text;
}

function engineType($str)
{
    $types = [
        'petrol' => 'Бензиновый',
        'petrol_turbo' => 'Бензиновый турбированный',
        'diesel' => 'Дизельный',
        'diesel_turbo' => 'Дизельный турбированный',
        'electric' => 'Электродвигатель',
        'hybrid' => 'Гибрид'
    ];

    $str = trim(strtolower($str));

    if ($str != '' && isset($types[$str]))
        return $types[$str];
    else
        return $str;
}

function driveType($str)
{
    $types = [
        'front' => 'Передний',
        'rear' => 'Заднийй',
        'four' => 'Полный'
    ];

    $str = trim(strtolower($str));

    if ($str != '' && isset($types[$str]))
        return $types[$str];
    else
        return $str;
}

function gearboxType($str)
{
    $types = [
        'mt' => 'Механическая',
        'at' => 'Автоматическая',
        'rgt' => 'Роботизированная',
        'cvt' => 'Вариатор',
        'amt' => 'Автоматизированная механическая'
    ];

    $str = trim(strtolower($str));

    if ($str != '' && isset($types[$str]))
        return $types[$str];
    else
        return $str;
}
function gearboxTypeShort($str)
{
    $types = [
        'mt' => 'МКПП',
        'at' => 'АКПП',
        'rgt' => 'РКПП',
        'cvt' => 'Вариатор',
        'amt' => 'АMКПП'
    ];

    $str = trim(strtolower($str));

    if ($str != '' && isset($types[$str]))
        return $types[$str];
    else
        return $str;
}


function bodyType($str)
{
    $types = [
        'hatchback_5' => 'Хэтчбек 5D',
        'hatchback_3' => 'Хэтчбек 3D',
        'liftback' => 'Лифтбек',
        'sedan' => 'Седан',
        'wagon' => 'Универсал',
        'wagon_5' => 'Универсал 5 мест',
        'wagon_7' => 'Универсал 7 мест',
        'coupe' => 'Купе',
        'suv' => 'Внедорожник',
        'suv_3' => 'Внедорожник 3',
        'suv_5' => 'Внедорожник 5D',
        'crossover' => 'Кроссовер',
        'truck' => 'Грузовик',
        'pickup' => 'Пикап',
        'van' => 'Минивен',
        'convertible' => 'Кабриолет'
    ];

    $str = trim(strtolower($str));

    if ($str != '' && isset($types[$str]))
        return $types[$str];
    else
        return $str;
}