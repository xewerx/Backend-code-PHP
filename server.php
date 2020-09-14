<?php
session_start();


function passwordStrength($pass) { 

// Validate password strength
$uppercase = preg_match('@[A-Z]@', $pass);
$lowercase = preg_match('@[a-z]@', $pass);
$number    = preg_match('@[0-9]@', $pass);
$specialChars = preg_match('@[^\w]@', $pass);

if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($pass) < 8) {
    return false;
}else{
    return true;
}
}


// initialising variables

$username = "";
$email = "";
$errors = array();

//connect to db

$db = mysqli_connect('localhost', 'root', '', 'practice') or die("could not connect do database");

//Register users

if(isset($_POST['reg_user'])) {
    
$username = mysqli_real_escape_string($db, $_POST['username']);
$email = mysqli_real_escape_string($db, $_POST['email']);
$email= filter_var($email, FILTER_SANITIZE_EMAIL);
$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

//form validation
if(empty($username)) {array_push($errors, "Username is required");}
if(empty(filter_var($email, FILTER_VALIDATE_EMAIL))) {array_push($errors, "Email is not correct");}
if(empty($email)) {array_push($errors, "Email is required");}
if(empty($password_1)) {array_push($errors, "Password is required");}
if($password_1 != $password_2) {array_push($errors, "Passwords do not match");}
if(!passwordStrength($password_1)) {array_push($errors, "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.");}

// check db for existing user with same username

$user_check_query = "SELECT * FROM user WHERE username = '$username' OR email = '$email' LIMit 1";

$results = mysqli_query($db, $user_check_query);
$user = mysqli_fetch_assoc($results);

if($user) {
        if($user['username'] === $username) {array_push($errors, "Username already exists");}
        if($user['email'] === $email) {array_push($errors, "This email is already has a registered username");}
}

// Register the user if no error 

if(count($errors) == 0) {

    $password = md5($password_1);
    $query = "INSERT INTO user (username, email, password) VALUES ('$username', '$email', '$password')";
    
    mysqli_query($db, $query);
    $_SESSION['username'] = $username;
    $_SESSION['success'] = "You are now logged in";

    require_once('mailer.php');
    // sendMail("e.lawecki@ccpartners.pl"); // adres na ktory wyslany zostanie email


    header('location: index.php');
}
}

//Login user

if(isset($_POST['login_user'])) {
    
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if(empty($username)) {
        array_push($errors, "Username is required");
    }

    if(empty($password)) {
        array_push($errors, "Password is required");
    }

    if(count($errors) == 0) {
        $password = md5($password);
        
        $query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
        $results = mysqli_query($db, $query);

        if(mysqli_num_rows($results)) {
            echo "cici";
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "Logged in succesfully";
            header("location: index.php");
        }
        else {
            array_push($errors, "Wrong username or password");
        }
    }

}