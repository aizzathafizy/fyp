<?php
// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Establish connection to your database
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

    // Get data from the POST request
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $food = $_POST["food"];
    $quantity = $_POST["quantity"];

    // Prepare and bind SQL statement for updating stock levels
    $stmtUpdateStock = $conn->prepare("UPDATE foods SET stock = stock - ? WHERE name = ? AND stock >= ?");
    $stmtUpdateStock->bind_param("iss", $quantity, $food, $quantity);

    // Execute the statement
    $stmtUpdateStock->execute();

    // Check if any rows were affected
    if ($stmtUpdateStock->affected_rows > 0) {
        // Return success response
        echo json_encode(["success" => true]);
    } else {
        // Return error response
        echo json_encode(["success" => false]);
    }

    // Close statement and connection
    $stmtUpdateStock->close();
    $conn->close();
}
?>
