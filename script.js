const allSideMenu = document.querySelectorAll("#sidebar .side-menu.top li a");

allSideMenu.forEach((item) => {
  const li = item.parentElement;

  item.addEventListener("click", function () {
    allSideMenu.forEach((i) => {
      i.parentElement.classList.remove("active");
    });
    li.classList.add("active");
  });
});

// TOGGLE SIDEBAR
const menuBar = document.querySelector("#content nav .bx.bx-menu");
const sidebar = document.getElementById("sidebar");

menuBar.addEventListener("click", function () {
  sidebar.classList.toggle("hide");
});

const searchButton = document.querySelector(
  "#content nav form .form-input button"
);
const searchButtonIcon = document.querySelector(
  "#content nav form .form-input button .bx"
);
const searchForm = document.querySelector("#content nav form");

searchButton.addEventListener("click", function (e) {
  if (window.innerWidth < 576) {
    e.preventDefault();
    searchForm.classList.toggle("show");
    if (searchForm.classList.contains("show")) {
      searchButtonIcon.classList.replace("bx-search", "bx-x");
    } else {
      searchButtonIcon.classList.replace("bx-x", "bx-search");
    }
  }
});

if (window.innerWidth < 768) {
  sidebar.classList.add("hide");
} else if (window.innerWidth > 576) {
  searchButtonIcon.classList.replace("bx-x", "bx-search");
  searchForm.classList.remove("show");
}

window.addEventListener("resize", function () {
  if (this.innerWidth > 576) {
    searchButtonIcon.classList.replace("bx-x", "bx-search");
    searchForm.classList.remove("show");
  }
});

const switchMode = document.getElementById("switch-mode");
const formPopup = document.getElementById("formPopup");
const cancelButton = document.getElementById("cancelButton");
const addButton = document.querySelector(
  "#content main .head-title .left .breadcrumb li a.active"
);

if (localStorage.getItem("dark-mode") === "true") {
  enableDarkMode();
  switchMode.checked = true;
  formPopup.classList.add("dark-mode");
}

switchMode.addEventListener("change", function () {
  if (this.checked) {
    enableDarkMode();
  } else {
    disableDarkMode();
  }
});

addButton.addEventListener("click", function (event) {
  event.preventDefault();
  formPopup.style.display = "flex";
  // Memeriksa mode gelap setiap kali popup dibuka
  if (localStorage.getItem("dark-mode") === "true") {
    formPopup.classList.add("dark-mode");
  } else {
    formPopup.classList.remove("dark-mode");
  }
});

cancelButton.addEventListener("click", function () {
  formPopup.style.display = "none";
});

function enableDarkMode() {
  document.body.classList.add("dark");
  formPopup.classList.add("dark-mode");
  localStorage.setItem("dark-mode", "true");
}

function disableDarkMode() {
  document.body.classList.remove("dark");
  formPopup.classList.remove("dark-mode");
  localStorage.removeItem("dark-mode");
}




// Kode popup TAMBAH

function handleTambahPegawai(form, tambahUrl) {
  // Di dalam fungsi fetch untuk tambah pegawai
  fetch(tambahUrl, {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: new URLSearchParams(new FormData(form)).toString(),
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.status_code === 200) {
        tampilkanPopupBerhasil("yeyy!! data berhasil ditambah");
      } else {
        tampilkanPopupGagal("yahh gagal menambah data", data.message);
      }
    })
    .catch((error) => {
      console.error("Error:", error);
      tampilkanPopupKesalahan(
        "ada Kesalahan sistem nih",
        "datanya gagal ditambahkan"
      );
    });
}

function tampilkanPopupBerhasil(pesan) {
  Swal.fire({
    title: pesan,
    icon: "success",
    confirmButtonColor: "#86B6F6",
    confirmButtonText: "Tutup",
  }).then(() => {
    // Refresh halaman atau lakukan aksi lainnya jika diperlukan
    window.location.reload();
  });
}

function tampilkanPopupGagal(judul, message) {
  Swal.fire({
    title: judul,
    text: message,
    icon: "error",
    confirmButtonColor: "#86B6F6",
    confirmButtonText: "Tutup",
  });
}

function tampilkanPopupKesalahan(judul, pesan) {
  Swal.fire({
    title: judul,
    text: pesan,
    icon: "error",
    confirmButtonColor: "#86B6F6",
    confirmButtonText: "Tutup",
  });
}

// Kode popup DELETE

function hapusData(id, table, id_column, deleteFile) {
  Swal.fire({
    title: "mau dihapus datanya?",
    icon: "warning",
    iconColor: "#FF8080",
    showCancelButton: true,
    confirmButtonColor: "#86B6F6",
    cancelButtonColor: "#FF8080",
    confirmButtonText: "yap, hapus aja",
    cancelButtonText: "ga jadii",
  }).then((result) => {
    if (result.isConfirmed) {
      // Gunakan fetch untuk mengirim request ke deleteFile
      fetch(`${deleteFile}?id=${id}&table=${table}&id_column=${id_column}`)
        .then((response) => response.json())
        .then((data) => {
          if (data.status_code === 200) {
            tampilkanBerhasil();
          } else {
            tampilkanGagal(data.message);
          }
        })
        .catch((error) => {
          console.error("Error:", error);
          tampilkanKesalahan();
        });
    }
  });
}

function tampilkanBerhasil() {
  Swal.fire({
    title: "datanya dah dihapus!",
    icon: "success",
    confirmButtonColor: "#86B6F6",
    confirmButtonText: "tutup",
  }).then(() => {
    // Refresh halaman atau lakukan aksi lainnya jika diperlukan
    window.location.reload();
  });
}

function tampilkanGagal(message) {
  Swal.fire({
    title: "yah gagal menghapus data",
    text: message,
    icon: "error",
    confirmButtonColor: "#86B6F6",
    confirmButtonText: "tutup",
  });
}

function tampilkanKesalahan() {
  Swal.fire({
    title: "ada kesalahan nih",
    text: "datanya gagal dihapus",
    icon: "error",
    confirmButtonColor: "#86B6F6",
    confirmButtonText: "tutup",
  });
}

// update data
function handleEditPegawai(form, editUrl) {
    fetch(editUrl, {
        method: 'POST',
        body: new FormData(form),
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('yahh gagal di update.');
        }
        return response.json();
    })
    .then(data => {
        console.log('Data pegawai diperbarui:', data);
        document.getElementById('formEditPopup').style.display = 'none';
        
        if (data.status_code === 200) {
            // Menggunakan fungsi tampilkanPopupBerhasil untuk menampilkan popup sukses
            tampilkanPopupBerhasil('data udah diperbarui', 'data udah diperbarui.');
        } else {
            // Menggunakan fungsi tampilkanPopupGagal untuk menampilkan popup gagal
            tampilkanPopupGagal('Pesan Gagal', data.message);
        }
    })
    .catch(error => {
        console.error('Error during fetch:', error);

        // Menggunakan fungsi tampilkanPopupKesalahan untuk menampilkan popup kesalahan
        tampilkanPopupKesalahan('wahh eror', error.message);
    });
}


// Kode popup TAMBAH

function handleTambahPelanggan(form, tambahUrl) {
  fetch(tambahUrl, {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: new URLSearchParams(new FormData(form)).toString(),
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.status_code === 200) {
        tampilkanPopupBerhasil("yeyy!! data berhasil ditambah");
      } else {
        tampilkanPopupGagal("yahh gagal menambah data", data.message);
      }
    })
    .catch((error) => {
      console.error("Error:", error);
      tampilkanPopupKesalahan(
        "ada Kesalahan sistem nih",
        "datanya gagal ditambahkan"
      );
    });
}

function tampilkanPopupBerhasil(pesan) {
  Swal.fire({
    title: pesan,
    icon: "success",
    confirmButtonColor: "#86B6F6",
    confirmButtonText: "Tutup",
  }).then(() => {
    // Refresh halaman atau lakukan aksi lainnya jika diperlukan
    window.location.reload();
  });
}

function tampilkanPopupGagal(judul, message) {
  Swal.fire({
    title: judul,
    text: message,
    icon: "error",
    confirmButtonColor: "#86B6F6",
    confirmButtonText: "Tutup",
  });
}

function tampilkanPopupKesalahan(judul, pesan) {
  Swal.fire({
    title: judul,
    text: pesan,
    icon: "error",
    confirmButtonColor: "#86B6F6",
    confirmButtonText: "Tutup",
  });
}


function hapusDataPelanggan(id, table, id_column, deleteFile) {
  console.log("Menghapus data. ID:", id, "Tabel:", table, "Kolom ID:", id_column, "Delete File:", deleteFile);

  Swal.fire({
    title: "mau dihapus datanya?",
    icon: "warning",
    iconColor: "#FF8080",
    showCancelButton: true,
    confirmButtonColor: "#86B6F6",
    cancelButtonColor: "#FF8080",
    confirmButtonText: "yap, hapus aja",
    cancelButtonText: "ga jadii",
  }).then((result) => {
    if (result.isConfirmed) {
      // Gunakan fetch untuk mengirim request ke deleteFile
      fetch(`${deleteFile}?id=${id}&table=${table}&id_column=${id_column}`)
        .then((response) => response.json())
        .then((data) => {
          console.log("Respons dari server:", data);

          if (data.status_code === 200) {
            tampilkanBerhasil();
          } else {
            tampilkanGagal(data.message);
          }
        })
        .catch((error) => {
          console.error("Error:", error);
          tampilkanKesalahan();
        });
    }
  });
}






function handleEditPelanggan(form, editUrl) {
  fetch(editUrl, {
    method: 'POST',
    body: new FormData(form),
  })
    .then(response => {
      if (!response.ok) {
        throw new Error('yahh gagal di update.');
      }
      return response.json();
    })
    .then(data => {
      console.log('Data pelanggan diperbarui:', data);
      document.getElementById('formEditPopup').style.display = 'none';

      if (data.status_code === 200) {
        tampilkanPopupBerhasil('data udah diperbarui', 'data udah diperbarui.');
      } else {
        tampilkanPopupGagal('Pesan Gagal', data.message);
      }
    })
    .catch(error => {
      console.error('Error during fetch:', error);
      tampilkanPopupKesalahan('wahh eror', error.message);
    });
}

// produk
function handleTambahProduk(form, tambahUrl) {
  fetch(tambahUrl, {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: new URLSearchParams(new FormData(form)).toString(),
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.status_code === 200) {
        tampilkanPopupBerhasil("Yeay! Data produk berhasil ditambahkan.");
      } else {
        tampilkanPopupGagal("Oops! Gagal menambah data produk.", data.message);
      }
    })
    .catch((error) => {
      console.error("Error:", error);
      tampilkanPopupKesalahan(
        "Terjadi kesalahan sistem",
        "Data produk gagal ditambahkan."
      );
    });
}

function hapusDataProduk(id, table, id_column, deleteFile) {
  Swal.fire({
    title: "mau dihapus datanya?",
    icon: "warning",
    iconColor: "#FF8080",
    showCancelButton: true,
    confirmButtonColor: "#86B6F6",
    cancelButtonColor: "#FF8080",
    confirmButtonText: "yap, hapus aja",
    cancelButtonText: "ga jadii",
  }).then((result) => {
    if (result.isConfirmed) {
      // Gunakan fetch untuk mengirim request ke deleteFile
      fetch(`${deleteFile}?id=${id}&table=${table}&id_column=${id_column}`)
        .then((response) => response.json())
        .then((data) => {
          if (data.status_code === 200) {
            tampilkanBerhasil();
          } else {
            tampilkanGagal(data.message);
          }
        })
        .catch((error) => {
          console.error("Error:", error);
          tampilkanKesalahan();
        });
    }
  });
}

function tampilkanBerhasil() {
  Swal.fire({
    title: "datanya dah dihapus!",
    icon: "success",
    confirmButtonColor: "#86B6F6",
    confirmButtonText: "tutup",
  }).then(() => {
    // Refresh halaman atau lakukan aksi lainnya jika diperlukan
    window.location.reload();
  });
}

function tampilkanGagal(message) {
  Swal.fire({
    title: "yah gagal menghapus data",
    text: message,
    icon: "error",
    confirmButtonColor: "#86B6F6",
    confirmButtonText: "tutup",
  });
}

function tampilkanKesalahan() {
  Swal.fire({
    title: "ada kesalahan nih",
    text: "datanya gagal dihapus",
    icon: "error",
    confirmButtonColor: "#86B6F6",
    confirmButtonText: "tutup",
  });
}

function handleEditProduk(form, editUrl) {
  fetch(editUrl, {
    method: 'POST',
    body: new FormData(form),
  })
    .then(response => {
      if (!response.ok) {
        throw new Error('Gagal memperbarui data produk.');
      }
      return response.json();
    })
    .then(data => {
      console.log('Data produk diperbarui:', data);
      document.getElementById('formEditPopup').style.display = 'none';

      if (data.status_code === 200) {
        tampilkanPopupBerhasil('Data produk telah diperbarui.', 'Data produk telah diperbarui.');
      } else {
        tampilkanPopupGagal('Pesan Gagal', data.message);
      }
    })
    .catch(error => {
      console.error('Error during fetch:', error);
      tampilkanPopupKesalahan('Oops! Terjadi kesalahan', error.message);
    });
}




// transaksi
function handleTambahTransaksi(form, tambahUrl) {
  // Validasi stok disini (seperti yang sudah dijelaskan sebelumnya)

  Swal.fire({
    title: "Yakin ingin menambahkan transaksi?",
    icon: "question",
    iconColor: "#86B6F6",
    showCancelButton: true,
    confirmButtonColor: "#86B6F6",
    cancelButtonColor: "#FF8080",
    confirmButtonText: "Ya, tambahkan",
    cancelButtonText: "Batal",
  }).then((result) => {
    if (result.isConfirmed) {
      fetch(tambahUrl, {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: new URLSearchParams(new FormData(form)).toString(),
      })
        .then((response) => {
          if (!response.ok) {
            throw new Error("Network response was not ok");
          }
          return response.json();
        })
        .then((data) => {
          if (data.status_code === 200) {
            tampilkanPopupBerhasil("Yeay! Data transaksi berhasil ditambahkan.");
          } else {
            tampilkanPopupGagal("Oops! Gagal menambah data transaksi.", data.message);
          }
        })
        .catch((error) => {
          console.error("Error:", error);
          tampilkanPopupKesalahan("Terjadi kesalahan sistem", "Data transaksi gagal ditambahkan.");
        });
    }
  });
}


function hapusDataTransaksi(id, table, id_column, deleteFile) {
  Swal.fire({
    title: "mau dihapus datanya?",
    icon: "warning",
    iconColor: "#FF8080",
    showCancelButton: true,
    confirmButtonColor: "#86B6F6",
    cancelButtonColor: "#FF8080",
    confirmButtonText: "yap, hapus aja",
    cancelButtonText: "ga jadii",
  }).then((result) => {
    if (result.isConfirmed) {
      // Ubah fetch untuk mengirim permintaan DELETE
      fetch(`${deleteFile}?id=${id}&table=${table}&id_column=${id_column}`, {
        method: 'DELETE',  // Menggunakan metode DELETE
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.status_code === 200) {
            tampilkanBerhasil();
          } else {
            tampilkanGagal(data.message);
          }
        })
        .catch((error) => {
          console.error("Error:", error);
          tampilkanKesalahan();
        });
    }
  });
}

// user
function handleTambahUser(form, tambahUrl) {
  fetch(tambahUrl, {
      method: "POST",
      headers: {
          "Content-Type": "application/x-www-form-urlencoded",
      },
      body: new URLSearchParams(new FormData(form)).toString(),
  })
  .then((response) => {
      // Ubah tipe data respons menjadi teks
      return response.text();
  })
  .then((data) => {
      // Lakukan pengolahan respons di sini sesuai dengan kebutuhan Anda
      console.log(data);

      // Contoh: Jika respons mengandung kata "berhasil", maka anggap berhasil
      if (data.includes("berhasil")) {
          tampilkanPopupBerhasil("Yeay! Data user berhasil ditambahkan.");
      } else {
          tampilkanPopupGagal("Oops! Gagal menambah data user.", data);
      }
  })
  .catch((error) => {
      console.error("Error:", error);
      tampilkanPopupKesalahan(
          "Terjadi kesalahan sistem",
          "Data user gagal ditambahkan."
      );
  });
}

function hapusDataUser(id, table, id_column, deleteFile) {
  Swal.fire({
    title: "mau dihapus datanya?",
    icon: "warning",
    iconColor: "#FF8080",
    showCancelButton: true,
    confirmButtonColor: "#86B6F6",
    cancelButtonColor: "#FF8080",
    confirmButtonText: "yap, hapus aja",
    cancelButtonText: "ga jadii",
  }).then((result) => {
    if (result.isConfirmed) {
      // Ubah fetch untuk mengirim permintaan DELETE
      fetch(`${deleteFile}?id=${id}&table=${table}&id_column=${id_column}`, {
        method: 'DELETE',  // Menggunakan metode DELETE
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.status_code === 200) {
            tampilkanBerhasil();
          } else {
            tampilkanGagal(data.message);
          }
        })
        .catch((error) => {
          console.error("Error:", error);
          tampilkanKesalahan();
        });
    }
  });
}