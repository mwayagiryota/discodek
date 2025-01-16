<?php
// Start the session
session_start();

$_SESSION = array();

// Removing tthe session cookie
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-42000, '/');
}

// Destroy the session
session_destroy();

// Redirecting to login page
header('Location: admin_login.php');
exit();
?>