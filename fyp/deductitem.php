<?php
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "food_bank_system";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle item addition
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $food_id = $_POST['food_id']; // You should sanitize and validate input
    $sql = "UPDATE foods SET quantity = quantity - 1 WHERE id = $food_id AND quantity > 0";

    if ($conn->query($sql) === TRUE) {
        echo "Item added successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>
