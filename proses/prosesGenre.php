<?php
include "../config/koneksi.php";

$module=$_GET["module"];
$proses=$_GET["act"];

if($module=="genre" && $proses=="input"){
    $code=$_FILES["gambar"]["error"];
        if($code===0){
            $nama_folder="../images/cover";
            $tmp=$_FILES["gambar"]["tmp_name"];
            $nama_file=$_FILES["gambar"]["name"];
            $path="$nama_folder/$nama_file";
            $upload_check=false;
            $tipe_file=array("image/jpeg","image/jpg","image/png");
            
            if(!in_array($_FILES["gambar"]["type"],$tipe_file)){
                ?><script>alert("Cek kembali ekstensi file anda (*.jpeg,*.jpg,*.png)"); </script><?php
                $upload_check=true;
                header('location:../content.php?module='.$module);
            }
            if($upload_check==false){
                unlink($nama_file);
            }
            if(!$upload_check and move_uploaded_file($tmp,$path)){
                mysqli_query($con, "insert into genre(nama, gambar) values('$_POST[nama]','$nama_file')");
                header('location:../content.php?module='.$module);
            }
            else{
                ?><script>alert("Upload gambar gagal!"); </script><?php
                header('location:../content.php?module='.$module);
            }
        }
}

else if($module=="genre" && $proses=="update"){
    if(!$_FILES["gambar"]["name"]==""){
        $code=$_FILES["gambar"]["error"];
            if($code===0){
                $nama_folder="../images/profil";
                $tmp=$_FILES["gambar"]["tmp_name"];
                $nama_file=$_FILES["gambar"]["name"];
                $path="$nama_folder/$nama_file";
                $upload_check=false;
                $tipe_file=array("image/jpeg","image/jpg","image/png");
        
                if(!in_array($_FILES["gambar"]["type"],$tipe_file)){
                    ?><script>alert("Cek kembali ekstensi file anda (*.jpeg,*.jpg,*.png)"); </script><?php
                    $upload_check=true;
                    header('location:../content.php?module='.$module);
                }
                if($upload_check==false){
                    unlink($_POST["gambar_lama"]);
                }
                if(!$upload_check and move_uploaded_file($tmp,$path)){
                    mysqli_query($con,"update genre set gambar='$nama_file' where id_genre=$_POST[id_genre]");
                }
                else{
                    ?><script>alert("Upload gambar gagal!"); </script><?php
                    header('location:../content.php?module='.$module);
                }
            }
        }
    
    mysqli_query($con, "update genre set nama='$_POST[nama]' where id_genre=$_POST[id_genre]");
    header('location:../content.php?module='.$module);
}
?>