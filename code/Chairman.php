<?php
    $conn = mysqli_connect("localhost", "root", "","database");

    if(!$conn){
        die("Connection Error");
    }
    $query = "SELECT Student_ID , Student_Name From Student";
    $result = mysqli_query($conn,$query);

 

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
    <h1>Welcome new <br> Student Data</h1>
        <div class = "headContainer">
            <div class = "row mt-5">
                <div class = "col">
                <div class = "card mt-5">
                    <div class = "card-header">
                        <div class = "mainContainer">
</div>
    <div class = "card-body"></div>
    <table class="table table-bordered text-center">
        <tr class="bg-dark text-white">
            <td>Student ID</td>
            <td>Student Name</td>
            <td>Approval</td>
            <td>Disapproval</td>
        </tr>
        <tr>
            <?php
            while($row = mysqli_fetch_assoc($result))
            {

            ?>
                <td><?php echo $row['Student_ID']?></td>
                <td><a href="redirectToDetails"><?php echo $row['Student_Name']?></td>
                <td><a href="a" class="=btn btn-danger">Approve</a></td> 
                <td><a href="a" class="=btn btn-primary">Disapprove</a></td>
            
        
                
        </tr>
        <?php
        }
    ?>
    </table>
</div>
</div>
      
      </div>
      </div>      <!-- Sign up link -->
            
             
            </p>

        </div>

    </form>

<script>
  function redirectToDetails() {
    window.location.href = "Details.php";
  }
  
</script>

</body>

</html>