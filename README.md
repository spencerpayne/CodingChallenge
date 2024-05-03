ngrok http --domain=suitable-burro-ghastly.ngrok-free.app 10.0.0.158:80
https://suitable-burro-ghastly.ngrok-free.app/CodingChallenge/

Create an .env file in a folder called private.
Should have the format:
host = ""\
dbname = ""
user = ""
pass = ""

Technology Stack:
- Database: PostgreSQL
- Backend: PHP

Functionality:
This program utilizes a PostgreSQL database for data storage and PHP for the backend operations.

Features:
1. User Signup:
   - Users can sign up with a username, email, and password.
   - It ensures that the username or email have not been used already. If they have, it throws an error.

2. User Login:
   - After creating an account, users can log in using the newly created credentials.
   - The login process requires the username and password, but not the email.

Database Details:
- Data is stored in a database named `codingchallenge`.
- The user information is stored in a table called `users`.
- The table has the following columns:
  - `username`
  - `email`
  - `password` (hashed for security)
