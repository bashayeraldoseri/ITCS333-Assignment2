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

// Display the retrieved data (for debugging purposes)
echo "<pre>";
print_r($data);
echo "</pre>";

// Assuming the 'records' key holds the data we need, loop through it and display relevant information
if (isset($data['records'])) {
    echo "<h1>UOB Students Enrollment by Nationality</h1>";
    echo "<table border='1'>";
    echo "<tr><th>Nationality</th><th>Number of Students</th></tr>";

    // Loop through each record and display nationality and the number of students
    foreach ($data['records'] as $record) {
        // Make sure that the necessary fields exist in each record
        if (isset($record['fields']['nationality']) && isset($record['fields']['students_count'])) {
            $nationality = htmlspecialchars($record['fields']['nationality']);  // Safeguard against XSS attacks
            $students_count = htmlspecialchars($record['fields']['students_count']);  // Safeguard against XSS attacks
            echo "<tr><td>$nationality</td><td>$students_count</td></tr>";
        }
    }
    echo "</table>";
} else {
    echo "No records found.";
}
?>
