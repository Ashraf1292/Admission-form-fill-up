<?php
// Start a session
session_start();

// Check if the user is logged in

// Get the user's email from the session
$name = $_SESSION['name'];

// Display a welcome message with the email
// Provide a link to log out
echo "<p><a href='logout2.php'>Log out</a></p>";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <h1>Welcome</h1>
    
      
            <!-- Sign up link -->
            
                  <p class="register">You have been successfully signed up <?php if(isset($name)) { echo $name; } ?>
               
               <a href="#" onclick="redirectToSignUp1()">Now You Can Login!</a>
               <br>
            

            </p>

        </div>

    </form>
<script>
  function redirectToSignUp1() {
    window.location.href = "StudentLogin.php";
  }
  
</script>

</body>

</html>