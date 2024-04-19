<?php
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "food_bank_system";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $phone = $_POST["number"];
    $email = $_POST["email"];
    $foods = $_POST["food"];
    $quantities = $_POST["quantity"];

    // Insert each food request into the database
    for ($i = 0; $i < count($foods); $i++) {
        $food = $foods[$i];
        $quantity = $quantities[$i];

        $sql = "INSERT INTO requests (name, phone, email, food, quantity) 
                VALUES ('$name', '$phone', '$email', '$food', $quantity)";

        if ($conn->query($sql) !== TRUE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    echo "Your request has been submitted!";
}

// Close database connection
$conn->close();
?>
