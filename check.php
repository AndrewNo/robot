<?php

$file = '/robots.txt';
$headers = get_headers($_POST['site'] . $file);

if (stripos($headers[1], 'nginx') || $headers[1] === 'Server: QRATOR') {
    $fileSize = substr($headers[4], 16);
} else {
    $fileSize = substr($headers[6], 16);
}
echo stripos($headers[1], 'nginx');
$codeServer = substr($headers[0], 9);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Results</title>
</head>
<body>
<table border="1" cellpadding="1" cellspacing="1" style="width: 100%">
    <tbody>
    <tr>
        <td>
            №
        </td>
        <td>
            Название проверки
        </td>
        <td>
            Статус
        </td>
        <td>&nbsp;</td>
        <td>
            Текущее состояние
        </td>
    </tr>
    <tr>
        <td rowspan="2">1</td>
        <td rowspan="2">
            Проверка наличия файла robots.txt
        </td>
        <td rowspan="2">
            <?php
            if (strpos($headers[0], '200')) {
                echo "Ок";
            } else {
                echo "Ошибка";
            }
            ?>
        </td>
        <td>Состояние</td>
        <td>
            <?php
            if (strpos($headers[0], '200')) {
                echo "Файл robots.txt присутствует";
            } else {
                echo "Файл robots.txt отсутствует";
            }
            ?>
        </td>
    </tr>
    <tr>
        <td>Рекомендации</td>
        <td>
            <?php
            if (strpos($headers[0], '200')) {
                echo "Доработки не требуются";
            } else {
                echo "Программист: Создать файл robots.txt и разместить его на сайте.";
            }
            ?>
        </td>
    </tr>

    <tr>
        <td rowspan="2">6</td>
        <td rowspan="2">
            Проверка указания директивы Host
        </td>
        <td rowspan="2">
            <?php
            if (strpos($headers[0], '200')) {
                if (substr_count(file_get_contents($_POST['site'] . $file), 'Host') === 1) {
                    echo 'Ок';
                } else {
                    echo "Ошибка";
                }
            }else {
                echo "Ошибка";
            }
            ?>
        </td>
        <td>Состояние</td>
        <td>
            <?php
            if (strpos($headers[0], '200')) {
                if (substr_count(file_get_contents($_POST['site'] . $file), 'Host') === 1) {
                    echo 'Директива Host указана';
                } else {
                    echo "В файле robots.txt не указана директива Host";
                }
            }else {
                echo "Файл robots.txt отсутствует";
            }
            ?>
        </td>
    </tr>
    <tr>
        <td>Рекомендации</td>
        <td>
            <?php
            if (strpos($headers[0], '200')) {
                if (substr_count(file_get_contents($_POST['site'] . $file), 'Host') === 1) {
                    echo 'Доработки не требуются';
                } else {
                    echo "Программист: Для того, чтобы поисковые системы знали, какая версия сайта является основных зеркалом, необходимо прописать адрес основного зеркала в директиве Host. В данный момент это не прописано. Необходимо добавить в файл robots.txt директиву Host. Директива Host задётся в файле 1 раз, после всех правил.";
                }
            }else {
                echo "Программист: Создать файл robots.txt и разместить его на сайте.";
            }
            ?>
        </td>
    </tr>

    <tr>
        <td rowspan="2">8</td>
        <td rowspan="2">
            Проверка количества директив Host, прописанных в файле
        </td>
        <td rowspan="2">
            <?php
            if (strpos($headers[0], '200')) {
                if (substr_count(file_get_contents($_POST['site'] . $file), 'Host') === 1) {
                    echo 'Ок';
                } else {
                    echo "Ошибка";
                }
            }else {
                echo "Ошибка";
            }
            ?>
        </td>
        <td>Состояние</td>
        <td>
            <?php
            if (strpos($headers[0], '200')) {
                if (substr_count(file_get_contents($_POST['site'] . $file), 'Host') === 1) {
                    echo 'В файле прописана 1 директива Host';
                } else {
                    echo "В файле прописано несколько директив Host";
                }
            }else {
                echo "Файл robots.txt отсутствует";
            }
            ?>
        </td>
    </tr>
    <tr>
        <td>Рекомендации</td>
        <td>
            <?php
            if (strpos($headers[0], '200')) {
                if (substr_count(file_get_contents($_POST['site'] . $file), 'Host') === 1) {
                    echo 'Доработки не требуются';
                } else {
                    echo "Программист: Директива Host должна быть указана в файле толоко 1 раз. Необходимо удалить все дополнительные директивы Host и оставить только 1, корректную и соответствующую основному зеркалу сайта. В файле прописано " . substr_count(file_get_contents($_POST['site'] . $file), 'Host') . " директив Host.";
                }
            }else {
                echo "Программист: Создать файл robots.txt и разместить его на сайте.";
            }
            ?>
        </td>
    </tr>

    <tr>
        <td rowspan="2">10</td>
        <td rowspan="2">
            Проверка размера файла robots.txt
        </td>
        <td rowspan="2">
            <?php
            if (strpos($headers[0], '200')) {
                if ($fileSize <= 32000) {
                    echo "Oк";
                } else {
                    echo "Ошибка";
                }
            }else {
                echo "Ошибка";
            }
            ?>
        </td>
        <td>Состояние</td>
        <td>
            <?php
            if (strpos($headers[0], '200')) {
                if ($fileSize <= 32000) {

                    echo "Размер файла robots.txt составляет " . $fileSize . " байт, что находится в пределах допустимой нормы";
                } else {
                    echo "Размера файла robots.txt составляет " . $fileSize . " байт, что превышает допустимую норму";
                }
            }else {
                echo "Файл robots.txt отсутствует";
            }
            ?>
        </td>
    </tr>
    <tr>
        <td>Рекомендации</td>
        <td>
            <?php
            if (strpos($headers[0], '200')) {
                if ($fileSize <= 32000) {

                    echo "Доработки не требуются";
                } else {
                    echo "Программист: Максимально допустимый размер файла robots.txt составляем 32 кб. Необходимо отредактировть файл robots.txt таким образом, чтобы его размер не превышал 32 Кб";
                }
            }else {
                echo "Программист: Создать файл robots.txt и разместить его на сайте.";
            }
            ?>
        </td>
    </tr>


    <tr>
        <td rowspan="2">11</td>
        <td rowspan="2">
            Проверка указания директивы Sitemap
        </td>
        <td rowspan="2">
            <?php
            if (strpos($headers[0], '200')) {
                if (substr_count(file_get_contents($_POST['site'] . $file), 'Sitemap') > 0) {
                    echo 'Ок';
                } else {
                    echo 'Ошибка';
                }
            }else {
                echo "Ошибка";
            }
            ?>
        </td>
        <td>Состояние</td>
        <td>
            <?php
            if (strpos($headers[0], '200')) {
                if (substr_count(file_get_contents($_POST['site'] . $file), 'Sitemap') > 0) {
                    echo 'Директива Sitemap указана';
                } else {
                    echo 'В файле robots.txt не указана директива Sitemap';
                }
            }else {
                echo "Файл robots.txt отсутствует";
            }
            ?>
        </td>
    </tr>
    <tr>
        <td>Рекомендации</td>
        <td>
            <?php
            if (strpos($headers[0], '200')) {
                if (substr_count(file_get_contents($_POST['site'] . $file), 'Sitemap') > 0) {
                    echo 'Доработки не требуются';
                } else {
                    echo 'Программист: Добавить в файл robots.txt директиву Sitemap';
                }
            }else {
                echo "Программист: Создать файл robots.txt и разместить его на сайте.";
            }
            ?>
        </td>
    </tr>

    <tr>
        <td rowspan="2">12</td>
        <td rowspan="2">
            Проверка кода ответа сервера для файла robots.txt
        </td>
        <td rowspan="2">
            <?php
            if (strpos($headers[0], '200')) {
                echo "Ок";
            } else {
                echo "Ошибка";
            }
            ?>
        </td>
        <td>Состояние</td>
        <td>
            <?php
            if (strpos($headers[0], '200')) {
                echo "Файл robots.txt отдаёт код ответа сервера 200";
            } else {
                echo "При обращении к файлу robots.txt сервер возвращает код ответа " . $codeServer;
            }
            ?>
        </td>
    </tr>
    <tr>
        <td>Рекомендации</td>
        <td>
            <?php
            if (strpos($headers[0], '200')) {
                echo "Доработки не требуются";
            } else {
                echo "Программист: Файл robots.txt должны отдавать код ответа 200, иначе файл не будет обрабатываться. Необходимо настроить сайт таким образом, чтобы при обращении к файлу robots.txt сервер возвращает код ответа 200";
            }
            ?>
        </td>
    </tr>
    </tbody>
</table>

</body>
</html>



