<?php error_reporting(E_ALL ^ (E_NOTICE | E_WARNING)); ?>

<?php
$proses='proses/prosesAlbum.php';
switch($_GET["act"]){
    default:
            /***** Get get error message from actionAddBarang.php ******/
            $message = '';
            if(isset($_GET["error"])) {
                $message = $_GET["error"];
                echo "
                <p style='color:red; font-style:italic'>$message</p>
                ";
            }
            ?>
            <div class="row">
            <div class="col-6">
                <h2 class="mt-3">Daftar Album</h2>
            </div>
            <div class="col-6 text-right">
                <a href="?module=album&act=tambah" class="btn btn-primary mt-3"><i class="fas fa-plus"></i></a>
            </div>
        </div>
            <div class="row">
                <div class="col-12">
                    <div class="card card-chart">
                    <div class="card-header ">
                        <div class="row p-5"><?php
                            $query = "SELECT a.*, a.nama as album, b.nama as artis from album a inner join artis b on a.id_artis=b.id_artis inner join label c on a.id_label=c.id_label inner join genre d on a.id_genre=d.id_genre order by a.tgl_rilis desc limit 8";
                            $result = mysqli_query($con, $query);
                            if (mysqli_num_rows($result) > 0){
                                $index = 1;
                                while($row = mysqli_fetch_assoc($result)){
                                    $id_album = $row["id_album"];
                                    ?>
                                    <div class="col-3" id=<?php echo $row["id_album"]; ?>>
                                    <div class="card data">
                                    <div class="text-right p-0" style="position:absolute; right:0;">
                                        <a href='$proses/actionDeleteBarang.php?id=$id_label' class='btn btn-danger pl-3 pr-3'><i class='far fa-trash-alt'></i></a>
                                    </div>
                                    <a href="?module=album&act=detail&id=<?php echo $id_album; ?>">
                                    <img class="card-img-top" width="100%" height="30%" src="images/cover/<?php echo $row["cover"]; ?>" alt="Card image cap">
                                    </a>
                                        <div class="card-body text-center">
                                            <h5 class="card-title mb-2"><strong><?php echo $row["album"]; ?></strong></h5>
                                            <p class="card-text m-0"><?php echo $row["artis"]; ?></p>
                                            <a href="#" class="btn btn-primary mt-3 pl-4 pr-4 pt-2 pb-2">PLAY</a>
                                            <a href='?module=album&act=edit&id=<?php echo $id_album; ?>' class='btn btn-success mt-3 pl-4 pr-4 pt-2 pb-2'>EDIT</i></a>
                                        </div>
                                    </div>
                                </div>
                                    <?php ;
                                }
                            }else{
                                ?><div class="col-12 text-center">Data Kosong</div><?php
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
                $detail=mysqli_query($con,"SELECT a.*, a.nama as album, b.nama as artis from album a inner join artis b on a.id_artis=b.id_artis inner join label c on a.id_label=c.id_label inner join genre d on a.id_genre=d.id_genre and a.id_album=$_GET[id]");
                $data=mysqli_fetch_assoc($detail);
                ?>

                <div class="row">
                    <div class="col-6">
                        <h2 class="mt-3"><?php echo $data["nama"]." - ".$data["artis"]; ?></h2>
                    </div>
                </div>
                <div class="row mr-5 ml-5">
                    <div class="col-3">
                        <div class="row">
                        <img class="card-img-top" width="100%" height="230px" src="images/cover/<?php echo $data["cover"]; ?>" alt="Card image cap">
                            <div class="card-body">
                                <p class="card-text">
                                    <i class="fas fa-music mr-2 text-primary"></i>
                                    <?php 
                                    $data1=mysqli_fetch_assoc(mysqli_query($con,"select count(id_album) from lagu where id_album=$_GET[id]"));
                                    $total_lagu=$data1["count(id_album)"];
                                        echo $total_lagu; ?> lagu
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
                                    <h3>Lagu</h3>
                                </div>
                                <div class="col-6 text-right">
                                    <a href="?module=album&act=tambahDetail&id=<?php echo $data["id_album"]; ?>" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                                </div>
                            </div>
                            <?php 
                            $lagu=mysqli_query($con,"select a.*,b.*, b.cover as coverLagu from album a, lagu b where a.id_album=b.id_album and a.id_album=$_GET[id] order by b.tgl_rilis desc");
                            while($row=mysqli_fetch_assoc($lagu)){
                                ?>
                                    <div class="row mb-3">
                                        <div class="col-1 mt-3 text-right">
                                            <i class="fas fa-play ml-3 text-secondary"></i>
                                        </div>
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
                                            <a href='$proses/actionDeleteBarang.php?id=$id_label' class='btn btn-danger pl-3 pr-3 m-0'><i class="fas fa-minus"></i></a>
                                        </div>
                                    </div>
                            <?php
                            }
                            ?>
                        </div>
                </div>
            <?php
                break;

            case 'tambahDetail': 
            $detail=mysqli_fetch_assoc(mysqli_query($con, "select a.*,b.*, b.nama as artis from album a, artis b where a.id_artis=b.id_artis and a.id_album=$_GET[id]"));?>

            <div class="container mt-3 ">
                <div class="row">
                    <div class="col-4">
                        <div class="row">
                            <h3>Lagu <?php echo $detail["artis"]; ?></h3>
                        </div>
                        <div class="row">
                            <div class="col-12">
                            <?php
                            $lagu=mysqli_query($con,"SELECT * from lagu where id_artis=$detail[id_artis] and id_album=0");
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
                                            <a href="<?php echo $proses.'?module=album&act=tambahDetail&album='.$_GET["id"].'&id='.$row["id_lagu"]; ?>" class='btn btn-primary pl-3 pr-3 m-0'><i class="fas fa-plus"></i></a>
                                        </div>
                                    </div>
                            <?php
                            } ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-7 offset-1">
                    <div class="row">
                            <h3>Tambah lagu baru</h3>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <form action="<?php echo $proses; ?>?module=album&act=inputNew" enctype="multipart/form-data" method="POST">
                                <input type="hidden" name="album" value="<?php echo $_GET["id"]; ?>" id="">
                                <input type="hidden" name="artis" value="<?php echo $detail["id_artis"]; ?>" id="">
                                <input type="hidden" name="label" value="<?php echo $detail["id_label"]; ?>" id="">
                                    <div class="form-row">
                                        <div class="form-group col-md-5">
                                            <label for="judul">Judul</label>
                                            <input type="text" class="form-control" id="judul" name="judul" placeholder="Judul" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="tgl_rilis">Tanggal Rilis</label>
                                            <input type="date" class="form-control" id="tgl_rilis" name="tgl_rilis" data-date-format="DD/MM/YYYY" required>
                                        </div>
                                        <div class="form-group col-md-3">                                        
                                            <label for="genre">Genre</label>
                                            <select name=genre class="form-control bg-dark">
                                            <?php 
                                                $genre=mysqli_query($con,"select * from genre");
                                            while($data2=mysqli_fetch_array($genre)){
                                                echo "<option value=$data2[id_genre]>$data2[nama]</option>";
                                            }
                                            ?>
                                            </select>
                                        </div>
                                    </div>
                                      <div class="form-row mt-3">
                                        <div class="col-md-6">
                                            <label for="label">File</label>
                                            <input type="file" class="form-control" id="file" name="file" required>
                                            <input type="hidden" name='durasi' id='durasi' />
                                            <audio id='audio' hidden></audio>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="cover">Cover</label>
                                            <input type="file" class="form-control" id="cover" name="cover" required>
                                        </div>
                                    </div>
                                    <div class="form-row mt-3">
                                        <div class="col-md-12 text-right">
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
            
            case 'tambah': ?>
                <h3>Tambah Album</h3>
                <form action="<?php echo $proses; ?>?module=album&act=input" enctype="multipart/form-data" method="POST" class="ml-5">
                    <div class="form-row">      
                        <div class="form-group col-md-4">
                            <label for="judul">Nama</label>
                            <input type="text" class="form-control" name="nama" placeholder="Nama" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="tgl_rilis">Tanggal Rilis</label>
                            <input type="date" class="form-control" id="tgl_rilis" name="tgl_rilis" data-date-format="DD/MM/YYYY" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="genre">Genre</label>
                            <select name=genre class="form-control bg-dark">
                            <?php 
                                $genre=mysqli_query($con,"select * from genre");
							while($data2=mysqli_fetch_array($genre)){
								echo "<option value=$data2[id_genre]>$data2[nama]</option>";
                            }
                            ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-row mt-3">
                        <div class="form-group col-md-3">
                            <label for="artis">Artis</label>
                            <select name=artis class="form-control bg-dark">
                            <?php 
                            $artis=mysqli_query($con,"select * from artis");
							while($data2=mysqli_fetch_array($artis)){
								echo "<option value=$data2[id_artis]>$data2[nama]</option>";
                            }
                            ?>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="label">Label</label>
                            <select name="label" class="form-control bg-dark">
                            <?php
                            $label=mysqli_query($con,"select * from label");
							while($data2=mysqli_fetch_array($label)){
								echo "<option value=$data2[id_label]>$data2[nama]</option>";
                            }
                            ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-row mt-3">
                        <div class="col-md-4">
                            <label for="cover">Cover</label>
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
                    $edit=mysqli_query($con,"select a.*, b.*, b.nama as genre, c.*,c.nama as artis, d.*, d.nama as label, e.*, e.nama as album from lagu a, genre b, artis c, label d, album e where a.id_genre=b.id_genre and a.id_artis=c.id_artis and a.id_label=d.id_label and a.id_album=e.id_album and a.id_lagu=$_GET[id]");
                    $data=mysqli_fetch_assoc($edit);
                ?>
                <h3>Edit Lagu</h3>

                <div class="row">
                    <div class="col-8">
                    <form action="<?php echo $proses; ?>?module=lagu&act=update" enctype="multipart/form-data" method="POST" class="ml-5">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="judul">Judul</label>
                            <input type="hidden" class="form-control" name="id_lagu" value="<?php echo $data['id_lagu']; ?>">
                            <input type="text" class="form-control" id="judul" value="<?php echo $data["judul"];?>" name="judul" placeholder="Judul" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="tgl_rilis">Tanggal Rilis</label>
                            <input type="date" class="form-control" id="tgl_rilis" value="<?php echo $data["tgl_rilis"];?>" name="tgl_rilis" data-date-format="YYYY/MM/DD" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="genre">Genre</label>
                            <select name=genre class="form-control bg-dark">
                            <?php 
                                echo "<option value=$data[id_genre] selected=selected>$data[genre]</option>";
                                $genre=mysqli_query($con,"select * from genre");
							while($data2=mysqli_fetch_array($genre)){
								echo "<option value=$data2[id_genre]>$data2[nama]</option>";
                            }
                            ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-row mt-3">
                        <div class="form-group col-md-3">
                            <label for="artis">Artis</label>
                            <input type="hidden" name="artis_lama" value="<?php echo $data["id_artis"]; ?>">
                            <select name=artis class="form-control bg-dark">
                            <?php 
                                echo "<option value=$data[id_artis] selected=selected>$data[artis]</option>";
                                $artis=mysqli_query($con,"select * from artis");
							while($data2=mysqli_fetch_array($artis)){
								echo "<option value=$data2[id_artis]>$data2[nama]</option>";
                            }
                            ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="label">Album</label>
                                <select name="album" class="form-control bg-dark">
                                <?php 
                                    echo "<option value=$data[id_album] selected=selected>$data[album] - $data[artis]</option>";
                                    $album=mysqli_query($con,"select a.*, b.nama as artis from album a, artis b where a.id_artis=b.id_artis");
                                    echo "<option value=0>No Album</option>";
                                while($data2=mysqli_fetch_array($album)){
                                    echo "<option value=$data2[id_album]>$data2[nama] - $data2[artis]</option>";
                                }
                                ?>
                                </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="label">Label</label>
                            <select name="label" class="form-control bg-dark">
                            <?php 
                                echo "<option value=$data[id_label] selected=selected>$data[label]</option>";
                                $label=mysqli_query($con,"select * from label");
							while($data2=mysqli_fetch_array($label)){
								echo "<option value=$data2[id_label]>$data2[nama]</option>";
                            }
                            ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-row mt-3">
                        <div class="col-md-4">
                            <label for="label">File</label>
                            <input type="file" class="form-control" id="file" name="file" value="<?php echo $data["file"];?>" >
                            <input type="hidden" name='durasi' id='durasi' />
                            <audio id='audio' hidden></audio>
                            <input type="hidden" name="file_lama" value="<?php echo $data["file"] ?>">
                        </div>
                        <div class="col-md-4">
                            <label for="cover">Cover</label>
                            <input type="file" class="form-control" id="cover" name="cover"  value="<?php echo $data["cover"];?>">
                            <input type="hidden" name="cover_lama" value="<?php echo $data["cover"] ?>">
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
                        <div class="col-12" id=<?php echo $data["id_lagu"]; ?>>
                        <img class="card-img-top" width="100%" height="30%" src="images/cover/<?php echo $data["cover"]; ?>" alt="Card image cap">
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