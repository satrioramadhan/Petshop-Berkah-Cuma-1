<?php
session_start();
require '../config/conn.php';

// Pastikan pengguna sudah login
if (!isset($_SESSION["username"])) {
    header("Location: ../login/login.php");
    exit();
}

// Cek jabatan pengguna
$queryJabatan = "SELECT jabatan FROM pegawai WHERE id_pegawai = ?";
$stmtJabatan = $conn->prepare($queryJabatan);
$stmtJabatan->bind_param('i', $_SESSION['id_user']);
$stmtJabatan->execute();
$stmtJabatan->bind_result($jabatan);
$stmtJabatan->fetch();
$stmtJabatan->close();

// Jika jabatan bukan "owner" atau "Owner", tampilkan popup
if (!in_array(strtoupper($jabatan), ['OWNER'])) {
    echo '<script>alert("Yahh sayang sekali, kamu tidak punya akses ke sini.");</script>';
    echo '<script>window.location.href = "../index/index.php";</script>'; // Ganti dengan halaman lain yang diinginkan
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<!-- ... bagian HTML lainnya ... -->
</html>



<!DOCTYPE html>
<html lang="en">
<!-- ... bagian HTML lainnya ... -->
</html>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="style_user.css">

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
        <li>
          <a href="../transaksi/transaksi.php">
            <i class="bx bxs-data"></i>
            <span class="text">Transaksi</span>
          </a>
        </li>
		<li class="active">
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
					
					<h1>User</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Menu</a>
						</li>
						
						<li><i class='bx bx-chevron-right' ></i></li>
						
						<li>
							<a  href="#">Pemeriksaan</a>
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
							<form action="tambah_user.php" method="POST" id="formTambahUser">
								<h1>Tambah User</h1>
								<div class="form-group">
								<label for="idPegawai">Nama Pegawai:</label><br>
								<select id="idPegawai" name="idPegawai" required>
									<?php
									require '../config/conn.php';
									// Ambil data pegawai dari database
									$resultPegawai = mysqli_query($conn, "SELECT id_pegawai, nama FROM pegawai WHERE is_deleted != 'Y' AND is_acount != 'A'");
									if (!$resultPegawai) {	
										die("Error in SQL query: " . mysqli_error($conn));
									}
									while ($rowPegawai = mysqli_fetch_assoc($resultPegawai)) {
										echo "<option value='" . $rowPegawai['id_pegawai'] . "' data-nama='" . $rowPegawai['nama'] . "'>" . $rowPegawai['nama'] . "</option>";
									}
									?>
								</select><br>
									<label for="username">Username:</label><br>
									<input type="text" id="username" name="username"><br>
									<label for="password">Password:</label><br>
									<input type="text" id="password" name="password"><br>
								</div>

								<div class="button">
									<input type="submit" value="Simpan">
									<button type="button" id="cancelButton">Batal</button>
								</div>
							</form>
						
					</div>
			</div>




			
			<form action="user.php" method="POST">
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
							<th>ID User</th>
							<th>Nama Pegawai</th>
							<th>Username</th>
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

						$result = mysqli_query($conn, "SELECT user.id_user, pegawai.nama AS nama_pegawai, user.username, user.password FROM user JOIN pegawai ON user.id_pegawai = pegawai.id_pegawai WHERE user.id_user LIKE '%$query%' OR pegawai.nama LIKE '%$query%' OR user.username LIKE '%$query%'");

						while($row = mysqli_fetch_assoc($result)) {
														
							echo "<tr>";
							echo "<td>" . $row['id_user'] . "</td>";
							echo "<td>" . $row['nama_pegawai'] . "</td>";
							echo "<td>" . $row['username'] . "</td>";
							echo "<td><a href='#' class='emot' onclick=\"hapusDataUser('" . $row['id_user'] . "', 'user', 'id_user', 'delete_user.php')\"><i class='bx bx-trash'></i></a>";
							echo "</tr>";
						}
						if (!$resultPegawai) {
							die("Error in SQL query: " . mysqli_error($conn));
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
	
	<!-- CONTENT -->
<script>
    const formTambahUser = document.querySelector('#formPopup form');
    const tambahUserUrl = 'tambah_user.php';

    if (formTambahUser) {
        formTambahUser.addEventListener('submit', function (event) {
            event.preventDefault();
            handleTambahUser(formTambahUser, tambahUserUrl);
        });
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../script.js"></script>
</body>
</html>
