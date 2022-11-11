<?php
require_once './config.php';
require './services.php';

$id = filter_input(INPUT_GET, 'id');
$db = new Db($pdo);

$db->deleteUser($id);
header("Location:index.php");
