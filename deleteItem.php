
<?php
// Check if the request method is DELETE
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Retrieve the ID from the parameter in the link
    $id = $_GET['id'];

    // Ensure the ID is valid
    if (!empty($id)) {
        // Database credentials
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

        // Prepare and execute the DELETE query
        $sql = "DELETE FROM `users` WHERE id = $id";

        if ($conn->query($sql) === TRUE) {
            echo "Item deleted successfully";
        } else {
            echo "Error deleting item: " . $conn->error;
        }

        // Close the database connection
        $conn->close();
    } else {
        echo "Invalid ID";
    }
} else {
    echo "Invalid request method. Only DELETE method is allowed.";
}
?>