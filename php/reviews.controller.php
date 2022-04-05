<?php

require_once(APP_ROOT . '/php/dbconnection.php');

function getReview($id, $userId) {
  $conn = createConnection();

  $sql = "SELECT reviews.id, movies.tmdb_id, movies.title, movies.overview, movies.release_date, movies.rating_average, movies.poster_path, reviews.comment, reviews.rating, reviews.user_id FROM reviews, movies ";
  $sql .= "WHERE reviews.id = ?";
  $sql .= " AND reviews.user_id = ?";
  $sql .= " AND reviews.movie_id = movies.id";

  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ii", $id, $userId);
  $stmt->execute();
  $result = $stmt->get_result();
  $review = $result->fetch_assoc();

  $conn->close();
  
  return $review;
}

function getReviewFromAnyUser($id) {
  $conn = createConnection();

  $sql = "SELECT reviews.id, movies.tmdb_id, movies.title, movies.overview, movies.release_date, movies.rating_average, movies.poster_path, reviews.comment, reviews.rating, reviews.user_id FROM reviews, movies ";
  $sql .= "WHERE reviews.id = ?";
  $sql .= " AND reviews.movie_id = movies.id";

  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $result = $stmt->get_result();
  $review = $result->fetch_assoc();

  $conn->close();
  
  return $review;
}


/**
 * Get all reviews created by specified user.
 *
 * @param integer $userId User ID from SQL database.
 * 
 * @return array Returns array with SQL data with all reviews.
 */
function getReviews($userId)
{
  $conn = createConnection();

  $sql = "SELECT reviews.id, reviews.comment, reviews.rating, CONCAT(users.first_name, ' ', users.last_name) AS author, movies.title, movies.tmdb_id";
  $sql .= " FROM reviews, users, movies";
  $sql .= " WHERE users.id = ?";
  $sql .= " AND reviews.user_id = users.id";
  $sql .= " AND reviews.movie_id = movies.id";

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

/**
 * Get all reviews in database. For admin use only.
 * 
 * @return array Returns array with SQL data with all reviews.
 */
function getAllReviews()
{
  $conn = createConnection();

  $sql = "SELECT reviews.id, movies.tmdb_id, movies.title, reviews.rating, CONCAT(users.first_name, ' ', users.last_name) AS author";
  $sql .= " FROM reviews, users, movies";
  $sql .= " WHERE reviews.user_id = users.id";
  $sql .= " AND reviews.movie_id = movies.id";

  $result = $conn->query($sql);

  $data = [];
  while ($row = $result->fetch_assoc()) {
    $data[] = $row;
  }
  $conn->close();
  return $data;
}

/**
 * Insert review data into SQL database.
 *
 * @param string $comment Review comment to insert into DB.
 * @param integer $rating Movie rating to insert into DB.
 * @param integer $user_id ID of user writing the review.
 * @param integer $movie_id ID of movie.
 * 
 * @return bool Returns true on success, and false on fail.
 */
function insertReview($comment, $rating, $user_id, $movie_id)
{
  $conn = createConnection();

  $sql = "INSERT INTO reviews (comment, rating, user_id, movie_id) VALUES (?,?,?,?)";

  $stmt= $conn->prepare($sql);
  $stmt->bind_param("siii", $comment, $rating, $user_id, $movie_id);
  $stmt->execute();

  $conn->close();
}

function deleteReview($id)
{
  $conn = createConnection();

  $sql = "DELETE FROM reviews WHERE id=?";

  $stmt= $conn->prepare($sql);
  $stmt->bind_param("i", $id);
  $stmt->execute();

  $conn->close();
}
