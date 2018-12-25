<?php
    include "../config/koneksi.php";

    $module=$_GET['module'];
    $proses=$_GET['act'];

    if($module=='lagu' && $proses=='input'){
        mysqli_query($con,"insert into lagu(judul, id_genre, tgl_rilis, id_album, id_artis, id_label) values('$_POST[judul]', $_POST[genre], '$_POST[tgl_rilis]', $_POST[album], $_POST[artis], $_POST[label])");

        $query=mysqli_query($con,"select max(id_lagu) from lagu");
        $result=mysqli_fetch_assoc($query);
        $id=$result["max(id_lagu)"];

        if(!$_FILES["file"]["name"]==""){
            $code=$_FILES["file"]["error"];
                if($code===0){
                    $nama_folder="../songs";
                    $tmp=$_FILES["file"]["tmp_name"];
                    $nama_file=$_FILES["file"]["name"];
                    $path="$nama_folder/$nama_file";
                    $upload_check=false;
                    
                    $tipe_file=array("audio/mp3","audio/mpeg","audio/mpeg3");
            
                    if(!in_array($_FILES["file"]["type"],$tipe_file)){
                        ?><script>alert("Cek kembali ekstensi file anda (*.mp3,*.mpeg,*.mpeg3)"); </script><?php
                        $upload_check=true;
                        header('location:../content.php?module='.$module);
                    }
                    if(file_exists($path)){
                        unlink($nama_file);
                    }
                    if(!$upload_check and move_uploaded_file($tmp,$path)){
                        mysqli_query($con,"update lagu set file='$nama_file', durasi=$_POST[durasi] where id_lagu=$id");
                    }
                    else{
                        ?><script>alert("Upload file gagal!"); </script><?php
                        header('location:../content.php?module='.$module);
                    }
                }
            }

            if(!$_FILES["cover"]["name"]==""){
                $code=$_FILES["cover"]["error"];
                    if($code===0){
                        $nama_folder="../images/cover";
                        $tmp=$_FILES["cover"]["tmp_name"];
                        $nama_file=$_FILES["cover"]["name"];
                        $path="$nama_folder/$nama_file";
                        $upload_check=false;
                        $tipe_file=array("image/jpeg","image/jpg","image/png");
                
                        if(!in_array($_FILES["cover"]["type"],$tipe_file)){
                            ?><script>alert("Cek kembali ekstensi file anda (*.jpeg,*.jpg,*.png)"); </script><?php
                            $upload_check=true;
                            header('location:../content.php?module='.$module);
                        }
                        if(file_exists($path)){
                            unlink($_POST["cover_lama"]);
                        }
                        if(!$upload_check and move_uploaded_file($tmp,$path)){
                            mysqli_query($con,"update lagu set cover='$nama_file' where id_lagu=$id");
                        }
                        else{
                            ?><script>alert("Upload gambar gagal!"); </script><?php
                            header('location:../content.php?module='.$module);
                        }
                    }
                }
        
        mysqli_query($con, "update artis set total_lagu=(total_lagu+1) where id_artis=$_POST[artis]");
	    header('location:../content.php?module='.$module); 
    }

    else if($module=='lagu' && $proses=='update'){
        if(!$_FILES["file"]["name"]==""){
            $code=$_FILES["file"]["error"];
                if($code===0){
                    $nama_folder="../songs";
                    $tmp=$_FILES["file"]["tmp_name"];
                    $nama_file=$_FILES["file"]["name"];
                    $path="$nama_folder/$nama_file";
                    $upload_check=false;
                    
                    $tipe_file=array("audio/mp3","audio/mpeg","audio/mpeg3");
            
                    if(!in_array($_FILES["file"]["type"],$tipe_file)){
                        ?><script>alert("Cek kembali ekstensi file anda (*.mp3,*.mpeg,*.mpeg3)"); </script><?php
                        $upload_check=true;
                        header('location:../content.php?module='.$module);
                    }
                    if(file_exists($path)){
                        unlink($_POST["file_lama"]);
                    }
                    if(!$upload_check and move_uploaded_file($tmp,$path)){
                        mysqli_query($con,"update lagu set file='$nama_file', durasi=$_POST[durasi] where id_lagu=$_POST[id_lagu]");
                    }
                    else{
                        ?><script>alert("Upload file gagal!"); </script><?php
                        header('location:../content.php?module='.$module);
                    }
                }
            }

            if(!$_FILES["cover"]["name"]==""){
                $code=$_FILES["cover"]["error"];
                    if($code===0){
                        $nama_folder="../images/cover";
                        $tmp=$_FILES["cover"]["tmp_name"];
                        $nama_file=$_FILES["cover"]["name"];
                        $path="$nama_folder/$nama_file";
                        $upload_check=false;
                        $tipe_file=array("image/jpeg","image/jpg","image/png");
                
                        if(!in_array($_FILES["cover"]["type"],$tipe_file)){
                            ?><script>alert("Cek kembali ekstensi file anda (*.jpeg,*.jpg,*.png)"); </script><?php
                            $upload_check=true;
                            header('location:../content.php?module='.$module);
                        }
                        if(file_exists($path)){
                            unlink($_POST["cover_lama"]);
                        }
                        if(!$upload_check and move_uploaded_file($tmp,$path)){
                            mysqli_query($con,"update lagu set cover='$nama_file' where id_lagu=$_POST[id_lagu]");
                        }
                        else{
                            ?><script>alert("Upload gambar gagal!"); </script><?php
                            header('location:../content.php?module='.$module);
                        }
                    }
                }

        mysqli_query($con,"update lagu set judul='$_POST[judul]', id_genre='$_POST[genre]', tgl_rilis='$_POST[tgl_rilis]', id_artis=$_POST[artis], id_label=$_POST[label] where id_lagu=$_POST[id_lagu]");

        mysqli_query($con,"update artis set total_lagu=(total_lagu-1) where id_artis=$_POST[artis_lama]");
        mysqli_query($con,"update artis set total_lagu=(total_lagu+1) where id_artis=$_POST[artis]");

        header('location:../content.php?module='.$module); 
    }

else if($module=='lagu' && $proses=='delete'){
    $query="delete from lagu where id_lagu=$_GET[id]";
    if(mysqli_query($con, $query)){
        header('location:../content.php?module='.$module);
    }
    else{
        ?><script>alert("Lagu gagal dihapus");document.location.href="../content.php?module='.$module"</script><?php
    }
}

?>


