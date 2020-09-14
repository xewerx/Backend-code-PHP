<?php include('server.php') ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Log in</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="">
</head>

<body>
<?php include('errors.php') ?>
    <div class="container">
        <div class="header">
            <h2>Log in<h2>
        </div>

        <form action="login.php" method="post">

            <div>
                <label for="username">Username :</label>
                <input type="text" name="username" required>
            </div>

            <div>
                <label for="password">Password :</label>
                <input type="password" name="password" required>
            </div>

            <button type="submit" name="login_user"> Log in </button>

            <p>Not a user?<a href="registration.php">Register here</a></p>

        </form>





    </div>


</body>

</html>