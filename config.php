<?php

try {
  $pdo = new PDO('mysql:dbname=crud_example;host:localhost;', 'root', '');
} catch (\Throwable $th) {
  echo "Error on connection: - ", $th->getMessage();
}
