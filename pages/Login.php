<?php

session_start();
if (isset($_SESSION['success_msg'])) {
  echo $_SESSION['success_msg'];
  unset($_SESSION['success_msg']); // unset the session variable to prevent it from being displayed again on refresh
}
// Database configuration
$servername = "localhost";
$username = "root";
$password = "123";
$database = "vehicledetection";

$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form input exists
if (isset($_POST['nationalid']) && isset($_POST['password'])) {
  // Retrieve form input
  $NationalID = $_POST['nationalid'];
  $Password = $_POST['password'];

  // Check if login credentials match hardcoded value for testing purposes
  if ($NationalID == '00000000000000' && $Password == '0000') {
    // Redirect to Detection-Page.html
      // Start a session and store relevant user information
      $_SESSION['NationalID'] = $NationalID;
      $_SESSION['Password'] = '0000'; 
      // Redirect to Detection-Page.php using a relative path
    $path = 'Vehicle_Data.php';
    header("Location: " . $path);
    exit();
  } else {
      // Query the database
      $sql = "SELECT * FROM driver WHERE NationalID = '$NationalID'";
      $result = $conn->query($sql);

      if ($result && $result->num_rows == 1) {
          $row = $result->fetch_assoc();
          $hashedPassword = $row['HashedPassword']; // Updated to use the hashed password column

          // Verify the password
          if (password_verify($Password, $hashedPassword)) {
              // Start a session and store relevant user information
              $_SESSION['NationalID'] = $row['NationalID'];
              $_SESSION['user_id'] = $row['user_id'];
              $_SESSION['username'] = $row['UserName'];
              $_SESSION['plate'] = $row['PlateNumber'];
              $_SESSION['number'] = $row['PhoneNumber'];

              // Redirect to a success page
              header("Location: Profile.php");
              exit();
          } else {
              echo "Invalid password.";
          }

      } else {
          echo "User not found.";
      }
  }
}

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

    




    <title>UserLogin</title>
</head>
<body class="text-center">

      
<main>      
        <header class="p-3 text-bg-dark">
          <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
              <img src="Logo.PNG" alt="Logo" width="50" height="50" class="me-2">
             
      
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="Home.php" class="nav-link px-3 text-secondary fw-bold fs-4" >Home</a></li>
                <li><a href="Rules.php" class="nav-link px-3 text-secondary fw-bold fs-4">​​​Traffic violations and penalties regulations</a></li>


              </ul>
      
          
      
               
              <a href="Signup.php">
                <button type="button" class="btn btn-danger me-3" >Create New Account</button>
            </a>
    
            </div>
          </div>
        </header>
      
      </main>
      

    
      <div class="formm d-flex justify-content-center">
      <form class="form mb-5" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
          <div class="mb-3">
            <label for="nationalid" class="form-label">
              <i class="fa fa-id-card fw-bold" aria-hidden="true"></i> National ID
            </label>
            <input type="text" class="form-control" id="nationalid" name="nationalid" aria-describedby="nationalIDHelp" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">
              <i class="fa fa-unlock-alt fw-bold" aria-hidden="true"></i> Password
            </label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>
          <button type="submit" class="btn btnn fw-bold ml-5 fs-5">Log in</button>
          <a class="btn btnn fw-bold ml-5 fs-5" href="forgetpassword.php" role="button">Forget Password</a>

            </a>
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

</body>
</html>

<?php
// Display error message if login was unsuccessful
if (isset($error)) {
    echo $error;
}

?>