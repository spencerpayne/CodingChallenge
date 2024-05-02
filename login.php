<?php
$env = parse_ini_file('.env');
$host = $env["host"];
$dbname = $env["dbname"];
$user = $env["user"];
$pass = $env["pass"];

$db = pg_connect("host=$host dbname=$dbname user=$user password=$pass");
if(!$db) {
    echo "Error : Unable to open database\n";
} else {
    // Get user input
    $username = $_GET["username"];
    $password = $_GET["password"];

    // Fetch the hashed password from the database for the provided username
    $query = "SELECT password FROM users WHERE username = $1";
    $result = pg_query_params($db, $query, array($username));

    if(!$result) {
        echo "Error : Unable to fetch user data\n";
    } else {
        // Check if a row is returned
        if(pg_num_rows($result) == 1) {
            $row = pg_fetch_assoc($result);
            $hashed_password_db = $row['password'];

            // Verify the provided password against the hashed password from the database
            if(password_verify($password, $hashed_password_db)) {
                // if passwords match, login is successful
                echo "User login successful\n";
                echo '<form action="logout.php" method="post">
                  <input type="submit" value="Log Out">
                </form>';
            } else {
                // Passwords don't match, login failed
                echo "Invalid username or password";
            }
        } else {
            // User not found in the database
            echo "Invalid username or password";
        }
    }
}
?>
