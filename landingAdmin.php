
<?php
    session_start();
?>

<html>
<head>

<?php
    include 'header.php';
?>
  <!-- Nucleo Icons -->
    <link href="css/nucleo-icons.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link href="css/black-dashboard.css?v=1.0.0" rel="stylesheet" />
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/SSUhtml5audio.css">
</head>
<body>
    <div class="main-panel">
    <?php
        include 'navbar.php';
    ?>

    <div class="content">
        <div class="row">
          <div class="col-12">
            <div class="card card-chart">
              <div class="card-header ">
                <div class="row">
                  <div class="col-sm-6 text-left">
                    <h5 class="card-category">Paling Disukai</h5>
                    <h2 class="card-title">Lagu</h2>
                  </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <div class="card lagu">
                        <img class="card-img-top" src="images/woman.jpg" alt="Card image cap">
                            <div class="card-body text-center">
                                <h5 class="card-title m-0"><strong>Nobody Compares To You</strong></h5>
                                <p class="card-text m-0">Artis</p>
                                <a href="#" class="btn btn-primary mt-3 pl-4 pr-4 pt-2 pb-2">PLAY</a>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4">
            <div class="card card-chart">
              <div class="card-header ">
                <h5 class="card-category">Judul 2</h5>
                <h3 class="card-title"><i class="tim-icons icon-bell-55 text-primary "></i> Subjudul 2</h3>
              </div>
              <div class="card-body ">
                <div class="chart-area">
                  <canvas id="chartLinePurple"></canvas>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="card card-chart">
              <div class="card-header ">
                <h5 class="card-category">Judul 3</h5>
                <h3 class="card-title"><i class="tim-icons icon-delivery-fast text-info "></i> Subjudul 3</h3>
              </div>
              <div class="card-body ">
                <div class="chart-area">
                  <canvas id="CountryChart"></canvas>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="card card-chart">
              <div class="card-header ">
                <h5 class="card-category">Judul 4</h5>
                <h3 class="card-title"><i class="tim-icons icon-send text-success "></i> Subjudul 4</h3>
              </div>
              <div class="card-body ">
                <div class="chart-area">
                  <canvas id="chartLineGreen"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="row">
        <?php include 'player.php'; ?>
    </div>

    <?php include 'linkJs.php'?>
</body>
</html>