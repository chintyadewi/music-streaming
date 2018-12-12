<?php
include "../config/koneksi.php";

$module=$_GET["module"];
$proses=$_GET["act"];

if($module=="artis" && $proses=="input"){
    $code=$_FILES["foto"]["error"];
        if($code===0){
            $nama_folder="../images/artis";
            $tmp=$_FILES["foto"]["tmp_name"];
            $nama_file=$_FILES["foto"]["name"];
            $path="$nama_folder/$nama_file";
            $upload_check=false;
            $tipe_file=array("image/jpeg","image/jpg","image/png");
            
            if(!in_array($_FILES["foto"]["type"],$tipe_file)){
                ?><script>alert("Cek kembali ekstensi file anda (*.jpeg,*.jpg,*.png)"); </script><?php
                $upload_check=true;
                header('location:../content.php?module='.$module);
            }
            if($upload_check==false){
                unlink($nama_file);
            }
            if(!$upload_check and move_uploaded_file($tmp,$path)){
                mysqli_query($con, "insert into artis(nama, foto, total_lagu, total_album, info) values('$_POST[nama]','$nama_file',0,0,'$_POST[info]')");
                header('location:../content.php?module='.$module);
            }
            else{
                ?><script>alert("Upload foto gagal!"); </script><?php
                header('location:../content.php?module='.$module);
            }
        }
}

else if($module=="artis" && $proses=="update"){
    if(!$_FILES["foto"]["name"]==""){
        $code=$_FILES["foto"]["error"];
            if($code===0){
                $nama_folder="../images/artis";
                $tmp=$_FILES["foto"]["tmp_name"];
                $nama_file=$_FILES["foto"]["name"];
                $path="$nama_folder/$nama_file";
                $upload_check=false;
                $tipe_file=array("image/jpeg","image/jpg","image/png");
        
                if(!in_array($_FILES["foto"]["type"],$tipe_file)){
                    ?><script>alert("Cek kembali ekstensi file anda (*.jpeg,*.jpg,*.png)"); </script><?php
                    $upload_check=true;
                    header('location:../content.php?module='.$module);
                }
                if($upload_check==false){
                    unlink($_POST["foto_lama"]);
                }
                if(!$upload_check and move_uploaded_file($tmp,$path)){
                    mysqli_query($con,"update artis set foto='$nama_file' where id_artis=$_POST[id_artis]");
                }
                else{
                    ?><script>alert("Upload gambar gagal!"); </script><?php
                    header('location:../content.php?module='.$module);
                }
            }
        }
    
    $data1=mysqli_fetch_assoc(mysqli_query($con,"select count(id_artis) from lagu where id_artis=$_POST[id_artis]"));
    $total_lagu=$data1["count(id_artis)"];

    $data2=mysqli_fetch_assoc(mysqli_query($con,"select count(id_artis) from album where id_artis=$_POST[id_artis]"));
    $total_album=$data2["count(id_artis)"];
        
    mysqli_query($con, "update artis set nama='$_POST[nama]', total_lagu=$total_lagu, total_album=$total_album, info='$_POST[info]' where id_artis=$_POST[id_artis]");
    header('location:../content.php?module='.$module);
}
?>