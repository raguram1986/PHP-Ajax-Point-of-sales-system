<?php
/**
 * Created by PhpStorm.
 * User: Virtualmist
 * Date: 9/24/2017
 * Time: 6:30 PM
 */

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "upos";

//$servername = "innovationlk.ipagemysql.com";
//$username = "cta_db";
//$password = "zM;(~dR6qy>fnN3}";
//$dbname = "cta_db";


// Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);







    $stmt = $conn->prepare("SELECT id,brand_name,status FROM brand  where id=?;");


    $project_id = $_POST["project_id"];
    $stmt->bind_param("s", $project_id);


    $stmt->bind_result($id,$brand_name,$status);

    if ($stmt->execute()) {
        while ($stmt->fetch()) {
            $output = array ("id"=>$id,"brand_name"=>$brand_name,"status"=>$status);
        }
        echo json_encode($output);
    }
    $stmt->close();

}