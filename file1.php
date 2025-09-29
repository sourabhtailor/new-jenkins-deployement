<?php
// test-insecure.php — for static-analysis only (do NOT deploy)

// 1) deprecated API usage that many rules flag
// Sonar rules often flag mysql_* usage as deprecated/unsafe
$connection = mysql_connect('localhost', 'user', 'pass'); // flagged: deprecated mysql extension
mysql_query("SELECT * FROM users"); // flagged

// 2) insecure pattern (tainted input used without sanitization)
// Static analyzers flag use of unsanitized data in critical APIs
$tainted = $_GET['user_input'];
echo "User says: " . $tainted; // possible XSS in web context (static analyzers note)
