<?php
require_once('./DBConnection.php');
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM `queue_list` where queue_id = '{$_GET['id']}'");
    @$res = $qry->fetchArray();
    if($res){
        foreach($res as $k => $v){
            if(!is_numeric($k)){
                $$k = $v;
            }
        }
    }
}
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM `queue_list_liv` where queue_id = '{$_GET['id']}'");
    @$res = $qry->fetchArray();
    if($res){
        foreach($res as $k => $v){
            if(!is_numeric($k)){
                $$k = $v;
            }
        }
    }
}
?>
<style>
    #uni_modal .modal-footer{
        display:none;
    }
</style>
<div class="container fluid">
    <?php if(isset($_GET['success']) && $_GET['success'] == true): ?>
        <center><div class="alert alert-success">Your Queue Number is successfully generated.</div></center>
    <?php endif; ?>
    <div id="outprint">
        <div class="row justify-content-end">
            <div class="col-12">
                <div class="card border-0 border-0  rounded-0 border-0 border-0">
                    <div class="fs-1 fw-bold text-center"><?php echo $queue ?></div>
                   
                   <center><?php //echo $customer_name ?></center>
                   
                    <center><?php echo $date_created ?></center>
                    <center>Lapse number <b>will not be entertained</b> </center>
                </div>
            </div>
        </div>
    </div>
    <div class="row my-2 mx-0 justify-content-end align-items-center">
    <center>
        <button class="btn btn-success rounded-0 me-2 col-sm-4" id="print" type="button"><i class="fa fa-print"></i> Print</button>
        <button class="btn btn-dark rounded-0 col-sm-4" data-bs-dismiss="modal" type="button"><i class="fa fa-times"></i> Close</button>
        </center>
    </div>
</div>
<script>
  $(function(){
    $('#print').click(function(){
        var _el = $('<div>')
        var _h = $('head').clone()
        var _div = $('<div>').css('text-align', 'center') // center the images
        var _img1 = $('<img>').attr('src', './phinma.png').attr('alt', 'SWU Phinma Logo').attr('width', '50').attr('height', '50') // create the first image element
        var _img2 = $('<img>').attr('src', './swu.png').attr('alt', 'SWU Phinma Logo').attr('width', '50').attr('height', '50') // create the second image element
        _div.append(_img1).append(_img2) // append the images to the new div element
        var _p = $('#outprint').clone()
        _h.find('title').text("Queue Number - Print")
        _el.append(_h)
        _el.append(_div) // append the new div element with the images
        _el.append(_p)
        var nw = window.open('','_blank','width=700,height=500,top=75,left=200')
            nw.document.write(_el.html())
            nw.document.close()
            setTimeout(() => {
                nw.print()
                setTimeout(() => {
                    nw.close()
                    $('#uni_modal').modal('hide')
                }, 200);
            }, 500);
    })
})



</script>