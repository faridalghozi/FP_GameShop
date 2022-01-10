<?php
  session_start();
  include 'db.php';

  if($_SESSION['status_login_admin'] != true){
    echo "<script>window.location = 'login_admin.php'</script>";
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
    <title>Add Category | Game Shop</title>
  </head>
  <body>
    <section class="section-navbar">
        <nav class="navbar navbar-expand-lg shadow">
            <div class="container-fluid">
              <a class="navbar-brand" href="dashboard_admin.php">Game Shop</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                <span></span>
                <span></span>
                <span></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                  <li class="nav-item">
                    <a class="nav-link" href="dashboard_admin.php">Dashboard</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link"  href="profil_admin.php">Profil</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="category.php">Data Kategori</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="product.php">Data Produk</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="logout_admin.php">Keluar</a>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
    </section>

    <section class="section-kategori container-fluid">
        <div class="container mt-5 p-4 bg-light rounded">
            <div class="row">
                <div class="col text-center mb-3">
                    <h2>Tambah Kategori</h2>
                    <hr class="mx-auto">
                </div>
            </div>
            <form action="" method="POST">
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">Nama Kategori</label>
                        <input type="text" name="kategori" class="form-control" id="kategori" required>
                    </div>
                </div>
                <div class="text-end">
                    <button type="submit" name="tambah_kategori" class="btn btn-primary">Tambah</button>
                </div>
                <?php
                    if(isset($_POST['tambah_kategori'])){

                        $kategori = ucwords($_POST['kategori']);

                        $insert = mysqli_query($conn, "INSERT INTO tb_category VALUES (
                                            null,
                                            '".$kategori."') ");
                        
                        if($insert){
                            echo "<script>alert('Tambah Kategori Berhasil')</script>";
                            echo "<script>window.location = 'category.php'</script>";
                        }
                        else{
                            echo "<script>alert('Tambah Kategori Gagal')</script>";
                        }

                    }
                ?>
            </form>
        </div>
    </section>

    <footer class="shadow">
        <div class="container mt-5">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <p class="pt-5 fw-bold">&copy; Copyright 2021</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  </body>
</html>