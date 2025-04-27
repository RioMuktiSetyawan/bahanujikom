<?php

// Panggil koneksi database
include "koneksi.php";

// Uji jika tombol simpan diklik
if (isset($_POST['bsimpan'])) {
    // Persiapan simpan data baru
    $simpan = mysqli_query($koneksi, "INSERT INTO tmhs (nim, nama, alamat, prodi) 
                                       VALUES ('$_POST[tnim]', 
                                               '$_POST[tnama]',                   
                                               '$_POST[talamat]',  
                                               '$_POST[tprodi]')");

    // Jika simpan success
    if ($simpan) {
        echo "<script>
        alert('Simpan data Sukses!');
        document.location='data_mahasiswa.php';   
        </script>";
    } else {
        echo "<script>
        alert('Simpan data Gagal!');
        document.location='data_mahasiswa.php';   
        </script>";
    }
}
// Uji jika tombol ubah diklik
if (isset($_POST['bubah'])) {
    // Persiapan simpan data baru
    $ubah = mysqli_query($koneksi, "UPDATE tmhs SET
                                                    nim = '$_POST[tnim]',
                                                    nama = '$_POST[tnama]',
                                                    alamat = '$_POST[talamat]',
                                                    prodi = '$_POST[tprodi]'
                                                    WHERE id_mhs = '$_POST[id_mhs]'
                                                        ");

    // Jika Ubah success
    if ($ubah) {
        echo "<script>
        alert('Ubah data Sukses!');
        document.location='data_mahasiswa.php';   
        </script>";
    } else {
        echo "<script>
        alert('Ubah data Gagal!');
        document.location='data_mahasiswa.php';   
        </script>";
    }
}
// Uji jika tombol hapus diklik
if (isset($_POST['bhapus'])) {
    // Persiapan Hapus data baru
    $hapus = mysqli_query ($koneksi, "DELETE FROM tmhs WHERE id_mhs = '$_POST[id_mhs]'");
                                                  

    // Jika Hapus success
    if ($hapus) {
        echo "<script>
        alert('Hapus data Sukses!');
        document.location='data_mahasiswa.php';   
        </script>";
    } else {
        echo "<script>
        alert('Hapus data Gagal!');
        document.location='data_mahasiswa.php';   
        </script>";
    }
}
?>