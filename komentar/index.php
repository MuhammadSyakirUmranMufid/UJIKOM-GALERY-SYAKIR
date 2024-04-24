<?php
require '../function/conect/index.php';

session_start();

if (empty($_SESSION["login"])) {
    header("Location: ../login/login.php");
    exit;
};

$foto_id = $_GET["foto_id"];

$q = query("SELECT * FROM foto WHERE foto_id = $foto_id")[0];
$k = query("SELECT * FROM komentar_foto WHERE foto_id = $foto_id");

if( isset($_POST["komentar"])) {
    if (tambahKomentar($_POST) > 0) {
        echo "<script>alert('berhasil di upload');
        window.location.href='../' </script>";
    }
}

function tambahKomentar () {
    global $conn;
    $user_id = $_SESSION["user_id"];
    $foto_id = $_GET["foto_id"];
    $isi_komentar = $_POST["isi_komentar"];
    $tanggal_komentar = date("Y-m-d");

    $query = mysqli_query($conn, "INSERT INTO komentar_foto VALUES ('', '$foto_id', '$user_id', '$isi_komentar', '$tanggal_komentar')");
};

function namaUser($user_id) {
    global $conn;
    $r = mysqli_query($conn, "SELECT * FROM user WHERE user_id = $user_id");
    $row = mysqli_fetch_assoc($r);
    return $row['nama_lengkap'];
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comentar</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <main class="px-16 py-12">
        <section class="px-q bg-gray-50 bg-opacity-50 px-2 py-2">
          <nav class="flex justify-between">
            <div class="block">
              <a class="font-bold text-xl italic text-slate-600" a="#">Muh Syakir</a>
            </div>
          <div class="block uppercase text-md font-semibold flex gap-x-8">
                <a href="../index.php" class="border-b font-bold italic p-2">Galery</a>
                <a href="../registrasi/" class="hover:border-b p-2">Registrasi</a>
                <a href="../function/logout/" class="hover:border-b p-2">log out</a>
          </div>
          </nav>
        </section>
            <section class="mt-24 max-w-[800px] mx-auto">
                <div class="">
                <img src="../stockPhoto/<?= $q["lokasi_file"]; ?>" alt="" class="rounded-b-md w-full drop-shadow-md">
                </div>
                <div class="py-4 px-2">
                <p class="capitalize mb-2 text-slate-700">di post pada <span class="font-semibold italic"><?= $q["tanggal_unggah"]; ?></span> oleh <span class="font-bold italic"><?= namaUser($q["user_id"]); ?></span></p>
                <h1 class="text-xl font-semibold text-gray-800 text-lg"><?= $q["judul_foto"]; ?></h1>
                <p class="text-lg text-justify"><?= $q["deskripsi_foto"]; ?></p>
                </div>
                <form method="post" action="" class="flex gap-x-8 items-center" enctype="multipart/form-data">
                    <div class="">
                        <h1 class="font-semibold italic text-slate-600">MASUKAN KOMENTAR ANDA</h1>
                    </div>
                    <div class="flex gap-x-4 py-4">
                        <input type="text" name="isi_komentar" class="px-2 py-1 w-[400px] border-b focus:outline-none">
                        <button class="flex items-center" name="komentar" type="submit">
                        <img src="../asset/right.png" alt="" width="18px" class="hover:scale-125 ease-in-out duration-300">
                        </button>
                    </div>
                </form>
                <div class="grid grid-cols-2 gap-x-12 gap-y-4 border-t py-6 px-2">
                <?php foreach ($k as $row) :?>
                <div class="max-w-md outline outline-1 outline-gray-100 shadow-md px-2 py-4">
                    <div class="flex justify-between items-center">
                        <h1 class="font-semibold text-slate-700">dikirim oleh <span class="text-xl font-bold italic"><?= namaUser($row["user_id"]); ?></span></h1>
                        <p class="text-sm italic"><?= $row["tanggal_komentar"]; ?></p>
                    </div>
                    <p class="px-1 mt-4 text-justify text-slate-600"><?= $row["isi_komentar"]; ?></p>
                </div>
                <?php endforeach ?>
            </section>
    </main>
</body>
</html>