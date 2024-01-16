<?php
require '../config/conn.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id_pegawai = $_POST['id_pegawai'];
    $nama = $_POST['nama'];
    $nik = $_POST['nik'];
    $alamat = $_POST['alamat'];
    $jabatan = $_POST['jabatan'];
    $gender = $_POST['gender'];
    $kontak = $_POST['kontak'];
    $gaji = $_POST['gaji'];

    $update = "UPDATE pegawai
               SET nama = ?, nik = ?, alamat = ?, jabatan = ?, gender = ?, kontak = ?, gaji = ?
               WHERE id_pegawai = ?";

    $stmt = mysqli_prepare($conn, $update);

    mysqli_stmt_bind_param($stmt, "sssssssi", $nama, $nik, $alamat, $jabatan, $gender, $kontak, $gaji, $id_pegawai);

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