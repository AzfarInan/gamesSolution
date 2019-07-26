<?php
session_start();

if (isset($_SESSION['uemail'])) {

    $id = "";
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    }
    if (!empty($id)){
        try{
            $con = new PDO('mysql:host=localhost;dbname=gamessolution', 'root', '');
            $stmt = "insert into recents (email,games_id) values ('$_SESSION[uemail]','$id')";
            $con->exec($stmt);
            
        } catch (Exception $ex) {
            
        }
        $con = null;
    }
        
        ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Games Solution</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <style>
            body {
                cursor: pointer;
                font-family: garamond;
            }
            .login:hover{
                font-size: 115%;
            }
            .navigation_bar {

                list-style-type: none;
                margin: 0;
                padding: 0;
                position: sticky;
                top: 5px;
                overflow: hidden;
                background-color: black;
            }


            li{
                cursor: pointer;
                float: left;
                padding: 16px;
                color: white;
            }

            li.active{
                background-color: darkblue;
                font-size: 150%;
            }

            li.list1:hover {
                background-color: #5e0101;
                font-size: 115%;
            }

            .searchContainer {
                display: inline-flex;
                flex: 1 1 300px;
                border: 2px solid #ccc;
                border-radius: 5px;
                overflow: hidden;
            }

            .searchIcon {
                padding: 0.5rem;
            }

            .searchBox {
                border: 0;
                padding: 0.5rem 0.5rem 0.5rem 0;
                flex: 1;
            }

            .searchButton {
                cursor: pointer;
                background: #5e0101;
                border: 0;
                color: white;
                padding: 0.5rem;
                border-radius: 0;
            }
            .searchButton:hover{
                background: black;
                color: aliceblue;
            }
            
            .left-part{
                display: inline-block;
                top: 265px;
                left: 105px;
                position: absolute;
            }
            .right-part{
                display: inline-block;
                position: absolute;
                top: 255px;
                left: 405px;
            }

            .right-part table tr:nth-child(even){
                background-color: lightgrey;
            }

            .check-part{
                display: inline-block;
                top: 255px;
                left: 820px;
                position: absolute;
            }
            .check-part table tr:nth-child(odd){
                background-color: lightgrey;
            }
            .mypcpart{
                display: inline-block;
                top: 255px;
                left: 820px;
                position: absolute;
            }
            .mypcpart table tr:nth-child(odd){
                background-color: lightgrey;
            }
            
            
        </style>
    </head>
    <body>
        <!-- HEADER -->
        <table style="width: 100%;  overflow-y: scroll">
            <tbody>
                <tr>
                    <td><img src="logo.png"></td>
                    <td><b style="font-size: 250%; color: #5e0101;">"Before playing, make sure you can run it!"</b></td>
                    <td>
                            <select id="option" style="border: none" onchange="gotoPage()">
                                <option disabled selected value></option>
                                <option>Profile</option>
                                <option>Log Out</option>
                            </select>
                        </td>
                <script>
                    function gotoPage(){
                        
                        var p = document.getElementById('option').value;
                        if (p == 'Profile')
                            window.location.assign('profile.php');
                        else if (p == 'Log Out'){
                            
                            var ans = window.confirm('Sure you want to Log Out?');
                            if(ans == true)
                                window.location.assign('logout.php');
                            else{
                                window.location.assign('home.php');
                            }
                        }
                    }
                </script>
                        <td><?php
                                try {

                                    $con = new PDO('mysql:host=localhost;dbname=gamessolution', 'root', '');
                                    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                    $stmt = "select name from users where email='$_SESSION[uemail]'";
                                    $pdostmt = $con->query($stmt);
                                    if ($pdostmt->rowCount() == 1) {
                                        $table = $pdostmt->fetchAll(PDO::FETCH_NUM);
                                        foreach ($table as $row) {
                                            echo "$row[0]";
                                        }
                                    }
                                    else {
                                        echo "<h1>USER</h1>";
                                    }
                                } catch (PDOException $ex) {
                                    echo "USER";
                                }

                                $con = null;
                                ?>
                        </td>
                        <td>
                            <?php
                                try {

                                    $con = new PDO('mysql:host=localhost;dbname=gamessolution', 'root', '');
                                    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                    $stmt = "select picture from users where email='$_SESSION[uemail]'";
                                    $pdostmt = $con->query($stmt);
                                    if ($pdostmt->rowCount() == 1) {
                                        $table = $pdostmt->fetchAll(PDO::FETCH_NUM);
                                        foreach ($table as $row) {
                                            if ($row[0] != '')
                                                echo "<img src='$row[0]' style='width: 80px; height: 80px; border-radius: 50px;'>";
                                            else 
                                                echo "<img src='https://dcassetcdn.com/common/images/v3/no-profile-pic-tiny.png' style='width: 80px; height: 80px; border-radius: 50px;'>";
                                        }
                                    }
                                    else {
                                        echo "<h1>USER</h1>";
                                    }
                                } catch (PDOException $ex) {
                                    echo "USER";
                                }

                                $con = null;
                                ?>
                        </td>
                </tr>
            </tbody>
        </table>
        
        <!-- NAVIGATIONAL BAR -->
        
        <ul id="navigation_bar" class="navigation_bar" name="navigation_bar" style="z-index: +999">
            <li class="list1" style="padding: 25px" onclick="home()">Home</li>
            <li class="list1" style="padding: 25px" onclick="gamesList()">Games List</li>
            <li class="list1" style="padding: 25px" onclick="mypc()">My Computer Details</li>
            <li class="list1" style="padding: 25px" onclick="gpuCompare()">GPU Compare</li>
            <li style="float: right;">
                <div class="searchContainer">
                    <form method="get" action="gameslist.php">
                        <i class="fa fa-search searchIcon"></i>
                        <input class="searchBox" id="search" type="search" name="search" placeholder="Search...">
                        <input type="submit" value="Search" name="submit" class="searchButton">
                    </form>
                </div>
            </li>
        </ul>
        <br/>
        
        <!-- WELCOME MESSAGE -->
        
        <h2>Welcome to the guiding star in your world of Gaming.</h2>
        <hr>

        <div class="main-section">
            
            <!-- Selecting the image of the Corresponding game from Database -->
            
            <div class="left-part">
                <?php
                $id = "";
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    
                    try {
                        $con = new PDO('mysql:host=localhost;dbname=gamessolution', 'root', '');
                        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        
                        $stmt = "select piclink from games where games_id='$id'";
                        $pdostmt = $con->query($stmt);

                        if ($pdostmt->rowCount() == 1) {
                            $table = $pdostmt->fetchAll(PDO::FETCH_NUM);

                            foreach ($table as $row) {
                                echo "<img src='$row[0]' style='width: 275px; height: 350px;'>";
                            }
                        } else {
                            echo "<h1>NO GAMES TO SHOW</h1>";
                        }
                    } catch (Exception $ex) {
                        echo 'No Data Found';
                    }
                    $con = null;
                }
                ?>
            </div>
            
            <!-- Selecting the System Requirements of the Selected Game from Database -->
            
            <div class="right-part">
                <table style="width: 400px; height: 306px; font-size: 120%; margin: 5px; border-top: 2px solid gray; border-bottom: 2px solid gray; border-collapse: collapse">
                    <caption style="padding-bottom: 20px; font-size: 130%;">Minimum System Requirements</caption>
                    <tr>
                        <!-- Selecting the NAME -->
                        
                        <td><strong>Name:</strong></td>
                        <td>
                            <?php
                            $id = "";
                            if (isset($_GET['id'])) {
                                $id = $_GET['id'];

                                try {
                                    $con = new PDO('mysql:host=localhost;dbname=gamessolution', 'root', '');
                                    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                    $stmt = "select name from games where games_id='$id'";
                                    $pdostmt = $con->query($stmt);

                                    if ($pdostmt->rowCount() == 1) {
                                        $table = $pdostmt->fetchAll(PDO::FETCH_NUM);

                                        foreach ($table as $row) {
                                            echo "$row[0]";
                                        }
                                    } else {
                                        echo "<h1>NO GAMES TO SHOW</h1>";
                                    }
                                } catch (Exception $ex) {
                                    echo 'No Data Found';
                                }
                                $con = null;
                            }
                            ?>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        
                        <!-- Selecting Game Type -->
                        
                        <td><strong>Type:</strong></td>
                        <td>
                            <?php
                            $id = "";
                            if (isset($_GET['id'])) {
                                $id = $_GET['id'];

                                try {
                                    $con = new PDO('mysql:host=localhost;dbname=gamessolution', 'root', '');
                                    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                    $stmt = "select type from games where games_id='$id'";
                                    $pdostmt = $con->query($stmt);

                                    if ($pdostmt->rowCount() == 1) {
                                        $table = $pdostmt->fetchAll(PDO::FETCH_NUM);

                                        foreach ($table as $row) {
                                            echo "$row[0]";
                                        }
                                    } else {
                                        echo "<h1>NO GAMES TO SHOW</h1>";
                                    }
                                } catch (Exception $ex) {
                                    echo 'No Data Found';
                                }
                                $con = null;
                            }
                            ?>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        
                        <!-- Selecting Processor Manufacturer & Model -->
                        
                        <td><strong>Processor:</strong></td>
                        <td>
                            <?php
                            $id = "";
                            if (isset($_GET['id'])) {
                                $id = $_GET['id'];

                                try {
                                    $con = new PDO('mysql:host=localhost;dbname=gamessolution', 'root', '');
                                    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                    $stmt = "select p_id from games where games_id='$id'";
                                    $pdostmt = $con->query($stmt);

                                    if ($pdostmt->rowCount() == 1) {
                                        $table = $pdostmt->fetchAll(PDO::FETCH_NUM);
                                        foreach ($table as $row) {
                                            $stmt = "select p_manufacturer,p_model from processor where p_id='$row[0]'";
                                            $pdostmt = $con->query($stmt);
                                            $table = $pdostmt->fetchAll(PDO::FETCH_NUM);
                                            foreach ($table as $row) {
                                                echo "$row[0] $row[1]";
                                            }
                                        }
                                    } else {
                                        echo "<h1>NO PROCESSOR TO SHOW</h1>";
                                    }
                                } catch (Exception $ex) {
                                    echo 'No Data Found';
                                }
                                $con = null;
                            }
                            ?>
                        </td>
                        
                        <!-- Saving the Processor id for the corresponding model to compare -->
                        
                        <td style="display: none">
                            <?php
                            $id = "";
                            if (isset($_GET['id'])) {
                                $id = $_GET['id'];

                                try {
                                    $con = new PDO('mysql:host=localhost;dbname=gamessolution', 'root', '');
                                    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                    $stmt = "select p_id from games where games_id='$id'";
                                    $pdostmt = $con->query($stmt);

                                    if ($pdostmt->rowCount() == 1) {
                                        $table = $pdostmt->fetchAll(PDO::FETCH_NUM);
                                        foreach ($table as $row) {
                                            echo "<p id='processor_id_game'>$row[0]</p>";
                                        }
                                    } else {
                                        echo "<h1>NO PROCESSOR TO SHOW</h1>";
                                    }
                                } catch (Exception $ex) {
                                    echo 'No Data Found';
                                }
                                $con = null;
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        
                        <!-- Selecting Graphics Card Manufacturer & Model -->
                        
                        <td><strong>Graphics:</strong></td>
                        <td>
                            <?php
                            $id = "";
                            if (isset($_GET['id'])) {
                                $id = $_GET['id'];

                                try {
                                    $con = new PDO('mysql:host=localhost;dbname=gamessolution', 'root', '');
                                    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                    $stmt = "select g_id from games where games_id='$id'";
                                    $pdostmt = $con->query($stmt);

                                    if ($pdostmt->rowCount() == 1) {
                                        $table = $pdostmt->fetchAll(PDO::FETCH_NUM);
                                        foreach ($table as $row) {
                                            $stmt = "select g_manufacturer,g_model from graphics where g_id='$row[0]'";
                                            $pdostmt = $con->query($stmt);
                                            $table = $pdostmt->fetchAll(PDO::FETCH_NUM);
                                            foreach ($table as $row) {
                                                echo "$row[0] $row[1]";
                                            }
                                        }
                                    } else {
                                        echo "<h1>NO GRAPHICS TO SHOW</h1>";
                                    }
                                } catch (Exception $ex) {
                                    echo 'No Data Found';
                                }
                                $con = null;
                            }
                            ?>
                        </td>
                        
                        <!-- Saving the graphics id for the corresponding model to compare -->
                        
                        <td style="display: none">
                            <?php
                            $id = "";
                            if (isset($_GET['id'])) {
                                $id = $_GET['id'];

                                try {
                                    $con = new PDO('mysql:host=localhost;dbname=gamessolution', 'root', '');
                                    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                    $stmt = "select g_id from games where games_id='$id'";
                                    $pdostmt = $con->query($stmt);

                                    if ($pdostmt->rowCount() == 1) {
                                        $table = $pdostmt->fetchAll(PDO::FETCH_NUM);
                                        foreach ($table as $row) {
                                            echo "<p id='graphics_id_game'>$row[0]</p>";
                                        }
                                    } else {
                                        echo "<h1>NO GRAPHICS TO SHOW</h1>";
                                    }
                                } catch (Exception $ex) {
                                    echo 'No Data Found';
                                }
                                $con = null;
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        
                        <!-- Selecting Ram -->
                        
                        <td><strong>Memory:</strong></td>
                        <td>
                            <?php
                            $id = "";
                            if (isset($_GET['id'])) {
                                $id = $_GET['id'];

                                try {
                                    $con = new PDO('mysql:host=localhost;dbname=gamessolution', 'root', '');
                                    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                    $stmt = "select r_id from games where games_id='$id'";
                                    $pdostmt = $con->query($stmt);

                                    if ($pdostmt->rowCount() == 1) {
                                        $table = $pdostmt->fetchAll(PDO::FETCH_NUM);
                                        foreach ($table as $row) {
                                            $stmt = "select memory from ram where r_id='$row[0]'";
                                            $pdostmt = $con->query($stmt);
                                            $table = $pdostmt->fetchAll(PDO::FETCH_NUM);
                                            foreach ($table as $row) {
                                                echo "$row[0]";
                                            }
                                        }
                                    } else {
                                        echo "<h1>NO MEMORY TO SHOW</h1>";
                                    }
                                } catch (Exception $ex) {
                                    echo 'No Data Found';
                                }
                                $con = null;
                            }
                            ?>
                        </td>
                        
                        <!-- Saving the ram id for the corresponding memory to compare -->
                        
                        <td style="display: none">
                            <?php
                            $id = "";
                            if (isset($_GET['id'])) {
                                $id = $_GET['id'];

                                try {
                                    $con = new PDO('mysql:host=localhost;dbname=gamessolution', 'root', '');
                                    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                    $stmt = "select r_id from games where games_id='$id'";
                                    $pdostmt = $con->query($stmt);

                                    if ($pdostmt->rowCount() == 1) {
                                        $table = $pdostmt->fetchAll(PDO::FETCH_NUM);
                                        foreach ($table as $row) {
                                            echo "<p id='ram_id_game'>$row[0]</p>";
                                        }
                                    } else {
                                        echo "<h1>NO MEMORY TO SHOW</h1>";
                                    }
                                } catch (Exception $ex) {
                                    echo 'No Data Found';
                                }
                                $con = null;
                            }
                            ?>
                        </td>
                    </tr>
                </table>
            </div>
            
            <!-- Enter your System's Configuration -->
            <div id="mypcpart" class="mypcpart">
                <table style="width: 400px; height: 306px; font-size: 120%; margin: 5px; border-top:2px solid gray;  border-bottom: 2px solid gray; border-collapse: collapse">
                    <caption style="padding-bottom: 20px; font-size: 130%;">Can you run it?</caption>
                    <tr>
                        <td><strong>Your CPU Manufacturer:</strong></td>
                        <td>
                          
                                <?php
                                    try {
                                        $con = new PDO("mysql:host=localhost; dbname=gamessolution", 'root', '');

                                        $stmt = "select p_id from users where email = '$_SESSION[uemail]'";
                                        $pdostmt = $con->query($stmt);
                                        $table = $pdostmt->fetchAll(PDO::FETCH_NUM);

                                        foreach ($table as $row) {

                                            $stmt1 = "select p_manufacturer from processor where p_id='$row[0]'";
                                            $pdostmt1 = $con->query($stmt1);
                                            if ($pdostmt1->rowCount() == 0)
                                                echo 'N/A';
                                            else {
                                                $table1 = $pdostmt1->fetchAll(PDO::FETCH_NUM);

                                                foreach ($table1 as $row) {
                                                    echo "$row[0]";
                                                }
                                            }
                                        }
                                    } catch (Exception $ex) {
                                        echo 'NOTHING!';
                                    }
                    
                                ?>
                            
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Your CPU Model:</strong></td>
                        <td id="cpumod">
                            <?php
                                try {
                                    $con = new PDO("mysql:host=localhost; dbname=gamessolution", 'root', '');

                                    $stmt = "select p_id from users where email = '$_SESSION[uemail]'";
                                    $pdostmt = $con->query($stmt);
                                    $table = $pdostmt->fetchAll(PDO::FETCH_NUM);

                                    foreach ($table as $row) {

                                        $stmt1 = "select p_model from processor where p_id='$row[0]'";
                                        $pdostmt1 = $con->query($stmt1);
                                        if ($pdostmt1->rowCount() == 0)
                                            echo 'N/A';
                                        else {
                                            $table1 = $pdostmt1->fetchAll(PDO::FETCH_NUM);

                                            foreach ($table1 as $row) {
                                                echo "$row[0]";
                                            }
                                        }
                                    }
                                } catch (Exception $ex) {
                                    echo 'NOTHING!';
                                }
                            ?>

                        </td>
                        <td  style="display: none">
                            <p id="user-cpu">
                                <?php
                                try {
                                    $con = new PDO("mysql:host=localhost; dbname=gamessolution", 'root', '');

                                    $stmt = "select p_id from users where email = '$_SESSION[uemail]'";
                                    $pdostmt = $con->query($stmt);
                                    $table = $pdostmt->fetchAll(PDO::FETCH_NUM);

                                    foreach ($table as $row) {
                                        echo "$row[0]";
                                    }
                                } catch (Exception $ex) {
                                    echo 'NOTHING!';
                                }
                            ?>
                            <p>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Your GPU Manufacturer:</strong></td>
                        <td>
                            
                            <?php
                                try {
                                    $con = new PDO("mysql:host=localhost; dbname=gamessolution", 'root', '');

                                    $stmt = "select g_id from users where email = '$_SESSION[uemail]'";
                                    $pdostmt = $con->query($stmt);
                                    $table = $pdostmt->fetchAll(PDO::FETCH_NUM);

                                    foreach ($table as $row) {

                                        $stmt1 = "select g_manufacturer from graphics where g_id='$row[0]'";
                                        $pdostmt1 = $con->query($stmt1);
                                        if ($pdostmt1->rowCount() == 0)
                                            echo 'N/A';
                                        else {
                                            $table1 = $pdostmt1->fetchAll(PDO::FETCH_NUM);

                                            foreach ($table1 as $row) {
                                                echo "$row[0]";
                                            }
                                        }
                                    }
                                } catch (Exception $ex) {
                                    echo 'NOTHING!';
                                }
                            ?>
                            
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Your GPU Model:</strong></td>
                        <td id="gpumod">
                            
                                <?php
                                try {
                                        $con = new PDO("mysql:host=localhost; dbname=gamessolution", 'root', '');

                                        $stmt = "select g_id from users where email = '$_SESSION[uemail]'";
                                        $pdostmt = $con->query($stmt);
                                        $table = $pdostmt->fetchAll(PDO::FETCH_NUM);

                                        foreach ($table as $row) {

                                            $stmt1 = "select g_model from graphics where g_id='$row[0]'";
                                            $pdostmt1 = $con->query($stmt1);
                                            if ($pdostmt1->rowCount() == 0)
                                                echo 'N/A';
                                            else {
                                                $table1 = $pdostmt1->fetchAll(PDO::FETCH_NUM);

                                                foreach ($table1 as $row) {
                                                    echo "$row[0]";
                                                }
                                            }
                                        }
                                    } catch (Exception $ex) {
                                        echo 'NOTHING!';
                                    }
                                ?>
                            
                        </td>
                        <td  style="display: none">
                            <p id="user-gpu">
                                <?php
                                try {
                                    $con = new PDO("mysql:host=localhost; dbname=gamessolution", 'root', '');

                                    $stmt = "select g_id from users where email = '$_SESSION[uemail]'";
                                    $pdostmt = $con->query($stmt);
                                    $table = $pdostmt->fetchAll(PDO::FETCH_NUM);

                                    foreach ($table as $row) {
                                        echo "$row[0]";
                                    }
                                } catch (Exception $ex) {
                                    echo 'NOTHING!';
                                }
                            ?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Enter your Memory:</strong></td>
                        <td id="mem">
                            
                                <?php
                                try {
                                        $con = new PDO("mysql:host=localhost; dbname=gamessolution", 'root', '');

                                        $stmt = "select r_id from users where email = '$_SESSION[uemail]'";
                                        $pdostmt = $con->query($stmt);
                                        $table = $pdostmt->fetchAll(PDO::FETCH_NUM);

                                        foreach ($table as $row) {

                                            $stmt1 = "select memory from ram where r_id='$row[0]'";
                                            $pdostmt1 = $con->query($stmt1);
                                            if ($pdostmt1->rowCount() == 0)
                                                echo 'N/A';
                                            else {
                                                $table1 = $pdostmt1->fetchAll(PDO::FETCH_NUM);

                                                foreach ($table1 as $row) {
                                                    echo "$row[0]";
                                                }
                                            }
                                        }
                                    } catch (Exception $ex) {
                                        echo 'NOTHING!';
                                    }
                                ?>
                            
                        </td>
                        <td  style="display: none">
                            <p id="user-ram">
                                <?php
                                try {
                                    $con = new PDO("mysql:host=localhost; dbname=gamessolution", 'root', '');

                                    $stmt = "select r_id from users where email = '$_SESSION[uemail]'";
                                    $pdostmt = $con->query($stmt);
                                    $table = $pdostmt->fetchAll(PDO::FETCH_NUM);

                                    foreach ($table as $row) {
                                        echo "$row[0]";
                                    }
                                } catch (Exception $ex) {
                                    echo 'NOTHING!';
                                }
                            ?>
                            </p>
                        </td>
                    </tr>
                    
                    <!-- Checking starts after pressing the button -->
                    
                    <tr>
                        <td style="text-align: center;" colspan="2">
                           
                            <button class="check-button" onmouseover="this.style.background = 'black';" onmouseout="this.style.background = '#5e0101';" style="padding: 10px; cursor: pointer; border: none; border: 1px solid #5e0101;margin-left: 55px; border-radius: 15px; background-color: #5e0101; color: white; font-size: 100%; padding-left: 10px; padding-right: 10px" onclick="checking()">GO!</button>
                            <button class="check-button" onmouseover="this.style.background = 'black';" onmouseout="this.style.background = '#5e0101';" style="padding: 10px; cursor: pointer; border: none; border: 1px solid #5e0101; border-radius: 15px; background-color: #5e0101; color: white; font-size: 100%; padding-left: 10px; padding-right: 10px" onclick="checkanother()">Check Another</button>
                        
                        </td>
                    </tr>
                </table>
        </div>
            <script>
                function checkanother()
                {
                    document.getElementById('mypcpart').style.display = "none";
                    document.getElementById('check-part').style.display = "inline";
                }
            </script>
                
            <!-- If you'r System is not saved -->
            
            
            <div id="check-part" class="check-part" style="display: none">
                <table style="width: 400px; height: 306px; font-size: 120%; margin: 5px; border-top:2px solid gray;  border-bottom: 2px solid gray; border-collapse: collapse">
                    <caption style="padding-bottom: 20px; font-size: 130%;">Can you run it?</caption>
                    <tr>
                        <td><strong>Enter your CPU Manufacturer:</strong></td>
                        <td>
                            <select id="cpuman" style="padding: 10px">
                                <?php
                                try {
                                    $con = new PDO("mysql:host=localhost; dbname=gamessolution", 'root', '');

                                    $stmt = "select distinct p_manufacturer from processor";
                                    $pdostmt = $con->query($stmt);
                                    $table = $pdostmt->fetchAll(PDO::FETCH_NUM);

                                    foreach ($table as $row) {
                                        echo "<option>$row[0]</option>";
                                    }
                                } catch (Exception $ex) {
                                    echo 'NOTHING!';
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Enter your CPU Model:</strong></td>
                        <td>
                            <select id="cpumod" onchange="changeCPUMOD()" style="padding: 10px">
                                <?php
                                try {
                                    $con = new PDO("mysql:host=localhost; dbname=gamessolution", 'root', '');

                                    $stmt = "select distinct p_model from processor";
                                    $pdostmt = $con->query($stmt);
                                    $table = $pdostmt->fetchAll(PDO::FETCH_NUM);

                                    foreach ($table as $row) {
                                        echo "<option>$row[0]</option>";
                                    }
                                } catch (Exception $ex) {
                                    echo 'NOTHING!';
                                }
                                ?>
                            </select>
                        </td>
                        <td  style="display: none">
                            <p id="user-cpu">1</p>
                        </td>
                        
                        <!-- Getting the processor id for the entered model -->
                        
                    <script>
                        function changeCPUMOD()
                        {
                        var x = document.getElementById('cpumod').value;
                        var request = new XMLHttpRequest();
                        request.onreadystatechange = function () {
                        if (this.readyState == 4 && this.status == 200) {
                        document.getElementById('user-cpu').innerHTML = request.responseText;
                        }
                        }

                        request.open("GET", "internal_cpu.php?user-cpu=" + x, true);
                        request.send();
                        }
                    </script>
                    </tr>
                    <tr>
                        <td><strong>Enter your GPU Manufacturer:</strong></td>
                        <td>
                            <select id="gpuman" style="padding: 10px">
                                <?php
                                try {
                                    $con = new PDO("mysql:host=localhost; dbname=gamessolution", 'root', '');

                                    $stmt = "select distinct g_manufacturer from graphics";
                                    $pdostmt = $con->query($stmt);
                                    $table = $pdostmt->fetchAll(PDO::FETCH_NUM);

                                    foreach ($table as $row) {
                                        echo "<option>$row[0]</option>";
                                    }
                                } catch (Exception $ex) {
                                    echo 'NOTHING!';
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Enter your GPU Model:</strong></td>
                        <td>
                            <select id="gpumod" onchange="changeGPUMOD()" style="padding: 10px">
                                <?php
                                try {
                                    $con = new PDO("mysql:host=localhost; dbname=gamessolution", 'root', '');

                                    $stmt = "select distinct g_model from graphics";
                                    $pdostmt = $con->query($stmt);
                                    $table = $pdostmt->fetchAll(PDO::FETCH_NUM);

                                    foreach ($table as $row) {
                                        echo "<option>$row[0]</option>";
                                    }
                                } catch (Exception $ex) {
                                    echo 'NOTHING!';
                                }
                                ?>
                            </select>
                        </td>
                        <td  style="display: none">
                            <p id="user-gpu">1</p>
                        </td>
                        
                         <!-- Getting the graphics id for the entered model -->
                         
                    <script>
                        function changeGPUMOD()
                        {
                        var x = document.getElementById('gpumod').value;
                        var request = new XMLHttpRequest();
                        request.onreadystatechange = function () {
                        if (this.readyState == 4 && this.status == 200) {
                        document.getElementById('user-gpu').innerHTML = request.responseText;
                        }
                        }

                        request.open("GET", "internal_gpu.php?user-gpu=" + x, true);
                        request.send();
                        }
                    </script>

                    </tr>
                    <tr>
                        <td><strong>Enter your Memory:</strong></td>
                        <td>
                            <select id="mem" onchange="changeRAM()" style="padding: 10px">
                                <?php
                                try {
                                    $con = new PDO("mysql:host=localhost; dbname=gamessolution", 'root', '');

                                    $stmt = "select memory,r_id from ram";
                                    $pdostmt = $con->query($stmt);
                                    $table = $pdostmt->fetchAll(PDO::FETCH_NUM);

                                    foreach ($table as $row) {
                                        echo "<option>$row[0]</option>";
                                        $ram_id = $row[1];
                                    }
                                } catch (Exception $ex) {
                                    echo 'NOTHING!';
                                }
                                ?>
                            </select>
                        </td>
                        <td  style="display: none">
                            <p id="user-ram">1</p>
                        </td>
                        
                         <!-- Getting the ram id for the entered memory -->
                        
                    <script>
                        function changeRAM()
                        {
                        var x = document.getElementById('mem').value;
                        var request = new XMLHttpRequest();
                        request.onreadystatechange = function () {
                        if (this.readyState == 4 && this.status == 200) {
                        document.getElementById('user-ram').innerHTML = request.responseText;
                        }
                        }

                        request.open("GET", "internal_ram.php?user-ram=" + x, true);
                        request.send();
                        }
                    </script>

                    </tr>
                    
                    <!-- Checking starts after pressing the button -->
                    
                    <tr>
                        <td colspan="2" style="text-align: center;">
                            <button class="check-button" onmouseover="this.style.background = 'black';" onmouseout="this.style.background = '#5e0101';" style="padding: 10px; cursor: pointer; border: none; border: 1px solid #5e0101; border-radius: 15px; background-color: #5e0101; color: white; font-size: 110%; padding-left: 150px; padding-right: 150px" onclick="checking()">GO!</button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        
        <!-- The result pop-up -->
        
        <div>
            <h1  id="result" style="font-size: 850%; background-color: black; color: white; border:5px solid darkred; position: fixed; top: 365px; left: 820px; transform: translate(-50%,-50%); padding: 50px; display: none">MEDIUM</h1>
            <i class="material-icons" id="cross-button" onclick="hideResult()" style="font-size:48px; color:gray; cursor: pointer; position: fixed; top: 325px; left: 1130px; z-index: +10; display: none">cancel</i>
        </div>

        <script>
            function mypc(){
                window.location.assign('mypcdetails.php');
            }

                function hideResult()
                {
                document.getElementById('result').style.display = "none";
                document.getElementById('cross-button').style.display = "none";
                }
<!-- Going to Home page -->

            function home()
            {
                    window.location.assign('home.php');
            }
            function gpuCompare()
            {
                        window.location.assign('gpucompare.php');
            }
            function gamesList()
            {
        window.location.assign('gameslist.php');
            }

<!-- Checking whether the game will run or not -->

            function checking(){
                var games_p = document.getElementById('processor_id_game').innerHTML;
                var games_g = document.getElementById('graphics_id_game').innerHTML;
                var games_r = document.getElementById('ram_id_game').innerHTML;
                var user_p = document.getElementById('user-cpu').innerHTML;
                var user_g = document.getElementById('user-gpu').innerHTML;
                var user_r = document.getElementById('user-ram').innerHTML;
                var p = games_p - user_p;
                var g = games_g - user_g;
                var r = games_r - user_r;
                var low = 0;
                var medium = 0;
                var high = 0;
                var fail = 0;
                if (p <= - 2)
                        high++;
                else if (p >= - 1 && p <= 1)
                        medium++;
                else if (p >= 2 && p <= 3)
                        low++;
                else if (p >= 4)
                        fail++;
                if (g <= - 2)
                        high++;
                else if (g >= - 1 && g <= 1)
                        medium++;
                else if (g >= 2 && g <= 3)
                        low++;
                else if (g >= 4)
                        fail++;
                if (r <= - 2)
                        high++;
                else if (r >= - 1 && r <= 1)
                        medium++;
                else if (r >= 2 && r <= 3)
                        low++;
                else if (r >= 4)
                        fail++;
                if ((high == 3) || (high == 2 && medium == 1)){
                document.getElementById('result').innerHTML = "HIGH";
                document.getElementById('cross-button').style.left = "1020px";
                            }
                            else if ((medium == 2 && high == 1)||(medium == 3)|| (high == 2 && low == 1)){
                        document.getElementById('result').innerHTML = "MEDIUM";
                document.getElementById('cross-button').style.left = "1130px";
            }
            else if (fail > 0){
                document.getElementById('result').innerHTML = "FAIL";
                document.getElementById('cross-button').style.left = "982px";
            }
            else
            {
                document.getElementById('result').innerHTML = "LOW";
                document.getElementById('cross-button').style.left = "985px";
            }
            document.getElementById('result').style.display = "inline";
            document.getElementById('cross-button').style.display = "inline";
        }
        </script>
    </body>    
</html>
            <?php
} else {
    ?>
            
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Games Solution</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <style>
            body {
                cursor: pointer;
                font-family: garamond;
            }
            .login:hover{
                font-size: 115%;
            }
            .navigation_bar {

                list-style-type: none;
                margin: 0;
                padding: 0;
                position: sticky;
                top: 5px;
                overflow: hidden;
                background-color: black;
            }


            li{
                cursor: pointer;
                float: left;
                padding: 16px;
                color: white;
            }

            li.active{
                background-color: darkblue;
                font-size: 150%;
            }

            li.list1:hover {
                background-color: #5e0101;
                font-size: 115%;
            }

            .searchContainer {
                display: inline-flex;
                flex: 1 1 300px;
                border: 2px solid #ccc;
                border-radius: 5px;
                overflow: hidden;
            }

            .searchIcon {
                padding: 0.5rem;
            }

            .searchBox {
                border: 0;
                padding: 0.5rem 0.5rem 0.5rem 0;
                flex: 1;
            }

            .searchButton {
                cursor: pointer;
                background: #5e0101;
                border: 0;
                color: white;
                padding: 0.5rem;
                border-radius: 0;
            }
            .searchButton:hover{
                background: black;
                color: aliceblue;
            }
            
            .left-part{
                display: inline-block;
                top: 265px;
                left: 105px;
                position: absolute;
            }
            .right-part{
                display: inline-block;
                position: absolute;
                top: 255px;
                left: 405px;
            }

            .right-part table tr:nth-child(even){
                background-color: lightgrey;
            }

            .check-part{
                display: inline-block;
                top: 255px;
                left: 820px;
                position: absolute;
            }
            .check-part table tr:nth-child(odd){
                background-color: lightgrey;
            }
            
            
        </style>
    </head>
    <body>
        <!-- HEADER -->
        <table style="width: 100%;  overflow-y: scroll">
            <tbody>
                <tr>
                    <td><img src="logo.png"></td>
                    <td><b style="font-size: 250%; color: #5e0101;">"Before playing, make sure you can run it!"</b></td>
                    <td><a href="login.php" class="login" style="text-decoration: none; color: #5e0101">LOGIN</a></td>
                    <td></td>
                    <td><a href="register.php" class="login" style="text-decoration: none; color: #5e0101">REGISTER</a></td>
                </tr>
            </tbody>
        </table>
        
        <!-- NAVIGATIONAL BAR -->
        
        <ul id="navigation_bar" class="navigation_bar" name="navigation_bar" style="z-index: +999">
            <li class="list1" style="padding: 25px" onclick="home()">Home</li>
            <li class="list1" style="padding: 25px" onclick="gamesList()">Games List</li>
            <li class="list1" style="padding: 25px" onclick="mypc()">My Computer Details</li>
            <li class="list1" style="padding: 25px" onclick="gpuCompare()">GPU Compare</li>
            <li style="float: right;">
                <div class="searchContainer">
                    <form method="get" action="gameslist.php">
                        <i class="fa fa-search searchIcon"></i>
                        <input class="searchBox" id="search" type="search" name="search" placeholder="Search...">
                        <input type="submit" value="Search" name="submit" class="searchButton">
                    </form>
                </div>
            </li>
        </ul>
        <br/>
        
        <!-- WELCOME MESSAGE -->
        
        <h2>Welcome to the guiding star in your world of Gaming.</h2>
        <hr>

        <div class="main-section">
            
            <!-- Selecting the image of the Corresponding game from Database -->
            
            <div class="left-part">
                <?php
                $id = "";
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];

                    try {
                        $con = new PDO('mysql:host=localhost;dbname=gamessolution', 'root', '');
                        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        $stmt = "select piclink from games where games_id='$id'";
                        $pdostmt = $con->query($stmt);

                        if ($pdostmt->rowCount() == 1) {
                            $table = $pdostmt->fetchAll(PDO::FETCH_NUM);

                            foreach ($table as $row) {
                                echo "<img src='$row[0]' style='width: 275px; height: 350px;'>";
                            }
                        } else {
                            echo "<h1>NO GAMES TO SHOW</h1>";
                        }
                    } catch (Exception $ex) {
                        echo 'No Data Found';
                    }
                    $con = null;
                }
                ?>
            </div>
            
            <!-- Selecting the System Requirements of the Selected Game from Database -->
            
            <div class="right-part">
                <table style="width: 400px; height: 306px; font-size: 120%; margin: 5px; border-top: 2px solid gray; border-bottom: 2px solid gray; border-collapse: collapse">
                    <caption style="padding-bottom: 20px; font-size: 130%;">Minimum System Requirements</caption>
                    <tr>
                        <!-- Selecting the NAME -->
                        
                        <td><strong>Name:</strong></td>
                        <td>
                            <?php
                            $id = "";
                            if (isset($_GET['id'])) {
                                $id = $_GET['id'];

                                try {
                                    $con = new PDO('mysql:host=localhost;dbname=gamessolution', 'root', '');
                                    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                    $stmt = "select name from games where games_id='$id'";
                                    $pdostmt = $con->query($stmt);

                                    if ($pdostmt->rowCount() == 1) {
                                        $table = $pdostmt->fetchAll(PDO::FETCH_NUM);

                                        foreach ($table as $row) {
                                            echo "$row[0]";
                                        }
                                    } else {
                                        echo "<h1>NO GAMES TO SHOW</h1>";
                                    }
                                } catch (Exception $ex) {
                                    echo 'No Data Found';
                                }
                                $con = null;
                            }
                            ?>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        
                        <!-- Selecting Game Type -->
                        
                        <td><strong>Type:</strong></td>
                        <td>
                            <?php
                            $id = "";
                            if (isset($_GET['id'])) {
                                $id = $_GET['id'];

                                try {
                                    $con = new PDO('mysql:host=localhost;dbname=gamessolution', 'root', '');
                                    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                    $stmt = "select type from games where games_id='$id'";
                                    $pdostmt = $con->query($stmt);

                                    if ($pdostmt->rowCount() == 1) {
                                        $table = $pdostmt->fetchAll(PDO::FETCH_NUM);

                                        foreach ($table as $row) {
                                            echo "$row[0]";
                                        }
                                    } else {
                                        echo "<h1>NO GAMES TO SHOW</h1>";
                                    }
                                } catch (Exception $ex) {
                                    echo 'No Data Found';
                                }
                                $con = null;
                            }
                            ?>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        
                        <!-- Selecting Processor Manufacturer & Model -->
                        
                        <td><strong>Processor:</strong></td>
                        <td>
                            <?php
                            $id = "";
                            if (isset($_GET['id'])) {
                                $id = $_GET['id'];

                                try {
                                    $con = new PDO('mysql:host=localhost;dbname=gamessolution', 'root', '');
                                    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                    $stmt = "select p_id from games where games_id='$id'";
                                    $pdostmt = $con->query($stmt);

                                    if ($pdostmt->rowCount() == 1) {
                                        $table = $pdostmt->fetchAll(PDO::FETCH_NUM);
                                        foreach ($table as $row) {
                                            $stmt = "select p_manufacturer,p_model from processor where p_id='$row[0]'";
                                            $pdostmt = $con->query($stmt);
                                            $table = $pdostmt->fetchAll(PDO::FETCH_NUM);
                                            foreach ($table as $row) {
                                                echo "$row[0] $row[1]";
                                            }
                                        }
                                    } else {
                                        echo "<h1>NO PROCESSOR TO SHOW</h1>";
                                    }
                                } catch (Exception $ex) {
                                    echo 'No Data Found';
                                }
                                $con = null;
                            }
                            ?>
                        </td>
                        
                        <!-- Saving the Processor id for the corresponding model to compare -->
                        
                        <td style="display: none">
                            <?php
                            $id = "";
                            if (isset($_GET['id'])) {
                                $id = $_GET['id'];

                                try {
                                    $con = new PDO('mysql:host=localhost;dbname=gamessolution', 'root', '');
                                    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                    $stmt = "select p_id from games where games_id='$id'";
                                    $pdostmt = $con->query($stmt);

                                    if ($pdostmt->rowCount() == 1) {
                                        $table = $pdostmt->fetchAll(PDO::FETCH_NUM);
                                        foreach ($table as $row) {
                                            echo "<p id='processor_id_game'>$row[0]</p>";
                                        }
                                    } else {
                                        echo "<h1>NO PROCESSOR TO SHOW</h1>";
                                    }
                                } catch (Exception $ex) {
                                    echo 'No Data Found';
                                }
                                $con = null;
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        
                        <!-- Selecting Graphics Card Manufacturer & Model -->
                        
                        <td><strong>Graphics:</strong></td>
                        <td>
                            <?php
                            $id = "";
                            if (isset($_GET['id'])) {
                                $id = $_GET['id'];

                                try {
                                    $con = new PDO('mysql:host=localhost;dbname=gamessolution', 'root', '');
                                    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                    $stmt = "select g_id from games where games_id='$id'";
                                    $pdostmt = $con->query($stmt);

                                    if ($pdostmt->rowCount() == 1) {
                                        $table = $pdostmt->fetchAll(PDO::FETCH_NUM);
                                        foreach ($table as $row) {
                                            $stmt = "select g_manufacturer,g_model from graphics where g_id='$row[0]'";
                                            $pdostmt = $con->query($stmt);
                                            $table = $pdostmt->fetchAll(PDO::FETCH_NUM);
                                            foreach ($table as $row) {
                                                echo "$row[0] $row[1]";
                                            }
                                        }
                                    } else {
                                        echo "<h1>NO GRAPHICS TO SHOW</h1>";
                                    }
                                } catch (Exception $ex) {
                                    echo 'No Data Found';
                                }
                                $con = null;
                            }
                            ?>
                        </td>
                        
                        <!-- Saving the graphics id for the corresponding model to compare -->
                        
                        <td style="display: none">
                            <?php
                            $id = "";
                            if (isset($_GET['id'])) {
                                $id = $_GET['id'];

                                try {
                                    $con = new PDO('mysql:host=localhost;dbname=gamessolution', 'root', '');
                                    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                    $stmt = "select g_id from games where games_id='$id'";
                                    $pdostmt = $con->query($stmt);

                                    if ($pdostmt->rowCount() == 1) {
                                        $table = $pdostmt->fetchAll(PDO::FETCH_NUM);
                                        foreach ($table as $row) {
                                            echo "<p id='graphics_id_game'>$row[0]</p>";
                                        }
                                    } else {
                                        echo "<h1>NO GRAPHICS TO SHOW</h1>";
                                    }
                                } catch (Exception $ex) {
                                    echo 'No Data Found';
                                }
                                $con = null;
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        
                        <!-- Selecting Ram -->
                        
                        <td><strong>Memory:</strong></td>
                        <td>
                            <?php
                            $id = "";
                            if (isset($_GET['id'])) {
                                $id = $_GET['id'];

                                try {
                                    $con = new PDO('mysql:host=localhost;dbname=gamessolution', 'root', '');
                                    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                    $stmt = "select r_id from games where games_id='$id'";
                                    $pdostmt = $con->query($stmt);

                                    if ($pdostmt->rowCount() == 1) {
                                        $table = $pdostmt->fetchAll(PDO::FETCH_NUM);
                                        foreach ($table as $row) {
                                            $stmt = "select memory from ram where r_id='$row[0]'";
                                            $pdostmt = $con->query($stmt);
                                            $table = $pdostmt->fetchAll(PDO::FETCH_NUM);
                                            foreach ($table as $row) {
                                                echo "$row[0]";
                                            }
                                        }
                                    } else {
                                        echo "<h1>NO MEMORY TO SHOW</h1>";
                                    }
                                } catch (Exception $ex) {
                                    echo 'No Data Found';
                                }
                                $con = null;
                            }
                            ?>
                        </td>
                        
                        <!-- Saving the ram id for the corresponding memory to compare -->
                        
                        <td style="display: none">
                            <?php
                            $id = "";
                            if (isset($_GET['id'])) {
                                $id = $_GET['id'];

                                try {
                                    $con = new PDO('mysql:host=localhost;dbname=gamessolution', 'root', '');
                                    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                    $stmt = "select r_id from games where games_id='$id'";
                                    $pdostmt = $con->query($stmt);

                                    if ($pdostmt->rowCount() == 1) {
                                        $table = $pdostmt->fetchAll(PDO::FETCH_NUM);
                                        foreach ($table as $row) {
                                            echo "<p id='ram_id_game'>$row[0]</p>";
                                        }
                                    } else {
                                        echo "<h1>NO MEMORY TO SHOW</h1>";
                                    }
                                } catch (Exception $ex) {
                                    echo 'No Data Found';
                                }
                                $con = null;
                            }
                            ?>
                        </td>
                    </tr>
                </table>
            </div>
            
            <!-- Enter your System's Configuration -->
            
            <div class="check-part">
                <table style="width: 400px; height: 306px; font-size: 120%; margin: 5px; border-top:2px solid gray;  border-bottom: 2px solid gray; border-collapse: collapse">
                    <caption style="padding-bottom: 20px; font-size: 130%;">Can you run it?</caption>
                    <tr>
                        <td><strong>Enter your CPU Manufacturer:</strong></td>
                        <td>
                            <select id="cpuman" style="padding: 10px">
                                <?php
                                try {
                                    $con = new PDO("mysql:host=localhost; dbname=gamessolution", 'root', '');

                                    $stmt = "select distinct p_manufacturer from processor";
                                    $pdostmt = $con->query($stmt);
                                    $table = $pdostmt->fetchAll(PDO::FETCH_NUM);

                                    foreach ($table as $row) {
                                        echo "<option>$row[0]</option>";
                                    }
                                } catch (Exception $ex) {
                                    echo 'NOTHING!';
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Enter your CPU Model:</strong></td>
                        <td>
                            <select id="cpumod" onchange="changeCPUMOD()" style="padding: 10px">
                                <?php
                                try {
                                    $con = new PDO("mysql:host=localhost; dbname=gamessolution", 'root', '');

                                    $stmt = "select distinct p_model from processor";
                                    $pdostmt = $con->query($stmt);
                                    $table = $pdostmt->fetchAll(PDO::FETCH_NUM);

                                    foreach ($table as $row) {
                                        echo "<option>$row[0]</option>";
                                    }
                                } catch (Exception $ex) {
                                    echo 'NOTHING!';
                                }
                                ?>
                            </select>
                        </td>
                        <td  style="display: none">
                            <p id="user-cpu">1</p>
                        </td>
                        
                        <!-- Getting the processor id for the entered model -->
                        
                    <script>
                        function changeCPUMOD()
                        {
                        var x = document.getElementById('cpumod').value;
                        var request = new XMLHttpRequest();
                        request.onreadystatechange = function () {
                        if (this.readyState == 4 && this.status == 200) {
                        document.getElementById('user-cpu').innerHTML = request.responseText;
                        }
                        }

                        request.open("GET", "internal_cpu.php?user-cpu=" + x, true);
                        request.send();
                        }
                    </script>
                    </tr>
                    <tr>
                        <td><strong>Enter your GPU Manufacturer:</strong></td>
                        <td>
                            <select id="gpuman" style="padding: 10px">
                                <?php
                                try {
                                    $con = new PDO("mysql:host=localhost; dbname=gamessolution", 'root', '');

                                    $stmt = "select distinct g_manufacturer from graphics";
                                    $pdostmt = $con->query($stmt);
                                    $table = $pdostmt->fetchAll(PDO::FETCH_NUM);

                                    foreach ($table as $row) {
                                        echo "<option>$row[0]</option>";
                                    }
                                } catch (Exception $ex) {
                                    echo 'NOTHING!';
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Enter your GPU Model:</strong></td>
                        <td>
                            <select id="gpumod" onchange="changeGPUMOD()" style="padding: 10px">
                                <?php
                                try {
                                    $con = new PDO("mysql:host=localhost; dbname=gamessolution", 'root', '');

                                    $stmt = "select distinct g_model from graphics";
                                    $pdostmt = $con->query($stmt);
                                    $table = $pdostmt->fetchAll(PDO::FETCH_NUM);

                                    foreach ($table as $row) {
                                        echo "<option>$row[0]</option>";
                                    }
                                } catch (Exception $ex) {
                                    echo 'NOTHING!';
                                }
                                ?>
                            </select>
                        </td>
                        <td  style="display: none">
                            <p id="user-gpu">1</p>
                        </td>
                        
                         <!-- Getting the graphics id for the entered model -->
                         
                    <script>
                        function changeGPUMOD()
                        {
                        var x = document.getElementById('gpumod').value;
                        var request = new XMLHttpRequest();
                        request.onreadystatechange = function () {
                        if (this.readyState == 4 && this.status == 200) {
                        document.getElementById('user-gpu').innerHTML = request.responseText;
                        }
                        }

                        request.open("GET", "internal_gpu.php?user-gpu=" + x, true);
                        request.send();
                        }
                    </script>

                    </tr>
                    <tr>
                        <td><strong>Enter your Memory:</strong></td>
                        <td>
                            <select id="mem" onchange="changeRAM()" style="padding: 10px">
                                <?php
                                try {
                                    $con = new PDO("mysql:host=localhost; dbname=gamessolution", 'root', '');

                                    $stmt = "select memory,r_id from ram";
                                    $pdostmt = $con->query($stmt);
                                    $table = $pdostmt->fetchAll(PDO::FETCH_NUM);

                                    foreach ($table as $row) {
                                        echo "<option>$row[0]</option>";
                                        $ram_id = $row[1];
                                    }
                                } catch (Exception $ex) {
                                    echo 'NOTHING!';
                                }
                                ?>
                            </select>
                        </td>
                        <td  style="display: none">
                            <p id="user-ram">1</p>
                        </td>
                        
                         <!-- Getting the ram id for the entered memory -->
                        
                    <script>
                        function changeRAM()
                        {
                        var x = document.getElementById('mem').value;
                        var request = new XMLHttpRequest();
                        request.onreadystatechange = function () {
                        if (this.readyState == 4 && this.status == 200) {
                        document.getElementById('user-ram').innerHTML = request.responseText;
                        }
                        }

                        request.open("GET", "internal_ram.php?user-ram=" + x, true);
                        request.send();
                        }
                    </script>

                    </tr>
                    
                    <!-- Checking starts after pressing the button -->
                    
                    <tr>
                        <td colspan="2" style="text-align: center;">
                            <button class="check-button" onmouseover="this.style.background = 'black';" onmouseout="this.style.background = '#5e0101';" style="padding: 10px; cursor: pointer; border: none; border: 1px solid #5e0101; border-radius: 15px; background-color: #5e0101; color: white; font-size: 110%; padding-left: 150px; padding-right: 150px" onclick="checking()">GO!</button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        
        <!-- The result pop-up -->
        
        <div>
            <h1  id="result" style="font-size: 850%; background-color: black; color: white; border:5px solid darkred; position: fixed; top: 365px; left: 820px; transform: translate(-50%,-50%); padding: 50px; display: none">MEDIUM</h1>
            <i class="material-icons" id="cross-button" onclick="hideResult()" style="font-size:48px; color:gray; cursor: pointer; position: fixed; top: 325px; left: 1130px; z-index: +10; display: none">cancel</i>
        </div>

        <script>
            function mypc(){
                window.alert('Log in to Continue.');
            }

                function hideResult()
                {
                document.getElementById('result').style.display = "none";
                document.getElementById('cross-button').style.display = "none";
                }
<!-- Going to Home page -->

            function home()
            {
                    window.location.assign('home.php');
            }
            function gpuCompare()
            {
                        window.location.assign('gpucompare.php');
            }
            function gamesList()
            {
        window.location.assign('gameslist.php');
            }

<!-- Checking whether the game will run or not -->

            function checking(){
                        var games_p = document.getElementById('processor_id_game').innerHTML;
                var games_g = document.getElementById('graphics_id_game').innerHTML;
                var games_r = document.getElementById('ram_id_game').innerHTML;
                var user_p = document.getElementById('user-cpu').innerHTML;
                var user_g = document.getElementById('user-gpu').innerHTML;
                var user_r = document.getElementById('user-ram').innerHTML;
                var p = games_p - user_p;
                var g = games_g - user_g;
                var r = games_r - user_r;
                var low = 0;
                var medium = 0;
                var high = 0;
                var fail = 0;
                if (p <= - 2)
                        high++;
                else if (p >= - 1 && p <= 1)
                        medium++;
                else if (p >= 2 && p <= 3)
                        low++;
                else if (p >= 4)
                        fail++;
                if (g <= - 2)
                        high++;
                else if (g >= - 1 && g <= 1)
                        medium++;
                else if (g >= 2 && g <= 3)
                        low++;
                else if (g >= 4)
                        fail++;
                if (r <= - 2)
                        high++;
                else if (r >= - 1 && r <= 1)
                        medium++;
                else if (r >= 2 && r <= 3)
                        low++;
                else if (r >= 4)
                        fail++;
                if ((high == 3) || (high == 2 && medium == 1)){
                document.getElementById('result').innerHTML = "HIGH";
                document.getElementById('cross-button').style.left = "1020px";
                            }
                            else if ((medium == 2 && high == 1)||(medium == 3)|| (high == 2 && low == 1)){
                        document.getElementById('result').innerHTML = "MEDIUM";
                document.getElementById('cross-button').style.left = "1130px";
            }
            else if (fail > 0){
                document.getElementById('result').innerHTML = "FAIL";
                document.getElementById('cross-button').style.left = "982px";
            }
            else
            {
                document.getElementById('result').innerHTML = "LOW";
                document.getElementById('cross-button').style.left = "985px";
            }
            document.getElementById('result').style.display = "inline";
            document.getElementById('cross-button').style.display = "inline";
        }
        </script>
    </body>    
</html>
    <?php
}
?>
