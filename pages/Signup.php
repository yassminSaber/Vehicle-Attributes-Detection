<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "123";
$database = "vehicledetection";

// Create a new MySQLi instance
$connection = new mysqli($servername, $username, $password, $database);






// Check the connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Include the PHPMailer library
use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\Exception; 

require 'C:/xampp/htdocs/GradProject/Pages/PHPMailer/src/Exception.php'; 
require 'C:/xampp/htdocs/GradProject/Pages/PHPMailer/src/PHPMailer.php'; 
require 'C:/xampp/htdocs/GradProject/Pages/PHPMailer/src/SMTP.php'; 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $nationalId = $_POST["nationalid"];
    $plateNumber = $_POST["plate"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    // You should perform validation and sanitization of the input values here
    // Get the hashed password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare the SQL statement to check if the email already exists in the database
    $checkEmailSql = "SELECT Email FROM driver WHERE Email = '$email'";
    $result = $connection->query($checkEmailSql);

    if ($result->num_rows > 0) {
        // Email already exists in the database
        echo "Error: Email already exists in the database";
    } else {
        $verificationCode = mt_rand(100000, 999999);
        $_SESSION['verification_code'] = $verificationCode;
    
    
    
            
            // Generate a verification code and store it in a session variable
            $verificationCode = mt_rand(100000, 999999);
            session_start();
            $_SESSION['email'] = $email;
            $_SESSION['nationalId'] = $nationalId;
            $_SESSION['plateNumber'] = $plateNumber;
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;

            $_SESSION['hashedPassword'] = $hashedPassword;

            $_SESSION['verification_code'] = $verificationCode;

            // Create a new PHPMailer instance and configure it with your email server settings
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Your SMTP server hostname
            $mail->SMTPAuth = true;
            $mail->Username = 'rawanehab124@gmail.com'; // Your SMTP username
            $mail->Password = 'affvwnktampvmtup'; // Your SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Set the email message properties
            $mail->setFrom('rawanehab124@gmail.com', 'Vehicle Detection System');
            $mail->addAddress($email);
            $mail->Subject = 'Verification Code for Vehicle Detection System';
            $mail->Body = 'Your verification code is: ' . $verificationCode;

            // Send the email
            try {
                $mail->send();
                // Email sent successfully, redirect to the verification-code.php page
                header("Location: verification-code.php");
                exit();
            } catch (Exception $e) {
                // Email failed to send, display an error message
                echo 'Error: Email could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
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
    <link rel="stylesheet" href="css/signup.css">

    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/footer.css">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.108.0">

    <link rel="stylesheet" href="css/all.min.css"> 
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@1,400;1,800&family=Roboto+Slab:wght@700&family=Roboto:ital,wght@0,100;0,300;0,400;1,300&display=swap" rel="stylesheet">
    <title>Signup</title>
    <style>
        @media (max-width:1000px) {
  input{
    width: 100% !important;
  }
}
input{
  width: 400px ;
}






    </style>
</head>
<body>
    <main>      
        <header class="p-3 text-bg-dark">
            <div class="container">
                <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <img src="Logo.PNG" alt="Logo" width="50" height="50" class="me-2">
                    <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                        <li><a href="Home.php" class="nav-link px-2 text-secondary fw-bold fs-4">Home</a></li>
                    </ul>
                    <a href="Login.php">
                        <button type="button" class="btn btn-danger">Log in</button>
                    </a>
                </div>
            </div>
        </header>
    </main>
     
    <div class="formm d-flex justify-content-center ">
        <div id="error"></div>
        <form id="form" name="form1" action="Signup.php" method="POST">

            <div class="mb-3">
                <label for="email" class="form-label"><i class="fa fa-user"  aria-hidden="true"></i>Email</label>
                <input id="email" name="email" type="email" class="form-control" placeholder="Enter your email" required>            
            </div>
            <div class="mb-3">
                <label for="username" class="form-label"><i class="fa fa-user"  aria-hidden="true"></i>Username</label>
                <input id="username" name="username" type="text" class="form-control" placeholder="Enter a Username"  required>
            </div>
            <div class="mb-3">
                <label for="id" class="form-label"> <i class="fa fa-id-card fw-bold" aria-hidden="true"></i> National ID</label>
                <input id="id" name="nationalid" type="text" class="form-control" placeholder="Enter Your NationalId" required>
            </div>
            <div class="mb-3">
                <label for="platnum" class="form-label"> <i class="far fa-window-maximize fw-bold" aria-hidden="true"></i> Plate Number</label>
                <input id="platnum" name="plate" type="text" class="form-control" placeholder="Enter Your PlateNumber" required>
            </div>
            <!-- <div class="mb-3">
                <label for="number" class="form-label"> <i class="fas fa-phone fw-bold" aria-hidden="true"></i> Phone Number</label>
                <input id="number" name="number" type="tel" class="form-control" placeholder="Enter Your PhoneNumber" required>
            </div> -->
            <div class="mb-3">
                <label for="password" class=" form-label "> <i class="fa fa-unlock-alt fw-bold" aria-hidden="true"></i> Password</label>
                <input id="password" name="password" type="password" class="form-control" placeholder="Enter your password" required>
            </div>
            <div class="mb-3">
                <label for="password2" class="form-label"><i class="fa fa-unlock-alt fw-bold" aria-hidden="true"></i> Confirm password</label>
                <input id="password2" name="password2" type="password" class="form-control" placeholder="Confirm your password" required>
            </div>
            <button type="submit" class="btn btnn fw-bold fs-4" >Sign Up</button>

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

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://www.gstatic.com/firbasjs/8.3.1/firbase.js"> </script>

    <script src="firbase-connection.js"> </script>
    <script src="firebase.js" type="text/javascript"> </script>
    <script src="js/js.js"></script>
    <script>
        document.getElementById('form').addEventListener('submit', function(event) {
            var nationalIDInput = document.getElementById('id');
            var nationalIDValue = nationalIDInput.value;

            var phoneNumberInput = document.getElementById('number');
            var phoneNumberValue = phoneNumberInput.value;

            // Remove any previous error messages
            var errorDiv = document.getElementById('error');
            errorDiv.innerHTML = '';

            // Validate National ID
            if (nationalIDValue.length !== 14 || isNaN(nationalIDValue)) {
                event.preventDefault(); // Prevent form submission

                // Display error message for National ID
                var errorMessage = document.createElement('div');
                errorMessage.classList.add('alert', 'alert-danger');
                errorMessage.textContent = 'National ID should be exactly 14 numbers.';
                errorDiv.appendChild(errorMessage);

                // Add invalid class to the input field
                nationalIDInput.classList.add('is-invalid');
           
            }

            // Validate Phone Number
            var phoneRegex = /^\d{11}$/;
            if (!phoneRegex.test(phoneNumberValue)) {
                event.preventDefault(); // Prevent form submission

                // Display error message for Phone Number
                var errorMessage = document.createElement('div');
                errorMessage.classList.add('alert', 'alert-danger');
                errorMessage.textContent = 'Phone Number should be a 11-digit number.';
                errorDiv.appendChild(errorMessage);

                // Add invalid class to the input field
                phoneNumberInput.classList.add('is-invalid');
                
            }
        
        });
    </script>
</body>
</html>

<?php
  // Close the database connection
  $connection->close();
// Display error message if login was unsuccessful
if (isset($error)) {
    echo $error;
}

?>