<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h3 class="card-title">Admin List</h3>
        <div class="card-tools align-middle">
            <button class="btn btn-dark btn-sm py-1 rounded-0" type="button" id="create_new">Add New</button>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-hover table-striped table-bordered">
            <colgroup>
                <col width="5%">
                <col width="20%">
                <col width="20%">
                <col width="20%">
                <col width="25%">
                <col width="5%">
            </colgroup>
            <thead>
                <tr>
                    <th class="text-center p-0">#</th>
                    <th class="text-center p-0">Employee #</th>
                    <th class="text-center p-0">Full Name</th>
                    <th class="text-center p-0">Email Address</th>
                    <th class="text-center p-0">Password</th>
                    <th class="text-center p-0">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $sql = "SELECT * FROM `administrator_list` where admin_id != 0 order by `lastname` asc";
                $qry = $conn->query($sql);
                $i = 1;
                    while($row = $qry->fetchArray()):
                ?>
                <tr>
                    <td class="text-center p-0"><?php echo $i++; ?></td>
                    <td class="py-0 px-1"><?php echo $row['username'] ?></td>
                    <td class="py-0 px-1"><?php echo $row['lastname'].", ".$row['firstname']." ".$row['MI']."."  ?></td>
                    <td class="py-0 px-1"><?php echo $row['email_address'] ?></td>
                    <td class="py-0 px-1"><?php echo $row['password'] ?></td>
                    <th class="text-center py-0 px-1">
                        <div class="btn-group" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle btn-sm rounded-0 py-0" data-bs-toggle="dropdown" aria-expanded="false">
                            Action
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <li><a class="dropdown-item edit_data" data-id = '<?php echo $row['admin_id'] ?>' href="javascript:void(0)">Edit</a></li>
                            <li><a class="dropdown-item delete_data" data-id = '<?php echo $row['admin_id'] ?>' data-name = '<?php echo $row['lastname'].", ".$row['firstname']." ".$row['MI']."." ?>' href="javascript:void(0)">Delete</a></li>
                            </ul>
                        </div>
                    </th>
                </tr>
                <?php endwhile; ?>
                <?php if(!$qry->fetchArray()): ?>
                    <tr>
                        <th class="text-center p-0" colspan="6">No data display.</th>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    $(function(){
        $('#create_new').click(function(){
            uni_modal('Add New User',"./manage_add_admin.php")
        })
        $('.edit_data').click(function(){
            uni_modal('Edit User Details',"./manage_edit_admin.php?id="+$(this).attr('data-id'))
        })
        $('.delete_data').click(function(){
            _conf("Are you sure to delete <b>"+$(this).attr('data-name')+"</b> from list?",'delete_data',[$(this).attr('data-id')])
        })
    })
    function delete_data($id){
        $('#confirm_modal button').attr('disabled',true)
        $.ajax({
            url:'./sa_actions.php?a=delete_user',
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
                }else{
                    alert("An error occurred.")
                    $('#confirm_modal button').attr('disabled',false)
                }
            }
        })
    }
</script>