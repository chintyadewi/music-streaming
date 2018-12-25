<?php error_reporting(E_ALL ^ (E_NOTICE | E_WARNING)); ?>

<?php

$level=$_SESSION["level"];
if($level=="label"){
    $id=mysqli_query($con,"select * from label where id_user=$_SESSION[id]");
    $data=mysqli_fetch_assoc($id);
    $id_label=$data["id_label"];
    $namaLabel=$data["nama"];
}

if($level=="admin" or $level=="label" or $level=="user"){
    $proses='proses/prosesAlbum.php';
    switch($_GET["act"]){
        default:
            ?>
            <div class="row">
                <div class="col-6">
                    <h2 class="mt-3">All Album</h2>
                </div>
                <div class="col-6 text-right">
                    <a href="?module=album&act=add" class="btn btn-primary mt-3"><i class="fas fa-plus"></i></a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card card-chart">
                    <div class="card-header ">
                        <div class="row ml-3 mr-3 mt-4">
                            <?php
                            if($level=="label"){
                                $query = "SELECT a.*, a.nama as album, b.nama as artis from album a inner join artis b on a.id_artis=b.id_artis inner join label c on a.id_label=c.id_label inner join genre d on a.id_genre=d.id_genre where a.flag='1' and a.id_label=$id_label order by a.tgl_rilis";
                            }
                            else{
                                $query = "SELECT a.*, a.nama as album, b.nama as artis from album a inner join artis b on a.id_artis=b.id_artis inner join label c on a.id_label=c.id_label inner join genre d on a.id_genre=d.id_genre where a.flag='1' order by a.tgl_rilis";
                            }
                            
                            $result = mysqli_query($con, $query);
                            if (mysqli_num_rows($result) > 0){
                                $index = 1;
                                while($row = mysqli_fetch_assoc($result)){
                                    $id_album = $row["id_album"];
                                    ?>
                                    <div class="col-3" id=<?php echo $row["id_album"]; ?>>
                                    <div class="card data">
                                    <?php
                                    if($level=="admin" or $level=="label"){ ?>                                    
                                    <div class="text-right p-0" style="position:absolute; right:-8px;">
                                        <a href='?module=album&act=edit&id=<?php echo $id_album; ?>' class='btn btn-success pr-3 pl-3 mt-0'><i class="fas fa-edit"></i></a><br>
                                        <a href="<?php echo $proses; ?>?module=album&act=delete&id=<?php echo $id_album; ?>" class='btn btn-danger pl-3 pr-3 mt-0'><i class='far fa-trash-alt'></i></a>
                                    </div>
                                    <?php } ?>
                                    <a href="?module=album&act=detail&id=<?php echo $id_album; ?>">
                                        <img class="card-img-top" width="100%" height="30%" src="images/cover/<?php echo $row["cover"]; ?>" alt="Card image cap">
                                    </a>
                                        <div class="card-body text-center">
                                            <h5 class="card-title mb-2"><strong><?php echo $row["album"]; ?></strong></h5>
                                            <p class="card-text m-0"><?php echo $row["artis"]; ?></p>
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
                $detail=mysqli_query($con,"SELECT a.*, a.nama as album, b.nama as artis from album a inner join artis b on a.id_artis=b.id_artis inner join label c on a.id_label=c.id_label inner join genre d on a.id_genre=d.id_genre and a.id_album=$_GET[id] and a.flag='1'");
                $data=mysqli_fetch_assoc($detail);
                ?>

                <div class="row">
                    <div class="col-6">
                        <h2 class="mt-3"><?php echo $data["nama"]." - ".$data["artis"]; ?></h2>
                    </div>
                </div>
                <div class="row mr-5 ml-5 mb-5">
                    <div class="col-3">
                        <div class="row">
                        <img class="card-img-top" width="100%" height="230px" src="images/cover/<?php echo $data["cover"]; ?>" alt="Card image cap">
                            <div class="card-body">
                                <p class="card-text">
                                    <i class="fas fa-music mr-2 text-primary"></i>
                                    <?php 
                                    $data1=mysqli_fetch_assoc(mysqli_query($con,"select count(id_album) from lagu where id_album=$_GET[id]"));
                                    $total_lagu=$data1["count(id_album)"];
                                        echo $total_lagu; ?> songs
                                </p>
                                <p class="card-text">
                                    <i class="far fa-calendar-alt mr-2 text-success"></i>
                                    <?php echo $data["tgl_rilis"]; ?>
                                </p>
                            </div>
                        </div>
                        </div>

                        <div class="col-8 ml-5 ">
                            <div class="row">
                                <div class="col-6">
                                    <h3>Songs</h3>
                                </div>
                                <div class="col-6 text-right">
                                    <a href="?module=album&act=addDetail&id=<?php echo $data["id_album"]; ?>" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                                </div>
                            </div>
                            <?php 
                            $lagu=mysqli_query($con,"select a.*,b.*, b.cover as coverLagu from album a, lagu b where a.id_album=b.id_album and a.id_album=$_GET[id] and a.flag='1' order by b.tgl_rilis desc");
                            if(mysqli_num_rows($lagu)>0){
                                while($row=mysqli_fetch_assoc($lagu)){
                                    ?>
                                        <div class="row mb-3">
                                        <a href="?module=album&act=detail&id=<?php echo $_GET["id"]; ?>&id_lagu=<?php echo $row["id_lagu"];?>">
                                            <div class="col-1 mt-3 text-right detailPlay">
                                                <i class="fas fa-play ml-3 text-secondary"></i>
                                            </div>
                                        </a>
                                            <div class="col-2 text-right"><img src="images/cover/<?php echo $row["coverLagu"]; ?>" width="80%">
                                            </div>
                                            <div class="col-7">
                                                <p class="text-white"><?php echo $row["judul"]; ?></p>
                                                <p class="mt-0" style="font-size:12"><?php echo $row["nama"]; ?></p>
                                                <hr class="m-0 border-secondary">
                                            </div>
                                            <div class="col-1 text-left">
                                                <p style="margin-top:30px; margin-left:-20px;"><?php echo $row["durasi"]; ?></p>
                                            </div>
                                            <div class="col-1 pt-3" style="margin-left:-20px;">
                                            <a href="<?php echo $proses.'?module=album&act=removeSong&album='.$_GET["id"].'&id='.$row["id_lagu"]; ?>" class='btn btn-danger pl-3 pr-3 m-0'><i class="fas fa-minus"></i></a>
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
                <div class="row">
                    <?php include "player.php"; ?>
                </div>
            <?php
                break;

            case 'addDetail': 
            $detail=mysqli_fetch_assoc(mysqli_query($con, "select a.*,b.*, b.nama as artis from album a, artis b where a.id_artis=b.id_artis and a.id_album=$_GET[id] and a.flag='1'"));?>

            <div class="container mt-3 ">
                <div class="row">
                    <div class="col-5">
                        <div class="row">
                            <h3><?php echo $detail["artis"]; ?>'s Songs</h3>
                        </div>
                        <div class="row">
                            <div class="col-12">
                            <?php
                            if($level=="label"){
                                $lagu=mysqli_query($con,"SELECT * from lagu where id_artis=$detail[id_artis] and isnull(id_album) and id_label=$id_label");
                            }
                            else{
                                $lagu=mysqli_query($con,"SELECT * from lagu where id_artis=$detail[id_artis] and isnull(id_album)");
                            }
                            $lagu=mysqli_query($con,"SELECT * from lagu where id_artis=$detail[id_artis] and isnull(id_album)");
                            if(mysqli_num_rows($lagu)>0){
                                while($row=mysqli_fetch_assoc($lagu)){
                                    ?>
                                        <div class="row mb-3">
                                            <div class="col-3 text-right"><img src="images/cover/<?php echo $row["cover"]; ?>" width="80%">
                                            </div>
                                            <div class="col-7">
                                                <p class="text-white"><?php echo $row["judul"]; ?></p>
                                                <p class="mt-0" style="font-size:12">-</p>
                                                <hr class="m-0 border-secondary">
                                            </div>
                                            <div class="col-1 text-left">
                                                <p style="margin-top:30px; margin-left:-20px;"><?php echo $row["durasi"]; ?></p>
                                            </div>
                                            <div class="col-1 pt-3" style="margin-left:-20px;">
                                                <a href="<?php echo $proses.'?module=album&act=addDetail&album='.$_GET["id"].'&id='.$row["id_lagu"]; ?>" class='btn btn-primary pl-3 pr-3 m-0'><i class="fas fa-plus"></i></a>
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

                    <div class="col-6 offset-1">
                    <div class="row">
                            <h3>Add New Song</h3>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <form action="<?php echo $proses; ?>?module=album&act=inputNew" enctype="multipart/form-data" method="POST">
                                <input type="hidden" name="album" value="<?php echo $_GET["id"]; ?>" id="">
                                <input type="hidden" name="artis" value="<?php echo $detail["id_artis"]; ?>" id="">
                                <input type="hidden" name="label" value="<?php echo $detail["id_label"]; ?>" id="">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="judul">Song Title</label>
                                            <input type="text" class="form-control" id="judul" name="judul" placeholder="Song Title" required>
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label for="tgl_rilis">Release Date</label>
                                            <input type="date" class="form-control" id="tgl_rilis" name="tgl_rilis" data-date-format="DD/MM/YYYY" required>
                                        </div>
                                    </div>
                                    <div class="form-row mt-3">
                                        <div class="form-group col-md-4">                                        
                                            <label for="genre">Genre</label>
                                            <select name=genre class="form-control bg-dark">
                                            <?php 
                                                $genre=mysqli_query($con,"select * from genre where flag='1'");
                                            while($data2=mysqli_fetch_array($genre)){
                                                echo "<option value=$data2[id_genre]>$data2[nama]</option>";
                                            }
                                            ?>
                                            </select>
                                        </div>
                                        <div class="col-md-7">
                                            <label for="label">Song File (*.mp3)</label>
                                            <input type="file" class="form-control" id="file" name="file" required>
                                            <input type="hidden" name='durasi' id='durasi' />
                                            <audio id='audio' hidden></audio>
                                        </div>
                                    </div>
                                        <div class="form-row mt-3">
                                        <div class="col-md-7">
                                            <label for="cover">Song Cover</label>
                                            <input type="file" class="form-control" id="cover" name="cover" required>
                                        </div>
                                    </div>
                                    <div class="form-row mt-5">
                                        <div class="col-md-11 text-right">
                                            <button type="reset" class="btn btn-warning">Reset</button>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                    </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                
                <?php 
            break;

            case 'add': ?>
                <h3>Add New Album</h3>
                <form action="<?php echo $proses; ?>?module=album&act=input" enctype="multipart/form-data" method="POST" class="ml-5">
                    <div class="form-row">      
                        <div class="form-group col-md-4">
                            <label for="judul">Name</label>
                            <input type="text" class="form-control" name="nama" placeholder="Name" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="tgl_rilis">Release Date</label>
                            <input type="date" class="form-control" id="tgl_rilis" name="tgl_rilis" data-date-format="DD/MM/YYYY" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="genre">Genre</label>
                            <select name=genre class="form-control bg-dark">
                            <?php 
                                $genre=mysqli_query($con,"select * from genre where flag='1'");
                            while($data2=mysqli_fetch_array($genre)){
                                echo "<option value=$data2[id_genre]>$data2[nama]</option>";
                            }
                            ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-row mt-3">
                        <div class="form-group col-md-3">
                            <label for="artis">Artist</label>
                            <select name=artis class="form-control bg-dark">
                            <?php 
                            $artis=mysqli_query($con,"select * from artis where flag='1'");
                            while($data2=mysqli_fetch_array($artis)){
                                echo "<option value=$data2[id_artis]>$data2[nama]</option>";
                            }
                            ?>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="label">Record Label</label>
                            <select name="label" class="form-control bg-dark">
                            <?php
                            $label=mysqli_query($con,"select * from label where flag='1'");
                            while($data2=mysqli_fetch_array($label)){
                                echo "<option value=$data2[id_label]>$data2[nama]</option>";
                            }
                            ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-row mt-3">
                        <div class="col-md-4">
                            <label for="cover">Album Cover</label>
                            <input type="file" class="form-control" id="cover" name="cover" required>
                        </div>
                    </div>
                    <div class="form-row mt-3">
                        <div class="col-md-9 text-right">
                            <button type="reset" class="btn btn-warning">Reset</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                    </form>
                <?php 
                break;
                
                case 'edit': 
                    $edit=mysqli_query($con,"select a.*, a.nama as album, b.nama as label, c.nama as genre, d.nama as artis from album a, label b, genre c, artis d where a.id_label=b.id_label and a.id_genre=c.id_genre and a.id_artis=d.id_artis and a.id_album=$_GET[id]");
                    $data=mysqli_fetch_assoc($edit);
                ?>
                    <h3>Edit Album</h3>
                    <div class="row">
                    <div class="col-8">
                        <form action="<?php echo $proses; ?>?module=album&act=update" enctype="multipart/form-data" method="POST" class="ml-5">
                        <div class="form-row">      
                            <div class="form-group col-md-4">
                                <label for="nama">Name</label>
                                <input type="text" class="form-control" name="nama" value="<?php echo $data["album"]; ?>" placeholder="Name" required>
                                <input type="hidden" name="id_album" value="<?php echo $data["id_album"]; ?>">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="tgl_rilis">Release Date</label>
                                <input type="date" class="form-control" id="tgl_rilis" name="tgl_rilis" data-date-format="YYYY/MM/DD" value="<?php echo $data["tgl_rilis"]; ?>" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="genre">Genre</label>
                                <select name=genre class="form-control bg-dark">
                                <?php 
                                echo "<option value=$data[id_genre] selected=selected>$data[genre]</option>";
                                    $genre=mysqli_query($con,"select * from where flag='1'");
                                while($data2=mysqli_fetch_array($genre)){
                                    echo "<option value=$data2[id_genre]>$data2[nama]</option>";
                                }
                                ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-row mt-3">
                            <div class="form-group col-md-3">
                                <label for="artis">Artist</label>
                                <select name=artis class="form-control bg-dark">
                                <?php 
                                echo "<option value=$data[id_artis] selected=selected>$data[artis]</option>";
                                $artis=mysqli_query($con,"select * from artis where flag='1'");
                                while($data2=mysqli_fetch_array($artis)){
                                    echo "<option value=$data2[id_artis]>$data2[nama]</option>";
                                }
                                ?>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="label">Record Label</label>
                                <select name="label" class="form-control bg-dark">
                                <?php
                                echo "<option value=$data[id_label] selected=selected>$data[label]</option>";
                                $label=mysqli_query($con,"select * from label where flag='1'");
                                while($data2=mysqli_fetch_array($label)){
                                    echo "<option value=$data2[id_label]>$data2[nama]</option>";
                                }
                                ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-row mt-3">
                            <div class="col-md-6">
                                <label for="cover">Album Cover</label>
                                <input type="file" class="form-control" id="cover" name="cover">
                                <input type="hidden" class="form-control" name="cover_lama" value="<?php echo $data["cover"]; ?>">
                            </div>
                        </div>
                        <div class="form-row mt-3">
                            <div class="col-md-10 text-right">
                                <button type="reset" class="btn btn-warning">Reset</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                        </form>
                    </div>

                    <div class="col-3">
                        <div class="col-12" id=<?php echo $data["id_album"]; ?>>
                        <img class="card-img-top" width="100%" height="30%" src="images/cover/<?php echo $data["cover"]; ?>" alt="Card image cap">
                            <div class="card-body text-center">
                                <h5 class="card-title m-0"><strong><?php echo $data["nama"]; ?></strong></h5>
                                <p class="card-text m-0"><?php echo $data["artis"]; ?></p>
                                <p class="card-text mt-2"><?php echo $data["label"]; ?></p>
                            </div>
                    </div>
                </div>
                
            <?php 
            }
            ?>

        <script>
            var f_duration =0; //store duration
            document.getElementById('audio').addEventListener('canplaythrough', function(e){
                            //add duration in the input field #f_du
            f_duration = Math.round(e.currentTarget.duration);
            document.getElementById('durasi').value = (f_duration).toFixed(1);
            URL.revokeObjectURL(obUrl);
                            });
            var obUrl;
            document.getElementById('file').addEventListener('change', function(e){
            var file = e.currentTarget.files[0];
            //check file extension for audio/video type
            if(file.name.match(/\.(avi|mp3|mp4|mpeg|ogg)$/i)){
                obUrl = URL.createObjectURL(file);
                document.getElementById('audio').setAttribute('src', obUrl);
            }
            });
        </script>
<?php
}else if($level==""){
  ?><script>alert("Log In First");document.location.href="../index.php";</script><?php
}
else{
  ?><script>alert("Access Denied");document.location.href="../logout.php";</script><?php
}