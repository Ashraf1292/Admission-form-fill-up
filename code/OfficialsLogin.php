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
        $email = $_POST['officialemail'];
        $password = $_POST['officialpassword'];
        $role = $_POST['role'];

        // Query to check if the email and password match
        $sql = "SELECT * FROM Officials WHERE Officials_Email = '$email' AND Officials_Password = '$password' AND Officials_Role = '$role'";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // If the query returns a result, it means that the email and password match

            // Set session variables
            $_SESSION['role'] = $role;
            $_SESSION['email'] = $email;

            // Redirect based on role
            switch ($role) {
                case "chairman":
                    header("Location: chairman.php");
                    exit();
                    break;
                case "provost":
                    header("Location: provost.php");
                    exit();
                    break;
                case "registrar":
                    header("Location: registrar.php");
                    exit();
                    break;
                case "assistant registrar":
                    header("Location: assistant_registrar.php");
                    exit();
                    break;
                case "admission associate assistant":
                    header("Location: admission_associate_assistant.php");
                    exit();
                    break;
                default:
                    echo "Invalid role";
                    break;
            }
        } else {
            echo "Invalid email or password";
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
  <a href="#" onclick="redirectToSignUp4()">Home Page</a>

    <script>
  function redirectToSignUp4() {
    window.location.href = "HomePage.php";
	
  }
  </script>
    <h1>Official's Log In</h1>
    <form action="" method="post">
        <!-- Headings for the form -->
        <div class="headingsContainer">
            <h3>Log In</h3>
            <p>Log in with your email and password</p>
        </div>

        <!-- Main container for all inputs -->
        <div class="mainContainer">
            <!-- Email input -->
            <label for="role">Role:</label>

            <select name="role" id="role">
                <option value="chairman">Chairman</option>
                <option value="provost">Provost</option>
                <option value="registrar">Registrar</option>
                <option value="assistant registrar">Assistant Registrar</option>
                <option value="admission associate assistant">Admission Associate Assistant</option>
            </select>

            <br>
            <br>

            <label for="officialemail">Your Email</label>
            <input type="text" placeholder="Enter Email" name="officialemail" required>

            <br>
            <br>

            <!-- Password input -->
           
            <label for = "officialpassword">Your Password</label>
            <input type="password" name="officialpassword" placeholder="Password">
            <br><br>
            <!-- Submit button -->
            <button type="submit" name="submit" value="Sign In">Submit</button>
        </div>
    </form>
</body>

</html>