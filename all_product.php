<?php
include("db.php");

$stmt = $conn->prepare("select p.id,p.p_name,p.p_description,c.catname,b.brand_name,p.warranty,p.cost_price,p.retail_price,d.discount_type,d.amount,p.reorderlevel,p.barcode,p.add_date,p.status,p.qty from product p, brand b, category c,discount d where p.brand_id = b.id and p.cat_id = c.id and p.barcode = d.barcode_id ");

$stmt->bind_result($id,$p_name,$p_description,$catname,$brand_name,$warranty,$cost_price,$retail_price,$discount_type,$amount,$reorderlevel,$barcode,$add_date,$status,$qty);




if ($stmt->execute()) {
    while ( $stmt->fetch() ) {
        $output[] = array ("id"=>$id, "p_name"=>$p_name,"p_description"=>$p_description,"catname"=>$catname,"brand_name"=>$brand_name,"warranty"=>$warranty,"cost_price"=>$cost_price,"retail_price"=>$retail_price,"discount_type"=>$discount_type,"amount"=>$amount,"reorderlevel"=>$reorderlevel,"barcode"=>$barcode,"add_date"=>$add_date, "status"=>$status,"qty"=>$qty );
    }

    echo json_encode( $output );
}
$stmt->close();

//}