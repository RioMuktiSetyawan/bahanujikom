<?php
session_start();
include "koneksi.php"; // Pastikan koneksi ke database sudah dipanggil

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Mencegah SQL Injection
    $username = mysqli_real_escape_string($koneksi, $username);
    $password = mysqli_real_escape_string($koneksi, $password);

    // Query cek username dan password
    $sql = "SELECT * FROM login_admin WHERE username = ? AND password = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // Jika username dan password cocok
    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username;

        // Debugging: Cek apakah session tersimpan
        echo "Login berhasil! Session: " . $_SESSION['username'];
        
        header("Location: index.php");
        exit();
    } else {
        echo "<script>alert('Username atau password salah!'); window.location.href='login.php';</script>";
    }

    $stmt->close();
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Halaman Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
   <h2 class="text-center"> Halaman Login Admin </h2>
        <!--colums-->
        <div class="row text-center align-items-center mt-4">
            <div class="col-12">
            <img src="Assets/logo.png" width="150" height="150";
            <br>
            <h2 class="mt-2"><span style="color: black;">🌟 Sistem Pengelolaan Data 🌟</h2></span>
            <i><span style="color: black;">CRUD</span><span style="color: coral;"> Create Read Update Delete</span><span style="color: black;">2025</span></i>
            </div>
          </div>
          <!--end colums-->
          <br>
          <!--form-->
          <form class="bg-primary text-light" style="width: 25%; margin: auto; border: 1px solid #ccc; padding: 20px; border-radius: 5px;" method="POST" action="login.php">
    <div class="mb-3 text-center">
        <label for="exampleInputUsername1" class="form-label">Username</label>
        <input type="text" class="form-control" id="exampleInputUsername1" name="username" required>
    </div>
    <div class="mb-3 text-center">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" name="password" required>
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-danger">Login</button>
    </div>
</form>

        <!--end form-->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>