<?php

require_once '../connection.php';

if (isset($_POST['login'])) {



    $username = $_POST['username'];
    $password = $_POST['password'];


    $sql = "SELECT * FROM lecture_reg Where f_name='$username' and password='$password';";
    $result = mysqli_query($con, $sql);

    if(mysqli_num_rows($result) > 0) {
        
        $row = mysqli_fetch_array($result);
        
        session_start();
         $_SESSION['name'] = $row['f_name'];
        

        header ("Location: ../update_time.php?login=success");
        exit();  
        
         
         
        }else {
            header ("Location: ../login.php?error=Incorrect Password");
            exit();
            
        }

    } 
   
else{
    header ("Location: ../login.php");
    exit();
}





?>