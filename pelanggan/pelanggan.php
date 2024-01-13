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
		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					
					<h1>Pelanggan</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Menu</a>
						</li>
						
						<li><i class='bx bx-chevron-right' ></i></li>
						
						<li>
							<a href="#">Pelanggan </a>
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
								<h1>Tambah Pegawai</h1>
								<div class="form-group">
									<label for="nama">Nama:</label><br>
									<input type="text" id="nama" name="nama"><br>
									<label for="nik">NIK:</label><br>
									<input type="text" id="nik" name="nik"><br>
									<label for="alamat">Alamat:</label><br>
									<input type="text" id="alamat" name="alamat"><br>
									<label for="gender">Gender:</label><br>
									<input type="text" id="gender" name="gender"><br>
									<label for="kontak">Kontak:</label><br>
									<input type="text" id="kontak" name="kontak"><br>
								</div>
								<div class="button">
									<input type="submit" value="Simpan">
									<button type="button" id="cancelButton">Batal</button>
								</div>
							</form>
						
					</div>
			</div>




			
			<form action="pelanggan.php" method="POST">
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

							
									$result = mysqli_query($conn, "SELECT * FROM pelanggan WHERE nama LIKE '%$query%' OR alamat LIKE '%$query%' OR nik LIKE '%$query%'");

									while($row = mysqli_fetch_assoc($result)) {
										echo "<tr>";
										echo "<td>" . $row['id_pelanggan'] . "</td>";
										echo "<td>" . $row['nama'] . "</td>";
										echo "<td>" . $row['alamat'] . "</td>";
										echo "<td>" . $row['gender'] . "</td>";
										echo "<td>" . $row['kontak'] . "</td>";
										echo "<td>" . $row['nik'] . "</td>";
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