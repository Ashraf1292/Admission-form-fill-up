<?php
    // Start a session
    session_start();

    $conn = mysqli_connect("localhost", "root", "", "database");

    if (!$conn) {
        die("Connection Error");
    }

    // Get the logged-in user's email
    $email = $_SESSION['email'];

    // Get the logged-in user's role and hall from the Officials table
    $query = "SELECT Officials_Role, Hall FROM Officials WHERE Officials_Email = '$email'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $role = $row['Officials_Role'];
    $hall = $row['Hall'];

    // Get the student ID, name, and form ID from the Student and Form tables whose subject matches the provost's hall
    if ($role == "Provost") {
       $query = "SELECT Student.Student_ID, Student.Student_Name, Form.Form_ID 
          FROM Student 
          INNER JOIN Form ON Student.Student_ID = Form.Student_ID 
          INNER JOIN Approval ON Form.Form_ID = Approval.Form_ID 
          WHERE Approval.C_Approval = 'YES' 
          AND Approval.P_Approval IS NULL 
          AND EXISTS (SELECT * FROM Officials WHERE Officials.Officials_Role = 'Chairman' AND Officials.Hall = '$hall')";
$result = mysqli_query($conn, $query);
    }
	
	  echo "<p><a href='logout.php'>Log out</a></p>";

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Chairman</title>
    <link rel="stylesheet" href="login2.css">
</head>

<body class="bg-dark">
    <h1>Welcome Provost <br> Student Data</h1>
    <div class="headContainer">
        <div class="row mt-5">
            <div class="col">
                <div class="card mt-5">
                    <div class="card-header">
                        <div class="mainContainer"></div>
                    </div>
                    <div class="card-body">
<!-- HTML table to display the student information -->
<table class="table table-bordered text-center">
    <tr class="bg-dark text-white">
        <td>Student ID</td>
        <td>Student Name</td>
        <td>Form ID</td>
        <td>Approval</td>
        <td>Disapproval</td>
    </tr>
    <?php
        while ($row = mysqli_fetch_assoc($result)) {
    ?>
    <tr>
                                <td><a href='details.php?student_id=<?php echo $row['Student_ID']?>'><?php echo $row['Student_ID']?></a></td>
                                <td><?php echo $row['Student_Name']?></td>
                                <td><?php echo $row['Form_ID']?></td>
                                <td>
                                    <form method="post">
                                        <input type="hidden" name="student_id" value="<?php echo $row['Student_ID']?>">
                                        <input type="hidden" name="approval" value="YES">
                                        <input type="submit" value="Approve" class="btn btn-danger">
                                    </form>
                                </td>
                                <td>
                                    <form method="post">
                                        <input type="hidden" name="student_id" value="<?php echo $row['Student_ID']?>">
                                        <input type="hidden" name="approval" value="NO">
                                        <input type="submit" value="Disapprove" class="btn btn-danger">
                                    </form>
                                        </td>
                                    </tr>
    <?php
        }
    ?>
</table>






                    </div>
                </div>
            </div>
        </div>
        <!-- Sign up link -->
       
    </div>
  
  <?php
// Update the Approval table with approval status
if (isset($_POST['approval'])) {
    $student_id = $_POST['student_id'];
    $approval = $_POST['approval'];
    $form_id_query = "SELECT Form_ID FROM Form WHERE Student_ID = '$student_id'";
    $form_id_result = mysqli_query($conn, $form_id_query);
    $form_id_row = mysqli_fetch_assoc($form_id_result);
    $form_id = $form_id_row['Form_ID'];
   $update_query = "UPDATE Approval SET P_Approval = '$officials_id' WHERE Form_ID = {$form_id}";
   

if (mysqli_query($conn, $update_query)) {
    echo "Record inserted successfully";
	header('Location: ' . $_SERVER['PHP_SELF']);
} else {
    echo "Error inserting record: " . mysqli_error($conn);
}
}
if (isset($_POST['disapproval'])) {
    $student_id = $_POST['student_id'];
    $disapproval = $_POST['disapproval'];
    $form_id_query = "SELECT Form_ID FROM Form WHERE Student_ID = '$student_id'";
    $form_id_result = mysqli_query($conn, $form_id_query);
    $form_id_row = mysqli_fetch_assoc($form_id_result);
    $form_id = $form_id_row['Form_ID'];
    $officials_id_query = "SELECT Officials_ID FROM Officials WHERE Officials_Email = '$email'";
    $officials_id_result = mysqli_query($conn, $officials_id_query);
    $officials_id_row = mysqli_fetch_assoc($officials_id_result);
    $officials_id = $officials_id_row['Officials_ID'];
    $insert_query = "INSERT INTO Approval (Form_ID, C_Approval) VALUES ('$form_id', '$disapproval')";
    
    
if (mysqli_query($conn, $insert_query)) {
    echo "Record inserted successfully";
	header('Location: ' . $_SERVER['PHP_SELF']);
} else {
    echo "Error inserting record: " . mysqli_error($conn);
}
}


    // Redirect to the same page to update the table
 
?>

</body>
</html>

