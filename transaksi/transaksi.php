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
        <li>
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
        </li>
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
      </ul>
		<ul class="side-menu">
			
			<li>
				<a href="#" class="logout">
					<i class='bx bxs-log-out-circle' ></i>
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
					<form>
						<h1>Tambah Transaksi</h1>
						<div class="form-group">
							<label for="idTransaksi">ID Transaksi:</label><br>
							<input type="text" id="idTransaksi" name="idTransaksi"><br>
							<label for="tglTransaksi">Tanggal Transaksi:</label><br>
							<input type="date" id="tglTransaksi" name="tglTransaksi"><br>
							<label for="idProduk">ID Produk:</label><br>
							<input type="text" id="idProduk" name="idProduk"><br>
							<label for="jumlahBarang">Jumlah Barang:</label><br>
							<input type="number" id="jumlahBarang" name="jumlahBarang"><br>
							<label for="totalHarga">Total Harga:</label><br>
							<input type="number" id="totalHarga" name="totalHarga"><br>
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
					<button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
				</div>
			</form>

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
							require '../config/conn.php';

							$query = "";
							if ($_SERVER["REQUEST_METHOD"] == "POST") {
								$query = $_POST['query'];
							}

							$result = mysqli_query($conn, "SELECT transaksi.id_transaksi, transaksi.tgl_transaksi, produk.nama_produk, transaksi.jumlah_barang, transaksi.total_harga FROM transaksi JOIN produk ON transaksi.id_produk = produk.id_produk WHERE produk.nama_produk LIKE '%$query%' OR transaksi.tgl_transaksi LIKE '%$query%' OR transaksi.total_harga LIKE '%$query%'");

							while($row = mysqli_fetch_assoc($result)) {
								echo "<tr>";
								echo "<td>" . $row['id_transaksi'] . "</td>";
								echo "<td>" . $row['tgl_transaksi'] . "</td>";
								echo "<td>" . $row['nama_produk'] . "</td>";
								echo "<td>" . $row['jumlah_barang'] . "</td>";
								echo "<td>" . $row['total_harga'] . "</td>";
								echo "<td><a href='#' class='emot'><i class='bx bx-edit-alt'></i></a>";
								echo "<a href='#' class='emot'><i class='bx bx-trash'></i></a></td>";
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
	

	<script src="../script.js"></script>
</body>
</html>