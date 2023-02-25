<?php
    // Start a session
    session_start();

    $conn = mysqli_connect("localhost", "root", "", "database");

    if (!$conn) {
        die("Connection Error");
    }

    // Get the student ID from the URL parameter
    $student_id = $_GET['student_id'];

    // Get the student information from the Student table
    $query = "SELECT * FROM Student WHERE Student_ID = '$student_id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);





// Display student image


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
        /* Styling for the table */
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            text-align: center;
            padding: 8px;
        }

        th {
            background-color: #343a40;
            color: white;
        }

    
        tr:hover {
            background-color: #ddd;
        }
    </style>
<body class="bg-dark">
    <h1>Student Information</h1>
    <div class="headContainer">
        <div class="row mt-5">
            <div class="col">
                <div class="card mt-5">
                    <div class="card-header">
                        <div class="mainContainer"></div>
                    </div>
                    <div class="card-body">
                        <!-- HTML table to display the student information -->
   

                        <h2>Student Details</h2>
                        <table class="table table-bordered text-center">
                            <tr>
                                <td>Student ID</td>
                                <td><?php echo $row['Student_ID']?></td>
                            </tr>
                            <tr>
                                <td>Student Name</td>
                                <td><?php echo $row['Student_Name']?></td>
                            </tr>
                            <tr>
                                <td>Mobile No</td>
                                <td><?php echo $row['Mobile']?></td>
                            </tr>
                            <tr>
                                <td>Date of Birth</td>
                                <td><?php echo $row['Date']?></td>
                            </tr>
                            <tr>
                                <td>Subject</td>
                                <td><?php echo $row['Subject']?></td>
                            </tr>
                            <tr>
                                <td>Session</td>
                                <td><?php echo $row['Session']?></td>
                            </tr>
                            <tr>
                            </table>
                               
<?php
                                   $query = "SELECT * FROM Father WHERE Student_ID = '$student_id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    ?>
                            <h2>Father's Details</h2>   
                            <table>
                            
                            <tr>
                                <td>Father's Name</td>
                                <td><?php echo $row['F_Name']?></td>
                            </tr>
                            <tr>
                                <td>Father's Profession</td>
                                <td><?php echo $row['F_Profession']?></td>
                            </tr>
                            <tr>
                                <td>Father's Mobile</td>
                                <td><?php echo $row['F_Mobile']?></td>
                            </tr>
                            <tr>
                                <td>Father's Income</td>
                                <td><?php echo $row['F_Income']?></td>
                            </tr>
                            </table>

      <?php
                                   $query = "SELECT * FROM Mother WHERE Student_ID = '$student_id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    ?>
                                                     
                            <h2>Mother's Details</h2>   
                            <table>
                            <tr>
                                <td>Mother's Name</td>
                                <td><?php echo $row['M_Name']?></td>
                            </tr>
                            
                            <tr>
                                <td>Mother's Mobile</td>
                                <td><?php echo $row['M_Mobile']?></td>
                            </tr>
                            </table>

<?php
                                   $query = "SELECT * FROM Exam_Details WHERE Student_ID = '$student_id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    ?>
                            <h2>Exam Details</h2>   
                            <table>
                            <tr>
                                <td>SSC Grade</td>
                                <td><?php echo $row['SSC']?></td>
                            </tr>
                            <tr>
                                <td>HSC Grade</td>
                                <td><?php echo $row['HSC']?></td>
                            </tr>
                           </table>
                           <?php
                                   $query = "SELECT * FROM Permanent_Address WHERE Student_ID = '$student_id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    ?>
                        
                            <h2> Permanent Address</h2>

                            <table>
                            <tr>
                                <td>Village</td>
                                <td><?php echo $row['Village']?></td>
                            </tr>
                            <tr>
                                <td>District</td>
                                <td><?php echo $row['District']?></td>
                            </tr>
                            <tr>
                                <td>Sub-District</td>
                                <td><?php echo $row['Sub_District']?></td>
                            </tr>
                            <tr>
                                <td>Post Office</td>
                                <td><?php echo $row['Post_Office']?></td>
                            </tr>
                            <tr>
                                <td>Permanent Address Mobile No.</td>
                                <td><?php echo $row['Pa_Mobile']?></td>
                            </tr>
                                </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <a href="generate_pdf.php?student_id=<?php echo $student_id; ?>">Download PDF</a>

</body>
</html>