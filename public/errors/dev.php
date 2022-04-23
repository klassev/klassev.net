<?php

use Kev\ErrorHandler;

/**
 * @var $err_num ErrorHandler
 * @var $err_str ErrorHandler
 * @var $err_file ErrorHandler
 * @var $err_line ErrorHandler
 */

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ошибка</title>
</head>
<body>

<h1>Произошла ошибка</h1>
<p><b>Код ошибки:</b> <?= $err_num ?></p>
<p><b>Текст ошибки:</b> <?= $err_str ?></p>
<p><b>Файл, в котором произошла ошибка:</b> <?= $err_file ?></p>
<p><b>Строка, в которой произошла ошибка:</b> <?= $err_line ?></p>

</body>
</html>
