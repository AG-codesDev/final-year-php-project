<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tilt+Prism&display=swap" rel="stylesheet">

    <title>Grocery Management System</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html,
        body {
            background-color: black;
            color: white;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
            font-weight: 100;
            /* font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; */
            font-family: "Tilt Prism", sans-serif;
        }

        .links>a {
            color: white;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 900;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
            /* border: 2px solid white; */
            padding: 14px;
            border-radius: 10px;
            margin: 0 5px;

         
        }

        .m-b-md {
            margin-bottom: 30px;
        }
        #admin{
            background-color: yellow;
            color: black;
        }
        #cashier{
            background-color: blue;
        }
        #customer{
            background-color: red;
        }
    </style>
</head>
<body>
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md">
               Grocery Sales Management
            </div>

            <div class="links">
                <a href="Restro/admin/" id="admin">Admin Log In</a>
                <a href="Restro/cashier/" id="cashier">Staff Log In</a>
                <a href="Restro/customer" id="customer">Customer Log In</a>
            </div>
        </div>
    </div>
</body>

</html>