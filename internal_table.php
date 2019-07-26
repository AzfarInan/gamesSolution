<?php

$category = "";


if (isset($_GET['category'])) {
    $category = $_GET['category'];
}

try {
    $con = new PDO("mysql:host=localhost;dbname=gamessolution", "root", "");
    if ($category == 'All') {
        $stmt = "select * from games";
    } else {
        $stmt = "select * from games where type='$category';";
    }
    $pdostmt = $con->query($stmt);
    $table = $pdostmt->fetchAll(PDO::FETCH_NUM);

    $htmlcode = "";
    foreach ($table as $row) {
        $htmlcode .= "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[7]</td><td><button style='padding: 10px; padding-left: 30px; padding-right: 30px; color: white; cursor: pointer; font-size: 80%; border: 1px solid black; border-radius: 15px; background-color: #5e0101;' onclick='gamePage($row[0])'>Check</button></td></tr>";
    }
    echo $htmlcode;
} catch (PDOException $ex) {
    echo "NOTHING";
}
?>