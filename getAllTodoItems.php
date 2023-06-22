<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "firstphpwithc#";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the JSON data from the request body
    $json_data = file_get_contents('php://input');

    // Decode the JSON data into an associative array
    $data = json_decode($json_data, true);

    $userId = $data["userId"] ?? '';


    $selectSql = "SELECT * FROM `todolist` WHERE `userId` = '$userId'";
    $selectResult = $conn->query($selectSql);

        if ($selectResult->num_rows > 0) {
            // Fetch all the rows and store them in an array
            $rows = array();
            while ($row = $selectResult->fetch_assoc()) {
                $rows[] = $row;
            }

            // Convert the array to JSON and echo the response
            echo json_encode($rows);
        } else {
            // No items found
            echo "No items found for the specified user.";
        }
    } else {
        // Query execution failed
        echo "Problem: " . $conn->error;
    }


// Close the connection
$conn->close();
?>