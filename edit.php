<?php
// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the ID from the parameter in the link
    $id = $_GET['id'];

    // Ensure the ID is valid
    if (!empty($id)) {
        // Database credentials
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "firstphpwithc#";

        $json_data = file_get_contents('php://input');
    
        // Decode the JSON data into an associative array
        $data = json_decode($json_data, true);
    
        // Extract the values from the array
        $name = $data['name'] ?? '';
       
        // Create a connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and execute the UPDATE query using prepared statements
        $stmt = $conn->prepare("UPDATE `users` SET `name`=? WHERE id=?");
        $stmt->bind_param("si", $name, $id);

        if ($stmt->execute()) {
            echo "Item updated successfully";
        } else {
            echo "Error updating item: " . $stmt->error;
        }

        // Close the prepared statement and database connection
        $stmt->close();
        $conn->close();
    } else {
        echo "Invalid ID";
    }
} else {
    echo "Invalid request method. Only POST method is allowed.";
}
