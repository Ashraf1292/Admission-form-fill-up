<?php
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

// Get the form data and save to database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $student_name = $_POST["student_name"];
  $mobile = $_POST["mobile"];
  $date = $_POST["date"];
  $subject = $_POST["subject"];
  $session = $_POST["session"];

  $sql = "INSERT INTO Student (Student_ID,Student_Name, Mobile, Date, Subject, Session)
  VALUES ('12','$student_name', '$mobile', '$date', '$subject', '$session')";

  if ($conn->query($sql) === TRUE) {
    echo "Student record created successfully<br>";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $f_name = $_POST["f_name"];
  $f_mobile = $_POST["f_mobile"];
  $f_profession = $_POST["f_profession"];
  $f_income = $_POST["f_income"];

  $sql = "INSERT INTO Father (Student_ID,F_Name, F_Mobile, F_Profession, F_Income)
  VALUES ('12', '$f_name', '$f_mobile', '$f_profession', '$f_income')";

  if ($conn->query($sql) === TRUE) {
    echo "Father record created successfully<br>";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $m_name = $_POST["m_name"];
  $m_mobile = $_POST["m_mobile"];

  $sql = "INSERT INTO Mother (Student_ID,M_Name, M_Mobile)
  VALUES ('12','$m_name', '$m_mobile')";

  if ($conn->query($sql) === TRUE) {
    echo "Mother record created successfully<br>";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $village = $_POST["village"];
  $post_office = $_POST["post_office"];
  $sub_district = $_POST["sub_district"];
  $district = $_POST["district"];
  $pa_mobile = $_POST["pa_mobile"];

  $sql = "INSERT INTO Permanent_Address (Student_ID,Village, Post_Office, Sub_District, District, Pa_Mobile)
  VALUES ('12','$village', '$post_office', '$sub_district', '$district', '$pa_mobile')";

  if ($conn->query($sql) === TRUE) {
    echo "Permanent Address record created successfully<br>";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $ssc_grade = $_POST["ssc_grade"];
  $hsc_grade = $_POST["hsc_grade"];

  $sql = "INSERT INTO Exam_Details (Student_ID,SSC, HSC)
  VALUES ('12','$ssc_grade', '$hsc_grade')";

  if ($conn->query($sql) === TRUE) {
    echo "Exam Details record created successfully<br>";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

}

$conn->close();
?>