<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "upos";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $last_insert_id = $_GET['last_id'];
    $sql = "select i.pur_id,i.prod_id,i.buyprice,i.qty,i.total,p.date,p.total,p.pay,p.due,pr.p_name from purchase_item i, purs p,product pr where i.pur_id = p.id and   i.prod_id = pr.barcode and  i.pur_id =  $last_insert_id ";


    $orderResult = $conn->query($sql);
    $orderData = $orderResult->fetch_array();
    $pur_id = $orderData[0];
    $prod_id = $orderData[1];
    $buyprice = $orderData[2];
    $qty = $orderData[3];
    $total = $orderData[4];
    $date = $orderData[5];
    $sub = $orderData[6];
    $pay = $orderData[7];
    $due = $orderData[8];

    ?>

<html>
<head>
    <title></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">


    <style>
        @media print
        {
            .button
            {
                display: none;
            }
        }

        @media print
        {
            @page {
                margin-top: 0;
                margin-bottom: 0;
            }
            body  {
                padding-top: 72px;
                padding-bottom: 72px ;
            }
        }




    </style>






    <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <!-- Theme style -->

    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->

    <link rel="stylesheet" href="bower_components/jquery-confirm-master/dist/jquery-confirm.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css"/>

    <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.css">
    <link type="text/css" rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">



</head>
<body style='background: #f9f9f9'>

<script>
    n =  new Date();
    y = n.getFullYear();
    m = n.getMonth() + 1;
    d = n.getDate();
    document.getElementById("date").innerHTML = m + "/" + d + "/" + y;





</script>










<div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class='print' style="border: 1px solid #a1a1a1; width: 88mm; background: white; padding: 10px; margin: 0 auto; text-align: center; ">


                    <div class="invoice-title" align="center">

                       <b>PURCHASE INVOICE</b><h2>Tutus Funny</h2>
                    </div>

                    <div class="invoice-title" align="left">
                       Order #  &nbsp; &nbsp;<b> <?php echo $last_insert_id; ?>
                    </div>
                    <div class="invoice-title" align="left">
                        Date #  &nbsp; <b> <?php echo $date; ?></b>
                    </div>


                    </br>
                    </br>

                    <div>
                        <div>

                            <table class="table table-condensed">
                                <thead>
                                <tr>
                                    <td class="text-center"><strong>No</strong></td>
                                    <td class="text-center"><strong>Pname</strong></td>
                                    <td class="text-center"><strong>Qty</strong></td>
                                    <td class="text-center"><strong>Price</strong></td>
                                    <td class="text-right"><strong>Total</strong></td>
                                </tr>
                                </thead>
                                <?php
                                $x = 1;
                                $last_insert_id = $_GET['last_id']; //
                                $orderResult = $conn->query($sql);
                                         while($row = $orderResult->fetch_array()){
                                             ?>
                                    <tr>
                                        <td class="text-center">
                                            <?php echo  $x;  ?>
                                        </td >
                                        <td class="text-center">
                                            <?php echo  $row[9];  ?>
                                        </td >
                                        <td class="text-center">
                                            <?php echo  $row[3];  ?>
                                        </td >
                                        <td class="text-center"><?php echo  $row[2];  ?></td>
                                        <td class="text-right"><?php echo  $row[4];  ?></td>
                                    </tr>

                                <?php $x++;   } ?>
                            </table>

                        </div>
                    </div>


                    <div  align="right">
                        Sub Total &nbsp;&nbsp;<b><?php echo $sub ?></b>
                    </div>
                    <div align="right">

                        Pay  &nbsp;&nbsp; <b><?php echo $pay ?></b>
                    </div>


                    <div align="right">
                        Due &nbsp;&nbsp;   <b><?php echo $due ?></b>
                    </div>

                    <div align="center">
                            <i>60 b bank road badulla</i>
                    </div>



                </div>


                </div>
                <div>
                <div>
              </div>

<center>

</body>
<script src="bower_components/jquery/dist/jquery.js"></script>
<script src="bower_components/jquery-confirm-master/dist/jquery-confirm.min.js"></script>
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/jquery.validate.min.js"></script>
<script src="jQuery.print.js"></script>





<script>
    myFunction();
    //
    window.onafterprint = function(e){
        closePrintView();
    };

    function myFunction(){
        window.print();

    }



    function closePrintView() {
        window.location.href = 'purchase.php';



    }

</script>
<script>


    // here we will write our custom code for printing our div



</script>
</html>


<?php     }   ?>