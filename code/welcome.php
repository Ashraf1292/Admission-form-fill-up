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
    <h1>Welcome new</h1>
    
      
            <!-- Sign up link -->
            
                  <p class="register">You have been successfully logged in, <?php if(isset($student_name)) { echo $student_name; } ?>
               <a href="#" onclick="redirectToSignUp1()">Check Status!</a>
               <br>
               <a href="#" onclick="redirectToSignUp()">Fill-up Form!</a>

            </p>

        </div>

    </form>
<script>
  function redirectToSignUp() {
    window.location.href = "form7.php";
  }
   function redirectToSignUp1() {
    window.location.href = "status.html";
  }
</script>

</body>

</html>