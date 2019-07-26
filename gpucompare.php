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
            .games-list tr td{
                text-align: center;
            }
            .games-list tr:nth-child(even)
            {
                background-color: gray;
            }
            .games-list tr td{
                padding: 10px;
                font-size: 110%;
            }
            .gpu-list-1 tr td{
                text-align: center;
                padding: 10px;
                font-size: 110%;
            }
            .gpu-list-1 tr:nth-child(even)
            {
                background-color: gray;
            }
            .gpu-list-2 tr td{
                text-align: center;
                padding: 10px;
                font-size: 110%;
            }
            .gpu-list-2 tr:nth-child(even)
            {
                background-color: gray;
            }
        </style>
    <body>
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

        <ul id="navigation_bar" class="navigation_bar" name="navigation_bar" style="z-index: +999">
            <li class="list1" style="padding: 25px" onclick="home()">Home</li>
            <li class="list1" style="padding: 25px" onclick="gameList()">Games List</li>
            <li class="list1" style="padding: 25px" onclick="mypc()">My Computer Details</li>
            <li class="active" style="padding: 25px">GPU Compare</li>
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
        <div style="display: inline-block; position: relative; left: 80px; font-size: 150%">
            <strong>Graphics Card 1:<br>
                AMD ATI RADEON</strong> <select id="gpu1" onchange="gpuOne()" style="padding: 10px; padding-left: 20px;">
                    <option disabled selected value></option>
                <?php
                try {
                    $con = new PDO("mysql:host=localhost; dbname=gamessolution", 'root', '');

                    $stmt = "select g_model from graphics";
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
        </div>
        <div style="display: inline-block; position: absolute;  right: 250px; font-size: 150%">
            <strong>Graphics Card 2:<br>
                AMD ATI RADEON</strong> <select id="gpu2" onchange="gpuTwo()" style="padding: 10px; padding-left: 20px;">
                    <option disabled selected value></option>
                <?php
                try {
                    $con = new PDO("mysql:host=localhost; dbname=gamessolution", 'root', '');

                    $stmt = "select g_model from graphics";
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
        </div>
        <script>
            function mypc(){
               window.location.assign('mypcdetails.php');
            }
            function gpuOne()
            {
                
                var name = document.getElementById('gpu1').value;
                document.getElementById('table-header-1').innerHTML = name;
                
                var request = new XMLHttpRequest();
                
                request.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById('table-body-1').innerHTML = request.responseText;
                    }
                }
                request.open("GET", "internal_compare.php?g_model=" + name, true);
                request.send();
            }
            function gpuTwo()
            {
                var name = document.getElementById('gpu2').value;
                document.getElementById('table-header-2').innerHTML = name;
                
                var request = new XMLHttpRequest();
                
                request.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById('table-body-2').innerHTML = request.responseText;
                    }
                }
                request.open("GET", "internal_compare.php?g_model=" + name, true);
                request.send();
            }
        </script>
        <div>
            <table class="games-list" style="width: 400px; position: relative; top: 50px; left: 90px; border: 1px solid gray; border-collapse: collapse">
                <thead>
                    <tr style="background-color: black; color: white">
                        <th><h2>Games</h2></th>

                    </tr>
                </thead>
                <tbody id="table-body">
                    <?php
                    try {
                        $con = new PDO("mysql:host=localhost;dbname=gamessolution", "root", "");
                        $stmt = "select name from games";

                        $pdostmt = $con->query($stmt);
                        $table = $pdostmt->fetchAll(PDO::FETCH_NUM);

                        foreach ($table as $row) {
                            echo "<tr><td>$row[0]</td></tr>";
                        }
                    } catch (PDOException $ex) {
                        echo "NOTHING";
                    }
                    ?>
                </tbody>
            </table>
            <table class="gpu-list-1" style="width: 300px; position: absolute; top: 377px; left: 520px; border: 1px solid gray; border-collapse: collapse">
                <thead>
                    <tr style="background-color: black; color: white">
                        <th><h2 id="table-header-1">GPU NAME</h2></th>
                    </tr>
                </thead>
                <tbody id="table-body-1">
                    
                </tbody>
            </table>
            <table class="gpu-list-2" style="width: 300px; position: absolute; top: 377px; left: 842px; border: 1px solid gray; border-collapse: collapse">
                <thead>
                    <tr style="background-color: black; color: white">
                        <th><h2 id="table-header-2">GPU NAME</h2></th>
                    </tr>
                </thead>
                <tbody id="table-body-2">
                    
                </tbody>
            </table>
        </div>
        <div class="footer" style="display: inline-block; height: 100px; width: 100%; background-image: url(https://www.allmightysteve.com/wp-content/uploads/2016/02/Steves-Footer-blank2.png); position: relative; top: 45px;">
            <br><br>
            <p style="color: white; text-align: center; padding-right: 45px"><strong>©</strong>Copyright 2019 Wolfpack TM - All rights Reserved.</p>
        </div>
        <script>
            function home()
            {
                window.location.assign('home.php');
            }
            function gameList()
            {
                window.location.assign('gameslist.php');
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
            .games-list tr td{
                text-align: center;
            }
            .games-list tr:nth-child(even)
            {
                background-color: gray;
            }
            .games-list tr td{
                padding: 10px;
                font-size: 110%;
            }
            .gpu-list-1 tr td{
                text-align: center;
                padding: 10px;
                font-size: 110%;
            }
            .gpu-list-1 tr:nth-child(even)
            {
                background-color: gray;
            }
            .gpu-list-2 tr td{
                text-align: center;
                padding: 10px;
                font-size: 110%;
            }
            .gpu-list-2 tr:nth-child(even)
            {
                background-color: gray;
            }
        </style>
    <body>
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

        <ul id="navigation_bar" class="navigation_bar" name="navigation_bar" style="z-index: +999">
            <li class="list1" style="padding: 25px" onclick="home()">Home</li>
            <li class="list1" style="padding: 25px" onclick="gameList()">Games List</li>
            <li class="list1" style="padding: 25px" onclick="mypc()">My Computer Details</li>
            <li class="active" style="padding: 25px">GPU Compare</li>
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
        <div style="display: inline-block; position: relative; left: 80px; font-size: 150%">
            <strong>Graphics Card 1:<br>
                AMD ATI RADEON</strong> <select id="gpu1" onchange="gpuOne()" style="padding: 10px; padding-left: 20px;">
                    <option disabled selected value></option>
                <?php
                try {
                    $con = new PDO("mysql:host=localhost; dbname=gamessolution", 'root', '');

                    $stmt = "select g_model from graphics";
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
        </div>
        <div style="display: inline-block; position: absolute;  right: 250px; font-size: 150%">
            <strong>Graphics Card 2:<br>
                AMD ATI RADEON</strong> <select id="gpu2" onchange="gpuTwo()" style="padding: 10px; padding-left: 20px;">
                    <option disabled selected value></option>
                <?php
                try {
                    $con = new PDO("mysql:host=localhost; dbname=gamessolution", 'root', '');

                    $stmt = "select g_model from graphics";
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
        </div>
        <script>
            function mypc(){
                window.alert('Log in to Continue.');
            }
            function gpuOne()
            {
                
                var name = document.getElementById('gpu1').value;
                document.getElementById('table-header-1').innerHTML = name;
                
                var request = new XMLHttpRequest();
                
                request.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById('table-body-1').innerHTML = request.responseText;
                    }
                }
                request.open("GET", "internal_compare.php?g_model=" + name, true);
                request.send();
            }
            function gpuTwo()
            {
                var name = document.getElementById('gpu2').value;
                document.getElementById('table-header-2').innerHTML = name;
                
                var request = new XMLHttpRequest();
                
                request.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById('table-body-2').innerHTML = request.responseText;
                    }
                }
                request.open("GET", "internal_compare.php?g_model=" + name, true);
                request.send();
            }
        </script>
        <div>
            <table class="games-list" style="width: 400px; position: relative; top: 50px; left: 90px; border: 1px solid gray; border-collapse: collapse">
                <thead>
                    <tr style="background-color: black; color: white">
                        <th><h2>Games</h2></th>

                    </tr>
                </thead>
                <tbody id="table-body">
                    <?php
                    try {
                        $con = new PDO("mysql:host=localhost;dbname=gamessolution", "root", "");
                        $stmt = "select name from games";

                        $pdostmt = $con->query($stmt);
                        $table = $pdostmt->fetchAll(PDO::FETCH_NUM);

                        foreach ($table as $row) {
                            echo "<tr><td>$row[0]</td></tr>";
                        }
                    } catch (PDOException $ex) {
                        echo "NOTHING";
                    }
                    ?>
                </tbody>
            </table>
            <table class="gpu-list-1" style="width: 300px; position: absolute; top: 377px; left: 520px; border: 1px solid gray; border-collapse: collapse">
                <thead>
                    <tr style="background-color: black; color: white">
                        <th><h2 id="table-header-1">GPU NAME</h2></th>
                    </tr>
                </thead>
                <tbody id="table-body-1">
                    
                </tbody>
            </table>
            <table class="gpu-list-2" style="width: 300px; position: absolute; top: 377px; left: 842px; border: 1px solid gray; border-collapse: collapse">
                <thead>
                    <tr style="background-color: black; color: white">
                        <th><h2 id="table-header-2">GPU NAME</h2></th>
                    </tr>
                </thead>
                <tbody id="table-body-2">
                    
                </tbody>
            </table>
        </div>
        <div class="footer" style="display: inline-block; height: 100px; width: 100%; background-image: url(https://www.allmightysteve.com/wp-content/uploads/2016/02/Steves-Footer-blank2.png); position: relative; top: 45px;">
            <br><br>
            <p style="color: white; text-align: center; padding-right: 45px"><strong>©</strong>Copyright 2019 Wolfpack TM - All rights Reserved.</p>
        </div>
        <script>
            function home()
            {
                window.location.assign('home.php');
            }
            function gameList()
            {
                window.location.assign('gameslist.php');
            }
        </script>
    </body>    
</html>
    <?php
}
?>