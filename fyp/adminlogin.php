<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if username and password are provided
    if (isset($_POST['username']) && isset($_POST['password'])) {
        // Dummy credentials (Replace these with your actual authentication logic)
        $valid_username = "admin123";
        $valid_password = "admin";

        // Retrieve username and password from the form
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Check if username and password match the valid credentials
        if ($username === $valid_username && $password === $valid_password) {
            // Start session and set authenticated flag
            session_start();
            $_SESSION['authenticated'] = true;
            
            // Redirect to admin page
            header("Location: adminpage.html");
            exit;
        } else {
            // Invalid credentials
            echo "Invalid username or password.";
        }
    } else {
        // Username or password not provided
        echo "Please provide both username and password.";
    }
}
?>
