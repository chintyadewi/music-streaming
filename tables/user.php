<?php error_reporting(E_ALL ^ (E_NOTICE | E_WARNING)); 

$level=$_SESSION["level"];
if($level=="admin"){

    $result1=mysqli_query($con,"select count(id_user) from user where level='admin'");
    $row1=mysqli_fetch_assoc($result1);
    $totalAdmin=$row1["count(id_user)"];

    $result2=mysqli_query($con,"select count(id_user) from user where level='label'");
    $row2=mysqli_fetch_assoc($result2);
    $totalLabel=$row2["count(id_user)"];

    $result3=mysqli_query($con,"select count(id_user) from user where level='user'");
    $row3=mysqli_fetch_assoc($result3);
    $totalUser=$row3["count(id_user)"];

    ?>

    <?php
    $proses='proses/prosesUser.php';
    switch($_GET["act"]){
        default:
            ?>
            <div class="row">
                <div class="col-6">
                    <h2 class="mt-3">All Users</h2>
                </div>
                <div class="col-6 text-right">
                    <a href="?module=user&act=add" class="btn btn-primary mt-3"><i class="fas fa-plus"></i></a>
                </div>
            </div>
            <div class="row">
            <div class="col-12">
                <div class="card card-chart">
                <div class="card-header ">
                    <div class="row">
                    <div class="col-sm-6 text-left">
                        <h5 class="card-category">Admin</h5>
                        <h3 class="card-title"><i class="fas fa-user-cog text-primary mr-2"></i><?php echo $totalAdmin; ?></h3>
                    </div>
                    </div>
                    <div class="row ml-3 mr-3 mb-5"><?php
                        $query = "SELECT * from user where level='admin' order by id_user desc";
                        $result = mysqli_query($con, $query);
                        if (mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_assoc($result)){
                                $id_user = $row["id_user"];
                                ?>
                                <div class="col-6 mt-4" id=<?php echo $row["id_user"]; ?>>
                                <div class="row">
                                <div class="col-4">
                                <img class="card-img-top rounded-circle" width="100%" height="125px" src="images/profil/<?php echo $row["foto"];?>" alt="Cover Image">
                                </div>
                                <div class="col-8">
                                    <h4 class="card-title mb-2 text-capitalize"><strong><?php echo $row["nama"]; ?></strong></h4>
                                    <p class="ml-3 mb-0"><?php echo $row["username"]; ?></p>
                                        <p class="ml-3 mb-2"><?php echo $row["email"]; ?></p>
                                        <a href='?module=user&act=edit&id=<?php echo $id_user; ?>' class='btn btn-success pl-4 pr-4 ml-3'><i class='fas fa-edit'></i></a>
                                        <a href="<?php echo $proses; ?>?module=user&act=delete&id=<?php echo $id_user; ?>" class='btn btn-danger pl-4 pr-4'><i class='far fa-trash-alt'></i></a>
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
            </div>
            </div>
            
            <div class="row">
            <div class="col-12">
                <div class="card card-chart">
                <div class="card-header ">
                    <div class="row">
                    <div class="col-sm-6 text-left">
                        <h5 class="card-category">Record Label</h5>
                        <h3 class="card-title"><i class="fas fa-user-tag text-success mr-2"></i><?php echo $totalLabel; ?></h3>
                    </div>
                    </div>
                    <div class="row ml-3 mr-3 mb-5"><?php
                        $query = "SELECT a.*, b.* from user a, label b where a.id_user=b.id_user and a.level='label' order by a.id_user desc";
                        $result = mysqli_query($con, $query);
                        if (mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_assoc($result)){
                                $id_label= $row["id_label"];
                                ?>
                                <div class="col-6 mt-4" id=<?php echo $row["id_user"]; ?>>
                                <div class="row">
                                <div class="col-4">
                                <img class="card-img-top rounded-circle" width="100%" height="125px" src="images/profil/<?php echo $row["foto"];?>" alt="Cover Image">
                                </div>
                                <div class="col-8">
                                    <h4 class="card-title mb-2 text-capitalize"><strong><?php echo $row["nama"]; ?></strong></h4>
                                    <p class="ml-3 mb-0"><?php echo $row["username"]; ?></p>
                                        <p class="ml-3 mb-2"><?php echo $row["email"]; ?></p>
                                        <a href='?module=label&act=edit&id=<?php echo $id_label; ?>' class='btn btn-success pl-4 pr-4 ml-3'><i class='fas fa-edit'></i></a>
                                        <a href="<?php echo $proses; ?>?module=label&act=delete&id=<?php echo $id_label; ?>" class='btn btn-danger pl-4 pr-4'><i class='far fa-trash-alt'></i></a>
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
            </div>
            </div>

            <div class="row">
            <div class="col-12">
                <div class="card card-chart">
                <div class="card-header ">
                    <div class="row">
                    <div class="col-sm-6 text-left">
                        <h5 class="card-category">User</h5>
                        <h3 class="card-title"><i class="fas fa-user-tag text-warning mr-2"></i><?php echo $totalUser; ?></h3>
                    </div>
                    </div>
                    <div class="row ml-3 mr-3 mb-5"><?php
                        $query = "SELECT * from user where level='user' order by id_user desc";
                        $result = mysqli_query($con, $query);
                        if (mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_assoc($result)){
                                $id_user = $row["id_user"];
                                ?>
                                <div class="col-6 mt-4" id=<?php echo $row["id_user"]; ?>>
                                <div class="row">
                                <div class="col-4">
                                <img class="card-img-top rounded-circle" width="100%" height="125px" src="images/profil/<?php echo $row["foto"];?>" alt="Cover Image">
                                </div>
                                <div class="col-8">
                                    <h4 class="card-title mb-2 text-capitalize"><strong><?php echo $row["nama"]; ?></strong></h4>
                                    <p class="ml-3 mb-0"><?php echo $row["username"]; ?></p>
                                        <p class="ml-3 mb-2"><?php echo $row["email"]; ?></p>
                                        <a href='?module=user&act=edit&id=<?php echo $id_user; ?>' class='btn btn-success pl-4 pr-4 ml-3'><i class='fas fa-edit'></i></a>
                                        <a href="<?php echo $proses; ?>?module=user&act=delete&id=<?php echo $id_user; ?>" class='btn btn-danger pl-4 pr-4'><i class='far fa-trash-alt'></i></a>
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
            </div>
            </div>
            <?php 
                break; 

                case 'detail':
                $detail=mysqli_query($con,"select * from user where id_user='$_GET[id]'");
                if(mysqli_num_rows($detail)>0){
                $data=mysqli_fetch_assoc($detail);
                ?>

                <div class="row">
                    <div class="col-6">
                        <h2 class="mt-3"><?php echo $data["nama"]; ?>'s Profile</h2>
                    </div>
                </div>
                <div class="row">
                <div class="col-7 card">
                        <div class="row ml-3 mr-3">
                        <?php
                            $id_user = $data["id_user"];
                            ?>
                            <div class="col-11 mt-4" id=<?php echo $data["id_user"]; ?>>
                            <div class="row">
                            <div class="col-5">
                            <form action="<?php echo $proses; ?>?module=profil&act=updateFoto" method="POST" enctype="multipart/form-data" id="formFoto">
                                <img class="card-img-top rounded-circle" width="100%" height="170px" src="images/profil/<?php echo $data["foto"];?>" alt="Cover Image">
                                
                                <label for="foto" class="btn btn-primary p-3" style="position:absolute; right:5; bottom:24%;">
                                    <i class="fas fa-camera"></i>
                                    <input type="file" name="foto" id="foto" style="display:none;">
                                </label>
                                <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
                                <input type="hidden" name="foto_lama" value="<?php echo $data["foto"]; ?>">
                            </form>
                            </div>
                            <div class="col-6 ml-4">
                                <div class="row">
                                    <div class="col-12">
                                        <h4 class="card-title mb-2 text-capitalize"><strong><?php echo $data["nama"]; ?></strong></h4>
                                        <p class="ml-3 mt-4 mb-0">
                                            <i class="fas fa-at text-primary mr-2"></i><?php echo $data["username"]; ?>
                                        </p>
                                        <p class="ml-3 mb-2">
                                        <i class="far fa-envelope text-success mr-2"></i><?php echo $data["email"]; ?>
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
                }else{
                    ?><div class="row"><div class="col-12 text-center mb-5">Empty</div></div><?php
                }
                break;

                case 'add': ?>
                    <h3>Add New User</h3>
                    <form action=<?php echo "$proses?module=user&act=input"; ?> enctype="multipart/form-data" method="POST" class="ml-5">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="nama">Name</label>
                                <input type="text" class="form-control" name="nama" placeholder="Name" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" name="username" placeholder="username" required>
                            </div>
                        </div>
                        <div class="form-row">
                            
                            <div class="col-md-3">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" placeholder="password" required>
                            </div>
                            <div class="col-md-4">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="email" required>
                            </div>
                        </div>
                        <div class="form-row mt-3">
                            <div class="col-md-4">
                                <label for="foto">Profile Picture</label>
                                <input type="file" class="form-control" name="foto" placeholder="" required>
                            </div>
                            <div class="col-md-2">
                                <label for="level">Level</label>
                                <select name="level" class="form-control bg-dark">
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row mt-5">
                            <div class="col-md-7 text-right">
                                <button type="reset" class="btn btn-warning">Reset</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                        </form>
                <?php 
                    break;

                case 'edit':
                    $edit=mysqli_query($con,"select * from user where id_user='$_GET[id]'");
                    $data=mysqli_fetch_assoc($edit);
                    ?>

                    <h3>Edit User</h3>
                    <div class="row">
                        <div class="col-8">
                        <form action=<?php echo "$proses?module=user&act=update"; ?> enctype="multipart/form-data" method="POST" class="ml-5">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="nama">Name</label>
                                <input type="text" class="form-control" name="nama" value="<?php echo $data["nama"]; ?>" placeholder="Name" required>
                                <input type="hidden" name="id_user" value="<?php echo $data["id_user"]; ?>">
                            </div>
                            <div class="form-group col-md-5">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" value="<?php echo $data["username"]; ?>" name="username" placeholder="username" required>
                            </div>
                        </div>
                        <div class="form-row mt-3">
                            <div class="col-md-5">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" placeholder="password">
                            </div>
                            <div class="col-md-6">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" value="<?php echo $data["email"]; ?>" name="email" placeholder="email" required>
                            </div>
                        </div>
                        <div class="form-row mt-3">
                            <div class="col-md-5">
                                <label for="foto">Profile Picture</label>
                                <input type="file" class="form-control" name="foto" placeholder="">
                                <input type="hidden" name="foto_lama" value="<?php echo $data["foto"]; ?>" >
                            </div>
                            <div class="col-md-3">
                                <label for="level">Level</label>
                                <select name="level" class="form-control bg-dark">
                                <?php 
                                    echo "<option value=$data[level] selected=selected>$data[level]</option>";
                                ?>
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                </select>
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

                        <div class="col-3">
                            <img class="rounded-circle" width="90%" height="200px" src="images/profil/<?php echo $data["foto"];?>" alt="Cover Image">
                        </div>
                    </div>
                    

                    <?php
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
