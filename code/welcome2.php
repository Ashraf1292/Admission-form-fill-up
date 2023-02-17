<?php
// Start a session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    // Redirect the user to the login page
    header('Location: login2.php');
    exit();
}

// Get the user's email from the session
$email = $_SESSION['email'];

// Display a welcome message
echo "Welcome, $email! You have been successfully signed in.";

// Provide a link to log out
echo "<p><a href='logout2.php'>Log out</a></p>";
?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="login2.css">

</head>

<body>
    <h1>Welcome new</h1>
    
      
            <!-- Sign up link -->
            
                  <p class="register">You have been successfully signed in, <?php if(isset($student_email)) { echo $student_email; } ?>
               
               <a href="#" onclick="redirectToSignUp1()">Now You Can Login!</a>
               <br>
            

            </p>

        </div>

    </form>
<script>
  function redirectToSignUp() {
    window.location.href = "Login-1.php";
  }
  
</script>

</body>

</html>