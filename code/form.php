<?php
   session_start();
 $email = $_SESSION['email'];
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "database";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
  echo $_SESSION['email'];
// Get the form data and save to database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_SESSION['email'];
  $student_name = $_POST["student_name"];
  $mobile = $_POST["mobile"];
  $subject = $_POST["subject"];
  $session = $_POST["session"];
  
  $query = "SELECT Account_ID FROM LOGIN WHERE Email = '$email'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($result);
  $account_id = $row['Account_ID'];

  $sql = "INSERT INTO `student` (`Student_ID`, `Student_Name`, `Student_Email`, `Session`, `Subject`, `Date`, `Mobile`, `Account_ID`) VALUES (NULL, '$student_name', '$email', '$session', '$subject', current_timestamp(), '$mobile', '$account_id');";

  if ($conn->query($sql) === TRUE) {
    echo "Student record created successfully<br>";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  } 
  $query = "SELECT Student_ID FROM STUDENT WHERE Student_Email = '$email'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($result);
  $student_id = $row['Student_ID'];

  $f_name = $_POST["f_name"];
  $f_mobile = $_POST["f_mobile"];
  $f_profession = $_POST["f_profession"];
  $f_income = $_POST["f_income"];

 $sql = "INSERT INTO Father (Student_ID, F_Name, F_Mobile, F_Profession, F_Income)
        VALUES ('$student_id', '$f_name', '$f_mobile', '$f_profession', '$f_income')";



  if ($conn->query($sql) === TRUE) {
    echo "Father record created successfully<br>";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

    $query = "SELECT Student_ID FROM Student WHERE Student_Email = '$email'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$student_id = $row['Student_ID'];


  $m_name = $_POST["m_name"];
  $m_mobile = $_POST["m_mobile"];

  $sql = "INSERT INTO Mother (Student_ID,M_Name, M_Mobile)
  VALUES ('$student_id','$m_name', '$m_mobile')";

  if ($conn->query($sql) === TRUE) {
    echo "Mother record created successfully<br>";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

    $query = "SELECT Student_ID FROM Student WHERE Student_Email = '$email'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$student_id = $row['Student_ID'];


  $village = $_POST["village"];
  $post_office = $_POST["post_office"];
  $sub_district = $_POST["sub_district"];
  $district = $_POST["district"];
  $pa_mobile = $_POST["pa_mobile"];

  $sql = "INSERT INTO Permanent_Address (Student_ID,Village, Post_Office, Sub_District, District, Pa_Mobile)
  VALUES ('$student_id','$village', '$post_office', '$sub_district', '$district', '$pa_mobile')";

  if ($conn->query($sql) === TRUE) {
    echo "Permanent Address record created successfully<br>";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

    $query = "SELECT Student_ID FROM Student WHERE Student_Email = '$email'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$student_id = $row['Student_ID'];


  $ssc_grade = $_POST["ssc_grade"];
  $hsc_grade = $_POST["hsc_grade"];

  $sql = "INSERT INTO Exam_Details (Student_ID,SSC, HSC)
  VALUES ('$student_id','$ssc_grade', '$hsc_grade')";

  if ($conn->query($sql) === TRUE) {
    echo "Exam Details record created successfully<br>";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  // Get the Student ID for the current student
$query = "SELECT Student_ID FROM Student WHERE Student_Email = '$email'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$student_id = $row['Student_ID'];

// Add a new entry to the Form table
$sql = "INSERT INTO Form (Form_ID, Student_ID) VALUES (NULL, '$student_id')";
if ($conn->query($sql) === TRUE) {
  echo "Form record created successfully<br>";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

// Redirect to Welcome4.php page after successful form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (!$conn->error) {
    header("Location: welcomeForm.php");
    exit();
  }
}


}

$conn->close();
?>