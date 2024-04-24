<?php 
require '../function/conect/index.php';
session_start();
$foto_id = $_GET['foto_id'];

$foto = query("SELECT * FROM foto WHERE foto_id = $foto_id")[0];

if( isset($_POST["submit"])) {
    if (add($_POST) > 0) {
        echo "<script>alert('berhasil di upload');
        window.location.href='../' </script>";
    }
}

function add ($data) {
    global $conn, $foto_id;
    $user_id = $_SESSION["user_id"];
    $judul_foto = $data["judul_foto"];
    $deskripsi_foto = $data["deskripsi_foto"];
    $tanggal_unggah = $data["tanggal_unggah"];
    $lokasi_file = upload();
    if ( !$lokasi_file) {
        return false;
    };

    $query = "UPDATE foto SET judul_foto = '$judul_foto', deskripsi_foto = '$deskripsi_foto', tanggal_unggah = '$tanggal_unggah', lokasi_file = '$lokasi_file' WHERE foto_id = '$foto_id'";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
};


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Foto</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <section class="max-w-[900px] mx-auto drop-shadow shadow-lg mt-24">
    <form action="" method="post" class="flex gap-x-4" enctype="multipart/form-data">
    <input type="hidden" name="user_id" id="user_id">
        <div class="">
        <img src="../stockPhoto/Stock (9).jpg" alt="" class="max-w-md h-full">
        </div>
        <div class="grid gap-y-4 px-4 py-8">
            <h1 class="font-bold text-2xl text-slate-600 uppercase">Lorem ipsum dolor sit.<span class="text-slate-900"> lorem !! </span></h1>
            <div class="grid gap-y-2">
                <label for="judul_foto" class="uppercase text-md text-slate-600">judul foto</label>
                <input type="text" name="judul_foto" id="judul_foto" value="<?= $foto["judul_foto"]; ?>" class="border-b focus:outline-none text-slate-500 px-2 ">
            </div>
            <div class="grid gap-y-2">
                <label for="deskripsi_foto" class="uppercase text-md text-slate-600">deskripsi foto</label>
                <textarea name="deskripsi_foto" id="deskripsi_foto" class="px-2 py-1 border focus:outline-none text-slate-500 "><?= $foto["deskripsi_foto"]; ?></textarea>
            </div>
            <div class="grid gap-y-2">
                <label for="tanggal_unggah" class="uppercase text-md text-slate-600">tanggal unggah</label>
                <input type="date" name="tanggal_unggah" value="<?= $foto["tanggal_unggah"]; ?>" id="tanggal_unggah" class="px-2 py-1 border-b focus:outline-none text-slate-500">
            </div>
            <div class="grid gap-y-2">
                <label for="lokasi_file" class="uppercase text-md text-slate-600">Pilih Gambar</label>
                <input type="file" name="lokasi_file" id="lokasi_file">
            </div>
            <div class="flex justify-end">
                <button type="submit" name="submit" class="px-4 py-1 rounded-md bg-gray-100 text-slate-800 hover:bg-slate-700 hover:text-white">UPLOAD</button>
            </div>
        </div>
    </form>    
    </section>
</body>
</html>