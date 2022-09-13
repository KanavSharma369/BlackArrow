<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="styles.css">
   <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
      <a href="report.php" class="link">Report a Crime</a>
      <a class="link " href="home.html" >Home</a>
  </div>
      <hr size="4px" style="margin:0px;background-color: #c3073f;"/>

      <div class="displayLogin texture ">
        <?php 
        session_start();
          if(isset($_SESSION['report_status']))
          {
            ?>
              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Hey! </strong><?php  echo $_SESSION['report_status'];?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            <?php
           
            unset($_SESSION['report_status']);
          }
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
      <br><br><br>
      <div class="user">
          <h1>Hello 
          <?php
          
            $username = $_SESSION['email'];

              echo "{$username}";

          ?>
          </h1>
          <h2>You have successfully logged in!</h2>
          <br>
          <div style="justify-content: center;width: 600px; display: flex; text-align: left;">
            <h3 style="margin: auto;">Now you can report a Crime </h3>
            <br>
            <a href="report.php" ><button class=" button button-4" >REPORT</button></a>
          </div>
          
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