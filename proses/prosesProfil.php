<?php
    include "../config/koneksi.php";

    $module=$_GET['module'];
    $proses=$_GET['act'];

    if($module=='profil' && $proses=='updateFoto'){
        if(!$_FILES["foto"]["name"]==""){
            $code=$_FILES["foto"]["error"];
                    if($code===0){
                        $nama_folder="../images/profil";
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
                        if(file_exists($path)){
                            unlink($_POST["foto_lama"]);
                        }
                        if(!$upload_check and move_uploaded_file($tmp,$path)){
                            mysqli_query($con, "update user set foto='$nama_file' where id_user=$_POST[id_user]");
                            header('location:../content.php?module='.$module);
                        }
                        else{
                            ?><script>alert("Upload gambar gagal!"); </script><?php
                            header('location:../content.php?module='.$module);
                        }
                    }
                }
    }
    else if($module=="profil" && $proses=="update"){
        if(!$_POST["nama"]==""){
            mysqli_query($con, "update user set nama='$_POST[nama]' where id_user=$_POST[id_user]");
        }
        if(!$_POST["email"]==""){
            mysqli_query($con, "update user set email='$_POST[email]' where id_user=$_POST[id_user]");
        }
        if(!$_POST["username"]==""){
            mysqli_query($con, "update user set username='$_POST[username]' where id_user=$_POST[id_user]");
        }
        if(!$_POST["password"]==""){
            mysqli_query($con, "update user set password=md5('$_POST[password]') where id_user=$_POST[id_user]");
        }
        
        header('location:../content.php?module='.$module);
    }
?>


