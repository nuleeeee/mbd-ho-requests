<?php
include "../../phpconfig/allfunction.php";

$cashieridz = $_SESSION["login_user"];

$item = $_POST["item"];
$qty = $_POST["qty"];


$newId = getId($db,"ho_use_mcore","ho_used","usedidxx");
$sql = "INSERT INTO ho_use_mcore.ho_used (usedidxx, reqidzz, usedqty, cashieridz, tsz)
		VALUES ($newId, $item, $qty, $cashieridz, NOW())";
$result= mysqli_query($db, $sql);

if (!$result) {
	echo mysqli_error($db);
} else {
	echo 1;
}