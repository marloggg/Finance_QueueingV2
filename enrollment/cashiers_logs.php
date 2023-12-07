<div class="card">
   <div class="card-header d-flex justify-content-between">
            <h3 class="card-title">Cashier List</h3> 
          
				<label for="price" class="control-label col-m-3 col-sm-offset-1" >Cashier: </label>
					<div class="col-m-2" id="fetch">
						<select name="cashier_selected" class="form-control" id="cashier_selected">
							<?php
									echo "<option value=".$_SESSION['lastname'].">".$_SESSION['lastname']."</option>";	
							?>
						</select>
					</div>


          <div>
                <label for="date" class="control-label col-m-3 col-sm-offset-1">Date Start</label>
                <div class="col-m-2">
                    <div class="input-group date" id="datepicker1">
                        <input type="text" class="form-control">
                        <span class="input-group-append">
                            <span class="input-group-text bg-white d-block">
                                <i class="fa fa-calendar"></i>
                            </span>
                        </span>
                    </div>
                </div>
            </div>
 
            <div>
                <label for="date" class="control-label col-m-3 col-sm-offset-1">Date End</label>
                <div class="col-m-2">
                    <div class="input-group date" id="datepicker2">
                        <input type="text" class="form-control">
                        <span class="input-group-append">
                            <span class="input-group-text bg-white d-block">
                                <i class="fa fa-calendar"></i>
                            </span>
                        </span>
                    </div>
                </div>
            </div>
            <div>
            <label></label>
            <div class="float-right">
            <button type="button" class="btn btn-primary" onclick="searchCashier()">Search</button>
            </div>
            </div>
            
            <div class="card-tools align-middle">
            <div class="col-md-12 head">
            <div>
            <label></label>
        <div class="float-right">
        <a href="export_data_cashier_logs.php" class="btn btn-success"><i class="dwn"></i> Export</a>
        </div>
        </div>
    </div>
    </div>
          
     </div>
</div>
    
<?php


$sql = "SELECT COUNT(*) FROM `enrollment` ql JOIN `cashier_list` c ON ql.cashier_id = c.cashier_id JOIN `teller_list` t ON ql.teller_id = t.teller_id";
$total_results = $conn->querySingle($sql);


$limit = 20; 

$total_pages = ceil($total_results / $limit);

$page = isset($_GET['page_num']) ? $_GET['page_num'] : 1; // current page, default to 1
$start = ($page - 1) * $limit; // starting index for the query

 // total number of results

$sql = "SELECT ql.*, c.*, t.* FROM `enrollment` ql JOIN `cashier_list` c ON ql.cashier_id = c.cashier_id JOIN `teller_list` t ON ql.teller_id = t.teller_id WHERE c.lastname = '" . $_SESSION['lastname'] ."' ORDER BY ql.date_created ASC LIMIT $start, $limit";
$qry = $conn->query($sql);
$i = $start + 1;

 // total number of pages
$prev_page = $page - 1; // previous page
$next_page = $page + 1; // next page

?>

    <div class="card-body">
        <table class="table table-hover table-striped table-bordered">
            <colgroup>
                <col width="25%">
                <col width="25%">
                <col width="25%">
                <col width="50%">
            </colgroup>
            <thead>
                <tr>
                    <th class="text-center p-0">Cashier Name</th>
                    <th class="text-center p-0">Teller # Used</th>
                    <th class="text-center p-0">Queue Number</th>
                    <th class="text-center p-0">Date</th>   
                </tr>
            </thead>
            <tbody>

            <?php
 
                    while($row = $qry->fetchArray()):
                ?>
                <tr>
                    <td class="text-center py-0 px-1"><?php echo $row['lastname'] ?></td>
                    <td class="text-center py-0 px-1"><?php echo $row['teller_name'] ?></td>
                    <td class="text-center py-0 px-1"><?php echo $row['queue'] ?></td>
                    <td class="text-center py-0 px-1"><?php echo date('Y-m-d', strtotime($row['date_created'])); ?></td>

                  
                </tr>
                <?php
                 endwhile; 
                  ?>
  
                
            </tbody>
        </table>
        
</div>
    <nav>
    <ul class="pagination justify-content-center">
        <?php if($page > 1): ?>
        <li class="page-item"><a class="page-link" href="?page=cashiers_logs&page_num=<?php echo $prev_page ?>">Previous</a></li>
        <?php endif; ?>
        <?php for($i = 1; $i <= $total_pages; $i++): ?>
        <li class="page-item <?php if($page == $i) echo 'active'; ?>"><a class="page-link" href="?page=cashiers_logs&page_num=<?php echo $i ?>"><?php echo $i ?></a></li>
        <?php endfor; ?>
        <?php if($page < $total_pages): ?>
        <li class="page-item"><a class="page-link" href="?page=cashiers_logs&page_num=<?php echo $next_page ?>">Next</a></li>
        <?php endif; ?>
    </ul>
</nav>
</div>
    </div>
    
</div>


<script>
        $(function() {
            $('#datepicker1').datepicker();
            $('#datepicker2').datepicker();
        });


        function searchCashier() {
   var cashier = $('#cashier_selected').val()
   var startDate = $("#datepicker1 input").val();
   var endDate = $("#datepicker2 input").val();

   $.ajax({
      url: "./get_alldata.php",
      type: "POST",
      data: {
         cashier: $('#cashier_selected').val(),
         startDate:  $("#datepicker1 input").val(),
         endDate: $("#datepicker2 input").val()
      },
            beforeSend:function(){
              $(".card-body").html("<span>Searching</span>");
            },
            success:function(data){
              $(".card-body").html(data);
            },
            error:function(jqXHR, textStatus, errorThrown){
              $(".card-body").html("<span>Error: " + textStatus + "</span>");
            }

   });
}

    </script>

