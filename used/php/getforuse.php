<?php
include "../../phpconfig/allfunction.php";

$cashieridz = $_SESSION["login_user"];

$display = "<table id='tbl_inventory' class='table table-bordered cell-border text-nowrap' style='width: 100%; font-size: 12px;'>
					<thead class='thd'>
						<tr>
							<th>Item ID</th>
							<th>Date Approved</th>
							<th>Item Name</th>
							<th>Item Quantity</th>
							<th>Requested By</th>
							<th>Approved By</th>
						</tr>
					</thead>
					<tbody>";

$sql = "SELECT reqidxx, itemname, itemqty, reqreason, house.cashieridz, status, house.tsz,
						CONCAT(vname.firstname, ' ', vname.lastname) as employee, position, deptname,
                        approval.tsz as approvaldate, CONCAT(apvrname.firstname, ' ', apvrname.lastname) as approver,
						(itemqty-IFNULL(usedqty,0)) as remainingqty
			FROM ho_use_mcore.ho_requests house
			INNER JOIN vlookup_mcore.vnamenew vname ON vname.nameidxx = house.cashieridz
            INNER JOIN vlookup_mcore.vemployeeposition showpos ON showpos.positionidxx = vname.positionidz
			INNER JOIN vlookup_mcore.vdepartmentpersonnel personnel ON personnel.nameidz = house.cashieridz
			INNER JOIN vlookup_mcore.vdepartment dept ON dept.deptidxx = personnel.department
            INNER JOIN ho_use_mcore.ho_approval approval ON approval.reqidz = house.reqidxx
			INNER JOIN vlookup_mcore.vnamenew apvrname ON apvrname.nameidxx = approval.approver
			LEFT OUTER JOIN ho_use_mcore.ho_used used ON used.reqidzz = house.reqidxx
			WHERE status = 1
			ORDER BY approvaldate DESC";
$result = mysqli_query($db, $sql);

while ($row = mysqli_fetch_array($result)) {
	$display .= "<tr>
						<td>" . $row["reqidxx"] . "</td>
						<td>" . $row["approvaldate"] . "</td>
						<td>" . $row["itemname"] . "</td>
						<td>" . $row["remainingqty"] . " / " . $row["itemqty"] . "</td>
						<td>" . $row["employee"] . "</td>
						<td>" . $row["approver"] . "</td>
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