<?php

session_start();

if (isset($_SESSION['uemail'])) {


    $cpu = "";
    $gpu = "";
    $ram = "";
    if (isset($_GET['user-cpu']) && isset($_GET['user-gpu']) && isset($_GET['user-ram'])) {
        $cpu = $_GET['user-cpu'];
        $gpu = $_GET['user-gpu'];
        $ram = $_GET['user-ram'];
    }
    if (!empty($cpu) && !empty($gpu) && !empty($ram)) {

        try {
            $con = new PDO('mysql:host=localhost;dbname=gamessolution', 'root', '');
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = "UPDATE users SET p_id = '$cpu', g_id = '$gpu', r_id = '$ram' WHERE email = '$_SESSION[uemail]';";
            $con->exec($stmt);
            echo "<script>window.location.assign('mypcdetails.php');</script>";
            
        } catch (PDOException $ex) {
            echo "<script>window.alert('database error');</script>";
            echo "<script>window.location.assign('submitpcinfo.php');</script>";
        }
    } else {
        echo "<script>window.alert('database empty');</script>";
        echo "<script>window.location.assign('submitpcinfo.php')</script>";
    }
    $con = null;
}
?>
