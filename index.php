<?php
require './function/conect/index.php';
session_start();

if (empty($_SESSION["login"])) {
  header("Location: ./login/login.php");
  exit;
}

// $foto = $_SESSION["foto_id"];

$query =mysqli_query($conn, "SELECT * FROM foto ORDER BY foto_id DESC");

function jumlah_komen($foto_id) {
  global $conn;
  $r = mysqli_query($conn, "SELECT COUNT(*) AS jumlah_komen FROM komentar_foto WHERE foto_id = $foto_id");
  $row = mysqli_fetch_assoc($r);
  return $row['jumlah_komen'];
};
function jumlah_like($foto_id) {
  global $conn;
  $q = mysqli_query($conn, "SELECT COUNT(*) AS jumlah_like FROM like_foto WHERE foto_id = $foto_id");
  $row = mysqli_fetch_assoc($q);
  return $row['jumlah_like'];
};

function namaUser($user_id) {
  global $conn;
  $r = mysqli_query($conn, "SELECT * FROM user WHERE user_id = $user_id");
  $row = mysqli_fetch_assoc($r);
  return $row['nama_lengkap'];
};

$id = $_SESSION["nama_lengkap"];
// $user = query("SELECT FROM user WHERE user = ");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galery home</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            clifford: '#da373d',
          },
          FontFamily: {

          }
        }
      }
    }
  </script>
</head>
<body>
  <main class="px-16 py-4">
    <section class="bg-gray-50 bg-opacity-50 px-2 py-2">
      <nav class="flex justify-between">
        <div class="block">
          <a class="font-bold text-xl italic text-slate-600" a="#">Muh Syakir</a>
        </div>
      <div class="block uppercase text-md font-semibold flex gap-x-8">
            <a href="#" class="border-b font-bold italic p-2">Galery</a>
            <a href="./registrasi/" class="hover:border-b p-2">Registrasi</a>
            <a href="./function/logout/" class="hover:border-b p-2">log out</a>
      </div>
      </nav>
    </section>

    <section class="flex justify-between px-8 py-12">
      <div>
        <h1 class="font-bold text-slate-600 text-xl capitalize">Halo User <span class="text-slate-900 font-semibold italic"><?= $_SESSION['nama_lengkap']; ?></span> selamat datang di Galery Photo</h1>
        <p class>Anda bisa berbagi kesenangan bersama keluarga, teman dan sehabat</p>
      </div>
        <div class="flex items-center">
        <a href="./uploadFoto/" class="flex">
          <span class="font-bold text-sm">COBA UPLOAD SEKARANG....</span>
          <img src="./asset/right-down.png" alt="" width="70px">
        </a>
      </div>
    </section>

    <section class="px-8 py-6 grid grid-cols-3 gap-x-8 gap-y-10">
      <?php while ($row = mysqli_fetch_assoc($query)) : ?>
      <div class="pb-6 max-w-sm grid grid-rows rounded-b-md shadow-md">
        <div>
          <img src="./stockPhoto/<?= $row["lokasi_file"]; ?>" alt="">
        </div>
        <div class="px-3 py-4">
        <p class="text-sm capitalize mb-2 text-slate-700">di post pada <span><?= $row["tanggal_unggah"]; ?></span> oleh user <span><?= namaUser($row["user_id"]); ?></span></p>
        <h1 class="font-semibold text-gray-800 text-lg"><?= $row["judul_foto"]; ?></h1>
        <p class="text-justify"><?= $row["deskripsi_foto"]; ?></p>
        </div>
        <div class="flex gap-x-4 px-3 py-2">
          <a href="./like/index.php?foto_id=<?= $row["foto_id"]; ?>" class="flex flex-col items-center">
            <img src="./asset/heart.png" alt="" width="20px">
            <p><?= jumlah_like($row['foto_id']) ?></p>
          </a >
          <a href="./komentar/index.php?foto_id=<?= $row["foto_id"]; ?>" class="flex flex-col items-center">
            <img src="./asset/comment.png" alt="" width="20px">
            <p><?= jumlah_komen($row['foto_id']) ?></p>
          </a>
          <a href="./updateData/index.php?foto_id=<?= $row["foto_id"]; ?>">Update</a>
          <a onclick="return confirm('apakah benar ingin menghapus ini?') " href="./hapus/index.php?foto_id=<?= $row["foto_id"]; ?>">Hapus</a>
        </div>
      </div>
      <?php endwhile ?>
    </section>
  </main>
</body>
</html>