<?php

if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
	$ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
	$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
	$ip = $_SERVER['REMOTE_ADDR'];
}
$lstIpall =substr(strrchr($ip,'.'),1);

include "session.php";

$ip =  $_SERVER['REMOTE_ADDR'];


function optionlst($db,$sqlcommand,$flddsplay,$fldvalue)
{
	$display = "";

	$resultx = mysqli_query($db, $sqlcommand);
	if(mysqli_error($db)!="")
	{
		return mysqli_error($db);
	}
	$count = mysqli_num_rows($resultx);
	if($count == 0)
	{
		$display .= "<option value=0>NO DATA</option>";
	}
	else
	{
		$display .= "<option value=0 selected>Please Select</option>";
		while($rowx = $resultx->fetch_array())
		{
			$display .= "<option value=".$rowx[$fldvalue].">".$rowx[$flddsplay]."</option>";
		}
	}
	return $display;
}

function getId($db,$schema,$table,$field)
{
	$ip =  $_SERVER['REMOTE_ADDR'];
	$lstIp =substr(strrchr($ip,'.'),1);
	$lstIp = sprintf('%03d',$lstIp);
	$sql = "SELECT max($field) as maxfld FROM $schema.$table WHERE $field LIKE '%.$lstIp%'";
	$newId = 0;
	$result = mysqli_query($db, $sql);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$count = mysqli_num_rows($result);

	if ($count == 1) {
		$newId = (int)$row["maxfld"] + 1 + sprintf('%0.3f',((int)$lstIp/1000));
		return sprintf('%0.3f',$newId);
	} else {
		$newId = 1 + sprintf('%0.3f',((int)$lstIp/1000));
		return sprintf('%0.3f',$newId) ;
	}
}

function clean($string)
{
	$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

	$string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

	$string = str_replace('-', ' ', $string);
	return $string;
}

?>