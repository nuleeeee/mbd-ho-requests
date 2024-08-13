<?php
include "../../phpconfig/allfunction.php";

$cashieridz = $_SESSION["login_user"];

$display = "<table id='tbl_inventory' class='table table-bordered cell-border text-nowrap' style='width: 100%; font-size: 12px;'>
					<thead class='thd'>
						<tr>
							<th>Item ID</th>
							<th>Item Name</th>
							<th>Quantity Used</th>
							<th>Date Used</th>
						</tr>
					</thead>
					<tbody>";

$sql = "SELECT reqidxx, itemname, status, usedqty, used.cashieridz, used.tsz
			FROM ho_use_mcore.ho_requests house
			LEFT OUTER JOIN ho_use_mcore.ho_used used ON used.reqidzz = house.reqidxx
			WHERE status = 1 AND used.cashieridz = $cashieridz
			ORDER BY used.tsz DESC";
$result = mysqli_query($db, $sql);

while ($row = mysqli_fetch_array($result)) {

    $datecreate = date_create($row["tsz"]);
    $dateused = date_format($datecreate,"M d Y g:i:s A");

	$display .= "<tr>
						<td>" . $row["reqidxx"] . "</td>
						<td>" . $row["itemname"] . "</td>
						<td>" . $row["usedqty"] . "</td>
						<td>" . $dateused . "</td>
					</tr>";
}

$display .= "</tbody>
				</table>
<script>
	$(document).ready(function() {
        $('#tbl_inventory').DataTable({
            'order': [],
            aLengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, 'ALL']
            ],
            scrollX: true,
            scrollY: 400,
			scrollCollapse: true
        });
    });
</script>";

echo $display;