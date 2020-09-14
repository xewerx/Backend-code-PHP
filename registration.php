<?php include('server.php') ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Registration</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="">
</head>

<body>

    <div class="container">
        <div class="header">
            <h2>Register<h2>
        </div>

        <form action="registration.php" method="post">

            <?php include('errors.php') ?>
            
            <div>
                <label for="username">Username :</label>
                <input type="text" name="username" required>
            </div>

            <div>
                <label for="email">Email :</label>
                <input type="email" name="email" required>
            </div>

            <div>
                <label for="password">Password :</label>
                <input type="password" name="password_1" required>
            </div>

            <div>
                <label for="password">Confirm password :</label>
                <input type="password" name="password_2" required>
            </div>

            <button type="submit" name="reg_user"> Submit </button>

            <p>Already a user?<a href="login.php">Log in</a></p>
        </form>





    </div>


</body>

</html>