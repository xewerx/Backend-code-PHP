<?php
    session_start();
    require_once('database.php');
    

    $email = $_POST['email'];
    $query = "SELECT email,password FROM user WHERE email='$email'";

    $results = mysqli_query($db, $query);

    if(mysqli_num_rows($results)){
    $user = mysqli_fetch_assoc($results);
    
    $email = $user['email'];
    $password = $user['password'];

    $link = "<a href='http://localhost/resetPassConfirm.php?key=".$email."&reset=".$password."'>Click To Reset password</a>";
    require_once('mailer.php');
    echo $link;
    //sendMail("e.lawecki@ccpartners.pl", "Zmiana hasła w serwisie xewerx.com", "Witaj!<br>Kliknij w link w celu zresetowania hasła: " . $link);
    $_SESSION['resetPass'] = "Link do resetu wyslany";
    //header("location: login.php");
    }
    else {
        $_SESSION['resetPass'] = "Nie znaleziono użytkownika o takim emailu";
        header("location: login.php");
    }

