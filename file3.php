<?php

class User {
    private $name;
    private $email;

    public function __construct($name, $email) {
        // Bug: No validation or sanitization
        $this->name = $name;
        $this->email = $email;
    }

    public function getProfile() {
        // Bug: Potential XSS vulnerability (unescaped output)
        return "<h1>$this->name</h1><p>Contact: $this->email</p>";
    }

    public function unusedFunction() {
        // Bug: Dead code - unused function
        return "This function is never called.";
    }
}

$user = new User($_GET['name'], $_GET['email']);
echo $user->getProfile();
?>
