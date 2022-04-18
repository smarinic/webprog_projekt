<?php

require_once(APP_ROOT . '/php/dbconnection.php');

/**
 * Get review that was created by specified user.
 *
 * @param integer $id Id for review to get from database.
 * @param integer $userId Id of user that created the review.
 * 
 * @return array Returns array with SQL data with all reviews.
 */
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

  $oldDate = $review['release_date'];
  $review['release_date'] = date("d.m.Y", strtotime($oldDate));
  
  return $review;
}

/**
 * Get review from specified user. For admin level accounts only.
 *
 * @param integer $id Id for review to get from database.
 * 
 * @return array Returns array with SQL data for specified review.
 */
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

  $oldDate = $review['release_date'];
  $review['release_date'] = date("d.m.Y", strtotime($oldDate));
  
  return $review;
}


/**
 * Get all reviews created by specified user.
 *
 * @param integer $userId User ID from SQL database.
 * 
 * @return array Returns array with SQL data with all reviews for specified user.
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


/**
 * Update data for any specified review. For admin use only.
 *
 * @param integer $id Id of review to update.
 * @param integer $comment Comment for review.
 * @param integer $rating Review score for review.
 * 
 * @return bool Returns true if update was succesful and false on error.
 */
function updateReviewFromAnyUser($id, $comment, $rating)
{
  $conn = createConnection();

  $sql = "UPDATE reviews";
  $sql .= " SET comment = ?, rating = ?";
  $sql .= " WHERE id = ?";

  $stmt= $conn->prepare($sql);
  $stmt->bind_param("sii", $comment, $rating, $id);
  $isUpdateSuccess = $stmt->execute();

  $conn->close();

  return $isUpdateSuccess;
}


/**
 * Update data for specified review that is created by specified user.
 *
 * @param integer $id Id of review to update.
 * @param integer $userId Id of users that created the review.
 * @param string $comment Comment for review.
 * @param integer $rating Review score for review.
 * 
 * @return bool Returns true if update was succesful and false on error.
 * 
 */
function updateReview($id, $userId, $comment, $rating)
{
  $conn = createConnection();

  $sql = "UPDATE reviews";
  $sql .= " SET comment = ?, rating = ?";
  $sql .= " WHERE id = ?";
  $sql .= " AND user_id = ?";

  $stmt= $conn->prepare($sql);
  $stmt->bind_param("siii", $comment, $rating, $id, $userId);
  $isUpdateSuccess = $stmt->execute();

  $conn->close();
  
  return $isUpdateSuccess;
}

/**
 * Delete review data from SQL database.
 *
 * @param integer $id Id of review to delete.
 * 
 */
function deleteReview($id)
{
  $conn = createConnection();

  $sql = "DELETE FROM reviews WHERE id=?";

  $stmt= $conn->prepare($sql);
  $stmt->bind_param("i", $id);
  $stmt->execute();

  $conn->close();
}
