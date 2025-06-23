<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Aplikasi Manajemen Stok</title>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }
        .login-box {
            padding: 40px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            width: 320px;
        }
        .login-box h1 {
            text-align: center;
            margin-top: 0;
            margin-bottom: 25px;
            color: #333;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            color: #555;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box; /* Ensures padding doesn't affect width */
        }
        .login-button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .login-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h1>Login</h1>
            <form id="form-login" action="" method="post">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="login-button">Login</button>
            </form>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('#form-login').on('submit', function(event) {
            event.preventDefault(); // Mencegah form dikirim secara normal

            $.ajax({
                url: "<?= base_url('/login/auth') ?>",
                type: "POST",
                data: $(this).serialize(),
                dataType: "JSON",
                success: function(response) {
                    if (response.status === 'success') {
                        // Jika sukses, arahkan ke halaman utama
                        window.location.href = response.redirect_url;
                    } else {
                        // Jika gagal, tampilkan notifikasi error
                        Swal.fire('Login Gagal', response.message, 'error');
                    }
                },
                error: function() {
                    Swal.fire('Oops...', 'Terjadi kesalahan server saat mencoba login.', 'error');
                }
            });
        });
    });
</script>
</html>