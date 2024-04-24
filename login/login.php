<?php
require '../function/conect/index.php';

session_start();

if (isset($_SESSION["login"])) {
  header("Location: ../index.php");
}

if ( isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

    if (mysqli_num_rows($result) === 1) {
      $row = mysqli_fetch_assoc($result);
      var_dump($row);
      if (md5($password, $row["password"])) {
        $_SESSION["login"] = true;
        $_SESSION["user_id"] = $row["user_id"];
        $_SESSION["username"] = $row["username"];
        $_SESSION["password"] = $row["password"];
        $_SESSION["email"] = $row["email"];
        $_SESSION["nama_lengkap"] = $row["nama_lengkap"];
        $_SESSION["alamat"] = $row["alamat"];

        header("Location: ../index.php");

      }
    }

    
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Log in</title>
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
  <section class="max-w-[850px] mx-auto mt-24 drop-shadow shadow-lg">
    <form action="" method="post" class="flex gap-x-6">
      <div class="">
        <img src="../asset/gunung.jpg" alt="" class="max-w-md rounded-l-md h-full">
      </div>
      <div class="pt-4 pb-12 grid gap-y-4">
        <h1 class="font-bold text-[40px] text-slate-700">Galery <span class="text-slate-500">Website</span></h1>
        <div class="grid gap-y-1">
          <label for="username" class="font-semibold text-slate-600 text-lg">Username</label>
          <input type="text" name="username" id="username" class="border-b focus:outline-none text-slate-500 text-md p-1">
        </div>
        <div class="grid gap-y-1 mt-2">
          <label for="password" class="font-semibold text-slate-600 text-lg">Password</label>
          <input type="password" name="password" id="password" class="border-b focus:outline-none text-slate-500 text-md p-1">
        </div>
        <div class="mt-4 items-end">
          <button type="submit" name="login" class="px-4 py-2 rounded-md bg-gray-100 text-lg font-semibold text-slate-800 hover:bg-slate-700 hover:text-white">Log in</button>
        </div>
      </div>
    </form>
  </section>
</body>

</html>