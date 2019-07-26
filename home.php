<?php
session_start();

if (isset($_SESSION['uemail'])) {

    try {

        $con = new PDO('mysql:host=localhost;dbname=gamessolution', 'root', '');
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = "select type from users where email='$_SESSION[uemail]'";
        $pdostmt = $con->query($stmt);
        if ($pdostmt->rowCount() == 1) {
            $table = $pdostmt->fetchAll(PDO::FETCH_NUM);
            foreach ($table as $row) {
                if ($row[0] == 'admin') {
                    echo "<script>window.location.assign('admin_page.php')</script>";
                }
            }
        } else {
            echo "<h1>USER</h1>";
        }
    } catch (PDOException $ex) {
        echo "USER";
    }

    $con = null;
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

                .login:hover{
                    cursor: pointer;
                    font-size: 150%;
                }
                .top-gpu-table{
                    border: 2px solid gray;
                    width: 480px;
                    border-collapse: collapse;
                }

                .top-gpu-table tr:nth-child(even)
                {
                    font-size: 130%;
                }
                .top-gpu-table tr:nth-child(odd)
                {
                    color: white;
                    background-color: gray;
                    font-size: 130%;
                }
                .top-cpu-table{
                    border: 2px solid gray;
                    border-collapse: collapse;
                    width: 480px;
                }

                .top-cpu-table tr:nth-child(even)
                {
                    color: white;
                    background-color: gray;
                    font-size: 130%;
                }
                .top-cpu-table tr:nth-child(odd)
                {
                    font-size: 130%;
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
        <li class="active" style="padding: 25px">Home</li>
        <li class="list1" style="padding: 25px" onclick="gameList()">Games List</li>
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
    <h2>Welcome to the guiding star in your world of Gaming.</h2>
    <hr>
    <h3 style="position: relative; max-width: 150px; text-align: center; top: 35px; left: 55px; z-index: +1; padding: 2px; background-color: white; color: darkred; border: 1px solid black">Popular Games</h3>
    <div class="popular-games" style="position: relative; left: 20px; border: 5px solid #5e0101; padding-top: 20px; padding-bottom: 20px; padding-right: 20px; height: 230px; width: 1270px; background-color: #292a2b">
        <?php
        try {

            $con = new PDO('mysql:host=localhost;dbname=gamessolution', 'root', '');
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = "select * from games where favorite='yes'";
            $pdostmt = $con->query($stmt);
            if ($pdostmt->rowCount() >= 1) {

                $stmt = "select piclink,games_id from games where favorite='yes' order by games_id asc limit 6";

                $pdostmt = $con->query($stmt);
                $table = $pdostmt->fetchAll(PDO::FETCH_NUM);

                foreach ($table as $row) {

                    echo "<img src='$row[0]' style='width: 195px; height: 232.14px; padding-left: 16px;' onmouseover='bigImg(this)' onmouseout='normalImg(this)' onclick='gotopage($row[1])'>";
                }
            } else {
                echo "<h1>NO POPULAR GAMES RIGHT NOW</h1>";
            }
        } catch (PDOException $ex) {
            echo "<script>window.location.assign('home.php?status=dberror');</script>";
        }

        $con = null;
        ?>
    </div>

    <span  style="display: inline-block; float: right; padding: 50px;">
        <h2 style="text-align: center">Top GPU of 2018</h2>
        <table class="top-gpu-table">
            <tbody>
                <?php
                try {
                    $con = new PDO('mysql:host=localhost;dbname=gamessolution', 'root', '');
                    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $stmt = "SELECT g_manufacturer,g_model FROM graphics ORDER BY g_id DESC LIMIT 5";
                    $pdostmt = $con->query($stmt);
                    if ($pdostmt->rowCount() >= 1) {

                        $table = $pdostmt->fetchAll(PDO::FETCH_NUM);

                        foreach ($table as $row) {
                            echo "<tr><td style='text-align: center;'>$row[0]</td><td>$row[1]</td></tr>";
                        }
                    } else {
                        echo "<h1>NO TOP GPU RIGHT NOW</h1>";
                    }
                } catch (PDOException $ex) {
                    echo "<script>window.location.assign('home.php?status=dberror');</script>";
                }

                $con = null;
                ?>
            </tbody>
        </table>

        <h2 style="text-align: center">Top CPU of 2018</h2>
        <table class="top-cpu-table">
            <tbody>
                <?php
                try {
                    $con = new PDO('mysql:host=localhost;dbname=gamessolution', 'root', '');
                    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $stmt = "SELECT p_manufacturer,p_model FROM processor ORDER BY p_id DESC LIMIT 5";
                    $pdostmt = $con->query($stmt);
                    if ($pdostmt->rowCount() >= 1) {

                        $table = $pdostmt->fetchAll(PDO::FETCH_NUM);

                        foreach ($table as $row) {
                            echo "<tr><td style='width: 250px; text-align: center'>$row[0]</td><td>$row[1]</td></tr>";
                        }
                    } else {
                        echo "<h1>NO TOP CPU RIGHT NOW</h1>";
                    }
                } catch (PDOException $ex) {
                    echo "<script>window.location.assign('home.php?status=dberror');</script>";
                }

                $con = null;
                ?>
            </tbody>
        </table>
    </span>
    <span style="display: inline-block; position: relative; left: 20px; top: 45px;">
        <iframe width="720" height="465" src="https://www.youtube.com/embed/JdR6bB943L4?autoplay=1"></iframe>
    </span>

    <h3 id="recent" style="position: relative; max-width: 150px; text-align: center; top: 35px; left: 55px; z-index: +1; padding: 2px; background-color: white; color: darkred; border: 1px solid black">Recently Viewed</h3>
    <div class="popular-games" id="recent" style="position: relative; left: 20px; border: 5px solid #5e0101; padding-top: 20px; padding-bottom: 20px; padding-right: 20px; height: 230px; width: 1270px; background-color: #292a2b">
        <?php
        try {

            $con = new PDO('mysql:host=localhost;dbname=gamessolution', 'root', '');
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = "select distinct games_id from recents where email='$_SESSION[uemail]' order by recents_id desc limit 6";
            $pdostmt = $con->query($stmt);
            $table = $pdostmt->fetchAll(PDO::FETCH_NUM);

            if ($pdostmt->rowCount() >= 1) {
                foreach ($table as $row) {

                    $stmt1 = "select piclink,games_id from games where games_id='$row[0]'";


                    $pdostmt1 = $con->query($stmt1);
                    $table1 = $pdostmt1->fetchAll(PDO::FETCH_NUM);

                    foreach ($table1 as $row1) {
                        echo "<img src='$row1[0]' style='width: 195px; height: 232.14px; padding-left: 16px;' onmouseover='bigImg(this)' onmouseout='normalImg(this)' onclick='gotopage($row1[1])'>";
                    }
                }
            } else {
                echo "";
            }
        } catch (PDOException $ex) {
            echo "<script>window.location.assign('home.php?status=dberror');</script>";
        }

        $con = null;
        ?>

        <div class="footer" style="display: block; height: 100px; width: 104%; background-image: url(https://www.allmightysteve.com/wp-content/uploads/2016/02/Steves-Footer-blank2.png); position: absolute; left: -32px; top: 265px;">
            <br><br>
            <p style="color: white; text-align: center; padding-right: 45px"><strong>©</strong>Copyright 2019 Wolfpack TM - All rights Reserved.</p>
        </div>


        <script>
            function mypc() {
                window.location.assign('mypcdetails.php');
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

                .login:hover{
                    cursor: pointer;
                    font-size: 150%;
                }
                .top-gpu-table{
                    border: 2px solid gray;
                    width: 480px;
                    border-collapse: collapse;
                }

                .top-gpu-table tr:nth-child(even)
                {
                    font-size: 130%;
                }
                .top-gpu-table tr:nth-child(odd)
                {
                    color: white;
                    background-color: gray;
                    font-size: 130%;
                }
                .top-cpu-table{
                    border: 2px solid gray;
                    border-collapse: collapse;
                    width: 480px;
                }

                .top-cpu-table tr:nth-child(even)
                {
                    color: white;
                    background-color: gray;
                    font-size: 130%;
                }
                .top-cpu-table tr:nth-child(odd)
                {
                    font-size: 130%;
                }

            </style>
        </head>
        <body>
            <table style="width: 100%;  overflow-y: scroll">
                <tbody>
                    <tr>
                        <td><img src="logo.png"></td>
                        <td><b style="font-size: 250%; color: #5e0101;">"Before playing, make sure you can run it!"</b></td>
                        <td><a href="login.php" class="login" id="login" style="text-decoration: none; color: #5e0101">LOGIN</a></td>
                        <td></td>
                        <td><a href="register.php" class="login" id="register" style="text-decoration: none; color: #5e0101">REGISTER</a></td>
                    </tr>
                </tbody>
            </table>

            <ul id="navigation_bar" class="navigation_bar" name="navigation_bar" style="z-index: +999">
                <li class="active" style="padding: 25px">Home</li>
                <li class="list1" style="padding: 25px" onclick="gameList()">Games List</li>
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
            <h2>Welcome to the guiding star in your world of Gaming.</h2>
            <hr>
            <h3 style="position: relative; max-width: 150px; text-align: center; top: 35px; left: 55px; z-index: +1; padding: 2px; background-color: white; color: darkred; border: 1px solid black">Popular Games</h3>
            <div class="popular-games" style="position: relative; left: 20px; border: 5px solid #5e0101; padding-top: 20px; padding-bottom: 20px; padding-right: 20px; height: 230px; width: 1270px; background-color: #292a2b">
                <?php
                try {

                    $con = new PDO('mysql:host=localhost;dbname=gamessolution', 'root', '');
                    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $stmt = "select * from games where favorite='yes'";
                    $pdostmt = $con->query($stmt);
                    if ($pdostmt->rowCount() >= 1) {

                        $stmt = "select piclink,games_id from games where favorite='yes' order by games_id asc limit 6";

                        $pdostmt = $con->query($stmt);
                        $table = $pdostmt->fetchAll(PDO::FETCH_NUM);

                        foreach ($table as $row) {

                            echo "<img src='$row[0]' style='width: 195px; height: 232.14px; padding-left: 16px;' onmouseover='bigImg(this)' onmouseout='normalImg(this)' onclick='gotopage($row[1])'>";
                        }
                    } else {
                        echo "<h1>NO POPULAR GAMES RIGHT NOW</h1>";
                    }
                } catch (PDOException $ex) {
                    echo "<script>window.location.assign('home.php?status=dberror');</script>";
                }

                $con = null;
                ?>
            </div>

            <span  style="display: inline-block; float: right; padding: 50px;">
                <h2 style="text-align: center">Top GPU of 2018</h2>
                <table class="top-gpu-table">
                    <tbody>
                        <?php
                        try {
                            $con = new PDO('mysql:host=localhost;dbname=gamessolution', 'root', '');
                            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            $stmt = "SELECT g_manufacturer,g_model FROM graphics ORDER BY g_id DESC LIMIT 5";
                            $pdostmt = $con->query($stmt);
                            if ($pdostmt->rowCount() >= 1) {

                                $table = $pdostmt->fetchAll(PDO::FETCH_NUM);

                                foreach ($table as $row) {
                                    echo "<tr><td style='text-align: center;'>$row[0]</td><td>$row[1]</td></tr>";
                                }
                            } else {
                                echo "<h1>NO TOP GPU RIGHT NOW</h1>";
                            }
                        } catch (PDOException $ex) {
                            echo "<script>window.location.assign('home.php?status=dberror');</script>";
                        }

                        $con = null;
                        ?>
                    </tbody>
                </table>

                <h2 style="text-align: center">Top CPU of 2018</h2>
                <table class="top-cpu-table">
                    <tbody>
                        <?php
                        try {
                            $con = new PDO('mysql:host=localhost;dbname=gamessolution', 'root', '');
                            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            $stmt = "SELECT p_manufacturer,p_model FROM processor ORDER BY p_id DESC LIMIT 5";
                            $pdostmt = $con->query($stmt);
                            if ($pdostmt->rowCount() >= 1) {

                                $table = $pdostmt->fetchAll(PDO::FETCH_NUM);

                                foreach ($table as $row) {
                                    echo "<tr><td style='width: 250px; text-align: center'>$row[0]</td><td>$row[1]</td></tr>";
                                }
                            } else {
                                echo "<h1>NO TOP CPU RIGHT NOW</h1>";
                            }
                        } catch (PDOException $ex) {
                            echo "<script>window.location.assign('home.php?status=dberror');</script>";
                        }

                        $con = null;
                        ?>
                    </tbody>
                </table>
            </span>
            <span style="display: inline-block; position: relative; left: 20px; top: 45px;">
                <iframe width="720" height="465" src="https://www.youtube.com/embed/JdR6bB943L4?autoplay=1"></iframe>
            </span>

            <div class="footer" style="display: inline-block; height: 100px; width: 100%; background-image: url(https://www.allmightysteve.com/wp-content/uploads/2016/02/Steves-Footer-blank2.png); position: relative; top: 45px;">
                <br><br>
                <p style="color: white; text-align: center; padding-right: 45px"><strong>©</strong>Copyright 2019 Wolfpack TM - All rights Reserved.</p>
            </div>


            <script>

                function mypc() {
                    window.alert('Log in to Continue.');
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
            </script>

        </body>
    </html>
    <?php
}
?>
