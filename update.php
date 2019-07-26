<?php

session_start();

if (isset($_SESSION['uemail'])) {

    $userpicture = "";
    if (isset($_POST['picture'])) {

        $userpicture = $_POST['picture'];
    }
    if (!empty($userpicture)) {

        try {
            $con = new PDO('mysql:host=localhost;dbname=gamessolution', 'root', '');
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = "update users set picture='$userpicture' where email='$_SESSION[uemail]'";
            $pdostmt = $con->query($stmt);
            
            echo "<script>window.location.assign('profile.php');</script>";
            
        } catch (PDOException $ex) {
            echo "<script>window.location.assign('profile.php);</script>";
        }
    } else {
         echo "<script>window.alert('NO PICTURE FOUND!');</script>";
        echo "<script>window.location.assign('profile.php')</script>";
    }
    $con = null;
}
?>

