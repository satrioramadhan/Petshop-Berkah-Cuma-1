<?php
require '../config/conn.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Ambil data dari formulir
    $idPegawai = $_POST['idPegawai'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Lakukan operasi insert tanpa memeriksa id_pelanggan
    $insert = "INSERT INTO user (id_pegawai, username, password) 
               VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $insert);
    mysqli_stmt_bind_param($stmt, "sss", $idPegawai, $username, $password);

    if (mysqli_stmt_execute($stmt)) {
        $response['status_code'] = 200;
        $response['message'] = "Data berhasil ditambahkan";
    } else {
        $response['status_code'] = 500;
        $response['message'] = "Gagal menambahkan data: " . mysqli_error($conn);
    }

    echo json_encode($response);

    // Tutup koneksi statement
    mysqli_stmt_close($stmt);
} else {
    $response['status_code'] = 400;
    $response['message'] = "Bad Request: Method not allowed";
    echo json_encode($response);
}
?>
