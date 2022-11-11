<?php
require_once './config.php';
require './services.php';

$db = new Db($pdo);

$users = $db->getUsers();

if (isset($_POST['name']) && isset($_POST['email'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];

  $db->addUser($name, $email);
  header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRUD</title>
  <link rel="stylesheet" href="styles.css" />
</head>

<body>
  <h1>Users</h1>
  <form method="post">
    <input type="text" name="name" placeholder="Name" />
    <br />
    <input type="email" name="email" placeholder="Email" />
    <br />
    <br />
    <button>Add</button>
  </form>
  <hr />
  <table>
    <thead>
      <tr>
        <th>id</th>
        <th>name</th>
        <th>email</th>
        <th>ACTIONS</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($users as $u) : ?>
        <tr>
          <td><?= $u['id']; ?></td>
          <td><?= $u['name']; ?></td>
          <td><?= $u['email']; ?></td>
          <td>
            <a href="edit.php?id=<?=$u['id'];?>">Edit</a>
            <a href="delete.php?id=<?=$u['id'];?>">Delete</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</body>

</html>