<?php
session_start();
require_once('./lib/db_login.php');

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Memeriksa apakah user sudah mengklik tombol login
if (isset($_POST['login'])) {
    $valid = TRUE;

    // Memeriksa validasi username
    $username = test_input($_POST['username']);
    if ($username == '') {
        $error_username = 'Username harus diisi';
        $valid = FALSE;
    }

    // Memeriksa validasi password
    $password = test_input($_POST['password']);
    if ($password == '') {
        $error_password = 'Password harus diisi';
        $valid = FALSE;
    }

    // Memeriksa validasi
    if ($valid) {
        // Assign query
        $query = "SELECT * FROM user WHERE username = '" . $username . "' AND password = '" . md5($password) . "'";

        // Execute query
        $result = $db->query($query);
        if (!$result) {
            die("Could not query the database: <br />" . $db->error);
        } else {
            // if ($result->num_rows > 0) {
            //     $_SESSION['username'] = $username;
            //     header('Location: ./mahasiswa/dashboardMHS.php');
            //     exit;
            // } else {
            //     echo '<span class "error">Username atau password salah.</span>';
            // }
            if ($result->num_rows > 0) {
                $_SESSION['username'] = $username;
                header('Location: ./operator/dashboardOPT.php');
                exit;
            } else {
                echo '<span class "error">Username atau password salah.</span>';
            }
        }

        $db->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Login</title>
    <link rel="shortcut icon" href="https://kulon2.undip.ac.id/pluginfile.php/1/theme_moove/favicon/1660361299/undip.ico" />
</head>
<style>
    .main {
    font-family: 'Open Sans';
    }

    /* Kotak login */
    .login-box {
    width: 650px;
    height: 612px;
    box-sizing: border-box;
    border-top-left-radius: 100px;
    border-bottom-left-radius: 100px;
    margin-top: -25px;
    margin-left: auto;
    }

    /* Agar label StudyfyIF dan Undip ditengah */
    .center-labels{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 150px;
    }
    
    /* form */
    .form-control {
        margin: auto;
        width: 300px;
        height: 50px;
    }

    /* tombol login */
    .btn {
        margin: auto;
        width: 300px;
        height: 50px;
    }
</style>

<body>
<br>
<body class="" style="background-image: url(./assets/img/logo1.jpg);background-repeat: no-repeat; background-size: 800px 700px;">
<div class="main d-flex flex-column justify-content-center">
<div class="login-box shadow" style="background-color:white;">
<div class=" thumbnail p-4" ><img class="rounded mx-auto d-block" style="width: 4cm; height: 4cm;"src="./assets/img/logo.png"/></div>
<div class="error"><?php if(isset($error_login)) echo $error_login;?></div>
    <form method="POST" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="center-labels">
        <label style="width: auto; height: 0.5cm; font-size: 1.5em;"><strong>StudyfyIF</strong></label>
        <br>
        <label style="width: auto; height: 1cm; font-size: 1.3em;">Universitas Diponegoro</label>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Username" id="user" name="username" maxlength="50" value="<?php if(isset($username)) echo $username;?>">
	        <div class="error"><?php if(isset($error_username)) echo $error_username;?></div>
        </div>
        <br>
        <div class="form-group">
	        <input type="password" class="form-control" placeholder="Password" id="password" name="password" maxlength="50">
	    <div class="error"><?php if(isset($error_password)) echo $error_password;?></div>
    </div>
        <br>
        <button type="login" class="btn center-labels btn-dark" name="login" value="login">LOGIN</button>;
    </form>
    </div>
</div>
</body>
</html>