<?php
  session_start();
  include 'db.php';

  if($_SESSION['status_login_admin'] != true){
    echo "<script>window.location = 'login_admin.php'</script>";
  }

  $produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id = '".$_GET['id']."' ");
  if(mysqli_num_rows($produk) == 0){
    echo "<script>window.location = 'product.php'</script>";
  }
  $p = mysqli_fetch_object($produk);

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="refresh">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>Edit Product | Game Shop</title>
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
        <div class="container mt-5 p-4 bg-light rounded">
            <div class="row">
                <div class="col text-center mb-3">
                    <h2>Edit Produk</h2>
                    <hr class="edit-produk mx-auto">
                </div>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">Kategori Produk</label>
                        <select class="form-select input-control" name="kategori" required>
                            <option value="">---Pilih---</option>
                            <?php
                                $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                                while($r = mysqli_fetch_array($kategori)){
                            ?>
                                <option value="<?php echo $r['category_id'] ?>" <?php echo ($r['category_id'] == $p->category_id)? 'selected':''; ?>><?php echo $r['category_name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">Nama Produk</label>
                        <input type="text" name="name" class="form-control" id="name" value="<?php echo $p->product_name?>" required>
                    </div>
                    <div class="col">
                        <label class="form-label">Harga</label>
                        <input type="number" name="price" class="form-control" id="price" value="<?php echo $p->product_price?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label class="form-label">Gambar Produk</label>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <img src="product/<?php echo $p->product_image ?>" class="mb-3 w-25" alt="">
                        <input type="hidden" name="photo" class="form-control" id="photo" value="<?php echo $p->product_image ?>">
                        <input type="file" name="image" class="form-control" id="image">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">Deskripsi Produk</label>
                        <textarea name="description" class="form-control input-control" id="description" rows="3" required><?php echo $p->product_description?></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">Status Produk</label>
                        <select class="form-select input-control" name="status">
                            <option selected>---Pilih---</option>
                            <option value="1"<?php echo ($p->product_status == 1)? 'selected':''; ?>>Aktif</option>
                            <option value="0"<?php echo ($p->product_status == 0)? 'selected':''; ?>>Tidak Aktif</option>
                        </select>
                    </div>
                </div>
                <div class="text-end">
                    <button type="submit" name="edit_produk" class="btn btn-primary">Edit</button>
                </div>
                <?php
                    if(isset($_POST['edit_produk'])){

                        // Data inputan dari form
                        $kategori = $_POST['kategori'];
                        $nama = $_POST['name'];
                        $harga = $_POST['price'];
                        $deskripsi = $_POST['description'];
                        $status = $_POST['status'];
                        $foto = $_POST['photo'];

                        // Jika admin ganti gambar
                        if($filename != ''){

                            // Data gambar yang baru
                            $filename = $_FILES['image']['name'];
                            $tmp_name = $_FILES['image']['tmp_name'];

                            $type1 = explode('.', $filename);
                            $type2 = $type1[1];
                            
                            $newname = 'produk'.time().'.'.$type2;

                            // Menampung data format yang diizinkan
                            $tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif');


                            // Validasi format file
                            if(!in_array($type2, $tipe_diizinkan)){
                                // Jika format file tidak ada dalam array tipe_diizinkan
                                echo "<script>alert('Format file tidak diizinkan')</script>";
                            }else{
                                unlink('./product/'.$foto);
                                move_uploaded_file($tmp_name, './product/'.$newname);
                                $nama_gambar = $newname;
                            }

                        }else{
                            // Jika admin tidak ganti gambar
                            $nama_gambar = $foto;
                        }

                        // Query update data produk
                        $update = mysqli_query($conn, "UPDATE tb_product SET
                                                category_id = '".$kategori."',
                                                product_name = '".$nama."',
                                                product_price = '".$harga."',
                                                product_description = '".$deskripsi."',
                                                product_image = '".$nama_gambar."',
                                                product_status = '".$status."'
                                                WHERE product_id = '".$p->product_id."' ");
                        
                        if($update){
                                echo "<script>alert('Edit Produk Berhasil')</script>";
                                echo "<script>window.location = 'product.php'</script>";
                            }else{
                                echo "<script>alert('Edit Produk Gagal')</script>";
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
    <script>CKEDITOR.replace('description')</script>

  </body>
</html>