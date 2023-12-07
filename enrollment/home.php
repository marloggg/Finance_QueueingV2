<div class="container">
    <div class="row">
    <div class="col-md-12 d-flex flex-row justify-content-center align-items-center" id="queue-numbers">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function updateQueueNumbers() {
            $.ajax({
                url: "get_queue_numbers.php",
                type: "GET",
                success: function(response) {
                    $("#queue-numbers").html(response);
                },
                error: function(xhr, status, error) {
                    console.log("Error: " + error);
                }
            });
        }
        
        $(document).ready(function() {
            updateQueueNumbers(); // Call the function once when the page loads
            
            setInterval(function() {
                updateQueueNumbers(); // Call the function every 5 seconds
            }, 1000);
        });
    </script>

        </div>
        
        <div class="col-md-6 d-flex flex-column justify-content-center align-items-center" id="serving-field">
            <div class="card col-sm-8 shadow">
                <div class="card-header">
                    <h5 class="card-title text-center">Now Serving ENROLLMENT</h5>
                </div>
                <div class="card-body">
                    <div class="fs-1  my-2 fw-bold text-center"><span id="queue">-----</span></div>
                </div>
                <div class="card-footer">
                </div>
            </div>
        </div>
        <div class="col-md-6 d-flex flex-column justify-content-center align-items-center" id="action-field">
            <div class="w-100 row row-cols-sm-1 row-cols-md-2 row-cols-xl-3">
                <div class="col">
                    <button id="next_queue" class="btn btn-flat btn-primary rounded-5 btn-lg"><i class="fa fa-forward"></i> Next</button>
                </div>
                <div class="col">
                    <button id="notify" class="btn btn-flat btn-secondary rounded-5 btn-lg"><i class="fa fa-bullhorn"></i> Notify</button>
                </div>
            </div>
        </div>
        
    </div>
</div>

<div> <?php //echo $_SESSION['teller_id'] ?></div>
<div> <?php //echo $_SESSION['cashier_id'] ?></div>

<script>
    var websocket = new WebSocket("ws://<?php echo $_SERVER['SERVER_NAME'] ?>:2306/swu-fpqsv1/php-sockets.php"); 
    websocket.onopen = function(event) { 
      console.log('socket is open!')
		}
    websocket.onclose = function(event){
      console.log('socket has been closed!')
    var websocket = new WebSocket("ws://<?php echo $_SERVER['SERVER_NAME'] ?>:2306/swu-fpqsv1/php-sockets.php"); 
    };
    var in_queue = {};
    function _resize_elements(){
        var window_height = $(window).height()
        var nav_height = $('#topNavBar').height()
        var container_height = window_height - nav_height
        $('#serving-field,#action-field').height(container_height - 200)
    }
    function get_queue(){
        $.ajax({
            url:'./../Actions.php?a=next_enrollment',
            dataType:'json',
            error:err=>console.log(err),
            success:function(resp){
                if(resp.status){
                    if(Object.keys(resp.data).length > 0){
                        in_queue = resp.data
                    }else{
                        in_queue = {}
                        alert("No Queue Available")
                    }
                }else{
                    alert('An error occured')
                }
                queue();
            }
        })

    }
    function queue(){
        $('#queue').text(in_queue.queue || "-----")
        websocket.send(JSON.stringify({type:'enrollment',cashier_id:'<?php echo $_SESSION['teller_id'] ?>',qid:in_queue.queue_id}))
    }
    
    _resize_elements();
    $(function(){
        $(window).resize(function(){
            _resize_elements()
        })
        $('#next_queue').click(function(){
            get_queue()
        })
        $('#notify').click(function(){
            if(!!in_queue.queue){
                queue()
            }else{
                alert("No Queue Available")
            }
        })
    })

</script>