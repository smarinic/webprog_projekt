<?php

require_once(APP_ROOT . '/php/dbconnection.php');

/**
 * Fetch data for movie.
 *
 * @param string $tmdb_id TMDB id string for movie
 * 
 * @return array|null Returns array of SQL data or null if id not found
 */
function getMovie($tmdb_id)
{
  $conn = createConnection();

  $sql = "SELECT movies.tmdb_id, movies.title, movies.overview, movies.release_date, movies.rating_average, movies.poster_path";
  $sql .= " FROM movies";
  $sql .= " WHERE movies.tmdb_id = ?";


  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $id);
  $stmt->execute();
  $result = $stmt->get_result();
  $movie = $result->fetch_assoc();
  $conn->close();
  return $movie;
}

/**
 * Fetch ID for movie.
 *
 * @param string $tmdb_id TMDB id string for movie
 * 
 * @return integer|null Returns id integer or null if id not found
 */
function getMovieId($tmdb_id)
{
  $conn = createConnection();

  $sql = "SELECT id";
  $sql .= " FROM movies";
  $sql .= " WHERE movies.tmdb_id = ?";


  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $tmdb_id);
  $stmt->execute();
  $result = $stmt->get_result();
  $movie = $result->fetch_assoc();
  $conn->close();
  if($movie == null) {
    return null;
  }
  else return $movie['id'];
}

/**
 * Insert movie data into database.
 *
 * @param string $tmdb_id TMDB id string for movie
 * @param string $title TMDB id string for movie
 * @param string $overview TMDB id string for movie
 * @param string $release_date TMDB id string for movie
 * @param float $rating_average TMDB id string for movie
 * @param string $poster_path TMDB id string for movie
 * 
 * @return bool Returns true if insert is successful. Returns false if operation failed.
 */
function insertMovie($tmdb_id, $title, $overview, $release_date, $rating_average, $poster_path)
{
  $conn = createConnection();

  $sql = "INSERT INTO movies (tmdb_id, title, overview, release_date, rating_average, poster_path) VALUES (?,?,?,?,?,?)";

  $stmt= $conn->prepare($sql);
  $stmt->bind_param("ssssds", $tmdb_id, $title, $overview, $release_date, $rating_average, $poster_path);
  $stmt->execute();
}
