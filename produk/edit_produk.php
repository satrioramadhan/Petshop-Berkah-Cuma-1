<?php
require '../config/conn.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id_produk = $_POST['id_produk'];
    $nama_produk = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    $update = "UPDATE produk
               SET nama_produk = ?, harga = ?, stok = ?
               WHERE id_produk = ?";

    $stmt = mysqli_prepare($conn, $update);

    mysqli_stmt_bind_param($stmt, "siii", $nama_produk, $harga, $stok, $id_produk);

    if (mysqli_stmt_execute($stmt)) {
        $response['status_code'] = 200;
        $response['message'] = "Data berhasil diupdate";
        echo json_encode($response);
    } else {
        $response['status_code'] = 500;
        $response['message'] = "Gagal mengupdate data: " . mysqli_error($conn);
        echo json_encode($response);
    }
} else {
    $response['status_code'] = 400;
    $response['message'] = "Bad Request: Method not allowed";
    echo json_encode($response);
}
?>
