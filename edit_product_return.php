<?php
/**
 * Created by PhpStorm.
 * User: Virtualmist
 * Date: 9/24/2017
 * Time: 6:30 PM
 */

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    include('db.php');
// Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    $stmt = $conn->prepare("SELECT id,p_name,p_description,cat_id,brand_id,warranty,cost_price,retail_price,qty,reorderlevel,barcode,add_date,status FROM product where id=?;");


    $project_id = $_POST["project_id"];
    $stmt->bind_param("s", $project_id);


    $stmt->bind_result($id,$p_name,$p_description,$cat_id,$brand_id,$warranty,$cost_price,$retail_price,$qty,$reorderlevel,$barcode,$add_date,$status);

    if ($stmt->execute()) {
        while ($stmt->fetch()) {
            $output = array ("id"=>$id,"p_name"=>$p_name,"p_description"=>$p_description,"cat_id"=>$cat_id,"brand_id"=>$brand_id,"warranty"=>$warranty,"cost_price"=>$cost_price,
                "retail_price"=>$retail_price,"reorderlevel"=>$reorderlevel,"barcode"=>$barcode,"add_date"=>$add_date,"status"=>$status);
        }
        echo json_encode($output);
    }
    $stmt->close();

}