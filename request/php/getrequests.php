<?php
include "../../phpconfig/allfunction.php";

$cashieridz = $_SESSION["login_user"];

$display = "<table id='tbl_requests' class='table table-bordered cell-border text-nowrap' style='width: 100%; font-size: 12px;'>
					<thead class='thd'>
						<tr>
							<th>Request ID</th>
							<th>Status</th>
							<th>Reason For Request</th>
							<th>Date Requested</th>
							<th>Item Requested</th>
							<th>Item Quantity</th>
							<th>Employee Name</th>
							<th>Position</th>
							<th>Department</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>";

$sql = "SELECT reqidxx, itemname, itemqty, reqreason, house.cashieridz,
				IF(status=1,'APPROVED',IF(status=2,'DISAPPROVED','PENDING')) as status,
				IFNULL(disapprovalreason,'-') as disapprovalreason, house.tsz,
				CONCAT(firstname, ' ', lastname) as employee, position, deptname
		FROM ho_use_mcore.ho_requests house
		INNER JOIN vlookup_mcore.vnamenew vname ON vname.nameidxx = house.cashieridz
            INNER JOIN vlookup_mcore.vemployeeposition showpos ON showpos.positionidxx = vname.positionidz
		INNER JOIN vlookup_mcore.vdepartmentpersonnel personnel ON personnel.nameidz = house.cashieridz
		INNER JOIN vlookup_mcore.vdepartment dept ON dept.deptidxx = personnel.department
		WHERE house.cashieridz = $cashieridz
		ORDER BY tsz DESC";
$result = mysqli_query($db, $sql);

while ($row = mysqli_fetch_array($result)) {

	if($row["status"] == "APPROVED") {
		$prop = "disabled";
	} else {
		$prop = "";
	}

	$display .= "<tr>
					<td>" . $row["reqidxx"] . "</td>
					<td>" . $row["status"] . "</td>
					<td><button class='btn custom-btn btn-sm w-100' onclick=\"open_reason('".$row["reqreason"]."')\">View</button></td>
					<td>" . $row["tsz"] . "</td>
					<td>" . $row["itemname"] . "</td>
					<td>" . $row["itemqty"] . "</td>
					<td>" . $row["employee"] . "</td>
					<td>" . $row["position"] . "</td>
					<td>" . $row["deptname"] . "</td>
					<td><button class='btn btn-danger btn-sm w-100' onclick=\"edit_request('".$row["reqidxx"]."', '".$row["itemname"]."', '".$row["itemqty"]."', '".$row["reqreason"]."', '".$row["disapprovalreason"]."')\" $prop>Edit</button></td>
				</tr>";
}

$display .= "</tbody>
				</table>
<script>
	$(document).ready(function() {
        $('#tbl_requests').DataTable({
            'order': [],
            aLengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, 'ALL']
            ],
		scrollCollapse: true,
            scrollX: true,
		scrollY: 400
        });
    });
</script>";

echo $display;
?>