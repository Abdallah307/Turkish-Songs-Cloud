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


?>

<!DOCTYPE html>

<html lang="en" xml:lang="en" xmlns:https="http://www.w3.org/1999/xhtml">
<head>
  <title>Sarki</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" type="text/css" href="HomePageStyle.css">
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

      $('.cardButtons').click(function () {
          var singer = $(this).prev().text();
         // window.open("http://localhost/ArtistProfile.php?singername="+singer);
          window.location = "http://localhost/ArtistProfile.php?singer="+singer+"&em="+"<?php echo $_GET['emails']?>";


      });
      $('#artistWord').addClass("animated slideInUp slow");
      $(".card").addClass("animated slideInUp");
      //this function i used for if i clicked on singer's image card ot will act as if its button go to his profile
      $('.view').click(function () {
          var par = $(this).parent();
          var singer = $(par).find('h4').text();
          // window.open("http://localhost/ArtistProfile.php?singername="+singer);
          window.location = "http://localhost/ArtistProfile.php?singer="+singer+"&em="+"<?php echo $_GET['emails']?>";


      });


  });

</script>


<style>
  .backGR {
    background-image: url("http://localhost/artists(3).png");


    height: 100%;
    /*display: block;*/
    max-width: 100%;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;


  }
  body , html {
    height:100%;
  }
  .demoFont {
    font-family: "Comic Sans MS", cursive, sans-serif;
    font-size: 6vw;
    letter-spacing: 2px;
    word-spacing: 2px;
    color: #000000;!important;
    font-weight: normal;
    text-decoration: none solid rgb(68, 68, 68);
    font-style: italic;
    font-variant: small-caps;
    text-transform: uppercase;
  }


  .cardButtons {
    border-radius: 20px;
    background-image: linear-gradient(to right top, #005eea, #3d51da, #5243c9, #6034b8, #6823a6);
    font-weight: bold;
  }

  .cardButtons:hover {
    color: #ffffff;
    background-image: linear-gradient(to right top, #7e00f4, #8216ed, #8623e7, #892de0, #8c35da);
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

<body class="bg-dark">

  <div class="container-fluid backGR d-flex justify-content-center align-items-center" style="height: 400px;">
      <h1 id="artistWord" class="text-center text-white demoFont">Artists</h1>
  </div>
  <br/><br/>
  <div class="container-fluid d-flex justify-content-center align-items-center">
    <div class="">
    <form action="" class="form-inline mr-auto">
      <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
      <button class="btn blue-gradient btn-rounded btn-sm my-0" type="submit">Search</button>
    </form>
    </div>
  </div>
<br/><br/>
  <div class="container-fluid">
   <div class="row d-flex justify-content-around align-items-center mr-auto">
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

     $sql = "SELECT singername, singercoverpic, singerprofilepic FROM singers";
     $conn->query("SET character_set_results=utf8mb4");
     $result = $conn->query($sql);

     if ($result->num_rows > 0) {
       // output data of each row
       while($row = $result->fetch_assoc()) {
//         echo "<br> id: ". $row["id"]. " - Name: ". $row["firstname"]. " " . $row["lastname"] . "<br>";
         $profilepic = $row["singerprofilepic"];
         $name = $row["singername"];
         $_SESSION["profile"] = $profilepic;
         $_SESSION["name"] =$name;

         echo "
<!-- Card -->
     <div class=\"card wow slow\" style=\"width: 400px; height: 420px; margin-bottom: 30px;\">

       <!-- Card image -->
       <div class=\"view overlay\">
         <img class=\"card-img-top fa fa-thumbs-up\" src=\"$profilepic\">
         <a href=\"#!\">
           <div class=\"mask rgba-white-slight\"></div>
         </a>
       </div>

       <!-- Card content -->
       <div class=\"card-body d-flex justify-content-center align-items-center flex-column\">

         <!-- Title -->
         <h4 lang='tr' class=\"card-title text-center\">$name</h4>
         <!-- Text -->
<!--         <p class=\"card-text\">Some quick example text to build on the card title and make up the bulk of the card's content.</p>-->
         <!-- Button -->
         <a  href=\"#\" class=\"btn cardButtons\" style=\"height: 50px; width: 250px;\">View Artist Page</a>

       </div>

     </div>
    
     <!-- Card -->";
         echo "<br/><br/><br/>";
       }
     }

     $conn->close();

     ?>


   </div>


  </div><!--artists cards big divider-->



<script src="js/wow.min.js"></script>
<script>
    new WOW().init();

</script>
</body>
</html>
