<?php
include "../../phpconfig/allfunction.php";

$cashieridz = $_SESSION["login_user"];

$request_itemname = $_POST["request_itemname"];
$request_itemqty = $_POST["request_itemqty"];
$request_reason = $_POST["request_reason"];

$newId = getId($db,"ho_use_mcore","ho_requests","reqidxx");

$sql = "INSERT INTO ho_use_mcore.ho_requests (reqidxx, itemname, itemqty, reqreason, cashieridz, status, tsz)
			VALUES ($newId, '$request_itemname', $request_itemqty, '$request_reason', '$cashieridz', 0, NOW())";
$result = mysqli_query($db, $sql);

if (!$result) {
	echo mysqli_error($db);
} else {
	echo 1;
}
?>