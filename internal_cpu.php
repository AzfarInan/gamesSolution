<?php

$user_cpu = "";


if (isset($_GET['user-cpu']))
    $user_cpu = $_GET['user-cpu'];

try {
    $con = new PDO("mysql:host=localhost;dbname=gamessolution", "root", "");

    $stmt = "select p_id from processor where p_model='$user_cpu';";
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