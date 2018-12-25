<?php error_reporting(E_ALL ^ (E_NOTICE | E_WARNING)); ?>

<?php
$level=$_SESSION["level"];
if($level=="admin" or $level=="label" or $level=="user"){
    $proses='proses/prosesGenre.php';
    switch($_GET["act"]){
        default:
            ?>
            <div class="row">
                <div class="col-6">
                    <h2 class="mt-3">Genre</h2>
                </div>
                <div class="col-6 text-right">
                    <a href="?module=genre&act=add" class="btn btn-primary mt-3"><i class="fas fa-plus"></i></a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card card-chart">
                    <div class="card-header ">
                        <div class="row ml-3 mr-3 mt-4"><?php
                            $query = "select * from genre where flag='1' order by nama asc";
                            $result = mysqli_query($con, $query);
                            if (mysqli_num_rows($result) > 0){
                                $index = 1;
                                while($row = mysqli_fetch_assoc($result)){
                                    $id_genre = $row["id_genre"];
                                    ?>
                                    <div class="col-3" id=<?php echo $row["id_genre"]; ?>>
                                    <div class="card data">
                                    <?php
                                    if($level=="admin"){ ?> 
                                    <div class="text-right p-0" style="position:absolute; right:-8px;">
                                        <a href='?module=genre&act=edit&id=<?php echo $id_genre; ?>' class='btn btn-success pr-3 pl-3 mt-0'><i class="fas fa-edit"></i></a><br>
                                        <a href="<?php echo $proses; ?>?module=genre&act=delete&id=<?php echo $id_genre;?>" class='btn btn-danger pl-3 pr-3 mt-0'><i class='far fa-trash-alt'></i></a>
                                    </div>
                                    <?php } ?>
                                    <a href="?module=genre&act=detail&id=<?php echo $id_genre; ?>">
                                        <img class="card-img-top" width="100%" height="30%" src="images/cover/<?php echo $row["gambar"]; ?>" alt="Card image cap">
                                    </a>
                                        <div class="card-body text-center">
                                            <h5 class="card-title mb-2"><strong><?php echo $row["nama"]; ?></strong></h5>
                                        </div>
                                    </div>
                                </div>
                                    <?php ;
                                }
                            }else{
                                ?><div class="col-12 text-center mb-5">Empty</div><?php
                            }
                            mysqli_close($con);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
                break; 

            case 'detail':
            $detail=mysqli_query($con,"select * from genre where id_genre=$_GET[id] and flag='1'");
            $data=mysqli_fetch_assoc($detail);
            ?>

            <div class="row">
                <div class="col-6">
                    <h2 class="mt-3"><?php echo $data["nama"];?> Genre</h2>
                </div>
            </div>
            <div class="row text-capitalize">
                <div class="col-12">
                    <div class="card card-chart">
                    <div class="card-header ">
                        <div class="row">
                        <div class="col-sm-6 text-left">
                            <h5 class="card-category">All Songs</h5>
                            <?php
                                $result=mysqli_query($con,"select count(id_lagu) from lagu where id_genre=$_GET[id]");
                                $row=mysqli_fetch_assoc($result);
                                $totalLagu=$row["count(id_lagu)"];
                            ?>
                            <h3 class="card-title"><i class="fas fa-music text-primary mr-2"></i><?php echo $totalLagu; ?></h3>
                        </div>
                        </div>
                        <div class="row ml-3 mr-3"><?php
                                    $query = "SELECT * from lagu l inner join artis a on a.id_artis=l.id_artis where l.id_genre=$_GET[id] order by l.tgl_rilis";
                                    $result = mysqli_query($con, $query);
                                    if (mysqli_num_rows($result) > 0){
                                        $index = 1;
                                        while($row = mysqli_fetch_assoc($result)){
                                            $id_lagu = $row["id_lagu"];
                                            ?>
                                            <div class="col-3" id=<?php echo $row["id_lagu"]; ?>>
                                            <div class="card data">
                                        <a href="content.php?module=genre&act=detailLagu&id=<?php echo $_GET["id"]; ?>&id_lagu=<?php echo $row["id_lagu"]; ?>">
                                            <img class="card-img-top" width="100%" height="30%" src="images/cover/<?php echo $row["cover"];?>" alt="Cover Image">
                                        </a>
                                                <div class="card-body text-center">
                                                    <h5 class="card-title m-0"><strong><?php echo $row["judul"]; ?></strong></h5>
                                                    <p class="card-text m-0"><?php echo $row["nama"]; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                            <?php ;
                                        }
                                    }else{
                                        ?><div class="col-12 text-center mb-5">Empty</div><?php
                                    }
                                    ?>
                                </div>
                    </div>
                    </div>
                </div>
                </div>
                <div class="row text-capitalize">
                    <div class="col-12">
                        <div class="card card-chart">
                        <div class="card-header ">
                            <div class="row">
                            <div class="col-sm-6 text-left">
                                <h5 class="card-category">All Albums</h5>
                                <?php
                                    $result2=mysqli_query($con,"select count(id_album) from album where id_genre=$_GET[id]");
                                    $row2=mysqli_fetch_assoc($result2);
                                    $totalAlbum=$row2["count(id_album)"];
                                ?>
                                <h3 class="card-title"><i class="fas fa-dot-circle text-success mr-2"></i><?php echo $totalAlbum; ?></h3>
                            </div>
                            </div>
                            <div class="row ml-3 mr-3"><?php
                                $query = "SELECT a.*, b.nama as 'artis' FROM album a, artis b where a.id_artis=b.id_artis and a.id_genre=$_GET[id] order by a.tgl_rilis";
                                $result = mysqli_query($con, $query);
                                if (mysqli_num_rows($result) > 0){
                                    $index = 1;
                                    while($row = mysqli_fetch_assoc($result)){
                                        $id_album = $row["id_album"];
                                        ?>
                                        <div class="col-3" id=<?php echo $row["id_album"]; ?>>
                                        <div class="card data">
                                        <a href="?module=album&act=detail&id=<?php echo $id_album; ?>">
                                            <img class="card-img-top" width="100%" height="30%"  src="images/cover/<?php echo $row["cover"];?>" alt="Cover Image">
                                        </a>
                                            <div class="card-body text-center">
                                                <h5 class="card-title m-0"><strong><?php echo $row["nama"]; ?></strong></h5>
                                                <p class="card-text m-0"><?php echo $row["artis"]; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                        <?php ;
                                    }
                                }else{
                                    ?><div class="col-12 text-center mb-5">Empty</div><?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                break;

            case 'detailLagu':
                $detail=mysqli_query($con,"select a.*, b.nama as artis, c.nama as label, d.nama as genre from lagu a, artis b, label c, genre d where a.id_artis=b.id_artis and a.id_label=c.id_label and a.id_genre=d.id_genre and a.id_lagu=$_GET[id_lagu] and a.id_genre=$_GET[id]");
                $data=mysqli_fetch_assoc($detail);
                ?>

                <div class="row">
                    <div class="col-6">
                        <h2 class="mt-3"><?php echo $data["judul"]." - ".$data["artis"]; ?></h2>
                    </div>
                </div>
                <div class="row mr-5 ml-5">
                    <div class="col-3">
                        <div class="row">
                            <div class="imgPlay">
                                <a href="javascript:void(0)" onclick="play('song')">
                                    <i class="far fa-play-circle fa-3x text-white"></i>
                                    <img class="card-img-top" width="100%" height="230px" src="images/cover/<?php echo $data["cover"]; ?>" alt="Card image cap">
                                </a>
                            </div>
                        </div>
                        </div>

                        <div class="col-8 ml-5 ">
                            <div class="row">
                                <div class="col-6">
                                    <h3>Info</h3>
                                </div>
                            </div>
                            <?php 
                            $lagu=mysqli_query($con,"select *, b.nama as label, c.nama as artis, d.nama as genre from lagu a inner join label b on a.id_label=b.id_label inner join artis c on a.id_artis=c.id_artis inner join genre d on a.id_genre=d.id_genre where a.id_lagu=$_GET[id_lagu] and a.id_genre=$_GET[id]");
                            if(mysqli_num_rows($lagu)>0){
                                while($row=mysqli_fetch_assoc($lagu)){
                                    ?>
                                    <div class="row mb-3">
                                        <div class="col-3 offset-1">
                                            <i class="fas fa-users mr-2 text-primary"></i>
                                            Artist
                                        </div><div class="col-1">
                                            <p>:</p>
                                        </div>
                                        <div class="col-7">
                                            <p><?php echo $row["artis"]; ?></p>
                                            <p><?php echo $row["info"]; ?></p>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-3 offset-1">
                                            <i class="fab fa-gratipay mr-2 text-success"></i>
                                            Genre
                                        </div><div class="col-1">
                                            <p>:</p>
                                        </div>
                                        <div class="col-7">
                                            <p><?php echo $row["genre"]; ?></p>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-3 offset-1">
                                            <i class="fas fa-microphone-alt mr-3 text-warning"></i>
                                            Record Label
                                        </div><div class="col-1">
                                            <p>:</p>
                                        </div>
                                        <div class="col-7">
                                            <p><?php echo $row["label"]; ?></p>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-3 offset-1">
                                            <i class="far fa-calendar-alt mr-2 text-primary"></i>
                                            Release date
                                        </div>
                                        <div class="col-1">
                                            <p>:</p>
                                        </div>
                                        <div class="col-7">
                                            <p><?php echo $row["tgl_rilis"]; ?></p>
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
                <div class="row mt-5 mb-5">
                <div class="col-12">
                    <div class="card card-chart">
                    <div class="card-header ">
                        <div class="row ml-3 mr-3 mt-4"><?php
                            $query = "SELECT * from lagu l inner join artis a on a.id_artis=l.id_artis where l.id_genre=$_GET[id] order by l.tgl_rilis desc";
                            $result = mysqli_query($con, $query);
                            if (mysqli_num_rows($result) > 0){
                                $index = 1;
                                while($row = mysqli_fetch_assoc($result)){
                                    $id_lagu = $row["id_lagu"];
                                    ?>
                                    <div class="col-3" id=<?php echo $row["id_lagu"]; ?>>
                                    <div class="card data">
                                    <div class="text-right p-0" style="position:absolute; right:-8px;">
                                        <a href='?module=&act=edit&id_lagu=<?php echo $id_lagu; ?>' class='btn btn-success pr-3 pl-3 mt-0'><i class="fas fa-edit"></i></a><br>
                                        <a href='$proses/actionDeleteBarang.php?id=$id_label' class='btn btn-danger pl-3 pr-3 mt-0'><i class='far fa-trash-alt'></i></a>
                                    </div>
                                    <a href="content.php?module=genre&act=detailLagu&id=<?php echo $_GET["id"]; ?>&id_lagu=<?php echo $row["id_lagu"]; ?>">
                                        <img class="card-img-top" width="100%" height="30%" src="images/cover/<?php echo $row["cover"]; ?>" alt="Card image cap">
                                    </a>
                                        <div class="card-body text-center">
                                            <h5 class="card-title m-0"><strong><?php echo $row["judul"]; ?></strong></h5>
                                            <p class="card-text m-0"><?php echo $row["nama"]; ?></p>
                                        </div>
                                    </div>
                                </div>
                                    <?php ;
                                }
                            }else{
                                ?><div class="col-12 text-center mb-5">Empty</div><?php
                            }
                            mysqli_close($con);

                            ?>
                        </div>
                    </div>
                </div>
            </div>
                <div class="row">
                    <?php include "player.php"; ?>
                </div>
            <?php 
                break;
                
            case 'add': ?>
                <h3>Add New Genre</h3>
                <form action="<?php echo $proses; ?>?module=genre&act=input" enctype="multipart/form-data" method="POST" class="ml-5">
                    <div class="form-row">      
                        <div class="form-group col-md-4">
                            <label for="judul">Name</label>
                            <input type="text" class="form-control" name="nama" placeholder="Name" required>
                        </div>
                        <div class="col-md-4">
                            <label for="gambar">Cover</label>
                            <input type="file" class="form-control" id="gambar" name="gambar" required>
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
                    $edit=mysqli_query($con,"select * from genre where id_genre=$_GET[id]");
                    $data=mysqli_fetch_assoc($edit);
                ?>
                    <h3>Edit Genre</h3>
                    <div class="row">
                    <div class="col-8">
                        <form action="<?php echo $proses; ?>?module=genre&act=update" enctype="multipart/form-data" method="POST" class="ml-5">
                        <div class="form-row">      
                            <div class="form-group col-md-5">
                                <label for="nama">Name</label>
                                <input type="text" class="form-control" name="nama" value="<?php echo $data["nama"]; ?>" placeholder="Name" required>
                                <input type="hidden" name="id_genre" value="<?php echo $data["id_genre"]; ?>">
                            </div>
                            <div class="col-md-5">
                                <label for="gambar">Cover</label>
                                <input type="file" class="form-control" id="gambar" name="gambar">
                                <input type="hidden" class="form-control" name="gambar_lama" value="<?php echo $data["gambar"]; ?>">
                            </div>
                        </div>
                        <div class="form-row mt-5">
                            <div class="col-md-10 text-right">
                                <button type="reset" class="btn btn-warning">Reset</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                        </form>
                    </div>

                    <div class="col-3">
                        <div class="col-12" id=<?php echo $data["id_genre"]; ?>>
                        <img class="card-img-top" width="100%" height="30%" src="images/cover/<?php echo $data["gambar"]; ?>" alt="Card image cap">
                            <div class="card-body text-center">
                                <h5 class="card-title m-0"><strong><?php echo $data["nama"]; ?></strong></h5>
                            </div>
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