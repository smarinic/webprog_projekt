<?php


function fetchUsers() {
  require_once('dbconnection.php');

  $sql = "SELECT users.id, first_name, last_name, email, created_at, updated_at, is_enabled, roles.name AS user_role FROM users, roles WHERE users.role_id = roles.id";
  $result = $conn->query($sql);
 
  $data = [];
  while ($row = $result->fetch_assoc()) {
      $data[] = $row;
  }
  $conn->close();
  return $data;
}



?>