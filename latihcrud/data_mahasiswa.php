<?php
//panggil koneksi
include "koneksi.php";


?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD - PHP - MYSQL + Modal bootstrap 5</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
    <div class="mt-3">
    <h3 class = "text-center">CRUD - PHP - MYSQL + Modal bootstrap 5</h3>
    <h3 class = "text-center">Ngoding Pintar</h3>
    </div>
    <!-- card (header and footer)!-->
    <div class="card mt-3">
  <div class="card-header bg-primary text-light">
    Data Mahasiswa
    <ul class="navbar-nav ms-auto">
    <li class="nav-item">
          <a class="btn btn-warning" aria-current="page" href="index.php">Home</a>
        </li>
    </ul>
  </div>
  <div class="card-body">
         <!-- Button trigger modal -->
<button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">
  Tambah Data
</button>
 <!-- end Button trigger modal -->
    <table class = "table table-bordered table-striped table-hover">
    <tr>
        <th>No</th>
        <th>Nim</th>
        <th>Nama Lengkap</th>
        <th>ALamat</th>
        <th>Jurusan</th>
        <th>Aksi</th>
    </tr>
    <?php
    //persiapan menampilkan data
    $no = 1;
    $tampil = mysqli_query($koneksi, "SELECT * FROM tmhs ORDER BY id_mhs DESC");
    while($data = mysqli_fetch_array($tampil)) :
    ?>



    <tr>
        <td><?= $no++ ?></td>
        <td><?= $data['nim']?></td>
        <td><?= $data['nama']?></td>
        <td><?= $data['alamat']?></td>
        <td><?= $data['prodi']?></td>
        <td>
            <a href ="#" class = "btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalUbah<?= $no ?>">Ubah</a>
            <a href ="#" class = "btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $no ?>">Hapus</a>
        </td>
    </tr>
        <!-- Modalubah (static backdrop) -->
<div class="modal fade" id="modalUbah<?= $no ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Form Data Mahasiswa</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" action="aksi_crudm.php">
      <input type ="hidden" name="id_mhs" value="<?= $data['id_mhs'] ?>">

      <div class="modal-body">  
      
        <!--FORM CONTROL!-->
        <div class="mb-3">
  <label class="form-label">NIM</label>
  <input type="text" class="form-control" name="tnim" value ="<?=$data['nim'] ?>" placeholder="Masukan NIM Anda">
</div>
<div class="mb-3">
  <label class="form-label">Nama Lengkap</label>
  <input type="text" class="form-control" name="tnama" value ="<?=$data['nama'] ?>" placeholder="Masukan Nama Lengkap Anda">
</div>
<div class="mb-3">
  <label class="form-label">Alamat</label>
  <textarea class="form-control" name="talamat" rows="3"><?=$data['alamat'] ?></textarea>
</div>
<div class="mb-3">
  <label class="form-label">Prodi</label>
  <select class="form-select" name="tprodi">
    <option value= "<?= $data['prodi']?>"><?= $data['prodi']?></option>
    <option value="S1 - Teknik Informatika">S1 - Teknik Informatika</option>
    <option value="S1 - Sistem Informasi">S1 - Sistem Informasi</option>
    <option value="S1 - Managemen">S1 - Managemen</option>
</select>
</div>

<!--end FORM CONTROL!-->
      </div>
      <div class="modal-footer">
      <button type="submit" class="btn btn-primary" name="bubah">Ubah</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Keluar</button>
        
      </div>
      </form>
    </div>
  </div>
</div>
<!-- end Modalubah (static backdrop) -->
        <!-- Modalhapus (static backdrop) -->
        <div class="modal fade" id="modalHapus<?= $no ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fs-5" id="staticBackdropLabel">Konfirmasi Hapus Data</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" action="aksi_crudm.php">
      <input type ="hidden" name="id_mhs" value="<?= $data['id_mhs'] ?>">

      <div class="modal-body">  
      
        <!--FORM CONTROL!-->
        <h5 class="text-center"> Apakah anda yakin menghapus data ini? <br>
        <span class ="text-danger"><?= $data['nim'] ?> - <?= $data['nama'] ?></span>
    </h5>
    </div>

<!--end FORM CONTROL!-->
      
      <div class="modal-footer">
      <button type="submit" class="btn btn-primary" name="bhapus">Hapus</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Keluar</button>
        
      </div>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- end Modalhapus (static backdrop) -->


        <?php endwhile; ?>

    </table>
    <!-- end card (header and footer)!-->

<!-- Modaltambah (static backdrop) -->
<div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Form Data Mahasiswa</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" action="aksi_crudm.php">
      <div class="modal-body">  
      
        <!--FORM CONTROL!-->
        <div class="mb-3">
  <label class="form-label">NIM</label>
  <input type="text" class="form-control" name="tnim" placeholder="Masukan NIM Anda">
</div>
<div class="mb-3">
  <label class="form-label">Nama Lengkap</label>
  <input type="text" class="form-control" name="tnama" placeholder="Masukan Nama Lengkap Anda">
</div>
<div class="mb-3">
  <label class="form-label">Alamat</label>
  <textarea class="form-control" name="talamat" rows="3"></textarea>
</div>
<div class="mb-3">
  <label class="form-label">Prodi</label>
  <select class="form-select" name="tprodi">
    <option></option>
    <option value="S1 - Teknik Informatika">S1 - Teknik Informatika</option>
    <option value="S1 - Sistem Informasi">S1 - Sistem Informasi</option>
    <option value="S1 - Managemen">S1 - Managemen</option>
</select>
</div>

<!--end FORM CONTROL!-->
      </div>
      <div class="modal-footer">
      <button type="submit" class="btn btn-primary" name="bsimpan">Simpan</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Keluar</button>
        
      </div>
      </form>
    </div>
  </div>
</div>
<!-- end Modaltambah (static backdrop) -->
  </div>
</div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>