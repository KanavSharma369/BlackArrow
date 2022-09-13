
<?php
session_start();
require_once "config.php";

$title = $location = "";
$title_err = $location_err  = $discription_err = "";

if(!isset($_SESSION['email']))
{
    header("location: login.php");
    exit;
}
else{
$email = $_SESSION['email'];
}
if ($_SERVER['REQUEST_METHOD'] == "POST"){

  if(empty(trim($_POST["title"]))){
        $title_err = "Subject cannot be blank";
    }
    else{
    $title = trim($_POST['title']);
}

    
// Check for location
if(empty(trim($_POST['location']))){
    $location_err = "Location cannot be blank";
}
else{
    $location = trim($_POST['location']);
}

//Check for discription
if(empty(trim($_POST['discription']))){
    $discription_err = "Discription cannot be blank";
}
else{
    $discription = trim($_POST['discription']);
}


$victim = filter_input(INPUT_POST, 'victim');

  $host = "localhost";
  $dbusername = "root";
  $dbpassword = "";
  $dbname = "black_arrow";

$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);
if($conn == false){
  dir('ERROR: Can not connect to database!');
}

//first_name, last_name, email, password, gender, phone_no, aadhar_no
if(empty($title_err) && empty($location_err) && empty($discription_err)){

            if(!empty($_POST['victim'])) {
          $victim = $_POST['victim'];
          echo '<script type="text/javascript">
                            window.onload = function () { alert("'.$victim.'"); }
                          </script>';
        }
            if (mysqli_connect_error()){
                die('Connect Error ('. mysqli_connect_errno() .') '
                . mysqli_connect_error());
            }
        
            else{
                $sql = "INSERT INTO users_report (title, location, victim, discription, email) values ('$title', '$location', '$victim', '$discription', '$email');";
                  
                if ($conn->query($sql)){
                    

                  $_SESSION['report_status'] = "You have successfully reported!";
                     header("location: welcome.php");
                }
                else{
                    echo "Error: ". $sql ." ". $conn->error;
                }
                $conn->close();
            }

}
  else
  {
    if(!empty($title_err)){
      echo '<script type="text/javascript">
                            window.onload = function () { alert("'.$title_err.'"); }
                          </script>';
    }
    else{
      echo '<script type="text/javascript">
                            window.onload = function () { alert("'.$location_err.'"); }
                          </script>';
    }
    
  }
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="styles.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>BlackArrow</title>
  </head>
<body>
   <div class="topnav">
      <a href="home.html"><img src="Logo/BlackArrowLogo-275.png" alt="Logo"></img></a>
      <a href="#"class="govt"><img src="Logo/Govt-Logo.png" class="govt"/></a>
      <a href="contactus.html" class="link">Contact Us</a>
      <a href="logout.php" class="link">Logout</a>
      <a href="register.php" class="link">Register</a>
      <a href="login.php" class="link">Login</a>
      <a href="general-awareness.html" class="link">General Awareness</a>
      <a href="report.php" class="link active">Report a Crime</a>
      <a class="link " href="home.html" >Home</a>
  </div>
      <hr size="4px" style="margin:0px;background-color: #c3073f;"/>
      <div class="container mt-10">
        <h2><br>Please fill the following details for reporting:</h2>
        <br>
        <form action="" method="post">
        <div class="mb-3">
          <!-- Category of report-->
          <label for="exampleFormControlInput1" class="form-label">Subject of Crime:</label>
          <input type="text" name ="title"class="form-control" id="title">
        </div>
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Place of incident:</label>
          <input type="text" name ="location"class="form-control" id="location">
        </div>
        With whom did it occur:<br>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="victim" id="inlineRadio1" value="Myself" checked>
            <label class="form-check-label" for="inlineRadio1">Myself</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="victim" id="inlineRadio2" value="Another person">
            <label class="form-check-label" for="inlineRadio2">Another person</label>
        </div>
    
        <div class="mb-3">
          <br>
          <label for="exampleFormControlTextarea1" class="form-label">Describe in detail:</label>
          <textarea class="form-control" name="discription" id="discription" rows="5"></textarea>
        </div>
        <div class="mb-3 row">
            <input class="btn btn-primary" type="submit" value="Submit">
          </div>
        </form>
      </div>

 <footer>
      <div class="foot">
        <div class="fcontent">
          <br>
          <div class="f1">
            <div class="f2">
              <nav>
                <a href="home.html"><img src="Logo/BlackArrowLogo-275.png" alt="Logo" width="200px"></a>
                <a href="home.html#aboutus"><p>About Us</p></a>
                <a href="contactus.html"><p>Contact Us</p></a>
              </nav>
            </div>
            <div class="f2">
              <nav>
                <a href="home.html"><p>Home</p></a>
                <a href="report.php"><p>Report an FIR</p></a>
                <a href="general-awareness.html"><p>General Awareness</p></a>
                <a href="login.php"><p>Login</p></a>

              </nav>
            </div>
            <div class="f2">
              <nav>
                <a href="#"><p>Privacy Policy</p></a>
                <a href="#"><p>Terms and Conditions</p></a>
                
              </nav>
            </div>
            <div style="width:250px;text-align: right;">
                <div class="f2fstore">
                  <a href="#" class="f2ficon"><img src="Images\facebook icon.png"></img></a>
                  <a href="#" class="f2ficon"><img src="Images\twitter icon.png"></img></a>
                  <a href="#" class="f2ficon"><img src="Images\instagram icon.png"></img></a>
                </div>
                <div class="f2fstore">
                  <a href="#"><img src="Images\app store.png" width="137px" height="40px"></img>
                  </a>
                </div>
                <div class="f2fstore">
                  <a href="#"><img src="Images\play store.png"width="137px" height="40px"></img>
                  </a>
                </div>
              
            </div>
          </div>
        </div>
      </div>
    </footer>
</body>
</html>