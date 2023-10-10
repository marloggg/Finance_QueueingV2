
<h3 style="padding: 30%; font-size: 30px";><center>Welcome Super Administrator to Cashier Queuing System</center></h3>
<style>
    html,body{
                height:100%;
                width:100%;
                margin: 0;
                overflow: hidden;
            }
            body::before {
                background-color: gray;
                content: "";
                background-image: url("<?php
                                        $imageFiles = scandir('.././images');
                                        $image = isset($imageFiles[2]) ? '.././images/' . $imageFiles[2] : '';
                                        echo $image;
                                        ?>");
                background-size: contain;
                background-repeat: no-repeat;
                background-position: center center;
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                filter: blur(8px); /* Adjust the blur amount as needed */
                z-index: -1; /* Place the pseudo-element behind other content */
            }
</style>


