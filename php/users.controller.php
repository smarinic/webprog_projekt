<?php


require_once(APP_ROOT . '/php/dbconnection.php');

/**
 * Get data for all users in database.
 *
 * @return Array Returns array with users.
 * 
 */
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

/**
 * Get data for specified user.
 *
 * @param integer $id Id of user to get.
 * 
 * @return Array Returns array with user data.
 * 
 */
function getUser($id) {
  $conn = createConnection();

  $sql = "SELECT users.first_name, users.last_name, users.email, users.created_at, users.updated_at, users.is_enabled, users.role_id FROM users, roles WHERE users.id=? AND users.role_id = roles.id";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $result = $stmt->get_result();
  $user = $result->fetch_assoc();
  $conn->close();
  return $user;
}

/**
 * Create user by inserting into the database.
 * User password is hashed by default PHP hashing algorithm.
 * For PHP 5.5.0 it's bcrypt.
 *
 * @param string $firstName First name for user.
 * @param string $lastName Last name for user.
 * @param string $email Email for user.
 * @param string $password Password for user.
 * 
 * @return bool Returns true if insert was succesful and false on error.
 * 
 */
function createUser($firstName, $lastName, $email, $password) {
  $conn = createConnection();
  $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, password, role_id) VALUES (?, ?, ?, ?, 3)");
  $stmt->bind_param("ssss", $firstName, $lastName, $email, $password);
  $password = password_hash(clean_input($_POST["password"]), PASSWORD_DEFAULT);
  $isSuccess = $stmt->execute();

  $conn->close();
  return $isSuccess;
}

/**
 * Delete user from the database.
 *
 * @param integer $id ID of user to delete.
 * 
 * @return bool Returns true if delete was succesful and false on error.
 * 
 */
function deleteUser($id) {
  $conn = createConnection();

  $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
  $stmt->bind_param('i', $id);

  $isSuccess = $stmt->execute();

  $conn->close();

  return $isSuccess;
}

/**
 * Update data for specified user.
 *
 * @param integer $id Id of user to update.
 * @param string $firstName Updated first name for user.
 * @param string $lastName Updated last name for user.
 * @param string $email Updated email for user.
 * @param string $password Updated password for user.
 * @param integer $rating Review score for review.
 * 
 * @return bool Returns true if update was succesful and false on error.
 * 
 */
function updateUser($id, $firstName, $lastName, $email, $password) {
  $conn = createConnection();

  $stmt = $conn->prepare("UPDATE users SET first_name = ?, last_name = ?, email = ?, password = ?, updated_at = ? WHERE id = ?");
  $update_datetime = date('Y-m-d H:i:s'); // insert current datetime for updated_at column
  $stmt->bind_param('sssssii', $firstName, $lastName, $email, $password, $update_datetime, $id);

  $password = password_hash(clean_input($_POST["password"]), PASSWORD_DEFAULT);

  $isSuccess = $stmt->execute();
  $conn->close();

  return $isSuccess;
}

/**
 * Update data for specified user. For admin use only.
 *
 * @param integer $id Id of user to update.
 * @param string $firstName Updated first name for user.
 * @param string $lastName Updated last name for user.
 * @param string $email Updated email for user.
 * @param string $password Updated password for user.
 * @param integer $rating Review score for review.
 * @param bool $isEnabled Is user account enabled.
 * 
 * @return bool Returns true if update was succesful and false on error.
 * 
 */
function updateUserByAdmin($id, $firstName, $lastName, $email, $password, $isEnabled, $roleId) {
  $conn = createConnection();

  $stmt = $conn->prepare("UPDATE users SET first_name = ?, last_name = ?, email = ?, password = ?, updated_at = ?, is_enabled = ?, role_id = ? WHERE id = ?");
  $update_datetime = date('Y-m-d H:i:s'); // insert current datetime for updated_at column
  $accountStatus = 0;
  switch ($isEnabled) {
    case true:
      $accountStatus = 1;
      break;
    case false:
      $accountStatus = 0;
      break;
    default:
      $accountStatus = 0;
      break;
  }
  $stmt->bind_param('sssssiii', $firstName, $lastName, $email, $password, $update_datetime, $accountStatus, $roleId, $id);

  $password = password_hash(clean_input($_POST["password"]), PASSWORD_DEFAULT);

  $isSuccess = $stmt->execute();
  $conn->close();

  return $isSuccess;
}

/**
 * Get all user roles from database.
 *
 * @return Array Returns array with all user roles.
 * 
 */
function getUserRoles() {
  $conn = createConnection();

  $sql = "SELECT id, name FROM roles";
  $result = $conn->query($sql);
 
  $data = [];
  while ($row = $result->fetch_assoc()) {
      $data[] = $row;
  }
  $conn->close();

  return $data;
}