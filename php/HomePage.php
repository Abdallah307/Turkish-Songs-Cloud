<?php
session_start();
$servername = "localhost";
$username = "website";
$password = "123456";
$dbname = "database1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);


}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
$userEmail = "";
$userPass = "";

$emerror = "";
$errorEmail = "";

$passError = "";
$errorPass = "";
if( isset($_POST["loginemail"]) && isset($_POST["loginpass"]) )
{
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['loginemail'])) {
      $emerror = "1px solid red";
      $errorEmail = "Please Fill in the email";
    }


    else {
      $userEmail = test_input($_POST['loginemail']);


    }
    if(empty($_POST['loginpass'])) {
      $passError = "1px solid red";
      $errorPass = "Please Fill in The Password";
    }
    else {
      $userPass = test_input($_POST['loginpass']);
    }



  }


}



$sql = "SELECT * FROM users where email='$userEmail' and password='$userPass'";
$conn->query("SET character_set_results=utf8mb4");

$result = $conn->query($sql);
$conn->query("SET character_set_results=utf8mb4");

if ($result->num_rows > 0) {

  while($row = $result->fetch_assoc()) {
        $_SESSION['emailAdd'] = $row['email'];
        $_SESSION['passing'] = $row['password'];




  }




  header('Location: UserProfile.php?emailing='.$_SESSION['emailAdd']);
  header("Status: 301 Moved Permanently");
  exit;

}
else{
//$errorEmail = "The email you entered is incorrect!";
}








?>
<!DOCTYPE html>
<html lang="en" xmlns:https="http://www.w3.org/1999/xhtml">
<head>
  <title>Sarki</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" type="text/css" href="HomePageStyle.css">
  <!--this is the jquery validator cdn-->
  <link rel="icon" href="http://localhost/sarkilogo.png">



  <!--  <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css" rel="stylesheet">-->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.10/css/mdb.min.css" rel="stylesheet">
  <!-- JQuery -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.10/js/mdb.min.js"></script>


  <script>




      $(document).ready(function () {





          $('#myRange').val("0");
          $('#volumeRange').val("1");

          var counter=0;
          var clicked = false;

          $('img.musicbars').hide();
          $('a').addClass("text-white");
          $('#navbarNav').on('show.bs.collapse', function () {
              $(this).removeClass('bg-transparent').addClass('mine');
          });
          $('#navbarNav').on('hidden.bs.collapse', function () {
              $(this).removeClass('mine').addClass('bg-transparent');
          });

          $('div.card-body a img').mouseenter(function () {
              if(clicked ==false)
              $(this).attr("src", "https://cdn3.iconfinder.com/data/icons/gradient-circle/36/5013-512.png");
              else {
                  $(this).attr("src", "https://cdn3.iconfinder.com/data/icons/gradient-circle/36/5014-512.png");

              }
          });
          $('div.card-body a img').mouseout(function () {
              if(clicked==false)
              $(this).attr("src", "https://www.trzcacak.rs/myfile/full/111-1117116_play-button-filetype-phone-icon-png-pink.png");
              else {
                  $(this).attr("src", "https://cdn3.iconfinder.com/data/icons/gradient-circle/36/5014-512.png");
              }
          });

          $('div.card-body a img').click(function () {
              counter = counter+1;

              if(counter%2==1) {
                  clicked = true;
                  $(this).attr("src", "https://cdn3.iconfinder.com/data/icons/gradient-circle/36/5014-512.png");
                  $(this).addClass('animated pulse infinite');
                  $(this).parent().next().next().show();
                 // $('audio').trigger('play');
                 //
                 //  $('audio').trigger('pause');
                 //  $('audio').attr('src', "http://localhost/bengu_songs/Bengü - Sahici.mp3");
                 //  $('audio').trigger('load');
                 //
                 //  $('audio').trigger('play');

              }
              else {
                  clicked = false;
                  $(this).attr("src", "https://cdn3.iconfinder.com/data/icons/gradient-circle/36/5013-512.png");
                  $(this).removeClass('animated pulse infinite');

                  $(this).parent().next().next().hide();
                   $('audio').trigger('pause');


              }

          });
              var playpauseCounter = 0;
                  $('#playmusic').click(function () {
                      playpauseCounter = playpauseCounter +1;

                      $('audio').trigger('play');
                      if(playpauseCounter%2==1) {
                          $('#playpauseimg').attr("src", "http://localhost/pause-512.png");
                      }
                      else {
                          $('audio').trigger('pause');
                          $('#playpauseimg').attr("src", "http://localhost/play-xxl.png");
                      }



                  });
                  $('#myRange').change(function () {
                       $("audio").prop("currentTime",$('#myRange').val());
                  });
                  $('#volumeRange').change(function () {
                      $("audio").prop("volume",$('#volumeRange').val());
                      if($('#volumeRange').val()==0) {
                          $('#volumeicon').attr("src", "http://localhost/mute-512.png");
                      }
                      else {
                          $('#volumeicon').attr("src", "http://localhost/volume-up.png");
                      }

                  });

          $('div.card-body').find('h1').addClass('mt-3');


             // $('#elegantModalForm').modal('hide');




              $('#elegantModalForm').modal({'backdrop': 'static'});


          $.validate({
              form:'#loginform',
              validateOnBlur: false,




          });













//this function i used for toggle the visibility of navigation bar and add the animation to it
          var prevScrollpos = window.pageYOffset;
          window.onscroll = function() {
              var currentScrollPos = window.pageYOffset;
              if ( currentScrollPos<=270) {
                  $('#navContainer').removeClass('animated slideInUp slow');
                  $('#navContainer').addClass('animated slideInDown slow');

                  document.getElementById("navContainer").style.top = "0";
              } else {
                  $('#navContainer').removeClass('animated slideInDown slow');
                  $('#navContainer').addClass('animated slideInUp slow');
                  document.getElementById("navContainer").style.top = "-100px";
              }
              prevScrollpos = currentScrollPos;
          }







      });
  </script>




  <style>
    li {
      padding: 30px;
    }
    /* width */
    ::-webkit-scrollbar {
      width: 20px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
      box-shadow: inset 0 0 5px grey;
      border-radius: 10px;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
      background-image: linear-gradient(to right top, #005eea, #3d51da, #5243c9, #6034b8, #6823a6);
      border-radius: 10px;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
      background-image: linear-gradient(to right top, #7e00f4, #8216ed, #8623e7, #892de0, #8c35da);
    }

    .has-error {
      color: red;
      text-transform: none;
      font-variant: none;
    }

  </style>
  <script>

  </script>
</head>

<body class="bg-dark animated fadeIn slow ">


<div class="bg1 d-flex justify-content-center align-items-center container-fluid ">
  <nav id="navContainer"  style="height: 100px;" class="navbar navbar-expand-lg bg-transparent scrolling-navbar d-flex justify-content-around fixed-top">
    <a  href="http://localhost/HomePage.php" class=" navbar-brand animated pulse"><img style="margin-top: 20px;" width="60px" height="80px" src="http://localhost/sarkilogo.png"><span class="font-weight-bold" style="color: #e3038d">Şarkı</span></a>
    <button class="navbar-toggler ml-auto pb-3" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"><img  src="http://www.armoredworks.com/metalcloak/images/2018-Website/Icons/menu-white.png" width="50px" height="30px"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center align-items-center " id="navbarNav">
      <ul  class="nav navbar-nav" >
        <li  class="nav-item"><a href="http://localhost/HomePage.php" class=" nav-link" >Home</a></li>
<!--        <li class="nav-item"><a href="http://localhost/ArtistsPage.php" class="nav-link">Artists</a></li>-->
<!--        <li class="nav-item mr-lg-auto"><a href="#" class="nav-link">Lists</a></li>-->
        <li class="nav-item"><a href="http://localhost/SignUpPage.php" class="nav-link">Create account</a></li>
        <li class="nav-item"><a id="loginButtonNav"  data-toggle="modal" data-target="#elegantModalForm" href class="nav-link">Login</a></li>

      </ul>
    </div>
    <div>

    </div>



  </nav>
  <div id="hometext" class="d-flex flex-column text-center text-white ">
    <h1 class="font-weight-bold animated flipInX slower ">Signup now for free</h1>
    <h2 class="animated flipInX slower">Discover Your Favourite Turkish Songs</h2><br/><br/>
    <div class="d-flex flex-row flex-wrap">
      <button style="margin:auto; padding-right: 150px; padding-left: 150px; padding-top: 20px;padding-bottom: 20px;" onclick="window.location.href='http://localhost/SignUpPage.php'" id="signup" type="button" class="btn animated zoomInUp slower delay-1s">Sign Up</button>
      <button id="take" data-toggle="modal" data-target="#modeling" style="margin:auto; padding-right: 150px; padding-left: 150px; padding-top: 20px;padding-bottom: 20px;"  type="button" class="btn animated zoomInUp slower delay-1s">Take a tour <img src="https://cdn3.iconfinder.com/data/icons/gradient-circle/36/5013-512.png" width="30px" height="30px"></button>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal animated slideInDown" id="elegantModalForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">

  <div class="modal-dialog" role="document">
    <!--Content-->
    <div class="modal-content form-elegant">
      <!--Header-->
      <div class="modal-header text-center mine">
        <h3 class="modal-title w-100 text-white font-weight-bold my-3" id="myModalLabel"><strong>Login</strong></h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!--Body-->
      <form id="loginform" method="post" action="HomePage.php" enctype="multipart/form-data" class="has-validation-callback">
      <div class="modal-body mx-4">
        <!--Body-->
        <div class="md-form mb-5">
          <input data-validation-error-msg="Please Enter a valid email address" data-validation="required email"  name="loginemail" style="font-variant: none;border-bottom: <?php echo $emerror ?>;
  text-transform: none;"  type="email" id="Form-email1" class="form-control">
          <label for="Form-email1">Your email</label>
          <span style="color: red;" ><?php echo $errorEmail ?></span>
        </div>

        <div class="md-form pb-3">
          <input data-validation-error-msg="Please Enter your password" data-validation="required"  name="loginpass"  style="font-variant: none;border-bottom: <?php echo $passError?>;
  text-transform: none;" type="password" id="Form-pass1" class="form-control">
          <label for="Form-pass1">Your password</label>
          <span style="color: red;"><?php echo $errorPass;?></span>
          <p class="font-small blue-text d-flex justify-content-end">Forgot <a href="#" class="blue-text ml-1">
              Password?</a></p>
        </div>

        <div class="text-center mb-3">
          <button id="modalButton" type="submit" class="btn btn-block btn-rounded z-depth-1a">Login</button>
        </div>

      </div>
      </form>
      <!--Footer-->
      <div class="modal-footer mx-5 pt-3 mb-1">
        <p class="font-small grey-text d-flex justify-content-end">Not a member? <a href="http://localhost/SignUpPage.php" class="blue-text ml-1">
            Sign Up</a></p>
      </div>
    </div>
    <!--/.Content-->
  </div>
</div>
<!-- Modal -->

<!--<div class="text-center">-->
<!--  <a href="" class="btn btn-default btn-rounded" data-toggle="modal" data-target="#elegantModalForm">Launch-->
<!--    modal Login Form</a>-->
<!--</div>-->

<div class="text-center container-fluid d-flex flex-column bg-dark text-white justify-content-center align-items-center">
  <br/>
  <h1 class="animated zoomIn wow">LET THE JOURNEY BEGIN!</h1>


  <video style=" max-width: 100%; height: auto;" controls class="animated fadeIn wow">
    <source src="http://localhost/Simge.mp4" type="video/mp4">
    Your browser does not support the video tag.
  </video>

  <!--  <img class=" animated pulse infinite" style="height: 400px; " src="http://localhost/musiclistener.png">-->
</div>
<br/><br/><br/>
<div class="container-fluid flex-wrap d-flex flex-xs-column justify-content-around bg-dark text-white justify-content-lg-around align-items-md-center align-items-sm-center flex-lg-row flex-md-column flex-sm-column">
  <div class="d-flex flex-column slideInUp animated slow wow">
    <h1 class="text-center font-weight-bold" style="font-size:20px; ">More likes. More playlists.<br/>
      All in one place.</h1><br/><br/>
    <p style="font-size: 20px;" class="text-white text-center" >
      The tracks you’ve liked and discovered,<br/>
      and your favorite playlists<br/>
      can all be found in your Library.<br/>
      Which means you can listen to what<br/>
      you love again and again. And again.

    </p>
  </div>
  <div>



  </div>
  <br/>
  <div>
    <img src="http://localhost/phone.png" style="height: 400px;width: 300px; max-width: 100%;" class="d-block bounceIn animated slower wow">
  </div>

</div>
<br/><br/><br/><br/>

<!--My Carousal-->

<!--<div class="container-fluid d-flex justify-content-around border border-warning">-->
<!---->
<!--    <img class="d-block animated slideInLeft slow overflow-hidden wow infinite" src="https://images.wallpaperscraft.com/image/girl_baby_sleep_bow_ribbon_80133_240x400.jpg">-->
<!--    <img class="d-block animated slideInLeft slow overflow-hidden wow infinite delay-3s" src="https://images.wallpaperscraft.com/image/girl_baby_sleep_bow_ribbon_80133_240x400.jpg">-->
<!--    <img class="d-block animated slideInLeft slow overflow-hidden wow infinite delay-2s" src="https://images.wallpaperscraft.com/image/girl_baby_sleep_bow_ribbon_80133_240x400.jpg">-->
<!--    <img class="d-block animated slideInLeft slow overflow-hidden wow infinite delay-1s" src="https://images.wallpaperscraft.com/image/girl_baby_sleep_bow_ribbon_80133_240x400.jpg">-->
<!---->
<!--</div>-->
<div class="container-fluid">
  <div id="carouselExampleControls" class="carousel slide animated fadeIn slow wow" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="d-block w-100" src="http://localhost/murat_boz_img.png"
             alt="First slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="http://localhost/ceceli_img.png"
             alt="Second slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="http://localhost/irmak_img.png"
             alt="Third slide">
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>
<br/><br/><br/><br/>

<div class="container-fluid d-flex justify-content-center align-items-center flex-column">
  <h1 class="text-center text-white hometext animated slideInUp wow ">Keep In touch with The Latest Releases</h1>
  <br/>
  <div id="carocard" class="carousel slide animated zoomIn wow slow" data-ride="carousel"><!--This is the carousal of cards of latest Songs-->
    <div class="carousel-inner d-flex ">
      <div class="carousel-item active ">
        <!-- Card deck -->
        <div class="card-deck d-flex flex-column flex-sm-column flex-md-column flex-lg-row  flex-wrap text-center text-white">
          <!-- Card -->
          <div class="card mb-4 bg-dark" style="border-image: linear-gradient(to right top, #005eea, #3d51da, #5243c9, #6034b8, #6823a6);" >

            <!--Card image-->
            <div class="view overlay">
              <img class="card-img-top" src="http://localhost/bengu1.png" alt="Card image cap">
              <a href="#!">
                <div class="mask rgba-white-slight"></div>
              </a>
            </div>

            <!--Card content-->
            <div class="card-body">

              <!--Title-->
              <h4 class="card-title text-center">Günaydın</h4>
              <a id="playcard1"><img onclick="cs_change_music('http://localhost/bengu_songs/Bengü - Feveran.mp3');" id="playing" class="mt-2" src="https://www.trzcacak.rs/myfile/full/111-1117116_play-button-filetype-phone-icon-png-pink.png" height="100px" width="100px"></a>
              <!--Text-->
              <h1 class="text-center">Bengü</h1>
              <img class="mt-2  musicbars" src="http://localhost/musicbars.gif" height="50px" width="50px">
              <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->


            </div>

          </div>
          <!-- Card -->
          <!-- Card -->
          <div class="card mb-4 bg-dark">

            <!--Card image-->
            <div class="view overlay">
              <img class="card-img-top" src="http://localhost/mustafam3.png" alt="Card image cap">
              <a href="#!">
                <div class="mask rgba-white-slight"></div>
              </a>
            </div>

            <!--Card content-->
            <div class="card-body">

              <!--Title-->
              <h4 class="card-title text-center"> Mühür</h4>
              <a id="playcard2"><img onclick="cs_change_music('http://localhost/irmak_arici_songs/Irmak Arıcı - Mevzum Derin.mp3');" class="mt-2" src="https://www.trzcacak.rs/myfile/full/111-1117116_play-button-filetype-phone-icon-png-pink.png" height="100px" width="100px"></a>
              <!--Text-->
              <h1 class="text-center">Irmak Arıcı </h1>
              <img class="mt-2  musicbars" src="http://localhost/musicbars.gif" height="50px" width="50px">
              <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->


            </div>

          </div>
          <!-- Card -->

          <!-- Card -->
          <div class="card mb-4 bg-dark">

            <!--Card image-->
            <div class="view overlay">
              <img class="card-img-top" src="http://localhost/merveozbey.png" alt="Card image cap">
              <a href="#!">
                <div class="mask rgba-white-slight"></div>
              </a>
            </div>

            <!--Card content-->
            <div class="card-body">

              <!--Title-->
              <h4 class="card-title text-center">Yaramızda Kalsın</h4>
              <a id="playcard3"><img onclick="cs_change_music('http://localhost/merve_ozbey_songs/Merve Özbey - Yaramızda Kalsın.mp3');" class="mt-2" src="https://www.trzcacak.rs/myfile/full/111-1117116_play-button-filetype-phone-icon-png-pink.png" height="100px" width="100px"></a>
              <!--Text-->
              <h1 class="text-center">Merve Özbey</h1>
              <img class="mt-2  musicbars" src="http://localhost/musicbars.gif " height="50px" width="50px">
              <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->


            </div>
          </div>
          <!-- Card -->

          <!-- Card -->
          <div class="card mb-4 bg-dark">

            <!--Card image-->
            <div class="view overlay">
              <img class="card-img-top" src="http://localhost/fride.png" alt="Card image cap">
              <a href="#!">
                <div class="mask rgba-white-slight"></div>
              </a>
            </div>

            <!--Card content-->
            <div class="card-body">

              <!--Title-->
              <h4 class="card-title text-center">Yok Yok</h4>
              <a id="playcard4"><img onclick="cs_change_music('http://localhost/feride_hilal_akin_songs/Feride Hilal Akın - Yok Yok.mp3');" class="mt-2" src="https://www.trzcacak.rs/myfile/full/111-1117116_play-button-filetype-phone-icon-png-pink.png" height="100px" width="100px"></a>
              <!--Text-->
              <h1 class="text-center">Feride</h1>
              <img class="mt-2  musicbars" src="http://localhost/musicbars.gif" height="50px" width="50px">
              <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->


            </div>

          </div>
          <!-- Card -->

        </div>
        <!-- Card deck -->
      </div>
      <div class="carousel-item">
        <!-- Card deck -->
        <div class="card-deck d-flex flex-column flex-sm-column flex-md-column flex-lg-row  flex-wrap text-white text-center">
          <!-- Card -->
          <div class="card mb-4 bg-dark">

            <!--Card image-->
            <div class="view overlay">
              <img class="card-img-top" src="https://i4.hurimg.com/i/hurriyet/75/750x422/5d2c2a33d3806c1ea429b724.jpg" alt="Card image cap">
              <a href="#!">
                <div class="mask rgba-white-slight"></div>
              </a>
            </div>

            <!--Card content-->
            <div class="card-body">

              <!--Title-->
              <h4 class="card-title text-center">Olsun</h4>
              <a id="playcard5"><img onclick="cs_change_music('http://localhost/cem_adrian_songs/Cem Adrian & Halil Sezai - Olsun.mp3');" class="mt-2" src="https://www.trzcacak.rs/myfile/full/111-1117116_play-button-filetype-phone-icon-png-pink.png" height="100px" width="100px"></a>
              <!--Text-->
              <h1 class="text-center">Cem Adrian</h1>
              <img class="mt-2 musicbars" src="http://localhost/musicbars.gif " height="50px" width="50px">
              <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->


            </div>

          </div>
          <!-- Card -->
          <!-- Card -->
          <div class="card mb-4 bg-dark">

            <!--Card image-->
            <div class="view overlay">
              <img class="card-img-top" src="http://localhost/eypioimg.png" alt="Card image cap">
              <a href="#!">
                <div class="mask rgba-white-slight"></div>
              </a>
            </div>

            <!--Card content-->
            <div class="card-body">

              <!--Title-->
              <h4 class="card-title text-center">gömün beni çukura</h4>
              <a id="playcard6"><img onclick="cs_change_music('http://localhost/eypio_songs/Eypio - Gömün Beni Çukura (Çukur Dizi Müziği) (Official Music Video).mp3');" class="mt-2" src="https://www.trzcacak.rs/myfile/full/111-1117116_play-button-filetype-phone-icon-png-pink.png" height="100px" width="100px"></a>
              <!--Text-->
              <h1 class="text-center">Eypio</h1>
              <img class="mt-2 musicbars" src="http://localhost/musicbars.gif " height="50px" width="50px">
              <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->


            </div>

          </div>
          <!-- Card -->

          <!-- Card -->
          <div class="card mb-4 bg-dark">

            <!--Card image-->
            <div class="view overlay">
              <img class="card-img-top" src="http://localhost/korayimg.png" alt="Card image cap">
              <a href="#!">
                <div class="mask rgba-white-slight"></div>
              </a>
            </div>

            <!--Card content-->
            <div class="card-body">

              <!--Title-->
              <h4 class="card-title text-center">Sen</h4>
              <a id="playcard7"><img onclick="cs_change_music('http://localhost/koray_avci_songs/Koray Avcı - Sen (Official Video).mp3');" class="mt-2" src="https://www.trzcacak.rs/myfile/full/111-1117116_play-button-filetype-phone-icon-png-pink.png" height="100px" width="100px"></a>
              <!--Text-->
              <h1 class="text-center">Koray Avci </h1>
              <img class="mt-2 musicbars" src="http://localhost/musicbars.gif " height="50px" width="50px">
              <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->


            </div>

          </div>
          <!-- Card -->

          <!-- Card -->
          <div class="card mb-4 bg-dark">

            <!--Card image-->
            <div class="view overlay">
              <img class="card-img-top" src="http://localhost/merveimg.png" alt="Card image cap">
              <a href="#!">
                <div class="mask rgba-white-slight"></div>
              </a>
            </div>

            <!--Card content-->
            <div class="card-body">

              <!--Title-->
              <h4 class="card-title text-center">Vuracak</h4>
              <a id="playcard8"><img onclick="cs_change_music('http://localhost/merve_ozbey_songs/Merve Özbey - Vuracak.mp3');" class="mt-2" src="https://www.trzcacak.rs/myfile/full/111-1117116_play-button-filetype-phone-icon-png-pink.png" height="100px" width="100px"></a>
              <!--Text-->
              <h1 class="text-center">Merve Özbey</h1>
              <img class="mt-2 musicbars" src="http://localhost/musicbars.gif " height="50px" width="50px">
              <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->


            </div>

          </div>
          <!-- Card -->

        </div>
        <!-- Card deck -->
      </div>
      <div class="carousel-item">
        <!-- Card deck -->
        <div class="card-deck d-flex flex-column flex-sm-column flex-md-column flex-lg-row  flex-wrap  text-center text-white">
          <!-- Card -->
          <div class="card mb-4 bg-dark">

            <!--Card image-->
            <div class="view overlay">
              <img class="card-img-top" src="http://localhost/burayimg.png" alt="Card image cap">
              <a href="#!">
                <div class="mask rgba-white-slight"></div>
              </a>
            </div>

            <!--Card content-->
            <div class="card-body">

              <!--Title-->
              <h4 class="card-title text-center">Mecnun</h4>
              <a id="playcard9"><img onclick="cs_change_music('http://localhost/buray_songs/Buray - Mecnun.mp3');" class="mt-2" src="https://www.trzcacak.rs/myfile/full/111-1117116_play-button-filetype-phone-icon-png-pink.png" height="100px" width="100px"></a>
              <!--Text-->
              <h1 class="text-center">Buray </h1>
              <img class="mt-2 musicbars" src="http://localhost/musicbars.gif " height="50px" width="50px">
              <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->


            </div>

          </div>
          <!-- Card -->
          <!-- Card -->
          <div class="card mb-4 bg-dark">

            <!--Card image-->
            <div class="view overlay">
              <img class="card-img-top" src="http://localhost/muratimg.png" alt="Card image cap">
              <a href="#!">
                <div class="mask rgba-white-slight"></div>
              </a>
            </div>

            <!--Card content-->
            <div class="card-body">

              <!--Title-->
              <h4 class="card-title text-center">Janti</h4>
              <a id="playcard10"><img onclick="cs_change_music('http://localhost/murat_boz_songs/Murat Boz - Janti.mp3');" class="mt-2" src="https://www.trzcacak.rs/myfile/full/111-1117116_play-button-filetype-phone-icon-png-pink.png" height="100px" width="100px"></a>
              <!--Text-->
              <h1 class="text-center">Murat Boz</h1>
              <img class="mt-2 musicbars" src="http://localhost/musicbars.gif " height="50px" width="50px">
              <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->


            </div>

          </div>
          <!-- Card -->

          <!-- Card -->
          <div class="card mb-4 bg-dark">

            <!--Card image-->
            <div class="view overlay">
              <img class="card-img-top" src="https://img-s1.onedio.com/id-5b4be166e267dc6a7163ba5e/rev-0/w-635/listing/f-jpg-webp/s-a758497f6ad8064386b360adab42d62f71c7e6f0.webp" alt="Card image cap">
              <a href="#!">
                <div class="mask rgba-white-slight"></div>
              </a>
            </div>

            <!--Card content-->
            <div class="card-body">

              <!--Title-->
              <h4 class="card-title text-center">Vazgeçtim</h4>
              <a id="playcard11"><img onclick="cs_change_music('http://localhost/yildiz_tilbe_songs/Yıldız Tilbe - Vazgeçtim.mp3');" class="mt-2" src="https://www.trzcacak.rs/myfile/full/111-1117116_play-button-filetype-phone-icon-png-pink.png" height="100px" width="100px"></a>
              <!--Text-->
              <h1 class="text-center">Sezen aksu</h1>
              <img class="mt-2 musicbars" src="http://localhost/musicbars.gif " height="50px" width="50px">
              <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->


            </div>

          </div>
          <!-- Card -->

          <!-- Card -->
          <div class="card mb-4 bg-dark">

            <!--Card image-->
            <div class="view overlay">
              <img class="card-img-top" src="http://localhost/yildizimg.png" alt="Card image cap">
              <a href="#!">
                <div class="mask rgba-white-slight"></div>
              </a>
            </div>

            <!--Card content-->
            <div class="card-body">

              <!--Title-->
              <h4 class="card-title text-center">Dağıldım Biraz</h4>
              <a id="playcard12"><img onclick="cs_change_music('http://localhost/yildiz_tilbe_songs/Yıldız Tilbe - Dağıldım Biraz.mp3');" class="mt-2" src="https://www.trzcacak.rs/myfile/full/111-1117116_play-button-filetype-phone-icon-png-pink.png" height="100px" width="100px"></a>
              <!--Text-->
              <h1 class="text-center">Yıldız Tilbe</h1>
              <img class="mt-2 musicbars" src="http://localhost/musicbars.gif " height="50px" width="50px">
              <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->


            </div>

          </div>
          <!-- Card -->

        </div>
        <!-- Card deck -->
      </div>
    </div>
    <a class="carousel-control-prev" href="#carocard" role="button" data-slide="prev" style="visibility: hidden">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carocard" role="button" data-slide="next" style="visibility: hidden">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div><!--Big div for carousal cards-->
<br/><br/><br/><br/>

<div class="text-center container-fluid d-flex flex-column bg-dark text-white justify-content-center align-items-center">
  <br/>
  <h1 class="animated zoomIn wow">Music is the literature of the heart</h1>


  <img class="animated slideInUp wow slow" src="ManWeb-landing.png" style="max-width: 100%;height: auto;">

  <!--  <img class=" animated pulse infinite" style="height: 400px; " src="http://localhost/musiclistener.png">-->
</div>
<br/><br/><br/><br/>
<!-- Footer -->
<footer class="page-footer font-small mine">

  <!-- Footer Elements -->
  <div class="container">

    <!-- Grid row-->
    <div class="row">

      <!-- Grid column -->
      <div class="col-md-12 py-5 flex-column">

        <div class="mb-5 flex-center">

          <!-- Facebook -->
          <a class="fb-ic">
            <i class="fab fa-facebook-f fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
          </a>
          <!-- Twitter -->
          <a class="tw-ic">
            <i class="fab fa-twitter fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
          </a>
          <!-- Google +-->
          <a class="gplus-ic">
            <i class="fab fa-google-plus-g fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
          </a>
          <!--Linkedin -->
          <a class="li-ic">
            <i class="fab fa-linkedin-in fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
          </a>
          <!--Instagram-->
          <a class="ins-ic">
            <i class="fab fa-instagram fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
          </a>
          <!--Pinterest-->
          <a class="pin-ic">
            <i class="fab fa-pinterest fa-lg white-text fa-2x"> </i>
          </a>
        </div>
      </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row-->

  </div>
  <!-- Footer Elements -->

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">© 2019 Copyright Reserved for Şarkı
    <a href="http://localhost/HomePage.php"> Şarkı.com</a>
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->
<audio id="my-audio"  controls class="fixed-bottom container-fluid mine" preload="none"  style="border-radius: 0; visibility: hidden;" hidden
        ontimeupdate="document.getElementById('tracktime').innerHTML =Math.floor(this.currentTime) + ' / ' + (Math.floor(this.duration));
document.getElementById('myRange').value =Math.floor(this.currentTime);document.getElementById('myRange').max =Math.floor(this.duration);">

  <source src="http://localhost/bengu_songs/Bengü - Feveran.mp3" type="audio/mpeg" >
  Your browser does not support the audio element.
</audio>
<div id="musicPlayer" class="d-flex align-items-center mt-5 text-white fixed-bottom" style="padding-bottom: 5px;visibility: hidden; background-image: linear-gradient(to right top, #005eea, #3d51da, #5243c9, #6034b8, #6823a6);"> <!--The bottom music player-->
  <div class="d-flex justify-content-center align-items-center">
    <img src="mustafam.png" class="d-block" height="70px" width="70px" style="margin-right: 5px; margin-left: 3px;">
    <div class="d-flex flex-column fontes">
      <h4 class="">seni seviyorum</h4>
      <small>Mustafa cecili</small>
    </div>
  </div>
  <div class="d-flex flex-column justify-content-center align-items-center flex-fill">
    <a id="playmusic"><img id="playpauseimg" src="http://localhost/play-xxl.png" height="30px" width="30px" style="margin-bottom: 20px; margin-top: 20px;"></a>
    <span id="tracktime">0 / 0</span> <input id="myRange" type="range" class="custom-range flex-fill" max="600" >
  </div>

  <div class="d-flex" style="margin-left: 5px; margin-right: 5px;">
    <img id="volumeicon" src="http://localhost/volume-up.png" height="20px" width="20px" style="margin-right: 5px;">
    <input id="volumeRange" type="range" class="custom-range flex-fill" step="0.1" max="1" min="0">
  </div>


</div>
<script src="js/wow.min.js"></script>
<script>
    new WOW().init();
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<script type="text/javascript">
var count=0;
    function cs_change_music(music)
    {
        document.getElementById("my-audio").pause();
        document.getElementById("my-audio").setAttribute('src', music);
        document.getElementById("my-audio").load();
        document.getElementById("my-audio").play();
    }
</script>



<!-- The Modal -->
<div class="modal animated zoomIn slow " id="modeling">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header bg-dark text-white ">
        <h4 class="modal-title text-center">Take a tour</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <video  autoplay width="100%" height="100%" controls>
          <source src="http://localhost/Sarki - Google Chrome 2019-12-09 02-30-12.mp4" type="video/mp4">

        </video>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer bg-dark text-white">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
</body>
</html>
