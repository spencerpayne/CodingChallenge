<?php
$host = "localhost";
$dbname = "codingchallenge";
$user = "jpayne";
$pass = "payne";

$db = pg_connect("host=$host dbname=$dbname user=$user password=$pass");
if(!$db) {
    echo "Error : Unable to open database\n";
} else {
    // Get user input
    $username = $_GET["username"];
    $email = $_GET["email"];
    $password = $_GET["password"];

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare a parameterized query
    $stmt = pg_prepare($db, "insert_query", "INSERT INTO users (username, email, password) VALUES ($1, $2, $3)");

    // Execute the query with user input as parameters
    $result = pg_execute($db, "insert_query", array($username, $email, $hashed_password));

    if(!$result) {
        echo "Error : Unable to register user\n";
        echo pg_last_error($db); // Print PostgreSQL error message
    } else {
        echo "User registered successfully\n";
        // Redirect to a success page or login page
        // header("Location: success.php");
        // exit();
    }
}
?>
