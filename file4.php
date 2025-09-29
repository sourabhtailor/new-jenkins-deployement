<?php

// Bad practice: hardcoded credentials
$username = "admin";
$password = "password123";

// SQL Injection vulnerability
$conn = new mysqli("localhost", "root", "", "test_db");
$sql = "SELECT * FROM users WHERE username = '" . $_GET['user'] . "'";
$result = $conn->query($sql);

// Unused variable
$unusedVar = 42;

// Error suppression (bad practice)
@include("config.php");

// Unreachable code
return;
echo "This will never be executed";

// Deprecated function usage
$now = split(" ", date("Y-m-d H:i:s")); // split() is deprecated

// Code duplication
function printWelcome() {
    echo "Welcome!";
}
function greetUser() {
    echo "Welcome!";
}

// XSS vulnerability
echo "Hello " . $_GET['name'];

// Infinite loop
while (true) {
    // Do nothing
}

// Empty catch block
try {
    riskyFunction();
} catch (Exception $e) {
    // ignored
}

// Function with too many responsibilities
function processUser($userData) {
    // Validate
    if (!isset($userData['email'])) {
        return false;
    }

    // Save to DB
    global $conn;
    $sql = "INSERT INTO users (email) VALUES ('" . $userData['email'] . "')";
    $conn->query($sql);

    // Send email
    mail($userData['email'], "Welcome!", "Thanks for joining us!");

    return true;
}

?>
