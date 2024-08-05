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

    $stmt = $conn->prepare("SELECT id,catname,status FROM category  where id=?;");


    $project_id = $_POST["project_id"];
    $stmt->bind_param("s", $project_id);


    $stmt->bind_result($id,$catname,$status);

    if ($stmt->execute()) {
        while ($stmt->fetch()) {
            $output = array ("id"=>$id,"catname"=>$catname);
        }
        echo json_encode($output);
    }
    $stmt->close();

}