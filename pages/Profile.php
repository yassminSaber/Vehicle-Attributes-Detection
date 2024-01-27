<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/profile.css">

    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/all.min.css">

    <link rel="stylesheet" href="css/footer.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@1,400;1,800&family=Roboto+Slab:wght@700&family=Roboto:ital,wght@0,100;0,300;0,400;1,300&display=swap" rel="stylesheet">

    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.108.0">

    <title>Profile</title>

    <style>
        .result {
            text-shadow: #4f5995 1px 0 10px;
            font-family: Georgia, 'Times New Roman', Times, serif;
            font-weight: bolder;
            font-size: 40px;
            margin-left: 140px;
        }

        .img-account-profile {
  border-radius: 50%;
  width: 300px; /* change this value to adjust the size of the photo */
  height: 300px;
  object-fit: cover; /* ensure the photo fills its container without stretching */
}

   
    </style>
</head>
<body class="text-center">

<?php
        // Initialize the session
        session_start();
        if (!isset($_SESSION['NationalID'])) {
            header("Location: Login.php"); // Redirect to login page if not logged in
                }

if (isset($_SESSION['message'])) {
    echo "<div>" . $_SESSION['message'] . "</div>";
    unset($_SESSION['message']);
}

        // Database configuration
        $servername = "localhost";
        $username = "root";
        $password = "123123";
        $database = "vehicledetection";
        
        // Create a connection to the database
        $conn = new mysqli($servername, $username, $password, $database);
        
        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        if(isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0){

            // Get the uploaded file's name, type, size, and temporary location
            $fileName = $_FILES['profile_picture']['name'];
            $fileType = $_FILES['profile_picture']['type'];
            $fileSize = $_FILES['profile_picture']['size'];
            $tmpName = $_FILES['profile_picture']['tmp_name'];
    
            // Check if the uploaded file is an image of type JPEG or PNG
            $allowed = array('jpeg', 'png');
            $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            if(in_array($fileExt, $allowed)){
        
                // Generate a unique file name for the uploaded image
                $newFileName = uniqid('', true) . '.' . $fileExt;
        
                // Set the path to save the uploaded image file
                $uploadPath = 'uploads/' . $newFileName;
        
                // Save the uploaded image file to the designated folder
                if(move_uploaded_file($tmpName, $uploadPath)){
                     // Update the user's profile information in the database to include the path to the saved image
            $sql = "UPDATE driver SET ProfilePicture='$uploadPath' WHERE NationalID='".$_SESSION['NationalID']."'";
            if ($conn->query($sql) === TRUE) {
                echo "Profile picture updated successfully.";
            } else {
                echo "Error updating profile picture: " . $conn->error;
            }

        } else{
            echo "Error uploading file.";
        }

    } else{
        echo "Invalid file type. Only JPEG and PNG images are allowed.";
    }

}


        // Retrieve user information from the database
        $sql = "SELECT * FROM driver WHERE NationalID = '".$_SESSION['NationalID']."'";
        
        $result = $conn->query($sql);
        
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
        ?>
        
        <!-- Display user information on the profile page -->
    
        
        <?php
        } else {
            echo "User not found.";
        }
        ?>
    
    <main>
        <header class="p-3 text-bg-dark">
            <div class="container">
                <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                    <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <img src="Logo.PNG" alt="Logo" width="50" height="50" class="me-2">
                        <li><a href="Home.php" class="nav-link px-3 text-secondary fw-bold fs-4">Home</a></li>
                        <li><a href="Rules.html" class="nav-link px-3 text-secondary fw-bold fs-4">​​​Traffic violations and penalties regulations</a></li>
                    </ul>
                    <a href="logout.php">
                <button type="button" class="btn btn-danger me-3"  >Log out</button>
                </a>   
                <a href="ChangePassword.php">
                    <button type="button" class="btn btn-danger">Change Password</button>
                </a>
                
                </div>
            </div>
        </header>
    </main>

    <section class="bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mb-4 mb-sm-5">
                <div class="card card-style1 border-0">
                    <div class="card-body p-1-9 p-sm-2-3 p-md-6 p-lg-7">
                        <div class="row align-items-center">
                            <div class="row">
                            <div class="col-xl-5">
                                        <!-- Profile picture card-->
                                        <div class="card mb-4 mb-xl-0">
                                            <div class="card-body text-center">
                                            <!-- Profile picture image-->
                                            <img class="img-account-profile  mb-2 " src="<?php echo $row['ProfilePicture']; ?>" alt="">
                                            <!-- Profile picture upload form-->
                                            <form method="post" enctype="multipart/form-data">
                                                <input type="file" name="profile_picture">
                                                <button class="btn btn-primary mt-2" type="submit" name="save">Save</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-6 px-xl-10">
                                    <div class="">
                                        <p class="featurette-heading lh-1 my-3 result">User Information</p>
                                    </div>
                                 
<!-- Create a row with centered columns -->
<div class="row justify-content-center">
  <!-- Create a column for each piece of user information -->
  <div class="mb-2 mb-xl-3 display-28  text-center "style="margin-left:10px" >
    <span class="display-26 text-danger me-2 font-weight-600 fw-bold">Name:</span> 
    <span class="display-26  me-2 font-weight-600 fw-bold" style="color: #4f5995;"> <?php echo $row['UserName']; ?> </span> 

  </div>
  <div class="mb-2 mb-xl-3 display-28  text-center" style="margin-left:80px">
    <span class="display-26 text-danger me-2 font-weight-600 fw-bold">National ID:  </span> 
    <span class="display-26  me-2 font-weight-600 fw-bold" style="color: #4f5995;"> <?php echo $row['NationalID']; ?> </span> 

  </div>
  <div class="mb-2 mb-xl-3 display-28  text-center"style="margin-left:20px">
    <span class="display-26 text-danger me-2 font-weight-600 fw-bold">Plate Number:</span> 
    <span class="display-26  me-2 font-weight-600 fw-bold"style="color: #4f5995;"> <?php echo $row['PlateNumber']; ?> </span> 

  </div>
</div>
<div class="">
    <p class="featurette-heading lh-1 my-5 result">Traffic Violation</p>
</div>
 <ul class="list-unstyled mb-0">
    <li class="mb-2 mb-xl-3" style="margin-left: 120px;">
        <span class="display-26 text-danger me-2 font-weight-600 fw-bold" " >Violation Description:</span>
        <?php
        $sql = "SELECT * FROM violation WHERE nationalID = '".$_SESSION['NationalID']."'";
        $result = $conn->query($sql);
        
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo '<span class="display-26 me-2 font-weight-600 fw-bold" style="color: #4f5995;" >' . $row['Violation'] . '</span> 
            <br>
            <span class="display-26 text-danger me-2 font-weight-600 fw-bold " ">Price:</span> 
            <span class="display-26  me-2 font-weight-600 fw-bold" style="color: #4f5995;">' . $row['Price'] . '</span>';
             
        } else {
            echo "No Violation.";
        }
        $conn->close();
        ?>
    </li>
    </ul>
                                    

                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    <footer class="row py-3 text-bg-dark">
        <div class="col mx-5 my-5 col-lg-4">
            <div class="links">
                <h5 class="text-light">About</h5>
                <ul class="list-unstyled lh-lg text-white-50">
                    <li>Government Checking Abnormal Behaviors</li>
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
    <script src="js/js.js"></script>

</body>
</html>