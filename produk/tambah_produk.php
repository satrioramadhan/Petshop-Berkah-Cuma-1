<?php
require '../config/conn.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Ambil data dari permintaan
    $id_produk = $_POST['id_produk'];
    $nama_produk = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    // Cek apakah id_produk sudah terdaftar
    $result = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk = '$id_produk'");

    if (mysqli_num_rows($result) > 0) {
        // id_produk sudah terdaftar, lakukan update
        $update = "UPDATE produk
                   SET nama_produk = ?, harga = ?, stok = ?, is_deleted = 'N'
                   WHERE id_produk = ?";

        $stmt = mysqli_prepare($conn, $update);
        mysqli_stmt_bind_param($stmt, "sdsi", $nama_produk, $harga, $stok, $id_produk);

        if (mysqli_stmt_execute($stmt)) {
            $response['status_code'] = 200;
            $response['message'] = "Data berhasil diperbarui";
        } else {
            $response['status_code'] = 500;
            $response['message'] = "Gagal memperbarui data: " . mysqli_error($conn);
        }
    } else {
        // id_produk belum terdaftar, lakukan insert
        $insert = "INSERT INTO produk (id_produk, nama_produk, harga, stok, is_deleted)
                   VALUES (?, ?, ?, ?, 'N')";

        $stmt = mysqli_prepare($conn, $insert);
        mysqli_stmt_bind_param($stmt, "ssdi", $id_produk, $nama_produk, $harga, $stok);

        if (mysqli_stmt_execute($stmt)) {
            $response['status_code'] = 200;
            $response['message'] = "Data berhasil ditambahkan";
        } else {
            $response['status_code'] = 500;
            $response['message'] = "Gagal menambahkan data: " . mysqli_error($conn);
        }
    }

    echo json_encode($response);
} else {
    $response['status_code'] = 400;
    $response['message'] = "Bad Request: Method not allowed";
    echo json_encode($response);
}
?>
