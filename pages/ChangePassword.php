<?php
session_start();

if (!isset($_SESSION['NationalID'])) {
    header("Location: Login.php");
}

if (isset($_SESSION['message'])) {
    echo "<div>" . $_SESSION['message'] . "</div>";
    unset($_SESSION['message']);
}


$servername = "localhost";
$username = "root";
$password = "123123";
$database = "vehicledetection";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $currentPassword = trim($_POST['current-password']);
    $newPassword = trim($_POST['new-password']);
    $confirmPassword = trim($_POST['confirm-password']);

    // Check if the new password and confirm password fields match
    if ($newPassword !== $confirmPassword) {
        $_SESSION['message'] = "New password and confirm password fields must match.";
        header("Location: ChangePassword.php");
        exit;
    }

    // Get the current user's NationalID from the session
    $nationalID = $_SESSION['NationalID'];

    // Retrieve the current user's information from the database
    $sql = "SELECT * FROM driver WHERE NationalID = '$nationalID'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        // Fetch the row data as an associative array
        $row = $result->fetch_assoc();

        // Check if the current password entered by the user matches the stored password hash
        if (password_verify($currentPassword, $row['HashedPassword'])) {
            // Hash the new password and update the user's record in the database
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $updateSql = "UPDATE driver SET Password = '$newPassword', hashedPassword = '$hashedPassword' WHERE NationalID = '".$_SESSION['NationalID']."'";
            if ($conn->query($updateSql) === TRUE) {
                $_SESSION['message'] = "Password updated successfully.";
                header("Location: Profile.php");

            } else {
                $_SESSION['message'] = "Error updating password: " . $conn->error;
                header("Location: ChangePassword.php");
            }
        } else {
            $_SESSION['message'] = "Current password is incorrect.";
            header("Location: ChangePassword.php");
        }
    } else if ($result->num_rows === 0) {
        $_SESSION['message'] = "User not found.";
        header("Location: ChangePassword.php");
    } else {
        $_SESSION['message'] = "Multiple users found with the same NationalID.";
        header("Location: ChangePassword.php");
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/login.css">

    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/all.min.css">

    <link rel="stylesheet" href="css/footer.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@1,400;1,800&family=Roboto+Slab:wght@700&family=Roboto:ital,wght@0,100;0,300;0,400;1,300&display=swap" rel="stylesheet">
        


    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.108.0">

    




    <title>Verification-Code</title>
</head>
<body class="text-center">

      
      <main>      
        <header class="p-3 text-bg-dark">
          <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <img src="Logo.PNG" alt="Logo" width="50" height="50" class="me-2">
      
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="Home.php" class="nav-link px-3 text-secondary fw-bold fs-4" >Home</a></li>

              </ul>
            </div>
          </div>
        </header>
      
      </main>
      

    
      


  <div class="formm d-flex justify-content-center">
        <form class="form mb-5" action="ChangePassword.php" method="post">
        <h1 style="margin-left: 50px;">Change Password</h1>


        <div class="mb-3">
  <label for="current-password">Current Password:</label>
  <input type="password" class="form-control" id="current-password" name="current-password">
</div>

<div class="mb-3">
  <label for="new-password">New Password:</label>
  <input type="password" class="form-control" id="new-password" name="new-password">
</div>
<div class="mb-3">
  <label for="confirm-password">Confirm Password:</label>
  <input type="password" class="form-control" id="confirm-password" name="confirm-password">
</div>
        
    
          <button type="submit" class="btn btnn fw-bold ml-5 fs-5">Change Password</button>
        </form>
      </div>
      
        <footer class=" row py-3  text-bg-dark ">
          
          <div class="col mx-5 my-5 col-lg-4">
            <div class="links">
              <h5 class="text-light">About</h5>
              <ul class="list-unstyled lh-lg text-white-50">
               <li> Government Checking Abnormal Behaviors</li>
              </ul>
            </div>
            </div>

            <div class="col mx-5 my-5 col-lg-2">
             <div class="links">
               <h5 class="text-light">Contact US</h5>
               <ul class="list-unstyled lh-lg text-white-50">
               <li> Telephone: +20 2 27955566 </li>
               <li> Telefax: +20 2 27955564 </li>
               <li>mft@mft.gov.eg </li>
               </ul>
             </div>
            </div>
            <div class="col mx-5 my-5 col-lg-2">
      <div class="links">
        <h5 class="text-light">Follow Us</h5>
        <ul class="list-unstyled lh-lg text-white-50">
          <li><a href="https://www.mot.gov.eg/"><i class="fab fa-mot fa-lg me-2"></i>Ministry of Transportation</a></li>
          <li><a href="https://www.linkedin.com/company/ministry-of-transport---egypt/"><i class="fab fa-linkedin fa-lg me-2"></i>LinkedIn</a></li>
          <li><a href="https://www.youtube.com/channel/UCQohChyiu_oOOxA6WOFY-jQ"><i class="fab fa-youtube fa-lg me-2"></i>YouTube</a></li>
          <li><a href="https://www.facebook.com/MinistryTransportation/?locale=ar_AR"><i class="fab fa-facebook fa-lg me-2"></i>Facebook</a></li>
        </ul>
      </div>
    </div>
            
        </footer>
      



    <script src="js/bootstrap.bundle.min.js"> </script>
    
    <script src="js/js.js"> </script>
    <script src="https://www.gstatic.com/firbasjs/8.3.1/firbase.js"> </script>

    <script src="firbase-connection.js"> </script>
    <script src="firebase.js" type="text/javascript"> </script>

</body>
</html>