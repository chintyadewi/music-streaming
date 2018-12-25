<?php
include "../config/koneksi.php";

$module=$_GET["module"];
$proses=$_GET["act"];

if($module=="user" && $proses=="input"){
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
                unlink($nama_file);
            }
            if(!$upload_check and move_uploaded_file($tmp,$path)){
                mysqli_query($con, "insert into user(nama, username, password, email, foto, level) values('$_POST[nama]','$_POST[username]',md5('$_POST[password]'),'$_POST[email]','$nama_file','$_POST[level]')");
                header('location:../content.php?module='.$module);
            }
            else{
                ?><script>alert("Upload gambar gagal!"); </script><?php
                header('location:../content.php?module='.$module);
            }
        }
}

else if($module=="user" && $proses=="update"){
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
                if($upload_check==false){
                    unlink($_POST["foto_lama"]);
                }
                if(!$upload_check and move_uploaded_file($tmp,$path)){
                    mysqli_query($con,"update user set foto='$nama_file' where id_user=$_POST[id_user]");
                }
                else{
                    ?><script>alert("Upload gambar gagal!"); </script><?php
                    header('location:../content.php?module='.$module);
                }
            }
        }
    
    if(!$_POST["password"]==""){
        mysqli_query($con,"update user set password=md5('$_POST[password]') where id_user=$_POST[id_user]");
    }

    mysqli_query($con, "update user set nama='$_POST[nama]', email='$_POST[email]', username='$_POST[username]', level='$_POST[level]' where id_user=$_POST[id_user]");
    header('location:../content.php?module='.$module);
}

else if($module=="user" && $proses=="delete"){
    $updateLabel=mysqli_query($con, "update label set id_user=null where id_user=$_GET[id]");
    $query="delete from user where id_user=$_GET[id]";

    if($updateLabel && mysqli_query($con, $query)){
        header('location:../content.php?module='.$module);
    }
    else{
        ?><script>alert("Label gagal dihapus");
            window.location.href="../content.php?module="+$module;</script>
        <?php
    }
}
?>