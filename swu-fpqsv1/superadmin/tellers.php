<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h3 class="card-title">Terminal List</h3>
        <div class="card-tools align-middle">
            <button class="btn btn-dark btn-sm py-1 rounded-0" type="button" id="create_new">Add New</button>
        </div>
    </div>

    <?php
$sql = "SELECT COUNT(*) FROM `teller_list`";
$total_results = $conn->querySingle($sql);


$limit = 20; 

$total_pages = ceil($total_results / $limit);

$page = isset($_GET['page_num']) ? $_GET['page_num'] : 1; // current page, default to 1
$start = ($page - 1) * $limit; // starting index for the query

 // total number of results

$sql = "SELECT * FROM `teller_list` ORDER BY `teller_name` ASC LIMIT $start, $limit";
$qry = $conn->query($sql);
$i = $start + 1;

 // total number of pages
$prev_page = $page - 1; // previous page
$next_page = $page + 1; // next page

?>

    <div class="card-body">
        <table class="table table-hover table-striped table-bordered">
            <colgroup>
                <col width="5%">
                <col width="25%">
                <col width="25%">
                <col width="25%">
                <col width="25%">
            </colgroup>
            <thead>
                <tr>
                    <th class="text-center p-0">#</th>
                    <th class="text-center p-0">Teller Number</th>
                    <th class="text-center p-0">Activity</th>
                    <th class="text-center p-0">Status</th>
                    <th class="text-center p-0">Action</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php 
             
                    while($row = $qry->fetchArray()):
                ?>
                <tr>
                    <td class="text-center p-0"><?php echo $i++; ?></td>
                    <td class="text-center py-0 px-1"><?php echo $row['teller_name'] ?></td>
                    <td class="py-0 px-1 text-center">
                        <?php 
                            if($row['log_status'] == 1){
                                echo  '<span class="py-1 px-3 badge rounded-pill bg-success"><small>In-Use</small></span>';
                            }else{
                                echo  '<span class="py-1 px-3 badge rounded-pill bg-danger"><small>Not In-Use</small></span>';

                            }
                        ?>
                    </td>
                    <td class="py-0 px-1 text-center">
                        <?php 
                            if($row['status'] == 1){
                                echo  '<span class="py-1 px-3 badge rounded-pill bg-success"><small>Active</small></span>';
                            }else{
                                echo  '<span class="py-1 px-3 badge rounded-pill bg-danger"><small>In-Active</small></span>';

                            }
                        ?>
                    </td>
                    <th class="text-center py-0 px-1">
                        <div class="btn-group" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle btn-sm rounded-0 py-0" data-bs-toggle="dropdown" aria-expanded="false">
                            Action
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <li><a class="dropdown-item edit_data" data-id = '<?php echo $row['teller_id'] ?>' href="javascript:void(0)">Edit</a></li>
                            <li><a class="dropdown-item delete_data" data-id = '<?php echo $row['teller_id'] ?>' data-name = '<?php echo $row['teller_name'] ?>' href="javascript:void(0)">Delete</a></li>
                            </ul>
                        </div>
                    </th>
                </tr>
                <?php endwhile; ?>
                <?php if(!$qry->fetchArray()): ?>
                    <tr>
                        <th class="text-center p-0" colspan="7">No data display.</th>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<div>
<label></label>
</div>
<nav>
    <ul class="pagination justify-content-center">
        <?php if($page > 1): ?>
        <li class="page-item"><a class="page-link" href="?page=tellers&page_num=<?php echo $prev_page ?>">Previous</a></li>
        <?php endif; ?>
        <?php for($i = 1; $i <= $total_pages; $i++): ?>
        <li class="page-item <?php if($page == $i) echo 'active'; ?>"><a class="page-link" href="?page=tellers&page_num=<?php echo $i ?>"><?php echo $i ?></a></li>
        <?php endfor; ?>
        <?php if($page < $total_pages): ?>
        <li class="page-item"><a class="page-link" href="?page=tellers&page_num=<?php echo $next_page ?>">Next</a></li>
        <?php endif; ?>
    </ul>
</nav>
<script>
    $(function(){
        $('#create_new').click(function(){
            uni_modal('Add New Teller',"./manage_teller.php")
        })
        $('.edit_data').click(function(){
            uni_modal('Edit Teller Details',"./manage_edit_teller.php?id="+$(this).attr('data-id'))
        })
        $('.delete_data').click(function(){
            _conf("Are you sure to delete <b>"+$(this).attr('data-name')+"</b> from list?",'delete_data',[$(this).attr('data-id')])
        })
    })
    function delete_data($id){
        $('#confirm_modal button').attr('disabled',true)
        $.ajax({
            url:'./sa_actions.php?a=delete_teller',
            method:'POST',
            data:{id:$id},
            dataType:'JSON',
            error:err=>{
                console.log(err)
                alert("An error occurred.")
                $('#confirm_modal button').attr('disabled',false)
            },
            success:function(resp){
                if(resp.status == 'success'){
                    location.reload()
                }else if(resp.status == 'failed' && !!resp.msg){
                    var el = $('<div>')
                    el.addClass('alert alert-danger pop-msg')
                    el.text(resp.msg)
                    el.hide()
                    $('#confirm_modal .modal-body').prepend(el)
                    el.show('slow')
                }else{
                    alert("An error occurred.")
                }
                $('#confirm_modal button').attr('disabled',false)

            }
        })
    }
</script>