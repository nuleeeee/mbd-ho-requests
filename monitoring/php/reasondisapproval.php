<?php
include "../../phpconfig/allfunction.php";

$cashieridz = $_SESSION["login_user"];

$req_id = $_POST["req_id"];
$reason = $_POST["reason"];

$sql = "UPDATE ho_use_mcore.ho_requests SET disapprovalreason = '".$reason."' WHERE reqidxx = $req_id";
$result = mysqli_query($db, $sql);

if (!$result) {
	echo mysqli_error($db);
} else {
	echo 1;
}