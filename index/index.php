<?php
session_start();

// Fungsi logout
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: ../login/login.php");
    exit();
}

// Cek apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: ../login/login.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Boxicons -->
    <link
      href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css"
      rel="stylesheet"
    />
    <!-- My CSS -->
    <link rel="stylesheet" href="style_index.css" />

    <title>Berkah Petshop</title>
  </head>
  <body>
    <!-- SIDEBAR -->
    <section id="sidebar">
      <a href="#" class="brand">
        <i class="bx bxs-smile"></i>
        <span class="text">Berkah Petshop</span>
      </a>
      <ul class="side-menu top">
        <li class="active">
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
          </a> -->
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
        <i class="bx bx-menu"></i>
        <a href="#" class="nav-link">Categories</a>
        <form action="#">
          <div class="form-input">
            <input type="search" placeholder="Search..." />
            <button type="submit" class="search-btn">
              <i class="bx bx-search"></i>
            </button>
          </div>
        </form>
        <input type="checkbox" id="switch-mode" hidden />
        <label for="switch-mode" class="switch-mode"></label>
        <a href="#" class="profile">
          <img src="img/people.png" />
        </a>
      </nav>
      <!-- NAVBAR -->

      <!-- MAIN -->
      <main>
        <div class="head-title">
          <div class="left">
            <h1>Dashboard</h1>
            <ul class="breadcrumb">
              <li>
                <a href="#">Menu</a>
              </li>
              <li><i class="bx bx-chevron-right"></i></li>
              <li>
                <a class="active" href="#">Dashboard</a>
              </li>
            </ul>
          </div>
        </div>

        <?php
        require '../config/conn.php';

        // Query untuk menghitung jumlah transaksi yang belum dihapus
        $result = mysqli_query($conn, "SELECT COUNT(*) AS jumlah FROM transaksi WHERE is_deleted != 'Y'");
        $row = mysqli_fetch_assoc($result);
        $jumlahTransaksi = $row['jumlah'];

        // Query untuk menghitung jumlah pelanggan yang belum dihapus
        $result = mysqli_query($conn, "SELECT COUNT(*) AS jumlah FROM pelanggan WHERE is_deleted != 'Y'");
        $row = mysqli_fetch_assoc($result);
        $jumlahPelanggan = $row['jumlah'];

        // Query untuk menghitung jumlah pegawai yang belum dihapus
        $result = mysqli_query($conn, "SELECT COUNT(*) AS jumlah FROM pegawai WHERE is_deleted != 'Y'");
        $row = mysqli_fetch_assoc($result);
        $jumlahPegawai = $row['jumlah'];
        ?>


        <ul class="box-info">
            <li>
                <i class="bx bxs-calendar-check"></i>
                <span class="text">
                    <h3><?php echo $jumlahTransaksi; ?></h3>
                    <p>Transaksi</p>
                </span>
            </li>
            <li>
                <i class="bx bxs-group"></i>
                <span class="text">
                    <h3><?php echo $jumlahPelanggan; ?></h3>
                    <p>Pelanggan</p>
                </span>
            </li>
            <li>
                <i class="bx bxs-group"></i>
                <span class="text">
                    <h3><?php echo $jumlahPegawai; ?></h3>
                    <p>Pegawai</p>
                </span>
            </li>
        </ul>


        <div class="table-data">
          <div class="order">
          <div class="head">
              <h3>Transaksi Hari Ini</h3>
          </div>
          <table>
              <thead>
                  <tr>
                      <th>Tanggal Transaksi</th>
                      <th>Nama Produk</th>
                      <th>Jumlah Barang</th>
                      <th>Total Harga</th>
                  </tr>
              </thead>
              <tbody>
                  <?php
                  require '../config/conn.php';

                  // Query untuk mengambil data transaksi hari ini
                  $result = mysqli_query($conn, "SELECT transaksi.tgl_transaksi, produk.nama_produk, transaksi.jumlah_barang, transaksi.total_harga FROM transaksi INNER JOIN produk ON transaksi.id_produk = produk.id_produk WHERE DATE(transaksi.tgl_transaksi) = CURDATE()");

                  while($row = mysqli_fetch_assoc($result)) {
                      echo "<tr>";
                      echo "<td>" . $row['tgl_transaksi'] . "</td>";
                      echo "<td>" . $row['nama_produk'] . "</td>";
                      echo "<td>" . $row['jumlah_barang'] . "</td>";
                      echo "<td>" . $row['total_harga'] . "</td>";
                      echo "</tr>";
                  }
                  ?>
              </tbody>
          </table>
      </div>




          <?php
          require '../config/conn.php';

          // Query untuk menghitung jumlah barang setiap produk di tabel transaksi bulan ini
          $result = mysqli_query($conn, "SELECT id_produk, SUM(jumlah_barang) AS jumlah FROM transaksi WHERE MONTH(tgl_transaksi) = MONTH(CURRENT_DATE()) AND YEAR(tgl_transaksi) = YEAR(CURRENT_DATE()) GROUP BY id_produk ORDER BY jumlah DESC");

          echo '<div class="todo">';
          echo '<div class="head">';
          echo '<h3>Produk Terlaris Bulan Ini</h3>';
          echo '</div>';
          echo '<ul class="todo-list">';

          while($row = mysqli_fetch_assoc($result)) {
              // Ambil nama produk dari tabel produk
              $resultProduk = mysqli_query($conn, "SELECT nama_produk FROM produk WHERE id_produk = " . $row['id_produk']);
              $rowProduk = mysqli_fetch_assoc($resultProduk);
              $namaProduk = $rowProduk['nama_produk'];

              echo '<li class="completed">';
              echo '<p>' . $namaProduk . ' : ' . $row['jumlah'] . '</p>';
              echo '<i class="bx bx-dots-vertical-rounded"></i>';
              echo '</li>';
          }

          echo '</ul>';
          echo '</div>';
          ?>


      </main>
      <!-- MAIN -->
    </section>
    <!-- CONTENT -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../script.js"></script>
  </body>
</html>
