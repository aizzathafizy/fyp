<?php
// Connect to your database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "food_bank_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query the foods table to fetch stock data
$sql = "SELECT name, stock, image FROM foods";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch stock data and store it in an array
    $stockData = array();
    while ($row = $result->fetch_assoc()) {
        $stockData[] = $row;
    }

    // Return stock data as JSON
    header('Content-Type: application/json');
    echo json_encode($stockData);
} else {
    // If no data found, return an empty array
    echo json_encode(array());
}

// Close connection
$conn->close();
?>
