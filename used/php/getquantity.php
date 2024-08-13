<?php
include "../../phpconfig/allfunction.php";

$item_id = $_POST['item_id'];

$sql = "SELECT (itemqty-IFNULL(usedqty,0)) as remainingqty FROM ho_use_mcore.ho_requests
            LEFT OUTER JOIN ho_use_mcore.ho_used used ON used.reqidzz = ho_use_mcore.ho_requests.reqidxx
            LEFT OUTER JOIN ho_use_mcore.ho_approval approval ON approval.reqidz = ho_use_mcore.ho_requests.reqidxx
            WHERE status = 1 AND reqidxx = $item_id";
$result = mysqli_query($db, $sql);

while ($row = mysqli_fetch_array($result)) {
    echo $row["remainingqty"];
}