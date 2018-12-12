<?php error_reporting(E_ALL ^ (E_NOTICE | E_WARNING)); ?>

<?php
$proses='proses/prosesArtis.php';
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
                <h2 class="mt-3">Daftar Artis</h2>
            </div>
            <div class="col-6 text-right">
                <a href="?module=artis&act=tambah" class="btn btn-primary mt-3"><i class="fas fa-plus"></i></a>
            </div>
        </div>
            <div class="row">
                <div class="col-12">
                    <div class="card card-chart">
                    <div class="card-header ">
                        <div class="row p-5"><?php
                           $query = "SELECT * FROM artis order by id_artis desc";
                            $result = mysqli_query($con, $query);
                            if (mysqli_num_rows($result) > 0){
                                $index = 1;
                                while($row = mysqli_fetch_assoc($result)){
                                    $id_artis = $row["id_artis"];
                                    ?>
                                    <div class="col-3" id=<?php echo $row["id_artis"]; ?>>
                                        <div class="card data">
                                        <div class="text-right p-0" style="position:absolute; right:0;">
                                            <a href='$proses/actionDeleteBarang.php?id=$id_label' class='btn btn-danger pl-3 pr-3'><i class='far fa-trash-alt'></i></a>
                                        </div>
                                        <a href="?module=artis&act=detail&id=<?php echo $id_artis; ?>">
                                            <img class="card-img-top" width="100%" height="30%" src="images/artis/<?php echo $row["foto"]; ?>" alt="Card image cap">
                                        </a>
                                                <div class="card-body text-center">
                                                    <h5 class="card-title m-0"><strong><?php echo $row["judul"]; ?></strong></h5>
                                                    <p class="card-text m-0"><?php echo $row["nama"]; ?></p>
                                                    <a href="#" class="btn btn-primary mt-3 pl-4 pr-4 pt-2 pb-2">PLAY</a>
                                                    <a href='?module=artis&act=edit&id=<?php echo $id_artis; ?>' class='btn btn-success mt-3 pl-4 pr-4 pt-2 pb-2'>EDIT</i></a>
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
                $detail=mysqli_query($con,"select * from artis where id_artis=$_GET[id]");
                $data=mysqli_fetch_assoc($detail);
                ?>

                <div class="row">
                    <div class="col-6">
                        <h2 class="mt-3"><?php echo $data["nama"]; ?></h2>
                    </div>
                </div>
                <div class="row mr-5 ml-5">
                    <div class="col-3">
                        <div class="row">
                        <img class="card-img-top" width="100%" src="images/artis/<?php echo $data["foto"]; ?>" alt="Card image cap">
                            <div class="card-body">
                                <p class="card-text"><i class="fas fa-music mr-2 text-primary"></i>
                                <?php echo $data["total_lagu"]; ?> lagu</p>
                                <p class="card-text"><i class="fas fa-dot-circle mr-2 text-success"></i>
                                <?php echo $data["total_album"]; ?> album</p>
                                <p class="card-text mt-3"><?php echo $data["info"]; ?></p>
                            </div>
                        </div>
                        </div>

                        <div class="col-7 ml-5">
                            <h3 class="mb-3">Lagu Terbaru</h3>
                            <?php 
                            $lagu=mysqli_query($con,"select a.*, b.*, b.cover as lagu from artis a, lagu b where a.id_artis = b.id_artis and a.id_artis=$_GET[id] order by b.tgl_rilis desc limit 15");
                            while($row=mysqli_fetch_assoc($lagu)){
                                ?>
                                    <div class="row mb-3">
                                        <div class="col-1 mt-3 text-right">
                                            <i class="fas fa-play ml-3 text-secondary"></i>
                                        </div>
                                        <div class="col-2 text-right"><img src="images/cover/<?php echo $row["lagu"]; ?>" width="80%">
                                        </div>
                                        <div class="col-8">
                                            <p class="text-white"><?php echo $row["judul"]; ?></p>
                                            <?php 
                                                $album=mysqli_fetch_assoc(mysqli_query($con, "select * from album where id_album=$row[id_album]"));
                                        
                                            if($row["id_album"]==0){ ?>
                                                    <p class="mt-0" style="font-size:12">-</p>
                                                    <?php
                                                }
                                            ?>
                                            <p class="mt-0" style="font-size:12"><?php echo $album["nama"]; ?></p>
                                            <hr class="m-0 border-secondary">
                                        </div>
                                        <div class="col-1 text-left">
                                            <p style="margin-top:30px; margin-left:-20px;"><?php echo $row["durasi"]; ?></p>
                                        </div>
                                    </div>
                            <?php
                            }
                            ?>
                        </div>
                </div>
            <?php
                break;

            case 'tambah': ?>
                <h3>Tambah Artis</h3>
                <form action="<?php echo $proses; ?>?module=artis&act=input" enctype="multipart/form-data" method="POST" class="ml-5">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" name="nama" placeholder="Nama" required>
                        </div>
                        <div class="col-md-4">
                            <label for="foto">Foto</label>
                            <input type="file" class="form-control" id="foto" name="foto" required>
                        </div>
                    </div>
                    <div class="form-row mt-3">
                        <div class="form-group col-md-6">
                            <label for="info">Info</label>
                            <textarea name="info" class="form-control" required></textarea>
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
                    $edit=mysqli_query($con,"select * from artis where id_artis=$_GET[id]");
                    $data=mysqli_fetch_assoc($edit);
                ?>
                
                <h3>Edit Artis</h3>

                <div class="row">
                    <div class="col-8">
                        <form action="<?php echo $proses; ?>?module=artis&act=input" enctype="multipart/form-data" method="POST" class="ml-5">
                            <div class="form-row">
                                <div class="form-group col-md-5">
                                <input type="hidden" class="form-control" name="id_artis" value="<?php echo $data["id_artis"]; ?>">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" name="nama" value="<?php echo $data["nama"]; ?>" placeholder="Nama" required>
                                </div>
                                <div class="col-md-5">
                                    <label for="foto">Foto</label>
                                    <input type="file" class="form-control" id="foto" name="foto">
                                </div>
                            </div>
                            <div class="form-row mt-3">
                                <div class="form-group col-md-10">
                                    <label for="info">Info</label>
                                    <textarea name="info" class="form-control" required><?php echo $data["info"]; ?></textarea>
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
                        <div class="col-12" id=<?php echo $data["id_artis"]; ?>>
                        <img class="card-img-top" width="100%" height="30%" src="images/artis/<?php echo $data["foto"]; ?>" alt="Card image cap">
                            <div class="card-body text-center">
                                <h5 class="card-title mb-2"><strong><?php echo $data["nama"]; ?></strong></h5>
                                <p class="card-text mb-0"><?php echo $data["total_lagu"]; ?> lagu</p>
                                <p class="card-text"><?php echo $data["total_album"]; ?> album</p>
                            </div>
                    </div>
                </div>
                
            <?php 
            }
            ?>
