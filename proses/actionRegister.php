<?php
include '../config/koneksi.php';

$nama=$_POST["nama"];
$username=$_POST["username"];
$password=md5($_POST["password"]);
$email=$_POST["email"];
    $query="insert into user (username, password, nama, email, level) values ('$username','$password','$nama','$email', 'user')";
    
    if(mysqli_query($con, $query)){ ?>
        <script>alert("Register Success!");document.location.href="../index.php"</script><?php
    }else{ ?>
        <script>alert("Username already used!");document.location.href="../index.php"</script><?php
    }
    
    mysqli_close($con);
        
?>