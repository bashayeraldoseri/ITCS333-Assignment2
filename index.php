<?php
// Define the URL of the API
$URL = "https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100";

// Fetch data from the API using file_get_contents()
$response = file_get_contents($URL);

// Check if the request was successful
if ($response === FALSE) {
    die("Error fetching data from the API.");
}

// Decode the JSON response into a PHP associative array
$data = json_decode($response, true);

// Check if the data is properly decoded
if ($data === NULL) {
    die("Error decoding the JSON response.");
}
    
?>
