<?php
sleep(1);

require_once("./../DBConnection.php");

?>

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
                    <th class="text-center p-0">Terminal # Used</th>
                    <th class="text-center p-0">Queue Number</th>
                    <th class="text-center p-0">Date</th>   
                </tr>
            </thead>
            <tbody>


            <?php

$cashier = $_POST['cashier'];
$start_date = date('Y-m-d', strtotime($_POST['startDate']));
$end_date = date('Y-m-d', strtotime($_POST['endDate']));


if ($cashier == 0) {

    $sql = "SELECT ql.*, c.*, t.*
        FROM `queue_list_sa` ql 
        JOIN `cashier_list` c ON ql.cashier_id = c.cashier_id 
        JOIN `teller_list` t ON ql.teller_id = t.teller_id 
        WHERE ql.date_created BETWEEN '$start_date' AND '$end_date'
        ORDER BY ql.date_created ASC";
    
}else{

$sql = "SELECT ql.*, c.*, t.*
        FROM `queue_list_sa` ql 
        JOIN `cashier_list` c ON ql.cashier_id = c.cashier_id 
        JOIN `teller_list` t ON ql.teller_id = t.teller_id 
        WHERE c.lastname = '$cashier'
        AND ql.date_created BETWEEN '$start_date' AND '$end_date'
        ORDER BY ql.date_created ASC";
}

                $qry = $conn->query($sql);

                $i = 1;
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
                  <?php if(!$qry->fetchArray()): ?>
                    <tr>
                        <th class="text-center p-0" colspan="7">No data display.</th>
                   
                    </tr>
                <?php endif; ?>
  
                
            </tbody>
        </table>
        