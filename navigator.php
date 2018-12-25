<?php
$level=$_SESSION["level"];
if($level=="admin" or $level=="label" or $level=="user"){
    
    if($level=="label"){
        $id=mysqli_query($con,"select id_label from label where id_user=$_SESSION[id]");
        $data=mysqli_fetch_assoc($id);
        $id_label=$data["id_label"];
    }

    if($level=="label"){
        $result1=mysqli_query($con,"select count(id_lagu) from lagu where id_label=$id_label");
        $row1=mysqli_fetch_assoc($result1);
        $totalLagu=$row1["count(id_lagu)"];
    }
    else{
        $result1=mysqli_query($con,"select count(id_lagu) from lagu");
        $row1=mysqli_fetch_assoc($result1);
        $totalLagu=$row1["count(id_lagu)"];
    }

    if($level=="label"){
        $result2=mysqli_query($con,"select count(id_album) from album where flag='1' and id_label=$id_label");
        $row2=mysqli_fetch_assoc($result2);
        $totalAlbum=$row2["count(id_album)"];
    }
    else{
        $result2=mysqli_query($con,"select count(id_album) from album where flag='1'");
        $row2=mysqli_fetch_assoc($result2);
        $totalAlbum=$row2["count(id_album)"];
    }
    

    $result3=mysqli_query($con,"select count(id_genre) from genre where flag='1'");
    $row3=mysqli_fetch_assoc($result3);
    $totalGenre=$row3["count(id_genre)"];

    $result4=mysqli_query($con,"select count(id_artis) from artis where flag='1'");
    $row4=mysqli_fetch_assoc($result4);
    $totalArtis=$row4["count(id_artis)"];

    $result5=mysqli_query($con,"select count(id_label) from label where flag='1'");
    $row5=mysqli_fetch_assoc($result5);
    $totalLabel=$row5["count(id_label)"];

    $result6=mysqli_query($con,"select count(id_user) from user where level='user'");
    $row6=mysqli_fetch_assoc($result6);
    $totalUser=$row6["count(id_user)"];

    $result7=mysqli_query($con,"select count(a.id_artis)from subscription a, artis b where a.id_user='$_SESSION[id]' and b.flag='1' and a.id_artis=b.id_artis");
    $row7=mysqli_fetch_assoc($result7);
    $totalSubscribe=$row7["count(a.id_artis)"];

?>

    <?php
    if ($_GET['module']=='home'){
        ?>
        <div class="row">
            <div class="col-12">
                <div class="card card-chart">
                <div class="card-header ">
                    <div class="row">
                    <div class="col-sm-6 text-left">
                        <h5 class="card-category">Your Subscription</h5>
                        <h3 class="card-title"><i class="fas fa-thumbs-up text-primary mr-2"></i><?php echo $totalSubscribe; ?></h3>
                    </div>
                    </div>
                    <div class="row ml-3 mr-3"><?php
                        $query = "select a.*, b.nama as artis, b.foto from subscription a, artis b where a.id_artis=b.id_artis and a.id_user=$_SESSION[id] and b.flag='1' order by a.id_artis desc";
                        $result = mysqli_query($con, $query);
                        if (mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_assoc($result)){
                                $id_artis = $row["id_artis"];
                                ?>
                                <div class="col-3" id=<?php echo $row["id_artis"]; ?>>
                                    <div class="card data m-0">
                                    <a href="?module=artis&act=detail&id=<?php echo $id_artis; ?>">
                                        <img class="card-img-top" width="100%" height="30%" src="images/artis/<?php echo $row["foto"]; ?>" alt="Card image cap">
                                    </a>
                                            <div class="card-body text-center">
                                                <h5 class="card-title m-0"><strong><?php echo $row["artis"]; ?></strong></h5>
                                                <?php
                                                    $subscribe=mysqli_query($con,"select * from subscription where id_user=$_SESSION[id] and id_artis=$row[id_artis]");
                                                    if(mysqli_num_rows($subscribe)>0){
                                                        ?><a href="<?php echo $proses?>?module=artis&act=disubscribe&id=<?php echo $row["id_artis"]; ?>" class="btn btn-primary mt-3 pl-4 pr-4 pt-2 pb-2">Disubscribe</a><?php  
                                                    }
                                                    else{
                                                        ?><a href="<?php echo $proses?>?module=artis&act=subscribe&id=<?php echo $row["id_artis"]; ?>" class="btn btn-primary mt-3 pl-4 pr-4 pt-2 pb-2">Subscribe</a><?php
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php ;
                                }
                                ?> <div class="col-12 text-right mb-3">
                                    <a href="?module=artis" class="btn btn-primary btn-simple mt-3 pl-4 pr-4 pt-2 pb-2">More</a>
                                </div>
                                <?php
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
                        <?php 
                        if($level=="label"){ ?>
                            <h5 class="card-category">Your Song</h5>
                        <?php 
                        }else{ ?>
                            <h5 class="card-category">New Release</h5>
                        <?php
                        }
                        ?>
                        <h3 class="card-title"><i class="fas fa-music text-primary mr-2"></i><?php echo $totalLagu; ?></h3>
                    </div>
                    </div>
                    <div class="row ml-3 mr-3"><?php
                                if($level=="label"){
                                    $query="SELECT * from lagu l inner join artis a on a.id_artis=l.id_artis where l.id_label=$id_label order by l.tgl_rilis desc limit 4";
                                }
                                else{
                                    $query = "SELECT * from lagu l inner join artis a on a.id_artis=l.id_artis order by l.tgl_rilis desc limit 4";
                                }
                                $result = mysqli_query($con, $query);
                                if (mysqli_num_rows($result) > 0){
                                    $index = 1;
                                    while($row = mysqli_fetch_assoc($result)){
                                        $id_lagu = $row["id_lagu"];
                                        ?>
                                        <div class="col-3" id=<?php echo $row["id_lagu"]; ?>>
                                        <div class="card data m-0">
                                        <a href="?module=lagu&act=detail&id_lagu=<?php echo $row["id_lagu"]; ?>">
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
                                    ?> 
                                    <div class="col-12 text-right mb-3">
                                        <a href="?module=lagu" class="btn btn-primary btn-simple mt-3 pl-4 pr-4 pt-2 pb-2">More</a>
                                    </div>
                                <?php
                                }else{
                                    ?><div class="col-12 mb-5 text-center">Empty</div><?php
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
                    <?php 
                        if($level=="label"){ ?>
                            <h5 class="card-category">Your Album</h5>
                        <?php 
                        }else{ ?>
                            <h5 class="card-category">New Album</h5>
                        <?php
                        }
                        ?>
                        <h3 class="card-title"><i class="fas fa-dot-circle text-success mr-2"></i><?php echo $totalAlbum; ?></h3>
                    </div>
                    </div>
                    <div class="row ml-3 mr-3"><?php
                                if($level=="label"){
                                    $query = "SELECT a.*, b.nama as 'artis' FROM album a, artis b where a.id_artis=b.id_artis and a.flag='1' and a.id_label=$id_label order by a.tgl_rilis desc limit 4";
                                }
                                else{
                                    $query = "SELECT a.*, b.nama as 'artis' FROM album a, artis b where a.id_artis=b.id_artis and a.flag='1' order by a.tgl_rilis desc limit 4";
                                }
                                $result = mysqli_query($con, $query);
                                if (mysqli_num_rows($result) > 0){
                                    $index = 1;
                                    while($row = mysqli_fetch_assoc($result)){
                                        $id_album = $row["id_album"];
                                        ?>
                                        <div class="col-3" id=<?php echo $row["id_album"]; ?>>
                                        <div class="card data m-0">
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
                                    ?> 
                                    <div class="col-12 text-right mb-3">
                                        <a href="?module=album" class="btn btn-primary btn-simple mt-3 pl-4 pr-4 pt-2 pb-2">More</a>
                                    </div>
                                    <?php
                                }else{
                                    ?><div class="col-12 mb-5 text-center">Empty</div><?php
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
                        <h5 class="card-category">New Artist</h5>
                        <h3 class="card-title"><i class="fas fa-users text-warning mr-2"></i><?php echo $totalArtis; ?></h3>
                    </div>
                    </div>
                    <div class="row ml-3 mr-3"><?php
                                $query = "SELECT * FROM artis where flag='1' order by id_artis desc limit 4";
                                $result = mysqli_query($con, $query);
                                if (mysqli_num_rows($result) > 0){
                                    $index = 1;
                                    while($row = mysqli_fetch_assoc($result)){
                                        $id_album = $row["id_artis"];
                                        ?>
                                        <div class="col-3" id=<?php echo $row["id_artis"]; ?>>
                                        <div class="card data m-0">
                                        <a href="?module=artis&act=detail&id=<?php echo $id_artis; ?>">
                                        <img class="card-img-top" width="100%" height="30%"  src="images/artis/<?php echo $row["foto"];?>" alt="Cover Image">
                                        </a>
                                            <div class="card-body text-center">
                                                <h5 class="card-title m-0"><strong><?php echo $row["nama"]; ?></strong></h5><?php
                                                    $subscribe=mysqli_query($con,"select * from subscription where id_user=$_SESSION[id] and id_artis=$row[id_artis]");
                                                    if(mysqli_num_rows($subscribe)>0){
                                                        ?><a href="<?php echo $proses?>?module=artis&act=disubscribe&id=<?php echo $row["id_artis"]; ?>" class="btn btn-primary mt-3 pl-4 pr-4 pt-2 pb-2">Disubscribe</a><?php  
                                                    }
                                                    else{
                                                        ?><a href="<?php echo $proses?>?module=artis&act=subscribe&id=<?php echo $row["id_artis"]; ?>" class="btn btn-primary mt-3 pl-4 pr-4 pt-2 pb-2">Subscribe</a><?php
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                        <?php ;
                                    }
                                    ?> 
                                    <div class="col-12 text-right mb-3">
                                        <a href="?module=artis" class="btn btn-primary btn-simple mt-3 pl-4 pr-4 pt-2 pb-2">More</a>
                                    </div>
                                    <?php
                                }else{
                                    ?><div class="col-12 mb-5 text-center">Empty</div><?php
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
                        <h5 class="card-category">Genre</h5>
                        <h3 class="card-title"><i class="fab fa-gratipay text-primary mr-2"></i><?php echo $totalGenre; ?></h3>
                    </div>
                    </div>
                    <div class="row ml-3 mr-3"><?php
                                $query = "SELECT * FROM genre where flag='1' limit 4";
                                $result = mysqli_query($con, $query);
                                if (mysqli_num_rows($result) > 0){
                                    $index = 1;
                                    while($row = mysqli_fetch_assoc($result)){
                                        $id_genre = $row["id_genre"];
                                        ?>
                                        <div class="col-3" id=<?php echo $row["id_genre"]; ?>>
                                        <div class="card data m-0">
                                        <a href="?module=genre&act=detail&id=<?php echo $id_genre; ?>">
                                        <img class="card-img-top" width="100%" height="30%" src="images/cover/<?php echo $row["gambar"];?>" alt="Cover Image">
                                        </a>
                                            <div class="card-body text-center">
                                                <h5 class="card-title m-0"><strong><?php echo $row["nama"]; ?></strong></h5>
                                            </div>
                                        </div>
                                    </div>
                                        <?php ;
                                    }
                                    ?> 
                                    <div class="col-12 text-right mb-3">
                                        <a href="?module=genre" class="btn btn-primary btn-simple mt-3 pl-4 pr-4 pt-2 pb-2">More</a>
                                    </div>
                                    <?php
                                }else{
                                    ?><div class="col-12 mb-5 text-center">Empty</div><?php
                                }
                                ?>
                            </div>
                </div>
                </div>
            </div>
            </div>
            <div class="row text-capitalize">
            <div class="col-6">
                <div class="card card-chart">
                <div class="card-header ">
                    <div class="row">
                    <div class="col-sm-6 text-left">
                        <h5 class="card-category">Record Label</h5>
                        <h3 class="card-title"><i class="fas fa-microphone-alt text-success mr-2"></i><?php echo $totalLabel; ?></h3>
                    </div>
                    </div>
                    <div class="row ml-3 mr-3"><?php
                                $query = "SELECT a.*, b.foto FROM label a, user b where a.id_user=b.id_user and a.flag='1' order by a.id_label desc limit 4";
                                $result = mysqli_query($con, $query);
                                if (mysqli_num_rows($result) > 0){
                                    $index = 1;
                                    while($row = mysqli_fetch_assoc($result)){
                                        $id_label = $row["id_label"];
                                        ?>
                                        <div class="col-3" id=<?php echo $row["id_label"]; ?>>
                                        <div class="card data m-0">
                                        <a href="?module=label&act=detail&id=<?php echo $id_label; ?>">
                                        <img class="card-img-top rounded-circle" width="100%" height="80px" src="images/profil/<?php echo $row["foto"];?>" alt="Cover Image">
                                        </a>
                                            <div class="card-body text-center">
                                                <h5 class="card-title m-0"><strong><?php echo $row["nama"]; ?></strong></h5>
                                            </div>
                                        </div>
                                    </div>
                                        <?php ;
                                    }
                                    ?> 
                                    <div class="col-12 text-right mb-3">
                                        <a href="?module=label" class="btn btn-primary btn-simple mt-3 pl-4 pr-4 pt-2 pb-2">More</a>
                                    </div>
                                    <?php
                                }else{
                                    ?><div class="col-12 mb-5 text-center">Empty</div><?php
                                }
                                ?>
                            </div>
                </div>
                </div>
            </div>

            <?php if($level=="admin"){ ?>
            <div class="col-6 text-capitalize">
                <div class="card card-chart">
                    <div class="card-header ">
                    <div class="row">
                        <div class="col-sm-6 text-left">
                        <h5 class="card-category">All Users</h5>
                        <h3 class="card-title"><i class="fas fa-user text-warning mr-2"></i><?php echo $totalUser; ?></h3>
                        </div>
                    </div>
                    <div class="row ml-3 mr-3"><?php
                                $query = "SELECT * from user where level='user' order by id_user desc limit 4";
                                $result = mysqli_query($con, $query);
                                if (mysqli_num_rows($result) > 0){
                                    $index = 1;
                                    while($row = mysqli_fetch_assoc($result)){
                                        $id_user = $row["id_user"];
                                        ?>
                                        <div class="col-3" id=<?php echo $row["id_user"]; ?>>
                                        <div class="card data m-0">
                                        <a href="?module=user&act=detail&id=<?php echo $id_user; ?>">
                                        <img class="card-img-top rounded-circle" width="100%" height="80px" src="images/profil/<?php echo $row["foto"];?>" alt="Cover Image">
                                        </a>
                                            <div class="card-body text-center">
                                                <h5 class="card-title m-0"><strong><?php echo $row["nama"]; ?></strong></h5>
                                            </div>
                                        </div>
                                    </div>
                                        <?php ;
                                    }
                                    ?> 
                                    <div class="col-12 text-right mb-3">
                                        <a href="?module=user" class="btn btn-primary btn-simple mt-3 pl-4 pr-4 pt-2 pb-2">More</a>
                                    </div>
                                    <?php
                                }else{
                                    ?><div class="col-12 mb-5 text-center">Empty</div><?php
                                }
                                mysqli_close($con);
                                ?>
                            </div>
                    </div>
                </div>
                </div>
            <?php } ?>
            </div>
        <?php
    }

    elseif ($_GET['module']=='lagu'){
        include "tables/lagu.php";
    }

    elseif ($_GET['module']=='label'){
        include "tables/label.php";
    }

    elseif ($_GET['module']=='user'){
        include "tables/user.php";
    }

    elseif ($_GET['module']=='artis'){
        include "tables/artis.php";
    }

    elseif ($_GET['module']=='album'){
        include "tables/album.php";
    }

    elseif ($_GET['module']=='genre'){
        include "tables/genre.php";
    }

    elseif ($_GET['module']=='playlist'){
        include "tables/playlist.php";
    }

    elseif ($_GET['module']=='profil'){
        include "tables/profil.php";
    }
    else{
        echo "<p class=mt-5><b>Page Not Found</b></p>";
    }
}else if($level==""){
    ?><script>alert("Log In First");document.location.href="index.php";</script><?php
}
else{
    ?><script>alert("Access Denied");document.location.href="logout.php";</script><?php
}
?>