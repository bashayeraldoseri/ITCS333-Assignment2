<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Statistics</title>
    <!-- Include Pico CSS for styling -->
    <link rel="stylesheet" href="https://unpkg.com/@picocss/pico@1.5.7/css/pico.min.css">
</head>
<body>
    <main class="container">
        <h1>Student Enrollment Statistics</h1>

        <?php
        // Define the API URL with filters
        $URL = "https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100";

        // Fetch data from the API
        $response = file_get_contents($URL);

        // Check if the request was successful
        if ($response === FALSE) {
            die("<p>Error fetching data from the API. Please check the URL or your internet connection.</p>");
        }

        // Decode the JSON response into a PHP associative array
        $data = json_decode($response, true);

        // Check if decoding was successful
        if ($data === NULL) {
            die("<p>Error decoding the JSON response. Invalid JSON format.</p>");
        }

        // Extract the 'records' from the response
        $records = $data['records'] ?? [];

        // Debugging step: Uncomment this to print raw API response
        /*
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        */
        ?>

        <!-- Create a responsive table to display the data -->
        <table role="grid">
            <thead>
                <tr>
                    <th>Year</th>
                    <th>Semester</th>
                    <th>The Programs</th>
                    <th>Nationality</th>
                    <th>Colleges</th>
                    <th>Number of Students</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Check if records are available
                if (empty($records)) {
                    echo "<tr><td colspan='6'>No data available</td></tr>";
                } else {
                    // Loop through each record and display it in the table
                    foreach ($records as $record) {
                        $fields = $record['record']['fields'] ?? [];
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($fields['year'] ?? 'N/A') . "</td>";
                        echo "<td>" . htmlspecialchars($fields['semester'] ?? 'N/A') . "</td>";
                        echo "<td>" . htmlspecialchars($fields['the_programs'] ?? 'N/A') . "</td>";
                        echo "<td>" . htmlspecialchars($fields['nationality'] ?? 'N/A') . "</td>";
                        echo "<td>" . htmlspecialchars($fields['colleges'] ?? 'N/A') . "</td>";
                        echo "<td>" . htmlspecialchars($fields['number_of_students'] ?? 'N/A') . "</td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </main>
</body>
</html>
