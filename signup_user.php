<?php
    require 'db.php';

    function signup($data_user){
        global $conn;

        $full_name = mysqli_real_escape_string($conn, $data_user['full_name']);
        $username = mysqli_real_escape_string($conn, $data_user['username']);
        $password = mysqli_real_escape_string($conn, $data_user[('password')]);
        $re_password = mysqli_real_escape_string($conn, $data_user[('re_password')]);
        $email = strtolower(stripslashes($data_user['email']));

        mysqli_query($conn, "INSERT INTO tb_user VALUES('', '$full_name','$username', MD5('$password'), '$email')");
        return mysqli_affected_rows($conn);
    }

    if(isset($_POST['signup'])){
        if(signup($_POST) > 0){
            echo "<script>alert('Succesfully Registered !'); window.location = 'login_user.php'; </script>";
        } else{
            echo "<script>alert('Registration Failed !')</script>";
        }
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="stylelogin_signup.css">
    <title>Sign Up | Game Shop</title>
  </head>
  <body>

    <div class="container">
        <div class="row">
            <div class="col text-center">
                <h4 class="text-center">SIGN UP</h4>
                <hr class="hr-user mx-auto">
            </div>
        </div>
        <form action="" method="POST">
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="full_name" class="form-control" id="full_name" required>
                </div>
                <div class="col">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" id="username" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password" required>
                </div>
                <div class="col">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" name="re_password" class="form-control" id="re_password" required>
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email" required>
                </div>
            </div>
            <div class="text-end">
                <button type="submit" name="signup" class="btn btn-primary">Sign Up</button>
            </div>
            <div>
                <a href="login_user.php">Login</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>