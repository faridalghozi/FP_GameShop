<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="stylelogin_signup.css">
    <title>Login Admin | Game Shop</title>
  </head>
  <body>
    <div class="container">
        <h4 class="text-center">LOGIN ADMIN</h4>
        <hr class="hr-admin mx-auto">
        <form action="" method="POST">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" id="username" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password" required>
            </div>
            <div class="text-end mb-3">
                <input class="btn" type="reset" value="Reset">
                <button type="submit" name="submit" class="btn btn-primary">Login</button>
            </div>
            <div>
                <a href="login_user.php">Login User</a>
            </div>
        </form>
        <?php
            if(isset($_POST['submit'])){
                session_start();
                include 'db.php';

                $username = mysqli_real_escape_string($conn, $_POST['username']);
                $password = mysqli_real_escape_string($conn, $_POST['password']);

                $check = mysqli_query($conn, "SELECT * FROM tb_admin WHERE username = '".$username."' AND password = '".MD5($password)."'");
                if(mysqli_num_rows($check) > 0){
                    $admin = mysqli_fetch_object($check);
                    $_SESSION['status_login_admin'] = true;
                    $_SESSION['admin_global'] = $admin;
                    $_SESSION['admin_id'] = $admin->admin_id;
                    echo "<script>window.location = 'dashboard_admin.php'</script>";
                }else{
                    echo "<script>alert('Username atau Password Salah !');</script>";
                }
            }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>