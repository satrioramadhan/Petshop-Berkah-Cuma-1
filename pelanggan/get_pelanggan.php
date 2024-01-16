<?php
require '../config/conn.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['id'])) {
        $idPelanggan = $_GET['id'];

        // Query untuk mendapatkan data pelanggan berdasarkan ID
        $query = "SELECT * FROM pelanggan WHERE id_pelanggan = $idPelanggan";
        $result = mysqli_query($conn, $query);

        // Buat array asosiatif dengan data pelanggan
        $pelanggan = mysqli_fetch_assoc($result);

        // Kirimkan sebagai respons
        header('Content-Type: application/json');
        echo json_encode($pelanggan);
    } else {
        $response['status_code'] = 400;
        $response['message'] = "ID Pelanggan tidak disediakan";
        echo json_encode($response);
    }
}
?>
