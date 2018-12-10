<?php
include '../config/koneksi.php';
session_start();
$error = '';

if(!empty($_POST["username"]) || !empty($_POST["password"])) {
    $username = $_POST["username"];
    $password = md5($_POST["password"]);

    # Write MySql Query
    $query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    # Get the query result
    $result = mysqli_query($con, $query);

    if(mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $level = $row["level"];
        $id = $row["id_user"];

        if($level == 'admin') {
            $_SESSION["username"] = $username;
            $_SESSION["level"] = $level;
            $_SESSION["id"]=$id;
            header("Location: ../content.php?module=home");
        } else if($level == 'user') {
            $_SESSION["username"] = $username;
            $_SESSION["level"] = $level;
            $_SESSION["id"]=$id;
            header("Location: ../content.php?module=home");
        }
        else if($level=='label'){
            $_SESSION["username"] = $username;
            $_SESSION["level"] = $level;
            $_SESSION["id"]=$id;
            header("Location: ../content.php?module=home");
        }
    } else {
        $error = urlencode("Username atau password salah!");
        header("Location: ../index.php?pesan=$error");
    }

    # Close connection to database
    mysqli_close($con);

} else {
    echo "masuk";
    die();
    $error = urlencode("Username atau password kosong!");
    header("Location: ../index.php?pesan=$error");
}
?>