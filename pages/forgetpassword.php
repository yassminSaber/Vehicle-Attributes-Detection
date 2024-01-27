<?php 
use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\Exception; 
require 'c:/xampp/htdocs/GradProject/Pages/PHPMailer/src/Exception.php'; 
require 'c:/xampp/htdocs/GradProject/Pages/PHPMailer/src/PHPMailer.php'; 
require 'c:/xampp/htdocs/GradProject/Pages/PHPMailer/src/SMTP.php'; 

// Database configuration 
$servername = "localhost"; 
$username = "root"; 
$password = "123"; 
$database = "vehicledetection"; 

//Create an instance; passing `true` enables exceptions 
$mail = new PHPMailer(true); 

if(isset($_POST['verifynum'])) {
  $email = $_POST['verifynum'];
  
  // Connect to database
  $conn = new mysqli($servername, $username, $password, $database);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Check if email exists in database and retrieve password
  $sql = "SELECT Password FROM driver WHERE Email='$email'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $password = $row['Password'];
    
    try {
      //Server settings 
      $mail->isSMTP(); //Send using SMTP 
      $mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through 
      $mail->SMTPAuth = true; //Enable SMTP authentication 
      $mail->Username = 'rawanehab124@gmail.com'; //SMTP username (your Outlook.com email address) 
      $mail->Password = 'affvwnktampvmtup'; //SMTP password (the app password you generated) 
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged 
      $mail->Port = 587; //TCP port to connect to 

      //Recipients 
      $mail->setFrom('rawanehab124@gmail.com', 'Vehicle Detection System'); 
      $mail->addAddress($email); //Add a recipient 

      //Content 
      $mail->isHTML(true); //Set email format to HTML 
      $mail->Subject = 'Your Password'; 
      $mail->Body = 'Your password is: <b>' . $password . '</b>'; 
      $mail->AltBody = 'Your password is: ' . $password; 

      $mail->send(); 
      
      header("Location: Login.php");

    } catch (Exception $e) { 
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"; 
    } 
  } else {
    echo 'Email address not found in database.';
  }
  
  $conn->close();
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






    <title>Password Resset</title>
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
      
          
      
               
              <a href="Login.php">
                <button type="button" class="btn btn-danger me-3" >Log in</button>
            </a>
    
            </div>
          </div>
        </header>
        </main> 


<section class="log">
        <div class="formm d-flex flex-column align-items-center">
          <h1 class="text-center mb-4">Forgot Password?</h1>
          <form class="form-signin" method="POST">
            <div class="form-group">
              <label for="inputEmail" class="form-label mb-2">Enter your Email Address</label>
              <input type="email" id="inputEmail" name="verifynum" class="form-control mb-3" placeholder="Email address" required autofocus>
              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

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
    
    <script src="js/js.js"> </script>
</body> 
</html>