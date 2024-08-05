<?php
/**
 * Created by PhpStorm.
 * User: Virtualmist
 * Date: 10/4/2017
 * Time: 8:37 PM
 */

include("db.php");


$stmt = $conn->prepare("select p.id,p.p_name,p.p_description,c.catname,b.brand_name,p.warranty,p.cost_price,p.retail_price,d.discount_type,d.cal_amount,p.reorderlevel,p.barcode,p.add_date,p.status,p.qty from product p join brand b on p.brand_id = b.id join category c on p.cat_id = c.id join discount d on p.barcode = d.barcode_id and p.status ='1' where p.barcode = ? ");

/*
$stmt = $conn->prepare("select  product_id,product_name,barcode,category,description,warrenty,product_condition,price_retail,
                   price_cost,discount,reorderlevel,brand
     from product  where product_id = ?");
*/
$barcode= $_POST["barcode"];
$stmt->bind_param("s", $barcode);
$stmt->bind_result($id,$p_name,$p_description,$catname,$brand_name,$warranty,$cost_price,$retail_price,$discount_type,$cal_amount,$reorderlevel,$barcode,$add_date,$status,$qty);

if ($stmt->execute()) {
    while ( $stmt->fetch() ) {
        $output[] = array ("id"=>$id, "p_name"=>$p_name,"p_description"=>$p_description,"catname"=>$catname,"brand_name"=>$brand_name,"warranty"=>$warranty,"cost_price"=>$cost_price,"retail_price"=>$retail_price,"discount_type"=>$discount_type,"cal_amount"=>$cal_amount,"reorderlevel"=>$reorderlevel,"barcode"=>$barcode,"add_date"=>$add_date, "status"=>$status,"qty"=>$qty  );
    }
    echo json_encode($output);
}
$stmt->close();



?>



