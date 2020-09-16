<?php
if($_GET['key'] && $_GET['reset'])
{
  $email=$_GET['key'];
  $password=$_GET['reset'];

  require_once('database.php');
  
  $query = "SELECT * FROM user WHERE password='$password' AND email='$email'";
  $results = mysqli_query($db, $query);

  if(mysqli_num_rows($results)) {
    ?>
    <form method="post" action="submitNewPass.php">
        <input type="hidden" name="key" value="<?php echo $email;?>">
        <input type="hidden" name="reset" value="<?php echo $password;?>">
        <p>Enter New password</p>
        <input type="password" name='password'>
        <input type="submit" name="submit_password">
    </form>
    <?php
  }
  else {
    echo "Error reset password";
  }
}
?>