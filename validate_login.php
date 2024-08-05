<?php
/**
 * Created by PhpStorm.
 * User: virtualmist
 * Date: 6/1/16
 * Time: 11:33 AM
 */

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start();

    include("db.php");
    $uname=$_POST['username'];
    $password=md5($_POST['password']);


    $id;
    $cname;
    $stmt = $conn->prepare("SELECT id,name FROM users WHERE user_name=? and password=?");
    $stmt->bind_param("ss", $uname,$password);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id,$name);
    $stmt->fetch();
    if ($stmt->num_rows == 1) {

        if ($stat==0){//invert of this
            echo 0;//email not verified
        }
        else{//email verified


            $_SESSION["isLogin"]=true;

            $_SESSION["userID"]=$id;
            $_SESSION["user_name"]=$name;
            echo 1;
        }

    }

    else {
        echo 3;//use pass incorrect
    }

    $stmt->close();


}

?>