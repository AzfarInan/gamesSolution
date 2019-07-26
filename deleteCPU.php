<?php
session_start();

$id = "";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
if (!empty($id)) {
    try {
        $con = new PDO('mysql:host=localhost;dbname=gamessolution', 'root', '');
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = "DELETE FROM processor WHERE p_id = $id;";
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