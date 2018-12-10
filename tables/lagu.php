<?php error_reporting(E_ALL ^ (E_NOTICE | E_WARNING)); ?>

<?php
$proses='proses/prosesLagu.php';
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
            <div class="row text-right">
                <div class="col-12">
                    <a href="?module=lagu&act=tambahlagu" class="btn btn-primary mt-3">Plus</a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card card-chart">
                    <div class="card-header ">
                        <div class="row p-5"><?php
                            $query = "SELECT * from lagu l inner join artis a on a.id_artis=l.id_artis order by l.tgl_rilis desc limit 8";
                            $result = mysqli_query($con, $query);
                            if (mysqli_num_rows($result) > 0){
                                $index = 1;
                                while($row = mysqli_fetch_assoc($result)){
                                    $id_lagu = $row["id_lagu"];
                                    ?>
                                    <div class="col-3" id=<?php echo $row["id_lagu"]; ?>>
                                    <div class="card data">
                                    <img class="card-img-top" width="100%" height="30%" src="images/cover/<?php echo $row["cover"]; ?>" alt="Card image cap">
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
                            mysqli_close($con);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
                break; 

            case 'tambahlagu': ?>
                <h3>Tambah Lagu</h3>
                <form action="$proses?module=lagu&act=input" enctype="multipart/form-data" method="POST" class="ml-5">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="judul">Judul</label>
                            <input type="text" class="form-control" id="judul" name="judul" placeholder="Judul" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="tgl_rilis">Tanggal Rilis</label>
                            <input type="date" class="form-control" id="tgl_rilis" name="tgl_rilis" data-date-format="YYYY/MM/DD" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="genre">Genre</label>
                        <select name=genre class="form-control bg-dark">
							<?php $genre=mysqli_query($con,"select * from genre");
							while($data=mysqli_fetch_array($genre)){
								echo "<option value=$data[id_genre]>$data[nama]</option>";
                            }
                            ?>
                        </select>
                        </div>
                    </div>
                    <div class="form-row mt-3">
                        <div class="form-group col-md-2">
                            <label for="genre">Artis</label>
                            <select name=genre class="form-control bg-dark">
                                <?php $artis=mysqli_query($con,"select * from artis");
                                while($data=mysqli_fetch_array($artis)){
                                    echo "<option value=$data[id_artis]>$data[nama]</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="file">File Lagu</label>
                            <input type="file" class="form-control" id="file" name="file" placeholder="" required>
                        </div>
                    </div>
                    <div class="form-row mt-3">
                        <div class="col-md-4">
                            <label for="cover">File Lagu</label>
                            <input type="file" class="form-control" id="cover" name="cover" placeholder="" required>
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

            }
            ?>
