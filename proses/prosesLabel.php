<?php
    include "../config/koneksi.php";
        
    $module=$_GET['module'];
    $proses=$_GET['act'];

    if($module=='label' && $proses=='input'){
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
                ?><script>alert("File dengan nama yang sama sudah tersimpan, coba lagi"); </script><?php
                $upload_check=true;
                header('location:../content.php?module='.$module);
            }
            if(!$upload_check AND move_uploaded_file($tmp,$path)){ 
                mysqli_query($con,"insert into user(username, password, nama, email, foto, level) values('$_POST[username]',md5('$_POST[password]'),'$_POST[nama]', '$_POST[email]', '$nama_file', 'label')");
                $result=mysqli_query($con,"select * from user where username='$_POST[username]' and password=md5('$_POST[password]')");
                $row=mysqli_fetch_assoc($result);
                mysqli_query($con,"insert into label(nama, id_user) values ('$_POST[nama]',$row[id_user])");
                header('location:../content.php?module='.$module); 
                mysqli_close($con);      
            }
            else{?>
                <script>alert("Upload Gambar Gagal! Cek kembali ekstensi file anda (*.jpeg,*.jpg,*.png)")</script> 
                <?php 
                header('location:../content.php?module='.$module);
            }
        }
    }else if($module=='label' && $proses=='update'){
        if(!$_FILES["foto"]["name"]=="" && !$_POST["password"]==""){ 
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
                        mysqli_query($con,"update label set nama='$_POST[nama]' where id_label=$_POST[id_label]");
                        $result=mysqli_query($con,"select id_user from label where id_label='$_POST[id_label]'");
                        $row=mysqli_fetch_assoc($result);
                        mysqli_query($con,"update user set username='$_POST[username]', password=md5('$_POST[password]'),nama='$_POST[nama]', email='$_POST[email]', foto='$nama_file' where id_user=$row[id_user]");
                        header('location:../content.php?module='.$module);
                    }
                    else{
                        ?><script>alert("Upload gambar gagal!"); </script><?php
                        header("Location: ../content.php?module='.$module");
                    }
                }
            }else if($_FILES["foto"]["name"]=="" && $_POST["password"]==""){ 
                mysqli_query($con,"update label set nama='$_POST[nama]' where id_label=$_POST[id_label]");
                $result=mysqli_query($con,"select id_user from label where id_label='$_POST[id_label]'");
                $row=mysqli_fetch_assoc($result);
                mysqli_query($con,"update user set username='$_POST[username]', nama='$_POST[nama]', email='$_POST[email]' where id_user=$row[id_user]");
                header('location:../content.php?module='.$module);
            }else if($_FILES["foto"]["name"]=="" && !$_POST["password"]==""){ 
                mysqli_query($con,"update label set nama='$_POST[nama]' where id_label=$_POST[id_label]");
                $result=mysqli_query($con,"select id_user from label where id_label='$_POST[id_label]'");
                $row=mysqli_fetch_assoc($result);
                mysqli_query($con,"update user set username='$_POST[username]', password=md5('$_POST[password]'), nama='$_POST[nama]', email='$_POST[email]' where id_user=$row[id_user]");
                header('location:../content.php?module='.$module);
            }else if(!$_FILES["foto"]["name"]=="" && $_POST["passsword"]==""){
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
                    }
                    if($upload_check==false){
                        unlink($_POST["foto_lama"]);
                    }
                    if(!$upload_check and move_uploaded_file($tmp,$path)){
                        mysqli_query($con,"update label set nama='$_POST[nama]' where id_label=$_POST[id_label]");
                        $result=mysqli_query($con,"select id_user from label where id_label='$_POST[id_label]'");
                        $row=mysqli_fetch_assoc($result);
                        mysqli_query($con,"update user set username='$_POST[username]',nama='$_POST[nama]', email='$_POST[email]', foto='$nama_file' where id_user=$row[id_user]");
                        header('location:../content.php?module='.$module);
                    }
                    else{
                        ?><script>alert("Upload gambar gagal!"); </script><?php
                        header("Location: ../content.php?module='.$module");
                    }
                }
            }
            
            // close mysql connection
            mysqli_close($con);
        }
?>


