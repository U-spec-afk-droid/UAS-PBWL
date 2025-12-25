<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>BookClass - Login</title>

    <style>
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
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            width: 100%;
            max-width: 440px;
        }

        .login-card {
            background: #ffffff;
            border-radius: 18px;
            box-shadow: 0 18px 40px rgba(0, 0, 0, 0.08);
            padding: 40px 34px;
        }

        .brand-logo {
            text-align: center;
            font-size: 30px;
            font-weight: 800;
            color: #2563eb;
            margin-bottom: 26px;
            letter-spacing: 0.6px;
        }

        /* ===============================
           FIX BREEZE TANPA TAILWIND
           =============================== */

        .auth-content {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 6px;
            color: #111827;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px 14px;
            border-radius: 10px;
            border: 1px solid #d1d5db;
            font-size: 14px;
        }

        input:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.18);
        }

        input[type="checkbox"] {
            width: auto;
        }

        .auth-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 14px;
        }

        .auth-row label {
            display: flex;
            align-items: center;
            gap: 6px;
            font-weight: 500;
        }

        button[type="submit"] {
            width: 100%;
            padding: 14px;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 14px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            margin-top: 8px;
        }

        button[type="submit"]:hover {
            background: #1d4ed8;
        }

        a {
            color: #2563eb;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

<div class="login-container">
    <div class="login-card">

        <div class="brand-logo">SI KELAS</div>

        <div class="auth-content">
            {{ $slot }}
        </div>

    </div>
</div>

</body>
</html>
