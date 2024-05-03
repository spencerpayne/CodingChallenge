<?php
//database connection
$env = parse_ini_file(__DIR__ . '/../private/.env');
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
        echo "Error registering user\n";    // error handling
        echo pg_last_error($db); // Print PostgreSQL error message
    } else {
        echo "User registered successfully\n";
        exit();
    }
}
