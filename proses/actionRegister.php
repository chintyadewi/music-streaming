<?php
include '../config/koneksi.php';

$nama=$_POST["nama"];
$username=$_POST["username"];
$password=md5($_POST["password"]);
$email=$_POST["email"];
$code=$_FILES["foto"]["error"];
    if($code===0){
        $nama_folder="../images/profil";
        $tmp=$_FILES["foto"]["tmp_name"];
        $nama_file=$_FILES["foto"]["name"];
        $path="$nama_folder/$nama_file";
        $upload_check=false;
        $tipe_file=array("image/jpeg","image/jpg","image/png");

        if(!in_array($_FILES["foto"]["type"],$tipe_file)){
            $error.="Cek kembali ekstensi file anda (*.jpeg,*.jpg,*.png)<br>";
            $upload_check=true;
            header("Location: ../index.php?error=$error");
        }
        
        if(file_exists($path)){
            $error.="File dengan nama yang sama sudah tersimpan, coba lagi<br>";
            $upload_check=true;
            header("Location: ../index.php?error=$error");
        }
        if(!$upload_check AND move_uploaded_file($tmp,$path)){ 
            $query="insert into user (username, password, nama, email, foto, level) values ('$username','$password','$nama','$email', '$nama_file', 'user')";
            
            if(mysqli_query($con, $query)){
                header("Location: ../index.php");
            }else{
                $error=urlencode("Username sudah ada!");
                header("Location: ../index.php?error=$error");
            }
            
            mysqli_close($con);      
        }
        else{
            $error="Upload Gambar Gagal! Cek kembali ekstensi file anda (*.jpeg,*.jpg,*.png)<br>";
            header("Location: ../index.php?error=$error");
        }
    }


?>