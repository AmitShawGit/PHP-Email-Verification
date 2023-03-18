<?php
session_start();
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="form.css">
</head>
<body>
<?php
include 'connection.php';
if(isset($_POST['submit'])){



    if(isset($_GET['token'])){
        $token = $_GET['token'];
    

    $newpass = mysqli_real_escape_string($con ,$_POST['pass']);
    $newrpass = mysqli_real_escape_string($con ,$_POST['rpass']);
//PASSWORD ENCYPTION
    $password = password_hash($newpass, PASSWORD_BCRYPT);
    $rpassword = password_hash($newrpass, PASSWORD_BCRYPT);

  



    if($newpass === $newrpass) {
        $updatequery = " update reg set pass ='$password' where token  ='$token' ";
            $iquery = mysqli_query($con, $updatequery);

    if($iquery){ 
        $_SESSION['msg'] = "your password updated";
        header('location:login.php');
    }
        else{
            $_SESSION['passmsg'] = " Not updated";
            header('location:reset.php');
        }
            }
            else{
                $_SESSION['passmsg'] =  "password are not matching";
              }
            
  }
  else{
   echo "no token found";
  }

 }

?>
    <form action = "" onsubmit = "return validateForm()" method="POST">
        <div class="container">
            <p style="text-align:center; font-size:25px;">Reset Password</p><br>
           New Password:  <br>
           <p>
            <?php if(isset($_SESSION['passmsg'])){echo $_SESSION['passmsg'];}
            else{echo $_SESSION['passmsg'] = "";} ?>
           </p>
            <input type="password" name="pass" id="password" class="username" placeholder="********">
            <br>
            <p id="pass" class="text"></p>
            Re-Type your password:  <br>
            <input type="password" name="rpass" id="repass" class="username"  placeholder="********">
            <br>
            <p id="repas" class="text"></p>
            <button type="submit" class="btn" id="submit" name="submit">Change Password</button>
            
        </div>
    </form>
   <script src="form.js"></script>
</body>
</html>
