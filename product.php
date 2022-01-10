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
    <title>Product | Game Shop</title>
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
                    <a class="nav-link" href="category.php">Data Kategori</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="product.php">Data Produk</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="logout_admin.php">Keluar</a>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
    </section>

    <section class="section-produk container-fluid">
        <div class="container mt-5 mb-5 p-4 bg-light rounded">
            <div class="row">
              <div class="col text-center">
                  <h2>Produk</h2>
                  <hr class="mx-auto">
              </div>
            </div>
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col" width="50px">No</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Gambar</th>
                    <th scope="col">Status</th>
                    <th scope="col" width="200px">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $no = 1;
                    $produk = mysqli_query($conn, "SELECT * FROM tb_product LEFT JOIN tb_category USING (category_id) ORDER BY product_id DESC");
                    if(mysqli_num_rows($produk) > 0){
                    while($row = mysqli_fetch_array($produk)){
                  ?>
                  <tr>
                    <th scope="row"><?php echo $no++ ?></th>
                    <td><?php echo $row['category_name'] ?></td>
                    <td><?php echo $row['product_name'] ?></td>
                    <td>Rp. <?php echo number_format($row['product_price']) ?></td>
                    <td><a href="product/<?php echo $row['product_image'] ?>" target="_blank"><img src="product/<?php echo $row['product_image'] ?>" class="img-produk-admin"</a></td>
                    <td><?php echo ($row['product_status']) == 0? 'Tidak Aktif':'Aktif'; ?></td>
                    <td>
                      <a href="edit_product.php?id=<?php echo $row['product_id']?>" class="btn btn-outline-primary">Edit</a>
                      <a href="delete.php?idp=<?php echo $row['product_id']?>" class="btn btn-outline-primary" onclick="return confirm('Yakin ingin hapus ?')">Hapus</a>
                    </td>
                  </tr>
                  <?php }}else{ ?>
                    <tr>
                        <td colspan="7">Tidak ada data produk</td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
              <a href="add_product.php" class="btn btn-outline-primary">Tambah Produk</a>
            </div>
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