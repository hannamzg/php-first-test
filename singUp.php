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

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the JSON data from the request body
    $json_data = file_get_contents('php://input');
    
    // Decode the JSON data into an associative array
    $data = json_decode($json_data, true);

    // Extract the values from the array
    $name = $data['name'] ?? '';
    $userName = $data['userName'] ?? '';
    $email = $data['email'] ?? '';
    $password = $data['password'] ?? '';

    // Process the uploaded photo
    if (isset($data['photo'])) {
        $photo = $data['photo'];

        // Create a unique file name for the photo
        $photo_name = uniqid() . '.jpg';
        $photo_destination = 'photos/' . $photo_name;

        // Save the photo to the destination folder
        if (file_put_contents($photo_destination, base64_decode($photo))) {
            // Prepare the SQL statement
            $sql = "INSERT INTO users (name, userName, email, password, photo) VALUES ('$name', '$userName', '$email', '$password', '$photo_destination')";

            // Execute the query
            if ($conn->query($sql) === TRUE) {
                echo "New record inserted successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Failed to save uploaded photo.";
        }
    } else {
        echo "Error uploading photo.";
    }
}

// Close the connection
$conn->close();
?>

