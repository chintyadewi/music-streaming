<?php
    include "../config/koneksi.php";

    $module=$_GET['module'];
    $proses=$_GET['act'];

    if($module=='album' && $proses=='input'){
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
                            unlink("$nama_folder/$nama_file");
                        }
                        if(!$upload_check and move_uploaded_file($tmp,$path)){
                            mysqli_query($con, "update artis set total_album=(total_album+1) where id_artis=$_POST[artis]");
                            mysqli_query($con,"insert into album(nama, tgl_rilis, id_genre, id_artis, id_label, cover, total_lagu) values('$_POST[nama]', '$_POST[tgl_rilis]',$_POST[genre], $_POST[artis], $_POST[label], '$nama_file', 0)");
                        }
                        else{
                            ?><script>alert("Upload gambar gagal!"); </script><?php
                            header('location:../content.php?module='.$module);
                        }
                    }
                }
        
        $inserted=mysqli_fetch_assoc(mysqli_query($con, "select max(id_album) from album"));

	    header('location:../content.php?module=album&act=detail&id='.$inserted["max(id_album)"]);
    }

    else if($module=="album" && $proses=="addDetail"){
        mysqli_query($con, "update lagu set id_album=$_GET[album] where id_lagu=$_GET[id]");
        header('location:../content.php?module=album&act=detail&id='.$_GET["album"]);
    }

    else if($module=="album" && $proses=="removeSong"){
        mysqli_query($con, "update lagu set id_album=null where id_lagu=$_GET[id]");
        header('location:../content.php?module=album&act=detail&id='.$_GET["album"]);
    }

    else if($module=='album' && $proses=='inputNew'){
        mysqli_query($con, "update artis set total_lagu=(total_lagu+1) where id_artis=$_POST[artis]");
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
                        unlink("$nama_folder/$nama_file");
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
                            unlink("$nama_folder/$nama_file");
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
            
            header('location:../content.php?module=album&act=detail&id='.$_POST["album"]); 
        }

        else if($module=="album" && $proses=="update"){
            mysqli_query($con,"update album set nama='$_POST[nama]', tgl_rilis='$_POST[tgl_rilis]', id_genre=$_POST[genre], id_artis=$_POST[artis], id_label=$_POST[label] where id_album=$_POST[id_album]");

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
                            unlink("$nama_folder/$nama_file");
                        }
                        if(!$upload_check and move_uploaded_file($tmp,$path)){
                            mysqli_query($con,"update album set cover='$nama_file' where id_album=$_POST[id_album]");
                        }
                        else{
                            ?><script>alert("Upload gambar gagal!"); </script><?php
                            header('location:../content.php?module='.$module);
                        }
                    }
                }
            header('location:../content.php?module='.$module);
        }

    else if($module=='album' && $proses=='delete'){
        $query="update album flag='0' where id_album=$_GET[id]";
        $query2="update lagu set id_album=null where id_album=$_GET[id]";
        if(mysqli_query($con, $query) && mysqli_query($con,$query2)){
            header('location:../content.php?module='.$module);
        }
        else{
            ?><script>alert("Album gagal dihapus");document.location.href="../content.php?module=album";</script><?php
        }
    }
?>


