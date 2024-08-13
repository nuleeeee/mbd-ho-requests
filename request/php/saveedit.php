<?php
include "../../phpconfig/allfunction.php";

$cashieridz = $_SESSION["login_user"];

$req_id = $_POST["req_id"];
$txt_itemname = $_POST["txt_itemname"];
$txt_qty = $_POST["txt_qty"];
$txt_reason = $_POST["txt_reason"];

$sql = "UPDATE ho_use_mcore.ho_requests SET itemname = '".$txt_itemname."', itemqty = '".$txt_qty."', reqreason = '".$txt_reason."' WHERE reqidxx = '".$req_id."'";
$result = mysqli_query($db, $sql);

if (!$result) {
	echo mysqli_error($db);
} else {
	echo 1;
}