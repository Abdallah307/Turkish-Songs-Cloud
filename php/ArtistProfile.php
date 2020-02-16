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
$sinQuery = test_input($_GET['singer']);
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
$propic = "";
$covpic = "";
$name = "";
$sql = "SELECT singercoverpic , singerprofilepic , singername FROM singers where singername='$sinQuery'";
$conn->query("SET character_set_results=utf8mb4");
$result = $conn->query($sql);
$conn->query("SET character_set_results=utf8mb4");
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $propic = $row['singerprofilepic'];
    $covpic = $row['singercoverpic'];
    $name = $row['singername'];

  }
} else {
  if ($sinQuery == "Bengü") {
        notRecognize("Ben");
  }
  elseif ($sinQuery=="Güliz Ayla") {
    notRecognize("ayla");
  }
  elseif ($sinQuery=="İlyas Yalçıntaş") {
    notRecognize("ilyas");
  }
  elseif ($sinQuery=="İrem Derici") {
    notRecognize("irem");
  }
  elseif ($sinQuery=="Irmak Arıcı") {
    notRecognize("irmak");
  }
  elseif ($sinQuery=="Koray Avcı") {
    notRecognize("koray");
  }
  elseif ($sinQuery=="Merve Özbey") {
    notRecognize("merve");
  }
  elseif ($sinQuery=="Oğuzhan Koç") {
    notRecognize("ozhan");
  }
  elseif ($sinQuery=="Toygar Işıklı") {
    notRecognize("toygar");
  }
  elseif ($sinQuery=="Tuğçe Kandemir") {
    notRecognize("kandemir");
  }
  elseif ($sinQuery=="Yıldız Tilbe") {
    notRecognize("tilbe");
  }
  elseif ($sinQuery=="Feride Hilal Akın") {
    notRecognize("feride");
  }
  elseif ($sinQuery=="Musa Eroğlu") {
    notRecognize("musa");
  }

}


function notRecognize($str) {
  $sql = "SELECT singercoverpic , singerprofilepic , singername FROM singers where about='$str'";
 $GLOBALS['conn']->query("SET character_set_results=utf8mb4");
  $result = $GLOBALS['conn']->query($sql);
  $GLOBALS['conn']->query("SET character_set_results=utf8mb4");
  if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
      $GLOBALS['propic'] =$row['singerprofilepic'];
      $GLOBALS['covpic'] = $row['singercoverpic'];
      $GLOBALS['name'] = $row['singername'];

    }
  }
}

if(isset($_GET['ur'])){
  if ($_GET['ur'] == "http://pluspng.com/img-png/png-purple-heart-magenta-purple-heart-clip-art-at-clker-com-vector-clip-art-online-royalty-free-public-domain-600.png") {
    $QS = $_GET['ur'];

    $stm = $conn->prepare("INSERT INTO userlikes (userEmail,songName) VALUES (?, ?)");
    $stm->bind_param("ss", $userEmails, $songName);
$existFlag = false;
// set parameters and execute
    $userEmails = $_GET['xx'];
    $songName = $_GET['tt'];
    //$asd = $_GET['tt'];
    $sqlr = "SELECT * FROM userlikes";
    $result = $conn->query($sqlr);

    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        if($row['userEmail']==$userEmails){
          if($row['songName']==$songName){
            $existFlag=true;
          }
        }
      }
    }

    if($existFlag==false){
      $stm->execute();
    }


    echo $_GET['ur'];
    $stm->close();
  }
  else{
    $asd = $_GET['tt'];
    $sql45 = "DELETE FROM userLikes WHERE songName='$asd'";
    $conn->query($sql45);

  }


}

if(isset($_GET['hist'])){
  $ste = $conn->prepare("INSERT INTO history (userEmail,songName) VALUES (?, ?)");
  $ste->bind_param("ss", $userEmails, $songName);

// set parameters and execute
  $userEmails = $_GET['emm'];
  $songName = $_GET['hist'];
  //$asd = $_GET['tt'];

  $ste->execute();
}





$conn->close();


?>



<!DOCTYPE html>
<html lang="en" xmlns:https="http://www.w3.org/1999/xhtml">
<head>
  <title>Sarki</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

<!--  <link rel="stylesheet" type="text/css" href="HomePageStyle.css">-->



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
        var ssss = "";
        var ems ="<?php echo $_GET['em'] ?>";


    var imageUrl = "<?php echo "$covpic"?>";
    var counter=0;
    var clicked = false;
    var child = "";
    $(".bgArtist").css("background-image", "url(" + imageUrl + ")");
$('.pla').click(function () {
    window.location = "http://localhost/testAjax.php?songing="+$(this).prev().text();


    // $(this).removeClass("animated heartBeat rollIn ");
    if($(this).find('img').attr("src")=="https://www.trzcacak.rs/myfile/full/111-1117116_play-button-filetype-phone-icon-png-pink.png"){
        $(this).find('img').attr("src" , "https://cdn3.iconfinder.com/data/icons/gradient-circle/36/5014-512.png");
        $('audio').trigger('play');
    }
    else {
        $(this).find('img').attr("src" , "https://www.trzcacak.rs/myfile/full/111-1117116_play-button-filetype-phone-icon-png-pink.png");
        //$('audio').trigger('pause');
    }

   // createCookie("sss",  $(this).prev().text(), "10");

    $.ajax({
        type: "GET",
        url: 'ArtistProfile.php',
        data: {hist:$(this).prev().text() , emm:ems},
        // success: function(data){
        //     alert(data);
        // }
    });



});




    // $('.strt').click(function () {
    //     $('#musicPlayer').css("visibility", "visible");
    //     $('audio').trigger('play');
    //     child = $(this).find('img');
    //     if($(child).attr("src")=="http://localhost/play-xxl.png")
    //         $(child).attr("src" , "http://localhost/pause-512.png");
    //     else {
    //         $(child).attr("src" , "http://localhost/play-xxl.png");
    //     }
    //
    //
    //
    //
    //
    //
    //
    // });



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



    $('.like_img').click(function () {

        $(this).removeClass("animated heartBeat rollIn ");
        if($(this).attr("src")=="http://pluspng.com/img-png/png-purple-heart-purple-heart-outline-clip-art-300.png") {
            $(this).addClass("animated heartBeat").attr("src", "http://pluspng.com/img-png/png-purple-heart-magenta-purple-heart-clip-art-at-clker-com-vector-clip-art-online-royalty-free-public-domain-600.png");

            $.ajax({
                type: "GET",
                url: 'ArtistProfile.php',
                data: {ur: $(this).attr("src") , tt:$(this).next().text() , xx:ems},
                // success: function(data){
                //     alert(data);
                // }
            });
        }
            else {
            $(this).addClass("animated headShake").attr("src" , "http://pluspng.com/img-png/png-purple-heart-purple-heart-outline-clip-art-300.png");
            $.ajax({
                type: "GET",
                url: 'ArtistProfile.php',
                data: {ur: $(this).attr("src")  ,tt:$(this).next().text()},
                // success: function(data){
                //     alert(data);
                // }
            });
            }


    });



        $('#overviewButton').click(function () {

            $('#songlist').hide();

        });
        $('#aboutButton').click(function () {
            $('#songlist').hide();



        });
    $('#songsButton').click(function () {

        $('#songlist').show();

    });


});
    function createCookie(name, value, days) {
        var expires;

        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toGMTString();
        }
        else {
            expires = "";
        }

        document.cookie = escape(name) + "=" +
            escape(value) + expires + "; path=/";
    }
</script>
<!--  <script>-->
<!---->
<!--      $(document).ready(function () {-->
<!--          $('a').addClass("text-white");-->
<!--          $('#navbarNav').on('show.bs.collapse', function () {-->
<!--              $(this).removeClass('bg-transparent').addClass('mine');-->
<!--          });-->
<!--          $('#navbarNav').on('hidden.bs.collapse', function () {-->
<!--              $(this).removeClass('mine').addClass('bg-transparent');-->
<!--          });-->
<!---->
<!---->
<!---->
<!---->
<!---->
<!---->
<!---->
<!---->
<!---->
<!--      });-->
<!--  </script>-->
<!--  <script>-->
<!---->
<!--  </script>-->
<!---->
<!---->
  <style>


    li {
      padding: 30px;
    }
    .bgArtist {
      /*background-image: url("http://localhost/mustafam2.png");*/


      height: 100%;

      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;

    }
   nav ul li.nav-item a:hover {
      border-bottom: 3px solid #8216ED;
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

    * {
      font-family: "Comic Sans MS", cursive, sans-serif;

      letter-spacing: 2px;
      word-spacing: 2px;

      font-weight: normal;
      text-decoration: none solid rgb(68, 68, 68);
      font-style: italic;
      font-variant: small-caps;
      text-transform: uppercase;
    }
  </style>

</head>
<body class="bg-dark animated fadeIn slow">


<div class="container-fluid" style="width: 85%; margin: auto;">
  <div style="padding: 50px;" class="bgArtist container-fluid d-flex align-items-center">
    <img class="rounded-circle" src="<?php echo $propic?>" width="150px" height="150px">
    <div id="information" class="d-flex flex-column mt-4 demoFont">
      <small style="background-color:rgba(0, 0, 0, 0.5); color: white;">Artist</small>
      <h1 class="demoFont text-center" style="background-color:rgba(0, 0, 0, 0.5); color: white; height: 45px;"><?php echo $name?></h1>
      <!--Here i made a trick to remove "choose file" text from buuton and change it to what i want-->

    </div>
  </div>

  <nav class="d-flex bg-transparent navbar-expand-lg navbar-dark demoFont">
    <ul class="nav navbar-nav">
      <li id="songsButton" class="nav-item"><a id="eee" href="#" class="nav-link" >Songs</a></li>
      <li id="overviewButton" class="nav-item"><a href="#" class="nav-link" >Overview</a></li>
      <li id="aboutButton" class="nav-item"><a href="#" class="nav-link" >About</a></li>
    </ul>
  </nav>

</div>
<hr>
<div class="container-fluid" style="width: 85%; margin: auto;">

  <ul id="songlist"  class="list-group animated slideInUp" >
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






    $song ="";
    $songpicture = "";
    $urlSong = "";

    $sql = "SELECT * FROM songs where singername='$sinQuery'";
    $conn->query("SET character_set_results=utf8mb4");
    $result = $conn->query($sql);
    $conn->query("SET character_set_results=utf8mb4");
    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        $song = $row['songname'];
        $songpicture = $row['songpic'];
        $urlSong = $row['songurl'];

        echo "<li class=\"list-group-item\" style=\"background-image: linear-gradient(to right top, #005eea, #3d51da, #5243c9, #6034b8, #6823a6);\"><div class=\"d-flex\" style=\"width: 100%;height: 20%;margin-bottom: 10px;\">

        <img src=\"$songpicture\" height=\"60px\" width=\"60px\">
        <img  class=\"pt-3 pb-2 ml-2 fa fa-thumbs-up like_img\" src=\"http://pluspng.com/img-png/png-purple-heart-purple-heart-outline-clip-art-300.png\" height=\"55px\" width=\"40px\">
        <h4 class=\"text-center text-white pt-3  ml-3 mr-auto\">$song</h4>
        <a href='#' style='z-index: 10;' class='pla'><img class='mt-2' height='50px' width='50px' src='https://www.trzcacak.rs/myfile/full/111-1117116_play-button-filetype-phone-icon-png-pink.png'></a>
        
      </div></li>
    <br/>";
      }
    }
    else {
      if ($sinQuery == "Bengü") {
        notRecognizeSong("Ben");
      }
      elseif ($sinQuery=="Güliz Ayla") {
        notRecognizeSong("ayla");
      }
      elseif ($sinQuery=="İlyas Yalçıntaş") {
        notRecognizeSong("ilyas");
      }
      elseif ($sinQuery=="İrem Derici") {
        notRecognizeSong("irem");
      }
      elseif ($sinQuery=="Irmak Arıcı") {
        notRecognizeSong("irmak");
      }
      elseif ($sinQuery=="Koray Avcı") {
        notRecognizeSong("koray");
      }
      elseif ($sinQuery=="Merve Özbey") {
        notRecognizeSong("merve");
      }
      elseif ($sinQuery=="Oğuzhan Koç") {
        notRecognizeSong("ozhan");
      }
      elseif ($sinQuery=="Toygar Işıklı") {
        notRecognizeSong("toygar");
      }
      elseif ($sinQuery=="Tuğçe Kandemir") {
        notRecognizeSong("kandemir");
      }
      elseif ($sinQuery=="Yıldız Tilbe") {
        notRecognizeSong("tilbe");
      }
      elseif ($sinQuery=="Feride Hilal Akın") {
        notRecognizeSong("feride");
      }
      elseif ($sinQuery=="Musa Eroğlu") {
        notRecognizeSong("musa");
      }

    }

    function notRecognizeSong($str) {

      $sql = "SELECT * FROM songs where singername in(select singername from singers where about='$str')";
      $GLOBALS["conn"]->query("SET character_set_results=utf8mb4");
      $result = $GLOBALS["conn"]->query($sql);
      $GLOBALS["conn"]->query("SET character_set_results=utf8mb4");
      if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
         $x =  $GLOBALS['song'] = $row['songname'];
          $y = $GLOBALS['songpicture'] = $row['songpic'];
          $z = $GLOBALS['urlSong'] = $row['songurl'];

          echo "<li class=\"list-group-item\" style=\"background-image: linear-gradient(to right top, #005eea, #3d51da, #5243c9, #6034b8, #6823a6);\"><div class=\"d-flex\" style=\"width: 100%;height: 20%;margin-bottom: 10px;\">

        <img src=\"$y\" height=\"60px\" width=\"60px\">
        <img  class=\"pt-3 pb-2 ml-2 fa fa-thumbs-up like_img\" src=\"http://pluspng.com/img-png/png-purple-heart-purple-heart-outline-clip-art-300.png\" height=\"55px\" width=\"40px\">
        <h4 class=\"text-center text-white pt-3  ml-3 mr-auto\">$x</h4>
        <a href='#' class='pla' ><img  class='mt-2' height='50px' width='50px' src='https://www.trzcacak.rs/myfile/full/111-1117116_play-button-filetype-phone-icon-png-pink.png'></a>
        
      </div></li>
    <br/>";
        }
      }
    }




    ?>




  </ul>




<script src="js/wow.min.js"></script>
<script>
    new WOW().init();
</script>
  <div id="musicPlayer" class="missing d-flex align-items-center mt-5 text-white fixed-bottom" style="padding-bottom: 5px;visibility: hidden; background-image: linear-gradient(to right top, #005eea, #3d51da, #5243c9, #6034b8, #6823a6);"> <!--The bottom music player-->
    <button type="button" class="close" data-dismiss="missing" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
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
  <audio  controls class="fixed-bottom container-fluid mine" preload="none"  style="border-radius: 0; visibility: hidden;"
          ontimeupdate="document.getElementById('tracktime').innerHTML =Math.floor(this.currentTime) + ' / ' + (Math.floor(this.duration));
document.getElementById('myRange').value =Math.floor(this.currentTime);document.getElementById('myRange').max =Math.floor(this.duration);">

    <source src=""  type="audio/mp3" >
    Your browser does not support the audio element.
  </audio>




</body>
</html>





