<?php

$user_ram = "";


if (isset($_GET['user-ram']))
    $user_ram = $_GET['user-ram'];

try {
    $con = new PDO("mysql:host=localhost;dbname=gamessolution", "root", "");

    $stmt = "select r_id from ram where memory='$user_ram';";
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

