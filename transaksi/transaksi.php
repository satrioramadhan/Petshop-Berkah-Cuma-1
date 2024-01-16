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
	<link rel="stylesheet" href="style_transaksi.css">

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
        <li>
          <a href="../pelanggan/pelanggan.php">
            <i class="bx bxs-data"></i>
            <span class="text">Pelanggan</span>
          </a>
        </li>
        <li class="active">
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
					
					<h1>Transaksi</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Menu</a>
						</li>
						
						<li><i class='bx bx-chevron-right' ></i></li>
						
						<li>
							<a href="#">Transaksi</a>
						</li>
					
						<li>|</li>
						
						<li>
							<a class="active"  href="#">Tambah</a>
						</li>

					</ul>
				</div>
			</div>
	
			<div id="formPopup" class="form-popup">
				<div class="form-container">
					<form action="tambah_transaksi.php" method="POST" id="formTambahTransaksi">
						<h1>Tambah Transaksi</h1>
						<div class="form-group">
							<label for="tglTransaksi">Tanggal Transaksi:</label><br>
							<input type="date" id="tglTransaksi" name="tglTransaksi" required><br>

							<label for="idProduk">Nama Produk:</label><br>
							<select id="idProduk" name="idProduk" required>
								<?php
								// Ambil data produk dari database
								$resultProduk = mysqli_query($conn, "SELECT id_produk, nama_produk, harga, stok FROM produk WHERE is_deleted != 'Y'");
								while ($rowProduk = mysqli_fetch_assoc($resultProduk)) {
									$keteranganStok = ($rowProduk['stok'] > 0) ? " - Stok: " . $rowProduk['stok'] : " - Stok Kosong";
									echo "<option value='" . $rowProduk['id_produk'] . "' data-harga='" . $rowProduk['harga'] . "'>" . $rowProduk['nama_produk'] . " - Rp " . $rowProduk['harga'] . $keteranganStok . "</option>";
								}
								?>
							</select><br>

							<label for="jumlahBarang">Jumlah Barang:</label><br>
							<input type="number" id="jumlahBarang" name="jumlahBarang" required step="0.01"><br>

							<label for="totalHarga">Total Harga:</label><br>
							<input type="number" id="totalHarga" name="totalHarga" required step="0.01"><br>
						</div>
						<div class="button">
							<input type="submit" value="Simpan">
							<button type="button" id="cancelButton">Batal</button>
						</div>
					</form>
				</div>
			</div>




			

			<form action="transaksi.php" method="POST">
				<div class="form-input">
				<input type="search" name="query" placeholder="Search...">
				<button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
				</div>
			</form>

			<!-- Tabel Data -->
			<div class="table-data">
				<div class="order">
				<table>
					<thead>
						<tr>
							<th>ID Transaksi</th>
							<th>Tanggal Transaksi</th>
							<th>Nama Produk</th>
							<th>Jumlah Barang</th>
							<th>Total Harga</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$query = "";
						if ($_SERVER["REQUEST_METHOD"] == "POST") {
							$query = $_POST['query'];
						}

						$result = mysqli_query($conn, "SELECT transaksi.id_transaksi, transaksi.tgl_transaksi, produk.nama_produk, transaksi.jumlah_barang, transaksi.total_harga 
						FROM transaksi JOIN produk ON transaksi.id_produk = produk.id_produk WHERE produk.nama_produk LIKE '%$query%' OR transaksi.tgl_transaksi LIKE '%$query%' OR transaksi.total_harga LIKE '%$query%'
						ORDER BY transaksi.id_transaksi ASC");

						while ($row = mysqli_fetch_assoc($result)) {
							echo "<tr id='row-" . $row['id_transaksi'] . "'>";
							echo "<td>" . $row['id_transaksi'] . "</td>";
							echo "<td>" . $row['tgl_transaksi'] . "</td>";
							echo "<td>" . $row['nama_produk'] . "</td>";
							echo "<td>" . $row['jumlah_barang'] . "</td>";
							echo "<td>" . $row['total_harga'] . "</td>";
							echo "<td><a href='#' class='emot' onclick=\"hapusDataTransaksi('" . $row['id_transaksi'] . "', 'transaksi', 'id_transaksi', 'delete_transaksi.php')\"><i class='bx bx-trash'></i></a>";
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
	<!-- CONTENT -->
	
	<script>
        const formTambahProduk = document.querySelector('#formPopup form');
        const tambahProdukUrl = 'tambah_transaksi.php';

        if (formTambahProduk) {
            formTambahProduk.addEventListener('submit', function (event) {
                event.preventDefault();
                handleTambahTransaksi(formTambahProduk, tambahProdukUrl);
            });
        }
    </script>

<script>
	document.addEventListener("DOMContentLoaded", function() {
		// Ambil elemen-elemen yang dibutuhkan
		var idProduk = document.getElementById("idProduk");
		var jumlahBarang = document.getElementById("jumlahBarang");
		var totalHarga = document.getElementById("totalHarga");

		// Tambahkan event listener pada perubahan nilai idProduk atau jumlahBarang
		idProduk.addEventListener("change", updateTotalHarga);
		jumlahBarang.addEventListener("input", updateTotalHarga);

		// Fungsi untuk mengupdate total harga
		function updateTotalHarga() {
			// Ambil harga dari atribut data-harga di opsi terpilih
			var selectedOption = idProduk.options[idProduk.selectedIndex];
			var hargaProduk = selectedOption.getAttribute("data-harga");

			// Ambil jumlah barang
			var jumlah = jumlahBarang.value;

			// Hitung total harga
			var total = hargaProduk * jumlah;

			// Tampilkan total harga pada input totalHarga
			totalHarga.value = total.toFixed(2); // Menyertakan 2 digit desimal
		}
	});

	const formTambahTransaksi = document.querySelector('#formTambahTransaksi');

	if (formTambahTransaksi) {
		formTambahTransaksi.addEventListener('submit', function (event) {
			event.preventDefault();  // Menghentikan aksi bawaan formulir

			const jumlahBarang = parseFloat(document.getElementById('jumlahBarang').value);
			const stokProduk = parseFloat(document.getElementById('idProduk').selectedOptions[0].getAttribute('data-stok'));

			if (jumlahBarang > stokProduk) {
				tampilkanPopupGagal('Jumlah barang melebihi stok yang tersedia!');
			} else {
				// Lanjutkan dengan mengirim formulir jika validasi berhasil
				handleTambahTransaksi(formTambahTransaksi, 'tambah_transaksi.php');  // Panggil fungsi handleTambahTransaksi
			}
		});
	}
	</script>


	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="../script.js"></script>
</body>
</html>