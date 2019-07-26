<?php

session_start();

if (isset($_SESSION['uemail'])) {

    $name = "";
    $type = "";
    $piclink = "";
    $p_id = "";        
    $g_id = "";
    $r_id = "";
    
    if (isset($_GET['name']) && isset($_GET['type']) && isset($_GET['piclink']) && isset($_GET['p_id']) && isset($_GET['g_id']) && isset($_GET['r_id'])) {

        $name = $_GET['name'];
        $type = $_GET['type'];
        $piclink = $_GET['piclink'];
        $p_id = $_GET['p_id'];
        $g_id = $_GET['g_id'];
        $r_id = $_GET['r_id'];

    }
    if (!empty($name) && !empty($p_id) && !empty($r_id) && !empty($g_id) && !empty($type) && !empty($piclink)) {

        try {
            $con = new PDO('mysql:host=localhost;dbname=gamessolution', 'root', '');
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = "INSERT INTO games (name, p_id, g_id, r_id, type, piclink, favorite) VALUES ('$name', '$p_id', '$g_id', '$r_id', '$type', '$piclink', 'no');";
            $con->query($stmt);
            echo "<script>window.alert('Successfully Inserted!');</script>";
            echo "<script>window.location.assign('admin_page.php');</script>";
            
        } catch (PDOException $ex) {
            echo "<script>window.alert('Exception Found: Enter Again.');</script>";
            echo "<script>window.location.assign('admin_page.php');</script>";
        }
    } else {
         echo "<script>window.alert('Do not leave any field Empty');</script>";
          echo "<script>window.location.assign('admin_page.php');</script>";
    }
    $con = null;
}
?>


