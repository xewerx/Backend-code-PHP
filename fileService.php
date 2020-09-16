<?php
session_start();

if(!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must login to view this page";
    header('location: login.php');
}

require_once ('database.php');

$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING); // <-- filter your data first
$textarea = filter_input(INPUT_POST, 'text', FILTER_SANITIZE_STRING); // <-- filter your data first
$target_dir = "uploads/";
$uploadOk = 1;

$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
$target_file = $target_dir .$_SESSION['username'] .".". $imageFileType;


// Check if image file is a actual image or fake image
if (isset($_POST["submit"]) && isset($_FILES['fileToUpload'])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".<br>";
        $uploadOk = 1;
    } else {
        echo "File is not an image.<br>";
        $uploadOk = 0;
    }
}

// Check if file already exists
//if (file_exists($target_file)) {
    //echo "Plik o tej nazwie już istnieje w bazie! Zmień nazwę pliku!<br>";
    //$uploadOk = 0;
//}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 5242880) {
    echo "Plik jest za duży!<br>";
    $uploadOk = 0;
}

// Allow certain file formats
if (
    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif"
) {
    echo "Tylko formaty JPG, JPEG, PNG, GIF są dozwolone.<br>";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Ogłoszenie nie zostało dodane<br>";
    echo "<button><a href='index.php'>Wróć</a></button>";
    // if everything is ok, try to upload file
} else {

    //If photo is saved, take date
    $date = date("Y/m/d");

    $query = "INSERT INTO promocje (title, pathtoimage, textarea, dateofadd) VALUES ('$title', '$target_file', '$textarea', '$date')";
    $result = mysqli_query($db, $query);

    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file) && $result) {
        echo "Ogłoszenie dodane pomyślnie<br>";

        echo "<button><a href='index.php'>Wróć</a></button>";
    } else {
        echo "Error<br>";
    }
}
