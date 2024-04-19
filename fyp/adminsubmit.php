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

    // Get form data
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
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
        if ($stmtInsertRequest->execute()) {
            echo "Data inserted successfully.";
        } else {
            echo "Error: " . $stmtInsertRequest->error;
        }
    }

    // Close statement and connection
    $stmtInsertRequest->close();
    $conn->close();
}
?>
