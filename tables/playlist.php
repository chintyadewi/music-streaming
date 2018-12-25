<?php 
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

$level=$_SESSION["level"];
if($level=="admin" or $level=="label" or $level=="user"){

    $result=mysqli_query($con,"select count(id_playlist) from playlist where id_user='$_SESSION[id]'");
    $row=mysqli_fetch_assoc($result);
    $totalPlaylistMu=$row["count(id_playlist)"];

    $result1=mysqli_query($con,"select count(id_playlist) from playlist");
    $row1=mysqli_fetch_assoc($result1);
    $totalPlaylist=$row["count(id_playlist)"];

    $proses='proses/prosesPlaylist.php';
    switch($_GET["act"]){
        default:
            ?>
            <div class="row">
                <div class="col-6">
                    <h2 class="mt-3">All Playlist</h2>
                </div>
                <div class="col-6 text-right">
                    <a href="?module=playlist&act=add" class="btn btn-primary mt-3"><i class="fas fa-plus"></i></a>
                </div>
            </div>

            <div class="row mb-5 pb-3">
                <div class="col-4">
                    <?php 
                        $playlist=mysqli_query($con,"select * from playlist where id_user=$_SESSION[id]");
                        if(mysqli_num_rows($playlist)>0){
                            $no=1;
                            while($row=mysqli_fetch_assoc($playlist)){ ?>
                            <a href="?module=playlist&id=<?php echo $row["id_playlist"];?>">
                                <div class="row playlist">
                                    <div class="col-12 card mb-0 mt-3">
                                        <div class="row p-3">
                                            <div class="col-1">
                                                <p class="text-primary"><?php echo $no; ?></p>
                                            </div>
                                            <div class="col-6">
                                                <p class="text-white"><?php echo $row["nama"]; ?></p>
                                            </div>
                                            <div class="col-4">
                                                <p><?php echo $row["tgl_buat"]; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-0">
                                    <div class="col-12 text-right">
                                    <a href='?module=playlist&act=edit&id=<?php echo $row["id_playlist"]; ?>' class='btn btn-success pr-3 pl-3 mt-0'><i class="fas fa-edit"></i></a>
                                        <a href="<?php echo $proses; ?>?module=playlist&act=delete&id=<?php echo $row["id_playlist"]; ?>" class='btn btn-danger pl-3 pr-3 mt-0'><i class='far fa-trash-alt'></i></a>
                                    </div>
                                </div>
                            </a>
                            <?php
                            $no++;
                            }
                        }else{
                            ?><div class="col-12 text-center mb-5">Empty</div><?php
                        }
                    ?>
                </div>
                <div class="col-7 ml-4 card p-3 mt-3">
                <?php 
                    $playlist=mysqli_query($con,"select * from playlist where id_playlist=$_GET[id]");
                    $Rplaylist=mysqli_fetch_assoc($playlist);
                ?>
                <?php if(mysqli_num_rows($playlist)>0){ ?>
                    <div class="row">
                        <div class="col-6">
                            <h4>
                            <?php 
                                echo $Rplaylist["nama"];
                            
                            ?></h4>
                        </div>
                        <div class="col-6 text-right">
                            <a href="?module=playlist&act=addSong&id=<?php echo $Rplaylist["id_playlist"]; ?>" class="btn btn-primary"><i class="fas fa-plus p-0"></i></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 p-3">
                        <?php 
                            $lagu=mysqli_query($con,"select a.*, b.*, c.nama as artis from detail_playlist a inner join lagu b on a.id_lagu=b.id_lagu inner join artis c on b.id_artis=c.id_artis where a.id_playlist=$_GET[id] order by a.id_detail desc");
                            if(mysqli_num_rows($lagu)>0){
                                while($row=mysqli_fetch_assoc($lagu)){
                                    ?>
                                        <div class="row mb-3">
                                        <a href="?module=playlist&id=<?php echo $_GET["id"]; ?>&id_lagu=<?php echo $row["id_lagu"];?>">
                                            <div class="col-1 mt-3 text-right detailPlay">
                                                <i class="fas fa-play ml-3 text-secondary"></i>
                                            </div>
                                        </a>
                                            <div class="col-2 text-center"><img src="images/cover/<?php echo $row["cover"]; ?>" width="80%">
                                            </div>
                                            <div class="col-6">
                                                <p class="text-white"><?php echo $row["judul"]; ?></p>
                                                <p class="mt-0" style="font-size:12"><?php echo $row["artis"]; ?></p>
                                                <hr class="m-0 border-secondary">
                                            </div>
                                            <div class="col-1 text-left">
                                                <p style="margin-top:30px; margin-left:-20px;"><?php echo $row["durasi"]; ?></p>
                                            </div>
                                            <div class="col-1 pt-3" style="margin-left:-20px;">
                                            <a href="<?php echo $proses.'?module=playlist&act=removeSong&id='.$_GET["id"].'&id_lagu='.$row["id_lagu"]; ?>" class='btn btn-danger pl-3 pr-3 m-0'><i class="fas fa-minus"></i></a>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                }else{
                                ?><div class="col-12 text-center mb-5">Empty</div><?php
                                }
                            ?>
                        </div>
                    </div>
                    <?php } ?>                    
                </div>
            </div>
            <div class="row">
                <?php include "player.php"; ?>
            </div>
            <?php 
                break; 

            case 'addSong': 
            $lagu=mysqli_query($con, "select  * from lagu where id_lagu not in (select id_lagu from detail_playlist where detail_playlist.id_playlist=$_GET[id] and detail_playlist.id_lagu=lagu.id_lagu) order by tgl_rilis desc");
            ?>

            <div class="container mt-3 ">
                <div class="row">
                    <div class="col-10">
                        <div class="row">
                            <h3>Choose Song</h3>
                        </div>
                        <div class="row">
                            <div class="col-12 offset-1">
                            <?php
                            if(mysqli_num_rows($lagu)>0){
                                while($row=mysqli_fetch_assoc($lagu)){
                                    $artis=mysqli_fetch_assoc(mysqli_query($con, "select nama from artis a, lagu b where b.id_artis=a.id_artis and b.id_lagu=$row[id_lagu]"));
                                    ?>
                                        <div class="row mb-3">
                                            <div class="col-1 text-right"><img src="images/cover/<?php echo $row["cover"]; ?>" width="100%">
                                            </div>
                                            <div class="col-7">
                                                <p class="text-white"><?php echo $row["judul"]; ?></p>
                                                <p class="mt-0" style="font-size:12"><?php echo $artis["nama"]; ?></p>
                                                <hr class="m-0 border-secondary">
                                            </div>
                                            <div class="col-1 text-left">
                                                <p style="margin-top:30px; margin-left:-20px;"><?php echo $row["durasi"]; ?></p>
                                            </div>
                                            <div class="col-1 pt-3" style="margin-left:-20px;">
                                                <a href="<?php echo $proses.'?module=playlist&act=addDetail&id='.$_GET["id"].'&id_lagu='.$row["id_lagu"]; ?>" class='btn btn-primary pl-3 pr-3 m-0'><i class="fas fa-plus"></i></a>
                                            </div>
                                        </div>
                                <?php
                                }
                            }
                            else{
                            ?><div class="col-12 text-center mb-5">Empty</div><?php
                            }
                            ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            break;

            case 'add': ?>
                <h3>Add New Playlist</h3>
                <form action="<?php echo $proses; ?>?module=playlist&act=input" method="POST" class="ml-5">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nama">Playlist Name</label>
                            <input type="text" class="form-control" name="nama" placeholder="Name" required>
                        </div>
                        <div class="col-md-4">
                            <input type="hidden" class="form-control text-white" id="tgl_buat" value="<?php echo date("Y-m-d"); ?>" name="tgl_buat">
                        </div>
                    </div>
                    <div class="form-row mt-5">
                        <div class="col-md-8 text-right">
                            <button type="reset" class="btn btn-warning">Reset</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                    </form>
                <?php 
                break;
                
                case 'edit': 
                    $edit=mysqli_query($con,"select * from playlist where id_playlist=$_GET[id]");
                    $data=mysqli_fetch_assoc($edit);
                ?>
                
                <h3>Edit Playlist</h3>

                <div class="row">
                    <div class="col-8">
                        <form action="<?php echo $proses; ?>?module=playlist&act=update" method="POST" class="ml-5">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nama">Playlist Name</label>
                                    <input type="hidden" class="form-control" name="id_playlist" value="<?php echo $data["id_playlist"];?>" required>
                                    <input type="text" class="form-control" name="nama" value="<?php echo $data["nama"];?>" placeholder="Name" required>
                                </div>
                            </div>
                            <div class="form-row mt-5">
                                <div class="col-md-8 text-right">
                                    <button type="reset" class="btn btn-warning">Reset</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                            </form>
                    </div>
                </div>
                
            <?php 
            }
}else if($level==""){
  ?><script>alert("Log In First");document.location.href="../index.php";</script><?php
}
else{
  ?><script>alert("Access Denied");document.location.href="../logout.php";</script><?php
}