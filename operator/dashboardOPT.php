<?php
session_start();
require_once('../lib/db_login.php');
// include("../template/headermahasiswa.php");

// Pengambilan data username
$username = $_SESSION['username'];
$query = "SELECT * FROM user WHERE username = '" . $username . "'";
    $result = $db->query($query);
    if (!$result) {
        die("Could not query the database: <br />" . $db->error);
    } else {
        if ($result->num_rows > 0) {
            $_SESSION['username'] = $username;
        }else {
            // Jika username dari user tidak ditemukan
            $username = "Guest";
        }
    }
$db->close();
?>

<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css" rel="stylesheet">
    <title>Dashboard</title>
    <link rel="shortcut icon" href="https://kulon2.undip.ac.id/pluginfile.php/1/theme_moove/favicon/1660361299/undip.ico" />
    <link rel="stylesheet" type="text/css" href="../css/dashboardOPT.css"> 
    <!-- <script src="../js/scripts.js"></script> -->
</head>
<body>

<div class="flex">
    <!-- Navbar -->
    <div class="fixed top-0 left-0 right-0 flex bg-blue-900 p-5 text-white">
        <!-- Welcome Sentence (Moved to the right) -->
        <div class="text font-bold" style="margin-left: auto; margin-right: 45px; font-size: 18px;">Selamat Datang, Operator!</div>
        <!-- User Picture -->
        <div class="profiltop">
            <img src="../assets/images/user.png" class="profile w-9 h-9 rounded-full cursor-pointer" id="user-menu-toggle" style="margin-left: 10px; margin-right: 5px; margin-top: 5px;">
            <!-- User Menu (submenu) -->
            <div class="absolute right-0 mt-2 bg-gray-900 text-white p-2 w-32 rounded-lg hidden" id="user-menu" style="margin-right: 5px;">
                <a href="../logout.php" class="block rounded py-2 hover:bg-gray-600 text-center">Logout</a>
            </div>
        </div>
    </div>
    <!-- Sidebar -->
    <aside class="fixed-sidebar w-64 h-auto bg-gray-800 text-white p-4">
        <div style="display: flex; align-items: center;">
            <img src="../assets/img/logo.png" style="margin-left: 1px; margin-bottom: 10px; width: 40px; height: 40px;">
            <h1 class="text-2xl font-bold mb-3 px-4">StudyfyIF</h1>
        </div>
        <ul>
            <li class="mb-2">
                <img src="../assets/images/user.png" class="profil-side px-6 py-2 mx-auto d-block">
            </li>
            <li>
                <p class="text-white text-center"><?php echo $username; ?></p>
                <p class="text-white text-center">Admin Informatika</p>
            </li>
            <br>
            <li class="mb-2">
                <a href="dashboardOPT.php" id="dashboard" class="text-white hover:bg-gray-600 px-4 py-2 block">Dashboard</a>
            </li>
            <li class="mb-2">
                <a href="genAkun.php" id="generate" class="text-white hover:bg-gray-600 px-4 py-2 block">Generate Akun</a>
            </li>
            <li class="mb-2">
                <a href="manAkun.php" id="manage" class="text-white hover:bg-gray-600 px-4 py-2 block">Manajemen Akun</a>
            </li>
            <li class="mb-2">
                <a href="dataMHS.php" id="datamhs" class="text-white hover:bg-gray-600 px-4 py-2 block">Data Mahasiswa</a>
            </li>
            <!-- <li class="mb-2">
                <a href="../logout.php" id="logout" class="text-white hover:bg-gray-600 px-4 py-2 block">Logout</a>
            </li> -->
        </ul>
    </aside>


    <!-- Konten (belum) -->
    <main class="main-content flex-1 p-4">
        <!-- CRUD -->
            <div class="profilebox" id="profilebox">
                <h1 class="text-xl font-bold mb-4">Dashboard</h1>
                <div class="profile-box-12-container">
                <div class="profile-box-1 shadow">
                    <h1 class="text-dark text-8xl text-center font-bold py-5">1</h1>
                    <p class="text-dark text-center">Total Operator Departemen</p>
                </div>
                <div class="profile-box-2 shadow px-10">
                    <h1 class="text-dark text-8xl text-center font-bold py-5">12</h1>
                    <p class="text-dark text-center">Total Mahasiswa</p>
                </div>
                </div>
                <div class="profile-box-3-container">
                <div class="profile-box-3 shadow">
                    <h1 class="text-dark text-8xl text-center font-bold py-5">10</h1>
                    <p class="text-dark text-center">Total Dosen Wali</p>
                </div>
                </div>
            </div>
            <!-- End konten -->

<script>
    //JavaScript untuk menu collapse (progress akademik)
    const collapsibleButtons = document.querySelectorAll(".collapsible");

    // Add click event listeners to collapsible buttons
    collapsibleButtons.forEach((button) => {
        button.addEventListener("click", () => {
            const submenu = button.nextElementSibling; // Use nextElementSibling
            if(submenu.style.display === "block" || submenu.style.display === "") {
                submenu.style.display = "none";
            }else{
                submenu.style.display = "block";
            }
        });
    });

    const userMenuToggle = document.getElementById('user-menu-toggle');
    const userMenu = document.getElementById('user-menu');

    userMenuToggle.addEventListener('click', () => {
        userMenu.classList.toggle('hidden');
    });

    // Fungsi untuk mengatur item aktif (menu dll)
    function setActiveItem(activeId) {
        const sidebarItems = document.querySelectorAll("aside a");
        sidebarItems.forEach((item) => {
            item.classList.remove("bg-green-600");
            item.classList.remove("text-gray-100");
        });

        const activeItem = document.getElementById(activeId);
        if (activeItem) {
            activeItem.classList.add("bg-blue-800");
            activeItem.classList.add("text-gray-100");
        }
    }

    // Set item aktif pada "dashboard" saat halaman di load pertama kali
    setActiveItem("dashboard");
</script>
</body>
</html>