<?php
session_start();
include "../config/koneksi.php";

$module=$_GET["module"];
$proses=$_GET["act"];

if($module=="playlist" && $proses=="input"){
    mysqli_query($con, "insert into playlist (id_user, nama, tgl_buat) values ('$_SESSION[id]', '$_POST[nama]', '$_POST[tgl_buat]')");
    header('location:../content.php?module='.$module);
}

else if($module=="playlist" && $proses=="addDetail"){
    mysqli_query($con, "insert into detail_playlist (id_playlist, id_lagu) values ($_GET[id], $_GET[id_lagu])");
    header('location:../content.php?module=playlist&id='.$_GET["id"]);
}
else if($module=="playlist" && $proses=="delete"){
    mysqli_query($con, "delete from playlist where id_playlist=$_GET[id])");
    mysqli_query($con, "delete from detail_playlist where id_playlist=$_GET[id]");
    header('location:../content.php?module='.$module);
}
else if($module=="playlist" && $proses=="removeSong"){
    mysqli_query($con, "delete from detail_playlist where id_playlist=$_GET[id] and id_lagu=$_GET[id_lagu]");
    header('location:../content.php?module=playlist&id='.$_GET["id"]);
}
else if($module=="playlist" && $proses=="update"){
    mysqli_query($con, "update playlist set nama='$_POST[nama]' where id_playlist=$_POST[id_playlist]");
    header('location:../content.php?module='.$module);
}
?>