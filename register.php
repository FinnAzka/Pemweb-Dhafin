<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Register</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <style>
        body { background: #f8f9fa; }
        .form-container { margin-top: 35px; margin-bottom: 35px; }
        .captcha-image { width: 173px; height: 50px; border: 1px solid #ced4da; }
    </style>
</head>
<body>
<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
require_once __DIR__ . '/koneksi.php';

$error = '';
$validate = '';
$success = '';

if (isset($_POST['submit'])) {
    $username = trim($_POST['username'] ?? '');
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $repass = $_POST['repassword'] ?? '';
    $captchaInput = strtoupper(trim($_POST['kodecaptcha'] ?? ''));
    $captchaExpected = $_SESSION['code'] ?? '';
    unset($_SESSION['code']);

    if (!is_string($captchaExpected) || $captchaExpected === '' || $captchaInput === '' || !hash_equals(strtoupper($captchaExpected), $captchaInput)) {
        $error = 'Kode CAPTCHA salah. Silakan coba lagi.';
    } elseif ($name === '' || $username === '' || $email === '' || $password === '' || $repass === '') {
        $error = 'Data tidak boleh kosong !!';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Format email tidak valid.';
    } elseif ($password !== $repass) {
        $validate = 'Password tidak sama !!';
    } else {
        try {
            $check = $con->prepare('SELECT id FROM users WHERE username = ? OR email = ? LIMIT 1');
            $check->bind_param('ss', $username, $email);
            $check->execute();
            $existing = $check->get_result()->fetch_assoc();
            $check->close();

            if ($existing) {
                $error = 'Username atau email sudah terdaftar !!';
            } else {
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                $insert = $con->prepare('INSERT INTO users (username, name, email, password) VALUES (?, ?, ?, ?)');
                $insert->bind_param('ssss', $username, $name, $email, $passwordHash);
                $insert->execute();
                $insert->close();
                $success = 'Register berhasil !!';
            }
        } catch (mysqli_sql_exception $exception) {
            $error = 'Register User Gagal !!';
        }
    }
}
?>

<section class="container-fluid mb-4">
    <section class="row justify-content-center">
        <section class="col-12 col-sm-6 col-md-4">
            <form class="form-container" action="register.php" method="POST">
                <h4 class="text-center font-weight-bold">Sign-Up</h4>

                <?php if ($error !== ''): ?>
                    <div class="alert alert-danger" role="alert"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></div>
                <?php endif; ?>
                <?php if ($success !== ''): ?>
                    <div class="alert alert-success" role="status"><?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8') ?></div>
                <?php endif; ?>

                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan Nama" required>
                </div>
                <div class="form-group">
                    <label for="email">Alamat Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email" required>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    <?php if ($validate !== ''): ?>
                        <p class="text-danger mb-0"><?= htmlspecialchars($validate, ENT_QUOTES, 'UTF-8') ?></p>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="repassword">Re-Password</label>
                    <input type="password" class="form-control" id="repassword" name="repassword" placeholder="Re-Password" required>
                    <?php if ($validate !== ''): ?>
                        <p class="text-danger mb-0"><?= htmlspecialchars($validate, ENT_QUOTES, 'UTF-8') ?></p>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="kodecaptcha">CAPTCHA</label>
                    <div class="d-flex align-items-center mb-2">
                        <img class="captcha-image" src="captcha.php?t=<?= time() ?>" alt="Kode CAPTCHA" width="173" height="50">
                        <button class="btn btn-outline-secondary btn-sm ml-2" type="button" onclick="document.querySelector('.captcha-image').src='captcha.php?t='+Date.now()">Muat ulang</button>
                    </div>
                    <input type="text" class="form-control" id="kodecaptcha" name="kodecaptcha" placeholder="Masukkan kode pada gambar" maxlength="5" autocomplete="off" required>
                </div>
                <button type="submit" name="submit" class="btn btn-primary btn-block">Register</button>
            </form>
        </section>
    </section>
</section>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>
</html>
