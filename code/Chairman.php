<?php
    // Start a session
    session_start();

    $conn = mysqli_connect("localhost", "root", "", "database");

    if (!$conn) {
        die("Connection Error");
    }

    // Get the chairman's department from the Officials table
    $email = $_SESSION['email'];
    $query = "SELECT department FROM Officials WHERE Officials_Email = '$email' AND Officials_Role = 'Chairman'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $department = $row['department'];

    // Get the student ID, name, and form ID from the Student and Form tables whose subject matches the chairman's department
$query = "SELECT Student.Student_ID, Student.Student_Name, Form.Form_ID FROM Student INNER JOIN Form ON Student.Student_ID = Form.Student_ID WHERE Student.Subject = '$department'";
    $result = mysqli_query($conn, $query);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Chairman</title>
    <link rel="stylesheet" href="style.css">
</head>

<body class="bg-dark">
    <h1>Welcome new <br> Student Data</h1>
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
                                <td><?php echo $row['Student_ID']?></td>
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
    $insert_query = "INSERT INTO Approval (Form_ID, C_Approval) VALUES ('$form_id', '$approval')";
if (mysqli_query($conn, $insert_query)) {
    echo "Record inserted successfully";
} else {
    echo "Error inserting record: " . mysqli_error($conn);
}
}


    // Redirect to the same page to update the table
 
?>

</body>
</html>

