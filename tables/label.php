<?php error_reporting(E_ALL ^ (E_NOTICE | E_WARNING)); ?>

<?php
$proses='proses/prosesLabel.php';
switch($_GET["act"]){
    default:
    ?>
        <h2 class="mt-3">Daftar Label</h2>
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
        <div class="row text-right">
                <div class="col-12">
                    <a href="?module=label&act=tambah" class="btn btn-primary mt-3"><i class="fas fa-plus"></i></a>
                </div>
            </div>
        <!-- <div class="row"> -->
            <table id="label" class="table table-stripped text-center mt-3" style="width:100%;">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Label</th>
                        <th>Username</th>
                        <th>Total Lagu</th>
                        <th>Total Album</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $query1 = "SELECT a.*, b.username FROM label a, user b where b.id_user=a.id_user";
                $result1 = mysqli_query($con, $query1);
                if (mysqli_num_rows($result1) > 0){
                    $index = 1;
                    while($row1 = mysqli_fetch_assoc($result1)){
                        $id_label = $row1["id_label"];
                        echo "
                        <tr>
                            <td>" . $index++ . "</td>
                            <td>" .$row1["nama"]. "</td>
                            <td>" .$row1["username"]. "</td>
                            <td>";
                                $lagu = "SELECT count(id_label) from lagu where id_label=$row1[id_label]";
                                $result2 = mysqli_query($con, $lagu);
                                $row2 = mysqli_fetch_assoc($result2);
                                echo $row2["count(id_label)"];
                            echo "</td>
                            <td>";
                                $album = "SELECT count(id_album) from album where id_label=$row1[id_label]";
                                $result3 = mysqli_query($con, $album);
                                $row3 = mysqli_fetch_assoc($result3);
                                echo $row3["count(id_album)"];
                            echo "</td>
                            <td>
                            <a href='?module=label&act=edit&id=$id_label' class='btn btn-success pl-4 pr-4'>
                                <i class='fas fa-edit'></i>
                            </a>
                            <a href='process/actionDeleteBarang.php?id=$id_label' class='btn btn-danger pl-4 pr-4'><i class='far fa-trash-alt'></i></a> </td>
                        </tr>
                        ";
                    }
                }else{
                    ?><div class="col-12 text-center">Data Kosong</div><?php
                }
                // close mysql connection
                mysqli_close($con); 
                ?>
                </tbody>
            </table>
            <script>
                $(document).ready(function() {
                    $('#label').DataTable({
                        "lengthMenu":[5,10,15,20],
                        "pageLength":5
                    });

                } );
            </script>
            <?php 
                break; 

            case 'tambah': ?>
                <h3>Tambah Label</h3>
                <form action=<?php echo "$proses?module=label&act=input"; ?> enctype="multipart/form-data" method="POST" class="ml-5">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="nama">Nama Label</label>
                            <input type="text" class="form-control" name="nama" placeholder="Nama" required>
                        </div>
                    </div>
                    <div class="form-row mt-3">
                        <h4>Akun</h4>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" placeholder="username" required>
                        </div>
                        <div class="col-md-3">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="password" required>
                        </div>
                    </div>
                    <div class="form-row mt-3">
                        <div class="col-md-4">
                            <label for="foto">Foto Profil</label>
                            <input type="file" class="form-control" name="foto" placeholder="" required>
                        </div>
                        <div class="col-md-4">
                            <label for="foto">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="email" required>
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
                $edit=mysqli_query($con,"SELECT a.*, b.email, b.username, b.foto FROM label a, user b where b.id_user=a.id_user and a.id_label='$_GET[id]'");
                $data=mysqli_fetch_assoc($edit);
                ?>

                <h3>Edit Label</h3>
                <form action=<?php echo "$proses?module=label&act=update"; ?> enctype="multipart/form-data" method="POST" class="ml-5">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="nama">Nama Label</label>
                            <input type="hidden" class="form-control" name="id_label" value="<?php echo $data['id_label']; ?>">
                            <input type="text" class="form-control" name="nama" value="<?php echo $data['nama']; ?>" placeholder="Nama" required>
                        </div>
                    </div>
                    <div class="form-row mt-3">
                        <h4>Akun</h4>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" value="<?php echo $data['username']; ?>" placeholder="username" required>
                        </div>
                        <div class="col-md-3">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="password">
                        </div>
                    </div>
                    <div class="form-row mt-3">
                        <div class="col-md-4">
                            <label for="foto">Foto Profil</label>
                            <input type="file" class="form-control" name="foto" placeholder="">
                            <input type="hidden" name="foto_lama" value="<?php echo $data["foto"] ?>">
                        </div>
                        <div class="col-md-4">
                            <label for="foto">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="email" value="<?php echo $data['email']; ?>" required>
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
            }
            ?>

