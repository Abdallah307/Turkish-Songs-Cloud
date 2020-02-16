<?php

session_start();

?>
<?php
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
$my = "";
$pic = "";
$sonname = "";
$sinarname = "";
$rty = $_GET['songing'];
$sql = "SELECT * FROM songs where songname ='$rty'";
$conn->query("SET character_set_results=utf8mb4");
$result = $conn->query($sql);
$conn->query("SET character_set_results=utf8mb4");
if ($result->num_rows > 0) {
// output data of each row
  while ($row = $result->fetch_assoc()) {
    $my = $row['songurl'];
    $sonname = $row['songname'];
    $pic = $row['songpic'];
    $sinarname = $row['singername'];
  }
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

      });
  </script>
</head>
<body class="animated fadeIn" style="background-image: linear-gradient(to right top, #005eea, #3d51da, #5243c9, #6034b8, #6823a6);">
<div style="" class="container-fluid d-flex justify-content-center align-items-center">
  <div style=" padding-left: 100px;padding-right: 100px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);" class="justify-content-center align-self-center align-items-center flex-column animated zoomIn slow">
  <img class=" rounded" src="<?php echo $pic ?>" style="width: 350px; height: 350px; margin-top: 100px; margin-left: 20px;">
  <h1 style="letter-spacing: 5px;" class="text-center text-white mt-3"><?php echo $sinarname;?></h1>
  <h2 style="letter-spacing: 10px;" class="text-center text-white mt-3"><?php echo $sonname; ?></h2>
  </div>
</div>
<audio  controls class="fixed-bottom container-fluid mine" preload="none"  style="border-radius: 0; visibility: hidden;" hidden
        ontimeupdate="document.getElementById('tracktime').innerHTML =Math.floor(this.currentTime) + ' / ' + (Math.floor(this.duration));
document.getElementById('myRange').value =Math.floor(this.currentTime);document.getElementById('myRange').max =Math.floor(this.duration);">

  <source src="<?php echo $my;?>" type="audio/mpeg" >
  Your browser does not support the audio element.
</audio>
<div id="musicPlayer" class="d-flex align-items-center mt-5 text-white fixed-bottom" style="padding-bottom: 5px;visibility: visible; background-image: linear-gradient(to right top, #005eea, #3d51da, #5243c9, #6034b8, #6823a6);"> <!--The bottom music player-->
  <div class="d-flex justify-content-center align-items-center">
    <img  src="<?php echo $pic;?>" class="d-block" height="70px" width="70px" style="margin-right: 5px; margin-left: 3px;">
    <div class="d-flex flex-column fontes">
      <h4 class=""><?php echo $sonname; ?></h4>
      <small><?php echo $sinarname;?></small>
    </div>
  </div>
  <div class="d-flex flex-column justify-content-center align-items-center flex-fill">
    <a  id="playmusic"><img id="playpauseimg" src="https://cdn3.iconfinder.com/data/icons/gradient-circle/36/5013-512.png" height="60px" width="60px" style="margin-bottom: 20px; margin-top: 20px;"></a>
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
<script>

  $(document).ready(function () {
      $('audio').trigger('play');
      $('#myRange').val("0");
      $('#volumeRange').val("1");
      $('#playpauseimg').attr("src", "https://cdn3.iconfinder.com/data/icons/gradient-circle/36/5014-512.png");

      var counter=0;
      var clicked = false;
      var playpauseCounter = 0;
      $('#playmusic').click(function () {
          playpauseCounter = playpauseCounter +1;

          $('audio').trigger('play');
          if(playpauseCounter%2==1) {
              $('#playpauseimg').attr("src", "https://cdn3.iconfinder.com/data/icons/gradient-circle/36/5014-512.png");
              $(this).addClass('animated pulse infinite');
          }
          else {
              $('audio').trigger('pause');
              $('#playpauseimg').attr("src", "https://cdn3.iconfinder.com/data/icons/gradient-circle/36/5013-512.png");
              $(this).removeClass('animated pulse infinite');
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
  });


</script>
</body>
</html>


