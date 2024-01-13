<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="style_pet.css">

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
        <li class="active">
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
		<main>
			<div class="head-title">
				<div class="left">
					
					<h1>Pet</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Menu</a>
						</li>
						
						<li><i class='bx bx-chevron-right' ></i></li>
						
						<li>
							<a href="#">Pet</a>
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
								<h1>Tambah Pet</h1>
								<div class="form-group">
									<label for="id_pet">ID Pet:</label><br>
									<input type="text" id="id_pet" name="id_pet"><br>
									<label for="nama">Nama Pet:</label><br>
									<input type="text" id="nama" name="nama"><br>
									<label for="jenis">Jenis Pet:</label><br>
									<input type="text" id="jenis" name="jenis"><br>
									<label for="ras">Ras:</label><br>
									<input type="text" id="ras" name="ras"><br>
									<label for="tgl_lahir">Tanggal Lahir:</label><br>
									<input type="date" id="tgl_lahir" name="tgl_lahir"><br>
									<label for="pelanggan_id_pelanggan">ID Pelanggan:</label><br>
									<input type="text" id="pelanggan_id_pelanggan" name="pelanggan_id_pelanggan"><br>
								</div>

								<div class="button">
									<input type="submit" value="Simpan">
									<button type="button" id="cancelButton">Batal</button>
								</div>
							</form>
						
					</div>
			</div>




			
			<form action="pet.php" method="POST">
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
										<th>ID Pet</th>
										<th>Nama Pet</th>
										<th>Jenis Pet</th>
										<th>Ras</th>
										<th>Tanggal Lahir</th>
										<th>Pemilik</th>
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

									// Query untuk mencari data pet berdasarkan nama, jenis, atau nama pemilik
									$result = mysqli_query($conn, "SELECT pet.id_pet, pet.nama, pet.jenis, pet.ras, pet.tgl_lahir, pelanggan.nama AS pemilik FROM pet JOIN pelanggan ON pet.pelanggan_id_pelanggan = pelanggan.id_pelanggan WHERE pet.nama LIKE '%$query%' OR pet.jenis LIKE '%$query%' OR pelanggan.nama LIKE '%$query%'");

									while($row = mysqli_fetch_assoc($result)) {
										echo "<tr>";
										echo "<td>" . $row['id_pet'] . "</td>";
										echo "<td>" . $row['nama'] . "</td>";
										echo "<td>" . $row['jenis'] . "</td>";
										echo "<td>" . $row['ras'] . "</td>";
										echo "<td>" . $row['tgl_lahir'] . "</td>";
										echo "<td>" . $row['pemilik'] . "</td>";
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