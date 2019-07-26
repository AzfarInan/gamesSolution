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
                overflow: hidden;
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
            .create:hover{
                cursor: pointer;

            }
        </style>
    </head>
    <body>
        <table style="width: 100%;  overflow-y: scroll">
            <tbody>
                <tr>
                    <td><img src="logo.png"></td>
                    <td><b style="font-size: 250%; color: #5e0101;">"Before playing, make sure you can run it!"</b></td>
                    <td></td>
                    <td><a href="login.php" class="login" id="login" style="text-decoration: none; color: #5e0101">LOGIN</a></td>
                </tr>
            </tbody>
        </table>

        <ul id="navigation_bar" class="navigation_bar" name="navigation_bar" style="z-index: +999">
            <li class="list1" style="padding: 25px" onclick="home()">Home</li>
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
        <form class="login" method="post" action="registration.php" style="position: relative; text-align: center; top:0px; font-size: 150%;">
            <h2 style="background-color: black; color: white; padding: 15px;">Sign Up</h2>
            <hr>
            <div style="background-color: black; color: white">
                <b style="margin-right: 45px;">Name:</b><input type="text" placeholder="Enter Name" id="name" name="uname" style="margin-top: 10px; margin-bottom: 10px; margin-right: 50px;padding: 10px;"><br/>
                <b style="margin-right: 45px;">Email:</b><input type="text" placeholder="Enter Email" id="email" name="uemail" style="margin-top: 0px; margin-bottom: 10px; margin-right: 50px;padding: 10px;"><br/>
                <b style="margin-right: 42px;">Password:</b><input type="password" placeholder="Enter Password" id="pass" name="upass" style="margin-top: 0px; margin-right: 80px;  padding: 10px; margin-bottom: 10px"><br/>
                <input class="create" type="submit" value="Create" style="margin-bottom: 15px; padding-left: 45px; padding-right: 45px; padding-top: 5px; padding-bottom: 5px; color: white; background-color: #5e0101; border-radius: 15px;  border-color: #a2c2f2">
            </div>
            <hr>
        </form>

        <?php
        $status = "";
        if (isset($_GET['status'])) {
            $status = $_GET['status'];
            if ($status == 'invalid') {
                ?>
                <script>window.alert('Invalid');</script>
                <?php
            } else if ($status == 'dberror') {
                ?>
                <script>window.alert('Database Connection Error');</script>
                <?php
            } else if ($status == 'existing') {
                ?>
                <script>window.alert('Data already exists!');</script>
                <?php
            }
        }
        ?>
        <script>
            function mypc(){
                window.alert('Log in to Continue.');
            }
            function gameList()
            {
                window.location.assign('gameslist.php');
            }
            function home()
            {
                window.location.assign('home.php');
            }
            function gpuCompare()
            {
                window.location.assign('gpucompare.php');
            }
        </script>
    </body>
</html>


