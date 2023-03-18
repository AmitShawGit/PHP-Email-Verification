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
   
    $email = mysqli_real_escape_string($con ,$_POST['email']);
    


//emailVerification
$emailquery = " select * from reg where email = '$email' ";
$query = mysqli_query($con,$emailquery);
$emailcount = mysqli_num_rows($query);

if($emailcount){
          $userdata = mysqli_fetch_array($query);
          $uname = $userdata['name'];
          $token = $userdata['token'];
        //mail send
        $subject = "Password reset";
        $body = "Hi $uname click the link to verify your gmail
        http://localhost/emailverify/reset.php?token=$token ";
        $header = "From: amitshaw1421@gmail.com";

        if(mail($email, $subject, $body, $header)){
           $_SESSION['msg'] =  "check your mail to reset your password $email";
           header('location:login.php');
        } 
        else{
               echo "email sending failed...";
        }
            }else{
               echo " no email found";
            }
            
  }

?>
    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>"onsubmit = "return validateForm()" method="POST">
        <div class="container">
            <p style="text-align:center;font-size:25px; ">Recover your account</p><br>
            Email:  <br>
            <input type="email" name="email" id="email" class="username" placeholder="xyz@gmail.com">
            <br>
            <p id="mail" class="text"></p>
           
            <button type="submit" class="btn" id="submit" name="submit">Send Mail</button>
            
        </div>
    </form>
   <script src="form.js"></script>
</body>
</html>