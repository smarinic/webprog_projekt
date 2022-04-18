<?php


require_once(APP_ROOT . '/php/dbconnection.php');

function getUsers() {

  $conn = createConnection();

  $sql = "SELECT users.id, first_name, last_name, email, created_at, updated_at, is_enabled, roles.name AS user_role FROM users, roles WHERE users.role_id = roles.id";
  $result = $conn->query($sql);
 
  $data = [];
  while ($row = $result->fetch_assoc()) {
      $data[] = $row;
  }
  $conn->close();
  return $data;
}

function getUser($id) {
  $conn = createConnection();

  $sql = "SELECT users.first_name, users.last_name, users.email, users.created_at, users.updated_at, users.is_enabled FROM users, roles WHERE id=? AND users.role_id = roles.id";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $result = $stmt->get_result();
  $user = $result->fetch_assoc();
  $conn->close();
  return $user;
}

function createUser($firstName, $lastName, $email, $password) {
  $conn = createConnection();
  $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, password, role_id) VALUES (?, ?, ?, ?, 3)");
  $stmt->bind_param("ssss", $firstName, $lastName, $email, $password);
  $password = password_hash(clean_input($_POST["password"]), PASSWORD_DEFAULT);
  $isSuccess = $stmt->execute();

  $conn->close();
  return $isSuccess;
}

function deleteUser($id) {
  $conn = createConnection();

  $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
  $stmt->bind_param('i', $id);

  $isSuccess = $stmt->execute();

  $conn->close();

  return $isSuccess;
}

function updateUser($id, $firstName, $lastName, $email, $password) {
  $conn = createConnection();

  $stmt = $conn->prepare("UPDATE users SET first_name = ?, last_name = ?, email = ?, password = ? WHERE id = ?");
  $stmt->bind_param('ssssi', $firstName, $lastName, $email, $password, $id);

  $password = password_hash(clean_input($_POST["password"]), PASSWORD_DEFAULT);

  $isSuccess = $stmt->execute();
  $stmt->close();
  $conn->close();

  return $isSuccess;
}

function enableUser($id) {

}

function disableUser($id) {
  
}
