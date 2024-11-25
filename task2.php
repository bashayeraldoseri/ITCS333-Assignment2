
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

        if (!$data || !isset($data["results"])){
            die('Error fetching the data from the API');
        }

        // Extract the 'records' from the response
        $result = $data["results"] ;    
        ?>

        
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
                    // Loop through each record and display it in the table
                    foreach ($result as $student) {
                    ?>
                     <tr>
                         <td><?php echo $student ["year"]; ?> </td>
                         <td><?php echo $student ["semester"]; ?> </td>
                         <td><?php echo $student ["the_programs"]; ?> </td>
                         <td><?php echo $student ["nationality"]; ?> </td>
                         <td><?php echo $student ["colleges"]; ?> </td>
                         <td><?php echo $student ["number_of_students"]; ?> </td>
                   </tr>
                   <?php
                    }
                ?>
            </tbody>
        </table>

    </main>

</body>

</html>
