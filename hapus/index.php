<?php
require '../function/conect/index.php';

$foto_id = $_GET["foto_id"];

mysqli_query($conn, "DELETE FROM foto WHERE foto_id = $foto_id");

header("Location: ../index.php");


?>