<?php
require '../config/conn.php';

if (isset($_GET['table']) && isset($_GET['id_column']) && isset($_GET['id'])) {
    $response = array();

    $table = $_GET['table'];
    $id_column = $_GET['id_column'];
    $id = $_GET['id'];

    $update = "UPDATE $table
               SET is_deleted = 'Y'
               WHERE $id_column = '$id'";

    if (mysqli_query($conn, $update)) {
        $response['status_code'] = 200;
        $response['message'] = "Data berhasil dihapus.";
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
