<?php
session_start();
require_once('DBConnection.php');
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ucwords(str_replace('_',' ',$page)) ?> | Cashier Queuing System</title>
    <link rel="stylesheet" href="./Font-Awesome-master/css/all.min.css">
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./select2/css/select2.min.css">
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./DataTables/datatables.min.css">
    <script src="./DataTables/datatables.min.js"></script>
    <script src="./Font-Awesome-master/js/all.min.js"></script>
    <script src="./select2/js/select2.min.js"></script>
    <script src="./js/script.js"></script>
    <style>
        :root{
            --bs-success-rgb:71, 222, 152 !important;
        }
        html,body{
            height:100%;
            width:100%;
            margin: 0; 
            overflow: hidden;             
        }
        body::before {
            content: "";
            background-image: url("./imageback.jpg");
            background-size: cover;
            background-repeat: no-repeat;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            filter: blur(8px); /* Adjust the blur amount as needed */
            z-index: -1; /* Place the pseudo-element behind other content */
        }
        .form-control.border-0{
            transition:border .2s cubic-bezier(0.4, 0, 1, 1);
        }
        .form-control.border-0:focus{
            box-shadow:unset !important;
            border-color:var(--bs-info) !important;
        }
        .form-check-input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
    }

    .radio-group {
        display: flex;
        flex-wrap: wrap; /* Allow items to wrap to the next line if needed */
        justify-content: flex-start; /* Align items to the left within the container */
    }

    /* Style for the custom radio button */
    .custom-radio {
        display: inline-block;
        width: 750px; /* Set a fixed width for the radio buttons */
        height: 65px; /* Set a fixed height for the radio buttons */
        padding: 10px;
        border: 2px solid #ccc;
        border-radius: 5px;
        margin: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease; /* Added transform for hover effect */
    }

    .custom-radio:hover {
        background-color: #8E0B16;
        color: #FFFFFF; /* Change the background color on hover */
        transform: scale(1.05); /* Scale up on hover */
    }

    /* Style for the selected custom radio button */
    .form-check-input:checked + .custom-radio {
        background-color: #007bff;
        color: #fff;
        border-color: #007bff;
    }

    /* Style for the selected custom radio button on hover */
    .form-check-input:checked + .custom-radio:hover {
        background-color: #0056b3;
    }

    </style>
</head>
<body>
    <main>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary bg-gradient" id="topNavBar">
        <div class="container">
            <a class="navbar-brand" href="./queue_registration.php">
            <?php
            $file_path = './text/text_content.txt';
            if (file_exists($file_path)) {
                $storedText = file_get_contents($file_path);
                if (!empty($storedText)) {
                    echo $storedText ;
                } else {
                    echo '<center><div>No text available.</div></center>';
                }
            } else {
                echo '<center><div>Text file not found.</div></center>';
            }
            ?>
            </a>
        </div>
    </nav>
    <div class="container py-3" id="page-container">
        <?php 
            if(isset($_SESSION['flashdata'])):
        ?>
        <div class="dynamic_alert alert alert-<?php echo $_SESSION['flashdata']['type'] ?>">
        <div class="float-end"><a href="javascript:void(0)" class="text-dark text-decoration-none" onclick="$(this).closest('.dynamic_alert').hide('slow').remove()">x</a></div>
            <?php echo $_SESSION['flashdata']['msg'] ?>
        </div>
        <?php unset($_SESSION['flashdata']) ?>
        <?php endif; ?>
        <div class="container-fluid py-5">

<?php
        
// Query your database table to retrieve the start and end time values

$query = "SELECT default_start_time, default_cutoff_time, manual_cutoff_time FROM queuing_start_end";

$result = $conn->query($query);

$row = $result->fetchArray(SQLITE3_ASSOC);

$startTime =date("H:i", strtotime($row['default_start_time']));
$cutoffTime = date("H:i", strtotime($row['default_cutoff_time']));
$manualCutoffTime = $row['manual_cutoff_time'];

//echo "Start Time: $startTime";
//echo "Start Time: $cutoffTime";
// Get the current time
$currentTime = time();
$date = date("H:i", $currentTime);
//echo "Start Time: $date";

if ($manualCutoffTime == 0) {
    if ($date >= $startTime && $date <= $cutoffTime) {
        $buttonDisabled = '';
        $cutoff = "none";
    } else {
        $buttonDisabled = '';
        $cutoff = "none";
    }
    } else {
        $buttonDisabled = '';
        $cutoff = "none";
    }
//echo "Start Time: $buttonDisabled";
?>

                <div class="row justify-content-center">
                    <div class="col-md-8">

                        <div class="card rouded-5 shadow">
                            <div class="card-header rounded-0" style="display:<?php echo $cutoff; ?>;">
                                <div class="h5 card-title" style="color:red" >I'm sorry, the cutoff time has passed, and it is no longer possible to generate a queue number. </div>
                            </div>
                            <div class="card-header rounded-0">
                                <center class="h5 card-title" style="font-size: 30px; font-weight: bold;">Get your Queue Number Here.</center>
                            </div>
                            <div class="card-body rounded-0">
                                <form action="" id="queue-form">
                                    <div class="form-group">
                                        <label for="customer_name" style="font-size: 20px; margin-bottom: 15px;">Enter your Name</label>
                                        <input type="text" id="customer_name" name="customer_name" autofocus autocomplete="off" type="submit" <?php echo $buttonDisabled; ?> class="form-control form-control-lg rounded-0 border-0 border-bottom" required>
                                    </div>
                                    <!-- <form action="" id="login-form"> -->
                                            <center style="margin-top: 2em; font-weight: bold; font-size: 20px;"><small></small></center>
                                            <!-- Replace this part in your HTML code -->
                                    <div class="form-group">
                                        <label for="teller_id" style="font-size: 20px; margin-bottom: 15px;">Select Transaction</label>
                                        <div class="radio-group" <?php echo $buttonDisabled; ?>>
                                            <?php 
                                            $cashier = $conn->query("SELECT * FROM `trasaction_list` where `status` = 1 order by `trasaction_name` asc");
                                            while($row = $cashier->fetchArray()):
                                            ?>
                                            <div class="form-check">
                                                <input class="form-check-input " type="radio" name="teller_id" id="teller_id_<?php echo $row['trasaction_id']; ?>" value="<?php echo $row['trasaction_id']; ?>" required>
                                                <label class="form-check-label custom-radio" for="teller_id_<?php echo $row['trasaction_id']; ?>"><?php echo $row['trasaction_name']; ?></label>
                                            </div>
                                            <?php endwhile; ?>
                                        </div>
                                    </div>

                                                        
                                            <div class="form-group text-center my-4">
                                            <button style="margin-top: 2em;" class="btn-primary btn-lg btn col-sm-5 rounded-5" type="submit" <?php echo $buttonDisabled; ?>>Get Queue</button>

                                        <!-- </form> -->
                                        
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>

        </div>
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
    <script>
        


        // $(function handleSelectionChange(){
        //     var teller_id = $("#teller_id").val();
        // })

        
        // Remove the existing handleSelectionChange function

            $(function(){
                $('.select2').select2({width:'100%'})
                $('#queue-form').submit(function(e){
                    e.preventDefault()
                    var _this = $(this)
                    _this.find('.pop-msg').remove()
                    var el = $('<div>')
                    el.addClass('alert pop-msg')
                    el.hide()
                    _this.find('button[type="submit"]').attr('disabled',true).text('Please wait...')
                    var teller_id = $("input[name='teller_id']:checked").val(); // Get the selected radio button value
                    var url;
                    switch (parseInt(teller_id)) {
                        case 1:
                            url = './Actions.php?a=save_queue';
                            break;
                        case 3:
                            url = './Actions.php?a=save_queue_sa';
                            break;
                        case 2: 
                            url = './Actions.php?a=save_queue_liv';
                            break;
                    }
                    $.ajax({
                        url: url,
                        method:'POST',
                        data:$(this).serialize(),
                        dataType:'JSON',
                        error:err=>{
                            console.log(err)
                            el.addClass("alert-danger")
                            el.text("An error occured while saving data.")
                            _this.find('button[type="submit"]').attr('disabled',false)
                            _this.prepend(el)
                            el.show('slow')
                        },
                        success:function(resp){
                            if(resp.status == 'success'){
                                uni_modal("Your Queue","get_queue.php?success=true&id="+resp.id)
                                $('#uni_modal').on('hide.bs.modal',function(e){
                                    location.reload()
                                })
                            }else if(resp.status ='failed' && !!resp.msg){
                                el.addClass('alert-'+resp.status)
                                el.text(resp.msg)
                                _this.prepend(el)
                                el.show('slow')
                            }else{
                                el.addClass('alert-'+resp.status)
                                el.text("An Error occured.")
                                _this.prepend(el)
                                el.show('slow')
                            }
                            _this.find('button[type="submit"]').attr('disabled',false)
                        }
                    })
                })
            })


        
    </script>
</body>
</html>