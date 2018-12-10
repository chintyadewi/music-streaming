<?php
    session_start();
    
    if(isset($_SESSION['uname']) and isset($_SESSION['level'])){
        if($_SESSION['level']=='admin'){
            header("location:landingAdmin.php");
        }
        else if($_SESSION['level']=='user'){
            header("location:landingUser.php");
        }
        else{
            header("location:landingLabel.php");
        }
    }

    if(isset($_GET['pesan'])){
        $mess="<p> {$_GET['pesan']}</p>";
    }else{
        $mess="";
    }
?>

<html>
<?php
    include 'header.php';
?>
    <body class="text-center">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5 offset-3 mt-5">
                <div class="card">
                    <div class="card-header">
                        <h2>Register</h2>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-10">
                                <form class="form-signin" action="proses/actionRegister.php" method="POST" enctype="multipart/form-data">
                                    <input type="text" name="nama" class="form-control" placeholder="nama" required>
                                    <input type="email" name="email" class="form-control" placeholder="email" required>
                                    <input type="text" name="username" class="form-control" placeholder="username" required>
                                    <input type="password" name="password" class="form-control" placeholder="password" required>
                                    <input type="file" name="foto" class="form-control" placeholder="upload foto">
                                    <button class="btn btn-lg btn-primary btn-block mt-4 mb-4" type="submit" name="submit">Register</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>