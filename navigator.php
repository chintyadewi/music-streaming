<?php
    $result1=mysqli_query($con,"select count(id_lagu) from lagu");
    $row1=mysqli_fetch_assoc($result1);
    $totalLagu=$row1["count(id_lagu)"];

    $result2=mysqli_query($con,"select count(id_album) from album");
    $row2=mysqli_fetch_assoc($result2);
    $totalAlbum=$row2["count(id_album)"];

    $result3=mysqli_query($con,"select count(id_genre) from genre");
    $row3=mysqli_fetch_assoc($result3);
    $totalGenre=$row3["count(id_genre)"];

    $result4=mysqli_query($con,"select count(id_artis) from artis");
    $row4=mysqli_fetch_assoc($result4);
    $totalArtis=$row4["count(id_artis)"];

    $result5=mysqli_query($con,"select count(id_label) from label");
    $row5=mysqli_fetch_assoc($result5);
    $totalLabel=$row5["count(id_label)"];

    $result6=mysqli_query($con,"select count(id_user) from user");
    $row6=mysqli_fetch_assoc($result6);
    $totalUser=$row6["count(id_user)"];

    $result7=mysqli_query($con,"select count(id_artis) from subscription where id_user='$_SESSION[id]'");
    $row7=mysqli_fetch_assoc($result7);
    $totalSubscribe=$row7["count(id_artis)"];
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
                    <h5 class="card-category">Subscription</h5>
                    <h3 class="card-title"><i class="fas fa-thumbs-up text-primary mr-2"></i><?php echo $totalSubscribe; ?></h3>
                  </div>
                </div>
                <div class="row ml-3 mr-3"><?php
                    $query = "select a.*, b.nama as artis, b.foto from subscription a, artis b where a.id_artis=b.id_artis and a.id_user=$_SESSION[id] order by a.id_artis desc limit 4";
                    $result = mysqli_query($con, $query);
                    if (mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            $id_artis = $row["id_artis"];
                            ?>
                            <div class="col-3" id=<?php echo $row["id_artis"]; ?>>
                                <div class="card data">
                                <a href="?module=artis&act=detail&id=<?php echo $id_artis; ?>">
                                    <img class="card-img-top" width="100%" height="30%" src="images/artis/<?php echo $row["foto"]; ?>" alt="Card image cap">
                                </a>
                                        <div class="card-body text-center">
                                            <h5 class="card-title m-0"><strong><?php echo $row["artis"]; ?></strong></h5>
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
                    <h5 class="card-category">Semua Lagu</h5>
                    <h3 class="card-title"><i class="fas fa-music text-primary mr-2"></i><?php echo $totalLagu; ?></h3>
                  </div>
                </div>
                <div class="row ml-3 mr-3"><?php
                            $query = "SELECT * from lagu l inner join artis a on a.id_artis=l.id_artis order by l.tgl_rilis desc limit 4";
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
                    <h3 class="card-title"><i class="fas fa-dot-circle text-success mr-2"></i><?php echo $totalAlbum; ?></h3>
                  </div>
                </div>
                <div class="row ml-3 mr-3"><?php
                            $query = "SELECT a.*, b.nama as 'artis' FROM album a, artis b where a.id_artis=b.id_artis order by a.tgl_rilis desc limit 4";
                            $result = mysqli_query($con, $query);
                            if (mysqli_num_rows($result) > 0){
                                $index = 1;
                                while($row = mysqli_fetch_assoc($result)){
                                    $id_album = $row["id_album"];
                                    ?>
                                    <div class="col-3" id=<?php echo $row["id_album"]; ?>>
                                    <div class="card data">
                                    <img class="card-img-top" width="100%" height="30%"  src="images/cover/<?php echo $row["cover"];?>" alt="Cover Image">
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
        <div class="row text-capitalize">
          <div class="col-12">
            <div class="card card-chart">
              <div class="card-header ">
                <div class="row">
                  <div class="col-sm-6 text-left">
                    <h5 class="card-category">Artis</h5>
                    <h3 class="card-title"><i class="fas fa-users text-warning mr-2"></i><?php echo $totalArtis; ?></h3>
                  </div>
                </div>
                <div class="row ml-3 mr-3"><?php
                            $query = "SELECT * FROM artis order by id_artis desc limit 4";
                            $result = mysqli_query($con, $query);
                            if (mysqli_num_rows($result) > 0){
                                $index = 1;
                                while($row = mysqli_fetch_assoc($result)){
                                    $id_album = $row["id_artis"];
                                    ?>
                                    <div class="col-3" id=<?php echo $row["id_artis"]; ?>>
                                    <div class="card data">
                                    <img class="card-img-top" width="100%" height="30%"  src="images/artis/<?php echo $row["foto"];?>" alt="Cover Image">
                                        <div class="card-body text-center">
                                            <h5 class="card-title m-0"><strong><?php echo $row["nama"]; ?></strong></h5>
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
                    <h5 class="card-category">Semua Genre</h5>
                    <h3 class="card-title"><i class="fab fa-gratipay text-primary mr-2"></i><?php echo $totalGenre; ?></h3>
                  </div>
                </div>
                <div class="row ml-3 mr-3"><?php
                            $query = "SELECT * FROM genre limit 4";
                            $result = mysqli_query($con, $query);
                            if (mysqli_num_rows($result) > 0){
                                $index = 1;
                                while($row = mysqli_fetch_assoc($result)){
                                    $id_genre = $row["id_genre"];
                                    ?>
                                    <div class="col-3" id=<?php echo $row["id_genre"]; ?>>
                                    <div class="card data">
                                    <img class="card-img-top" width="100%" height="30%" src="images/cover/<?php echo $row["gambar"];?>" alt="Cover Image">
                                        <div class="card-body text-center">
                                            <h5 class="card-title m-0"><strong><?php echo $row["nama"]; ?></strong></h5>
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
        <div class="col-6">
            <div class="card card-chart">
              <div class="card-header ">
                <div class="row">
                  <div class="col-sm-6 text-left">
                    <h5 class="card-category">Label</h5>
                    <h3 class="card-title"><i class="fas fa-microphone-alt text-success mr-2"></i><?php echo $totalLabel; ?></h3>
                  </div>
                </div>
                <div class="row ml-3 mr-3"><?php
                            $query = "SELECT a.*, b.foto FROM label a, user b where a.id_user=b.id_user order by a.id_label desc limit 4";
                            $result = mysqli_query($con, $query);
                            if (mysqli_num_rows($result) > 0){
                                $index = 1;
                                while($row = mysqli_fetch_assoc($result)){
                                    $id_genre = $row["id_label"];
                                    ?>
                                    <div class="col-3" id=<?php echo $row["id_label"]; ?>>
                                    <div class="card data">
                                    <img class="card-img-top rounded-circle" width="100%" height="80px" src="images/profil/<?php echo $row["foto"];?>" alt="Cover Image">
                                        <div class="card-body text-center">
                                            <h5 class="card-title m-0"><strong><?php echo $row["nama"]; ?></strong></h5>
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
          <div class="col-6 text-capitalize">
              <div class="card card-chart">
                <div class="card-header ">
                  <div class="row">
                    <div class="col-sm-6 text-left">
                      <h5 class="card-category">User</h5>
                      <h3 class="card-title"><i class="fas fa-user text-warning mr-2"></i><?php echo $totalUser; ?></h3>
                    </div>
                  </div>
                  <div class="row ml-3 mr-3"><?php
                              $query = "SELECT * from user where level='user' order by id_user desc limit 4";
                              $result = mysqli_query($con, $query);
                              if (mysqli_num_rows($result) > 0){
                                  $index = 1;
                                  while($row = mysqli_fetch_assoc($result)){
                                      $id_genre = $row["id_user"];
                                      ?>
                                      <div class="col-3" id=<?php echo $row["id_user"]; ?>>
                                      <div class="card data">
                                      <img class="card-img-top rounded-circle" width="100%" height="80px" src="images/profil/<?php echo $row["foto"];?>" alt="Cover Image">
                                          <div class="card-body text-center">
                                              <h5 class="card-title m-0"><strong><?php echo $row["nama"]; ?></strong></h5>
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

elseif ($_GET['module']=='laporan'){
	include "modul/mod_laporan/laporan.php";
}

elseif ($_GET['module']=='dt_nilai'){
	include "modul/mod_nilai/nilai.php";
}
elseif ($_GET['module']=='dt_nilaisiswa'){
	include "modul/mod_transaksi/nilaisiswa.php";
}

elseif ($_GET['module']=='dt_lihatnilai'){
	include "modul/mod_nilai/lihat_nilai.php";
}
elseif ($_GET['module']=='dt_siswalihat'){
	include "modul/mod_siswa_lihat/siswa_lihat.php";
}
elseif ($_GET['module']=='dt_lihatguru'){
	include "modul/mod_siswa_lihat/lihat_guru.php";
}
elseif ($_GET['module']=='dt_nilaimurid'){
	include "modul/mod_wali_murid/nilai_murid.php";
}
elseif ($_GET['module']=='dt_gurumurid'){
	include "modul/mod_wali_murid/guru_murid.php";
}
elseif ($_GET['module']=='dt_user'){
	include "modul/mod_user/user.php";
}
elseif ($_GET['module']=='dt_profil'){
	include "modul/mod_profil/profil.php";
}
elseif ($_GET['module']=='backup'){
	include "modul/mod_database/backup.php";
}
elseif ($_GET['module']=='restore'){
	include "modul/mod_database/restore.php";
}
else{
	echo "<p><b>MODUL BELUM ADA ATAU BELUM LENGKAP</b></p>";
}

?>