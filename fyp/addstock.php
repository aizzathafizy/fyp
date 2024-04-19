<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all fields are filled
    if (isset($_POST["food"]) && isset($_POST["quantity"])) {
        // Sanitize input to prevent SQL injection
        $food = htmlspecialchars($_POST["food"]);
        $quantity = intval($_POST["quantity"]);

        // Connect to your database (replace these values with your actual database credentials)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "food_bank_system";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare SQL statement to update stock in the database
        $sql = "UPDATE foods SET stock = stock + ? WHERE name = ?";
        $stmt = $conn->prepare($sql);

        // Bind parameters and execute the statement
        $stmt->bind_param("is", $quantity, $food);
        $stmt->execute();

        // Check if the update was successful
        if ($stmt->affected_rows > 0) {
            echo "Stock added successfully.";
        } else {
            echo "Error adding stock: " . $conn->error;
        }

        // Close the statement and database connection
        $stmt->close();
        $conn->close();
    } else {
        echo "All fields are required.";
    }
}
?>
