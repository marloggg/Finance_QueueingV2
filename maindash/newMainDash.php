<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            /* margin: 0;
            padding: 0; */
            background-color: #495057;
        }

        .content {
            position: justify;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%; 
            z-index: 0;
        }
        
        .title {
            margin-top: 300px;
            font-size: 50px;
            color: #ffff;
        }
        .header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px;
            z-index: 0;
        }

        .header h1 {
            margin: 0;
        }
        
        .menu {
            display: none;
            background-color: #eee;
            color: black;
            position: absolute;
            top: 50px;
            right: 10px;
            z-index: 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .me {
            padding: 10px 20px; /* Adjust padding as needed */
            color: #fff; /* Text color */
            background-color: #3498db; /* Background color */
            font-size: 18px; /* Font size */
            text-decoration: none; /* Remove underlines from the link */
            border-radius: 5px; /* Rounded corners */
            transition: background-color 0.3s ease;
        }
        .me:hover{
            background-color: #2980b9; /* Background color on hover */
        
        }
        .back {
            margin-top: 60px;   
            padding: 10px 20px; /* Adjust padding as needed */
            color: #fff; /* Text color */
            background-color: #3498db; /* Background color */
            font-size: 18px; /* Font size */
            text-decoration: none; /* Remove underlines from the link */
            border-radius: 5px; /* Rounded corners */
            transition: background-color 0.3s ease;
        }
        .back:hover{
            background-color: #2980b9; /* Background color on hover */
        
        }

        .menu ul{
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        list-style: none;
        text-align: center;
        }
        .menu ul li{
        margin: 20px 0;
        }
        .menu ul li a {
        text-decoration: none;
        font-size: 30px;
        font-weight: 500;
        padding: 5px 30px;
        color: white;
        position: relative;
        line-height: 50px;
        transition: all 0.3s ease;
        padding: 5px;
        text-align: center;
}

        .menu ul li a:after{
        position: absolute;
        content: "";
        background: #5a1e1e;
        width: 100%;
        height: 50px;
        left: 0;
        border-radius: 5px;
        transform: scaleY(0);
        z-index: -1;
        transition: transform 0.3s ease;
        }
        .menu ul li a:hover:after{
        transform: scaleY(1);
        }
        .menu ul li a:hover{
        color: #dc4545;
        }
        /* Style the buttons within menu items */
        .menu-button {
            display: inline-block;
            padding: 5px 10px;
            background-color: #3498db;
            color: #fff;
            font-size: 14px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
            cursor: pointer;
        }

        /* Change button background color on hover */
        .menu-button:hover {
            background-color: #2980b9;
        }

        
        .menu-button-open {
            display: inline;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #343a40;
            border: none;
            font-size: 24px;
            z-index: 3;
            cursor: pointer;
        }

        .menu-button-close {
            display: none;
        }
    </style>
</head>
<body>
    <div class="content">
        <center><h1 class="title">Usability of the Multiplatform Queuing System <br>
            SOUTHWESTERN UNIVERSITY PHINMA</h1></center>
        <center><a href="#" class="me" id="menu-button">Proceed</a></center>
    </div>
    <div class="menu">
    <div class="h-100 d-flex jsutify-content-center align-items-center">
    <div class='w-100'>
    <center><img src="./phinma.png" alt="SWU Phinma Logo" width="200" height="200">
    <img src="<?php 
    $imageFiles = scandir('./../images');
    $image = isset($imageFiles[2]) ? './../images/' . $imageFiles[2] : '';
    echo $image;
    ?>" alt="SWU Phinma Logo" width="200" height="200">
</center>
        <ul>
            <li><a href="../superadmin/">SUPER ADMINISTRATOR</a></li>
            <li><a href="../administrator/login.php">ADMINISTRATOR</a></li>
            <li><a href="../cashdash/home.php">CASHIERS</a></li>
            <li><a href="../queue_registration.php">GET QUEUE</a></li>
            <li><a href="../monitoring/">LIVE MONITORING</a></li>
            <button class="back" id="back-button">Back to Home</button>
        </ul>
    </div>
    <script>
        const menuButton = document.getElementById("menu-button");
        const menu = document.querySelector(".menu");
        const backButton = document.getElementById("back-button");

        menuButton.addEventListener("click", () => {
            menu.classList.toggle("menu-button-open");
            menuButton.classList.toggle("menu-button-close");
        });

        backButton.addEventListener("click", () => {
            // Redirect to your main home page URL
            window.location.href = "../MainDash/newMainDash.php";
        });
    </script>
</body>
</html>
