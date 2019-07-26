<?php

$user_gpu = "";

if (isset($_GET['user-gpu']))
    $user_gpu = $_GET['user-gpu'];

try {
    $con = new PDO("mysql:host=localhost;dbname=gamessolution", "root", "");

    $stmt = "select g_id from graphics where g_model='$user_gpu';";
    $pdostmt = $con->query($stmt);
    $table = $pdostmt->fetchAll(PDO::FETCH_NUM);

    $htmlcode = "";
    foreach ($table as $row) {
        $htmlcode .= "$row[0]";
    }
    echo $htmlcode;
} catch (PDOException $ex) {
    echo "NOTHING";
}
?>

