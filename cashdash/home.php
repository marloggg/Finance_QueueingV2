<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Website</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Custom styles */
        body {
            background-color: #7c7c7c;
            overflow: hidden;
        }
        .navbar {
            background-color: #B02609;
        }
        .navbar-dark .navbar-toggler-icon {
            background-color: #fff;
        }
        .navbar-brand, .navbar-nav .nav-link {
            color: #fff;
        }
        .navbar-brand:hover, .navbar-nav .nav-link:hover {
            color: #f0f0f0;
        }
        .background {
            position: relative;
            text-align: center;
            color: #fff;
            /* background: url('swu.png') no-repeat center center fixed; */
            background-size: 45%;
            height: 100vh;
            font-size: 20px;
        }
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
        }
        .btn-primary { 
            margin-right: 20px;
            font-size: 26px;
            margin-top: 90px;
        }
        .btn-primary:hover {
            background-color: #9D0A0E;
            border-color: #0056b3;
        }
        
        /* Apply the blur effect only to the background image */
        .background::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('swu.png') no-repeat center center fixed;
            filter: blur(5px); /* Adjust the blur level as needed */
            z-index: -1;
            background-size: 45%;
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">SWU Finance Queuing System</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../cashier_live"><b>LIVE</b></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../cashier_sa"><b>SA</b></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../cashier"><b>RAD</b></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Background Image and Buttons -->
    <div class="background">
        <div class="overlay"></div>
        <div class="container h-100">
            <div class="row h-100 justify-content-center align-items-center">
                <div class="col-md-6 text-center">
                    <h1><b>Welcome to SWU Finance</b></h1>
                    <p>Please choose the type of <b>CASHIER</b></p>
                    <?php
                        // PHP code for dynamic buttons
                        $links = [
                            '../cashier_live' => '<b>LIVE</b>',
                            '../cashier_sa' => '<b>SA</b>',
                            '../cashier' => '<b>RAD</b>'
                        ];
                        foreach ($links as $url => $label):
                    ?>
                        <a href="<?php echo $url; ?>" class="btn btn-primary btn-lg"><?php echo $label; ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS at the end of the body -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
