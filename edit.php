<?php
require_once './config.php';
require './services.php';

$id = filter_input(INPUT_GET, 'id');
$db = new Db($pdo);

if (isset($_POST['name']) && isset($_POST['email'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];

  $db->updateUser($id, $name, $email);
  header("Location: index.php");
  exit;
}

$user = $db->getUser($id);

$name = $user['name'];
$email = $user['email'];

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRUD - EDIT</title>
</head>

<body>
  <form method="post">
    <input type="text" name="name" placeholder="Name" value="<?= $name ?? ''; ?>" />
    <br />
    <input type="email" name="email" placeholder="Email" value="<?= $email ?? ''; ?>" />
    <br />
    <br />
    <button>Update</button>
  </form>
</body>

</html>