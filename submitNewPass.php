<?php
session_start();
if(isset($_POST['submit_password']) && $_POST['key'] && $_POST['reset'])
{
  require_once('database.php');

  $email=$_POST['key'];
  $password=mysqli_real_escape_string($db, $_POST['password']);
  $password = md5($password);

  

  $query = "UPDATE user SET password='$password' WHERE email='$email'";
  $results = mysqli_query($db, $query);

  if($results) {
    $_SESSION['resetPass'] = "Hasło zmienione pomyślnie";
    header("location: login.php");
  } 
  else {
    $_SESSION['resetPass'] = "Wystąpił błąd, spróbuj ponownie";
    header("location: login.php");
  }
}
