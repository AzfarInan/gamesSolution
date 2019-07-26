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
        </style>
    </head>
    <body>
        <table style="width: 100%;  overflow-y: scroll">
            <tbody>
                <tr>
                    <td><img src="logo.png"></td>
                    <td><b style="font-size: 250%; color: #5e0101;">"Before playing, make sure you can run it!"</b></td>
                    <td></td>
                    <td><a href="register.php" class="login" id="register" style="text-decoration: none; color: #5e0101">REGISTER</a></td>
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

        <form class="login" method="post" action="validation.php" style="position: relative; width: auto; text-align: center; top: -35px; font-size: 150%;">
            <h2 style="background-color: black; color: white; padding: 10px;">Log In</h2>
            <hr>
            <div style="background-color: black; color: white">
                <b style="margin-right: 45px;">Email:</b><input type="text" placeholder="Enter Email" id="uemail" name="uemail" style="margin-top: 50px; margin-bottom: 50px; margin-right: 50px;padding: 10px;"><br/>
                <b style="margin-right: 42px;">Password:</b><input type="password" placeholder="Enter Password" id="upass" name="upass" style="margin-top: 0px; margin-right: 80px;  padding: 10px; margin-bottom: 30px"><br/>
                <input type="submit" class="loginbutton" value="Login" style="background-color: #5e0101; margin-bottom: 15px; padding-left: 45px; padding-right: 45px; padding-top: 5px; padding-bottom: 5px; color: white; border-radius: 25px; border-color: whitesmoke"><br/>
            </div>
            <hr>
        </form>


        <?php
        $status = "";
        if (isset($_GET['status'])) {
            $status = $_GET['status'];
            if ($status == 'invalid') {
                ?>
                <script>window.alert('invalid username or password');</script>
                <?php
            } else if ($status == 'dberror') {
                ?>
                <script>window.alert('Database Connection Error');</script>
                <?php
            } else if ($status == 'logout') {
                ?>
                <script>window.alert('Successfully logged out.');</script>
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




