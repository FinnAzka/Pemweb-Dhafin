<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Portal IAM TIK PNJ</title>
    <style>
        :root {
            --bg-base: #F8FAFC;
            --bg-surface: #FFFFFF;
            --border-color: #CBD5E1;
            --border-focus: #1E3A8A;
            --text-main: #0F172A;
            --text-muted: #475569;
            --brand-primary: #1E3A8A;
            --brand-primary-hover: #172554;
            --font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: var(--font-family);
            background-color: var(--bg-base);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px 16px;
        }

        .login-card {
            background-color: var(--bg-surface);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            width: 100%;
            max-width: 420px;
            padding: 36px 32px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
        }

        .brand-header {
            text-align: center;
            margin-bottom: 28px;
        }

        .brand-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 52px;
            height: 52px;
            background-color: #EFF6FF;
            color: var(--brand-primary);
            border: 2px solid #BFDBFE;
            border-radius: 10px;
            font-weight: 800;
            font-size: 1.1rem;
            margin-bottom: 16px;
        }

        .brand-header h1 {
            font-size: 1.35rem;
            font-weight: 700;
            color: var(--text-main);
            letter-spacing: -0.3px;
        }

        .brand-header p {
            font-size: 0.875rem;
            color: var(--text-muted);
            margin-top: 4px;
        }

        .alert-error {
            background-color: #FEF2F2;
            color: #991B1B;
            border: 1px solid #FECACA;
            border-radius: 6px;
            padding: 12px 14px;
            font-size: 0.84rem;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--text-main);
            margin-bottom: 6px;
        }

        .form-input {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            font-size: 0.9375rem;
            color: var(--text-main);
            background-color: #FFFFFF;
            font-family: inherit;
            transition: border-color 150ms ease, box-shadow 150ms ease;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--border-focus);
            box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.15);
        }

        .btn-submit {
            width: 100%;
            background-color: var(--brand-primary);
            color: #FFFFFF;
            border: none;
            padding: 12px 16px;
            border-radius: 6px;
            font-size: 0.9375rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 150ms ease;
            min-height: 44px;
            margin-top: 8px;
        }

        .btn-submit:hover {
            background-color: var(--brand-primary-hover);
        }

        .btn-register {
            display: block;
            width: 100%;
            margin-top: 10px;
            padding: 11px 16px;
            border: 1px solid var(--brand-primary);
            border-radius: 6px;
            color: var(--brand-primary);
            background: #FFFFFF;
            text-align: center;
            text-decoration: none;
            font-size: 0.9375rem;
            font-weight: 600;
        }

        .btn-register:hover {
            color: var(--brand-primary-hover);
            background: #EFF6FF;
            text-decoration: none;
        }

        .btn-submit:focus-visible {
            outline: 2px solid #2563EB;
            outline-offset: 2px;
        }

        .captcha-row {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }

        .captcha-image {
            display: block;
            width: 180px;
            height: 56px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
        }

        .captcha-refresh {
            min-height: 42px;
            padding: 8px 10px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            color: var(--brand-primary);
            background: #fff;
            cursor: pointer;
        }

        .captcha-help {
            margin-top: 6px;
            color: var(--text-muted);
            font-size: 0.78rem;
        }

        .login-footer {
            margin-top: 24px;
            padding-top: 18px;
            border-top: 1px solid #F1F5F9;
            text-align: center;
            font-size: 0.78rem;
            color: var(--text-muted);
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="brand-header">
            <div class="brand-icon" aria-hidden="true">TIK</div>
            <h1>Manajemen Akun</h1>
            <p>Masuk menggunakan email dan password Anda</p>
        </div>

        <?php if (!empty($error)): ?>
            <div class="alert-error" role="alert">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form action="<?= BASE_URL ?>/login" method="POST">
            <div class="form-group">
                <label for="email" class="form-label">Alamat Email</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    class="form-input" 
                    placeholder="nama@pnj.ac.id" 
                    required 
                    autocomplete="email"
                >
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    class="form-input" 
                    placeholder="Masukkan password" 
                    required 
                    autocomplete="current-password"
                >
            </div>

            <div class="form-group">
                <label for="captcha" class="form-label">Kode CAPTCHA</label>
                <div class="captcha-row">
                    <img
                        id="captcha-image"
                        class="captcha-image"
                        src="<?= BASE_URL ?>/captcha.php?t=<?= time() ?>"
                        alt="Gambar kode CAPTCHA"
                        width="180"
                        height="56"
                    >
                    <button class="captcha-refresh" type="button" id="refresh-captcha" aria-label="Muat ulang CAPTCHA">Muat ulang</button>
                </div>
                <input
                    type="text"
                    id="captcha"
                    name="captcha"
                    class="form-input"
                    placeholder="Ketik kode pada gambar"
                    required
                    maxlength="5"
                    autocomplete="off"
                    autocapitalize="characters"
                >
                <p class="captcha-help">Masukkan 5 karakter yang terlihat pada gambar.</p>
            </div>

            <button type="submit" class="btn-submit">Masuk ke Sistem</button>
            <a class="btn-register" href="<?= BASE_URL ?>/register.php">Daftar / Register</a>
        </form>

        <div class="login-footer">
            Sistem Informasi Pengelolaan Identitas Mahasiswa & Dosen PNJ
        </div>
    </div>
    <script>
        document.getElementById('refresh-captcha').addEventListener('click', function () {
            document.getElementById('captcha-image').src =
                '<?= BASE_URL ?>/captcha.php?t=' + Date.now();
        });
    </script>
</body>
</html>
