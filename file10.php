<?php
// sample_buggy.php
// Intentionally vulnerable/buggy PHP for testing Sonar/Scanner rules

// 1) Hardcoded credentials
$dbUser = "admin";
$dbPass = "P@ssw0rd123"; // secret in source code

// 2) Using deprecated mysql extension and building SQL via concatenation -> SQL injection
function getUserById($id) {
    // intval is not used -> potential injection if $id is from untrusted input
    $conn = mysql_connect('localhost', $dbUser, $dbPass);
    mysql_select_db('app_db', $conn);
    $sql = "SELECT * FROM users WHERE id = " . $id;
    $result = mysql_query($sql, $conn);
    return mysql_fetch_assoc($result);
}

// 3) Cross Site Scripting (XSS) - echoing user input directly
function renderGreeting() {
    $name = $_GET['name']; // unvalidated user input
    echo "<h1>Welcome, $name</h1>";
}

// 4) Using insecure random for tokens
function generateToken() {
    // rand() is predictable
    return md5(rand() . time());
}

// 5) Weak password hashing
function storePassword($password) {
    // md5 is weak and unsalted
    $hash = md5($password);
    // pretend to store $hash in DB
    return $hash;
}

// 6) Insecure file include / path traversal
function loadTemplate($tpl) {
    // attacker could pass ../../etc/passwd
    include __DIR__ . "/templates/" . $tpl;
}

// 7) Ignoring errors / suppressing with @
function saveToFile($filename, $content) {
    // @ operator suppresses errors - hides issues
    @file_put_contents($filename, $content);
}

// 8) Unused variables / dead code
function compute() {
    $a = 5;
    $b = 10;
    $unused = 42; // unused variable
    return $a + $b;
}

// 9) Long method with mixed responsibilities
function handleRequest() {
    // Connect to DB
    $conn = mysql_connect('localhost', $dbUser, $dbPass);
    mysql_select_db('app_db', $conn);

    // Parse input
    $id = $_REQUEST['id'];
    // Do DB lookup
    $sql = "SELECT * FROM users WHERE id = " . $id;
    $result = mysql_query($sql, $conn);
    $user = mysql_fetch_assoc($result);

    // Render
    echo "<div>";
    echo "<h2>User</h2>";
    echo "<p>Name: " . $user['name'] . "</p>";
    echo "</div>";

    // Save some log file without checking path or permissions
    file_put_contents("/var/log/app/last_access.log", date('c') . " id=" . $id . "\n", FILE_APPEND);
}

// 10) Missing input validation leading to possible type confusion
function multiply($x, $y) {
    return $x * $y; // if $x or $y are arrays or strings could behave unexpectedly
}

