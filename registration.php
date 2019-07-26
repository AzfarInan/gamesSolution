<?php
    session_start();
    
    $username = "";
    $password = "";
    $useremail = "";
    
    if (isset($_POST['uemail']) && isset($_POST['upass']) && isset($_POST['uname'])) {
        
        $username = $_POST['uname'];
        $useremail = $_POST['uemail'];
        $password = $_POST['upass'];
    }
    if (!empty($useremail) && !empty($password) && !empty($username)) {

        try {
            $con = new PDO('mysql:host=localhost;dbname=gamessolution', 'root', '');
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = "select * from users where name='$username' && email='$useremail' && pass='$password'";
            $pdostmt = $con->query($stmt);

            if ($pdostmt->rowCount() == 0) {
                try{
                    $crt = "INSERT INTO users (name, email, pass) VALUES ('$username', '$useremail', '$password');";
                    $con->exec($crt);
                } catch (PDOException $ex){
                    echo "<script>window.location.assign('register.php?status=existing');</script>";
                }
                echo "<script>window.alert('SUCCESSFULLY INSERTED!');</script>";
                $_SESSION['uemail'] = $useremail;
                echo "<script>window.location.assign('home.php')</script>";
            } else {
                echo "<script>window.location.assign('register.php?status=existing');</script>";
            }
        } catch (PDOException $ex) {
            echo "<script>window.location.assign('register.php?status=dberror');</script>";
        }
    } else {
    echo "<script>window.location.assign('register.php?status=invalid')</script>";
    }
    $con = null;
?>
