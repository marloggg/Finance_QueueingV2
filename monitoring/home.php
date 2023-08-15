<div class="container-fluid">
    <center><button class="btn btn-lg btn-primary w-25" id="start" type="button">Start Live Queue Monitor</button></center>
    <div class="border-dark border-3 border shadow d-none" id="monitor-holder">
        <div class="row my-0 mx-0">
            <div class="col-md-5 d-flex flex-column justify-content-center align-items-center border-end border-dark" id="serving-field">
                <div class="card col-sm-12 shadow h-100">
                    
                    <div class="card-header">
                        <h5 class="card-title text-center font-style=bold"><b>RAD</b></h5>
                    </div>
                    <div class="card-body h-100">
                        <div id="serving-list" class="list-group overflow-auto">
                            <?php 
                            $cashier = $conn->query("SELECT queue_list.*, cashier_list.*, teller_list.teller_id, teller_list.teller_name, COUNT(queue_list.queue_id) AS queue_count
                            FROM queue_list
                            FULL JOIN cashier_list ON queue_list.Cashier_id = cashier_list.cashier_id
                            FULL JOIN teller_list ON queue_list.Teller_id = teller_list.teller_id
                            WHERE date(queue_list.DATE_CREATED) = date('now')
                            GROUP BY teller_list.teller_id
                            ORDER BY queue_list.queue_id DESC limit 4");
                            
                            while($row = $cashier->fetchArray()):
                            ?>
                            <div class="list-group-item" data-id="<?php echo $row['cashier_id'] ?>" style="display:none">
                                <div class="fs-5 fw-2 cashier-name border-bottom border-info"><?php echo $row['teller_name'] ?></div>
                                <div class="ps-4"><span class="serve-queue fs-4 fw-bold">10001 - Ivan Jay Almeria</span></div>
                            </div>
                            <?php endwhile; ?>
                        </div>                        
                    </div>

                    <div class="card-header">
                        <h5 class="card-title text-center"><b>LIVE</b></h5>
                    </div>
                    <div class="card-body h-100">
                        <div id="serving-listlive" class="list-group overflow-auto">
                            <?php 
                            $cashier = $conn->query("SELECT queue_list_liv.*, cashier_list.*, teller_list.teller_id, teller_list.teller_name, COUNT(queue_list_liv.queue_id) AS queue_count
                            FROM queue_list_liv
                            FULL JOIN cashier_list ON queue_list_liv.Cashier_id = cashier_list.cashier_id
                            FULL JOIN teller_list ON queue_list_liv.Teller_id = teller_list.teller_id
                            WHERE date(queue_list_liv.DATE_CREATED) = date('now')
                            GROUP BY teller_list.teller_id
                            ORDER BY queue_list_liv.queue_id DESC limit 4");
                            
                            while($row = $cashier->fetchArray()):
                            ?>
                            <div class="list-group-item" data-id="<?php echo $row['cashier_id'] ?>" style="display:none">
                                <div class="fs-5 fw-2 cashier-name border-bottom border-info"><?php echo $row['teller_name'] ?></div>
                                <div class="ps-4"><span class="serve-queue fs-4 fw-bold">10001 - Ivan Jay Almeria</span></div>
                            </div>
                            <?php endwhile; ?>                            
                        </div>
                    </div>

                    <div class="card-header">
                        <h5 class="card-title text-center"><b>STUDENT ACCOUNT</b></h5>
                    </div>
                    <div class="card-body h-100">
                        <div id="serving-list_sa" class="list-group overflow-auto">
                            <?php 
                            $cashier = $conn->query("SELECT queue_list_sa.*, cashier_list.*, teller_list.teller_id, teller_list.teller_name, COUNT(queue_list_sa.queue_id) AS queue_count
                            FROM queue_list_sa
                            FULL JOIN cashier_list ON queue_list_sa.Cashier_id = cashier_list.cashier_id
                            FULL JOIN teller_list ON queue_list_sa.Teller_id = teller_list.teller_id
                            WHERE date(queue_list_sa.DATE_CREATED) = date('now')
                            GROUP BY teller_list.teller_id
                            ORDER BY queue_list_sa.queue_id DESC limit 4");
                            
                            while($row = $cashier->fetchArray()):
                            ?>
                            <div class="list-group-item" data-id="<?php echo $row['cashier_id'] ?>" style="display:none">
                                <div class="fs-5 fw-2 cashier-name border-bottom border-info"><?php echo $row['teller_name'] ?></div>
                                <div class="ps-4"><span class="serve-queue fs-4 fw-bold">10001 - Ivan Jay Almeria</span></div>
                            </div>
                            <?php endwhile; ?>                 
                            </div>
                        </div>
                    </div>
                </div>

            <div class="col-md-7 d-flex flex-column justify-content-center align-items-center bg-dark bg-gradient text-light" id="action-field">
                <div class="col-auto flex-grow-1">
                <?php 
                    $vid = scandir('./../video');
                    $video = isset($vid[2]) ? $vid[2]: "";
                ?>
                    <video id="loop-vid" src="./../video/<?php echo $video ?>" loop class="w-100 h-100"></video>
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
    var websocket = new WebSocket("ws://<?php echo $_SERVER['SERVER_NAME'] ?>:2306/queuing/php-sockets.php"); 
    websocket.onopen = function(event) { 
        console.log('socket is open!')
		}
    websocket.onclose = function(event){
        console.log('socket has been closed!')
    var websocket = new WebSocket("ws://<?php echo $_SERVER['SERVER_NAME'] ?>:2306/queuing/php-sockets.php"); 
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
            var message = "RAD NUMBER " + Math.abs(resp.queue) + "PLEASE PROCEED TO " + cashier + "";
            speak(message);
            }
        }
        }
    });
    }
// RAD END

// LIVE
function new_queuelive($cashier_id,$qid){
        $.ajax({
            url:'./../Actions.php?a=get_queue_liv',
            method:'POST',
            data:{cashier_id:$cashier_id,qid:$qid},
            dataType:'JSON',
            error:err=>{
                console.log(err)
            },
            success:function(resp){
                if(resp.status =='success'){
                    var item = $('#serving-listlive').find('.list-group-item[data-id="'+$cashier_id+'"]')
                    var cashier =  item.find('.cashier-name').text()
                    var nitem = item.clone()
                    //nitem.find('.serve-queue').text(resp.queue+" - "+resp.name) with name
                        nitem.find('.serve-queue').text(resp.queue)
                        item.remove()
                        $('#serving-listlive').prepend(nitem)
                    if(resp.queue == ''){
                        nitem.hide('slow')
                    }else{
                        nitem.show('slow')
                      //  speak("Queue Number "+(Math.abs(resp.queue))+resp.name+", Please proceed to "+cashier) with name
                        speak("LIVE NUMBER"+(Math.abs(resp.queue))+", Please proceed to "+cashier)
                    }
                }
            }
        })
    }
// LIVE END

    // SA
    function new_queue_sa($cashier_id,$qid){
        $.ajax({
            url:'./../Actions.php?a=get_queue_sa',
            method:'POST',
            data:{cashier_id:$cashier_id,qid:$qid},
            dataType:'JSON',
            error:err=>{
                console.log(err)
            },
            success:function(resp){
                if(resp.status =='success'){
                    var item = $('#serving-list_sa').find('.list-group-item[data-id="'+$cashier_id+'"]')
                    var cashier =  item.find('.cashier-name').text()
                    var nitem = item.clone()
                    //nitem.find('.serve-queue').text(resp.queue+" - "+resp.name) with name
                        nitem.find('.serve-queue').text(resp.queue)
                        item.remove()
                        $('#serving-list_sa').prepend(nitem)
                    if(resp.queue == ''){
                        nitem.hide('slow')
                    }else{
                        nitem.show('slow')
                      //  speak("Queue Number "+(Math.abs(resp.queue))+resp.name+", Please proceed to "+cashier) with name
                        speak("STUDENT ACCOUNT NUMBER"+(Math.abs(resp.queue))+", Please proceed to "+cashier)
                    }
                }
            }
        })
    }
    // SA END
    
    $(function(){
        setInterval(() => {
            time_loop()
        }, 1000);
        $('#start').click(function(){
            $(this).hide()
            $('#monitor-holder').removeClass('d-none')
            _resize_elements()
            vid_loop.play()
        })
        $(window).resize(function(){
            _resize_elements()
        })

        websocket.onmessage = function(event) {
			var Data = JSON.parse(event.data);
            if(!!Data.type && typeof Data.type != undefined && typeof Data.type != null){
                if(Data.type == 'queue'){
                    new_queue(Data.cashier_id,Data.qid)
                    new_queuelive(Data.cashier_id,Data.qid)
                    new_queue_sa(Data.cashier_id,Data.qid)          
                }
                if(Data.type == 'test'){
                    speak("This is a sample notification.")
                }
            }
        }
    })
</script>