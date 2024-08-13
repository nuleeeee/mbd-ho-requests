<?php

include "session.php";

if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}
$lstIpall =substr(strrchr($ip,'.'),1);

$ip =  $_SERVER['REMOTE_ADDR'];

$client_sub = "_mcore";
$mcore_sub = "_mcore";

//GET BRANCH NAME
function getbrname($bridz)
{
    if($bridz == 1)
    {
        return "Los Banos";
    }
    else if($bridz == 2)
    {
        return "Lipa";
    }
    else if($bridz == 3)
    {
        return "Calamba";
    }
    else if($bridz == 4)
    {
        return "Sto Tomas";
    }
    else if($bridz == 5)
    {
        return "Batangas City";
    }
    else if($bridz == 6)
    {
        return "Rosario";
    }
    else if($bridz == 7)
    {
        return "Lucena";
    }
    else if($bridz == 8)
    {
        return "Pagsanjan";
    }
    else if($bridz == 9)
    {
        return "Dasmarinas";
    }
}
//GET BRANCH FOR SQL
function getbrsql($bridz)
{
    if($bridz == 1)
    {
        return "mli";
    }
    else if($bridz == 2)
    {
        return "lpa";
    }
    else if($bridz == 3)
    {
        return "cal";
    }
    else if($bridz == 4)
    {
        return "sto";
    }
    else if($bridz == 5)
    {
        return "bct";
    }
    else if($bridz == 6)
    {
        return "ros";
    }
    else if($bridz == 7)
    {
        return "luc";
    }
    else if($bridz == 8)
    {
        return "psj";
    }
    else if($bridz == 9)
    {
        return "das";
    }
    else if($bridz == 99)
    {
        return "akin";
    }
}

function getbrscan($bridz)
{
    if($bridz == 1)
    {
        return "NEWLOS/LOS";
    }
    else if($bridz == 2)
    {
        return "LIP/LIP";
    }
    else if($bridz == 3)
    {
        return "CAL/CAL";
    }
    else if($bridz == 4)
    {
        return "STO/STO";
    }
    else if($bridz == 5)
    {
        return "BCT/BCT";
    }
    else if($bridz == 6)
    {
        return "ROS/ROS";
    }
    else if($bridz == 7)
    {
        return "LUC/LUC";
    }
    else if($bridz == 8)
    {
        return "PSJ";
    }
    else if($bridz == 9)
    {
        return "DAS/DAS";
    }
}

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

function getcreditcardtagopts($db, $sqlcommand, $flddsplay, $fldvalue)
{
    $display = "";

    $resultx = mysqli_query($db, $sqlcommand);
    if (mysqli_error($db) != "") {
        return mysqli_error($db);
    }
    $count = mysqli_num_rows($resultx);
    if ($count == 0) {
        $display .= "<option value=0>NO DATA</option>";
    } else {
        $display .= "<option value=0 selected>SELECT ALL</option>";
        while ($rowx = $resultx->fetch_array()) {
            $display .= "<option value=" . $rowx[$fldvalue] . ">" . $rowx[$flddsplay] . "</option>";
        }
    }
    return $display;
}

function getId($db,$schema,$table,$field,$formid)
{
    $ip =  $_SERVER['REMOTE_ADDR']; 
    $lstIp =substr(strrchr($ip,'.'),1);
    $lstIp = sprintf('%03d',$lstIp);
    $sql = "SELECT max($field) as maxfld FROM $schema.$table WHERE $field LIKE '%.$lstIp%'";
    $newId = 0;
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
            
    $bridz =$GLOBALS['brnumb'];    
            
    if ($count == 1) {
        $newId = (int)$row["maxfld"] + 1 + sprintf('%0.3f',((int)$lstIp/1000));
        return sprintf('%0.3f',$newId);
    } else {
        $newId = 1 + sprintf('%0.3f',((int)$lstIp/1000));
        return sprintf('%0.3f',$newId) ;

    }
}

function getcounterId($db,$schema,$table,$field,$formid)
{
    $ip =  $_SERVER['REMOTE_ADDR']; 
    $lstIp =substr(strrchr($ip,'.'),1);
    $sql = " SELECT max($field) as maxfld FROM $schema.$table ";
    $newId = 0;
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
            
    $bridz =$GLOBALS['brnumb'];    
            
    if ($count == 1) {
         $newId = (int)$row["maxfld"] + 1 + sprintf('%0.3f',((int)$bridz/1000)) + sprintf('%0.6f',((int)$lstIp/1000000)) + sprintf('%0.8f',((int)$formid/100000000));
        return sprintf('%0.8f',$newId);
    } else {
        $newId = 1 + sprintf('%0.3f',((int)$bridz/1000)) + sprintf('%0.6f',((int)$lstIp/1000000)) + sprintf('%0.8f',((int)$formid/100000000));
        return sprintf('%0.8f',$newId) ;
    }
}

function getIdoldhopo($db,$schema,$table,$field,$formid)
{
    $ip =  $_SERVER['REMOTE_ADDR']; 
    $lstIp =substr(strrchr($ip,'.'),1);
    $sql = "SELECT max($field) as maxfld FROM $schema.$table ";
    $newId = 0;
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    
    $bridz = $GLOBALS['brnumb'];
    
    if ($count == 1) {
        $newId = (int)$row["maxfld"] + 1 + sprintf('%0.3f',((int)$bridz/1000)) + sprintf('%0.6f',((int)$lstIp/1000000)) + sprintf('%0.8f',((int)$formid/100000000));
        return sprintf('%0.8f',$newId);
    } else {
        $newId = 1 + sprintf('%0.3f',((int)$bridz/1000)) + sprintf('%0.6f',((int)$lstIp/1000000)) + sprintf('%0.8f',((int)$formid/100000000));
        return sprintf('%0.8f',$newId) ;
    }
}

function getmaxsino($db,$cashieridz)
{
   $sqlcmd = "SELECT MAX(sino) + 1 as sino FROM sales_mbd.invdet WHERE cashieridz = $cashieridz";
    $result = mysqli_query($db, $sqlcmd);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if ($count >= 1) {  
        return $row["sino"];
    } else {
        return 0;
    }
}

function getinvoicenumbsales($db,$invidz)
{

    $sqlcmd = "
    SELECT sino FROM sales_mbd.invdet WHERE invidz = $invidz";
    $result = mysqli_query($db, $sqlcmd);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if ($count >= 1) {  
        return $row["sino"];
    } else {
        return 0;
    }
}

function getsoldtoid($db,$invidz)
{

    $sqlcmd = "SELECT nameidz FROM sales_mbd.inv WHERE invidxx = $invidz";
    $result = mysqli_query($db, $sqlcmd);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if ($count >= 1) {  
        return $row["nameidz"];
    } else {
        return 0;
    }
}

function comboboxsupp($db,$id,$sqlcomm,$displmemvar,$valuememvar)
{
    $sql = mysqli_real_escape_string($db,$sqlcomm);
    $result = mysqli_query($db, $sql);
    
    $display = "<select  class=\"form-control selectpicker\" id=\"".$id."\" data-live-search=\"true\">
    <optgroup>";
        
    while($row = $result->fetch_array())
    {
       $display .="<option value='".$row[$valuememvar]."'>".$row[$displmemvar]."</option>";
    }
    $display .="</optgroup></select>";
        
    return $display;
}

function checkstat($db,$forpicidzz)
{
    $sqlinsert = "
    SELECT * FROM scan_mbd_ho.toscangoodbad where goodbadidxx = 
(SELECT max(goodbadidxx) FROM scan_mbd_ho.toscangoodbad WHERE forpididz =$forpicidzz  )
    ";
    $result = mysqli_query($db, $sqlinsert);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if ($count >= 1) {
        if($row["good"] == 1)
        {
            return "Clear";
        }   
        else
        {
            return "With Findings";
        }

    } else {

        return "Unaudited";

    }
}

function checkifuploaded($db,$todoby,$forpicdz)
{
    $sql = "SELECT count(*) as count FROM scan_mbd.forpicscan".$todoby." where forpicidz=".$forpicdz;
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if ($row["count"] >= 1) {
        return "UPLOAD:".$row["count"]."(s)";
    } else {

        return "NO UPLOAD YET";
    }
}

function checkfindings($db,$chklist,$forpicidzz)
{
    $sqlinsert = "
    SELECT * FROM scan_mbd_ho.toscanaudit where forpididz=$forpicidzz and chlistidz=$chklist
    ";
    $result = mysqli_query($db, $sqlinsert);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if ($count >= 1) {
        return 1;
    } else {

        return 0;

    }
}

function showerrorx($db,$sql)
{
    if(mysqli_error($db)!="")
    {
        return mysqli_error($db)."<br>Error SQL:<br>".$sql;
    }
}

function showerror($db,$sql)
{
    if(mysqli_error($db)!="")
    {
        echo mysqli_error($db)."<br>\n\nError SQL:<br>\n\n".$sql;
        return 1;
    }
    return 0;
}

//SCAN AUDIT PETTYCASH
function getifhavepettyremarks($db,$forpidz)
{

    $sqlcmd = "SELECT TRIM(remarks) as remarks FROM scan_mbd_ho.toremarks WHERE forpicidz = $forpidz AND formidz = 1";
    $result = mysqli_query($db, $sqlcmd);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    
    if ($count >= 1) {  
        $remarks = $row['remarks'];
        $remarks = str_replace('"','',$remarks);
        $remarks = str_replace("'","",$remarks);    
        $remarks = preg_replace('/\s+/', ' ', $remarks);
        return $remarks;
    } else {

        return 0;
    }
}

function getifhavejabaremarks($db,$forpidz)
{

    $sqlcmd = "SELECT GROUP_CONCAT(remarks SEPARATOR ' / ') as remarks FROM scan_mbd_ho.toremarksjaba WHERE forpicidz = $forpidz";
    $result = mysqli_query($db, $sqlcmd);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    $remarks = mysqli_real_escape_string($db,$row['remarks']);
    if ($count >= 1) {  
        return $remarks;
    } else {

        return 0;
    }
}

function getremithaveremarks($db,$remitidz)
{

    $sqlcmd = "SELECT * FROM scan_mbd_ho.gainlossremarks WHERE reportidz = $remitidz";
    $result = mysqli_query($db, $sqlcmd);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    $remarks = mysqli_real_escape_string($db,$row['remarks']);
    if ($count >= 1) {  
        return $remarks;
    } else {

        return 0;
    }
}

function getrevise($db,$nameidz,$start,$end,$dbcrid,$type)
{
    $sqlcmd = "";
    if($type == 1)
    {
        $sqlcmd = "SELECT SUM(systemamt) as systemamt FROM
        (
            SELECT IFNULL(SUM(credit),0) as systemamt FROM sales_mbd.payt WHERE dbcridz = $dbcrid AND cashieridz = $nameidz  AND RIGHT(paytidxx,1) = 0 AND DATE(tsz) = '$start'
            UNION ALL
            SELECT IFNULL(SUM(credit),0) as systemamt FROM soa_mbd.soapaypayt WHERE dbcridz = $dbcrid AND cashieridz = $nameidz AND (RIGHT(invpaytidxx,1) = 0 OR RIGHT(invpaytidxx,1) = 8) AND DATE(tsz) = '$start'
            UNION ALL
            SELECT IFNULL(SUM(credit),0) as systemamt FROM provi_mbd.provipayt WHERE dbcridz = $dbcrid AND cashieridz = $nameidz AND DATE(tsz) = '$start'
        )as systemall";
    }
    else
    {
        $sqlcmd = "SELECT SUM(systemamt) as systemamt FROM
        (
            SELECT IFNULL(SUM(credit),0) as systemamt FROM sales_mbd.payt WHERE dbcridz = 1 AND cashieridz = $nameidz AND RIGHT(paytidxx,1) <> 0 AND DATE(tsz) = '$start'
            UNION ALL
            SELECT IFNULL(SUM(credit),0) as systemamt FROM soa_mbd.soapaypayt WHERE dbcridz = 1 AND cashieridz = $nameidz AND RIGHT(invpaytidxx,1) NOT IN (0,8) AND DATE(tsz) = '$start'
        )as systemall";
    }
    $result = mysqli_query($db, $sqlcmd);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    $systemamt = $row['systemamt'];
    if ($count >= 1) {  
        return $systemamt;
    } else {

        return 0;
    }
}

//AGING + INVENTORY
function getlastincqty($db,$itemidz,$date)
{
    $sqlcmd = "SELECT * FROM dispatch_mbd.dispatchindet WHERE itemidz = $itemidz AND tsz = '$date'";
    $result = mysqli_query($db, $sqlcmd);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    $lstdsct = $row['dispatchqty'];
    if ($count >= 1) {  
        return $lstdsct;
    } else {

        return 0;

    }
}

function getinctotal($db,$itemidz,$date)
{
    $sqlcmd = "SELECT IFNULL(SUM(dispatchqty),0) as dispatchqty FROM dispatch_mbd.dispatchindet WHERE tsz >= '$date' AND itemidz  = $itemidz";
    $result = mysqli_query($db, $sqlcmd);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    $dsct = $row['dispatchqty'];
    if ($count >= 1) {  
        return $dsct;
    } else {

        return 0;

    }
}

function getsalestotal($db,$itemidz,$startdate)
{
    $sqlcmd = "SELECT SUM(salesqty) as salesqty FROM
(
    SELECT IF(ISNULL(SUM(salesqty)),0.00,SUM(salesqty)) as salesqty FROM
    (
        SELECT qty - IFNULL(refqty,0) as salesqty FROM sales_mbd.invdet
        LEFT OUTER JOIN
        (
            SELECT SUM(refqty) as refqty,invdetidz FROM sales_mbd.refund WHERE DATE(tsz) > '$startdate' GROUP BY invdetidz
        )as tblnew_refund ON tblnew_refund.invdetidz = sales_mbd.invdet.invdetidxx
        WHERE DATE(tsz) > '$startdate' AND itemidz = $itemidz
    )as salesall
    UNION ALL
    SELECT IF(ISNULL(SUM(salesqty)),0.00,SUM(salesqty)) as salesqty FROM
    (
        SELECT invqty as salesqty FROM sales_mcore.salesdet
        LEFT OUTER JOIN
        (
            SELECT SUM(refqty) as refqty,invdetidz FROM sales_mcore.salesref WHERE DATE(tsz) > '$startdate' GROUP BY invdetidz
        )as tblold_refund ON tblold_refund.invdetidz = sales_mcore.salesdet.invdetidxx
        WHERE DATE(tsz) > '$startdate' AND itemidz = $itemidz
    )as salesall_old
)as sales_all";
    $resultx = mysqli_query($db, $sqlcmd);
    $rowx = mysqli_fetch_array($resultx, MYSQLI_ASSOC);
    $count = mysqli_num_rows($resultx);
    if ($count >= 1) {  
        return $rowx["salesqty"];
    }
    return 0;
}

function getfirstsales($db,$itemidz,$startdate)
{
    $sqlcmd = "SELECT MIN(tsz) as salestsz FROM sales_mbd.invdet WHERE DATE(tsz) > '$startdate' AND itemidz = $itemidz";
    $resultx = mysqli_query($db, $sqlcmd);
    $rowx = mysqli_fetch_array($resultx, MYSQLI_ASSOC);
    $count = mysqli_num_rows($resultx);
    if ($count >= 1) {  
        return $rowx["salestsz"];
    }
    return 0;
}

function getfirstsalesqty($db,$itemidz,$date)
{
    $sqlcmd = "SELECT qty FROM sales_mbd.invdet WHERE itemidz = $itemidz AND tsz = '$date';";
    $resultx = mysqli_query($db, $sqlcmd);
    $rowx = mysqli_fetch_array($resultx, MYSQLI_ASSOC);
    $count = mysqli_num_rows($resultx);
    if ($count >= 1) {  
        return $rowx["qty"];
    }
    return 0;
}

function getlastsales($db,$itemidz,$startdate)
{
    $sqlcmd = "SELECT MAX(tsz) as salestsz FROM sales_mcore.salesdet WHERE DATE(tsz) > '$startdate' AND itemidz = $itemidz";
    $resultx = mysqli_query($db, $sqlcmd);
    $rowx = mysqli_fetch_array($resultx, MYSQLI_ASSOC);
    $count = mysqli_num_rows($resultx);
    if ($count >= 1) {  
        return $rowx["salestsz"];
    }
    return 0;
}

function getlastsalesqty($db,$itemidz,$date)
{
    $sqlcmd = "SELECT qty FROM sales_mbd.invdet WHERE itemidz = $itemidz AND tsz = '$date';";
    $resultx = mysqli_query($db, $sqlcmd);
    $rowx = mysqli_fetch_array($resultx, MYSQLI_ASSOC);
    $count = mysqli_num_rows($resultx);
    if ($count >= 1) {  
        return $rowx["qty"];
    }
    return 0;
}

function getinterval($db,$startdate,$enddate)
{
    $sqlcmd = "SELECT TIMESTAMPDIFF(DAY, '$startdate', '$enddate') as intervalday";
    $resultx = mysqli_query($db, $sqlcmd);
    $rowx = mysqli_fetch_array($resultx, MYSQLI_ASSOC);
    $count = mysqli_num_rows($resultx);
    if ($count >= 1) {  
        return $rowx["intervalday"];
    }
    return 0;
}

//BANK
function systemamt($db,$bankdetidz)
{
    $sqlcmd = "SELECT SUM(credit) as amount FROM bank_mbd.systembank where bankdetidz=$bankdetidz
    UNION
    SELECT SUM(credit) as amount FROM bank_mbd.systembankremit WHERE bankdetidz = $bankdetidz";
    $result = mysqli_query($db, $sqlcmd);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $amt = $row['amount'];
    $count = mysqli_num_rows($result);
    if ($count == 1) {
        return $amt;
    } else {
        
        return "0";
    }

}

function getifhavebankremarks($db,$forpidz)
{
    
    $sqlcmd = "SELECT IFNULL(GROUP_CONCAT(remarks SEPARATOR '/ '),'kevinonly') as remarks FROM scan_mbd_ho.tobankremarks WHERE forpicidz = $forpidz GROUP BY forpicidz";
    $result = mysqli_query($db, $sqlcmd);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    $remarks = mysqli_real_escape_string($db,$row['remarks']);
    if ($count >= 1) {  
        return $remarks;
    } else {
        return "kevinonly";
    }
}

//HOPO
function gethoposchema($bridz)
{
    $schemamaster = "";
    if($bridz == 1)
    {
        $schemamaster = "hopo_mcore_mli";
    }
    else if($bridz == 2)
    {
        $schemamaster = "hopo_mcore_lpa";
    }
    else if($bridz == 3)
    {
        $schemamaster = "hopo_mcore_cal";
    }
    else if($bridz == 4)
    {
        $schemamaster = "hopo_mcore_sto";
    }
    else if($bridz == 5)
    {
        $schemamaster = "hopo_mcore_bct";
    }
    else if($bridz == 6)
    {
        $schemamaster = "hopo_mcore_ros";
    }
    else if($bridz == 7)
    {
        $schemamaster = "hopo_mcore_luc";
    }
    else if($bridz == 0)
    {
        $schemamaster = "hopo_mcore_hoq";
    }
    else if($bridz == 8)
    {
        $schemamaster = "hopo_mcore_psj";
    }
    else if($bridz == 9)
    {
        $schemamaster = "hopo_mcore_das";
    }
    else if($bridz == 10)
    {
        
    }
    else if($bridz == 11)
    {

    }
    else if($bridz == 99)
    {
        $schemamaster = "hopo_mcore_akin";
    }
    return $schemamaster;
}

function gethoposchemanew($bridz)
{
    $schemanew = "";
    if($bridz == 1)
    {
        $schemanew = "hopo_mbd_mli";
    }
    else if($bridz == 2)
    {
        $schemanew = "hopo_mbd_lpa";
    }
    else if($bridz == 3)
    {
        $schemanew = "hopo_mbd_cal";
    }
    else if($bridz == 4)
    {
        $schemanew = "hopo_mbd_sto";
    }
    else if($bridz == 5)
    {
        $schemanew = "hopo_mbd_bct";
    }
    else if($bridz == 6)
    {
        $schemanew = "hopo_mbd_ros";
    }
    else if($bridz == 7)
    {
        $schemanew = "hopo_mbd_luc";
    }
    else if($bridz == 0)
    {

    }
    else if($bridz == 8)
    {
        $schemanew = "hopo_mbd_psj";
    }
    else if($bridz == 9)
    {
        $schemanew = "hopo_mbd_das";
    }
    else if($bridz == 10)
    {
        
    }
    else if($bridz == 11)
    {

    }
    else if($bridz == 99)
    {
        $schemanew = "hopo_mbd";
    }
    return $schemanew;
}

function getcreditpayment($db,$hopoid)
{

    $sqlcmd = "
    SELECT dbcr FROM hopo_mcore.hopopayt
    INNER JOIN vlookup_mcore.vdbcr ON vlookup_mcore.vdbcr.dbcridxx = hopo_mcore.hopopayt.dbcridz
    WHERE hopoidzz = $hopoid AND dbcridz IN (SELECT dbcridxx FROM vlookup_mcore.vdbcr WHERE hopo = 1)
    ";
    $result = mysqli_query($db, $sqlcmd);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if ($count >= 1) {  
        return $row["dbcr"];
    } else {
        return "N/A";
    }
}

function getiftransactedbrpo($db,$brpoid)
{

    $sqlcmd = "SELECT * FROM hopo_mbd.hopodet WHERE brpoidz = $brpoid";
    $result = mysqli_query($db, $sqlcmd);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if ($count >= 1) {  
        return 1;
    } else {
        return 0;
    }
}

function getiftransactedbrpodet($db,$brpodet)
{

    $sqlcmd = "SELECT * FROM hopo_mcore.hopodet WHERE brdetidzz = $brpodet";
    $result = mysqli_query($db, $sqlcmd);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if ($count >= 1) {  
        return 1;
    } else {
        return 0;
    }
}


function getifcancelnapona($db,$brpoidxx)
{

    $sqlcmd = "SELECT * FROM hopo_mcore.hopocancel WHERE brpoidz = $brpoidxx";
    $result = mysqli_query($db, $sqlcmd);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if ($count >= 1) {  
        return 1;
    } else {
        return 0;
    }
}

//DBMEMO
function getdbmemotype($db,$type)
{
    $sqlcmd = "select * from vlookup_mcore.dbmemotype where typeidxx=$type";
    $result = mysqli_query($db, $sqlcmd);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    
    $count = mysqli_num_rows($result);
    if ($count == 1) {
        $types = $row['type'];
        return $types;
    } else {
        
        echo "NO CATEGORY";
    }

}

function getifdbmemo($db,$transid)
{
    $sqlcmd = "SELECT * FROM dbmemo_mbd.dbmemo WHERE invidz = $transid";
    $result = mysqli_query($db, $sqlcmd);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    
    $count = mysqli_num_rows($result);
    
    if ($count >= 1) {
        //$types = $row['type'];
        return 1;
    } else {
        
        return 0;
    }

}

function getifdbcoupon($db,$couponid)
{
    $sqlcmd = "SELECT * FROM dbmemo_mbd.dbcoupon WHERE couponid = $couponid";
    $result = mysqli_query($db, $sqlcmd);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if ($count >= 1) {
        return 1;
    } else {
        
        return 0;
    }

}

function getifcouponexists($db,$couponid)
{
    $sqlcmd = "SELECT * FROM sales_mbd.payt WHERE dbcridz = 125 AND credit < 0 AND paytidxx = $couponid";
    $result = mysqli_query($db, $sqlcmd);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $paidba = $row["paidba"];
    $soaba = $row["soaba"];
    $count = mysqli_num_rows($result);
    if ($count >= 1) {
        if($paidba == 0 && $soaba == 0)
        {
            return 0;
        }
        else
        {
            return 1;
        }
        
    } else {
        
        return 2;
    }

}

function getdbmemoschema($bridz)
{
    if($bridz == 1)
    {
        $schemanew = "dbmemo_mbd_mli";
    }
    else if($bridz == 2)
    {
        $schemanew = "dbmemo_mbd_lpa";
    }
    else if($bridz == 3)
    {
        $schemanew = "dbmemo_mbd_cal";
    }
    else if($bridz == 4)
    {
        $schemanew = "dbmemo_mbd_sto";
    }
    else if($bridz == 5)
    {
        $schemanew = "dbmemo_mbd_bct";
    }
    else if($bridz == 6)
    {
        $schemanew = "dbmemo_mbd_ros";
    }
    else if($bridz == 7)
    {
        $schemanew = "dbmemo_mbd_luc";
    }
    else if($bridz == 0)
    {
        $schemanew = "dbmemo_mbd";
    }
    else if($bridz == 8)
    {
        $schemanew = "dbmemo_mbd_psj";
    }
    else if($bridz == 9)
    {
        $schemanew = "dbmemo_mbd_das";
    }
    else if($bridz == 10)
    {
        
    }
    else if($bridz == 11)
    {

    }
    else if($bridz == 99)
    {
        $schemanew = "dbmemo_mbd";
    }
    return $schemanew;
}

function getitemdetails($db,$itemidz,$fld)
{
    $sqlcmd = "SELECT $fld as fld FROM vproduct_mcore.sqlitemdet WHERE itemidz = $itemidz";
    $result = mysqli_query($db, $sqlcmd);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if ($count >= 1) {  
        return $row["fld"];
    } else {
        return "N/A";
    }
}

function getitemcategory($db,$itemidz,$fld)
{
    $sqlcmd = "SELECT $fld as fld FROM vproduct_mcore.sqlitem
    INNER JOIN vproduct_mcore.category ON vproduct_mcore.category.catidxx = vproduct_mcore.sqlitem.catidz
    WHERE itemidx = $itemidz";
    $result = mysqli_query($db, $sqlcmd);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if ($count >= 1) {  
        return $row["fld"];
    } else {
        return "N/A";
    }
}

//SI CHECKER
function getdelstatus($db,$invdetidx)
{
    $sqlcmd = "SELECT IF(confirmqty = 0,'UNDELIVERED',IF(confirmqty > 0 AND confirmqty < qty, CONCAT(confirmqty,'-','PARTIAL'), IF(confirmqty > 0 AND confirmqty > qty, 'DELIVERED THEN REFUND','DELIVERED'))) as status FROM
    (
        SELECT qty - IFNULL(refqty,0) as qty,IFNULL(confirmqty,0) as confirmqty FROM sales_mbd.invdet
        LEFT OUTER JOIN
        (
            SELECT SUM(confirmqty) as confirmqty,invdetidz FROM deliv_mbd.backloaddet WHERE invdetidz = $invdetidx GROUP BY invdetidz
        )as tbl_confirm ON tbl_confirm.invdetidz = sales_mbd.invdet.invdetidxx
        LEFT OUTER JOIN
        (
            SELECT SUM(refqty) as refqty,invdetidz FROM sales_mbd.refund WHERE invdetidz = $invdetidx GROUP BY invdetidz
        )as tbl_refund ON tbl_refund.invdetidz = sales_mbd.invdet.invdetidxx
        WHERE invdetidxx = $invdetidx
    )as tbl_all";
    $result = mysqli_query($db, $sqlcmd);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if ($count >= 1) {  
        return $row["status"];
    } else {
        return "N/A";
    }
}

function getpickupstatus($db,$invdetidx)
{
    $sqlcmd = "SELECT IF(prepqty = 0,'UNPICKUP',IF(prepqty > 0 AND prepqty < qty, 'PARTIAL', IF(prepqty > 0 AND prepqty > qty, 'PICKUP THEN REFUND','PICK UP'))) as status FROM
    (
        SELECT qty - IFNULL(refqty,0) as qty,IFNULL(prepqty,0) as prepqty  FROM sales_mbd.invdet
        LEFT OUTER JOIN
        (
            SELECT SUM(prepqty) as prepqty,invdetidz FROM deliv_mbd.preparationdet WHERE invdetidz = $invdetidx GROUP BY invdetidz
        )as tbl_prep ON tbl_prep.invdetidz = sales_mbd.invdet.invdetidxx
        LEFT OUTER JOIN
        (
            SELECT SUM(refqty) as refqty,invdetidz FROM sales_mbd.refund WHERE invdetidz = $invdetidx GROUP BY invdetidz
        )as tbl_refund ON tbl_refund.invdetidz = sales_mbd.invdet.invdetidxx
        WHERE invdetidxx = $invdetidx
    )as tbl_all";
    $result = mysqli_query($db, $sqlcmd);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if ($count >= 1) {  
        return $row["status"];
    } else {
        return "N/A";
    }
}
//PROFIT
function profit_delcharge($db,$txt_startdate,$txt_enddate,$brsql)
{
    $sqlcmd = "SELECT  SUM(gross) AS gross FROM
(
    SELECT *,qty * (sprice - vbprice) AS profits,qty * sprice AS gross FROM
    (
        SELECT sales_mbd.invdet.invdetidxx,qty,sprice,vproduct_mbd.vitem_$brsql.vbprice,sales_mbd.disc.mlidiscamt AS mli,sales_mbd.discpromo.mlidiscpromoamt AS mlipromo,0 AS mlicomm FROM sales_mbd.invdet
        LEFT OUTER JOIN sales_mbd.disc ON sales_mbd.disc.invdetidxx = sales_mbd.invdet.invdetidxx
        LEFT OUTER JOIN sales_mbd.discpromo ON sales_mbd.discpromo.invdetidxx = sales_mbd.invdet.invdetidxx
        INNER JOIN vproduct_mbd.vitem_$brsql ON vproduct_mbd.vitem_$brsql.itemidxx = sales_mbd.invdet.itemidz
        WHERE DATE(sales_mbd.invdet.tsz) >= '$txt_startdate' AND DATE(sales_mbd.invdet.tsz) <= '$txt_enddate' AND sales_mbd.invdet.formidz = 1 AND sales_mbd.invdet.itemidz IN (221975)
        GROUP BY sales_mbd.invdet.invdetidxx
        UNION ALL 
        SELECT sales_mbd.invdet.invdetidxx,refqty * - 1 AS qty,sprice,vproduct_mbd.vitem_$brsql.vbprice,sales_mbd.disc.mlidiscamt AS mli,sales_mbd.discpromo.mlidiscpromoamt AS mlipromo,0 AS mlicomm FROM sales_mbd.refund
        INNER JOIN sales_mbd.invdet ON sales_mbd.invdet.invdetidxx = sales_mbd.refund.invdetidz
        LEFT OUTER JOIN sales_mbd.disc ON sales_mbd.disc.invdetidxx = sales_mbd.invdet.invdetidxx
        LEFT OUTER JOIN sales_mbd.discpromo ON sales_mbd.discpromo.invdetidxx = sales_mbd.invdet.invdetidxx
        INNER JOIN vproduct_mbd.vitem_$brsql ON vproduct_mbd.vitem_$brsql.itemidxx = sales_mbd.invdet.itemidz
        WHERE DATE(sales_mbd.refund.tsz) >= '$txt_startdate' AND DATE(sales_mbd.refund.tsz) <= '$txt_enddate' AND sales_mbd.invdet.itemidz IN (221975) AND sales_mbd.refund.formidz = 1
        GROUP BY sales_mbd.refund.refidxx
    )AS tmp1
) AS finals";
    $result = mysqli_query($db, $sqlcmd);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if ($count >= 1) {  
        return $row["gross"];
        
    }
    else
        
    {
        return 0;
    }
}

function profit_getsalary($db,$startdate,$enddate)
{
    $sqlcmd = "SELECT ROUND(sum(perday),2) as perday FROM 
(
    SELECT dtr_mcore.dtr.nameidz,date(dtr_mcore.dtr.tsz) as dates,rate,type,if(type=0,rate/26,rate) + (ifnull(amount,0))/26 as perday FROM dtr_mcore.dtr 
    INNER JOIN
    (
        SELECT nameidz,rate,type FROM vlookup_mcore.vnameratedet WHERE vnrateidxx IN (SELECT max(vnrateidxx) as idxx FROM vlookup_mcore.vnameratedet GROUP BY nameidz)
    ) as salaryrate ON salaryrate.nameidz = dtr_mcore.dtr.nameidz
    LEFT OUTER JOIN 
    (
        SELECT nameidz,amount FROM vlookup_mcore.allowance 
        WHERE allowidxx IN (SELECT max(allowidxx) as idxx FROM vlookup_mcore.allowance GROUP BY nameidz)
    ) as salaryallowance ON salaryallowance.nameidz = dtr_mcore.dtr.nameidz
    where date(dtr_mcore.dtr.tsz)>='$startdate' and date(dtr_mcore.dtr.tsz)<='$enddate' AND dtr_mcore.dtr.nameidz <> 3972
    GROUP BY nameidz,date(tsz)
) as overall ";

    $result = mysqli_query($db, $sqlcmd);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if ($count >= 1) {  
        return $row["perday"];
        
    }
    else
        
    {
        return 0;
    }
}

function profit_getsalarydriver($db,$startdate,$enddate)
{
    $sqlcmd = "SELECT (tripqty * ifnull(driverrate,0)) + (tripqty * ifnull(helper1rate,0)) + (tripqty * ifnull(helper2rate,0)) as amt FROM 
(
    SELECT trips2.*,rate as helper2rate FROM
    (
        SELECT trips1.*,rate as helper1rate FROM 
        (
            SELECT trips.*,rate as driverrate FROM
            (
                SELECT  trips as tripqty,tripticketidz,driver,helper1,helper2 FROM deliv_mbd.backload
                INNER JOIN vlookup_mcore.vname ON vlookup_mcore.vname.nameidxx = deliv_mbd.backload.driver
                WHERE DATE(deliv_mbd.backload.tsz) >= '$startdate' AND DATE(deliv_mbd.backload.tsz) <= '$enddate'
            )as trips 
            LEFT OUTER JOIN 
            (
                SELECT nameidz,rate FROM vlookup_mcore.vnameratetrip WHERE vnmetrpidx IN (SELECT max(vnmetrpidx) FROM vlookup_mcore.vnameratetrip GROUP BY nameidz)
            ) as ratedriver ON ratedriver.nameidz = trips.driver
        )as trips1
        LEFT OUTER JOIN 
        (
            SELECT nameidz,rate FROM vlookup_mcore.vnameratetrip WHERE vnmetrpidx IN (SELECT max(vnmetrpidx) FROM vlookup_mcore.vnameratetrip GROUP BY nameidz)
        ) as ratehelper1 ON ratehelper1.nameidz = trips1.helper1
    )as trips2
    LEFT OUTER JOIN 
    (
        SELECT nameidz,rate FROM vlookup_mcore.vnameratetrip WHERE vnmetrpidx IN (SELECT max(vnmetrpidx) FROM vlookup_mcore.vnameratetrip GROUP BY nameidz)
    ) as ratehelper2 ON ratehelper2.nameidz = trips2.helper2
) as final";

    $result = mysqli_query($db, $sqlcmd);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if ($count >= 1) {  
        return $row["amt"];
        
    }
    else
        
    {
        return 0;
    }
}

function profit_gas($db,$startdate,$enddate)
{
    $sqlcmd = "SELECT SUM(amount) as amount FROM
(
    SELECT dispatchqty * dispatchsprice as amount  FROM dispatch_mbd.dispatchindet
    WHERE dispatch_mbd.dispatchindet.itemidz in (230011,230017,54537687,54537689,54537690,54540785) AND date(dispatch_mbd.dispatchindet.tsz) >= '$startdate' AND date(dispatch_mbd.dispatchindet.tsz) <= '$enddate'
) as overall";
    $result = mysqli_query($db, $sqlcmd);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if ($count >= 1) {  
        return $row["amount"];
    }
    else
    {
        return 0;
    }
}

function profit_outside($db,$startdate,$enddate)
{
    $sqlcmd = "SELECT SUM(amt) * -1 as amt FROM
(
    SELECT sum(qty*sprice) as amt FROM sales_mbd.invdet where itemidz in (54532727,5449860) and formidz =5 and date(tsz)>='$startdate' and date(tsz)<='$enddate'
    UNION ALL
    SELECT sum(refqty*sprice)*-1 as amt FROM sales_mbd.refund
    INNER JOIN sales_mbd.invdet ON sales_mbd.invdet.invdetidxx = sales_mbd.refund.invdetidz AND sales_mbd.invdet.invidz = sales_mbd.refund.invidz
    where sales_mbd.invdet.itemidz in (54532727,5449860) and date(sales_mbd.refund.tsz)>='$startdate' and date(sales_mbd.refund.tsz)<='$enddate' and sales_mbd.invdet.formidz= 5
) as summall";
    $result = mysqli_query($db, $sqlcmd);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if ($count >= 1) {  
        return $row["amt"];
        
    }
    else
        
    {
        return 0;
    }
}

function profit_petty($db,$startdate,$enddate)
{
    $sqlcmd = "SELECT ABS(SUM(amt)) as amt FROM
(
    SELECT sum(qty*sprice) as amt FROM sales_mbd.invdet WHERE formidz =5 and date(tsz)>='$startdate' and date(tsz)<='$enddate'  AND sales_mbd.invdet.itemidz NOT in (54532727,5449860)
    UNION ALL
    SELECT SUM(refqty*sprice) *-1 as amt FROM sales_mbd.refund
    INNER JOIN sales_mbd.invdet ON sales_mbd.invdet.invdetidxx = sales_mbd.refund.invdetidz  AND sales_mbd.invdet.invidz = sales_mbd.refund.invidz
    where date(sales_mbd.refund.tsz)>='$startdate' and date(sales_mbd.refund.tsz)<='$enddate' AND sales_mbd.invdet.itemidz NOT in (54532727,5449860) and sales_mbd.invdet.formidz = 5 GROUP BY invdetidxx
) as summall";
    $result = mysqli_query($db, $sqlcmd);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if ($count >= 1) {  
        return $row["amt"];
        
    }
    else
        
    {
        return 0;
    }
}

function profit_gainloss($db,$startdate,$enddate)
{
    $sqlcmd = "SELECT SUM(gainlossamt) * -1 as amt FROM
(
    SELECT reportidxx,DATE(remit_mbd.remitreport.tsz) as transdate,systemamt,oldsystemamt,zankamt,remitamt,(systemamt + oldsystemamt + zankamt)  - remitamt as gainlossamt,nameidz  FROM remit_mbd.remitreport
    WHERE DATE(remit_mbd.remitreport.tsz) >= '$startdate' AND DATE(remit_mbd.remitreport.tsz) <= '$enddate' AND dbcridz= 1
)as tblgainloss";
    $result = mysqli_query($db, $sqlcmd);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if ($count >= 1) {  
        return $row["amt"];
        
    }
    else
        
    {
        return 0;
    }
}

function profit_rent($db,$bridz,$tartdate,$enddate)
{
    $sqlcmd = "SELECT amount/30 as amt FROM  vlookup_mcore.vrent where month= month(DATE_SUB('$tartdate', INTERVAL 4 MONTH)) and year = year(DATE_SUB('$tartdate', INTERVAL 4 MONTH)) and bridz=$bridz";
    $result = mysqli_query($db, $sqlcmd);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if ($count >= 1) {  
        return $row["amt"];
        
    }
    else
        
    {
        return 0;
    }
}

function profit_getcccharge($db,$start,$end)
{
    $sqlcmd = "select sum(credit)*.035 as amt from sales_mbd.payt where dbcridz = 3 AND date(tsz)>='$start' and date(tsz)<='$end'";
    $result = mysqli_query($db, $sqlcmd);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if ($count >= 1) {  
        return $row["amt"];
        
    }
    else
        
    {
        return 0;
    }
}

function profit_getbreakage($db,$stdate,$enddate,$type)
{
    if($type == 1)
    {
        $sqlcmd = "SELECT ROUND(SUM(amount),2) as breakageamt FROM
(
    SELECT item,qty,vbprice,qty * vbprice as  amount FROM
    (
        SELECT item,qty,itemidz FROM wrhse_mbd.breakagedet WHERE DATE(wrhse_mbd.breakagedet.tsz) >= '$stdate' AND DATE(wrhse_mbd.breakagedet.tsz) <= '$enddate'
    )as overbad
    INNER JOIN vproduct_mbd.vitem_psj ON vproduct_mbd.vitem_psj.itemidxx = overbad.itemidz
    INNER JOIN vproduct_mbd.vitem ON vproduct_mbd.vitem.itemidxx = overbad.itemidz
    INNER JOIN vproduct_mcore.category ON vproduct_mcore.category.catidxx = vproduct_mbd.vitem.suppidz
    WHERE npaydes <> 2
)as fbreakage";
    }
    else
    {
        $sqlcmd = "SELECT ROUND(SUM(amount),2) as breakageamt FROM
(
    SELECT item,qty,vbprice,qty * vbprice as  amount FROM
    (
        SELECT item,qty,itemidz FROM wrhse_mbd.breakagedet WHERE DATE(wrhse_mbd.breakagedet.tsz) >= '$stdate' AND DATE(wrhse_mbd.breakagedet.tsz) <= '$enddate'
    )as overbad
    INNER JOIN vproduct_mbd.vitem_psj ON vproduct_mbd.vitem_psj.itemidxx = overbad.itemidz
    INNER JOIN vproduct_mbd.vitem ON vproduct_mbd.vitem.itemidxx = overbad.itemidz
    INNER JOIN vproduct_mcore.category ON vproduct_mcore.category.catidxx = vproduct_mbd.vitem.suppidz
    WHERE npaydes = 2
)as fbreakage";
    }
    $result = mysqli_query($db, $sqlcmd);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    $breakageamt = $row['breakageamt'];
    if ($count >= 1) {  
        return $breakageamt;
    } else {

        return 0;

    }
}
//EXPENSE
function comboboxmonth($id)
{
    $month = date('m');
    $value1 ="value='1'";
    $value2 ="value='2'";
    $value3 ="value='3'";
    $value4 ="value='4'";
    $value5 ="value='5'";
    $value6 ="value='6'";
    $value7 ="value='7'";
    $value8 ="value='8'";
    $value9 ="value='9'";
    $value10 ="value='10'";
    $value11 ="value='11'";
    $value12 ="value='12'";
    if($month == 1)
        $value1 = "value='1' selected";
    else if($month == 2)
        $value2 = "value='2' selected";
    else if($month == 3)
        $value3 = "value='3' selected";
    else if($month == 4)
        $value4 = "value='4' selected";
    else if($month == 5)
        $value5 = "value='5' selected";
    else if($month == 6)
        $value6 = "value='6' selected";
    else if($month == 7)
        $value7 = "value='7' selected";
    else if($month == 8)
        $value8 = "value='8' selected";
    else if($month == 9)
        $value9 = "value='9' selected";
    else if($month == 10)
        $value10 = "value='10' selected";
    else if($month == 11)
        $value11 = "value='11' selected";
    else if($month == 12)
        $value12 = "value='12' selected";
    $display = "<select style='max-width:300px; display:inline;' class=\"form-control\" id=\"".$id."\" name=\"".$id."\">";
    $display .="<option $value1>January</option>";
    $display .="<option $value2>February</option>";
    $display .="<option $value3>March</option>";
    $display .="<option $value4>April</option>";
    $display .="<option $value5>May</option>";
    $display .="<option $value6>June</option>";
    $display .="<option $value7>July</option>";
    $display .="<option $value8>August</option>";
    $display .="<option $value9>September</option>";
    $display .="<option $value10>October</option>";
    $display .="<option $value11>November</option>";
    $display .="<option $value12>December</option>";
    $display .="</select>";
    echo $display;
}

function yearcmb($id)
{
    $display = "<select style='max-width:300px; display:inline;' class=\"form-control\" id=\"".$id."\" name=\"".$id."\">";
    for($i = date('Y') ; $i >= 2017; $i--)
    {
        $display .= "<option value='$i'>$i</option>";
    }
    $display .="</select>";     
    echo $display;
}

function expense_salary($db,$month,$year,$bridz)
{
    $sqlcmd = "SELECT SUM(amt) as amt FROM
(
    SELECT nameidxx,amt FROM vlookup_mcore.vname
    INNER JOIN
    (
        SELECT rate,nameidz FROM payroll_mcore.vnameratedet
        INNER JOIN
        (
            SELECT MAX(vnrateidxx) as vnrateidxx FROM payroll_mcore.vnameratedet GROUP BY nameidz
        )as tbl_rate ON tbl_rate.vnrateidxx = payroll_mcore.vnameratedet.vnrateidxx
        WHERE rate > 1
    )as tbl_ratedet ON tbl_ratedet.nameidz = vlookup_mcore.vname.nameidxx
    INNER JOIN
    (
        SELECT amt,nameidz FROM payroll_mcore.salary
        INNER JOIN
        (
            SELECT amt,salaryidz,nameidz FROM payroll_mcore.salarydet WHERE saldescid = 86 
        )as tbl_salarydet ON tbl_salarydet.salaryidz = payroll_mcore.salary.salaryidx
        WHERE MONTH(dateend)  = $month AND YEAR(dateend) = $year
    )as tbl_salary ON tbl_salary.nameidz = vlookup_mcore.vname.nameidxx
    WHERE bridz = $bridz
)as tbl_salaryall";
    $result = mysqli_query($db, $sqlcmd);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if ($count >= 1) {  
        return $row["amt"];
        
    }
    else
        
    {
        return 0;
    }
}

function expense_salarydriver($db,$month,$year,$bridz)
{
    $sqlcmd = "SELECT SUM(amt) as amt FROM
(
    SELECT nameidxx,amt FROM vlookup_mcore.vname
    INNER JOIN
    (
        SELECT rate,nameidz FROM payroll_mcore.vnameratetrip
        INNER JOIN
        (
            SELECT MAX(vnmetrpidx) as vnmetrpidx FROM payroll_mcore.vnameratetrip GROUP BY nameidz
        )as tbl_rate ON tbl_rate.vnmetrpidx = payroll_mcore.vnameratetrip.vnmetrpidx
        WHERE rate > 1
    )as tbl_ratedet ON tbl_ratedet.nameidz = vlookup_mcore.vname.nameidxx
    INNER JOIN
    (
        SELECT amt,nameidz FROM payroll_mcore.salary
        INNER JOIN
        (
            SELECT amt,salaryidz,nameidz FROM payroll_mcore.salarydet WHERE saldescid = 86 
        )as tbl_salarydet ON tbl_salarydet.salaryidz = payroll_mcore.salary.salaryidx
        WHERE MONTH(dateend)  = $month AND YEAR(dateend) = $year
    )as tbl_salary ON tbl_salary.nameidz = vlookup_mcore.vname.nameidxx
    WHERE bridz = $bridz
)as tbl_salaryall";
    $result = mysqli_query($db, $sqlcmd);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if ($count >= 1) {  
        return $row["amt"];
        
    }
    else
        
    {
        return 0;
    }
}

function expense_guard($db,$month,$year,$expensetype)
{
    $sqlcmd = "SELECT SUM(cr) as amt FROM
(
    SELECT chkno,vname,cr,chkdate2,chktsz,remarks,chkidxx,invidz,nameidz,MONTH(chktsz) as monthtsz,YEAR(chktsz) as yeartsz FROM
    (
        SELECT chkidxx,_invsup.invoicepayt.invidz,_invsup.invoicepayt.chkno,_invsup.invoicesoldto.nameidz,cr,_invsup.invoicepayt.tsz as chktsz,remarks,chkdate2 FROM _invsup.invoicepayt
        INNER JOIN _invsup.invoicesoldto ON _invsup.invoicesoldto.invidz = _invsup.invoicepayt.invidz
        INNER JOIN _invsup.invoicepayid ON _invsup.invoicepayid.invidz = _invsup.invoicepayt.invidz
        INNER JOIN _invsup.chkdate2 ON _invsup.chkdate2.chkidz = _invsup.invoicepayt.chkidxx
        WHERE MONTH(_invsup.invoicepayt.tsz) = $month AND YEAR(_invsup.invoicepayt.tsz) = $year AND dbcridz = 25
    )as tblpayt
    INNER JOIN
    (
        SELECT nameidxx,vname FROM vlookup_mcore.vnameexpense WHERE expenseidz = $expensetype
    )as tblexpense ON tblexpense.nameidxx = tblpayt.nameidz
)as expenseall";
    $result = mysqli_query($db, $sqlcmd);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if ($count >= 1) {  
        return $row["amt"];
        
    }
    else
        
    {
        return 0;
    }
}

function expense_gaspetty($db,$month,$year)
{
    $sqlcmd = "SELECT SUM(amt) as amt FROM
    (
        SELECT sprice * -1 as amt FROM sales_mbd.invdet WHERE itemidz = 54532716 AND formidz = 5 AND MONTH(tsz) = $month AND YEAR(tsz) = $year
    )as expenseall";
    $result = mysqli_query($db, $sqlcmd);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if ($count >= 1) {  
        return $row["amt"];
        
    }
    else
        
    {
        return 0;
    }
}

function expense_outsidepurchase($db,$month,$year)
{
    $sqlcmd = "SELECT SUM(amt) as amt FROM
    (
        SELECT sprice * -1 as amt FROM sales_mbd.invdet WHERE itemidz = 54532727 AND formidz = 5 AND MONTH(tsz) = $month AND YEAR(tsz) = $year
    )as expenseall";
    $result = mysqli_query($db, $sqlcmd);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if ($count >= 1) {  
        return $row["amt"];
        
    }
    else
        
    {
        return 0;
    }
}

function expense_petty($db,$month,$year,$stats)
{
    $sqlcmd = "SELECT abs(SUM(amt)) as amt FROM
    (
        SELECT sprice * qty as amt FROM sales_mbd.invdet
        INNER JOIN vlookup_mcore.vnamepettynew ON vlookup_mcore.vnamepettynew.itemidxx = sales_mbd.invdet.itemidz
        WHERE formidz = 5 AND MONTH(sales_mbd.invdet.tsz) = $month AND YEAR(sales_mbd.invdet.tsz) = $year AND pettyidz = $stats
    )as expenseall";
    $result = mysqli_query($db, $sqlcmd);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if ($count >= 1) {  
        return $row["amt"];
        
    }
    else
        
    {
        return 0;
    }
}

function expense_getbreakage($db,$month,$year,$type)
{
    $bridz = $GLOBALS['brnumb'];

    $brsql = getbrsql($bridz);
    
    if($type == 1)
    {
        $sqlcmd = "SELECT ROUND(SUM(amount),2) as breakageamt FROM
(
    SELECT item,qty,vbprice,qty * vbprice as  amount FROM
    (
        SELECT item,qty,itemidz FROM wrhse_mbd.breakagedet WHERE MONTH(wrhse_mbd.breakagedet.tsz) = $month AND YEAR(wrhse_mbd.breakagedet.tsz) = $year
    )as overbad
    INNER JOIN vproduct_mbd.vitem_$brsql ON vproduct_mbd.vitem_$brsql.itemidxx = overbad.itemidz
    INNER JOIN vproduct_mbd.vitem ON vproduct_mbd.vitem.itemidxx = overbad.itemidz
    INNER JOIN vproduct_mcore.category ON vproduct_mcore.category.catidxx = vproduct_mbd.vitem.suppidz
    WHERE npaydes <> 2
)as fbreakage";
    }
    else
    {
        $sqlcmd = "SELECT ROUND(SUM(amount),2) as breakageamt FROM
(
    SELECT item,qty,vbprice,qty * vbprice as  amount FROM
    (
        SELECT item,qty,itemidz FROM wrhse_mbd.breakagedet WHERE MONTH(wrhse_mbd.breakagedet.tsz) = $month AND DATE(wrhse_mbd.breakagedet.tsz) = $year
    )as overbad
    INNER JOIN vproduct_mbd.vitem_$brsql ON vproduct_mbd.vitem_$brsql.itemidxx = overbad.itemidz
    INNER JOIN vproduct_mbd.vitem ON vproduct_mbd.vitem.itemidxx = overbad.itemidz
    INNER JOIN vproduct_mcore.category ON vproduct_mcore.category.catidxx = vproduct_mbd.vitem.suppidz
    WHERE npaydes = 2
)as fbreakage";
    }
    $result = mysqli_query($db, $sqlcmd);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    $breakageamt = $row['breakageamt'];
    if ($count >= 1) {  
        return $breakageamt;
    } else {

        return 0;

    }
}

//SELLING AREA
function getsalesincsa($db,$sellingstk,$itemidz,$datestart)
{
    $sqlcmd = "SELECT itemidz,item,itemcode,IFNULL(SUM(salesqty),0) as salesqty,IFNULL(SUM(incomingqty),0) as incomingqty FROM
    (
        SELECT itemidz,item,itemcode,qty as salesqty,0 as incomingqty FROM sales_mbd.invdet WHERE itemidz = $itemidz AND tsz > '$datestart'
        UNION ALL
        SELECT itemidz,item,itemcode,refqty * -1 as salesqty,0 as incomingqty FROM sales_mbd.refund
        INNER JOIN sales_mbd.invdet ON sales_mbd.invdet.invdetidxx = sales_mbd.refund.invdetidz
        WHERE itemidz = $itemidz AND sales_mbd.refund.tsz > '$datestart'
        UNION ALL
        SELECT itemidz,item,itemcode,0 as saleqty,dispatchqty as incomingqty FROM dispatch_mbd.dispatchindet WHERE itemidz = $itemidz AND tsz > '$datestart'
    )as tbl_sales
    GROUP BY itemidz";
    $result = mysqli_query($db, $sqlcmd);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if ($count >= 1) {  
        //return number_format(($sellingstk + $row["incomingqty"]) - $row["salesqty"], 2, '.', ' ');
        return ($sellingstk + $row["incomingqty"]) - $row["salesqty"];
    } else {
        //return number_format($sellingstk, 2, '.', ' ');
        return $sellingstk;
    }
}

function getmaxseldate($db,$itemidz)
{
    $sqlcmd = "SELECT MIN(tsz) as seldate,now() as datenow FROM sellingarea_mbd.sellingareadet WHERE itemidz = $itemidz GROUP BY itemidz";
    $result = mysqli_query($db, $sqlcmd);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if ($count >= 1) {  
        return $row["seldate"];
    } else {
        return $row["datenow"];
    }
}


//SCAN AUDIT BO PICKUP
function getifpickupremarks($db,$forpidz)
{

    $sqlcmd = "SELECT * FROM scan_mbd_ho.jababopickupremarks WHERE pickupidxx = $forpidz";
    $result = mysqli_query($db, $sqlcmd);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    $remarks = mysqli_real_escape_string($db,$row['remarks']);
    if ($count >= 1) {  
        return $remarks;
    } else {

        return 0;
    }
}
//SI CHECKER
function getpaymentzank($db,$paymentid,$fld)
{
    $sqlcmd = "SELECT $fld as returnFld FROM sales_mbd.codarpaymentdet
INNER JOIN
(
    SELECT GROUP_CONCAT(dbcr separator '-') AS dbcr,invidz FROM sales_mbd.payt WHERE credit > 0 GROUP BY invidz
)as paytpayt ON paytpayt.invidz = sales_mbd.codarpaymentdet.codarinvidxx
WHERE soapayidz = $paymentid";
    $result = mysqli_query($db, $sqlcmd);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if ($count >= 1) {  
        return $row["returnFld"];
    } else {

        return 0;
    }
}

//GETCASHIERNAME
function getcashiernamepo($db,$nameidz)
{
    $sqlcmd = "SELECT vname FROM vlookup_mcore.vname WHERE nameidxx = $nameidz";
    $result = mysqli_query($db, $sqlcmd);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if ($count >= 1) {  
        return $row["vname"];
    } else {

        return "N/A";
    }
}

//JABA TRANSCOUNT
function getjabatranscount($db,$start,$end)
{

    $sqlcmd = "SELECT COUNT(*) as cnttrans FROM
(
    SELECT * FROM
    (
        SELECT qty,invidz FROM sales_mbd.invdet
        INNER JOIN sales_mbd.inv ON sales_mbd.inv.invidxx = sales_mbd.invdet.invidz
        INNER JOIN jaba_mbd.jabaitemdet ON jaba_mbd.jabaitemdet.itemidxx = sales_mbd.invdet.itemidz
        WHERE DATE(sales_mbd.invdet.tsz) >= '$start' AND DATE(sales_mbd.invdet.tsz) <= '$end' AND formidz IN (1,4) AND itemidz <> 54593422 AND sales_mbd.inv.nameidz NOT IN (1806,38273903,123,343,344,395,992,1112,1837,2459,2585,2639,2669,3241,3777,3787)
        UNION ALL
        SELECT qty,invidz FROM sales_mbd.invdet
        INNER JOIN sales_mbd.inv ON sales_mbd.inv.invidxx = sales_mbd.invdet.invidz
        INNER JOIN vproduct_mbd.vitem ON vproduct_mbd.vitem.itemidxx = sales_mbd.invdet.itemidz
        INNER JOIN vproduct_mcore.category ON vproduct_mcore.category.catidxx  =  vproduct_mbd.vitem.suppidz
        INNER JOIN vproduct_mcore.category_type ON vproduct_mcore.category_type.catidxx  =  vproduct_mcore.category.catidxx
        WHERE DATE(sales_mbd.invdet.tsz) >= '$start' AND DATE(sales_mbd.invdet.tsz) <= '$end' AND typeidz IN (1,3) AND formidz IN (1,4) AND itemidz <> 54593422 AND sales_mbd.inv.nameidz NOT IN (1806,38273903,123,343,344,395,992,1112,1837,2459,2585,2639,2669,3241,3777,3787)
    )as tbl_l
    GROUP BY invidz
)as tbl_2";
    $result = mysqli_query($db, $sqlcmd);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    return $row["cnttrans"];
}

//MBD TRANSCOUNT
function getmbdtranscount($db,$start,$end)
{

    $sqlcmd = "SELECT COUNT(*) as cnttrans FROM
(
    SELECT * FROM
    (
        SELECT qty,invidz FROM sales_mbd.invdet
        INNER JOIN sales_mbd.inv ON sales_mbd.inv.invidxx = sales_mbd.invdet.invidz
        INNER JOIN vproduct_mbd.vitem ON vproduct_mbd.vitem.itemidxx = sales_mbd.invdet.itemidz
        INNER JOIN vproduct_mcore.category ON vproduct_mcore.category.catidxx = vproduct_mbd.vitem.suppidz
        INNER JOIN vproduct_mcore.category_type ON vproduct_mcore.category_type.catidxx = vproduct_mbd.vitem.suppidz
        WHERE DATE(sales_mbd.invdet.tsz) >= '$start' AND DATE(sales_mbd.invdet.tsz) <= '$end' AND typeidz NOT IN (1,3) AND formidz IN (1,4) AND itemidz <> 54593422 AND sales_mbd.inv.nameidz NOT IN (1806,38273903,123,343,344,395,992,1112,1837,2459,2585,2639,2669,3241,3777,3787)
    )as tbl_l
    GROUP BY invidz
)as tbl_2";
    $result = mysqli_query($db, $sqlcmd);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    return $row["cnttrans"];
}
//MECHANDISER GRADE
function getdisercount($db,$month,$year)
{

    $sqlcmd = "SELECT COUNT(*) as cntdiser FROM report_mbd.dizercount WHERE month = $month AND year = $year;";
    $result = mysqli_query($db, $sqlcmd);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if ($count >= 1) {  
        return $row["cntdiser"];
    } else {
        return 0;
    }
}

function getsalesquota($db,$month,$year,$bridz)
{
    $monthname = "";
    if($month == 1)
    {
        $monthname = "janquota";
    }
    else if($month == 2)
    {
        $monthname = "febquota";
    }
    else if($month == 3)
    {
        $monthname = "marchquota";
    }
    else if($month == 4)
    {
        $monthname = "aprilquota";
    }
    else if($month == 5)
    {
        $monthname = "mayquota";
    }
    else if($month == 6)
    {
        $monthname = "junequota";
    }
    else if($month == 7)
    {
        $monthname = "julyquota";
    }
    else if($month == 8)
    {
        $monthname = "augquota";
    }
    else if($month == 9)
    {
        $monthname = "augquota";
    }
    else if($month == 10)
    {
        $monthname = "octquota";
    }
    else if($month == 11)
    {
        $monthname = "novquota";
    }
    else if($month == 12)
    {
        $monthname = "decquota";
    }
    $sqlcmd = "SELECT $monthname as fld FROM vlookup_mcore.vbrquota WHERE bridz = $bridz AND year = $year";
    $result = mysqli_query($db, $sqlcmd);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if ($count >= 1) {  
        return $row["fld"];
    } else {
        return 0;
    }
}

//MBD TRANSCOUNT NEW
function getmbdtranscountnew($db,$year,$month)
{

    $sqlcmd = "SELECT COUNT(*) as cntFld FROM
    (
        SELECT * FROM
        (
            SELECT qty,invidz,YEAR(sales_mbd.invdet.tsz) as yeartsz,MONTH(sales_mbd.invdet.tsz) as monthtsz,DATE(sales_mbd.invdet.tsz) as dateval FROM sales_mbd.invdet
            INNER JOIN sales_mbd.inv ON sales_mbd.inv.invidxx = sales_mbd.invdet.invidz
            INNER JOIN vproduct_mbd.vitem ON vproduct_mbd.vitem.itemidxx = sales_mbd.invdet.itemidz
            INNER JOIN vproduct_mcore.category ON vproduct_mcore.category.catidxx = vproduct_mbd.vitem.suppidz
            INNER JOIN vproduct_mcore.category_type ON vproduct_mcore.category_type.catidxx = vproduct_mbd.vitem.suppidz
            WHERE YEAR(sales_mbd.invdet.tsz) = $year AND MONTH(sales_mbd.invdet.tsz) = $month AND typeidz NOT IN (1,3) AND formidz IN (1,4) AND itemidz <> 54593422
            AND sales_mbd.inv.nameidz NOT IN (1806,38273903,123,343,344,395,992,1112,1837,2459,2585,2639,2669,3241,3777,3787)
        )as tbl_l
        GROUP BY dateval,invidz
    )as tbl_2";
    $result = mysqli_query($db, $sqlcmd);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    return $row["cntFld"];
}

//JABA TRANSCOUNT NEW
function getjabatranscountnew($db,$year,$month)
{

    $sqlcmd = "SELECT COUNT(*) as cnttrans FROM
(
    SELECT * FROM
    (
        SELECT qty,invidz,DATE(sales_mbd.invdet.tsz) as dateval FROM sales_mbd.invdet
        INNER JOIN sales_mbd.inv ON sales_mbd.inv.invidxx = sales_mbd.invdet.invidz
        INNER JOIN jaba_mbd.jabaitemdet ON jaba_mbd.jabaitemdet.itemidxx = sales_mbd.invdet.itemidz
        WHERE YEAR(sales_mbd.invdet.tsz) = $year AND MONTH(sales_mbd.invdet.tsz) = $month AND formidz IN (1,4) AND itemidz <> 54593422 AND sales_mbd.inv.nameidz NOT IN (1806,38273903,123,343,344,395,992,1112,1837,2459,2585,2639,2669,3241,3777,3787)
        UNION ALL
        SELECT qty,invidz,DATE(sales_mbd.invdet.tsz) as dateval FROM sales_mbd.invdet
        INNER JOIN sales_mbd.inv ON sales_mbd.inv.invidxx = sales_mbd.invdet.invidz
        INNER JOIN vproduct_mbd.vitem ON vproduct_mbd.vitem.itemidxx = sales_mbd.invdet.itemidz
        INNER JOIN vproduct_mcore.category ON vproduct_mcore.category.catidxx  =  vproduct_mbd.vitem.suppidz
        INNER JOIN vproduct_mcore.category_type ON vproduct_mcore.category_type.catidxx  =  vproduct_mcore.category.catidxx
        WHERE YEAR(sales_mbd.invdet.tsz) = $year AND MONTH(sales_mbd.invdet.tsz) = $month AND typeidz IN (1,3) AND formidz IN (1,4) AND itemidz <> 54593422 AND sales_mbd.inv.nameidz NOT IN (1806,38273903,123,343,344,395,992,1112,1837,2459,2585,2639,2669,3241,3777,3787)
    )as tbl_l
    GROUP BY dateval,invidz
)as tbl_2";
    $result = mysqli_query($db, $sqlcmd);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    return $row["cnttrans"];
}

function clean($string)
{
    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

    $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

    $string = str_replace('-', ' ', $string);
    return $string;
}
//HISTORY

function getdispatchqty($db,$hodetidxx)
{
    $sql = "SELECT SUM(dispatchqty) as dispatchqty FROM
    (
        SELECT IF(ISNULL(SUM(dispatchqty)),0,SUM(dispatchqty)) as dispatchqty FROM dispatch_mbd.dispatchindet WHERE hopodetidz = CONCAT(SUBSTRING_INDEX($hodetidxx,'.',1),'.',SUBSTRING(SUBSTRING_INDEX($hodetidxx,'.',-1),4,3)) GROUP BY hopodetidz
    )as fnalall";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if ($count >=1) {
        $dspchqty = $row["dispatchqty"];
        return $dspchqty;
    } else {

        return 0;
    }
}
    
function getdispatchidz($db,$hodetidxx,$fld)
{
    $sql = "
        SELECT GROUP_CONCAT($fld ORDER BY tsz ASC SEPARATOR '-') as unqfld FROM dispatch_mbd.dispatchindet WHERE hopodetidz = CONCAT(SUBSTRING_INDEX($hodetidxx,'.',1),'.',SUBSTRING(SUBSTRING_INDEX($hodetidxx,'.',-1),4,3)) GROUP BY hopodetidz";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if ($count >=1) {
        return $row["unqfld"];
    } else {

        return 0;
    }
}

function checkuploadedno($db, $datequery, $dbcrid)
{
    $sql = "";
    if ($dbcrid == 1) {
        $sql = "SELECT COUNT(paytidxx) as cntfld FROM
                (
                    SELECT REPLACE(DATE(sales_mbd.payt.tsz),'-','') + (sales_mbd.payt.cashieridz/1000) as paytidxx FROM sales_mbd.payt
                    INNER JOIN vlookup_mcore.vname ON vlookup_mcore.vname.nameidxx =  sales_mbd.payt.cashieridz WHERE DATE( sales_mbd.payt.tsz) = '$datequery'
                    GROUP BY  sales_mbd.payt.cashieridz,DATE( sales_mbd.payt.tsz)
                )as tbl_cash
                INNER JOIN scan_mbd.forpicscancashier ON scan_mbd.forpicscancashier.forpicidz = tbl_cash.paytidxx";
    } else if ($dbcrid == 2) {
        $sql = "SELECT COUNT(paytidxx) as cntfld FROM
                (
                    SELECT paytidxx FROM sales_mbd.payt WHERE dbcridz = 2 AND DATE(sales_mbd.payt.tsz) = '$datequery'
                    UNION ALL
                    SELECT invpaytidxx as paytidxx FROM soa_mbd.soapaypayt WHERE dbcridz = 2 AND DATE(soa_mbd.soapaypayt.tsz) = '$datequery' 
                    UNION ALL
                    SELECT prpaytidxx as paytidxx FROM provi_mbd.provipayt WHERE dbcridz = 2  AND DATE(provi_mbd.provipayt.tsz) = '$datequery'
                )as tbl_cheq
                INNER JOIN scan_mbd.forpicscancashier ON scan_mbd.forpicscancashier.forpicidz = tbl_cheq.paytidxx";
    } else if ($dbcrid == 3) {
        $sql = "SELECT COUNT(paytidxx) as cntfld FROM
                (
                    SELECT paytidxx FROM sales_mbd.payt
                    WHERE dbcridz = 3 AND DATE(sales_mbd.payt.tsz) = '$datequery'
                    UNION
                    SELECT invpaytidxx as paytidxx FROM soa_mbd.soapaypayt
                    WHERE dbcridz = 3 AND DATE(soa_mbd.soapaypayt.tsz) = '$datequery'
                    UNION
                    SELECT prpaytidxx as paytidxx FROM provi_mbd.provipayt
                    WHERE dbcridz = 3 AND DATE(provi_mbd.provipayt.tsz) = '$datequery'
                )as tbl_credt
                INNER JOIN scan_mbd.forpicscancashier ON scan_mbd.forpicscancashier.forpicidz = tbl_credt.paytidxx";
    } else if ($dbcrid == 4) {
        $sql = "SELECT COUNT(paytidxx) as cntfld FROM
                (
                    SELECT paytidxx FROM sales_mbd.payt
                    WHERE dbcridz = 4 AND DATE(sales_mbd.payt.tsz) = '$datequery'
                )as tbl_cod
                INNER JOIN scan_mbd.forpicscancashier ON scan_mbd.forpicscancashier.forpicidz = tbl_cod.paytidxx";
    } else if ($dbcrid == 5) {
        $sql = "SELECT COUNT(paytidxx) as cntfld FROM
                    (
                        SELECT (paytidxx+.01) as paytidxx
                        FROM sales_mbd.payt where dbcridz=5 and 
                        DATE(sales_mbd.payt.tsz) = '$datequery'
                        and credit>0 and formidz = 1
                    )as tbl_acctrec
                INNER JOIN scan_mbd.forpicscancashier ON scan_mbd.forpicscancashier.forpicidz = tbl_acctrec.paytidxx";
    } else if ($dbcrid == 34) {
        $sql = "SELECT COUNT(paytidxx) as cntfld FROM
                (
                    SELECT  paytidxx FROM sales_mbd.payt
                    WHERE dbcridz = 34 AND DATE(sales_mbd.payt.tsz) = '$datequery'
                    UNION
                    SELECT invpaytidxx as paytidxx FROM soa_mbd.soapaypayt
                    WHERE dbcridz = 34 AND DATE(soa_mbd.soapaypayt.tsz) = '$datequery'
                    UNION
                    SELECT prpaytidxx as paytidxx FROM provi_mbd.provipayt
                    WHERE dbcridz = 34 AND DATE(provi_mbd.provipayt.tsz) = '$datequery'
                )as tbl_bnktrns
                INNER JOIN scan_mbd.forpicscancashier ON scan_mbd.forpicscancashier.forpicidz = tbl_bnktrns.paytidxx";
    } else if ($dbcrid == 125) {
        $sql = "SELECT COUNT(paytidxx) as cntfld FROM
                (
                    SELECT  paytidxx FROM sales_mbd.payt
                    LEFT OUTER JOIN sales_mbd.used_coupon ON sales_mbd.used_coupon.transid = sales_mbd.payt.invidz
                    WHERE dbcridz = 125 AND credit >0 AND DATE(sales_mbd.payt.tsz) = '$datequery'
                    UNION
                    SELECT paytidxx FROM sales_mbd.payt
                    WHERE dbcridz = 125 AND credit <0 AND DATE(sales_mbd.payt.tsz) = '$datequery'
                )as tbl_coupon
                INNER JOIN scan_mbd.forpicscancashier ON scan_mbd.forpicscancashier.forpicidz = tbl_coupon.paytidxx";
    } else {
        return "NONE";
    }
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if ($row["cntfld"] >= 1) {
        return "" . $row["cntfld"] . "(s)";
    } else {

        return "None";
    }
}

function checkuploadcardtrans($db, $datequery, $dbcrid, $paytidxx)
{
    $sql = "";
    if ($dbcrid == 3) {
        $sql = "SELECT COUNT(paytidxx) as cntfld FROM
                (
                    SELECT paytidxx FROM sales_mbd.payt
                    WHERE dbcridz = 3 AND DATE(sales_mbd.payt.tsz) = '$datequery' AND paytidxx = '$paytidxx'
                    UNION
                    SELECT invpaytidxx as paytidxx FROM soa_mbd.soapaypayt
                    WHERE dbcridz = 3 AND DATE(soa_mbd.soapaypayt.tsz) = '$datequery' AND invpaytidxx = '$paytidxx'
                    UNION
                    SELECT prpaytidxx as paytidxx FROM provi_mbd.provipayt
                    WHERE dbcridz = 3 AND DATE(provi_mbd.provipayt.tsz) = '$datequery' AND prpaytidxx = '$paytidxx'
                )as tbl_credt
                INNER JOIN scan_mbd.forpicscancashier ON scan_mbd.forpicscancashier.forpicidz = tbl_credt.paytidxx";
    } else if ($dbcrid == 34) {
        $sql = "SELECT COUNT(paytidxx) as cntfld FROM
                (
                    SELECT  paytidxx FROM sales_mbd.payt
                    WHERE dbcridz = 34 AND DATE(sales_mbd.payt.tsz) = '$datequery' AND paytidxx = '$paytidxx'
                    UNION
                    SELECT invpaytidxx as paytidxx FROM soa_mbd.soapaypayt
                    WHERE dbcridz = 34 AND DATE(soa_mbd.soapaypayt.tsz) = '$datequery' AND invpaytidxx = '$paytidxx'
                    UNION
                    SELECT prpaytidxx as paytidxx FROM provi_mbd.provipayt
                    WHERE dbcridz = 34 AND DATE(provi_mbd.provipayt.tsz) = '$datequery' AND prpaytidxx = '$paytidxx'
                )as tbl_bnktrns
                INNER JOIN scan_mbd.forpicscancashier ON scan_mbd.forpicscancashier.forpicidz = tbl_bnktrns.paytidxx";
    } else {
        return "NONE";
    }
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if ($row["cntfld"] >= 1) {
        return "" . $row["cntfld"] . "(s)";
    } else {

        return "None";
    }
}
//GET SHORT TERM LIMIT
function getstlimit($db)
{

    $sqlcmd = "SELECT * FROM sales_mbd.shorttermlimit";
    $result = mysqli_query($db, $sqlcmd);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if ($count >= 1) {  
        return $row["stlimitamount"];
    } else {
        return 0;
    }
}

function getstbalance($db)
{

    $sqlcmd = "SELECT SUM(stlimitamount) as availablebalance FROM
    (
        SELECT stlimitamount FROM sales_mbd.shorttermlimit
        UNION ALL
        SELECT credit * -1 as stlimitamount FROM sales_mbd.payt WHERE dbcridz = 137 AND paidba = 0
    )as tbl_tbl";
    $result = mysqli_query($db, $sqlcmd);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if ($count >= 1) {  
        return $row["availablebalance"];
    } else {
        return 0;
    }
}

//JABA AGING
function getsalestotalbybarcode($db,$itemcode)
{
    $sqlcmd = "SELECT SUM(salesqty) as salesqty FROM
(
    SELECT IF(ISNULL(SUM(salesqty)),0.00,SUM(salesqty)) as salesqty FROM
    (
        SELECT qty - IFNULL(refqty,0) as salesqty FROM sales_mbd.invdet
        LEFT OUTER JOIN
        (
            SELECT SUM(refqty) as refqty,invdetidz FROM sales_mbd.refund GROUP BY invdetidz
        )as tblnew_refund ON tblnew_refund.invdetidz = sales_mbd.invdet.invdetidxx
        WHERE itemcode = '$itemcode'
    )as salesall
)as sales_all";
    $resultx = mysqli_query($db, $sqlcmd);
    $rowx = mysqli_fetch_array($resultx, MYSQLI_ASSOC);
    $count = mysqli_num_rows($resultx);
    if ($count >= 1) {  
        return $rowx["salesqty"];
    }
    return 0;
}

function getinctotalbybarcode($db,$itemcode)
{
    $sqlcmd = "
    SELECT IF(ISNULL(SUM(dispatchqty)),0.00,SUM(dispatchqty)) as dispatchqty FROM
    (
        SELECT dispatchqty FROM dispatch_mbd.dispatchindet WHERE itemcode = '$itemcode'
    )as salesall";
    $resultx = mysqli_query($db, $sqlcmd);
    $rowx = mysqli_fetch_array($resultx, MYSQLI_ASSOC);
    $count = mysqli_num_rows($resultx);
    if ($count >= 1) {  
        return $rowx["dispatchqty"];
    }
    return 0;
}

function getjabacounter($db,$hopoidz)
{
    $sqlcmd = "SELECT GROUP_CONCAT(ctridzz ORDER BY ctridzz SEPARATOR ',') as ctridzz FROM counter_mcore.counterdet WHERE hopoidzz = $hopoidz";
    $resultx = mysqli_query($db, $sqlcmd);
    $rowx = mysqli_fetch_array($resultx, MYSQLI_ASSOC);
    $count = mysqli_num_rows($resultx);
    if ($count >= 1) {  
        return $rowx["ctridzz"];
    }
    return 0;
}

function getjabaadv($db,$hopoidz)
{
    $sqlcmd = "SELECT * FROM forchqs_mcore.invpaybal WHERE invidzz = $hopoidz";
    $resultx = mysqli_query($db, $sqlcmd);
    $rowx = mysqli_fetch_array($resultx, MYSQLI_ASSOC);
    $count = mysqli_num_rows($resultx);
    if ($count >= 1) {  
        return 1;
    }
    return 0;
}

function getjabaadvchequenumber($db,$hopoidz)
{
    $sqlcmd = "SELECT GROUP_CONCAT(chkno SEPARATOR ',') as chkno FROM forchqs_mcore.invpaybal
INNER JOIN forchqs_mcore.payt ON forchqs_mcore.payt.invidz = forchqs_mcore.invpaybal.invidz AND dbcridz = 2
WHERE invidzz = $hopoidz";
    $resultx = mysqli_query($db, $sqlcmd);
    $rowx = mysqli_fetch_array($resultx, MYSQLI_ASSOC);
    $count = mysqli_num_rows($resultx);
    if ($count >= 1) {  
        return $rowx["chkno"];
    }
    return 0;
}

function getchequenumber($db,$hopoidz)
{
    $sqlcmd = "SELECT GROUP_CONCAT(chkno SEPARATOR ',') as chkno FROM
(
    SELECT ctridzz,invidz FROM counter_mcore.counterdet
    INNER JOIN forchqs_mcore.invpaybal ON forchqs_mcore.invpaybal.counteridz = counter_mcore.counterdet.ctridzz
    WHERE hopoidzz = $hopoidz
    GROUP BY invidz
)as tbl_counter
INNER JOIN forchqs_mcore.payt ON forchqs_mcore.payt.invidz = tbl_counter.invidz AND dbcridz = 2";
    $resultx = mysqli_query($db, $sqlcmd);
    $rowx = mysqli_fetch_array($resultx, MYSQLI_ASSOC);
    $count = mysqli_num_rows($resultx);
    if ($count >= 1) {  
        return $rowx["chkno"];
    }
    return '-';
}
//HOPO MONITORING
function gettotaldispatch($db,$hopoidz)
{
    $sqlcmd = "SELECT SUM(dispatchqty) as totalqty FROM dispatch_mbd.dispatchindet WHERE hopoidzz = $hopoidz";
    $resultx = mysqli_query($db, $sqlcmd);
    $rowx = mysqli_fetch_array($resultx, MYSQLI_ASSOC);
    $count = mysqli_num_rows($resultx);
    if ($count >= 1) {  
        return $rowx["totalqty"];
    }
    return 0;
}

function gettotalolddispatch($db,$hopoidzz)
{
    $sqlcmd = "SELECT GROUP_CONCAT(hodetidxx SEPARATOR ',') as hopodetid FROM hopo_mcore.hopodet WHERE hopoidzz = $hopoidzz GROUP BY hopoidzz";
    $resultx = mysqli_query($db, $sqlcmd);
    $rowx = mysqli_fetch_array($resultx, MYSQLI_ASSOC);
    $count = mysqli_num_rows($resultx);
    if ($count >= 1) {  
        $hopodetid = $rowx["hopodetid"];
        $sql2 = "SELECT SUM(dspchqty) as dspchqty FROM dispatch_mcore.dspchindet 
        INNER JOIN dispatch_mcore.dspchindetedit ON dispatch_mcore.dspchindetedit.dpcdetidzz = dispatch_mcore.dspchindet.dpcdetidxx
        WHERE hopodetidz IN ($hopodetid)";
        $result2 = mysqli_query($db, $sql2);
        $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
        $count = mysqli_num_rows($result2);
        if ($count >= 1) {  
            return $row2["dspchqty"];
        }
        return 0;
        
    }
    return 0;
}

?>

