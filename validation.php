<?php

session_start();

$useremail = "";
$password = "";
$userid = "";
if (isset($_POST['uemail']) && isset($_POST['upass'])) {
    $useremail = $_POST['uemail'];
    $password = $_POST['upass'];
}
if (!empty($useremail) && !empty($password)) {

    try {
        $con = new PDO('mysql:host=localhost;dbname=gamessolution', 'root', '');
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = "select user_id,name from users where email='$useremail' && pass='$password'";
        $pdostmt = $con->query($stmt);
        if ($pdostmt->rowCount() == 1) {
            $table = $pdostmt->fetchAll(PDO::FETCH_NUM);

            foreach ($table as $row) {
                $userid = $row[0];
                $username = $row[1];
            }
            $_SESSION['uemail'] = $useremail;
            echo "<script>window.location.assign('home.php?user=' +$userid);</script>";
        } else {
            echo "<script>window.location.assign('login.php?status=invalid');</script>";
        }
    } catch (PDOException $ex) {
        echo "<script>window.location.assign('login.php?status=dberror');</script>";
    }
} else {
    echo "<script>window.location.assign('login.php?status=invalid')</script>";
}
$con = null;
?>