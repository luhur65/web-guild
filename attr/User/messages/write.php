<?php

$data_source_file = fopen("data.json", "w+");

$_POST['message'] = strip_tags($_POST['message']);
$_POST['name'] = strip_tags($_POST['name']);

$message = json_encode($_POST);	

fwrite($data_source_file, $message);
fclose($data_source_file);
