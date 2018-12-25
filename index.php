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
?>

<html>
<?php
    include 'header.php';
?>
<body style="overflow:hidden;">
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg fixed-top navbar-transparent">
    <div class="container">
      <div class="navbar-translate">
        <a class="navbar-brand" href="#" rel="tooltip" title="" data-placement="bottom" target="_blank">
            <img src="images/logo.png" width="40" height="40" class="d-inline-block align-middle mr-1" alt="">
            <span style="font-size:18"><b><strong>Sound On!</strong></b></span>
        </a>
        <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-bar bar1"></span>
          <span class="navbar-toggler-bar bar2"></span>
          <span class="navbar-toggler-bar bar3"></span>
        </button>
      </div>
      <div class="collapse navbar-collapse justify-content-end" id="navigation">
        <div class="navbar-collapse-header">
        <ul class="navbar-nav">
          <li class="nav-item">
            <button class="btn btn-success btn-round" data-toggle="modal" data-target="#login">
                Log In
              </button>
          </li>
        </ul>
      </div>
    </div>
  </nav>

    <div class="row h-100 bg-image">
        <div class="col-12 h-100 overlay-bg">
            <div class="row">
                <div class="col-6 offset-3 text-center" style="margin-top:15%;">
                    <h1 class="text-white"><strong>Listen To Your Favourite Music Here</strong></h1>
                    <h3 class="text-white">Discover new songs everyday</h3><br>
                    <button class="btn btn-lg" data-toggle="modal" style="animation: bounce 1s infinite;" data-target="#register">
                        GET STARTED
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-black" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content" style="background: #1e1e2d;">
            <div>
                <button type="button" class="close text-white p-2" data-dismiss="modal" aria-label="Close">
                <span aria-hiddem="true">&times;</span></button>
            </div>
        </button>
            <div class="justify-content-center">
              <div class="text-muted text-center ml-auto mr-auto">
                <h3 class="mb-0">Log In</h3>
              </div>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center mt-3">
                    <div class="col-10">
                        <form class="form-signin" action="proses/actionLogin.php" method="POST">
                            <div class="form-group mb-3">
                                <div class="input-group-prepend">
                                <span class="input-group-text border-0 mr-2">
                                    <i class="fas fa-at"></i>
                                </span>
                                <input type="text" name="username" class="form-control" placeholder="username" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group-prepend">
                                <span class="input-group-text border-0 mr-2">
                                    <i class="fas fa-key"></i>
                                </span>
                                <input type="password" name="password" class="form-control" placeholder="password" required>
                            </div>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-lg btn-primary btn-block mt-4 mb-4" type="submit" name="submit">Login</button>
                            </div>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-black" id="register" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content" style="background: #1e1e2d;">
            <div>
                <button type="button" class="close text-white p-2" data-dismiss="modal" aria-label="Close">
                <span aria-hiddem="true">&times;</span></button>
            </div>
            <div class="justify-content-center">
              <div class="text-muted text-center ml-auto mr-auto">
                <h3 class="mb-0">Register</h3>
              </div>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center mt-3">
                    <div class="col-10">
                        <form class="form-signin" action="proses/actionRegister.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group mb-3">
                                <div class="input-group-prepend">
                                <span class="input-group-text border-0 mr-2">
                                    <i class="far fa-user"></i>
                                </span>
                                <input type="text" name="nama" class="form-control" placeholder="nama" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group-prepend">
                                <span class="input-group-text border-0 mr-2">
                                    <i class="fas fa-at"></i>
                                </span>
                                <input type="text" name="username" class="form-control" placeholder="username" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group-prepend">
                                <span class="input-group-text border-0 mr-2">
                                    <i class="fas fa-key"></i>
                                </span>
                                <input type="password" name="password" class="form-control" placeholder="password" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group-prepend">
                                <span class="input-group-text border-0 mr-2">
                                    <i class="far fa-envelope"></i>
                                </span>
                                <input type="email" name="email" class="form-control" placeholder="email" required>
                                </div>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-lg btn-primary btn-block mt-4 mb-4" type="submit" name="submit">Register</button>
                            </div>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

      <?php include "linkJs.php"; ?>
</body>
</html>