<?php error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

$result=mysqli_query($con,"select count(id_playlist) from playlist where id_user='$_SESSION[id]'");
$row=mysqli_fetch_assoc($result);
$totalPlaylistMu=$row["count(id_playlist)"];

$result1=mysqli_query($con,"select count(id_playlist) from playlist");
$row1=mysqli_fetch_assoc($result1);
$totalPlaylist=$row["count(id_playlist)"];

?>
<?php
$proses='proses/prosesPlaylist.php';
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
                    <h2 class="mt-3">Daftar Playlist</h2>
                </div>
                <div class="col-6 text-right">
                    <a href="?module=artis&act=tambah" class="btn btn-primary mt-3"><i class="fas fa-plus"></i></a>
                </div>
            </div>

        <div class="row">
        <div class="col-12">
            <div class="card card-chart">
              <div class="card-header ">
                <div class="row">
                  <div class="col-sm-6 text-left">
                    <h5 class="card-category">Playlist Mu</h5>
                    <h3 class="card-title"><i class="fas fa-thumbs-up text-primary mr-2"></i><?php echo $totalPlaylistMu; ?></h3>
                  </div>
                </div>
                <div class="row ml-3 mr-3">
                    <div class="col-12">
                        <table id="playlist" class="table table-stripped text-center mt-3" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Playlist</th>
                                    <th>Tanggal Buat</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $query = "select * from playlist where id_user=$_SESSION[id] order by tgl_buat desc";
                            $result = mysqli_query($con, $query);
                            if (mysqli_num_rows($result) > 0){
                                $index = 1;
                                while($row = mysqli_fetch_assoc($result)){
                                    $id_playlist = $row["id_playlist"];
                                    ?>
                                    <tr>
                                        <td><?php echo $index++; ?></td>
                                        <td><?php echo $row["nama"]; ?></td>
                                        <td><?php echo $row["tgl_buat"]; ?></td>
                                        <td>
                                            <a href='?module=album&act=edit&id=<?php echo $id_album; ?>' class='btn btn-success pr-3 pl-3 mt-0'><i class="fas fa-edit"></i></a>
                                            <a href='$proses/actionDeleteBarang.php?id=$id_label' class='btn btn-danger pl-3 pr-3 mt-0'><i class='far fa-trash-alt'></i></a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            mysqli_close($con); 
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <script>
                    $(document).ready(function() {
                        $('#playlist').DataTable({
                            "lengthMenu":[5,10,15,20],
                            "pageLength":5
                        });

                    } );
                </script>
              </div>
            </div>
        </div>
        </div>
        
        <div class="row">
            <div class="col-12">
                    <div class="card card-chart">
                    <div class="card-header ">
                        <div class="row">
                            <div class="col-sm-6 text-left">
                                <h5 class="card-category">Semua Artis</h5>
                                <h3 class="card-title"><i class="fas fa-users text-success mr-2"></i><?php echo $totalArtis; ?></h3>
                            </div>
                        </div>
                        <div class="row ml-3 mr-3"><?php
                           $query = "SELECT * FROM artis order by id_artis desc";
                            $result = mysqli_query($con, $query);
                            if (mysqli_num_rows($result) > 0){
                                $index = 1;
                                while($row = mysqli_fetch_assoc($result)){
                                    $id_artis = $row["id_artis"];
                                    ?>
                                    <div class="col-3" id=<?php echo $row["id_artis"]; ?>>
                                        <div class="card data">
                                        <div class="text-right p-0" style="position:absolute; right:-8px;">
                                            <a href='?module=artis&act=edit&id=<?php echo $id_artis; ?>' class='btn btn-success pr-3 pl-3 mt-0'><i class="fas fa-edit"></i></a><br>
                                            <a href='$proses/actionDeleteBarang.php?id=$id_label' class='btn btn-danger pl-3 pr-3 mt-0'><i class='far fa-trash-alt'></i></a>
                                        </div>
                                        <a href="?module=artis&act=detail&id=<?php echo $id_artis; ?>">
                                            <img class="card-img-top" width="100%" height="30%" src="images/artis/<?php echo $row["foto"]; ?>" alt="Card image cap">
                                        </a>
                                                <div class="card-body text-center">
                                                <h5 class="card-title m-0"><strong><?php echo $row["nama"]; ?></strong></h5>
                                                <?php
                                                    $subscribe=mysqli_query($con,"select * from subscription where id_user=$_SESSION[id] and id_artis=$row[id_artis]");
                                                    if(mysqli_num_rows($subscribe)>0){
                                                        ?><a href="#" class="btn btn-primary mt-3 pl-4 pr-4 pt-2 pb-2">Disubscribe</a><?php 
                                                    }
                                                    else{
                                                        ?><a href="#" class="btn btn-primary mt-3 pl-4 pr-4 pt-2 pb-2">Subscribe</a><?php
                                                    }
                                                    ?>
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
                $detail=mysqli_query($con,"select a.*, b.nama as lagu from detail_playlist a, lagu b where a.id_lagu=b.id_lagu and a.id_playlist=$_GET[id] and a.id_user=$_SESSION[id]");
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
                        <img class="card-img-top" width="100%" height="230px" src="images/artis/<?php echo $data["foto"]; ?>" alt="Card image cap">
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
                            if(mysqli_num_rows($lagu)>0){
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
                        }
                        else{
                            echo "Lagu belum tersedia";
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
