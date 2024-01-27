

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/carousel.css">


    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.108.0">

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/headers/">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/footers/">


<style>

  .texttt{
    font-size: 150px;
    margin-top: 200px;
    text-align: center;
    width: 100% !important;
  }
  @media (max-width:1000px) {
    .texttt{font-size: 70px; ;}
  
}
  .opa {
    opacity: 45%;

  }
  .hi{
    height: 600px;
  }


.content {
  box-shadow: 7px 5px 16px 20px  #212529;

    margin-top: 147px;
    margin-bottom: 130px;
    border-radius: 42px;
    border-color: #4d7dad;
    border-style: solid;
    margin-right: auto;
    margin-left: auto;
    text-align: center;
    height:fit-content;
    padding: 30px 0px;
    width: 100%;
    background-color: #dde3e1;
  }

  

  .div2{
    
      text-shadow: #4f5995 1px 0 10px;
      font-family:Georgia, 'Times New Roman', Times, serif; 
      font-weight:bolder; 
      font-size: 50px; 
      width: 100%;
   
  
  }
#myCarousel{

 width: 100%;


}
#myCarousel img{

width: 100%;

}
.ved{
  margin-top: 100px;
  margin-bottom: 20px;
}


</style>

   
    <title>Home</title>
</head>
<body>

      
<main>
      <header class="p-3 text-bg-dark">
        <div class="container">
          <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
              <img src="Logo.PNG" alt="Logo" width="50" height="50" class="me-2">
              <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
            </a>
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
              <li><a href="Home.php" class="nav-link px-2 text-secondary fw-bold fs-4">Home</a></li>
              <li><a href="Rules.php" class="nav-link px-3 text-secondary fw-bold fs-4">​​​Traffic violations and penalties regulations</a></li>

          <?php
            session_start();

          if (isset($_SESSION['username'])) {
            // Show logout and profile buttons
          echo '<a href="Profile.php"><button type="button" class="btn btn-danger me-3">Profile</button></a>';
          echo '<a href="logout.php"><button type="button" class="btn btn-danger me-3">Log out</button></a>';
          } else {
           // Show login and signup buttons
          echo '<a href="Login.php"><button type="button" class="btn btn-danger me-3">Log in</button></a>';
          echo ' <a href="Signup.php"><button type="button" class="btn btn-danger ">Sign up</button></a>';
          }
          ?>
                
            </div>
          </div>
        </header>
      
      </main>
      


<!-- 
-------------------------------- -->



<main>

  <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>

    
    </div>
    
    <div class="carousel-inner">

      <div class="carousel-item active hi">

          <img src="car1.jpg" class="bd-placeholder-img opa"  width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
      </div>
      <div class="carousel-item hi">

        <img src="car2.jpg" class="bd-placeholder-img opa"  width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
      </div>
      

      <div class="carousel-item hi" > 
        <img src="car3.jpg"  class="bd-placeholder-img opa"  width="100%" height="100%"  xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
      </div>

     
     

      <div >
        <p class=" texttt px-2 text-secondary fw-bold ">Vehicle Detection</p>
    </div>






  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>


    <div class="content row featurette  ">

<div class="col-md-4 order-md-1">
  <video class="ved" id="background-video" autoplay loop muted poster="https://assets.codepen.io/6093409/river.jpg">
    <source src="Automatic Vehicle Detection_2.mp4" type="video/mp4">
    </video>
</div>
      
    

<div class="col-md-8 order-md-2 featurette-heading  lh-1  ">

        <p class="div2"> Best In Traffic Violation Detection<hr>
        <h4> YOU CAN FIND OUT THE VIOLATIONS OF YOUR VEHICLE</h4>  </p>
       

        
</div>




      
    </div>
    <P class=" featurette-heading  lh-2 ">

      
    
    </P>
   
  </main>










  <footer class=" row py-3  text-bg-dark ">
          
    <div class="col mx-5 my-5 col-lg-4">
      <div class="links">
        <h5 class="text-light">About</h5>
        <ul class="list-unstyled lh-lg text-white-50">
         <li> Government Check Abnormal Behaviors</li>
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
