<?php
require './config.php';

/*  C R U D
  C - CREATE
  R - READ
  U - UPDATE
  D - DELETE
*/


class Db
{
  private $pdo;

  public function __construct(PDO $pdo)
  {
    $this->pdo = $pdo;
  }


  /**
   * CRUD | C - CREATE
   */
  public function addUser($name, $email)
  {
    try {
      $sql = $this->pdo->prepare("INSERT INTO users (name, email) VALUES (:name, :email)");
      $sql->bindValue(':name', $name);
      $sql->bindValue(':email', $email);
      $sql->execute();

      return true;
    } catch (PDOException $e) {
      echo $e->getMessage();
      return false;
    }
  }

  /**
   * CRUD | R - READ
   */
  public function getUsers()
  {
    $sql = $this->pdo->query('SELECT * FROM users');
    return ($sql->rowCount() > 0) ?
      $sql->fetchAll(PDO::FETCH_ASSOC) :
      [];
  }

  /**
   * CRUD | R - READ
   */
  public function getUser($id)
  {
    $sql = $this->pdo->prepare('SELECT * FROM users WHERE id=:id');
    $sql->bindValue(':id', $id);
    $sql->execute();

    return ($sql->rowCount() > 0) ?
      $sql->fetchAll(PDO::FETCH_ASSOC)[0] :
      [];
  }

  /**
   * CRUD | U - UPDATE
   */
  public function updateUser($id, $name = null, $email = null)
  {
    if ($name === null && $email === null) {
      return false;
    }

    $q = '';
    if ($name !== null && $email === null) {
      $q = "UPDATE users SET name=:name WHERE id=:id";
    } else if ($name === null && $email !== null) {
      $q = "UPDATE users SET email=:email WHERE id=:id";
    } else if ($name !== null && $email !== null) {
      $q = "UPDATE users SET name=:name, email=:email WHERE id=:id";
    }

    $sql = $this->pdo->prepare($q);
    $sql->bindValue(':id', $id);
    if ($name !== null) $sql->bindValue(':name', $name);
    if ($email !== null) $sql->bindValue(':email', $email);
    $sql->execute();

    return true;
  }

  /**
   * CRUD | D - DELETE
   */
  public function deleteUser($id)
  {
    $sql = $this->pdo->prepare('DELETE FROM users WHERE id = :id');
    $sql->bindValue(':id', $id);
    $sql->execute();

    return true;
  }
}
