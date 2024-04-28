<?php
// Start the session
session_start();

// Unset all of the session variables
$_SESSION = [];

// Destroy the session
session_destroy();

// Redirect to a login page or any other appropriate page
header("Location: index.html");
exit();
?>
