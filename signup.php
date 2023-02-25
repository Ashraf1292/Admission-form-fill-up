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
        $candidate_id =$_SESSION['candidate_ID']= $_POST['candidate_ID'];
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $cpass = $_POST['cpassword'];
        $name = $_POST['name'];

        // Query to check if the candidate ID exists in the database
        $check_query = "SELECT * FROM Candidate WHERE Candidate_ID = '$candidate_id'";

        // Execute the query
        $check_result = $conn->query($check_query);
        // Check if the candidate ID exists in the database
        if ($check_result->num_rows > 0) {
            // Query to save the email and password in the database
            if($pass == $cpass){
                $insert_query = "INSERT INTO login (Candidate_id, Name ,Email, Password) VALUES ('$candidate_id','$name','$email', '$pass')";
                
                // Execute the query
                if ($conn->query($insert_query) === TRUE) {
                    // Set the user's email in the session
                    session_start();
                    $_SESSION['name'] = $name;

                    // Redirect the user to the welcome page
                    header("Location: welcomeSignin.php");
                    exit();
                } else {
                    echo "Error: " . $insert_query . "<br>" . $conn->error;
                }
            }
            else {
                echo "Passwords didn't match";
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
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Sign Up</h1>
    <form action="" method="post">
        <!-- Headings for the form -->
        <div class="headingsContainer">
            <h3>If you don't have an account already</h3>
            <p>Sign in with candidate id, your email and password</p>
        </div>

        <!-- Main container for all inputs -->
        <div class="mainContainer">
            <!-- Candidate ID input -->
            <label for="candidate_ID">Your Candidate ID</label>
            <input type="text" placeholder="Enter Candidate ID" name="candidate_ID" required>
            <label for="email">Your Name</label>
            <input type="text" placeholder="Enter Your Name" name="name" required>
            <!-- Email input -->
            <label for="email">Your Email</label>
            <input type="text" placeholder="Enter Email" name="email" required>

            <br><br>

            <!-- Password input -->
            <label for="password">Your Password</label>
            <input type="password" name="password" placeholder="Password">
            <br><br>
            <label for="password">Retype your Password</label>
            <input type="password" name="cpassword" placeholder="Password">
            <br><br>


            <!-- Submit button -->
            <button type="submit" name="submit" value="Sign In">Submit</button>
        </div>
    </form>
	<p><center><a href="#" onclick="redirectToSignUp4()">Home Page</a></center></p>

    <script>
  function redirectToSignUp4() {
    window.location.href = "HomePage.php";
  }
</script>
</body>

</html>
