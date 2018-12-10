<?php
    $dbUrl="localhost";
    $dbUser="root";
    $dbPass="";
    $dbName="db_musik";

    $con=mysqli_connect($dbUrl, $dbUser, $dbPass, $dbName);
    if(!$con){
        die("Koneksi Gagal : ".mysqli_connect_error());
    }
?>