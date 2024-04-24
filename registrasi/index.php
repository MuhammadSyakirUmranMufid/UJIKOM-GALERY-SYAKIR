<?php
require '../function/conect/index.php';


if (isset($_POST["submit"])) {
    if (tambahUser($_POST) > 0) {
        echo "
        <script>
        alert('data tambah');
        window.location.href = '../login/login.php';
        </script>
       
        ";
        
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>registrasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <main class="px-16 py-4"> 
        <section class="bg-gray-50 bg-opacity-50 px-2 py-2">
              <nav class="flex justify-between">
                <div class="block">
                  <a class="font-bold text-xl italic text-slate-600" a="#">Muh Syakir</a>
                </div>
              <div class="block uppercase text-md font-semibold flex gap-x-8">
                    <a href="../" class="hover:border-b p-2">Galery</a>
                    <a href="#" class="border-b font-bold italic p-2" >Registrasi</a>
                    <a href="../function/logout/" class="hover:border-b p-2">log out</a>
              </div>
              </nav>
            </section>
            <section class="max-w-lg mx-auto mt-24 shadow-md">
                <form action="" method="post" class="grid gap-y-4 px-4 py-4">
                    <div class="grid grid-cols-2 gap-x-8 gap-y-4">
                        <div class="grid gap-y-1 mt-2">
                            <label for="username" class="font-semibold text-slate-600 text-lg">Username</label>
                            <input type="usermame" name="username" id="username" class="border-b focus:outline-none text-slate-500 text-md p-1">
                        </div>
                        <div class="grid gap-y-1">
                            <label for="password" class="font-semibold text-slate-600 text-lg">password</label>
                            <input type="password" name="password" id="password" class="border-b focus:outline-none text-slate-500 text-md p-1">
                        </div>
                        <div class="grid gap-y-1">
                            <label for="email" class="font-semibold text-slate-600 text-lg">email</label>
                            <input type="email" name="email" id="email" class="border-b focus:outline-none text-slate-500 text-md p-1">
                        </div>
                        <div class="grid gap-y-1">
                            <label for="nama_lengkap" class="font-semibold text-slate-600 text-lg">nama lengkap</label>
                            <input type="text" name="nama_lengkap" id="nama_lengkap" class="border-b focus:outline-none text-slate-500 text-md p-1">
                        </div>
                    </div>
                    <div class="grid gap-y-1 w-full">
                        <label for="alamat">alamat</label>
                        <textarea name="alamat" id="alamat" class="block border"></textarea>
                    </div>
                    <div>
                        <button type="submit" name="submit">Registrasi</button>
                    </div>
                </form>
        </section>
    </main>
</body>

</html>