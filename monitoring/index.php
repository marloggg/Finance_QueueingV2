<?php
session_start();
require_once('./../DBConnection.php');
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ucwords(str_replace('_',' ',$page)) ?> | Cashier Queuing System - Cashier - Side</title>
    <link rel="stylesheet" href="./../Font-Awesome-master/css/all.min.css">
    <link rel="stylesheet" href="./../css/bootstrap.css">
    <link rel="stylesheet" href="./../select2/css/select2.min.css">
    <script src="./../js/jquery-3.6.0.min.js"></script>
    <script src="./../js/popper.min.js"></script>
    <script src="./../js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./../DataTables/datatables.min.css">
    <script src="./../DataTables/datatables.min.js"></script>
    <script src="./../Font-Awesome-master/js/all.min.js"></script>
    <script src="./../select2/js/select2.min.js"></script>
    <script src="./../js/script.js"></script>
    <link rel="shortcut icon" type= "x-icon" href="<?php 
                                    $imageFiles = scandir('.././images');
                                    $image = isset($imageFiles[2]) ? '.././images/' . $imageFiles[2] : '';
                                    echo $image;
                                    ?>">
    <style>
        :root{
            --bs-success-rgb:71, 222, 152 !important;
        }
        html,body{
            height:100%;
            width:100%;
        }
        main{
            height:100%;
            display:flex;
            flex-flow:column;
        }
        #page-container{
            flex: 1 1 auto; 
            overflow:auto;
        }
        #topNavBar{
            flex: 0 1 auto; 
        }
        .thumbnail-img{
            width:50px;
            height:50px;
            margin:2px
        }
        .truncate-1 {
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
        }
        .truncate-3 {
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
        }
        .modal-dialog.large {
            width: 80% !important;
            max-width: unset;
        }
        .modal-dialog.mid-large {
            width: 50% !important;
            max-width: unset;
        }
        @media (max-width:720px){
            
            .modal-dialog.large {
                width: 100% !important;
                max-width: unset;
            }
            .modal-dialog.mid-large {
                width: 100% !important;
                max-width: unset;
            }  
        
        }
        .display-select-image{
            width:60px;
            height:60px;
            margin:2px
        }
        img.display-image {
            width: 100%;
            height: 45vh;
            object-fit: cover;
            background: black;
        }
        /* width */
        ::-webkit-scrollbar {
        width: 5px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
        background: #f1f1f1; 
        }
        
        /* Handle */
        ::-webkit-scrollbar-thumb {
        background: #888; 
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
        background: #555; 
        }
        .img-del-btn{
            right: 2px;
            top: -3px;
        }
        .img-del-btn>.btn{
            font-size: 10px;
            padding: 0px 2px !important;
        }
    </style>
    <?php
    $file_path = '../text/text_navcolor.txt';
    if (file_exists($file_path) && ($storedText = file_get_contents($file_path))) {
        echo '<style>';
        echo '#topNavBar {';
        echo '  flex: 0 1 auto;';
        echo '  background-color: ' . $storedText . ';'; // Set the background color here
        echo '}';
        echo '</style>';
    } else {
        echo '<center><div>File not found or empty.</div></center>';
    }
    ?>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-gradient" id="topNavBar">
        <div class="container">
            <a class="navbar-brand" href="../monitoring/">
            <center style="font-size: 30px; font-weight: bold;"><?php
            $file_path = '../text/text_content.txt';
            if (file_exists($file_path)) {
                $storedText = file_get_contents($file_path);
                if (!empty($storedText)) {
                    $fontColorFilePath = "../text/text_fontcolor.txt"; // Relative path to the font color text file
                    $selectedFontColor = file_get_contents($fontColorFilePath);
                    
                    // Add the selected font color to the inline style
                    echo "<center><div style='color: $selectedFontColor;'>$storedText</div></center>";
                } else {
                    echo '<center><div>No text available.</div></center>';
                }
            } else {
                echo '<center><div>Text file not found.</div></center>';
            }
            ?></center>
            </a>
        </div>
    </nav>
    <main>
    <div class="container-fluid py-3" id="page-container">
        <?php 
            if(isset($_SESSION['flashdata'])):
        ?>
        <div class="dynamic_alert alert alert-<?php echo $_SESSION['flashdata']['type'] ?>">
        <div class="float-end"><a href="javascript:void(0)" class="text-dark text-decoration-none" onclick="$(this).closest('.dynamic_alert').hide('slow').remove()">x</a></div>
            <?php echo $_SESSION['flashdata']['msg'] ?>
        </div>
        <?php unset($_SESSION['flashdata']) ?>
        <?php endif; ?>
        <?php
            include $page.'.php';
        ?>
    </div>
    </main>
    <div class="modal fade" id="uni_modal" role='dialog' data-bs-backdrop="static" data-bs-keyboard="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header py-2">
            <h5 class="modal-title"></h5>
        </div>
        <div class="modal-body">
        </div>
        <div class="modal-footer py-1">
            <button type="button" class="btn btn-sm rounded-0 btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
            <button type="button" class="btn btn-sm rounded-0 btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
        </div>
        </div>
    </div>
    <div class="modal fade" id="uni_modal_secondary" role='dialog' data-bs-backdrop="static" data-bs-keyboard="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header py-2">
            <h5 class="modal-title"></h5>
        </div>
        <div class="modal-body">
        </div>
        <div class="modal-footer py-1">
            <button type="button" class="btn btn-sm rounded-0 btn-primary" id='submit' onclick="$('#uni_modal_secondary form').submit()">Save</button>
            <button type="button" class="btn btn-sm rounded-0 btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
        </div>
        </div>
    </div>
    <div class="modal fade" id="confirm_modal" role='dialog'>
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content rounded-0">
            <div class="modal-header py-2">
            <h5 class="modal-title">Confirmation</h5>
        </div>
        <div class="modal-body">
            <div id="delete_content"></div>
        </div>
        <div class="modal-footer py-1">
            <button type="button" class="btn btn-primary btn-sm rounded-0" id='confirm' onclick="">Continue</button>
            <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Close</button>
        </div>
        </div>
        </div>
    </div>
</body>
</html>