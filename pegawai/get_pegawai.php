<?php
require '../config/conn.php';

// Ambil ID Pegawai dari parameter GET
$idPegawai = $_GET['id'];

// Query untuk mendapatkan data pegawai berdasarkan ID
$query = "SELECT * FROM pegawai WHERE id_pegawai = $idPegawai";
$result = mysqli_query($conn, $query);

// Buat array asosiatif dengan data pegawai
$pegawai = mysqli_fetch_assoc($result);

// Konversi ke JSON dan kirimkan sebagai respons
header('Content-Type: application/json');
echo json_encode($pegawai);
?>
