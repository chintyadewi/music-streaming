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
    $proses='proses/prosesLagu.php';
    switch($_GET["act"]){
        default:
            ?>
            <div class="row">
                <div class="col-6">
                    <h2 class="mt-3">All Songs</h2>
                </div>
                <div class="col-6 text-right">
                    <a href="?module=lagu&act=add" class="btn btn-primary mt-3"><i class="fas fa-plus"></i></a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card card-chart">
                    <div class="card-header ">
                        <div class="row ml-3 mr-3 mt-4"><?php
                            if($level=="label"){
                                $query = "SELECT * from lagu l inner join artis a on a.id_artis=l.id_artis where l.id_label=$id_label order by l.tgl_rilis desc";
                            }
                            else{
                                $query = "SELECT * from lagu l inner join artis a on a.id_artis=l.id_artis order by l.tgl_rilis desc";
                            }
                           
                            $result = mysqli_query($con, $query);
                            if (mysqli_num_rows($result) > 0){
                                $index = 1;
                                while($row = mysqli_fetch_assoc($result)){
                                    $id_lagu = $row["id_lagu"];
                                    ?>
                                    <div class="col-3" id=<?php echo $row["id_lagu"]; ?>>
                                    <div class="card data">
                                    <?php
                                    if($level=="admin" or $level=="label"){ ?> 
                                    <div class="text-right p-0" style="position:absolute; right:-8px;">
                                        <a href='?module=lagu&act=edit&id_lagu=<?php echo $id_lagu; ?>' class='btn btn-success pr-3 pl-3 mt-0'><i class="fas fa-edit"></i></a><br>
                                        <a href="<?php echo $proses; ?>?module=lagu&act=delete&id=<?php echo $id_lagu; ?>" class='btn btn-danger pl-3 pr-3 mt-0'><i class='far fa-trash-alt'></i></a>
                                    </div>
                                    <?php } ?>
                                    <a href="content.php?module=lagu&act=detail&id_lagu=<?php echo $row["id_lagu"]; ?>">
                                    <img class="card-img-top" width="100%" height="200px" src="images/cover/<?php echo $row["cover"]; ?>" alt="Card image cap">
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
            <?php 
                break; 

            case 'detail':

                $detail=mysqli_query($con,"select a.*, b.nama as artis, c.nama as label, d.nama as genre from lagu a, artis b, label c, genre d where a.id_artis=b.id_artis and a.id_label=c.id_label and a.id_genre=d.id_genre and a.id_lagu=$_GET[id_lagu]");
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
                            $lagu=mysqli_query($con,"select *, b.nama as label, c.nama as artis, d.nama as genre from lagu a inner join label b on a.id_label=b.id_label inner join artis c on a.id_artis=c.id_artis inner join genre d on a.id_genre=d.id_genre where a.id_lagu=$_GET[id_lagu]");
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
                            $query = "SELECT * from lagu l inner join artis a on a.id_artis=l.id_artis order by l.tgl_rilis desc";
                            $result = mysqli_query($con, $query);
                            if (mysqli_num_rows($result) > 0){
                                $index = 1;
                                while($row = mysqli_fetch_assoc($result)){
                                    $id_lagu = $row["id_lagu"];
                                    ?>
                                    <div class="col-3" id=<?php echo $row["id_lagu"]; ?>>
                                    <div class="card data">
                                        <div class="text-right p-0" style="position:absolute; right:-8px;">
                                            <a href='?module=lagu&act=edit&id_lagu=<?php echo $id_lagu; ?>' class='btn btn-success pr-3 pl-3 mt-0'><i class="fas fa-edit"></i></a><br>
                                            <a href="<?php echo $proses; ?>?module=lagu&act=delete&id=<?php echo $id_lagu; ?>" class='btn btn-danger pl-3 pr-3 mt-0'><i class='far fa-trash-alt'></i></a>
                                        </div>
                                        <a href="?module=lagu&act=detail&id_lagu=<?php echo $row["id_lagu"]; ?>">
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
                <h3>Add New Song</h3>
                <form action="<?php echo $proses; ?>?module=lagu&act=input" enctype="multipart/form-data" method="POST" class="ml-5">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="judul">Song Title</label>
                            <input type="text" class="form-control" id="judul" name="judul" placeholder="Title" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="tgl_rilis">Release Date</label>
                            <input type="date" class="form-control" id="tgl_rilis" name="tgl_rilis" data-date-format="YYYY/MM/DD" required>
                        </div>
                        <div class="form-group col-md-3">
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
                        <div class="col-md-4">
                            <label for="label">Album</label>
                                <select name="album" class="form-control bg-dark">
                                <option value="null">No Album</option>
                                <?php 
                                if($level=="label"){
                                    $album=mysqli_query($con,"select a.*, b.nama as artis from album a, artis b where a.id_artis=b.id_artis and a.flag='1' and a.id_label=$id_label");
                                }
                                else{
                                    $album=mysqli_query($con,"select a.*, b.nama as artis from album a, artis b where a.id_artis=b.id_artis and a.flag='1'");
                                }
                                while($data2=mysqli_fetch_array($album)){
                                    echo "<option value=$data2[id_album]>$data2[nama] - $data2[artis]</option>";
                                }
                                ?>
                                </select>
                        </div>
                        <?php 
                        if($level=="label"){ ?>
                            <div class="form-group col-md-3">
                            <input type="hidden" name="label" value="<?php echo $namaLabel; ?>">
                            </div>
                        <?php
                        }else{ ?>
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
                        <?php
                        }
                        ?>
                    </div>
                    <div class="form-row mt-3">
                        <div class="col-md-4">
                            <label for="label">Song File (*.mp3)</label>
                            <input type="file" class="form-control" id="file" name="file" required>
                            <input type="hidden" name='durasi' id='durasi' />
                            <audio id='audio' hidden></audio>
                        </div>
                        <div class="col-md-4">
                            <label for="cover">Song Cover</label>
                            <input type="file" class="form-control" id="cover" name="cover" required>
                        </div>
                    </div>
                    <div class="form-row mt-5">
                        <div class="col-md-10 text-right">
                            <button type="reset" class="btn btn-warning">Reset</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                    </form>
                <?php 
                break;
                
                case 'edit': 
                    $edit=mysqli_query($con,"select a.*, b.*, a.cover as coverLagu, b.nama as genre,c.nama as artis, d.nama as label from lagu a, genre b, artis c, label d where a.id_genre=b.id_genre and a.id_artis=c.id_artis and a.id_label=d.id_label and a.id_lagu='$_GET[id_lagu]'");
                    $data=mysqli_fetch_assoc($edit);
                ?>
                <h3>Edit Song</h3>

                <div class="row">
                    <div class="col-8">
                    <form action="<?php echo $proses; ?>?module=lagu&act=update" enctype="multipart/form-data" method="POST" class="ml-5">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="judul">Song Title</label>
                            <input type="hidden" class="form-control" name="id_lagu" value="<?php echo $data['id_lagu']; ?>">
                            <input type="text" class="form-control" id="judul" value="<?php echo $data["judul"];?>" name="judul" placeholder="Judul" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="tgl_rilis">Release Date</label>
                            <input type="date" class="form-control" id="tgl_rilis" value="<?php echo $data["tgl_rilis"];?>" name="tgl_rilis" data-date-format="YYYY/MM/DD" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="genre">Genre</label>
                            <select name=genre class="form-control bg-dark">
                            <?php 
                                echo "<option value=$data[id_genre] selected=selected>$data[genre]</option>";
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
                            <input type="hidden" name="artis_lama" value="<?php echo $data["id_artis"]; ?>">
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
                        <?php 
                        if($level=="label"){ ?>
                            <div class="form-group col-md-3">
                            <input type="hidden" name="label" value="<?php echo $namaLabel; ?>">
                            </div>
                        <?php
                        }else{ ?>
                            <div class="form-group col-md-3">
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
                        <?php } ?>
                    </div>
                    <div class="form-row mt-3">
                        <div class="col-md-4">
                            <label for="label">Song File</label>
                            <input type="file" class="form-control" id="file" name="file" value="<?php echo $data["file"];?>" >
                            <input type="hidden" name='durasi' id='durasi' />
                            <audio id='audio' hidden></audio>
                            <input type="hidden" name="file_lama" value="<?php echo $data["file"] ?>">
                        </div>
                        <div class="col-md-4">
                            <label for="cover">Song Cover</label>
                            <input type="file" class="form-control" id="cover" name="cover"  value="<?php echo $data["cover"];?>">
                            <input type="hidden" name="cover_lama" value="<?php echo $data["cover"] ?>">
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
                        <div class="col-12" id=<?php echo $data["id_lagu"]; ?>>
                        <img class="card-img-top" width="100%" height="30%" src="images/cover/<?php echo $data["coverLagu"]; ?>" alt="Card image cap">
                            <div class="card-body text-center">
                                <h5 class="card-title m-0"><strong><?php echo $data["judul"]; ?></strong></h5>
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
                document.getElementById('durasi').value = (f_duration/60).toFixed(1);
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