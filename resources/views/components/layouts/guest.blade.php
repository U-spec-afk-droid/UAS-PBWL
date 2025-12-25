<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>BookClass - Login</title>

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

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
            max-width: 420px;
        }

        .login-card {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 15px 35px rgba(0,0,0,.08);
            padding: 35px 30px;
        }

        .brand-logo {
            text-align: center;
            font-size: 28px;
            font-weight: 800;
            color: #2563eb;
            margin-bottom: 18px;
            letter-spacing: .5px;
        }
    </style>
</head>

<body>
<div class="login-container">
    <div class="login-card">

        <div class="brand-logo">BOOKCLASS</div>

        {{ $slot }}

    </div>
</div>
</body>
</html>
