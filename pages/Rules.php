<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/Rules.css">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@1,400;1,800&family=Roboto+Slab:wght@700&family=Roboto:ital,wght@0,100;0,300;0,400;1,300&display=swap" rel="stylesheet">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.108.0">

    <title>   Traffic violations and penalties regulations</title>

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
.col-md-4{
padding: 50px 10px !important;
margin-top: -50px !important;
}
  
    </style>
</head>
<body class="text-center">
  <main>
        <header class="p-3 text-bg-dark">
            <div class="container">
                <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                    <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <img src="logo.png" alt="Logo" width="50" height="50" class="me-2">
                        <li><a href="Home.php" class="nav-link px-3 text-secondary fw-bold fs-4">Home</a></li>
                        <li><a href="Rules.php" class="nav-link px-3 text-secondary fw-bold fs-4">   Traffic violations and penalties regulations</a></li>
                    </ul>
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
    <div class="paragraph">
        <h2> General traffic violations and penalties regulations</h2>
        <p>Traffic violations and penalties regulations establish rules and consequences for maintaining safe and orderly traffic flow on roads.</p>
        <div class="row p-2 text-center">
            

        <div class="col-md-4">

                <div class="card cardView" id="speeding" style="min-height: 600px;  padding:20px 10px;">
                    <img src="speed.jpg" class="card-img-top rounded-circle" style="width: 50% !important;  margin-right: auto; margin-left: auto; height:200px ; margin-top:10px; margin: bottom 30px;">
                    <div class="card-body">
                        <h3 class="card-title">Speeding</h3>
                        <p class="card-text scroller">Exceeding the designated speed limit is considered a traffic violation. Penalties may include fines ranging from EGP 300 to EGP 1,500, and the suspension of the driving license for a specified period.</p>
                    </div>
                </div>

            </div>

            <div class="col-md-4">

<div class="card cardView" id="Color" style="min-height: 600px;  padding:20px 10px;">
    <img src="color1.jpg" class="card-img-top rounded-circle"style="width: 50%;  margin-right: auto; margin-left: auto; height:200px ; margin-top:10px; margin: bottom 30px;">
    <div class="card-body">
        <h3 class="card-title">Color</h3>
        <p class="card-text scroller">Modifying the color of a vehicle without obtaining the necessary authorization or failing to update the vehicle's registration documents is considered a violation. Penalties for unauthorized color changes can include fines and potential legal consequences.</p></div>
</div>

</div>
<div class="col-md-4">
                <div class="card cardView" id="Damage" style="min-height: 600px;  padding:20px 10px;">
                    <img src="damage.jpg" class="card-img-top rounded-circle" style="width: 50%;  margin-right: auto; margin-left: auto; height:200px ; margin-top:10px; margin: bottom 30px;">
                    <div class="card-body">
                        <h3 class="card-title">Damage Status</h3>
                        <p class="card-text scroller ">It's illegal and unsafe to drive a vehicle with significant damage that affects its safety, structural integrity, or roadworthiness. This violates traffic regulations and poses risks to everyone on the road. Penalties and regulations may vary, but it's generally not allowed in Egypt.

</p></div>
                </div>
            </div>
            </div>

            <div class="row p-2 text-center">

            <div class="col-md-4">
                <div class="card cardView" id="Type" style="min-height: 600px;  padding:20px 10px;">
                    <img src="type.jpg" class="card-img-top rounded-circle"style="width: 50%;  margin-right: auto; margin-left: auto; height:200px ; margin-top:10px; margin: bottom 30px;">
                    <div class="card-body">
                        <h3 class="card-title">Type</h3>
                        <p class="card-text scroller">Using a vehicle that is not permitted on a specific road or in a designated area can result in penalties. This may include driving large trucks or heavy commercial vehicles on roads designated for smaller vehicles, or driving motorcycles or bicycles on roads where they are prohibited.</p></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card cardView" id="RedLight" style="min-height: 600px;  padding:20px 10px;">
                    <img src="red.jpg" class="card-img-top rounded-circle"style="width: 50%;  margin-right: auto; margin-left: auto; height:200px ; margin-top:10px; margin: bottom 30px;">
                    <div class="card-body">
                        <h3 class="card-title">Running a Red Light</h3>
                        <p class="card-text scroller"> Failing to stop at a red traffic signal is a violation. The penalty for running a red light can result in fines starting from EGP 500, along with the deduction of points from the driver's license.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card cardView" id="DUI" style="min-height: 600px;  padding:20px 10px;">
                    <img src="drugs.PNG" class="card-img-top rounded-circle"style="width: 50%;  margin-right: auto; margin-left: auto; height:200px ; margin-top:10px; margin: bottom 30px;"> 
                    <div class="card-body">
                        <h3 class="card-title">Driving Under the Influence</h3>
                        <p class="card-text scroller">Operating a vehicle while under the influence of alcohol or drugs is strictly prohibited. Penalties for DUI offenses can include fines starting from EGP 1,000, imprisonment, suspension of the driving license, or a combination of these punishments.</p>
                    </div>
                </div>
            </div>
            </div>
        <div class="row p-2 text-center">

            <div class="col-md-4">
                <div class="card cardView" id="Mobile"style="min-height: 600px;  padding:20px 10px;">
                    <img src="phone.jpg" class="card-img-top rounded-circle"style="width: 50%;  margin-right: auto; margin-left: auto; height:200px ; margin-top:10px; margin: bottom 30px;">
                    <div class="card-body">
                        <h3 class="card-title">Using a Mobile Phone While Driving</h3>
                        <p class="card-text scroller">Using a mobile phone without a hands-free device while driving is a traffic violation. The penalty for this offense may include fines starting from EGP 100 and the deduction of points from the driver's license.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card cardView" id="belt" style="min-height: 600px;  padding:20px 10px;">
                    <img src="belty.png" class="card-img-top rounded-circle"style="width: 50%;  margin-right: auto; margin-left: auto; height:200px ; margin-top:10px; margin: bottom 30px;">
                    <div class="card-body">
                        <h3 class="card-title">Seat Belt Violation</h3>
                        <p class="card-text scroller">Failing to wear a seat belt while driving or not ensuring that passengers are wearing seat belts is considered a violation. The penalty for not wearing a seat belt can result in fines starting from EGP 100.</p>
                    </div>
                    </div>
            </div>
            <div class="col-md-4">
                <div class="card cardView" id="Illegal" style="min-height: 600px;  padding:20px 10px;">
                    <img src="overtaking.jpg" class="card-img-top rounded-circle"style="width: 50%;  margin-right: auto; margin-left: auto; height:200px ; margin-top:10px; margin: bottom 30px;">
                    <div class="card-body">
                        <h3 class="card-title">Illegal Overtaking</h3>
                        <p class="card-text scroller">Making unsafe or illegal overtaking maneuvers is a violation. Penalties may include fines starting from EGP 500, deduction of points from the driver's license, and in some cases, temporary license suspension.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row p-2 text-center">

            <div class="col-md-4">
                <div class="card cardView " id="Liscence" style="min-height: 600px;  padding:20px 10px;">
                    <img src="liscence.png" class="card-img-top rounded-circle"style="width: 50%;  margin-right: auto; margin-left: auto;height:200px ; margin-top:10px; margin: bottom 30px;">
                    <div class="card-body">
                        <h3 class="card-title">Driving without a Valid License</h3>
                        <p class="card-text scroller">Operating a motor vehicle without a valid driver's license is an offense. The penalty for driving without a license may involve fines starting from EGP 1,000 and potential vehicle confiscation.</p></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card cardView" id="parking" style="min-height: 600px;  padding:20px 10px;">
                    <img src="parking.PNG" class="card-img-top rounded-circle"style="width: 50%;  margin-right: auto; margin-left: auto; height:200px ; margin-top:10px; margin: bottom 30px;" />
                    <div class="card-body">
                        <h3 class="card-title">Parking Violations</h3>
                        <p class="card-text scroller "> Parking in restricted zones, blocking traffic, or parking in a manner that obstructs other vehicles or pedestrians is considered a violation. Penalties for parking violations can range from fines starting from EGP 200 to EGP 1,000, and the vehicle may be towed or impounded.</p></div>
         </div>
            </div>
        <div class="col-md-4">
            <div class="card cardView" id="Overloading" style="min-height: 600px;  padding:20px 10px;">
                <img src="over.jpg" class="card-img-top rounded-circle"style="width: 50%;  margin-right: auto; margin-left: auto; height:200px ; margin-top:10px; margin: bottom 30px;">
                <div class="card-body">
                    <h3 class="card-title">Overloading</h3>
                    <p class="card-text scroller "> Carrying more passengers or cargo than the vehicle's capacity allows is a violation. Penalties for overloading can involve fines starting from EGP 500, and the vehicle may be impounded until the excess load is removed.</p></div>
            </div>
        </div>
    </div>
    </div>
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