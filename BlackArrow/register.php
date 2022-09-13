<?php
//echo "error0";
session_start();
require_once "config.php";

$email = $password = $confirm_password = "";
$email_err = $password_err = $confirm_password_err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST"){

  if(empty(trim($_POST["email"]))){
        $email_err = "Email cannot be blank";
    }
    else{
        $sql = "SELECT email FROM users_record WHERE email = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if($stmt)
        {
            mysqli_stmt_bind_param($stmt, "s", $param_email);

            // Set the value of param email
            $param_email = trim($_POST['email']);

            // Try to execute this statement
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    $email_err = "This email is already taken"; 
                }
                else{
                    $email = trim($_POST['email']);
                }
            }
            else{
                echo "Something went wrong";
            }
        }
    }
// Check for password
if(empty(trim($_POST['password']))){
    $password_err = "Password cannot be blank";
}
elseif(strlen(trim($_POST['password'])) < 5){
    $password_err = "Password cannot be less than 5 characters";
}
else{
    $password = trim($_POST['password']);
}

// Check for confirm password field
if(trim($_POST['password']) !=  trim($_POST['confirm_password'])){
    $password_err = "Passwords should match";
}

$param_password = password_hash($password, PASSWORD_DEFAULT);
$password = $param_password;
$first_name = filter_input(INPUT_POST, 'first_name');
//echo "error1";
$last_name = filter_input(INPUT_POST, 'last_name');
//echo "error2";
//$email = filter_input(INPUT_POST, 'email');
// echo "error3";
//$password = filter_input(INPUT_POST, 'password');
// echo "error4";
$gender = filter_input(INPUT_POST, 'gender');
// echo "error5";
$phone_no = filter_input(INPUT_POST, 'phone_no');
// echo "error6";
$aadhar_no = filter_input(INPUT_POST, 'aadhar_no');
// echo "error7";

  $host = "localhost";
  $dbusername = "root";
  $dbpassword = "";
  $dbname = "black_arrow";
// echo "error8";
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);
if($conn == false){
  dir('ERROR: Can not connect to database!');
  // echo "error9";
}
// echo "error10";
//first_name, last_name, email, password, gender, phone_no, aadhar_no
if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
  // echo "error11";
if(!empty($first_name) && !empty($last_name)){
  // echo "error12";
    if(!empty($email)){
      // echo "error13";
        if(!empty($password)){
           // echo "error14";
  
            if (mysqli_connect_error()){
                die('Connect Error ('. mysqli_connect_errno() .') '
                . mysqli_connect_error());
            }
        
            else{
                $sql = "INSERT INTO users_record (first_name,last_name, email, password, gender,phone_no, aadhar_no) values ('$first_name','$last_name', '$email', '$password','$gender', '$phone_no','$aadhar_no');";
                  // echo "error15";
                if ($conn->query($sql)){
                    // echo "error16";
                    // echo '<script type="text/javascript">
                    //         window.onload = function () { window.alert("You have successfully registered."); }
                    //         window.location.href="login.php";
                    //       </script>';
                  $_SESSION['status'] = "You have successfully registered!";
                     header("location: login.php");
                }
                else{
                    echo "Error: ". $sql ." ". $conn->error;
                }
                $conn->close();
            }
        }
        else{
            echo '<script type="text/javascript">
                            window.onload = function () { alert("Password cannot be empty"); }
                          </script>';
            
        }
    }
    else{
        echo '<script type="text/javascript">
                            window.onload = function () { alert("Email cannot be empty"); }
                          </script>';
    }
}
else{
    echo '<script type="text/javascript">
                            window.onload = function () { alert("First Name and Last Name cannot be empty"); }
                          </script>';
}

}
  else
  {
    if(!empty($email_err)){
      echo '<script type="text/javascript">
                            window.onload = function () { alert("'.$email_err.'"); }
                          </script>';
    }
    else{
      echo '<script type="text/javascript">
                            window.onload = function () { alert("'.$password_err.'\n'.$confirm_password_err.'"); }
                          </script>';
    }
    
  }
} 
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <title>BlackArrow</title>
  </head>
<body>
   <div class="topnav">
      <a href="home.html"><img src="Logo/BlackArrowLogo-275.png" alt="Logo"></img></a>
      <a href="#"class="govt"><img src="Logo/Govt-Logo.png" class="govt"/></a>
      <a href="contactus.html" class="link">Contact Us</a>
      <a href="logout.php" class="link">Logout</a>
      <a href="register.php" class="link active">Register</a>
      <a href="login.php" class="link">Login</a>
      <a href="general-awareness.html" class="link">General Awareness</a>
      <a href="report.php" class="link">Report a Crime</a>
      <a class="link " href="home.html" >Home</a>
  </div>
      <hr size="4px" style="margin:0px;background-color: #c3073f;"/>

          <br>

      <h2 style="margin-left: 20px;">Please enter the details to register:</h2>
      <div class="container mt-10">
        <form action="" method="post">
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">First and Last name</label>
            <div class="input-group">
              <input type="text" aria-label="First name" class="form-control" name="first_name" id="first_name">
              <input type="text" aria-label="Last name" class="form-control" name="last_name" id="last_name">
            </div>
          </div>
          <br>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.
            </div>
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Confirm password</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password">
          </div>
          <div class=" mb-3">
            <label for="exampleInputEmail1" class="form-label">Gender</label>
            <select class="form-select" id="gender" name="gender">
              <option selected>Choose...</option>
              <option value="M">M</option>
              <option value="F">F</option>
            </select>
          </div>
          <div class=" mb-3">
            <label for="exampleInputEmail1" class="form-label">Phone number</label>
            <br>
            <input type="text" class="form-control" aria-label="phone-no input" aria-describedby="inputGroup-sizing-default" id="phone-no" name="phone_no">
          </div>
          <div class=" mb-3">
            <label for="exampleInputEmail1" class="form-label">Aadhar number</label>
            <input type="text" class="form-control" aria-label="aadhar-no input" aria-describedby="inputGroup-sizing-default" id="aadhar-no" name="aadhar_no">
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <br>
        <h6>Already Registered? <a href="login.php" style="color: blueviolet;">Login Here!</a></h6>
        <br><br>
      </div>
        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

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