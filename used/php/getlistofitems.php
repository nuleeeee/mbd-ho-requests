<?php
include "../../phpconfig/allfunction.php";

$sql = optionlst($db, "SELECT reqidxx, itemname FROM ho_use_mcore.ho_requests
            LEFT OUTER JOIN ho_use_mcore.ho_used used ON used.reqidzz = ho_use_mcore.ho_requests.reqidxx
            LEFT OUTER JOIN ho_use_mcore.ho_approval approval ON approval.reqidz = ho_use_mcore.ho_requests.reqidxx
            WHERE (itemqty-IFNULL(usedqty,0)) > 0 AND status = 1
            ORDER BY approval.tsz DESC", "itemname", "reqidxx");

echo $sql;