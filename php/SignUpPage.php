<?php error_reporting (E_ALL ^ E_NOTICE); ?>
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

$sql = "SELECT * FROM users";
$result = $conn->query($sql);
$flag = false;
$flag2 = false;
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
  if($row["email"]==$_POST['email'] ){
    $flag = true;
  }
  if($row['phone']==$_POST['phone'] ){
      $flag2 = true;
    }

  }
  if($flag==true){

  }
}



static $qq = 0;
// prepare and bind

  $stmt = $conn->prepare("INSERT INTO users  (fname, lname, email , password , phone) VALUES (?, ?, ? , ? , ?)");
  $stmt->bind_param("ssssi", $firstname, $lastname, $email, $pass, $phone);



$nameErr = "";
$spanErr = "";

$phoneErr = "";
$phoneSpanError = "";
$successFlag = false;
// set parameters and execute
if(isset($_POST["fname"]) && isset($_POST["lname"]) && isset($_POST["email"]) && isset($_POST["pass"]) && isset($_POST["phone"]))
{
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if ($flag == true) {
    $nameErr = "1px solid red";
    $spanErr = "Another account is using ".$_POST['email'];
  }
  elseif ($flag2==true){
    $phoneErr = "1px solid red";
    $phoneSpanError = "Another account is using ".$_POST['phone'];
  }else {
    $email = test_input($_POST["email"]);
    $firstname = test_input($_POST["fname"]);
    $lastname = test_input($_POST["lname"]);
    //  $email = test_input($_POST["email"]);
    $pass = test_input($_POST["pass"]);
   $phone = test_input($_POST["phone"]);
   $successFlag = true;

  }

//    $firstname = test_input($_POST["fname"]);
//    $lastname = test_input($_POST["lname"]);
  //  $email = test_input($_POST["email"]);
//    $pass = test_input($_POST["pass"]);
//    $phone = test_input($_POST["phone"]);

}


}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
$stmt->execute();
$stmt->close();
if($successFlag==true){


  $sql76 = "UPDATE users SET profilepic='http://localhost/altprofile.png' where email='$email'";
  $conn->query($sql76);
  $sql73 = "UPDATE users SET coverpic='http://localhost/altcover.jpg' where email='$email'";
  $conn->query($sql73);

  header('Location: http://localhost/HomePage.php');

  exit;
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en" xmlns:https="http://www.w3.org/1999/xhtml">
<head>
  <title>Sarki</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" type="text/css" href="SignUpPageStyle.css">
  <!--this is the jquery validator cdn-->

  <link rel="icon" href="http://localhost/sarkilogo.png">

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
          var myLanguage = {
              errorTitle: 'failed to sign up please try again!',
              requiredFields: 'You have not answered all required fields',
              badTime: 'You have not given a correct time',
              badEmail: 'You have not given a correct e-mail address',
              badTelephone: 'You have not given a correct phone number',
              badSecurityAnswer: 'You have not given a correct answer to the security question',
              badDate: 'You have not given a correct date',
              lengthBadStart: 'The input value must be between ',
              lengthBadEnd: ' characters',
              lengthTooLongStart: 'The input value is longer than ',
              lengthTooShortStart: 'The input value is shorter than ',
              notConfirmed: 'Input values could not be confirmed',
              badDomain: 'Incorrect domain value',
              badUrl: 'The input value is not a correct URL',
              badCustomVal: 'The input value is incorrect',
              andSpaces: ' and spaces ',
              badInt: 'The input value was not a correct number',
              badSecurityNumber: 'Your social security number was incorrect',
              badUKVatAnswer: 'Incorrect UK VAT Number',
              badStrength: 'The password isn\'t strong enough',
              badNumberOfSelectedOptionsStart: 'You have to choose at least ',
              badNumberOfSelectedOptionsEnd: ' answers',
              badAlphaNumeric: 'The input value can only contain alphanumeric characters ',
              badAlphaNumericExtra: ' and ',
              wrongFileSize: 'The file you are trying to upload is too large (max %s)',
              wrongFileType: 'Only files of type %s is allowed',
              groupCheckedRangeStart: 'Please choose between ',
              groupCheckedTooFewStart: 'Please choose at least ',
              groupCheckedTooManyStart: 'Please choose a maximum of ',
              groupCheckedEnd: ' item(s)',
              badCreditCard: 'The credit card number is not correct',
              badCVV: 'The CVV number was not correct',
              wrongFileDim : 'Incorrect image dimensions,',
              imageTooTall : 'the image can not be taller than',
              imageTooWide : 'the image can not be wider than',
              imageTooSmall : 'the image was too small',
              min : 'min',
              max : 'max',
              imageRatioNotAccepted : 'Image ratio is not accepted'
          };
          $.validate({
              form: '#signupform',
              language : myLanguage ,
              // errorMessagePosition: 'top',
              validateOnBlur: false,
              modules: 'security' ,
              onModulesLoaded : function() {
                  var optionalConfig = {
                      fontSize: '12pt',
                      padding: '4px',
                      bad : 'Very bad',
                      weak : 'Weak',
                      good : 'Good',
                      strong : 'Strong'
                  };

                  $('input[name="pass"]').displayPasswordStrength(optionalConfig);
              }


          });



          //$("audio").prop("volume",0.3);






      });













  </script>
  <script>

  </script>
  <style>
    .has-error {
      color: red;
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
<body>
<!--<nav class="navbar fixed-top navbar-expand-lg navbar-dark scrolling-navbar bg-transparent d-flex justify-content-center align-items-center">-->
<!--  <a  href="http://localhost/HomePage.html" class="text-white navbar-brand animated pulse"><img style="padding-top: 10px; padding-bottom: 0"  width="40px" height="60px" src="http://localhost/sarkilogo.png"></a>-->
<!---->
<!---->
<!--</nav>-->

<div class="backG d-flex flex-column flex-sm-column flex-md-column flex-lg-row ">
  <!--  <nav class="navbar navbar-expand-lg navbar-dark fixed-top scrolling-navbar d-flex justify-content-center align-content-center">-->
  <!--    <a  href="http://localhost/Turk.html" class="text-white navbar-brand animated pulse"><img style="margin-top: 20px;" width="60px" height="80px" src="http://localhost/sarkilogo.png"></a>-->
  <!--  </nav>-->
  <div style="background-image: linear-gradient(to right top, #005eea, #4257e8, #604ee5, #7743e0, #8c35da);" class="d-flex col-md-7 d-flex justify-content-center">
    <div class="d-flex flex-column text-center">
      <a   href="http://localhost/HomePage.php" class=" navbar-brand animated pulse infinite"><img style="margin-top: 20px;" width="80px" height="100px" src="http://localhost/sarkilogo.png"><span  class="font-weight-bold" style="color: #e3038d;font-size: 25px;">Şarkı</span></a>
      <h1 class="text-white kkk fonting animated delay-1s zoomIn slow" style="margin-top: 10px;" id="welcomeText">Welcome to Şarkı</h1>
      <h5 class="text-white kkk animated delay-1s zoomIn slow" >ALL THE MUSIC YOU LOVE, ALL THE FREEDOM YOU NEED</h5>

      <div style="position: absolute; bottom: 200px; right: 60px;" class="d-flex justify-content-around">
        <img class="animated fadeIn delay-2s" src="first.png" width="161" height="161" style="margin-right: 30px;">
        <img class="animated fadeIn delay-3s" src="second.png" width="161" height="161" style="margin-right: 30px;">
        <img class="animated fadeIn delay-4s" src="third.png" width="161" height="161">
      </div>

    </div>

<div style="position: absolute; bottom: 30px; left: 0; right: 100%;">
  <img id="man" class="animated slideInLeft"  src="man-1454591_1280.png" width="300px;" height="450px;">
</div>
  </div>
  <!-- Material form register -->
  <div id="signupcard" class="card  navbar-dark col-md-5 border-5 animated slideInLeft slow bg-white" >

    <h5 id="sign_header" class="card-header white-text text-center py-4" style="background-image: linear-gradient(to right top, #005eea, #3d51da, #5243c9, #6034b8, #6823a6);">
      <strong>Sign up</strong>
    </h5>

    <!--Card content-->
    <div class="card-body px-lg-5 pt-0" >

      <!-- Form -->
      <form id="signupform" class="text-center has-validation-callback" method="post" style="" action="SignUpPage.php" enctype="multipart/form-data">

        <div class="form-row">
          <div class="col">
            <!-- First name -->
            <div class="md-form">
              <input data-validation-error-msg="Please Enter a valid First name" data-validation="required length custom"  data-validation-length="3-15" data-validation-regexp="^([a-zA-Z-]+)$" style="font-variant: none;
  text-transform: none;" type="text" name="fname" id="materialRegisterFormFirstName" class="form-control" style="color: black;">
              <label for="materialRegisterFormFirstName" >First name</label>
            </div>
          </div>
          <div class="col">
            <!-- Last name -->
            <div class="md-form">
              <input data-validation-error-msg="Please Enter a valid Last name" data-validation="required length custom"  data-validation-length="3-15" data-validation-regexp="^([a-zA-Z-]+)$" style="font-variant: none;
  text-transform: none;" type="text" name="lname" id="materialRegisterFormLastName" class="form-control" style="color: black;">
              <label for="materialRegisterFormLastName" >Last name</label>
            </div>
          </div>
        </div>

        <!-- E-mail -->
        <div class="md-form mt-0">
          <input data-validation-error-msg="Please Enter a valid email address" data-validation="required email" style="font-variant: none;border-bottom:<?php echo $nameErr?> ;
  text-transform: none;" type="email" name="email" id="materialRegisterFormEmail" class="form-control" style="color: black;">
          <label for="materialRegisterFormEmail" >E-mail</label>
          <span style="color: red; font-style: italic; font-variant: none;text-transform: none;"><?php echo $spanErr?></span>
        </div>

        <!-- Password -->
        <div class="md-form">
          <input   data-validation-strength="2" data-validation="required length strength length"  data-validation-length="min8" style="font-variant: none;
  text-transform: none;" type="password" name="pass" id="materialRegisterFormPassword" class="form-control" aria-describedby="materialRegisterFormPasswordHelpBlock" style="color: white;">
          <label for="materialRegisterFormPassword" >Password</label>
          <small id="materialRegisterFormPasswordHelpBlock" class="form-text text-muted mb-4">
            At least 8 characters
          </small>

        </div>


        <!-- Phone number -->
        <div class="md-form">
          <input data-validation="required custom length" data-validation-regexp="^([0-9]+)$" data-validation-length="max14" style="font-variant: none;border-bottom: <?php echo $phoneErr; ?>;
  text-transform: none;" type="text" name="phone" id="materialRegisterFormPhone" class="form-control" aria-describedby="materialRegisterFormPhoneHelpBlock" style="color: white;">
          <label for="materialRegisterFormPhone" >Phone number</label>
          <small id="materialRegisterFormPhoneHelpBlock" class="form-text  mb-4" >
            Optional - for two step authentication
          </small>
          <span style="color: red; font-style: italic; font-variant: none;text-transform: none;"><?php echo $phoneSpanError?></span>
        </div>

<!--
     <div class="custom-control custom-checkbox">-->
<!--          <input style="font-variant: none;-->
<!--  text-transform: none;" type="checkbox" class="custom-control-input" id="materialRegisterFormNewsletter">-->
<!--          <label class="custom-control-label" for="materialRegisterFormNewsletter">Subscribe to our newsletter</label>-->
<!--        </div>-->

        <!-- Sign up button -->
        <button  id="sign2" style="background-image: linear-gradient(to right top, #005eea, #3d51da, #5243c9, #6034b8, #6823a6);border-radius: 20px;" class="btn btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit">Sign up</button>

        <!-- Social register -->
        <!--          <p>or sign up with:</p>-->
        <!---->
        <!--          <a type="button" class="btn-floating btn-fb btn-sm">-->
        <!--            <i class="fab fa-facebook-f"></i>-->
        <!--          </a>-->
        <!--          <a type="button" class="btn-floating btn-tw btn-sm">-->
        <!--            <i class="fab fa-twitter"></i>-->
        <!--          </a>-->
        <!--          <a type="button" class="btn-floating btn-li btn-sm">-->
        <!--            <i class="fab fa-linkedin-in"></i>-->
        <!--          </a>-->
        <!--          <a type="button" class="btn-floating btn-git btn-sm">-->
        <!--            <i class="fab fa-github"></i>-->
        <!--          </a>-->
        <!---->
        <!--          <hr>-->

        <!-- Terms of service -->
        <p>By clicking
          <em>Sign up</em> you agree to our
          <a href="" target="_blank">terms of service</a>

      </form>
      <!-- Form -->

    </div>

  </div>



  <!-- Material form register -->
<!--  <div id="demoFont" class="d-flex flex-column text-center text-white animated slideInLeft slower">-->
<!--    <h1 class="">Signup now and</h1>-->
<!--    <h2>start creating your own library</h2>-->
<!--  </div>-->
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
</body>
</html>
