<?php
header('Content-Type: text/html; charset=UTF-8');
include __DIR__ . '/ZipArchiv.php';

$obj = new ZipArchiv(true);

?>
добавляем файл  table.json : <?php var_dump($obj->AddFile('table.json')); ?> <br>
добавляем файл  table1.json : <?php var_dump($obj->AddFile('table1.json')); ?> <br>
добавляем файл  table2.json : <?php var_dump($obj->AddFile('table2.json')); ?> <br>

создаем архив dr.zip: <?php var_dump($obj->Archive('dr1.zip')); ?>
