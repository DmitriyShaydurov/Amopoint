<?php
require_once('classes/File.php');

define('UPLOAD_DIR', '/files/'); // Директория загрузки файлов
define('DELIMITER', ','); // разделитель


$h = new File(UPLOAD_DIR);
echo $h->getResponce($_FILES, DELIMITER);
