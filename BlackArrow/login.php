<?php
//This script will handle login
session_start();

// check if the user is already logged in
if(isset($_SESSION['email']))
{
    header("location: welcome.php");
    exit;
}
require_once "config.php";

$email = $password = "";
$err = "";

// if request method is post
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    if(empty(trim($_POST['email'])) || empty(trim($_POST['password'])))
    {
        $err = "Please enter email + password";
    }
    else{
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
    }


if(empty($err))
{
    $sql = "SELECT email, password FROM users_record WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $param_email);
    $param_email = $email;
    
    
    // Try to execute this statement
    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    mysqli_stmt_bind_result($stmt, $email, $hashed_password);
                    if(mysqli_stmt_fetch($stmt))
                    {
                        if(password_verify($password, $hashed_password))
                        {
                            // this means the password is corrct. Allow user to login
                            session_start();
                            $_SESSION["email"] = $email;
                            $_SESSION["loggedin"] = true;

                            //Redirect user to welcome page
                            header("location: welcome.php");
                            
                        }
                        else{
                          echo '<script type="text/javascript">
                            window.onload = function () { alert("Email or Password is incorrect"); }
                          </script>';
                        }
                    }

                }
                else{
                          echo '<script type="text/javascript">
                            window.onload = function () { alert("Email or Password is incorrect"); }
                          </script>';
                        }

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
      <a href="login.php" class="link active">Login</a>
      <a href="general-awareness.html" class="link">General Awareness</a>
      <a href="report.php" class="link">Report a Crime</a>
      <a class="link" href="home.html" >Home</a>
  </div>
      <hr size="4px" style="margin:0px;background-color: #c3073f;"/>
      <br><br><br>
      <div class="loginContainer mt-10">
       <?php 
  
          if(isset($_SESSION['status']))
          {
            ?>
              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Hey! </strong><?php  echo $_SESSION['status'];?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            <?php
           
            unset($_SESSION['status']);
          }
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

      <div class="loginArea">
        <h2>Please login here:</h2>
        <br>
        <form action="" method="post"> 
          <div class="mb-3 ">
            <label  class="col-sm-2 col-form-label">Email</label>
            <div class="mb-3">
              <input type="text" name ="email"class="form-control" id="email">
            </div>
          </div>
          <div class="mb-3 ">
            <label  class="col-sm-2 col-form-label" style="width:100px;">Password</label>
            <div class="mb-3 ">
              <input type="password" name ="password"class="form-control" id="password">
            </div>
          </div>
          <div class="mb-3 row">
            <input class="btn btn-primary" type="submit" value="Submit">
          </div>
        </form>
        <h6>Don't have account? <a href="register.php" style="color: blueviolet;">Register Here!</a></h6>
      </div>
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