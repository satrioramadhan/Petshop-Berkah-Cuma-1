<?php
require '../config/conn.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id_pelanggan = $_POST['id_pelanggan'];
    $nama = $_POST['nama'];
    $nik = $_POST['nik'];
    $alamat = $_POST['alamat'];
    $gender = $_POST['gender'];
    $kontak = $_POST['kontak'];

    $update = "UPDATE pelanggan
               SET nama = ?, nik = ?, alamat = ?, gender = ?, kontak = ?
               WHERE id_pelanggan = ?";

    $stmt = mysqli_prepare($conn, $update);

    mysqli_stmt_bind_param($stmt, "sssssi", $nama, $nik, $alamat, $gender, $kontak, $id_pelanggan);

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
