<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - BookClass</title>
    @include('styles.login') <!-- Jika ingin pisahkan CSS -->
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="brand-logo">BOOKCLASS</div>
            <h2 class="login-title">Login</h2>
            <p class="login-subtitle">Masuk ke akun Anda</p>

            <form>
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-input" placeholder="Masukkan email Anda">
                </div>

                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-input" placeholder="Masukkan password Anda">
                </div>

                <div class="remember-forgot">
                    <label class="remember-me">
                        <input type="checkbox">
                        Remember me
                    </label>
                    <a href="#" class="forgot-password">Forgot your password?</a>
                </div>

                <button type="submit" class="login-btn">LOG IN</button>
            </form>

            <div class="login-footer">
                &copy; 2024 BookClass. All rights reserved.
            </div>
        </div>
    </div>
</body>
</html>

<style>
/* Copy semua CSS dari kode pertama di sini */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
}

/* ... dan seterusnya (salin semua CSS di sini) ... */
</style>