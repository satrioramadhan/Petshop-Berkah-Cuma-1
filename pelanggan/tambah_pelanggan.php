<?php
require '../config/conn.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Ambil data dari permintaan
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $kontak = $_POST['kontak'];
    $gender = $_POST['gender'];
    $nik = $_POST['nik'];

    // Cek apakah NIK sudah terdaftar
    $cekNik = mysqli_query($conn, "SELECT * FROM `pelanggan` WHERE nik='$nik'");
    if (mysqli_num_rows($cekNik) > 0) {
        $response['status_code'] = 201;
        $response['message'] = "NIK SUDAH TERDAFTAR";
        echo json_encode($response);
    } else {
        // Insert data pelanggan baru
        $id_pelanggan_query = mysqli_query($conn, "SELECT * FROM `pelanggan` ORDER BY id_pelanggan DESC LIMIT 1");

        if ($id_pelanggan_query) {
            $da = mysqli_fetch_array($id_pelanggan_query);
            if ($da) {
                $id_pelanggan = $da['id_pelanggan'] + 1;
            } else {
                $id_pelanggan = 1;
            }
        } else {
            $response['status_code'] = 201;
            $response['message'] = "Error saat mengambil id_pelanggan";
            echo json_encode($response);
            exit();
        }

        $insert = "INSERT INTO pelanggan (id_pelanggan, nama, alamat, kontak, gender, nik)
                   VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $insert);

        // Bind parameters
        mysqli_stmt_bind_param($stmt, "isssss", $id_pelanggan, $nama, $alamat, $kontak, $gender, $nik);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            $response['id_pelanggan'] = (string)$id_pelanggan;
            $response['nik'] = $nik;
            $response['nama'] = $nama;
            $response['alamat'] = $alamat;
            $response['kontak'] = $kontak;
            $response['gender'] = $gender;
            $response['status_code'] = 200;
            $response['message'] = "BERHASIL";
            echo json_encode($response);
        } else {
            $response['status_code'] = 201;
            $response['message'] = "GAGAL!";
            echo json_encode($response);
        }
    }
}
?>
