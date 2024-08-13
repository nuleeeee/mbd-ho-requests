<?php
include "../../phpconfig/allfunction.php";

$cashieridz = $_SESSION["login_user"];

$display = "<table id='tbl_forapproval' class='table table-bordered cell-border text-nowrap' style='width: 100%; table-layout: fixed; font-size: 12px;'>
					<thead class='thd'>
						<tr>
							<th nowrap style='width: 90px;'>BTN</th>
							<th nowrap>Request ID</th>
							<th nowrap>Status</th>
							<th nowrap>Reason For Request / Use</th>
							<th nowrap>Date Requested</th>
							<th nowrap>Item Requested</th>
							<th nowrap>Item Quantity</th>
							<th nowrap>Employee Name</th>
							<th nowrap>Position</th>
							<th nowrap>Department</th>
						</tr>
					</thead>
					<tbody>";

$sql = "SELECT reqidxx, itemname, itemqty, reqreason, house.cashieridz, status, house.tsz,
						CONCAT(lastname, ', ', firstname) as employee, position, deptname
			FROM ho_use_mcore.ho_requests house
			INNER JOIN vlookup_mcore.vnamenew vname ON vname.nameidxx = house.cashieridz
            INNER JOIN vlookup_mcore.vemployeeposition showpos ON showpos.positionidxx = vname.positionidz
			INNER JOIN vlookup_mcore.vdepartmentpersonnel personnel ON personnel.nameidz = house.cashieridz
			INNER JOIN vlookup_mcore.vdepartment dept ON dept.deptidxx = personnel.department
			WHERE status = 0
			ORDER BY tsz DESC";
$result = mysqli_query($db, $sql);

while ($row = mysqli_fetch_array($result)) {
	$display .= "<tr>
						<td>
							<button class='btn btn-danger btn-sm me-2' onclick=\"disapprove_request(" . $row["reqidxx"] . ")\" title='Disapprove Request'>
								<img src='assets/icons/disapprove.png' height='30'>
							</button>
							<button class='btn btn-success btn-sm me-0' onclick=\"approve_request(" . $row["reqidxx"] . ")\" title='Approve Request'>
								<img src='assets/icons/approve.png' height='30'>
							</button>
						</td>
						<td>" . $row["reqidxx"] . "</td>
						<td>" . $row["reqidxx"] . "</td>
						<td><button class='btn custom-btn btn-sm w-100' onclick=\"open_reason('".$row["reqreason"]."')\">View</button></td>
						<td>" . $row["tsz"] . "</td>
						<td>" . $row["itemname"] . "</td>
						<td>" . $row["itemqty"] . "</td>
						<td>" . $row["employee"] . "</td>
						<td>" . $row["position"] . "</td>
						<td>" . $row["deptname"] . "</td>
					</tr>";
}

$display .= "</tbody>
				</table>
<script>
	$(document).ready(function() {
        $('#tbl_forapproval').DataTable().destroy();

        $('#tbl_forapproval').DataTable({
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