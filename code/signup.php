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
        $candidate_id = $_POST['candidate_ID'];
        $email = $_POST['email'];
        $pass = $_POST['password'];

        // Query to check if the candidate ID exists in the database
        $check_query = "SELECT * FROM Candidate WHERE Candidate_ID = '$candidate_id'";

        // Execute the query
        $check_result = $conn->query($check_query);

        // Check if the candidate ID exists in the database
        if ($check_result->num_rows > 0) {
            // Query to save the email and password in the database
            $insert_query = "INSERT INTO login (Email, Password) VALUES ('$email', '$pass')";
            
            // Execute the query
            if ($conn->query($insert_query) === TRUE) {
                // Set the user's email in the session
                $_SESSION['email'] = $email;

                // Redirect the user to the welcome page
                header("Location: welcomeSignin.php");
                exit();
            } else {
                echo "Error: " . $insert_query . "<br>" . $conn->error;
            }
        } else {
            echo "Invalid Candidate ID";
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
            <h3>Sign In</h3>
            <p>Sign in with candidate id, your email and password</p>
        </div>

        <!-- Main container for all inputs -->
        <div class="mainContainer">
            <!-- Candidate ID input -->
            <label for="candidate_ID">Your Candidate ID</label>
            <input type="text" placeholder="Enter Candidate ID" name="candidate_ID" required>

            <!-- Email input -->
            <label for="email">Your Email</label>
            <input type="text" placeholder="Enter Email" name="email" required>

            <br><br>

            <!-- Password input -->
            <label for="password">Your Password</label>
            <input type="password" name="password" placeholder="Password">
            <br><br>

            <!-- Submit button -->
            <button type="submit" name="submit" value="Sign In">Submit</button>
        </div>
    </form>
</body>

</html>
