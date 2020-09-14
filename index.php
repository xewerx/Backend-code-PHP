<?php

session_start();

if(!isset($_SESSION['username'])) {

    $_SESSION['msg'] = "You must login to view this page";
    header('location: login.php');
}

if(isset($_GET['logout'])) {

    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>HOME PAGE</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
    </head>
<body>

<h1>This is home page</h1>
<?php
if(isset($_SESSION['success'])) : ?>

<div>
    <h3>

        <?php

        echo $_SESSION['success'];
        unset($_SESSION['success']);

        ?>

    </h3>
</div>

<?php endif ?>

//if the user log in print information about him

<?php if(isset($_SESSION['username'])) : ?>

    <h3>Welcome <?php echo $_SESSION['username'] ?></h3>

    <button><a href="index.php?logout='1'">Logout</a></button>

<?php endif ?>


    </body>
</html>