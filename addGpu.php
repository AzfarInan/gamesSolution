<?php
session_start();

$g_manufacturer = "";
$g_model = "";
if (isset($_GET['g_manufacturer']) && isset($_GET['g_model'])) {
    $g_manufacturer = $_GET['g_manufacturer'];
    $g_model = $_GET['g_model'];
}
if (!empty($g_manufacturer) && !empty($g_model)) {
    try {
        $con = new PDO('mysql:host=localhost;dbname=gamessolution', 'root', '');
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = "INSERT INTO graphics (g_manufacturer, g_model) VALUES ('$g_manufacturer', '$g_model');";
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
