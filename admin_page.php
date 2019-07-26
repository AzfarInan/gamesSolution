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
                #games-table tr:nth-child(even){
                    background-color: black;
                    color: white;
                }
                #favorite-games tr:nth-child(even){
                    background-color: black;
                    color: white;
                }
                #list-of-CPU tr:nth-child(even)
                {
                    background-color: black;
                    color: white;
                }
                #list-of-GPU tr:nth-child(even)
                {
                    background-color: black;
                    color: white;
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
                                <option>Log Out</option>
                            </select>
                        </td>
                <script>
                    function gotoPage() {

                        var p = document.getElementById('option').value;
                        if (p == 'Log Out') {
                            var ans = window.confirm('Sure you want to Log Out?');
                            if (ans == true)
                                window.location.assign('logout.php');
                            else {
                                window.location.assign('admin_page.php');
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
            </tr>
        </tbody>
    </table>
    <hr>

    <div id="games" class="games" style="display: inline-block; height: 250px; width: 350px; overflow-y: auto;">
        <table id="games-table">
            <caption>List of Games</caption>
            <tbody>
                <tr>
                    <th>Game</th>
                    <th>Delete</th>
                </tr>
                <?php
                try {
                    $con = new PDO("mysql:host=localhost;dbname=gamessolution", "root", "");
                    $stmt = "select * from games";
                    $pdostmt = $con->query($stmt);
                    $table = $pdostmt->fetchAll(PDO::FETCH_NUM);
                    foreach ($table as $row) {
                        echo "<tr><td>$row[1]</td><td><button onclick='deleteME($row[0])'>Delete</button></td></tr>";
                    }
                } catch (PDOException $ex) {
                    echo "NOTHING";
                }
                ?>
            </tbody>
            <script>
                function deleteME(x)
                {
                    var y = window.confirm('Are you sure?');
                    if (y == true)
                        window.location.assign('delete.php?id=' + x);
                }
            </script>
        </table>
    </div>
    <button id="punyButton" style="display: block; margin-left: 115px; margin-top: 25px;" onclick="openAdd()">Add games</button>
    <script>
        function openAdd() {
            document.getElementById('games-table').style.display = "none";
            document.getElementById('punyButton').style.display = "none";
            document.getElementById('games-add').style.display = "inline";
        }
    </script>
    <div id="games-add"  style="display: none; position: absolute; left:20px; height: 350px; width: 380px; overflow-y: auto;">

        <form method="get" action="insert_games.php"> 
            <table>
                <caption>Add Games</caption>
                <tr>
                    <td>Name:</td>
                    <td><input name="name" type="text"></td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td><input name="type" type="text"></td>
                </tr>
                <tr>
                    <td>Picture Link:</td>
                    <td><input name="piclink" type="text"></td>
                </tr>
                <tr>
                    <td>Processor Manufacturer:</td>
                    <td><input type="text" value="Intel" readOnly></td>
                </tr>
                <tr>
                    <td>Processor Model:</td>
                    <td>
                        <select id="cpumod" onchange="changeCPUMOD()" style="padding: 10px">
                            <option></option>
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
                        <script>
                            function changeCPUMOD()
                            {
                                var x = document.getElementById('cpumod').value;
                                var request = new XMLHttpRequest();
                                request.onreadystatechange = function () {
                                    if (this.readyState == 4 && this.status == 200) {
                                        document.getElementById('user-cpu').value = request.responseText;
                                    }
                                }

                                request.open("GET", "internal_cpu.php?user-cpu=" + x, true);
                                request.send();
                            }
                        </script>
                    </td>
                    <td style="display: none">
                        <input name="p_id" id="user-cpu" type="text">
                    </td>
                </tr>
                <tr>
                    <td>Graphics Manufacturer:</td>
                    <td><input type="text" value="AMD Radeon" readOnly></td>
                </tr>
                <tr>
                    <td>Graphics Model:</td>
                    <td>
                        <select id="gpumod" onchange="changeGPUMOD()" style="padding: 10px">
                            <option></option>
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
                        <script>
                            function changeGPUMOD()
                            {
                                var x = document.getElementById('gpumod').value;
                                var request = new XMLHttpRequest();
                                request.onreadystatechange = function () {
                                    if (this.readyState == 4 && this.status == 200) {
                                        document.getElementById('user-gpu').value = request.responseText;
                                    }
                                }

                                request.open("GET", "internal_gpu.php?user-gpu=" + x, true);
                                request.send();
                            }
                        </script>
                    </td>
                    <td style="display: none">
                        <input name="g_id" id="user-gpu" type="text">
                    </td>
                </tr>
                <tr>
                    <td>Ram:</td>
                    <td>
                        <select id="mem" onchange="changeRAM()" style="padding: 10px">
                            <option></option>
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
                        <script>
                            function changeRAM()
                            {
                                var x = document.getElementById('mem').value;
                                var request = new XMLHttpRequest();
                                request.onreadystatechange = function () {
                                    if (this.readyState == 4 && this.status == 200) {
                                        document.getElementById('user-ram').value = request.responseText;
                                    }
                                }

                                request.open("GET", "internal_ram.php?user-ram=" + x, true);
                                request.send();
                            }
                        </script>
                    </td>
                    <td style="display: none">
                        <input name="r_id" id="user-ram" type="text">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit"  style="margin-left: 124px; margin-top: 25px; padding: 10px;">
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <div id="favorite-games" style="display: inline-block; position: absolute; top: 105px; left: 410px; height: 250px; width: 380px; overflow-y: auto;">
        <table>
            <caption>Favorite Games</caption>
            <tr>
                <th>Games</th>
                <th>Remove</th>
            </tr>
            <?php
            try {
                $con = new PDO("mysql:host=localhost;dbname=gamessolution", "root", "");
                $stmt = "select * from games where favorite = 'yes'";
                $pdostmt = $con->query($stmt);
                $table = $pdostmt->fetchAll(PDO::FETCH_NUM);
                foreach ($table as $row) {
                    echo "<tr><td>$row[1]</td><td><button onclick='removeME($row[0])'>Remove</button></td></tr>";
                }
            } catch (PDOException $ex) {
                echo "NOTHING";
            }
            ?>
            <tr>
                <td colspan="2" style="text-align: center"><strong>Top 6 will be visible<strong></td>
                            </tr>
                            </tbody>
                            <script>
                                function removeME(x)
                                {
                                    var y = window.confirm('Are you sure?');
                                    if (y == true) {
                                        window.location.assign('removeFavorite.php?id=' + x);
                                    }
                                }
                            </script>
                            </table>
                            </div>
                            <button id="tinyButton" style="display: inline-block; position: absolute; top:360px; left:380px;  margin-left: 115px; margin-top: 25px;" onclick="addfavorite()">Add Favorite</button>
                            <div id="favorite-games-list" style="display: none; position: absolute; top: 105px; left: 450px; height: 250px; width: 350px; overflow-y: auto;">
                                <table>
                                    <caption>Add Favorite Games</caption>
                                    <tr>
                                        <th>Games</th>
                                        <th>Add</th>
                                    </tr>
                                    <?php
                                    try {
                                        $con = new PDO("mysql:host=localhost;dbname=gamessolution", "root", "");
                                        $stmt = "select * from games where favorite != 'yes'";
                                        $pdostmt = $con->query($stmt);
                                        $table = $pdostmt->fetchAll(PDO::FETCH_NUM);
                                        foreach ($table as $row) {
                                            echo "<tr><td>$row[1]</td><td><button onclick='addME($row[0])'>Add</button></td></tr>";
                                        }
                                    } catch (PDOException $ex) {
                                        echo "NOTHING";
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                            <script>
                                function addME(x)
                                {
                                    var y = window.confirm('Are you sure?');
                                    if (y == true) {
                                        window.location.assign('addFavorite.php?id=' + x);
                                    }
                                }

                                function addfavorite() {
                                    document.getElementById('favorite-games').style.display = "none";
                                    document.getElementById('tinyButton').style.display = "none";
                                    document.getElementById('favorite-games-list').style.display = "inline";
                                }
                            </script>
                            <div id="list-of-CPU" style="display: inline-block; height: 250px; width: 220px; overflow-y: auto; position: absolute; top: 105px; left: 750px;">
                                <table>
                                    <caption>List of CPU</caption>
                                    <tbody>
                                        <tr>
                                            <th>CPU Model</th>
                                            <th>Delete</th>
                                        </tr>
                                        <?php
                                        try {
                                            $con = new PDO("mysql:host=localhost;dbname=gamessolution", "root", "");
                                            $stmt = "select * from processor";
                                            $pdostmt = $con->query($stmt);
                                            $table = $pdostmt->fetchAll(PDO::FETCH_NUM);
                                            foreach ($table as $row) {
                                                echo "<tr><td>$row[2]</td><td><button onclick='deleteCPU($row[0])'>Delete</button></td></tr>";
                                            }
                                        } catch (PDOException $ex) {
                                            echo "NOTHING";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <script>
                                    function deleteCPU(x) {
                                        var y = window.confirm('Are you sure?');
                                        if (y == true) {
                                            window.location.assign('deleteCPU.php?id=' + x);
                                        }
                                    }
                                </script>
                            </div>
                            <button id="anothertinyButton" style="display: inline-block; position: absolute; top:360px; left:700px;  margin-left: 115px; margin-top: 25px;" onclick="addCPU()">Add CPU</button>
                            <script>
                                function addCPU() {
                                    document.getElementById('list-of-CPU').style.display = "none";
                                    document.getElementById('anothertinyButton').style.display = "none";
                                    document.getElementById('add-cpu-form').style.display = "inline";
                                }
                            </script>
                            <div id="add-cpu-form" style="display: none; height: 250px; width: 250px; overflow-y: auto; position: absolute; top: 105px; left: 750px;">
                                <table>
                                    <form action="addCpu.php" method="get">
                                        <caption>ADD CPU</caption>
                                        <tbody>
                                            <tr>
                                                <td>CPU Manufacturer:</td>
                                                <td><input name="p_manufacturer" type="text" value="Intel" readOnly></td>
                                            </tr>
                                            <tr>
                                                <td>CPU Model</td>
                                                <td><input name="p_model" type="text"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><input type="submit"  style="margin-left: 150px; margin-top: 15px;"></td>
                                            </tr>
                                        </tbody>
                                    </form>
                                </table>
                            </div>

                            <div id="list-of-GPU" style="display: inline-block; height: 250px; width: 220px; overflow-y: auto; position: absolute; top: 105px; left: 1100px;">
                                <table>
                                    <caption>List of GPU</caption>
                                    <tbody>
                                        <tr>
                                            <th>GPU Model</th>
                                            <th>Delete</th>
                                        </tr>
                                        <?php
                                        try {
                                            $con = new PDO("mysql:host=localhost;dbname=gamessolution", "root", "");
                                            $stmt = "select * from graphics";
                                            $pdostmt = $con->query($stmt);
                                            $table = $pdostmt->fetchAll(PDO::FETCH_NUM);
                                            foreach ($table as $row) {
                                                echo "<tr><td>$row[2]</td><td><button onclick='deleteGPU($row[0])'>Delete</button></td></tr>";
                                            }
                                        } catch (PDOException $ex) {
                                            echo "NOTHING";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <script>
                                    function deleteGPU(x) {
                                        var y = window.confirm('Are you sure?');
                                        if (y == true) {
                                            window.location.assign('deleteGPU.php?id=' + x);
                                        }
                                    }
                                </script>
                            </div>
                            <button id="yetanothertinyButton" style="display: inline-block; position: absolute; top:360px; left:1000px;  margin-left: 115px; margin-top: 25px;" onclick="addGPU()">Add GPU</button>
                            <script>
                                function addGPU() {
                                    document.getElementById('list-of-GPU').style.display = "none";
                                    document.getElementById('yetanothertinyButton').style.display = "none";
                                    document.getElementById('add-gpu-form').style.display = "inline";
                                }
                            </script>
                            <div id="add-gpu-form" style="display: none; height: 250px; width: 350px; overflow-y: auto; position: absolute; top: 105px; left: 1000px;">
                                <table>
                                    <form action="addGpu.php" method="get">
                                        <caption>ADD GPU</caption>
                                        <tbody>
                                            <tr>
                                                <td>GPU Manufacturer:</td>
                                                <td><input name="g_manufacturer" type="text" value="AMD Radeon" readOnly></td>
                                            </tr>
                                            <tr>
                                                <td>CPU Model</td>
                                                <td><input name="g_model" type="text"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><input type="submit"  style="margin-left: 150px; margin-top: 15px;"></td>
                                            </tr>
                                        </tbody>
                                    </form>
                                </table>
                            </div>
                            <div class="footer" style="display: block; height: 100px; width: 100%; background-image: url(https://www.allmightysteve.com/wp-content/uploads/2016/02/Steves-Footer-blank2.png); position: absolute; left: 0px; top: 557px;">
                                <br/>
                                <br/>
                                <p style="color: white; text-align: center; padding-right: 45px"><strong>©</strong>Copyright 2019 Wolfpack TM - All rights Reserved.</p>
                            </div>


                            </body>
                            </html>
                            <?php
                        }
                        else
                            echo "<script>window.location.assign('login.php');</script>";
                        ?>