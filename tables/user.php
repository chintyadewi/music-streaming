<?php error_reporting(E_ALL ^ (E_NOTICE | E_WARNING)); 

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
        
        <?php
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
                <h2 class="mt-3">Daftar User</h2>
            </div>
            <div class="col-6 text-right">
                <a href="?module=user&act=tambah" class="btn btn-primary mt-3"><i class="fas fa-plus"></i></a>
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
                                    <a href='process/actionDeleteBarang.php?id=$id_label' class='btn btn-danger pl-4 pr-4'><i class='far fa-trash-alt'></i></a>
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
                    <h5 class="card-category">Label</h5>
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
                                    <a href='process/actionDeleteBarang.php?id=$id_label' class='btn btn-danger pl-4 pr-4'><i class='far fa-trash-alt'></i></a>
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
                                    <a href='process/actionDeleteBarang.php?id=$id_label' class='btn btn-danger pl-4 pr-4'><i class='far fa-trash-alt'></i></a>
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
                <h3>Tambah User</h3>
                <form action=<?php echo "$proses?module=user&act=input"; ?> enctype="multipart/form-data" method="POST" class="ml-5">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" name="nama" placeholder="Nama" required>
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
                            <label for="foto">Foto Profil</label>
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

                    <div class="form-row mt-3">
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
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" name="nama" value="<?php echo $data["nama"]; ?>" placeholder="Nama" required>
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
                            <label for="foto">Foto Profil</label>
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

                    <div class="form-row mt-3">
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

