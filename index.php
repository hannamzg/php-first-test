<?php
    $myName = "hanna";
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "todolist";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_errno) {
      die("Failed to connect to MySQL: " . $conn->connect_error);
    }


    if(isset($_POST["submit"])){
        $txt = $_POST["txt"];
       
        $query = "INSERT INTO todolistphp (txt) VALUES('$txt')";
        mysqli_query($conn,$query);
        echo
        "
        <script> alert('Data Inserted Successfully'); </script>
        ";
    }

    if (isset($_POST["delete"])) {
        $id = $_POST["delete"];
        $query = "DELETE FROM todolistphp WHERE id = $id";
        mysqli_query($conn, $query);
        echo "<script>alert('Data Deleted Successfully');</script>";
    }
      
?>



<!DOCTYPE html>
<html>
<head>
  <title>To-Do List</title>
  <style>
    table {
      border-collapse: collapse;
      width: 100%;
    }
    th, td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }
    input[type=text] {
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      box-sizing: border-box;
    }
    button {
      background-color: #4CAF50;
      color: white;
      padding: 14px 20px;
      border: none;
      cursor: pointer;
      width: 100%;
    }
    button:hover {
      opacity: 0.8;
    }
    .delete{
        background-color: red;
        width: 150px;
    }
  </style>
</head>
<body>
  <h1>To-Do List</h1>
  <form  action="" method="post" autocomplete="off">
    <label for="item">New Item:</label>
    <input type="text" id="item" name="txt"  required value="" placeholder="Enter new to-do item...">
    <button type="submit" name="submit">Submit</button>
  </form>
  <br>
  <table>
    <tr>
      <th>ID</th>
      <th>Item</th>
    </tr>
    <?php
    // Connect to database
    $mysqli = new mysqli($servername, $username, $password, $dbname);
    if ($mysqli->connect_errno) {
      die("Failed to connect to MySQL: " . $mysqli->connect_error);
    }

    // Retrieve to-do items from database
    $result = $mysqli->query("SELECT * FROM todolistphp");
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["id"] . "</td><td>" . $row["txt"] . "</td><td>  <form  method='post'><button   type='submit' name='delete' value=" . $row["id"] . " class=delete>Delete</button></form> </td></tr>";
      }
    } else {
      echo "<tr><td colspan='2'>No items found.</td></tr>";
    }

    // Close database connection
    $mysqli->close();
    ?>
  </table>
</body>
</html>
