<?php
    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "database";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    if(isset($_SESSION['name'])) {
        $name = $_SESSION['name'];
    }
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
    <h1>Congratulations!</h1>
    
      
            <!-- Sign up link -->
            
                  <p class="register">Your form have been successfully submitted, <?php if(isset($name)) { echo $name; } ?>
               
               
               <br>
            

            </p>

        </div>

    </form>


</body>

</html>