<?php
require '../config/conn.php';

if (isset($_GET['table']) && isset($_GET['id_column']) && isset($_GET['id'])) {
    $response = array();

    $table = $_GET['table'];
    $id_column = $_GET['id_column'];
    $id = $_GET['id'];

    // Ubah is_deleted menjadi DELETE untuk menghapus baris
    $deleteQuery = "DELETE FROM $table WHERE $id_column = '$id'";

    if (mysqli_query($conn, $deleteQuery)) {
        $response['status_code'] = 200;
        $response['message'] = "Data berhasil dihapus";
        echo json_encode($response);
    } else {
        $response['status_code'] = 500; // Internal Server Error
        $response['message'] = "Terjadi kesalahan: " . mysqli_error($conn);
        echo json_encode($response);
    }
} else {
    $response = array();
    $response['status_code'] = 400; // Bad Request
    $response['message'] = "Parameter tidak lengkap.";
    echo json_encode($response);
}
?>
