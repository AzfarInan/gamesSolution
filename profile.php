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
            <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

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
                .image-buttons{
                    background-color: #5e0101;
                }
                .image-buttons:hover{
                    background-color: black;
                    cursor: pointer;
                }
            </style>
        </head>
        <body>
            <table style="width: 100%; border-collapse: collapse; overflow-y: scroll">
                <tbody>
                    <tr>
                        <td><img src="logo.png"></td>
                        <td><b style="font-size: 250%; color: #5e0101;">"Before playing, make sure you can run it!"</b></td>
                        <td><a href="logout.php" class="login" id="register" style="text-decoration: none; color: #5e0101">Log Out</a></td>
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
            <div class="image" style="display: inline-block; position: relative; left: 250px;">
                <img id="profile-image" src="<?php
                try {

                    $con = new PDO('mysql:host=localhost;dbname=gamessolution', 'root', '');
                    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $stmt = "select picture from users where email='$_SESSION[uemail]'";
                    $pdostmt = $con->query($stmt);
                    if ($pdostmt->rowCount() == 1) {
                        $table = $pdostmt->fetchAll(PDO::FETCH_NUM);
                        foreach ($table as $row) {
                            if ($row[0] != '')
                                echo "$row[0]";
                            else {
                                echo "https://dcassetcdn.com/common/images/v3/no-profile-pic-tiny.png";
                            }
                        }
                    }
                    else {
                        echo "<h1>USER</h1>";
                    }
                } catch (PDOException $ex) {
                    echo "USER";
                }

                $con = null;
                ?>" style="width: 300px; height: 300px; border-radius: 50%;"><br/>
                <button  onclick="updateImage()" class="image-buttons" id="updateButton" style="color: white; position: absolute; left: 100px; top: 320px; padding: 10px; padding-left: 25px; padding-right: 25px;">Update</button>
                </div>


            <div class="info" style="display: inline-block; position: relative; left: 500px;">
                <form method="post" action="update.php">
                    <table style="position: relative; top: -100px; left: -210px; font-size: 20px;">
                        <tbody>
                            <tr>
                                <td><strong>Name:</strong></td>
                                <td>
                                    <?php
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
                            </tr>
                            <tr>
                                <td><strong>Email:</strong></td>
                                <td><?php echo $_SESSION['uemail']; ?></td> 
                            </tr>
                            <tr>
                                <td><strong>Password:</strong></td>
                                <td>
                                    <?php
                                    try {

                                        $con = new PDO('mysql:host=localhost;dbname=gamessolution', 'root', '');
                                        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                        $stmt = "select pass from users where email='$_SESSION[uemail]'";
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
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
            <div class="piclink" id="pic-link" style="position: absolute; top: 350px; left: 220px; border: 6px solid #5e0101; border-radius: 15px; background-color: black; padding-top: 50px; padding-bottom: 50px; width: 420px; color: white; display: none">
                <form action="update.php" method="post">
                    <span style="padding: 80px;">Picture Link:<input type="text" name="picture" autofocus></span>
                    <span style="padding-left: 200px; margin-top: 10px"><input type="submit" value="Submit" style="position: absolute; top: 80px;"></span>
                </form>
            </div>
            <i class="material-icons" id="cross-button" onclick="hideResult()" style="font-size:48px; color:gray; cursor: pointer; position: absolute; top: 345px; left: 608px; z-index: +10; display: none">cancel</i>

            <div class="footer" style="display: inline-block; height: 100px; width: 100%; background-image: url(https://www.allmightysteve.com/wp-content/uploads/2016/02/Steves-Footer-blank2.png); position: relative; top: 45px;">
                <br><br>
                <p style="color: white; text-align: center; padding-right: 45px"><strong>©</strong>Copyright 2019 Wolfpack TM - All rights Reserved.</p>
            </div>


            <script>
                function updateImage() {
                    var x;
                    var y;
                    x = document.getElementById('pic-link').style.display = "inline";
                    y = document.getElementById('cross-button').style.display = "inline";
                }
                function hideResult() {
                    var x;
                    var y;
                    x = document.getElementById('pic-link').style.display = "none";
                    y = document.getElementById('cross-button').style.display = "none";
                }
                function home() {
                    window.location.assign('home.php');
                }
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
            </script>

        </body>
    </html>

    <?php
}
?>