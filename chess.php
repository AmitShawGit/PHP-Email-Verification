<?php
session_start();
if(!isset($_SESSION['username'])){
    header('location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo  $_SESSION['username'] ;?></title>
    <style>
        table{
            border: 1px solid black; border-spacing: 0px;
        }
        tr{
            border: 1px solid black;
           
        }
        td{
            border: 1px solid black;
            width: 50px;
            height: 50px;
        }
        .bgcolor{
            background-color: black;
        }
    </style>
</head>
<body>
    <form action="" method="POST">
        <input type="text" name="cb" id="">
        <input type="submit" name="submit" id="" value="Generate Board">
        <a href="logout.php">logout</a>
    </form><br>
    <table>
        <?php
        if(isset($_POST['submit'])){
            $data = $_POST['cb'];
            for($row = 1; $row <= $data; $row++){
                echo "<tr>";
                for($col=1; $col <= $data; $col++){
                    if(($row + $col) % 2 == 0){
                        echo "<td class = 'bgcolor'>  </td>";
                    }else{
                        echo "<td> </td>";
                    }
                }
           echo "</tr>"; }
        }
        ?>
    </table>
</body>
</html>