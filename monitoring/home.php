<div class="container-fluid">
    <center><button class="btn btn-lg btn-primary w-25" id="start" type="button">Start Live Queue Monitor</button></center>
    <div class="border-dark border-3 border shadow d-none" id="monitor-holder">
        <div class="row my-0 mx-0">
            <div class="col-md-5 d-flex flex-column justify-content-center align-items-center border-end border-dark" id="serving-field">
                <div class="card col-sm-12 shadow h-100">
                    
                <div class="row">
    <!-- First Card - RAD -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title text-center font-style=bold"><b>SHS</b></h5>
                                </div>
                                <div class="card-body" style="height: 250px;">
                                    <div id="serving-list" class="list-group overflow-auto">
                                        <?php 
                                        $cashier = $conn->query("SELECT * FROM `teller_list` order by `teller_id` asc");
                                        while($row = $cashier->fetchArray()):
                                        ?>
                                        <div class="list-group-item" data-id="<?php echo $row['teller_id']?>" style="display:none" >
                                            <center> 
                                                <div class="fs-4 bold fw-4 cashier-name border-bottom border-info"><?php echo $row['teller_name'] ?></div>
                                            </center>
                                            <center> 
                                                <div>
                                                    <span class="fs-3 fw-bold">SHS-</span>
                                                    <span class="serve-queue fs-3 fw-bold">10001 - Ivan Jay Almeria</span>
                                                </div>
                                            </center>
                                        </div>
                                        <?php endwhile; ?> 
                                    </div>                        
                                </div>
                            </div>
                        </div>

                        <!-- Second Card - RAD1 -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title text-center font-style=bold"><b>MEDICINE</b></h5>
                                </div>
                                <div class="card-body" style="height: 250px;">
                                    <div id="serving-list-medicine" class="list-group overflow-auto">
                                        <?php 
                                        $cashier = $conn->query("SELECT * FROM `teller_list` order by `teller_id` asc");
                                        while($row = $cashier->fetchArray()):
                                        ?>
                                        <div class="list-group-item" data-id="<?php echo $row['teller_id']?>" style="display:none" >
                                            <center> 
                                                <div class="fs-4 bold fw-4 cashier-name border-bottom border-info"><?php echo $row['teller_name'] ?></div>
                                            </center>
                                            <center> 
                                                <div>
                                                    <span class="fs-3 fw-bold">MED-</span>
                                                    <span class="serve-queue fs-3 fw-bold">10001 - Ivan Jay Almeria</span>
                                                </div>
                                            </center>
                                        </div>
                                        <?php endwhile; ?> 
                                    </div>                        
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Third Card - RAD2 -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title text-center font-style=bold"><b>FOREIGN</b></h5>
                                </div>
                                <div class="card-body" style="height: 250px;">
                                    <div id="serving-list-liv" class="list-group overflow-auto">
                                        <?php 
                                        $cashier = $conn->query("SELECT * FROM `teller_list` order by `teller_id` asc");
                                        while($row = $cashier->fetchArray()):
                                        ?>
                                        <div class="list-group-item" data-id="<?php echo $row['teller_id']?>" style="display:none" >
                                            <center> 
                                                <div class="fs-4 bold fw-4 cashier-name border-bottom border-info"><?php echo $row['teller_name'] ?></div>
                                            </center>
                                            <center> 
                                                <div>
                                                    <span class="fs-3 fw-bold">F-</span>
                                                    <span class="serve-queue fs-3 fw-bold">10001 - Ivan Jay Almeria</span>
                                                </div>
                                            </center>
                                        </div>
                                        <?php endwhile; ?> 
                                    </div>                        
                                </div>
                            </div>
                        </div>

                        <!-- Fourth Card - LIVE -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title text-center"><b>GRADUATE & UNDERGRAD</b></h5>
                                </div>
                                <div class="card-body" style="height: 250px;">
                                    <div id="serving-list-sa" class="list-group overflow-auto">
                                        <?php 
                                        $cashier = $conn->query("SELECT * FROM `teller_list` order by `teller_id` asc");
                                        while($row = $cashier->fetchArray()):
                                        ?>
                                        <div class="list-group-item" data-id="<?php echo $row['teller_id']?>" style="display:none" >
                                            <center> 
                                                <div class="fs-4 fw-4 cashier-name border-bottom border-info"><?php echo $row['teller_name'] ?></div>
                                            </center>
                                            <center> 
                                                <div>
                                                    <span class="fs-3 fw-bold">T-</span>
                                                    <span class="serve-queue fs-3 fw-bold">10001 - Ivan Jay Almeria</span>
                                                </div>
                                            </center>
                                        </div>
                                        <?php endwhile; ?>                             
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-header">
                        <h5 class="card-title text-center"><b>ENROLLMENT, INC, ORF etc.</b></h5>
                    </div>
                    <div class="card-body h-100">
                    <div id="serving-list-enrollment" class="list-group overflow-auto">
                            <?php 
                            $cashier = $conn->query("SELECT * FROM `teller_list` order by `teller_id` asc");
                            while($row = $cashier->fetchArray()):
                            ?>
                            <div class="list-group-item" data-id="<?php echo $row['teller_id']?>" style="display:none" >
                            <center> <div class="fs-2 fw-4 cashier-name border-bottom border-info"><?php echo $row['teller_name'] ?></div></center>
                            <center> <div ><span class="fs-2 fw-bold">ENROLLMENT-</span><span class="serve-queue fs-2 fw-bold">10001 - Jairo</span></div></center>
                            </div>
                            <?php endwhile; ?>                  
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-md-7 d-flex flex-column justify-content-center align-items-center bg-dark bg-gradient text-light" id="action-field">
                <div class="col-auto flex-grow-1">
                <?php 
                    $vid = scandir('../video/');
                    $videoList = [];

                    foreach ($vid as $file) {
                        if (pathinfo($file, PATHINFO_EXTENSION) === 'mp4') {
                            $videoList[] = $file;
                        }
                    }
                    ?>
                    <video id="loop-vid" src="../video/<?php echo $videoList[0]; ?>" class="w-100 h-100"></video>
                </div>
                <div id="datetimefield" class="w-100  col-auto">
                    <div class="fs-1 text-center time fw-bold"></div>
                    <div class="fs-5 text-center date fw-bold"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var video = document.getElementById("loop-vid");
    video.volume = 0.05;

    var videoList = <?php echo json_encode($videoList); ?>;
    var currentVideoIndex = 0;

    function playNextVideo() {
        if (videoList.length === 0) {
            return; // No videos to play
        }
        video.src = "../video/" + videoList[currentVideoIndex];
        video.play();
        currentVideoIndex = (currentVideoIndex + 1) % videoList.length;
    }

    video.onended = function () {
        playNextVideo(); // Play the next video when the current one ends
    };

    // Initially start playing the first video
    playNextVideo();



    var websocket = new WebSocket("ws://<?php echo $_SERVER['SERVER_NAME'] ?>:2306/swu-fpqsv1/php-sockets.php"); 
    websocket.onopen = function(event) { 
        console.log('socket is open!')
		}
    websocket.onclose = function(event){
        console.log('socket has been closed!')
    var websocket = new WebSocket("ws://<?php echo $_SERVER['SERVER_NAME'] ?>:2306/swu-fpqsv1/php-sockets.php"); 
    };
    let tts = new SpeechSynthesisUtterance();
    tts.lang = "en"; 
    tts.voice = window.speechSynthesis.getVoices()[0] ; 
    let notif_audio = new Audio("./../audio/ascend.mp3")
    let vid_loop = $('#loop-vid')[0]
    tts.onstart= ()=>{
        vid_loop.pause()
    }
    notif_audio.setAttribute('muted',true)
    notif_audio.setAttribute('autoplay',true)
    document.querySelector('body').appendChild(notif_audio)
    function speak($text=""){
        if($text == '')
        return false;
        tts.text = $text; 
        notif_audio.setAttribute('muted',false)
        notif_audio.play()
        setTimeout(() => {
            window.speechSynthesis.speak(tts); 
            tts.onend= ()=>{
                vid_loop.play()
            }
        }, 500);
    }
    function time_loop(){
        var hour,min,ampm,mo,d,yr,s;
        let mos = ['January','Febuary','March','April','May','June','July','August','September','October','November','December']
        var datetime = new Date();
        hour = datetime.getHours()
        min = datetime.getMinutes()
        s = datetime.getSeconds()
        ampm = hour >= 12 ? "PM" : "AM";
        mo = mos[datetime.getMonth()]
        d = datetime.getDate ()
        yr = datetime.getFullYear()
        hour = hour >= 12 ? hour - 12 : hour;
        hour = String(hour).padStart(2,0)
        min = String(min).padStart(2,0)
        s = String(s).padStart(2,0)
        $('.time').text(hour+":"+min+":"+s+" "+ampm)
        $('.date').text(mo+" "+d+", "+yr)
            
            
    }
    function _resize_elements(){
        var window_height = $(window).height()
        var nav_height = $('nav').height()
        var container_height = window_height - nav_height
        $('#serving-field,#action-field').height(container_height - 50)
        $('#serving-list').height($('#serving-list').parent().height() - 30)
    }
    function _resize_elements_liv(){
        var window_height = $(window).height()
        var nav_height = $('nav').height()
        var container_height = window_height - nav_height
        $('#serving-field,#action-field').height(container_height - 50)
        $('#serving-list-liv').height($('#serving-list-liv').parent().height() - 30)
    }
    function _resize_elements_sa(){
        var window_height = $(window).height()
        var nav_height = $('nav').height()
        var container_height = window_height - nav_height
        $('#serving-field,#action-field').height(container_height - 50)
        $('#serving-list-sa').height($('#serving-list-sa').parent().height() - 30)
    }
    function _resize_elements_enrollment(){
        var window_height = $(window).height()
        var nav_height = $('nav').height()
        var container_height = window_height - nav_height
        $('#serving-field,#action-field').height(container_height - 50)
        $('#serving-list-enrollment').height($('#serving-list-enrollment').parent().height() - 30)
    }
    function _resize_elements_medicine(){
        var window_height = $(window).height()
        var nav_height = $('nav').height()
        var container_height = window_height - nav_height
        $('#serving-field,#action-field').height(container_height - 50)
        $('#serving-list-medicine').height($('#serving-list-medicine').parent().height() - 30)
    }

// RAD
                    function new_queue($cashier_id, $qid) {
                $.ajax({
                    url: './../Actions.php?a=get_queue',
                    method: 'POST',
                    data: { cashier_id: $cashier_id, qid: $qid },
                    dataType: 'JSON',
                    error: err => {
                    console.log(err);
                    },
                    success: function (resp) {
                    if (resp.status == 'success') {
                        var item = $('#serving-list').find('.list-group-item[data-id="' + $cashier_id + '"]');
                        var cashier = item.find('.cashier-name').text();
                        var nitem = item.clone();
                        
                        nitem.find('.serve-queue').text(resp.queue);
                        item.remove();
                        $('#serving-list').prepend(nitem);
                        
                        if (resp.queue == '') {
                        nitem.hide('slow');
                        } else {
                        nitem.show('slow');
                        var message = "RAD NUMBER " + Math.abs(resp.queue) + "!!!!!!!, PLEASE PROCEED TO " + cashier + "!!!!!!!!!!!!!";
                        speak(message);
                        }
                    }
                    }
                });
                }
                // RAD END

                // LIVE
                function new_queue_liv($cashier_id, $qid) {
                $.ajax({
                    url: './../Actions.php?a=get_queue_liv',
                    method: 'POST',
                    data: { cashier_id: $cashier_id, qid: $qid },
                    dataType: 'JSON',
                    error: err => {
                    console.log(err);
                    },
                    success: function (resp) {
                    if (resp.status == 'success') {
                        var item = $('#serving-list-liv').find('.list-group-item[data-id="' + $cashier_id + '"]');
                        var cashier = item.find('.cashier-name').text();
                        var nitem = item.clone();
                        
                        nitem.find('.serve-queue').text(resp.queue);
                        item.remove();
                        $('#serving-list-liv').prepend(nitem);
                        
                        if (resp.queue == '') {
                        nitem.hide('slow');
                        } else {
                        nitem.show('slow');
                        var message = "LIVE' NUMBER " + Math.abs(resp.queue) + "!!!!!!!, PLEASE PROCEED TO " + cashier + "!!!!!!!!!!!!!";
                        speak(message);
                        }
                    }
                    }
                });
                }
                // LIVE END

                    // SA
                    function new_queue_sa($cashier_id, $qid) {
                $.ajax({
                    url: './../Actions.php?a=get_queue_sa',
                    method: 'POST',
                    data: { cashier_id: $cashier_id, qid: $qid },
                    dataType: 'JSON',
                    error: err => {
                    console.log(err);
                    },
                    success: function (resp) {
                    if (resp.status == 'success') {
                        var item = $('#serving-list-sa').find('.list-group-item[data-id="' + $cashier_id + '"]');
                        var cashier = item.find('.cashier-name').text();
                        var nitem = item.clone();
                        
                        nitem.find('.serve-queue').text(resp.queue);
                        item.remove();
                        $('#serving-list-sa').prepend(nitem);
                        
                        if (resp.queue == '') {
                        nitem.hide('slow');
                        } else {
                        nitem.show('slow');
                        var message = "STUDENT ACCOUNT NUMBER " + Math.abs(resp.queue) + "!!!!!!!, PLEASE PROCEED TO " + cashier + "!!!!!!!!!!!!!";
                        speak(message);
                        }
                    }
                    }
                });
                }
            // SA END

             // enrollment
             function new_enrollment($cashier_id, $qid) {
                $.ajax({
                    url: './../Actions.php?a=get_enrollment',
                    method: 'POST',
                    data: { cashier_id: $cashier_id, qid: $qid },
                    dataType: 'JSON',
                    error: err => {
                    console.log(err);
                    },
                    success: function (resp) {
                    if (resp.status == 'success') {
                        var item = $('#serving-list-enrollment').find('.list-group-item[data-id="' + $cashier_id + '"]');
                        var cashier = item.find('.cashier-name').text();
                        var nitem = item.clone();
                        
                        nitem.find('.serve-queue').text(resp.queue);
                        item.remove();
                        $('#serving-list-enrollment').prepend(nitem);
                        
                        if (resp.queue == '') {
                        nitem.hide('slow');
                        } else {
                        nitem.show('slow');
                        var message = "ENROLLMENT NUMBER" + Math.abs(resp.queue) + "!!!!!!!, PLEASE PROCEED TO " + cashier + "!!!!!!!!!!!!!";
                        speak(message);
                        }
                    }
                    }
                });
                }
            // SA enrollment

             // medicine
             function new_medicine($cashier_id, $qid) {
                $.ajax({
                    url: './../Actions.php?a=get_medicine',
                    method: 'POST',
                    data: { cashier_id: $cashier_id, qid: $qid },
                    dataType: 'JSON',
                    error: err => {
                    console.log(err);
                    },
                    success: function (resp) {
                    if (resp.status == 'success') {
                        var item = $('#serving-list-medicine').find('.list-group-item[data-id="' + $cashier_id + '"]');
                        var cashier = item.find('.cashier-name').text();
                        var nitem = item.clone();
                        
                        nitem.find('.serve-queue').text(resp.queue);
                        item.remove();
                        $('#serving-list-medicine').prepend(nitem);
                        
                        if (resp.queue == '') {
                        nitem.hide('slow');
                        } else {
                        nitem.show('slow');
                        var message = "MEDICINE NUMBER" + Math.abs(resp.queue) + "!!!!!!!, PLEASE PROCEED TO " + cashier + "!!!!!!!!!!!!!";
                        speak(message);
                        }
                    }
                    }
                });
                }
            // SA medicine


    
    $(function(){
        setInterval(() => {
            time_loop()
        }, 1000);
        $('#start').click(function(){
            $(this).hide()
            $('#monitor-holder').removeClass('d-none')
            _resize_elements()
            _resize_elements_liv()
            _resize_elements_sa()
            _resize_elements_enrollment()
            _resize_elements_medicine()
            vid_loop.play()
        })
        $(window).resize(function(){
            _resize_elements()
            _resize_elements_liv()
            _resize_elements_sa()
            _resize_elements_enrollment()
            _resize_elements_medicine()
        })

        websocket.onmessage = function(event) {
			var Data = JSON.parse(event.data);
            if(!!Data.type && typeof Data.type != undefined && typeof Data.type != null){
                if(Data.type == 'queue_rad'){
                    new_queue(Data.cashier_id,Data.qid)
                }
                if(Data.type == 'queue_live'){
                    new_queue_liv(Data.cashier_id,Data.qid)
                }
                if(Data.type == 'queue_sa'){
                    new_queue_sa(Data.cashier_id,Data.qid)          
                }
                if(Data.type == 'enrollment'){
                    new_enrollment(Data.cashier_id,Data.qid)          
                }
                if(Data.type == 'medicine'){
                    new_medicine(Data.cashier_id,Data.qid)          
                }
                if(Data.type == 'test'){
                    speak("This is a sample notification.")
                }
            }
        }
    })
</script>