<?php
    // Start a session
    session_start();

    // Connect to the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "database";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the form has been submitted
    if(isset($_POST['submit'])) {
        // Get the form data
        $email = $_POST['email'];
        $pass = $_POST['password'];

        // Query to check if the email and password match
        $sql = "SELECT * FROM Student WHERE Student_Email='$email' AND Student_Password='$pass'";
        $result = $conn->query($sql);

        // If the query returns a result, it means that the email and password match
        if ($result->num_rows > 0) {
            // Store the email in a session variable
            $_SESSION['email'] = $email;
            // Redirect to the welcome page
            header("Location: welcome.html");
        } else {
            // If the email and password do not match, display an error message
            echo "Wrong email or password. Try again.";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="login2.css">

</head>

<body>
    <h1>Sign In</h1>
    <form action="" method="post">
        <!-- Headings for the form -->
        <div class="headingsContainer">
            <h3>Log In</h3>
            <p>Log in with your email and password</p>
        </div>

        <!-- Main container for all inputs -->
        <div class="mainContainer">
            <!-- Email input -->
              <label for="email">Your Email</label>
            <input type="text" placeholder="Enter Email" name="email" required>

            <br><br>

            <!-- Password input -->
            <label for = "password">Your Password</label>
            <input type="password" name="password" placeholder="Password">
            <br><br>
            <!-- Submit button -->
            <button type="submit" name="submit" value="Sign In">Submit</button>
        </div>
    </form>
</body>

</html>