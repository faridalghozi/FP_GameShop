<?php
  session_start();
  if($_SESSION['status_login_user'] != true){
    echo "<script>window.location = 'login_user.php'</script>";
  }
  error_reporting(0);
  include 'db.php';
  $kontak = mysqli_query($conn, "SELECT admin_address, admin_email, admin_telp FROM tb_admin WHERE admin_id = 1");
  $a = mysqli_fetch_object($kontak);

  $produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id = '".$_GET['id']."' ");
  $p = mysqli_fetch_object($produk);

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="refresh">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Detail | Game Shop</title>
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
                    <a class="nav-link" href="index.php">Dashboard</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link"  href="profil_user.php">Profil</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="product_user.php">Produk</a>
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
                    <input type="text" class="form-control" name="search" id="search" placeholder="Cari Produk" value="<?php echo $_GET['search'] ?>">
                    <input type="hidden" class="form-control" name="kat" id="kat" value="<?php echo $_GET['kat'] ?>">
                  </div>
                  <div class="col-2">
                    <button type="submit" class="btn btn-primary btn-lg" name="cari">Cari</button>
                  </div>
                </div>
              </form>
            </div>
        </div>
    </section>

    <section class="section-detail-produk container-fluid">
        <div class="container mt-5 p-4 bg-light rounded">
            <div class="container">
                <div class="row">
                    <div class="col text-center">
                        <h2>Detail Produk</h2>
                        <hr class="mx-auto">
                    </div>
                </div>
                <div class="row py-3">
                    <div class="col">
                        <img src="product/<?php echo $p->product_image ?>" class="rounded w-100" alt="">
                    </div>
                    <div class="col">
                        <h3 class="fw-bold"><?php echo $p->product_name ?></h3>
                        <h4>Rp. <?php echo number_format($p->product_price) ?></h4>
                        <p class="my-4">Deskripsi :<br>
                            <?php echo $p->product_description ?>
                        </p>
                        <div class="row">
                            <div class="col">
                                <p><a href="https://api.whatsapp.com/send?phone=<?php echo $a->admin_telp ?>&text=Hai, saya tertarik dengan produk Anda." class="btn btn-outline-success w-100" target="_blank">Hubungi via Whatsapp</a></p>
                            </div>
                            <div class="col">
                                <a href="https://api.whatsapp.com/send?phone=<?php echo $a->admin_telp ?>&text=Hai, saya tertarik dengan produk Anda." target="_blank">
                                    <img src="img/whatsapp.png" class="w-25" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
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