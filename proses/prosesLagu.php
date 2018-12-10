<?php
    include "../config/koneksi.php";
        
    $module=$_GET['module'];
    $act=$_GET['act'];

    if($module=='lagu' && $proses='input'){
        mysqli_query($connect,"insert into lagu values(,'$_POST[judul]','$_POST[file]',,'$_POST[genre]', '$_POST[tgl_rilis], 0,'$_POST[artis]', '')");
	    header('location:../../content.php?module='.$module); 
    }
?>


