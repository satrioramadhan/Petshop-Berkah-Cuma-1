<?php
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION["username"])) {
    // Jika belum, arahkan ke halaman login
    header("Location: ../login/login.php");
    exit();
}
?>
<?php
require '../config/conn.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="style_pelanggan.css">

	<title>Berkah Petshop</title>
</head>
<body>

	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<i class='bx bxs-smile'></i>
			<span class="text">Berkah Petshop</span>
		</a>
		<ul class="side-menu top">
			<li>
				<a href="../index/index.php">
					<i class="bx bxs-dashboard"></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li>
				<a href="../pegawai/pegawai.php">
					<i class="bx bxs-data"></i>
					<span class="text">Pegawai</span>
				</a>
			</li>
			<li>
				<a href="../produk/produk.php">
					<i class="bx bxs-data"></i>
					<span class="text">Produk</span>
				</a>
			</li>
			<!-- <li>
				<a href="../pemeriksaan/pemeriksaan.php">
					<i class="bx bxs-data"></i>
					<span class="text">Pemeriksaan</span>
				</a>
			</li>
			<li>
				<a href="../pet/pet.php">
					<i class="bx bxs-data"></i>
					<span class="text">Pet</span>
				</a>
			</li> -->
			<li  class="active">
				<a href="../pelanggan/pelanggan.php">
					<i class="bx bxs-data"></i>
					<span class="text">Pelanggan</span>
				</a>
			</li>
			<li>
				<a href="../transaksi/transaksi.php">
					<i class="bx bxs-data"></i>
					<span class="text">Transaksi</span>
				</a>
			</li>
			<li>
				<a href="../user/user.php">
					<i class="bx bxs-data"></i>
					<span class="text">User</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
        <li>
            <a href="../logout/logout.php" class="logout">
                <i class='bx bxs-log-out-circle'></i>
                <span class="text">Logout</span>
            </a>
        </li>>
		</ul>
	</section>
	<!-- SIDEBAR -->

	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu' ></i>
			<a href="#" class="nav-link">Categories</a>
			<form action="#">
				<div class="form-input">
					<input type="search" placeholder="Search...">
					<button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
				</div>
			</form>
			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>
			
			<a href="#" class="profile">
				<img src="img/people.png">
			</a>
		</nav>
		<!-- NAVBAR -->
		
		<!-- MAIN -->
		<main>
            <div class="head-title">
                <div class="left">

                    <h1>Pelanggan</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a href="#">Menu</a>
                        </li>

                        <li><i class='bx bx-chevron-right'></i></li>

                        <li>
                            <a href="#">Pelanggan </a>
                        </li>

                        <li>|</li>

                        <li>
                            <a class="active" href="#">Tambah</a>
                        </li>

                    </ul>
                </div>
            </div>

            <!-- Form Tambah Pelanggan -->
            <div id="formPopup" class="form-popup">
                <div class="form-container">
                    <form action="tambah_pelanggan.php" method="POST">
                        <h1>Tambah Pelanggan</h1>
                        <div class="form-group">
                            <label for="nama">Nama:</label><br>
                            <input type="text" id="nama" name="nama" required><br>
                            <label for="nik">NIK:</label><br>
                            <input type="text" id="nik" name="nik" required><br>
                            <label for="alamat">Alamat:</label><br>
                            <input type="text" id="alamat" name="alamat" required><br>
                            <label for="gender">Gender:</label><br>
                            <div class="custom-select">
                                <select id="gender" name="gender" required>
                                    <option value="Laki - laki">Laki - laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div><br>
                            <label for="kontak">Kontak:</label><br>
                            <input type="tel" id="kontak" name="kontak" required><br>
                        </div>
                        <div class="button">
                            <input type="submit" value="Simpan">
                            <button type="button" id="cancelButton">Batal</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- ... Bagian edit ... -->

            <div id="formEditPopup" class="form-popup">
                <div class="form-container">
                    <form id="formEdit" action="edit_pelanggan.php" method="POST">
                        <h1>Edit Pelanggan</h1>
                        <div class="form-group">
                            <input type="hidden" id="editIdPelanggan" name="id_pelanggan">
                            <label for="editNama">Nama:</label><br>
                            <input type="text" id="editNama" name="nama" required><br>
                            <label for="editNik">NIK:</label><br>
                            <input type="text" id="editNik" name="nik" required><br>
                            <label for="editAlamat">Alamat:</label><br>
                            <input type="text" id="editAlamat" name="alamat" required><br>
                            <label for="editGender">Gender:</label><br>
                            <div class="custom-select">
                                <select id="editGender" name="gender" required>
                                    <option value="Laki - laki">Laki - laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div><br>
                            <label for="editKontak">Kontak:</label><br>
                            <input type="tel" id="editKontak" name="kontak" required><br>
                        </div>
                        <div class="button">
                            <input type="submit" value="Simpan">
                            <button type="button" id="cancelEditButton">Batal</button>
                        </div>
                    </form>
                </div>
            </div>

            <script>
                const formEditPelanggan = document.querySelector('#formEditPopup form');
                const cancelEditButton = document.getElementById('cancelEditButton');

                formEditPelanggan.addEventListener('submit', function (event) {
                    event.preventDefault();
                    handleEditPelanggan(formEditPelanggan, 'edit_pelanggan.php');
                });

                if (cancelEditButton) {
                    cancelEditButton.addEventListener('click', function () {
                        tutupFormEdit();
                    });
                }

                function tutupFormEdit() {
                    const formEdit = document.querySelector('#formEditPopup');
                    formEdit.style.display = "none";
                }
            </script>

            <form action="pelanggan.php" method="POST">
                <div class="form-input">
                    <input type="search" name="query" placeholder="Search...">
                    <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
                </div>
            </form>

            <!-- Tabel data pelanggan -->
            <div class="table-data">
                <div class="order">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Gender</th>
                                <th>Kontak</th>
                                <th>NIK</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require '../config/conn.php';

                            $query = "";
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                $query = $_POST['query'];
                            }

                            // Query untuk mencari data pelanggan yang belum dihapus
                            $result = mysqli_query($conn, "SELECT * FROM pelanggan WHERE is_deleted != 'Y' AND (nama LIKE '%$query%' OR alamat LIKE '%$query%' OR nik LIKE '%$query%')");	

                            while ($row = mysqli_fetch_assoc($result)) {
								echo "<tr>";
								echo "<td>" . $row['id_pelanggan'] . "</td>";
								echo "<td>" . $row['nama'] . "</td>";
								echo "<td>" . $row['alamat'] . "</td>";
								echo "<td>" . $row['gender'] . "</td>";
								echo "<td>" . $row['kontak'] . "</td>";
								echo "<td>" . $row['nik'] . "</td>";
								echo "<td><a href='#' class='emot' onclick=\"console.log('ID Pelanggan: " . $row['id_pelanggan'] . "'); tampilkanFormEdit('" . $row['id_pelanggan'] . "')\"><i class='bx bx-edit-alt'></i></a>";
								echo "<a href='#' class='emot' onclick=\"hapusDataPelanggan('" . $row['id_pelanggan'] . "', 'pelanggan', 'id_pelanggan', 'delete_pelanggan.php')\"><i class='bx bx-trash'></i></a></td>";
								echo "</tr>";
							}
							
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
        <!-- MAIN -->
    </section>
    <!-- POPUP -->

    <script>
        const formTambahPelanggan = document.querySelector('#formPopup form');
        const tambahPelangganUrl = 'tambah_pelanggan.php';

        if (formTambahPelanggan) {
            formTambahPelanggan.addEventListener('submit', function (event) {
                event.preventDefault();
                handleTambahPelanggan(formTambahPelanggan, tambahPelangganUrl);
            });
        }
    </script>

    <script>
        function tampilkanFormEdit(idPelanggan) {
            const formEdit = document.querySelector('#formEditPopup');
            const editUrl = 'get_pelanggan.php?id=' + idPelanggan;

            fetch(editUrl)
                .then(response => {
                    console.log('Response status:', response.status);
                    return response.json();
                })
                .then(data => {
                    console.log('Data dari server:', data);

                    if (data.id_pelanggan) {
                        // Mengisi data ke dalam form edit
                        formEdit.querySelector('#editIdPelanggan').value = data.id_pelanggan;
                        formEdit.querySelector('#editNama').value = data.nama;
                        formEdit.querySelector('#editNik').value = data.nik;
                        formEdit.querySelector('#editAlamat').value = data.alamat;
                        formEdit.querySelector('#editGender').value = data.gender;
                        formEdit.querySelector('#editKontak').value = data.kontak;

                        // Menampilkan popup form edit
                        formEdit.style.display = "flex";

                        // Memeriksa mode gelap setiap kali popup dibuka
                        if (localStorage.getItem('dark-mode') === 'true') {
                            formEdit.classList.add('dark-mode');
                        } else {
                            formEdit.classList.remove('dark-mode');
                        }
                    } else {
                        tampilkanPopupGagal('Error', 'Gagal mendapatkan data pelanggan.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    tampilkanPopupKesalahan('Ada kesalahan sistem.', 'Data pelanggan tidak dapat diambil.');
                });
        }
    </script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="../script.js"></script>
</body>

</html>