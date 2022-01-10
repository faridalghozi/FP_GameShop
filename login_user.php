<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="stylelogin_signup.css">
    <title>Login | Game Shop</title>
  </head>
  <body>
    <div class="container">
        <h4 class="text-center">LOGIN</h4>
        <hr class="hr-user mx-auto">
        <form action="" method="POST">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" id="username">
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password">
            </div>
            <div class="text-end mb-3">
                <input class="btn" type="reset" value="Reset">
                <button type="submit" name="submit" class="btn btn-primary">Login</button>
            </div>
            <div class="mb-1">
                <a href="login_admin.php">Login Admin</a>
            </div>
            <div>
                <a href="signup_user.php">Sign Up</a>
            </div>
        </form>
        <?php
            if(isset($_POST['submit'])){
                session_start();
                include 'db.php';

                $username = mysqli_real_escape_string($conn, $_POST['username']);
                $password = mysqli_real_escape_string($conn, $_POST['password']);

                $check = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '".$username."' AND password = '".MD5($password)."'");
                if(mysqli_num_rows($check) > 0){
                    $user = mysqli_fetch_object($check);
                    $_SESSION['status_login_user'] = true;
                    $_SESSION['user_global'] = $user;
                    $_SESSION['user_id'] = $user->user_id;
                    echo "<script>window.location = 'index.php'</script>";
                }else{
                    echo "<script>alert('Username atau Password Salah !');</script>";
                }
            }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>