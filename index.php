<?php
  session_start();
  if($_SESSION['status_login_user'] != true){
    echo "<script>window.location = 'login_user.php'</script>";
  }
  include 'db.php';
  $kontak = mysqli_query($conn, "SELECT admin_address, admin_email, admin_telp FROM tb_admin WHERE admin_id = 1");
  $a = mysqli_fetch_object($kontak);

  function make_query($conn){
    $query = "SELECT * FROM tb_product ORDER BY product_id ASC";
    $result = mysqli_query($conn, $query);
    return $result;
  }

  function make_slide_indicators($conn){
    $output = ''; 
    $count = 0;
    $result = make_query($conn);
    while($carousel = mysqli_fetch_array($result)){
      if($count == 0){
      $output .= '<button type="button" data-bs-target="#carousel-image" data-bs-slide-to="'.$count.'" class="active"></button>';
      }
      else{
      $output .= '<button type="button" data-bs-target="#carousel-image" data-bs-slide-to="'.$count.'"></button>';
      }
    $count = $count + 1;
    }
    return $output;
  }

  function make_slides($conn){
    $output = '';
    $count = 0;
    $result = make_query($conn);
    while($carousel = mysqli_fetch_array($result)){
      if($count == 0){
      $output .= '<div class="carousel-item active" data-bs-interval="5000">';
      }
      else{
      $output .= '<div class="carousel-item" data-bs-interval="5000">';
      }
      $output .= '<img src="product/'.$carousel['product_image'].'" class="d-block w-50 mx-auto rounded" alt="'.$carousel['product_name'].'" />
        <div class="carousel-caption d-none d-md-block"">
          <h5>'.$carousel['product_name'].'</h5>
        </div>
      </div>';
      $count = $count + 1;
    }
    return $output;
  }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="refresh">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Game Shop</title>
  </head>
  <body>
    <section class="section-navbar">
        <nav class="navbar navbar-expand-lg shadow">
            <div class="container-fluid">
              <a class="navbar-brand" href="index.php">Game Shop</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                <span></span>
                <span></span>
                <span></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Dashboard</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link"  href="profil_user.php">Profil</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="product_user.php">Produk</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="logout_user.php">Keluar</a>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
    </section>

    <section class="section-cari-produk container-fluid">
        <div class="container p-4 bg-light rounded">
            <div class="container">
              <form action="product_user.php">
                <div class="row justify-content-center">
                  <div class="col-6">
                    <input type="text" class="form-control" name="search" id="search" placeholder="Cari Produk">
                  </div>
                  <div class="col-2">
                    <button type="submit" class="btn btn-primary btn-lg" name="cari">Cari</button>
                  </div>
                </div>
              </form>
            </div>
        </div>
    </section>

    <section class="section-carousel container-fluid">
      <div class="container mt-1 p-4 bg-light rounded">
        <div class="container">
          <div id="carousel-image" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
            <?php echo make_slide_indicators($conn); ?>
            </div>
            <div class="carousel-inner">
            <?php echo make_slides($conn); ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carousel-image" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carousel-image" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
        </div>
      </div>
    </section>

    <section class="section-title container-fluid">
        <div class="container mt-5 p-4 bg-light rounded">
            <div class="container text-center">
                <h1 class="display-5 fw-bold mt-3">Game Shop</h1>
                <h5 class="">Selamat Datang <?php echo $_SESSION['user_global']->user_name ?> !</h5>
            </div>
        </div>
    </section>

    <section class="section-kategori container-fluid">
        <div class="container mt-5 mb-5 p-4 bg-light rounded">
            <div class="row">
                <div class="col text-center">
                    <h2>Kategori Produk</h2>
                    <hr class="mx-auto">
                </div>
            </div>
            <div class="row row-cols-2 row-cols-lg-5 g-2 g-lg-3">
              <?php
                $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                if(mysqli_num_rows($kategori) > 0){
                  while($k = mysqli_fetch_array($kategori)){
              ?>
              <div class="col">
                <div class="p-5 rounded text-center">
                  <a href="product_user.php?kat=<?php echo $k['category_id'] ?>" class="link-dark text-decoration-none">
                    <img src="img/list-option.png" class="pb-2 w-75" alt="">
                    <p><?php echo $k['category_name'] ?></p>
                  </a>
                </div>
              </div>
              <?php }}else{ ?>
                <p>Kategori tidak ada</p>
              <?php } ?>
            </div>
        </div>
    </section>

    <section class="section-produk container-fluid">
        <div class="container mt-5 mb-5 p-4 bg-light rounded">
            <div class="row">
                <div class="col text-center">
                    <h2>Produk Terbaru</h2>
                    <hr class="produk-terbaru mx-auto">
                </div>
            </div>
            <div class="row row-cols-2 row-cols-lg-4 g-2 g-lg-3 py-3">
              <?php
                $produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_status = 1 ORDER BY product_id DESC LIMIT 8");
                if(mysqli_num_rows($produk) > 0){
                  while($p = mysqli_fetch_array($produk)){
              ?>
                <div class="col">
                  <a href="detail_product_user.php?id=<?php echo $p['product_id'] ?>" class="link-dark text-decoration-none">
                    <div class="card border-0 rounded">
                      <img src="product/<?php echo $p['product_image'] ?>" class="card-img-top w-100" alt="">
                      <div class="card-body">
                        <p class="card-text"><?php echo substr($p['product_name'], 0, 30) ?></p>
                        <p class="card-text fw-bold text-end harga">Rp. <?php echo number_format($p['product_price']) ?></p>
                      </div>
                    </div>
                  </a>
                </div>
              <?php }}else{ ?>
                <p>Produk tidak ada</p>
              <?php } ?>
            </div>
        </div>
    </section>

    <footer class="shadow">
        <div class="container mt-5">
            <div class="row">
                <div class="col-sm-12 pt-3 text-center">
                    <h5 class="fw-bold">Alamat</h5>
                    <p><?php echo $a->admin_address ?></p>
                    <h5 class="fw-bold">Email</h5>
                    <p><?php echo $a->admin_email ?></p>
                    <h5 class="fw-bold">No. HP</h5>
                    <p><?php echo $a->admin_telp ?></p>
                    <p class="pt-2 fw-bold">&copy; Copyright 2021</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  </body>
</html>