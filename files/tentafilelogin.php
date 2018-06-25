<?php
require_once 'config.php';

$username = $password = "";
$username_err = $password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty(trim($_POST["username"]))){
        $username_err = 'Enter your username here.';
    }else{
        $username = trim ($POST['username']);
    }//if username

    //----------------------------------------------------

    if(empty(trim($_POST["password"]))){
        $password_err = 'Enter your password.';
    }else{
        $password = trim ($POST['password']);
    }//if password

    //-----------------------------------------------------

    if(empty($username_err) && empty($password_err)){
        $sql = "SELECT username, password from user where username = ?";
        if($stm = $mysqli->prepare($sql)){
            $stm->bind_param("s", $param_username);
            $param_username = $username;

            if($stm->execute()){
                $stm->store_result();

                if($stm->num_rows == 1){
                    $stm->bind_result($username, $hashed_password);
                    if($stm->fetch()){
                        if(password_verify($password, $hashed_password)){
                            session_start();
                            $_SESSION['username'] = $username;
                            header("location: samplelandingpage.php");
                        }else{
                            $password_err = 'The password is not valid!';
                        }
                    }
                }else{
                    $username_err = 'The account does not exist.';
                }
            }else{
                echo "Error! try again later!";
            }
        }
        $stm->close();
    }
    $mysqli->close();    
}
?>