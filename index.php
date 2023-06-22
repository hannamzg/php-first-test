
<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "firstphpwithc#";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the request is a GET request
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // SQL query to retrieve all data from the users table
    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);

    // Check if any rows were returned
    if ($result->num_rows > 0) {
        // Create an array to store the result
        $data = array();

        // Loop through each row
        while ($row = $result->fetch_assoc()) {
            // Add each row to the data array
            $data[] = $row;
        }

        // Convert the data array to JSON
        $json = json_encode($data);

        // Return the JSON response
        header('Content-Type: application/json');
        echo $json;
    } else {
        echo "No data found in the users table.";
    }
} else {
    echo "Invalid request method.";
}

// Close the connection
$conn->close();
?>





