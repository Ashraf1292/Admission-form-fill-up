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
    if(isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
        $sql = "SELECT * FROM Student WHERE Student_Email='$email'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $student_name = $row['Student_Name'];
            }
        }
    }
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="login2.css">

</head>

<body>
    <h1>Congratulations!</h1>
    
      
            <!-- Sign up link -->
            
                  <p class="register">Your form have been successfully submitted, <?php if(isset($email)) { echo $email; } ?>
               
               
               <br>
            

            </p>

        </div>

    </form>


</body>

</html>