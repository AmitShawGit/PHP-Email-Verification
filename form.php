<?php
session_start();
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
    $uname = mysqli_real_escape_string($con ,$_POST['uname']);
    $mobile = mysqli_real_escape_string($con ,$_POST['mobile']);
    $email = mysqli_real_escape_string($con ,$_POST['email']);
    $pass = mysqli_real_escape_string($con ,$_POST['pass']);
    $rpass = mysqli_real_escape_string($con ,$_POST['rpass']);
//PASSWORD ENCYPTION
    $password = password_hash($pass, PASSWORD_BCRYPT);
    $rpassword = password_hash($rpass, PASSWORD_BCRYPT);

    //tokengenerator
    $token = bin2hex(random_bytes(15));
//emailVerification
$emailquery = " select * from reg where email = '$email' ";
$query = mysqli_query($con,$emailquery);
$emailcount = mysqli_num_rows($query);

if($emailcount > 0){
    echo "email already exist";
}
else{
    if($pass === $rpass) {
            $insertquery = " insert into reg( name, mobile, email, pass, rpass, token, status) values('$uname','$mobile','$email','$password','$rpassword' , '$token' , 'inactive') ";
            $iquery = mysqli_query($con, $insertquery);

    if($iquery){
               
        //mail send
        $subject = "Account Verification";
        $body = "Hi $uname click the link to verify your gmail
        http://localhost/emailverify/activate.php?token=$token ";
        $header = "From: amitshaw1421@gmail.com";

        if(mail($email, $subject, $body, $header)){
           $_SESSION['msg'] =  "check your mail to activate your account $email";
           header('location:login.php');
        } 
        else{
               echo "email sending failed...";
        }
            }
            
  }
 }
}
?>
    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>"onsubmit = "return validateForm()" method="POST">
        <div class="container">
            Name: <br>
            <input type="text" id="username" class="username" placeholder="Name" name="uname">
            <br>
            <p id="text" class="text"></p>
            Mobile:  <br>
            <input type="number" name="mobile" id="mobile" class="username" placeholder="+9123456789">
            <br>
            <p id="phone" class="text"></p>
            Email:  <br>
            <input type="email" name="email" id="email" class="username" placeholder="xyz@gmail.com">
            <br>
            <p id="mail" class="text"></p>
            Password:  <br>
            <input type="password" name="pass" id="password" class="username" placeholder="********">
            <br>
            <p id="pass" class="text"></p>
            Re-Type your password:  <br>
            <input type="password" name="rpass" id="repass" class="username"  placeholder="********">
            <br>
            <p id="repas" class="text"></p>
            <button type="submit" class="btn" id="submit" name="submit">Create Account</button>
            <p>already have account <a href="login.php">log in</a></p>
        </div>
    </form>
   <script src="form.js"></script>
</body>
</html>