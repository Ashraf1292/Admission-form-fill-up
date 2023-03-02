<?php
    // Start a session
    session_start();

    // Include the TCPDF library
    require_once('E:/xampp/htdocs/tcpdf/tcpdf.php');

    $conn = mysqli_connect("localhost", "root", "", "database");

    if (!$conn) {
        die("Connection Error");
    }

    // Get the student ID from the URL parameter
    $student_id = $_GET['student_id'];
    
$query = "SELECT Form_ID FROM Form WHERE Student_ID = '$student_id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);
$form_id = $row['Form_ID'];

// Get the approval details for the form from the Approval table
$query = "SELECT * FROM Approval WHERE Form_ID = '$form_id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$c_approval = $row['C_Approval'];
$p_approval = $row['P_Approval'];
$r_approval = $row['R_Approval'];
$ar_approval = $row['AR_Approval'];
$aaa_approval = $row['AAA_Approval'];

// Get the official sign of the official who approved the form
$query = "SELECT * FROM Officials WHERE Officials_id = '$c_approval'";
$result = mysqli_query($conn, $query);
$rowc = mysqli_fetch_assoc($result);

$query = "SELECT * FROM Officials WHERE Officials_id = '$p_approval'";
$result = mysqli_query($conn, $query);
$rowp = mysqli_fetch_assoc($result);

$query = "SELECT * FROM Officials WHERE Officials_id = '$r_approval'";
$result = mysqli_query($conn, $query);
$rowr = mysqli_fetch_assoc($result);

$query = "SELECT * FROM Officials WHERE Officials_id = '$ar_approval'";
$result = mysqli_query($conn, $query);
$rowar = mysqli_fetch_assoc($result);

$query = "SELECT * FROM Officials WHERE Officials_id = '$aaa_approval'";
$result = mysqli_query($conn, $query);
$rowaaa = mysqli_fetch_assoc($result);
    // Get the student information from the Student table
    $query = "SELECT * FROM Student WHERE Student_ID = '$student_id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

   

    // Create a new TCPDF object
   $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetCreator('Student Details');
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Student Details PDF');
$pdf->SetSubject('Student Details PDF');
$pdf->SetMargins(15, 15, 15);
$pdf->SetAutoPageBreak(true, 15);
$pdf->SetFont('times', '', 12);
$pdf->AddPage();
$img_x = 150;
$img_y = 220;
$img_w = 30;
$img_h = 4;
$pdf->Image('@'.$rowc['Signature'], $img_x, $img_y, $img_w, $img_h, '', '', '', false, 150, '', false, false, 0, false, false, false);

$img_x = 150;
$img_y = 225;
$img_w = 30;
$img_h = 4;
$pdf->Image('@'.$rowp['Signature'], $img_x, $img_y, $img_w, $img_h, '', '', '', false, 150, '', false, false, 0, false, false, false);

$img_x = 150;
$img_y = 230;
$img_w = 30;
$img_h = 4;
$pdf->Image('@'.$rowr['Signature'], $img_x, $img_y, $img_w, $img_h, '', '', '', false, 150, '', false, false, 0, false, false, false);

$img_x = 150;
$img_y = 235;
$img_w = 30;
$img_h = 4;
$pdf->Image('@'.$rowar['Signature'], $img_x, $img_y, $img_w, $img_h, '', '', '', false, 150, '', false, false, 0, false, false, false);

$img_x = 150;
$img_y = 240;
$img_w = 30;
$img_h = 4;
$pdf->Image('@'.$rowaaa['Signature'], $img_x, $img_y, $img_w, $img_h, '', '', '', false, 150, '', false, false, 0, false, false, false);
$html = '<h1>Student Information</h1>';
$html .= '<h2>Student Details</h2>';
$html .= '<table>';
$html .= '<tr><td>Student ID</td><td>'.$row['Student_ID'].'</td></tr>';
$html .= '<tr><td>Student Name</td><td>'.$row['Student_Name'].'</td></tr>';
$html .= '<tr><td>Mobile No</td><td>'.$row['Mobile'].'</td></tr>';
$html .= '<tr><td>Date of Birth</td><td>'.$row['Date'].'</td></tr>';
$html .= '<tr><td>Subject</td><td>'.$row['Subject'].'</td></tr>';
$html .= '<tr><td>Session</td><td>'.$row['Session'].'</td></tr>';
$html .= '</table>';


    $query = "SELECT * FROM Father WHERE Student_ID = '$student_id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

$html .= '<h2>Mother Details</h2>';
$html .= '<table>';
$html .= '<tr><td>Father Name</td><td>'.$row['F_Name'].'</td></tr>';
$html .= '<tr><td>Father Mobile No</td><td>'.$row['F_Mobile'].'</td></tr>';
$html .= '<tr><td>Profession</td><td>'.$row['F_Profession'].'</td></tr>';
$html .= '<tr><td>Income</td><td>'.$row['F_Income'].'</td></tr>';
$html .= '</table>';


$query = "SELECT * FROM Mother WHERE Student_ID = '$student_id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

$html .= '<h2>Mother Details</h2>';
$html .= '<table>';
$html .= '<tr><td>Mother Name</td><td>'.$row['M_Name'].'</td></tr>';
$html .= '<tr><td>Mother Mobile No</td><td>'.$row['M_Mobile'].'</td></tr>';
$html .= '</table>';


$query = "SELECT * FROM Exam_Details WHERE Student_ID = '$student_id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

$html .= '<h2>Exam Details</h2>';
$html .= '<table>';
$html .= '<tr><td>SSC Grade</td><td>'.$row['SSC'].'</td></tr>';
$html .= '<tr><td>HSC Grade</td><td>'.$row['HSC'].'</td></tr>';
$html .= '</table>';


$query = "SELECT * FROM Permanent_Address WHERE Student_ID = '$student_id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

$html .= '<h2>Permanent Address</h2>';
$html .= '<table>';
$html .= '<tr><td>Student Name</td><td>'.$row['Village'].'</td></tr>';
$html .= '<tr><td>District</td><td>'.$row['District'].'</td></tr>';
$html .= '<tr><td>Sub-District</td><td>'.$row['Sub_District'].'</td></tr>';
$html .= '<tr><td>Post Office</td><td>'.$row['Post_Office'].'</td></tr>';
$html .= '<tr><td>Permanent Address Mobile No.</td><td>'.$row['Pa_Mobile'].'</td></tr>';
$html .= '</table>';
$html .= '<h2>Signatures </h2>';
$html .= '<table>';
$html .= '<tr><td>Chairman</td><td>'.$rowc['Officials_Name'].'</td></tr>';
$html .= '<tr><td>Provost</td><td>'.$rowp['Officials_Name'].'</td></tr>';
$html .= '<tr><td>Registrar</td><td>'.$rowr['Officials_Name'].'</td></tr>';
$html .= '<tr><td>Assistant Registrar</td><td>'.$rowar['Officials_Name'].'</td></tr>';
$html .= '<tr><td>Admission Associate Assistant</td><td>'.$rowaaa['Officials_Name'].'</td></tr>';
$html .= '</table>';

$pdf->writeHTML($html, true, false, true, false, '');

$pdf->Output('Student_Details.pdf', 'D');
?>
