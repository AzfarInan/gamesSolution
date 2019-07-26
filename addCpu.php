<?php
session_start();

$p_manufacturer = "";
$p_model = "";
if (isset($_GET['p_manufacturer']) && isset($_GET['p_model'])) {
    $p_manufacturer = $_GET['p_manufacturer'];
    $p_model = $_GET['p_model'];
}
if (!empty($p_manufacturer) && !empty($p_model)) {
    try {
        $con = new PDO('mysql:host=localhost;dbname=gamessolution', 'root', '');
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = "INSERT INTO processor (p_manufacturer, p_model) VALUES ('$p_manufacturer', '$p_model');";
        $con->exec($stmt); 
        echo "<script>window.location.assign('admin_page.php')</script>";
    } catch (PDOException $ex) {
        echo "";
    }
} else {
    echo "";
}
$con = null;
?>
