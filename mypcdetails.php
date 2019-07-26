<?php
session_start();

if (isset($_SESSION['uemail'])) {
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <title>Games Solution</title>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <style>
                body {
                    font-family: garamond;
                    cursor: pointer;
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
                    float: left;
                    padding: 16px;
                    color: white;
                }

                li.active{
                    background-color: darkblue;
                    font-size: 150%;
                }

                li.list1:hover {
                    cursor: pointer;
                    background-color: #5e0101;
                    font-size: 150%;
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
                    background: #5e0101;
                    border: 0;
                    color: white;
                    padding: 0.5rem;
                    border-radius: 0;
                }
                .searchButton:hover{
                    cursor: pointer;
                    background: black;
                    color: aliceblue;
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
                    left: 450px;
                    position: absolute;
                }
                .check-part table tr:nth-child(odd){
                    background-color: lightgrey;
                }
            </style>
        </head>
        <body>
            <table style="width: 100%; border-collapse: collapse; overflow-y: scroll">
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
                    function gotoPage() {

                        var p = document.getElementById('option').value;
                        if (p == 'Profile')
                            window.location.assign('profile.php');
                        else if (p == 'Log Out') {

                            var ans = window.confirm('Sure you want to Log Out?');
                            if (ans == true)
                                window.location.assign('logout.php');
                            else {
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
                        } else {
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

    <ul id="navigation_bar" class="navigation_bar" name="navigation_bar" style="z-index: +999">
        <li class="list1" style="padding: 25px" onclick="home()">Home</li>
        <li class="list1" style="padding: 25px" onclick="gameList()">Games List</li>
        <li class="active" style="padding: 25px">My Computer Details</li>
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
    <h2>Welcome to the guiding star in your world of Gaming.</h2>
    <hr>
    <div class="check-part">
        <table style="width: 400px; height: 306px; font-size: 120%; margin: 5px; border-top:2px solid gray;  border-bottom: 2px solid gray; border-collapse: collapse">
            <caption style="padding-bottom: 20px; font-size: 130%;">My PC Configuration</caption>
            <tr>
                <td><strong>CPU Manufacturer:</strong></td>
                <td id="cpuMan1"> <?php
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
                <td><strong>CPU Model:</strong></td>
                <td id="cpuMod1">
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
            </tr>
            <tr>
                <td><strong>GPU Manufacturer:</strong></td>
                <td id="gpuMan1">
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
                <td><strong>GPU Model:</strong></td>
                <td id="gpuMod1">
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
           </tr>
            <tr>
                <td><strong>Memory:</strong></td>
                <td id="ram1">
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
            <tr>
                <td colspan="2" style="text-align: center;">
                    <button  onclick="checking()" class="check-button" id="check-button" onmouseover="this.style.background = 'black';" onmouseout="this.style.background = '#5e0101';" style="padding: 10px; cursor: pointer; border: none; border: 1px solid #5e0101; border-radius: 15px; background-color: #5e0101; color: white; font-size: 110%; padding-left: 150px; padding-right: 150px">Change</button>
                </td>
            </tr>
        </table>
    </div>


    <div class="footer" style="display: inline-block; height: 100px; width: 100%; background-image: url(https://www.allmightysteve.com/wp-content/uploads/2016/02/Steves-Footer-blank2.png); position: relative; top: 450px;">
        <br><br>
        <p style="color: white; text-align: center; padding-right: 45px"><strong>©</strong>Copyright 2019 Wolfpack TM - All rights Reserved.</p>
    </div>
    


    <script>
        function home() {
            window.location.assign('home.php');
        }
        function gameList()
        {
            window.location.assign('gameslist.php');
        }
        function gpuCompare()
        {
            window.location.assign('gpucompare.php');
        }
        function gotopage(x)
        {
            window.location.assign('gamepage.php?id=' + x);
        }
        function bigImg(x) {
            x.style.opacity = "0.4";
        }

        function normalImg(x) {
            x.style.opacity = "1";
        }
        function checking()
        {
            window.location.assign('submitpcinfo.php');
        }
    </script>

    </body>
    </html>
    <?php
}
?>

