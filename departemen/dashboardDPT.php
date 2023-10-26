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
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <!-- <script src="../js/scripts.js"></script> -->
</head>
<body>

<div class="flex">
    <!-- Navbar -->
    <div class="fixed top-0 left-0 right-0 flex bg-blue-900 p-5 text-white">
        <!-- Welcome Sentence (Moved to the right) -->
        <div class="text font-bold" style="margin-left: auto; margin-right: 45px; font-size: 18px;">Selamat Datang, Mahasiswa!</div>
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
                <p class="text-white text-center">Mahasiswa Informatika</p>
            </li>
            <br>
            <li class="mb-2">
                <a href="dashboardMHS.php" id="profil" class="text-white hover:bg-gray-600 px-4 py-2 block">Profil</a>
            </li>
            <li class="mb-2">
                <button class="collapsible text-white hover:bg-gray-600 px-3 py-2 block">Progress Akademik</button>
                <div class="submenu">
                    <a href="irs.php" id="irs" class="text-white hover:bg-gray-600 px-4 py-2 block">IRS</a>
                    <a href="khs.php" id="khs" class="text-white hover:bg-gray-600 px-4 py-2 block">KHS</a>
                    <a href="pkl.php" id="pkl" class="text-white hover:bg-gray-600 px-4 py-2 block">PKL</a>
                    <a href="skripsi.php" id="skripsi" class="text-white hover:bg-gray-600 px-4 py-2 block">Skripsi</a>
                </div>
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
                <h1 class="text-xl font-bold mb-4">Profil Mahasiswa</h1>
                <div>
                <div class="profile-box shadow">
                    <h1 class="text-white text-center font-bold py-5">Mahasiswa Informatika UNDIP</h1>
                    <div>
                        <img src="../assets/images/user.png" class="profil-box px-10 py-2 d-block" style="margin-top: 20px;">
                    </div>
                    <!-- <div style="display: flex;">
                        <img src="../assets/images/pencil.png" style="margin-left: 93px; margin-top: 3px; width: 15px; height: 15px;">
                        <a href="uploadfoto.php" class="text-white" style="margin-left: 5px; font-size: 13px;">Upload Foto</a>
                    </div> -->
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

    // Set item aktif pada "profil" saat halaman di load pertama kali
    setActiveItem("profil");
</script>
</body>
</html>