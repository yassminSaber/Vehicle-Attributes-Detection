<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Check if a video file was uploaded
  if (!empty($_FILES['videoFile']['name'])) {
    // Check if the file is a valid video file
    $allowedTypes = array('mp4', 'avi', 'mov');
    $fileParts = pathinfo($_FILES['videoFile']['name']);
    $fileExt = strtolower($fileParts['extension']);
    if (in_array($fileExt, $allowedTypes)) {
      // Move the uploaded file to a permanent location
      $filePath = 'uploads/' . $_FILES['videoFile']['name'];
      move_uploaded_file($_FILES['videoFile']['tmp_name'], $filePath);
      // $filePath = '/upload' . $_FILES['video']['name'];
      // move_uploaded_file($_FILES['video']['tmp_name'], $filePath);
    
      // Handle the response from the Flask API
      if ($response == 'Video uploaded successfully.') {
        echo 'Video uploaded successfully.';
      } else {
        echo 'Error uploading video: ' . $response;
      }

      // Insert the location, vehicle type, and filename into the database
      $location = $_POST['location'];
      $vehicleType = $_POST['vehicleType'];
      $video = $_FILES['videoFile']['name'];
      $date = $_POST['date'];
      $time = $_POST['time'];
    
      //header('Location: Detection-Page.php');
  exit();

      // Connect to the database (replace with your own details)
      $servername = 'localhost';
      $username = 'root';
      $password = 'your_password';
      $dbname = 'vehicledetection';

      $conn = mysqli_connect($servername, $username, $password, $dbname);
      if (!$conn) {
        die('Connection failed: ' . mysqli_connect_error());
      }

      $sql = "INSERT INTO video (location, vehicletype, video, date, time) VALUES ('$location', '$vehicleType', '$video', '$date' , '$time')";

      if (mysqli_query($conn, $sql)) {
        echo 'Video uploaded successfully.';
      } else {
        echo 'Error uploading video: ' . mysqli_error($conn);
      }

      mysqli_close($conn);
    } else {
      echo 'Invalid file type. Please upload an MP4, AVI, or MOV file.';
    }
  } else {
    echo 'Please select a file to upload.';

  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="{{ url_for('static', filename='detection.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url_for('static', filename='bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url_for('static', filename='nav.css') }}">



    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.108.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@1,400;1,800&family=Roboto+Slab:wght@700&family=Roboto:ital,wght@0,100;0,300;0,400;1,300&display=swap" rel="stylesheet">
        

<title>Detection</title>

<style>

  .inpved{

    margin-right: 594px;
    margin-bottom: 310px;

  }

.inpp{
  width: 300px;
  margin-left: 630px;
}


</style>

</head>
<body >

      
<main>
      
      <header class="p-3 text-bg-dark">
        <div class="container">
          <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">

            <img src="{{ url_for('static', filename='images/logo.png') }}" alt="Logo" width="50" height="50" class="me-2">

            
              <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
            </a>
    
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
              <li><a href="Home.php" class="nav-link px-2 text-secondary fw-bold fs-4">Home</a></li>
              <li><a href="Detection-Page.php" class="nav-link px-2 text-white fw-bold fs-4">Detection</a></li>
              <li><a href="Vehicle_Data.php" class="nav-link px-2 text-white fw-bold fs-4">Data</a></li>

            </ul>
               
            <a href="logout.php">
                <button type="button" class="btn btn-danger me-3"  >Log out</button>

                </a>
          
          </div>
        </div>
      </header>
    
    </main>


      <video id="background-video">
        <source src="{{ url_for('static', filename='videos/carsss.mp4') }}" type="video/mp4" controls>
        </video>
      <div >
        <p  style=" margin-top:150px ; margin-left:550px ; font-family:Georgia, 'Times New Roman', Times, serif;" class="fw-bold fs-1 "> Upload Video To Detect Vehicles </p>

      </div>

      <div class=" d-flex justify-content-center   " style="margin-bottom: 50px;">


      <form action="/upload" method="post" enctype="multipart/form-data">
  <div class="inpp" style="margin-right:550px">
    <label for="location" class="form-label fw-bold" style="font-family:Georgia, 'Times New Roman', Times, serif;">Enter the Location:</label>
    <input type="text" class="form-control" id="location" name="location" required>
    <br>
    <label for="vehicleType" class="form-label fw-bold mt-2" style="font-family:Georgia, 'Times New Roman', Times, serif;">Enter the Vehicle Type:</label>
    <input type="text" class="form-control" id="vehicleType" name="vehicleType" required>
    <label for="date" class="form-label fw-bold" style="font-family:Georgia, 'Times New Roman', Times, serif;">Date :</label>
    <input type="date" class="form-control" id="date" name="date">
    <label for="time" class="form-label fw-bold" style="font-family:Georgia, 'Times New Roman', Times, serif;">Time :</label>
    <input type="time" class="form-control" id="time" name="time">
    <label for="speed" class="form-label fw-bold" style="font-family:Georgia, 'Times New Roman', Times, serif;">Speed Limit :</label>
    <input type="text" class="form-control" id="speed" name="speed">
    <br>
  </div>
  <div style="margin-left:500px">
    <label for="videoFile" class="form-label fw-bold" style="font-family:Georgia, 'Times New Roman', Times, serif;">Select a Video File:</label>
    <input type="file" class="form-control" id="videoFile" name="video" style="width: 500px;" accept="video/*"><br>
  </div>
  <button class="btn btn-light" type="submit" style="background-color: rgb(25 68 112 / 75%); color:aliceblu; margin-left:750px;">Upload</button>
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
    <script>
    $(document).ready(function() {
  $('form').submit(function(e) {
    e.preventDefault();
    $.ajax({
      url: 'Detection-Page.php',
      type: 'POST',
      data: new FormData(this),
      processData: false,
      contentType: false,
      success: function(data) {
        $('#message').text(data);
      },
      error: function(xhr, textStatus, errorThrown) {
        $('#message').text('Error uploading video.');
      }
    });
  });
});




</script>
</body>
</html>