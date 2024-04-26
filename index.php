<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TibiaPvP - Home</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f4;
        }
        .header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
        }
        .navbar {
            background-color: #1a1a1a;
        }
        .navbar-brand, .nav-link {
            color: #d4af37 !important;
        }
        .nav-link:hover {
            color: #fff !important;
        }
        .content {
            background-color: #fff;
            margin: 20px auto;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 80%;
        }
        .footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        .logo {
            height: 200px;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="images/tibiapvp_logo.png" alt="TibiaPvP Logo" class="logo">
    </div>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">TibiaPvP</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="?function=last_death_server">Últimas Mortes <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?function=guild_online">Membros de Guilda Online</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?function=last_death_player">Exiva Última Morte</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container content">
        <?php

            $data_get = $_GET;

            if(isset($data_get['function'])) {
                $function = $data_get['function'];
            } else {
                $function = 'last_death_server';
            }


            if($function == 'last_death_server') {
                include('last_death_server.php');
            } elseif($function == 'guild_online') {
                include('guild_online.php');
            } elseif($function == 'last_death_player') {
                include('last_death_player.php');
            }
        
        ?>
    </div>
    <div class="footer">
        <p>&copy; 2024 TibiaPvP. All rights reserved.</p>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
