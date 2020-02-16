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
$name = "";
$userEmail = $_SESSION['emailAdd'];
$userPass = $_SESSION['passing'];
if(empty($_SESSION['emailAdd']) or empty($_SESSION['passing'])){
 header('Location:http://localhost/HomePage.php');
}
$sql = "SELECT * FROM users where email='$userEmail' and password='$userPass'";
$conn->query("SET character_set_results=utf8mb4");
$result = $conn->query($sql);
$conn->query("SET character_set_results=utf8mb4");
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $name = $row['fname']." ".$row['lname'];
    $propic = $row['profilepic'];
    $copic = $row['coverpic'];

  }
}

if(isset($_GET['ttr'])){
  $ar = $_GET['ttr'];
  $sql47 = "DELETE FROM userLikes WHERE songName='$ar'";
  $conn->query($sql47);
}

$ob = "";


if(isset($_GET['kvcArray'])){
  $ob = json_decode($_GET['kvcArray']);
  $st = $conn->prepare("INSERT INTO playlists (listname, userEmail,songname) VALUES (?, ?, ?)");
  $st->bind_param("sss", $liste, $userEmails, $sonname);
  $liste =$_GET['list'];
  $userEmails = $userEmail;
  for ($x = 0; $x <count($ob); $x++){

    $sonname = $ob[$x] ;
    $st->execute();
  }


  $st->close();

}

if(isset($_GET['clear'])){
  $sql88 = "DELETE FROM history WHERE userEmail='$userEmail'";
  $conn->query($sql88);
}

if(isset($_GET['cl'])){
  session_unset();
}
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
  <script>

      $(document).ready(function () {
          $.validate({
              form : '#playlistform' ,
              onblur:false
          });

          //this is for hide and show divs like "likes" "overview" and "history" and add animation on Show them
         $('#likes').hide();
         $('#likesbutton').click(function () {
             $('#first').toggleClass("animated slideInLeft slow");
             $('#sec').toggleClass("animated slideInRight slow");
             $('#thd').toggleClass("animated slideInLeft slow");
             $('#likes').toggle();
         });

          // // This is for change background image if "update image button in profile user"//
          // $('#files').hide();
          // $('#information').mouseenter(function () {
          //     $('#files').show();
          // });
          // $('#information').mouseout(function () {
          //     $('#files').hide();
          // });
          // $('#files').mouseenter(function () {
          //     $(this).addClass('linearOver');
          //
          // });
          // $('#files').mouseout(function () {
          //     $(this).removeClass('linearOver');
          //
          // });


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





          });
          $('#accordion').hide();
$('#myLikes').hide();
$('#myHistory').hide();
$('#playListDiv').hide();
$('#playlistchoose').hide();
$('#likesbutton').click(function () {
    $('#playlistchoose').hide();
    $('#myLikes').show();
    $('#myHistory').hide();
    $('#playListDiv').hide();
    $('#accordion').hide();
$(this).css("border-bottom", "3px solid #8216ED");
    $('#playlistsButton').children().css("border-bottom", "none");
    $('#historyButton').children().css("border-bottom", "none");
});
          $('#playlistsButton').click(function () {

              $('#playListDiv').show();
              $('#accordion').show();
              $('#myLikes').hide();
              $('#myHistory').hide();
              $(this).children().css("border-bottom", "3px solid #8216ED");
              $('#likesbutton').css("border-bottom", "none");
              $('#historyButton').children().css("border-bottom", "none");
              $('#playlistchoose').hide();
          });
          $('#historyButton').click(function () {
              $('#myHistory').show();
              $('#myLikes').hide();
              $(this).children().css("border-bottom", "3px solid #8216ED");
              $('#likesbutton').css("border-bottom", "none");
              $('#playlistsButton').children().css("border-bottom", "none");
              $('#playListDiv').hide();
              $('#playlistchoose').hide();
              $('#accordion').hide();
          });
          $('#createListButton').click(function () {
              $('#accordion').hide();
              //$('#playlistchoose').show();
                  var x = document.getElementById("playlistchoose");
                  if (x.style.display === "none") {
                      x.style.display = "block";
                  } else {
                      $('#accordion').show();
                      x.style.display = "none";
                  }

          });


          $('.like_img').click(function () {
              $(this).removeClass("animated heartBeat rollIn ");
              $(this).addClass("animated heartBeat").attr("src" , "http://pluspng.com/img-png/png-purple-heart-purple-heart-outline-clip-art-300.png");
              $.ajax({
                  type: "GET",
                  url: 'UserProfile.php',
                  data: {ttr:$(this).next().text()},
                  // success: function(data){
                  //     alert(data);
                  // }
              });
          });
var arrayOfSongs = [];
$('.checkbox').click(function () {
    if($(this).attr("src")=="https://cdn3.iconfinder.com/data/icons/ui-base-set/100/Artboard_41_copy_48-512.png"){
        $(this).addClass('animated rollIn ').attr("src" , "http://localhost/checkbox.png");
        arrayOfSongs.push($(this).prev().text());
    }
    else{
        $(this).addClass('bounce').removeClass('rollIn').attr("src" , "https://cdn3.iconfinder.com/data/icons/ui-base-set/100/Artboard_41_copy_48-512.png");
    }
});
$('.suc').hide();
$('#playlistform').submit(function () {
    var myJSONText = JSON.stringify(arrayOfSongs);
    $.ajax({
        type: "GET",
        url: "UserProfile.php",
        data: { kvcArray: myJSONText , list:$('#listname').val()},
        success: function(data){
            $('.suc').show();
        }
    });

});

$('#createListButton').mouseenter(function () {
    $(this).css("background-image", "linear-gradient(to right top, #7e00f4, #8216ed, #8623e7, #892de0, #8c35da)");
});
          $('#createListButton').mouseout(function () {
              $(this).css("background-image", "linear-gradient(to right top, #005eea, #3d51da, #5243c9, #6034b8, #6823a6)");
          });
          $('[data-toggle="tooltip"]').tooltip();
          $('#clearHistory').mouseenter(function () {
              $(this).css("background-image", "linear-gradient(to right top, #7e00f4, #8216ed, #8623e7, #892de0, #8c35da)");
          });
          $('#clearHistory').mouseout(function () {
              $(this).css("background-image", "linear-gradient(to right top, #005eea, #3d51da, #5243c9, #6034b8, #6823a6)");
          });
$('#clearHistory').click(function () {
    $.ajax({
        type: "GET",
        url: "UserProfile.php",
        data: { clear:"clear"},

    });
});

$('#logoutform').submit(function () {
    $.ajax({
        type: "GET",
        url: "UserProfile.php",
        data: { cl:"clear"},

    });
});
          $('.stepper').mdbStepper();
      });
  </script>
  <script>

  </script>


  <style>
    .has-error {
      color:red;
      font-size: 10px;
    }
    .modal-dialog{
      overflow-y: initial !important
    }
    .modal-body{
      height: 250px;
      overflow-y: auto;
    }
    li {
      padding: 30px;
    }
    .bg1 {
      background-image: url("<?php echo $copic?>");


      height: 35%;

      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;

    }
    .demoFont {
      font-family: "Comic Sans MS", cursive, sans-serif;
      font-size: 25px;
      letter-spacing: 2px;
      word-spacing: 2px;
      color: #000000;!important;
      font-weight: normal;
      text-decoration: none solid rgb(68, 68, 68);
      font-style: italic;
      font-variant: small-caps;
      text-transform: uppercase;
    }


    body , html {
      height:100%;
    }
    ul li a:hover {
      border-bottom: 3px solid #8216ED;
    }
    input[type='file'] {
     color: transparent;
    }

    .linearBack {
      border-radius: 20px;
      background-image: linear-gradient(to right top, #005eea, #3d51da, #5243c9, #6034b8, #6823a6);
      font-weight: bold;
      color: white;
    }

    .linearOver {
      color: #ffffff;
      background-image: linear-gradient(to right top, #7e00f4, #8216ed, #8623e7, #892de0, #8c35da);


    }

    .mine {
      background-image: linear-gradient(to right top, #005eea, #3d51da, #5243c9, #6034b8, #6823a6);
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



  </style>

</head>

<body class="bg-dark animated fadeIn slow" style="overflow-y: scroll;">
<?php

$sql86 = "SELECT * FROM users where email='$userEmail'";
$conn->query("SET character_set_results=utf8mb4");
$result86 = $conn->query($sql86);
$conn->query("SET character_set_results=utf8mb4");
if ($result86->num_rows > 0) {
  while($row = $result86->fetch_assoc()) {
    $profpic = $row['profilepic'];

  }
}


?>
<div class="container-fluid" style="width: 85%; margin: auto;">
  <div id="profileHeader" class="bg1 container-fluid d-flex align-items-center">
  <img class="rounded-circle" src="<?php echo $profpic?>" width="150px" height="150px">
  <div id="information" class="d-flex flex-column mt-4">
    <h1 class="demoFont text-center pt-2" style="background-color:rgba(0, 0, 0, 0.5); color: white; height: 45px;"><?php echo $name; //session_unset(); ?></h1>
    <!--Here i made a trick to remove "choose file" text from buuton and change it to what i want-->

  </div>

</div>
  <div class="d-flex justify-content-end demoFont" style="color: #fff9c0;">

    <div class="btn-group">
      <button style="background-image: linear-gradient(to right top, #005eea, #3d51da, #5243c9, #6034b8, #6823a6);" type="button" class="btn"><img width="30px" height="30px" src="https://cdn3.iconfinder.com/data/icons/gradient-circle/36/5077-512.png"> Settings</button>
      <button style="background-image: linear-gradient(to right top, #005eea, #3d51da, #5243c9, #6034b8, #6823a6);" type="button" class="btn dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference"
              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
        <span class="sr-only">Toggle Dropdown</span>
      </button>
      <div class="dropdown-menu animated fadeIn" aria-labelledby="dropdownMenuReference">
        <button data-toggle="modal" data-target="#myModal" style=";background-image: linear-gradient(to right top, #005eea, #3d51da, #5243c9, #6034b8, #6823a6);width: 250px;" class="btn dropdown-item text-white ">Edit Your Profile</button>
        <button data-toggle="modal" data-target="#modalPass" style="background-image: linear-gradient(to right top, #005eea, #3d51da, #5243c9, #6034b8, #6823a6);width: 250px;" class="btn dropdown-item text-white ">Change Your Password</button>
        <div class="dropdown-divider"></div>
        <form  class="dropdown-item" id="logoutform" action="http://localhost/HomePage.php" method="post">
          <button style="border-radius: 50px;margin-left: 0;background-image: linear-gradient(to right top, #005eea, #3d51da, #5243c9, #6034b8, #6823a6);" type="submit" class="btn text-white">Logout  <i class="fas fa-sign-out-alt"></i></button>
        </form>
      </div>
    </div>
  </div>




    <hr>
  <nav class="d-flex bg-transparent justify-content-center  navbar-expand-lg navbar-dark demoFont">
    <ul class="nav navbar-nav">
      <li class="nav-item"><a id="likesbutton" href="#" class="nav-link" >Likes</a></li>
      <li class="nav-item"><a href="http://localhost/ArtistsPage.php?emails=<?php echo $userEmail?>" class="nav-link">Artists</a></li>
      <li id="playlistsButton" class="nav-item"><a href="#" class="nav-link" >Playlists</a></li>
      <li id="historyButton" class="nav-item"><a href="#" class="nav-link" >History</a></li>
    </ul>
  </nav>


<div class="container-fluid" style="width: 85%; margin: auto;">
  <div id="playListDiv" class="animated slideInLeft">
    <button data-toggle="tooltip" data-html="true" title="create your own playlists" style=" background-image: linear-gradient(to right top, #005eea, #3d51da, #5243c9, #6034b8, #6823a6);border-radius: 20px;" id="createListButton" type="button" class="btn btn-primary" >Create a PlayList</button>
  </div>
  <div class="alert suc alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>Success!</strong> The PlayList Created Successfully !
  </div>
  <ul id="myLikes" class="list-group animated slideInUp demoFont">
    <?php

    $sql60 = "SELECT * FROM userlikes where userEmail='$userEmail'";

    $conn->query("SET character_set_results=utf8mb4");
    $result60 = $conn->query($sql60);
    $conn->query("SET character_set_results=utf8mb4");
    if ($result60->num_rows > 0) {
      // output data of each row
      while($row = $result60->fetch_assoc()) {
$srr = $row['songName'];
$sqs = "SELECT * FROM songs where songname='$srr'";
        $conn->query("SET character_set_results=utf8mb4");
        $result44 = $conn->query($sqs);
        $conn->query("SET character_set_results=utf8mb4");
        if ($result44->num_rows > 0) {
          // output data of each row
          while($row = $result44->fetch_assoc()) {
           $sonpic = $row['songpic'];
          }
        }

        echo "<li class=\"list-group-item\" style=\"background-image: linear-gradient(to right top, #005eea, #3d51da, #5243c9, #6034b8, #6823a6);\"><div class=\"d-flex\" style=\"width: 100%;height: 20%;margin-bottom: 10px;\">

        <img src=\"$sonpic\" height=\"60px\" width=\"60px\">
        <img  class=\"pt-3 pb-2 ml-2 fa fa-thumbs-up like_img\" src=\"http://pluspng.com/img-png/png-purple-heart-magenta-purple-heart-clip-art-at-clker-com-vector-clip-art-online-royalty-free-public-domain-600.png\" height=\"55px\" width=\"40px\">
        <h4 class=\"text-center text-white pt-3  ml-3 mr-auto\">$srr</h4>
        <a href='#' style='z-index: 10;' class='pla'><img class='mt-2' height='50px' width='50px' src='https://www.trzcacak.rs/myfile/full/111-1117116_play-button-filetype-phone-icon-png-pink.png'></a>
        
      </div></li>
    <br/>";
      }
    }

    ?>


  </ul>
  <ul id="myHistory" class="list-group animated slideInUp demoFont">
    <form action="UserProfile.php?emailing=<?php echo $userEmail?>" method="POST">
    <input   id="clearHistory" type="submit" style="width: 200px; border-radius: 20px;color: #fff9c0;background-image: linear-gradient(to right top, #005eea, #3d51da, #5243c9, #6034b8, #6823a6); font-size: medium;" class="btn" value="Clear History">
    </form>
      <?php

    $sql20 = "SELECT * FROM history where userEmail='$userEmail'";

    $conn->query("SET character_set_results=utf8mb4");
    $result20 = $conn->query($sql20);
    $conn->query("SET character_set_results=utf8mb4");
    if ($result20->num_rows > 0) {
      // output data of each row
      while($row = $result20->fetch_assoc()) {
        $srrs = $row['songName'];
        $sqss = "SELECT * FROM songs where songname='$srrs'";
        $conn->query("SET character_set_results=utf8mb4");
        $result21 = $conn->query($sqss);
        $conn->query("SET character_set_results=utf8mb4");
        if ($result21->num_rows > 0) {
          // output data of each row
          while($row = $result21->fetch_assoc()) {
            $sonpics = $row['songpic'];
          }
        }

        echo "<li class=\"list-group-item\" style=\"background-image: linear-gradient(to right top, #005eea, #3d51da, #5243c9, #6034b8, #6823a6);\"><div class=\"d-flex\" style=\"width: 100%;height: 20%;margin-bottom: 10px;\">

        <img src=\"$sonpics\" height=\"60px\" width=\"60px\">
        <!--img  class=\"pt-3 pb-2 ml-2 fa fa-thumbs-up like_img\" src=\"http://pluspng.com/img-png/png-purple-heart-magenta-purple-heart-clip-art-at-clker-com-vector-clip-art-online-royalty-free-public-domain-600.png\" height=\"55px\" width=\"40px\"-->
        <h4 class=\"text-center text-white pt-3  ml-3 mr-auto\">$srrs</h4>
        <a href='#' style='z-index: 10;' class='pla'><img class='mt-2' height='50px' width='50px' src='https://www.trzcacak.rs/myfile/full/111-1117116_play-button-filetype-phone-icon-png-pink.png'></a>
        
      </div></li>
    <br/>";
      }
    }

    ?>
  </ul>










<!--  <ul id="playlistsMenu"  class="list-group animated slideInUp demoFont">-->
  <div id="accordion">
    <div class="card ">









    <?php
$myflag ="";
$counting = 0;
    $sql66 = "SELECT listname FROM playlists where userEmail='$userEmail'";

    $conn->query("SET character_set_results=utf8mb4");
    $result66 = $conn->query($sql66);
    $conn->query("SET character_set_results=utf8mb4");
    if ($result66->num_rows > 0) {
      // output data of each row
      while($row = $result66->fetch_assoc()) {
        if($row['listname']==$myflag)
          continue;
        $sttt = $row['listname'];
        $myflag = $sttt;
       // echo "$sttt";
        $sqsss = "SELECT * FROM playlists where listname='$sttt'";
        $conn->query("SET character_set_results=utf8mb4");
        $result99 = $conn->query($sqsss);
        $conn->query("SET character_set_results=utf8mb4");
        echo "<div style='background-color: #3d51da;' class=\"card-header text-center\">
        <a style='color: #fff9c0;' class=\"card-link  demoFont \" aria-expanded=\"false\" data-toggle=\"collapse\" href=\"#collapse$counting\">
          $sttt
        </a>
      </div>";
        if ($result99->num_rows > 0) {
          // output data of each row
          while($row = $result99->fetch_assoc()) {
            $lisaname = $row['listname'];
            $somame = $row['songname'];


            $ssss = "SELECT * FROM songs where songname='$somame'";
            $conn->query("SET character_set_results=utf8mb4");
            $result46 = $conn->query($ssss);
            $conn->query("SET character_set_results=utf8mb4");
            if ($result46->num_rows > 0) {
              // output data of each row
              while($row = $result46->fetch_assoc()) {
                $sonpica = $row['songpic'];
              }
            }


            echo " 
      <div id=\"collapse$counting\" class=\"collapse demoFont\" data-parent=\"#accordion\">
        <div class=\"card-body bg-dark\">
        <li class=\"list-group-item\" style=\"background-image: linear-gradient(to right top, #005eea, #3d51da, #5243c9, #6034b8, #6823a6);\"><div class=\"d-flex\" style=\"width: 100%;height: 20%;margin-bottom: 10px;\">

        <img src=\"$sonpica\" height=\"60px\" width=\"60px\">
        <!--img  class=\"pt-3 pb-2 ml-2 fa fa-thumbs-up like_img\" src=\"http://pluspng.com/img-png/png-purple-heart-magenta-purple-heart-clip-art-at-clker-com-vector-clip-art-online-royalty-free-public-domain-600.png\" height=\"55px\" width=\"40px\"-->
        <h4 class=\"text-center text-white pt-3  ml-3 mr-auto\">$somame</h4>
        <a href='#' style='z-index: 10;' class='pla'><img class='mt-2' height='50px' width='50px' src='https://www.trzcacak.rs/myfile/full/111-1117116_play-button-filetype-phone-icon-png-pink.png'></a>
        
      </div></li>
    <br/>
        </div>
      </div>";


          }
        }

        $counting = $counting+1;
      }
    }

    ?>
    </div>
  </div>
<!--  </ul>-->












</div>



<script src="js/wow.min.js"></script>
<script>
    new WOW().init();
</script>
  <div id="playlistchoose" class="container-fluid demoFont" style="width: 85%;">
    <div class="d-flex justify-content-start">
      <form id="playlistform" action="UserProfile.php?emailing=<?php echo $userEmail?>" method="POST" class="mr-auto">
        <div class="md-form" >
          <input  data-validation-error-msg="Please Enter PlayList name"   data-validation="length" data-validation-length="min1"   type="text" id="listname" class="form-control" name="List_name" style="color: #ffffff;">
          <label style="color: #fff9c0" for="listname">Enter List name</label>
        </div>
        <input id="submition" class="btn btn-success" type="submit" value="Save Changes">
      </form>
      <button style="height: 50px;width: 200px; margin-top: 90px;" class="btn btn-danger" >Cancel</button>

    </div>
    <ul  class="list-group animated slideInUp demoFont">
      <?php

      $sql60 = "SELECT * FROM userlikes where userEmail='$userEmail'";

      $conn->query("SET character_set_results=utf8mb4");
      $result60 = $conn->query($sql60);
      $conn->query("SET character_set_results=utf8mb4");
      if ($result60->num_rows > 0) {
        // output data of each row
        while($row = $result60->fetch_assoc()) {
          $srr = $row['songName'];
          $sqs = "SELECT * FROM songs where songname='$srr'";
          $conn->query("SET character_set_results=utf8mb4");
          $result44 = $conn->query($sqs);
          $conn->query("SET character_set_results=utf8mb4");
          if ($result44->num_rows > 0) {
            // output data of each row
            while($row = $result44->fetch_assoc()) {
              $sonpic = $row['songpic'];
            }
          }
          echo "<div class=\"custom-control d-inline custom-checkbox\">
  <input type=\"checkbox\" class=\"custom-control-input\" >
  
</div>";
          echo "<li class=\"list-group-item\" style=\"background-image: linear-gradient(to right top, #005eea, #3d51da, #5243c9, #6034b8, #6823a6);\"><div class=\"d-flex bef\" style=\"width: 100%;height: 20%;margin-bottom: 10px;\">

        <img src=\"$sonpic\" height=\"60px\" width=\"60px\">
        
        <h4 class=\"text-center text-white pt-3  ml-3 mr-auto\">$srr</h4>
<img  class='mt-2 checkbox' src='https://cdn3.iconfinder.com/data/icons/ui-base-set/100/Artboard_41_copy_48-512.png' width='70px' , height='70px'>      
      </div></li>
    <br/>";
        }
      }

      ?>


    </ul>

  </div><!-- container of modal-->





<?php
$sql111 = "SELECT fname , lname FROM users where email='$userEmail'";
$result111 = $conn->query($sql111);

if ($result111->num_rows > 0) {
  // output data of each row
  while($row = $result111->fetch_assoc()) {
   $fname = $row['fname'];
   $lname = $row['lname'];
  }
}

?>











  <!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit Your Profile</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <!-- Material input -->
          <form action="UserProfile.php?emailing=<?php echo $userEmail?>" method="POST">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">First and last name</span>
            </div>
            <br/>

            <input name="fsname" value="<?php echo $fname?>"  type="text" aria-label="First name" class="form-control">
            <input name="lsname"  value="<?php echo $lname?>" type="text" aria-label="Last name" class="form-control">
            <input class="btn" type="submit" value="Save Changes" style="margin-top: 0;background-image: linear-gradient(to right top, #005eea, #3d51da, #5243c9, #6034b8, #6823a6);">

          </div>
          </form>
          <hr>
          <form action="UserProfile.php?emailing=<?php echo $userEmail?>" method="POST">
          <label class="demoFont" for="files">Update Profile Image </label>
          <button style="width: 60% ;font-size: 10px;letter-spacing: 2px;font-family: Comic Sans MS", cursive, sans-serif; class="btn linearBack text-white" id="files" onclick="document.getElementById('file').click(); return false;">Choose Profile Image</button>
          <input accept="image/*" type="file" id="file" name="profile" style="visibility: hidden;">
            <input class="btn" type="submit" value="Save Changes" style="margin-top: 0;background-image: linear-gradient(to right top, #005eea, #3d51da, #5243c9, #6034b8, #6823a6);">
          </form>
            <hr>
          <form action="UserProfile.php?emailing=<?php echo $userEmail?>" method="POST">
          <label class="demoFont" for="files1">Update Cover Image </label>
          <button style="width: 60% ;font-size: 10px;letter-spacing: 2px;font-family: Comic Sans MS", cursive, sans-serif; class="btn linearBack text-white" id="files1" onclick="document.getElementById('file2').click(); return false;">Choose Cover Image</button>
          <input accept="image/*" type="file" id="file2" name="cover" style="visibility: hidden;">
            <input class="btn" type="submit" value="Save Changes" style="margin-top: 0;background-image: linear-gradient(to right top, #005eea, #3d51da, #5243c9, #6034b8, #6823a6);">
          </form>
        </div>



        <!-- Modal footer -->
        <div class="modal-footer">



          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>







<?php


if( isset($_POST['fsname']) && isset($_POST['lsname']) ) {
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(!empty($_POST['fsname']) &&!empty($_POST['lsname'])){
      $fn = $_POST['fsname'];
      $ln = $_POST['lsname'];

      $sql90 = "UPDATE users SET fname='$fn' , lname='$ln' WHERE email='$userEmail'";
      $conn->query($sql90);
    }



  }


}

if( isset($_POST['profile'])) {
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(!empty($_POST['profile'])){
      $pr = $_POST['profile'];

      $sql91 = "UPDATE users SET profilepic='http://localhost/$pr' where email='$userEmail'";
      $conn->query($sql91);
    }



  }


}

if( isset($_POST['cover'])) {
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(!empty($_POST['cover'])){
      $co = $_POST['cover'];

      $sql91 = "UPDATE users SET coverpic='http://localhost/$co' where email='$userEmail'";
      $conn->query($sql91);

    }



  }


}
?>



















  <!-- The Modal -->
  <div class="modal fade" id="modalPass">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Change Yor Password</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <form action="UserProfile.php?emailing=<?php echo $userEmail?>" method="POST">
        <div class="modal-body">
          <ul class="stepper linear">
            <li class="step active">
              <div style="margin-top: 0;"  id="anPass" data-step-label="Type something" class="step-title waves-effect waves-dark">Step 1</div>
              <div class="step-new-content">
                <div class="row">
                  <div class="md-form col-12 ml-auto">
                    <input name="curpass" id="email-linear" type="password" class="form-control validate" required>
                    <label for="email-linear">Current Password</label>
                    <a href="#passDiv" class="waves-effect waves-dark btn btn-sm btn-primary next-step">CONTINUE</a>
                  </div>

                </div>
                <div class="step-actions">
                </div>
              </div>
            </li>
            <li class="step">
              <div id="passDiv" class="step-title waves-effect waves-dark">Step 2</div>
              <div class="step-new-content">
                <div class="row">
                  <div class="md-form col-12 ml-auto">
                    <input name="newpass" id="password-linear" type="password" class="form-control validate" required>
                    <label for="password-linear">Type a new Password</label>
                  </div>
                </div>
                <div class="step-actions">
                  <a href="#subS" class="waves-effect waves-dark btn btn-sm btn-primary next-step">CONTINUE</a>
                  <a href="#anPass" class="waves-effect waves-dark btn btn-sm btn-secondary previous-step">BACK</a>
                </div>
              </div>
            </li>
            <li class="step">
              <div id="subS" class="step-title waves-effect waves-dark">Step 3</div>
              <div class="step-new-content">
                Finish!
                <div class="step-actions">
                  <button class="waves-effect waves-dark btn btn-sm btn-primary m-0 mt-4" type="submit">Change Yor Password</button>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </form>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>






  <?php


  if( isset($_POST['curpass']) && isset($_POST['newpass']) ) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if(!empty($_POST['curpass']) &&!empty($_POST['newpass']) &&$_POST['curpass']==$userPass){

        $cp = $_POST['curpass'];
        $np = $_POST['newpass'];

        $sql97 = "UPDATE users SET password='$np'";
        $conn->query($sql97);
        echo "<script>alert('Password has been Changed Successfully!')</script>";



      }
      else{
        if($_POST['curpass']!=$userPass)
        echo "<script>alert('Faild to change your password Please Try Again! ')</script>";
      }



    }


  }


  ?>




</body>

</html>
