<?php
include "../../phpconfig/allfunction.php";

$cashieridz = $_SESSION["login_user"];

$sql = "SELECT nameidxx, personnel, deptname, position FROM vlookup_mcore.vnamenew
			INNER JOIN vlookup_mcore.vdepartmentpersonnel personnel ON personnel.nameidz = vlookup_mcore.vnamenew.nameidxx
			INNER JOIN vlookup_mcore.vdepartment dept ON dept.deptidxx = personnel.department
            INNER JOIN vlookup_mcore.vemployeeposition showpos ON showpos.positionidxx = vlookup_mcore.vnamenew.positionidz
            WHERE nameidz = $cashieridz";
$result = mysqli_query($db, $sql);

while ($row = mysqli_fetch_array($result)) {
	echo json_encode(array('personnel' => $row["personnel"], 'position' => $row["position"], 'deptname' => $row["deptname"]));
}
?>