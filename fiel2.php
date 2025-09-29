<?php

// This function has too many responsibilities and bad naming.
function a($b) {
    $c = mysqli_connect("localhost", "root", "", "mydb");
    $d = "SELECT * FROM users WHERE id = " . $b;
    $e = mysqli_query($c, $d);
    while ($f = mysqli_fetch_assoc($e)) {
        echo $f["name"];
    }
    mysqli_close($c);
}

// Unused variable
$foo = "This is unused";

// Hardcoded credentials
$password = "admin123";

// Deprecated function
$now = split(":", "12:00");

// No PHPDoc or type hinting
class User {
    public $name;
    public $email;

    function getData() {
        return $this->name . " " . $this->email;
    }
}

?>
