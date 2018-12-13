<?php error_reporting(E_ALL ^ (E_NOTICE | E_WARNING)); ?>

<?php
$proses='proses/prosesGenre.php';
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
                    <h2 class="mt-3">Genre Musik</h2>
                </div>
                <div class="col-6 text-right">
                    <a href="?module=genre&act=tambah" class="btn btn-primary mt-3"><i class="fas fa-plus"></i></a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card card-chart">
                    <div class="card-header ">
                        <div class="row ml-3 mr-3 mt-4"><?php
                            $query = "select * from genre order by nama asc";
                            $result = mysqli_query($con, $query);
                            if (mysqli_num_rows($result) > 0){
                                $index = 1;
                                while($row = mysqli_fetch_assoc($result)){
                                    $id_genre = $row["id_genre"];
                                    ?>
                                    <div class="col-3" id=<?php echo $row["id_genre"]; ?>>
                                    <div class="card data">
                                    <div class="text-right p-0" style="position:absolute; right:-8px;">
                                        <a href='?module=genre&act=edit&id=<?php echo $id_genre; ?>' class='btn btn-success pr-3 pl-3 mt-0'><i class="fas fa-edit"></i></a><br>
                                        <a href='$proses/actionDeleteBarang.php?id=$id_label' class='btn btn-danger pl-3 pr-3 mt-0'><i class='far fa-trash-alt'></i></a>
                                    </div>
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
            $detail=mysqli_query($con,"select * from genre where id_genre=$_GET[id]");
            $data=mysqli_fetch_assoc($detail);
            ?>

            <div class="row">
                <div class="col-6">
                    <h2 class="mt-3">Genre <?php echo $data["nama"];?></h2>
                </div>
            </div>
            <div class="row text-capitalize">
                <div class="col-12">
                    <div class="card card-chart">
                    <div class="card-header ">
                        <div class="row">
                        <div class="col-sm-6 text-left">
                            <h5 class="card-category">Semua Lagu</h5>
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
                                            <img class="card-img-top" width="100%" height="30%" src="images/cover/<?php echo $row["cover"];?>" alt="Cover Image">
                                                <div class="card-body text-center">
                                                    <h5 class="card-title m-0"><strong><?php echo $row["judul"]; ?></strong></h5>
                                                    <p class="card-text m-0"><?php echo $row["nama"]; ?></p>
                                                    <a href="#" class="btn btn-primary mt-3 pl-4 pr-4 pt-2 pb-2">PLAY</a>
                                                </div>
                                            </div>
                                        </div>
                                            <?php ;
                                        }
                                    }else{
                                        ?><div class="col-12 text-center">Data Kosong</div><?php
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
                                <h5 class="card-category">Semua Album</h5>
                                <?php
                                    $result2=mysqli_query($con,"select count(id_genre) from album where id_genre=$_GET[id]");
                                    $row2=mysqli_fetch_assoc($result2);
                                    $totalAlbum=$row2["count(id_genre)"];
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
                                                <a href="#" class="btn btn-primary mt-3 pl-4 pr-4 pt-2 pb-2">PLAY</a>
                                            </div>
                                        </div>
                                    </div>
                                        <?php ;
                                    }
                                }else{
                                    ?><div class="col-12 text-center">Data Kosong</div><?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                break;

            case 'tambah': ?>
                <h3>Tambah Genre</h3>
                <form action="<?php echo $proses; ?>?module=genre&act=input" enctype="multipart/form-data" method="POST" class="ml-5">
                    <div class="form-row">      
                        <div class="form-group col-md-4">
                            <label for="judul">Nama</label>
                            <input type="text" class="form-control" name="nama" placeholder="Nama" required>
                        </div>
                        <div class="col-md-4">
                            <label for="gambar">Gambar</label>
                            <input type="file" class="form-control" id="gambar" name="gambar" required>
                        </div>
                    </div>
                    <div class="form-row mt-3">
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
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" name="nama" value="<?php echo $data["nama"]; ?>" placeholder="Nama" required>
                                <input type="hidden" name="id_genre" value="<?php echo $data["id_genre"]; ?>">
                            </div>
                            <div class="col-md-5">
                                <label for="gambar">Gambar</label>
                                <input type="file" class="form-control" id="gambar" name="gambar">
                                <input type="hidden" class="form-control" name="gambar_lama" value="<?php echo $data["gambar"]; ?>">
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
                        <div class="col-12" id=<?php echo $data["id_genre"]; ?>>
                        <img class="card-img-top" width="100%" height="30%" src="images/cover/<?php echo $data["gambar"]; ?>" alt="Card image cap">
                            <div class="card-body text-center">
                                <h5 class="card-title m-0"><strong><?php echo $data["nama"]; ?></strong></h5>
                            </div>
                    </div>
                </div>
                
            <?php 
            }
            ?>