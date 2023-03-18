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
    <title>FormValidation</title>
    <style>
        *{
            margin: 0;
        }
        body{
            display: flex ;
            height: 100vh;
            justify-content: center;
            text-align: center;
            align-items: center;
            background-color: rgb(0, 165, 235);
        }
        #form-container{
           height: 300px;
           width: 300px;
           background-color: white;
           padding: 20px;
        }
        input{
            margin: 7px;
            height: 35px;
            width: 250px;
            border-radius: 5px;
            border: 2px solid rgb(132, 132, 132);
            background-color: rgba(255, 253, 253, 0.779);
        }
        ::placeholder{
            font-size: 15px;
            padding: 10px;
        }
        input[type="submit"]{
            margin: 7px;
            height: 35px;
            width: 180px;
            border-radius: 5px;
            border: 0px;
            background-color: rgb(255, 153, 0);
            cursor: pointer;
        }
        .checkbox{
            text-align:left;
            width: 25px;
            margin-top:-30px;
            height : 25px;
        }
        .error{
            color: rgb(171, 4, 4);
            text-align: left;
            margin-left:25px ;
        }
    </style>
</head>
<body>
    <?php
    include 'connection.php';
    if(isset($_POST['login'])){
           $username = $_POST['username'];
           $password = $_POST['password'];
           $email_search = " select * from reg where email = '$username' and status='active' ";
           $query = mysqli_query($con,$email_search);
           $email_count = mysqli_num_rows($query);

           if($email_count){
            $email_pass = mysqli_fetch_assoc($query);
            $db_pass = $email_pass['pass'];
            
            $_SESSION['username']= $email_pass['name'];

            $pass_decode = password_verify($password,$db_pass);
            if($pass_decode){

                if(isset($_POST['rememberme'])){
                  setcookie('emailcookie',$username,time()+86400);
                  setcookie('passwordcookie',$password,time()+86400);
                header('location:chess.php');
                }else{
                
                header('location:chess.php');
                }


                
            }
            else{
                echo " invalid pass ";
            }
        
           }else{
            echo " invalid email ";
           }
        }
    
    ?>
    <div id="form-container">
        <h2>Login</h2><br><p><?php
        if(isset($_SESSION['msg'])){
         echo $_SESSION['msg'];}
         else{
            $_SESSION['msg'] = "you are logged out log in again";
         } ?></p>
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>"onsubmit = "return validateForm()" method="post">
            <input type="text" placeholder="Username" id="username" name="username"><br>
            <p id="userError" class="error" value="
            <?php
             if(isset($_COOKIE['emailcookie'])){
                 echo $_COOKIE['emailcookie'];
                 } ?>">
              </p>
            <input type="password" placeholder="password" id="password" name="password"><br>
            <p id="passError" class="error" value="
            <?php
             if(isset($_COOKIE['passwordcookie'])){
                 echo $_COOKIE['passwordcookie'];
                 } ?>" > </p><br>
            <input type="checkbox" class="checkbox" name="rememberme">Remember me <br>
            <input type="submit" name="login" value="log in"><br><br>
            forget your password ?<a href="recover.php">Click Here</a>
          <br>  New User <a href="form.php">Sign In</a>
        </form>
    </div>


    <script>
        let username = document.getElementById("username");
        let password = document.getElementById("password");
        let flag = 1;

        function validateForm(){
            if(username.value == ""){
                document.getElementById("userError").innerHTML = "Fill Username";
                flag = 0;
            }
            else if(username.value.length < 3){
                document.getElementById("userError").innerHTML = "user must fill 3 character";
                flag = 0;
            }
            else {
                document.getElementById("userError").innerHTML = "";
                flag = 1;
            }
       

        if(password.value == ""){
                document.getElementById("passError").innerHTML = "Password is empty";
                flag = 0;
            }
            else {
                document.getElementById("passError").innerHTML = "";
                flag = 1;
            }

            if(flag){
                return true;
            }
            else{
                return false;
            }
        }

    </script>
</body>
</html>