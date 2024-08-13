<?php
include "../../phpconfig/allfunction.php";

$cashieridz = $_SESSION["login_user"];

$req_id = $_POST["req_id"];
$status = $_POST["status"];

$sql1 = "UPDATE ho_use_mcore.ho_requests SET status = $status WHERE reqidxx = $req_id";
$result1 = mysqli_query($db, $sql1);

$newId = getId($db,"ho_use_mcore","ho_approval","approvalidxx");

$sql2 = "INSERT INTO ho_use_mcore.ho_approval (approvalidxx, reqidz, approver, tsz)
            VALUES ($newId, $req_id, $cashieridz, NOW())";
$result2 = mysqli_query($db, $sql2);

if (!$result1 || !$result2) {
	echo mysqli_error($db);
} else {
	echo 1;
}
?>