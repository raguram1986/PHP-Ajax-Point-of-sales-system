<?php

include("db.php");


$stmt = $conn->prepare("select id,vname,contactno,email,address,status from vendor where status = '1'  order by id DESC ");
$stmt->bind_result($id,$vname,$contactno,$email,$address,$status);

if ($stmt->execute()) {
    while ( $stmt->fetch() ) {
        $output[] = array ("id"=>$id, "vname"=> $vname,"contactno"=>$contactno, "email"=> $email,"address"=>$address, "status"=>$status);
    }
    echo json_encode( $output );
}
$stmt->close();

//}