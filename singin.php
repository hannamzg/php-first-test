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

    $userName = $data['userName'] ?? '';
    $password = $data['password'] ?? '';

    // Prepare the SQL statement
    $sql = "SELECT * FROM users WHERE userName = '$userName' AND password = '$password'";

    // Execute the query
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User found, fetch user data
        $user = $result->fetch_assoc();

        // Return user data as JSON response
        echo json_encode($user);
    } else {
        // No matching user found, handle sign-in failure
        echo "Invalid username or password";
    }
}

// Close the connection
$conn->close();
?>
