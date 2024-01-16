<?php
require '../config/conn.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['id'])) {
        $idProduk = $_GET['id'];

        // Query untuk mendapatkan data produk berdasarkan ID
        $query = "SELECT * FROM produk WHERE id_produk = $idProduk";
        $result = mysqli_query($conn, $query);

        $produk = mysqli_fetch_assoc($result);

        // Kirimkan sebagai respons
        header('Content-Type: application/json');
        echo json_encode($produk);
    } else {
        $response['status_code'] = 400;
        $response['message'] = "ID Produk tidak disediakan";
        echo json_encode($response);
    }
}
?>