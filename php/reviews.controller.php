<?php

require_once(APP_ROOT . '/php/dbconnection.php');

function getReview($id) {
  $conn = createConnection();

  $sql = "SELECT reviews.id, reviews.tmdb_id, reviews.title, reviews.comment, reviews.rating, CONCAT(users.first_name, ' ', users.last_name) AS author FROM reviews, users ";
  $sql .= "WHERE reviews.id = ? AND reviews.user_id = users.id";

  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $result = $stmt->get_result();
  $user = $result->fetch_assoc();
  $conn->close();
  return $user;
}

function getReviews($userId)
{
  $conn = createConnection();

  $sql = "SELECT reviews.id, reviews.tmdb_id, reviews.title, reviews.rating, CONCAT(users.first_name, ' ', users.last_name) AS author FROM reviews, users ";
  $sql .= "WHERE reviews.user_id = ? AND reviews.user_id = users.id";

  $stmt = $conn->prepare($sql); 
  $stmt->bind_param("i", $userId);
  $stmt->execute();
  $result = $stmt->get_result();
  $data = [];
  while ($row = $result->fetch_assoc()) {
      $data[] = $row;
  }

  $conn->close();
  return $data;
}

function getAllReviews()
{
  $conn = createConnection();

  $sql = "SELECT reviews.id, reviews.tmdb_id, reviews.title, reviews.rating, CONCAT(users.first_name, ' ', users.last_name) AS author FROM reviews, users ";
  $sql .= "WHERE reviews.user_id = users.id";

  $result = $conn->query($sql);

  $data = [];
  while ($row = $result->fetch_assoc()) {
    $data[] = $row;
  }
  $conn->close();
  return $data;
}

function createReview($movieId, $userId, $reviewText, $rating)
{
  // TODO: dovrsit
}

function deleteReview($id)
{
  // TODO: dovrsit
}
