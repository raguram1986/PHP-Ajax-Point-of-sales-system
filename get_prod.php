<?php
/**
 * Created by PhpStorm.
 * User: Virtualmist
 * Date: 10/4/2017
 * Time: 8:37 PM
 */

include("db.php");


$stmt = $conn->prepare("select id,p_name,p_description,cat_id,brand_id,warranty,cost_price,retail_price,reorderlevel,barcode,add_date,status from product where barcode= ? ");

/*
$stmt = $conn->prepare("select  product_id,product_name,barcode,category,description,warrenty,product_condition,price_retail,
                   price_cost,discount,reorderlevel,brand
     from product  where product_id = ?");
*/
$barcode= $_POST["barcode"];
$stmt->bind_param("s", $barcode);
$stmt->bind_result($id,$p_name,$p_description,$cat_id,$brand_id,$warranty,$cost_price,$retail_price,$reorderlevel,$barcode,$add_date,$status);

if ($stmt->execute()) {
    while ( $stmt->fetch() ) {
        $output[] = array ("id"=>$id, "p_name"=>$p_name,"p_description"=>$p_description,"cat_id"=>$cat_id,"brand_id"=>$brand_id,"warranty"=>$warranty,"cost_price"=>$cost_price,"retail_price"=>$retail_price,"reorderlevel"=>$reorderlevel,"barcode"=>$barcode,"add_date"=>$add_date, "status"=>$status );
    }
    echo json_encode($output);
}
$stmt->close();



?>



