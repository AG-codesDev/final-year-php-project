<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tilt+Prism&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <title>Grocery Management System</title>

    <!-- Styles -->
    <style>
        html, body {
            background: linear-gradient(to right, #0f2027, #203a43, #2c5364);
            color: #f0f0f0;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .content {
            text-align: center;
            background: rgba(0, 0, 0, 0.5);
            padding: 50px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
        }

        .title {
            font-size: 84px;
            font-family: "Tilt Prism", sans-serif;
            margin-bottom: 30px;
        }

        .links > a {
            color: #f0f0f0;
            padding: 14px 30px;
            font-size: 15px;
            font-weight: 900;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
            border-radius: 25px;
            margin: 0 15px;
            transition: background-color 0.3s, transform 0.3s;
        }

        .links > a#admin {
            background-color: #e74c3c;
        }

        .links > a#cashier {
            background-color: #f1c40f;
            color: #333;
        }

        .links > a#customer {
            background-color: #3498db;
        }

        .links > a:hover {
            transform: scale(1.1);
        }
    </style>
</head>
<body>
    <div class="content">
        <div class="title">
            Grocery Sales Management
        </div>
        <div class="links">
            <a href="Restro/admin/" id="admin">Admin Log In</a>
            <a href="Restro/cashier/" id="cashier">Staff Log In</a>
            <a href="Restro/customer" id="customer">Customer Log In</a>
        </div>
    </div>
</body>
</html>
