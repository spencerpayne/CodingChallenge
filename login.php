<?php
// hidden database parameters, gets them from .env file
$env = parse_ini_file('.env');
$host = $env["host"];
$dbname = $env["dbname"];
$user = $env["user"];
$pass = $env["pass"];

// connect to database and use db credentials
$db = pg_connect("host=$host dbname=$dbname user=$user password=$pass");
if (!$db) {
    echo "Error : Unable to open database\n";
} else {
    // get user input
    $username = $_GET["username"];
    $password = $_GET["password"];

    // gets hashed password from table and sees if it matches for provided username
    $query = "SELECT password FROM users WHERE username = $1";
    $result = pg_query_params($db, $query, array($username));

    if (!$result) {
        echo "Error : Unable to fetch user data\n";
    } else {
        // check if table has data and checks 
        if (pg_num_rows($result) == 1) {
            $row = pg_fetch_assoc($result);
            $hashed_password_db = $row['password'];

            // check if password matches the hashed password
            if (password_verify($password, $hashed_password_db)) {
                // if passwords match, login is successful and give user ability to logout
                echo "<div style='text-align: center;'>";
                echo "<p>User login successful</p>";
                echo '<form action="logout.php" method="post" style="margin-top: 20px;">
                          <input type="submit" value="Log Out">
                      </form>';
                echo "</div>";
            } else {
                // if password is incorrect or user is not in table
                echo "<div style='text-align: center;'>";
                echo "<p style='color: red;'>Invalid username or password</p>";
                echo "</div>";
            }
        }
    }
}
