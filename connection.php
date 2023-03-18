<?php

$server = "localhost";
$user = "root";
$password = "";
$db = "email";

$con = mysqli_connect($server,$user,$password,$db);

if($con){
    
    ?>
    <script>
        alert "Information send sucessfully";
    </script>
    <?php
}else{
   
    ?>
    <script>
        alert "Information not send";
    </script>
<?php
}
?>