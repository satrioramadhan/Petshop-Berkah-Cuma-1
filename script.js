const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');

allSideMenu.forEach(item => {
    const li = item.parentElement;

    item.addEventListener('click', function () {
        allSideMenu.forEach(i => {
            i.parentElement.classList.remove('active');
        })
        li.classList.add('active');
    })
});

// TOGGLE SIDEBAR
const menuBar = document.querySelector('#content nav .bx.bx-menu');
const sidebar = document.getElementById('sidebar');

menuBar.addEventListener('click', function () {
    sidebar.classList.toggle('hide');
})

const searchButton = document.querySelector('#content nav form .form-input button');
const searchButtonIcon = document.querySelector('#content nav form .form-input button .bx');
const searchForm = document.querySelector('#content nav form');

searchButton.addEventListener('click', function (e) {
    if (window.innerWidth < 576) {
        e.preventDefault();
        searchForm.classList.toggle('show');
        if (searchForm.classList.contains('show')) {
            searchButtonIcon.classList.replace('bx-search', 'bx-x');
        } else {
            searchButtonIcon.classList.replace('bx-x', 'bx-search');
        }
    }
})

if (window.innerWidth < 768) {
    sidebar.classList.add('hide');
} else if (window.innerWidth > 576) {
    searchButtonIcon.classList.replace('bx-x', 'bx-search');
    searchForm.classList.remove('show');
}

window.addEventListener('resize', function () {
    if (this.innerWidth > 576) {
        searchButtonIcon.classList.replace('bx-x', 'bx-search');
        searchForm.classList.remove('show');
    }
})

const switchMode = document.getElementById('switch-mode');
const formPopup = document.getElementById('formPopup');
const cancelButton = document.getElementById('cancelButton');
const addButton = document.querySelector('#content main .head-title .left .breadcrumb li a.active');

if (localStorage.getItem('dark-mode') === 'true') {
    enableDarkMode();
    switchMode.checked = true;
    formPopup.classList.add('dark-mode');
}

switchMode.addEventListener('change', function () {
    if (this.checked) {
        enableDarkMode();
    } else {
        disableDarkMode();
    }
});

addButton.addEventListener('click', function (event) {
    event.preventDefault();
    formPopup.style.display = "flex";
    // Memeriksa mode gelap setiap kali popup dibuka
    if (localStorage.getItem('dark-mode') === 'true') {
        formPopup.classList.add('dark-mode');
    } else {
        formPopup.classList.remove('dark-mode');
    }
});

cancelButton.addEventListener('click', function () {
    formPopup.style.display = "none";
});

function enableDarkMode() {
    document.body.classList.add('dark');
    formPopup.classList.add('dark-mode');
    localStorage.setItem('dark-mode', 'true');
}

function disableDarkMode() {
    document.body.classList.remove('dark');
    formPopup.classList.remove('dark-mode');
    localStorage.removeItem('dark-mode');
}
