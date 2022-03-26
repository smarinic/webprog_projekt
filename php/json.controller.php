<?php
/**
 * Fetch JSON with movie search data.
 *
 * @param string $searchTerm Term to search for
 * 
 * @return array Returns array of JSON key value pairs
 */ 
function getJsonSearchMovie($searchTerm)
{
  $api_key = file_get_contents(APP_ROOT . '/api_key');

  $api_query = 'https://api.themoviedb.org/3/search/movie?api_key=';
  $api_query .= $api_key;
  $api_query .= '&language=en-US&query=' . urlencode($searchTerm);
  $api_query .= '&page=1&include_adult=false';

  if(USE_FAKE_JSON_DATA) {
    $json = file_get_contents(APP_ROOT . '/test_data/movies_search.json');
  }
  else {
    $json = file_get_contents($api_query);
  }

  $json_data = json_decode($json, true);

  return $json_data['results'];
}

/**
 * Fetch JSON data with movie details.
 *
 * @param string $tmdb_id TMDB id for movie
 * 
 * @return array Returns array of JSON key value pairs
 */ 
function getJsonMovieDetails($id)
{
  $api_key = file_get_contents(APP_ROOT . '/api_key');

  $api_query = 'https://api.themoviedb.org/3/movie/' . $id;
  $api_query .= '?api_key=' . $api_key;
  $api_query .= '&language=en-US';

  if(USE_FAKE_JSON_DATA) {
    $json = file_get_contents(APP_ROOT . '/test_data/movie_details.json');
  }
  else {
    $json = file_get_contents($api_query);
  }

  $json_data = json_decode($json, true);

  return $json_data;
}
