<?php 

  if($_SERVER['REQUEST_METHOD']=='POST'){
    include "connection.php";
    session_start();
   $Messages = "";
   $isFial = 'not';
   if(isset($_POST['loginemail'])){
          $loginemail = $_POST['loginemail'];
          $loginpassword= $_POST['loginpass'];
          $sql = "SELECT * FROM userprofile where user_email='$loginemail'";
          $userresult = mysqli_query($cnct,$sql);
          $rowuser = mysqli_fetch_assoc($userresult);
          if(password_verify($loginpassword,$rowuser['password'])){
            $_SESSION['isLogin'] = true;
            $_SESSION['email'] = $loginemail;
            $_SESSION['userId'] = $rowuser['user_id'];
            $Messages = "Successfully loged in...!";
            $isFial = 'ha';
            header("Location: /forum/index.php");
          }else{
            $Messages = "Invalid creadential...!";
            header("Location: /forum/index.php");
          }
   }elseif(isset($_POST['email']) || isset($_POST['pass']) || isset($_POST['cpass'])){

    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $cpass = $_POST['cpass'];
     $sql = "SELECT * FROM userprofile where user_email='$email'";
     $userresult = mysqli_query($cnct,$sql);
 
     if(mysqli_num_rows($userresult)== 1){
       $Messages = "this user name is already taken by some one choose another...!";
     }elseif($pass !== $cpass){
       $Messages = "password must be same...";
     }else{
         $mypass = password_hash($pass,PASSWORD_DEFAULT);
         $newInset = "INSERT INTO userprofile(user_email,password) VALUES('$email','$mypass')";
         $insertResult = mysqli_query($cnct,$newInset);
         if($insertResult){
           $isFial = 'ha';
           $Messages = "successfully registration done...!";
           }
           header("Location: /forum/index.php");
     }

   }

                if($isFial=='na'){
                  echo '<div class="alert mb-0 alert-warning alert-dismissible fade show" role="alert">
                  <strong>'.$Messages.'</strong> 
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
                }elseif($isFial=='ha'){
                  echo '<div class="alert mb-0 alert-success alert-dismissible fade show" role="alert">
                  <strong> '.$Messages.'</strong>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
                }
    

  }

?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Dropdown
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php" tabindex="-1">Contact</a>
                </li>
            </ul>
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>

            <?php
        if($_SERVER['REQUEST_METHOD'] != 'POST'){
          session_start();
        }

        if(isset($_SESSION['isLogin'])){
          echo '<p class="px-2">wellcome '.$_SESSION['email'].'</p>';
          echo '<button class="btn"><a href="/forum/logout.php" class="btn btn-success">Logout</a></button>';

        }else{
          echo '<button class="btn btn-success mx-2" data-bs-toggle="modal" data-bs-target="#exampleModal">Login</button>
          <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal2">Registration</button>';
        }
      
      ?>


        </div>
    </div>
</nav>


<?php include "loginmodal.php" ?>
<?php include "registrationmodal.php" ?>