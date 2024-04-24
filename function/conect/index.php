<?php 
$conn = mysqli_connect("localhost", "root", "", "ujikom");


function query ($query)  
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
};
function tambahUser ($data) {
    global $conn;

    $username = $data["username"];
    $password = $data["password"];
    $email = $data["email"];
    $namaLengkap = $data["nama_lengkap"];
    $alamat = $data["alamat"];


    $query = "INSERT INTO user VALUES ('', '$username', '$password', '$email', '$namaLengkap', '$alamat')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
};

function upload () {
    $namaFile = $_FILES['lokasi_file']['name'];
    $ukuranFile = $_FILES['lokasi_file']['size'];
    $error = $_FILES['lokasi_file']['error'];
    $tmpName= $_FILES['lokasi_file']['tmp_name'];

    if ( $error === 4 ) {
     echo "<script>
     alert('Pilih Gambar');
     </script>";   
     return false;
    };


    $ekstensiGambarValid = ['jpg', 'png', 'jpeg'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if ( !in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
        alert('Bukan Gambar');
        </script>";
        return false;   
    };

    if ($ukuranFile > 10000000) {
        echo "<script>
        alert('Ukuran Gambar Terlalu Besar');
        </script>";
        return false;   
    };

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;



    move_uploaded_file($tmpName, './../stockPhoto/' . $namaFileBaru);

    return $namaFileBaru;
}
?>