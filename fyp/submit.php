<?php
// Check if the form is submitted
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

    // Prepare and bind SQL statement for inserting request into requests table
    $stmtInsertRequest = $conn->prepare("INSERT INTO requests (name, phone, email, food, quantity) VALUES (?, ?, ?, ?, ?)");
    $stmtInsertRequest->bind_param("sssss", $name, $phone, $email, $food, $quantity);

    // Prepare and bind SQL statement for updating stock levels
    $stmtUpdateStock = $conn->prepare("UPDATE foods SET stock = stock - ? WHERE name = ? AND stock >= ?");
    $stmtUpdateStock->bind_param("iss", $quantity, $foodName, $quantity);

    // Get form data
    $name = isset($_POST["name"]) ? $_POST["name"] : "";
    $phone = isset($_POST["phone"]) ? $_POST["phone"] : "";
    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $foods = isset($_POST["food"]) ? $_POST["food"] : array();
    $quantities = isset($_POST["quantity"]) ? $_POST["quantity"] : array();

    // Check if 'food' or 'quantity' fields are empty
    if (empty($foods) || empty($quantities)) {
        die("Error: 'Food' and 'Quantity' fields cannot be empty.");
    }

    // Insert into the database for each food item
    for ($i = 0; $i < count($foods); $i++) {
        $food = $foods[$i];
        $quantity = $quantities[$i];

        // Insert request into requests table
        $stmtInsertRequest->execute();

        // Update stock levels
        $foodName = $food; // To use in stock update query
        if ($stmtUpdateStock->execute()) {
            echo "New record inserted successfully.";
        } else {
            echo "Error: " . $stmtUpdateStock->error;
        }
    }

    // Close statements and connection
    $stmtInsertRequest->close();
    $stmtUpdateStock->close();
    $conn->close();
}
?>
