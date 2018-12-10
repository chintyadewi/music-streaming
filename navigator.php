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
                    <h5 class="card-category">Semua Lagu</h5>
                    <h3 class="card-title"><i class="fas fa-music text-primary mr-2"></i><?php echo $totalLagu; ?></h3>
                  </div>
                </div>
                <div class="row ml-3 mr-3"><?php
                            $query = "SELECT * from lagu l inner join artis a on a.id_artis=l.id_artis limit 8";
                            $result = mysqli_query($con, $query);
                            if (mysqli_num_rows($result) > 0){
                                $index = 1;
                                while($row = mysqli_fetch_assoc($result)){
                                    $id_barang = $row["id_lagu"];
                                    ?>
                                    <div class="col-3" id=<?php echo $row["cover"]; ?>>
                                    <div class="card lagu">
                                    <img class="card-img-top" src="images/cover/<?php echo $row["cover"];?>" alt="Cover Image">
                                        <div class="card-body text-center">
                                            <h5 class="card-title m-0"><strong><?php echo $row["judul"]; ?></strong></h5>
                                            <p class="card-text m-0"><?php echo $row["id_artis"]; ?></p>
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
        <div class="row">
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
                            $query = "SELECT * FROM album limit 8";
                            $result = mysqli_query($con, $query);
                            if (mysqli_num_rows($result) > 0){
                                $index = 1;
                                while($row = mysqli_fetch_assoc($result)){
                                    $id_barang = $row["id_album"];
                                    ?>
                                    <div class="col-3" id=<?php echo $row["cover"]; ?>>
                                    <div class="card lagu">
                                    <img class="card-img-top" src="images/cover/<?php echo $row["cover"];?>" alt="Cover Image">
                                        <div class="card-body text-center">
                                            <h5 class="card-title m-0"><strong><?php echo $row["nama"]; ?></strong></h5>
                                            <p class="card-text m-0"><?php echo $row["id_artis"]; ?></p>
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
        <div class="row">
          <div class="col-6">
            <div class="card card-chart">
              <div class="card-header ">
                <div class="row">
                  <div class="col-sm-6 text-left">
                    <h5 class="card-category">Semua Genre</h5>
                    <h3 class="card-title"><i class="fas fa-dot-circle text-success mr-2"></i><?php echo $totalGenre; ?></h3>
                  </div>
                </div>
                <div class="row ml-3 mr-3"><?php
                            $query = "SELECT * FROM genre limit 8";
                            $result = mysqli_query($con, $query);
                            if (mysqli_num_rows($result) > 0){
                                $index = 1;
                                while($row = mysqli_fetch_assoc($result)){
                                    $id_barang = $row["id_album"];
                                    ?>
                                    <div class="col-3" id=<?php echo $row["cover"]; ?>>
                                    <div class="card lagu">
                                    <img class="card-img-top" src="images/cover/<?php echo $row["cover"];?>" alt="Cover Image">
                                        <div class="card-body text-center">
                                            <h5 class="card-title m-0"><strong><?php echo $row["nama"]; ?></strong></h5>
                                            <p class="card-text m-0"><?php echo $row["id_artis"]; ?></p>
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
        </div>
    
	<?php
}

elseif ($_GET['module']=='lagu'){
	include "tables/lagu.php";
}

elseif ($_GET['module']=='label'){
	include "tables/label.php";
}

elseif ($_GET['module']=='dt_wali'){
	include "modul/mod_wali/wali.php";
}

elseif ($_GET['module']=='dt_kd'){
	include "modul/mod_kd/kd.php";
}

elseif ($_GET['module']=='dt_sk'){
	include "modul/mod_sk/sk.php";
}

elseif ($_GET['module']=='dt_bidangstu'){
	include "modul/mod_bidangstu/bidangstu.php";
}

elseif ($_GET['module']=='dt_kompke'){
	include "modul/mod_kompke/kompke.php";
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