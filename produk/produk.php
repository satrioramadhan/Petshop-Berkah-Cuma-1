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
	<link rel="stylesheet" href="style_produk.css">

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
        <li class="active">
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
        <li>
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
        </li>
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

                    <h1>Produk</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a href="#">Menu</a>
                        </li>

                        <li><i class='bx bx-chevron-right'></i></li>

                        <li>
                            <a href="#">Produk </a>
                        </li>

                        <li>|</li>

                        <li>
                            <a class="active" href="#">Tambah</a>
                        </li>

                    </ul>
                </div>
            </div>

            <!-- Form Tambah Produk -->
            <div id="formPopup" class="form-popup">
                <div class="form-container">
                    <form action="tambah_produk.php" method="POST">
                        <h1>Tambah Produk</h1>
                        <div class="form-group">
							<label for="id_produk">ID Produk:</label><br>
                            <input type="text" id="id_produk" name="id_produk" required><br>
                            <label for="nama_produk">Nama Produk:</label><br>
                            <input type="text" id="nama_produk" name="nama_produk" required><br>
                            <label for="harga">Harga:</label><br>
                            <input type="number" id="harga" name="harga" required><br>
                            <label for="stok">Stok:</label><br>
                            <input type="number" id="stok" name="stok" required><br>
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
                    <form id="formEdit" action="edit_produk.php" method="POST">
                        <h1>Edit Produk</h1>
                        <div class="form-group">
							<label for="editIdproduk">ID Produk:</label><br>
                            <input type="text" id="editIdProduk" name="id_produk" readonly required><br>
                            <label for="editNamaProduk">Nama Produk:</label><br>
                            <input type="text" id="editNamaProduk" name="nama_produk" required><br>
                            <label for="editHarga">Harga:</label><br>
                            <input type="number" id="editHarga" name="harga" required><br>
                            <label for="editStok">Stok:</label><br>
                            <input type="number" id="editStok" name="stok" required><br>
                        </div>
                        <div class="button">
                            <input type="submit" value="Simpan">
                            <button type="button" id="cancelEditButton">Batal</button>
                        </div>
                    </form>
                </div>
            </div>

            <script>
                const formEditProduk = document.querySelector('#formEditPopup form');
                const cancelEditButton = document.getElementById('cancelEditButton');

                formEditProduk.addEventListener('submit', function (event) {
                    event.preventDefault();
                    handleEditProduk(formEditProduk, 'edit_produk.php');
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

            <form action="produk.php" method="POST">
                <div class="form-input">
                    <input type="search" name="query" placeholder="Search...">
                    <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
                </div>
            </form>

            <!-- Tabel data produk -->
            <div class="table-data">
				<div class="order">
					<table>
						<thead>
							<tr>
								<th>ID</th>
								<th>Nama Produk</th>
								<th>Harga</th>
								<th>Stok</th>
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

							// Query untuk mencari data produk yang belum dihapus
							$result = mysqli_query($conn, "SELECT * FROM produk WHERE is_deleted != 'Y' AND (nama_produk LIKE '%$query%' OR harga LIKE '%$query%' OR stok LIKE '%$query%')");

							while ($row = mysqli_fetch_assoc($result)) {
								echo "<tr>";
								echo "<td>" . htmlspecialchars($row['id_produk']) . "</td>";
								echo "<td>" . htmlspecialchars($row['nama_produk']) . "</td>";
								echo "<td>" . htmlspecialchars($row['harga']) . "</td>";
								echo "<td>" . htmlspecialchars($row['stok']) . "</td>";
								echo "<td>";
                                echo "<a href='#' class='emot' onclick=\"console.log('ID PROduk: " . $row['id_produk'] . "'); tampilkanFormEdit('" . $row['id_produk'] . "')\"><i class='bx bx-edit-alt'></i></a>";
								echo "<a href='#' class='emot' onclick=\"hapusDataProduk('" . $row['id_produk'] . "', 'produk', 'id_produk', 'delete_produk.php')\"><i class='bx bx-trash'></i></a>";
                                echo "</td>";
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
        const formTambahProduk = document.querySelector('#formPopup form');
        const tambahProdukUrl = 'tambah_produk.php';

        if (formTambahProduk) {
            formTambahProduk.addEventListener('submit', function (event) {
                event.preventDefault();
                handleTambahProduk(formTambahProduk, tambahProdukUrl);
            });
        }
    </script>

    <script>
        function tampilkanFormEdit(idProduk) {
            const formEdit = document.querySelector('#formEditPopup');
            const editUrl = 'get_produk.php?id=' + idProduk;

            fetch(editUrl)
                .then(response => {
                    console.log('Response status:', response.status);
                    return response.json();
                })
                .then(data => {
                    console.log('Data dari server:', data);

                    if (data.id_produk) {
                        // Mengisi data ke dalam form edit
                        formEdit.querySelector('#editIdProduk').value = data.id_produk;
                        formEdit.querySelector('#editNamaProduk').value = data.nama_produk;
                        formEdit.querySelector('#editHarga').value = data.harga;
                        formEdit.querySelector('#editStok').value = data.stok;

                        
                        // Menampilkan popup form edit
                        formEdit.style.display = "flex";

                        // Memeriksa mode gelap setiap kali popup dibuka
                        if (localStorage.getItem('dark-mode') === 'true') {
                            formEdit.classList.add('dark-mode');
                        } else {
                            formEdit.classList.remove('dark-mode');
                        }
                    } else {
                        tampilkanPopupGagal('Error', 'Gagal mendapatkan data produk.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    tampilkanPopupKesalahan('Ada kesalahan sistem.', 'Data produk tidak dapat diambil.');
                });
        }
    </script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="../script.js"></script>
</body>

</html>
