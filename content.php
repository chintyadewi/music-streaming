<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

session_start();
include 'config/koneksi.php';

$level=$_SESSION["level"];
if($level=="admin" or $level=="label" or $level=="user"){
    $query1="select * from user where id_user='$_SESSION[id]'";  
    $result1 = mysqli_query($con, $query1);
    if(mysqli_num_rows($result1) == 1) {
      $row1 = mysqli_fetch_assoc($result1);
      $namaUser=$row1["nama"];
      $foto=$row1["foto"];
    }

    // Get data label
    $query2="select nama from label where id_user='$_SESSION[id]'";  
    $result2 = mysqli_query($con, $query2);
    if(mysqli_num_rows($result2) == 1) {
      $row2 = mysqli_fetch_assoc($result2);
      $namaLabel=$row2["nama"];
    }
    ?>

    <head>
      <?php include 'header.php'?>
    </head>

    <body class="text-white">
      <div class="main-panel">
        <div class="sidebar">
              <!--
                Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
            -->
          <div class="sidebar-wrapper">
            <div class="logo">
              <span class="simple-text logo-normal">
                <?php echo $_GET["module"]; ?>
              </span>
            </div>
            <ul class="nav" style="font-size:18">
              <li>
                <a href="?module=home">
                  <i class="fas fa-columns"></i>
                  <p>Home</p>
                </a>
              </li>
              <li>
                <a href="?module=playlist">
                <i class="fas fa-list-ul"></i>
                  <p>My Playlist</p>
                </a>
              </li>
              <li>
                <a href="?module=lagu">
                <i class="fas fa-music"></i>
                  <p>Songs</p>
                </a>
              </li>
              <li>
                <a href="?module=album">
                <i class="fas fa-dot-circle"></i>
                  <p>Album</p>
                </a>
              </li>
              <li>
                <a href="?module=artis">
                <i class="fas fa-users"></i>
                  <p>Artist</p>
                </a>
              </li>
              <li>
                <a href="?module=genre">
                  <i class="fab fa-gratipay"></i>
                  <p>Genre</p>
                </a>
              </li>
              <li>
                <a href="?module=label">
                <i class="fas fa-microphone-alt"></i>
                  <p>Record Label</p>
                </a>
              </li>
              <?php if($level=="admin"){ ?>
                <li>
                  <a href="?module=user">
                  <i class="fas fa-user"></i>
                    <p>Users</p>
                  </a>
                </li>
              <?php
              }
              ?>
            </ul>
          </div>
        </div>

        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg fixed-top bg-dark">
                <div class="container-fluid m-0 p-0">
                  <div class="navbar-wrapper">
                    <div class="navbar-toggle d-inline">
                      <button type="button" class="navbar-toggler">
                        <span class="navbar-toggler-bar bar1"></span>
                        <span class="navbar-toggler-bar bar2"></span>
                        <span class="navbar-toggler-bar bar3"></span>
                      </button>
                    </div>
                    <a class="navbar-brand" href="#pablo">
                        <img src="images/logo.png" width="40" height="40" class="d-inline-block align-middle mr-1" alt="">
                        <span style="font-size:18"><b><strong>Sound On!</strong></b></span>
                    </a>
                  </div>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navigation">
                    <ul class="navbar-nav ml-auto d-flex align-items-center">
                    <!-- Pilihan menu menurut hak akses -->
                    <?php
                        if($level=="admin"){
                          ?>
                            <li>Admin</li>
                            <li><i class="fas fa-user-cog"></i></li>
                            <li>|</li>
                          <?php
                        }
                        else if($level=="label"){
                          ?>
                            <li>Record Label</li>
                            <li><i class="fas fa-user-tag" style="color:#bfbfbf;"></i></li>
                            <li>|</li>
                          <?php
                        }
                      ?>
                      
                      <li><?php echo $namaUser; ?></li>
                      
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                          <div class="photo d-flex">
                            <img src="images/profil/<?php echo $foto; ?>">
                          </div>
                          <b class="caret d-none d-lg-block d-xl-block"></b>
                        </a>
                        <ul class="dropdown-menu dropdown-navbar">
                          <li class="nav-link">
                            <a href="?module=profil" class="nav-item dropdown-item">
                            <i class="far fa-user" style="font-size:15px;"></i> Profile</a>
                          </li>
                          <div class="dropdown-divider"></div>
                          <li class="nav-link">
                            <a href="logout.php" class="nav-item dropdown-item">
                              <i class="fas fa-sign-out-alt" style="font-size:15px;"></i> Log Out</a>
                          </li>
                        </ul>
                      </li>
                      <li class="separator d-lg-none"></li>
                    </ul>
                  </div>
                </div>
              </nav>

              <div class="content">
                <div> 
                  <?php include 'navigator.php'?>
                </div>
                  
                  <?php include 'linkJs.php'?>
              </div>
          </div>
      </body>
  </html>
<?php
}else if($level==""){
  ?><script>alert("Log In First");document.location.href="index.php";</script><?php
}
else{
  ?><script>alert("Access Denied");document.location.href="logout.php";</script><?php
}