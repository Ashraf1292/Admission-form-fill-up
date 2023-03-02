<?php
    session_start();
    $conn = mysqli_connect("localhost", "root", "", "database");

    if (!$conn) {
        die("Connection Error");
    }

    // Get student ID from the Login table
    $email = $_SESSION['email'];
    $query = "SELECT Account_ID FROM Login WHERE Email = '$email'";
    $result = mysqli_query($conn, $query);
    $rowacc = mysqli_fetch_assoc($result);
    $account_id = $rowacc['Account_ID'];

    // Get corresponding student ID from the Student table
    $query = "SELECT Student_ID FROM Student WHERE Account_ID = '$account_id'";
    $result = mysqli_query($conn, $query);
    $rowstu = mysqli_fetch_assoc($result);
    
    
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


    <h1>Form Status</h1>

  <p><center>
<?php
      
    // Check if student exists before retrieving the student_id
    if ($rowstu) {

        $student_id = $rowstu['Student_ID'];

        // Get corresponding form ID from the Form table
        $query = "SELECT Form_ID FROM Form WHERE Student_ID = '$student_id'";
        $result = mysqli_query($conn, $query);
        $rowf = mysqli_fetch_assoc($result);

        // Check if form exists before retrieving the form_id
        if ($rowf) {

            $form_id = $rowf['Form_ID'];

            // Get the status of the form from the Approval table
            $query = "SELECT * FROM Approval WHERE Form_ID = '$form_id'";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            // Display status based on form approval status
            if($row){

                if(!($row['C_Approval'] == 'NO' || $row['P_Approval'] == 'NO' || $row['R_Approval'] == 'NO' || $row['AR_Approval'] == 'NO' || $row['AAA_Approval'] == 'NO') ) 
                {

                    if($row['AAA_Approval'] != NULL){
                        echo "Your Form Has Been Approved. <a href='generate_pdf.php?student_id=" . $student_id . "'target=''status.pdf'>Click here to download PDF</a>";
                    }
                    else{
                        echo "Pending";
                    }
                }
                else{
                    echo "Your Form Has Been Disapproved";
                }

            }
  

        }
  }
  else
  {
    echo"Your Form Has Not Been Submitted";


  }

  
  
?>
  
  
  
  
  </center>
  </p>

	<p><a href='status.php'>Click here to download PDF</a></p>
    <p><a href='logout2.php'>Log out</a></p>

</body>

</html>