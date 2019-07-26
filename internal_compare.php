<?php

$g_model = "";
if (isset($_GET['g_model']))
    $g_model = $_GET['g_model'];

try {
    $con = new PDO("mysql:host=localhost;dbname=gamessolution", "root", "");

    $stmt = "select g_id from graphics where g_model = '$g_model'";
    $pdostmt = $con->query($stmt);
    $g_id = 0;
    if ($pdostmt->rowCount() == 1) {
        $table = $pdostmt->fetchAll(PDO::FETCH_NUM);

        foreach ($table as $row) {
            $g_id = $row[0];
        }
    }
    $stmnt = "select name,g_id from games";
    $pdostmnt = $con->query($stmnt);

    $chair = $pdostmnt->fetchAll(PDO::FETCH_NUM);
    $htmlcode = "";
    foreach ($chair as $row) {

        $cmp = $row[1]-$g_id;

        if ($cmp <= -2)
            $htmlcode .= "<tr><td style='background-color: darkgreen; color: white'>HIGH</td></tr>";
        else if ($cmp >= -1 && $cmp <= 1)
            $htmlcode .= "<tr><td style='background-color: darkblue; color: white'>MEDIUM</td></tr>";
        else if ($cmp >= 2 && $cmp <= 3)
            $htmlcode .= "<tr><td style='background-color: darkgray; color: white'>LOW</td></tr>";
        else
            $htmlcode .= "<tr><td style='background-color: darkred; color: white'>FAIL</td></tr>";
    }
    echo $htmlcode;
} catch (PDOException $ex) {
    echo "";
}
?>