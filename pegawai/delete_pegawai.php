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
        $response['message'] = "udah dihapus";
        echo json_encode($response);
    } else {
        $response['status_code'] = 500; // Internal Server Error
        $response['message'] = "yah ada kesalahan nih: " . mysqli_error($conn);
        echo json_encode($response);
    }
} else {
    $response = array();
    $response['status_code'] = 400; // Bad Request
    $response['message'] = "Parameter tidak lengkap.";
    echo json_encode($response);
}



//Demo kesalahan

// require '../config/conn.php';

// if (isset($_GET['table']) && isset($_GET['id_column']) && isset($_GET['id'])) {
//     $response = array();

//     $table = $_GET['table'];
//     $id_column = $_GET['id_column'];
//     $id = $_GET['id'];

//     // Simulasi keadaan kesalahan (selalu menghasilkan kesalahan)
//     $simulasiKesalahan = true;

//     if ($simulasiKesalahan) {
//         $response['status_code'] = 500; // Internal Server Error
//         $response['message'] = "ada kesalahan server nihh maap ya.";
//         echo json_encode($response);
//     } else {
//         $update = "UPDATE $table
//                    SET is_deleted = 'Y'
//                    WHERE $id_column = '$id'";

//         if (mysqli_query($conn, $update)) {
//             $response['status_code'] = 200;
//             $response['message'] = "BERHASIL DIHAPUS";
//             echo json_encode($response);
//         } else {
//             $response['status_code'] = 201;
//             $response['message'] = "GAGAL DIHAPUS: " . mysqli_error($conn);
//             echo json_encode($response);
//         }
//     }
// } else {
//     $response = array();
//     $response['status_code'] = 400; // Bad Request
//     $response['message'] = "Parameter tidak lengkap.";
//     echo json_encode($response);
// }




// Simulasi keadaan gagal (ubah true menjadi false)
// require '../config/conn.php';

// if (isset($_GET['table']) && isset($_GET['id_column']) && isset($_GET['id'])) {
//     $response = array();

//     $table = $_GET['table'];
//     $id_column = $_GET['id_column'];
//     $id = $_GET['id'];

    
//     $simulasiGagal = true;

//     if ($simulasiGagal) {
//         $response['status_code'] = 201;
//         $response['message'] = "duhh datanya gagal dihapus";
//         echo json_encode($response);
//     } else {
//         $update = "UPDATE $table
//                    SET is_deleted = 'Y'
//                    WHERE $id_column = '$id'";

//         if (mysqli_query($conn, $update)) {
//             $response['status_code'] = 200;
//             $response['message'] = "BERHASIL DIHAPUS";
//             echo json_encode($response);
//         } else {
//             $response['status_code'] = 201;
//             $response['message'] = "GAGAL DIHAPUS: " . mysqli_error($conn);
//             echo json_encode($response);
//         }
//     }
// } else {
//     $response = array();
//     $response['status_code'] = 400; // Bad Request
//     $response['message'] = "Parameter tidak lengkap.";
//     echo json_encode($response);
// }
?>

