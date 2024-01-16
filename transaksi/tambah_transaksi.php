<?php
require '../config/conn.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $tglTransaksi = $_POST['tglTransaksi'];
    $idProduk = $_POST['idProduk'];
    $jumlahBarang = $_POST['jumlahBarang'];
    $totalHarga = $_POST['totalHarga'];

    // Validasi stok
    $resultStok = mysqli_query($conn, "SELECT stok FROM produk WHERE id_produk = '$idProduk'");
    $rowStok = mysqli_fetch_assoc($resultStok);
    $stokProduk = $rowStok['stok'];

    if ($jumlahBarang > $stokProduk) {
        // Jumlah barang melebihi stok yang tersedia
        $response['status_code'] = 400;
        $response['message'] = "Jumlah barang melebihi stok yang tersedia.";
    } else {
        // Lanjutkan dengan menambah transaksi jika validasi berhasil
        $insert = "INSERT INTO transaksi (tgl_transaksi, id_produk, jumlah_barang, total_harga) VALUES ('$tglTransaksi', '$idProduk', '$jumlahBarang', '$totalHarga')";

        if (mysqli_query($conn, $insert)) {
            // Update stok produk
            $updateStok = "UPDATE produk SET stok = stok - '$jumlahBarang' WHERE id_produk = '$idProduk'";
            mysqli_query($conn, $updateStok);

            $response['status_code'] = 200;
            $response['message'] = "Data transaksi berhasil ditambahkan";
        } else {
            $response['status_code'] = 500;
            $response['message'] = "Gagal menambah data transaksi: " . mysqli_error($conn);
        }
    }

    echo json_encode($response);
} else {
    $response['status_code'] = 400;
    $response['message'] = "Bad Request: Method not allowed";
    echo json_encode($response);
}
?>