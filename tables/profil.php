<?php error_reporting(E_ALL ^ (E_NOTICE | E_WARNING)); 

$level=$_SESSION["level"];
if($level=="admin" or $level=="label" or $level=="user"){

    $result1=mysqli_query($con,"select count(id_playlist) from playlist where id_user=$_SESSION[id]");
    $row1=mysqli_fetch_assoc($result1);
    $totalPlaylist=$row1["count(id_playlist)"];

    $result2=mysqli_query($con,"select count(id_subscribe) from subscription where id_user=$_SESSION[id]");
    $row2=mysqli_fetch_assoc($result2);
    $totalSubscription=$row2["count(id_subscribe)"];

    ?>

    <?php
    $proses='proses/prosesProfil.php';
    switch($_GET["act"]){
        default:
            ?>
            <div class="row">
                <div class="col-6">
                    <h2 class="mt-3">Your Profile</h2>
                </div>
            </div>
            <div class="row">
            <div class="col-7 card">
                    <div class="row ml-3 mr-3">
                    <?php
                        $query = "SELECT * from user where id_user=$_SESSION[id]";
                        $result = mysqli_query($con, $query);
                        if (mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_assoc($result)){
                                $id_user = $row["id_user"];
                                ?>
                                <div class="col-11 mt-4" id=<?php echo $row["id_user"]; ?>>
                                <div class="row">
                                <div class="col-5">
                                <form action="<?php echo $proses; ?>?module=profil&act=updateFoto" method="POST" enctype="multipart/form-data" id="formFoto">
                                    <img class="card-img-top rounded-circle" width="100%" height="170px" src="images/profil/<?php echo $row["foto"];?>" alt="Cover Image">
                                    
                                    <label for="foto" class="btn btn-primary p-3" style="position:absolute; right:5; bottom:24%;">
                                        <i class="fas fa-camera"></i>
                                        <input type="file" name="foto" id="foto" style="display:none;">
                                    </label>
                                    <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
                                    <input type="hidden" name="foto_lama" value="<?php echo $row["foto"]; ?>">
                                </form>
                                </div>
                                <div class="col-6 ml-4">
                                    <div class="row">
                                        <div class="col-12">
                                            <h4 class="card-title mb-2 text-capitalize"><strong><?php echo $row["nama"]; ?></strong></h4>
                                            <p class="ml-3 mt-4 mb-0">
                                                <i class="fas fa-at text-primary mr-2"></i><?php echo $row["username"]; ?>
                                            </p>
                                            <p class="ml-3 mb-2">
                                            <i class="far fa-envelope text-success mr-2"></i><?php echo $row["email"]; ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-11 pt-3 offset-1 border-top border-secondary">
                                            <div class="row">
                                                <div class="col-5">
                                                    <h5><i class="fas fa-list-ul text-warning mr-2"></i>Playlist</h5>
                                                    <h2 class="ml-4"><?php echo $totalPlaylist; ?></h2>
                                                </div>
                                                <div class="col-7">
                                                    <h5><i class="far fa-bell text-primary mr-2"></i>Subscription</h5>
                                                    <h2 class="ml-4"></i><?php echo $totalSubscription; ?></h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                    <?php ;
                                }
                            }else{
                                ?><div class="col-12 text-center mb-5">Empty</div><?php
                            }
                            ?>
                        </div>
                </div>
                </div>
                <div class="col-4 ml-5">
                    <div class="row">
                        <div class="col-12">
                            <h4>Edit Profile</h2>
                        </div>
                        <div class="col-10">
                            <form class="form-signin" action="<?php echo $proses; ?>?module=profil&act=update" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id_user" class="form-control" value="<?php echo $id_user; ?>">
                                <div class="form-group mb-3">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text border-0 mr-2">
                                        <i class="far fa-user"></i>
                                    </span>
                                    <input type="text" name="nama" class="form-control" placeholder="name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text border-0 mr-2">
                                        <i class="fas fa-at"></i>
                                    </span>
                                    <input type="text" name="username" class="form-control" placeholder="username">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text border-0 mr-2">
                                        <i class="fas fa-key"></i>
                                    </span>
                                    <input type="password" name="password" class="form-control" placeholder="password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text border-0 mr-2">
                                        <i class="far fa-envelope"></i>
                                    </span>
                                    <input type="email" name="email" class="form-control" placeholder="email">
                                    </div>
                                </div>
                                <div class="form-row mt-3">
                                    <div class="col-md-12 text-right">
                                        <button class="btn btn-primary" type="submit" name="submit">Submit</button>
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
                }
            ?>

                
            <script>
                document.getElementById("foto").onchange = function() {
                    document.getElementById("formFoto").submit();
                }
            </script>
<?php
}else if($level==""){
  ?><script>alert("Log In First");document.location.href="../index.php";</script><?php
}
else{
  ?><script>alert("Access Denied");document.location.href="../logout.php";</script><?php
}