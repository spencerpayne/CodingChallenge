<?php
//database connection
$env = parse_ini_file('.env');
$host = $env["host"];
$dbname = $env["dbname"];
$user = $env["user"];
$pass = $env["pass"];

$db = pg_connect("host=$host dbname=$dbname user=$user password=$pass");    // connect to db
if (!$db) {
    echo "Error : Unable to open database\n";
} else {
    // get input from user
    $username = $_GET["username"];
    $email = $_GET["email"];
    $password = $_GET["password"];

    // hashes the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // prepare the query
    $stmt = pg_prepare($db, "insert_query", "INSERT INTO users (username, email, password) VALUES ($1, $2, $3)");

    // execute the query with user input, inserts new user into the table
    $result = pg_execute($db, "insert_query", array($username, $email, $hashed_password));

    if (!$result) {
        // If there's an error registering the user
        echo "<div style='text-align: center;'>";
        echo "<p style='color: red;'>Error registering user</p>";
        echo "<p style='color: red;'>" . pg_last_error($db) . "</p>";
        echo "<a href='index.html'>Return to Home</a>";
        echo "</div>";
    } else {
        // If the user is registered successfully
        echo "<div style='text-align: center;'>";
        echo "<p>User registered successfully</p>";
        echo "<a href='index.html'>Return to Home</a>";
        echo "</div>";
        exit(); // Exit to prevent further execution
    }
}
