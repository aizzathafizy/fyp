<?php
// Database connection
$host = "localhost";
$username = "root";
$password = "";
$database = "food_bank_system";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve data sent via POST request
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$food = $_POST['food'];
$quantity = $_POST['quantity'];

// Prepare and execute SQL statement to delete the record
$sql = "DELETE FROM requests WHERE name = '$name' AND phone = '$phone' AND email = '$email' AND food = '$food' AND quantity = '$quantity'";
if ($conn->query($sql) === TRUE) {
    echo "success";
} else {
    echo "error";
}

// Close connection
$conn->close();
?>
