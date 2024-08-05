<?php

include("db.php");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $last_insert_id = $_GET['last_id'];




    $sql = "select i.sales_id,i.product_id,i.price,i.qty,i.discount,i.total,s.date,s.grand_total,s.pay,s.balance,pr.p_name from sales_product i, sales s,product pr where s.id = i.sales_id and i.product_id = pr.barcode and  i.sales_id =  $last_insert_id ";


    $orderResult = $conn->query($sql);
    $orderData = $orderResult->fetch_array();
    $sales_id = $orderData[0];
    $product_id = $orderData[1];
      $price = $orderData[2];
    $qty = $orderData[3];
    $discount = $orderData[4];
    $total = $orderData[5];
    $date = $orderData[6];
    $grand_total = $orderData[7];
    $pay = $orderData[8];
    $balance = $orderData[9];
    $product_name = $orderData[10];
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


    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class='print' style="border: 1px solid #a1a1a1; width: 88mm; background: white; padding: 10px; margin: 0 auto; text-align: center; ">


                    <div class="invoice-title" align="center">

                        <h1>Tutus Funny</h1>
                    </div>

                    <div class="invoice-title" align="left">
                        Order #  &nbsp; &nbsp;<b> <?php echo $last_insert_id; ?></b>
                    </div>
                    <div class="invoice-title" align="left">
                        Date # <b> <?php echo $date; ?> </b>
                    </div>

                    <div class="invoice-title" align="right">
                        Date # <b> <?php echo $date; ?> </b>
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
                                            <?php echo  $row[10];  ?>
                                        </td >
                                        <td class="text-center">
                                            <?php echo  $row[3];  ?>
                                        </td >
                                        <td class="text-center"><?php echo  $row[4];  ?></td>
                                        <td class="text-right"><?php echo  $row[2];  ?></td>
                                    </tr>
                                    <?php $x++;   } ?>
                            </table>

                        </div>
                    </div>
                    <div  align="right">
                        Sub Total &nbsp;&nbsp;<b><?php echo $grand_total ?></b>
                    </div>
                    <div align="right">

                        Pay  &nbsp;&nbsp; <b><?php echo $pay ?></b>
                    </div>


                    <div align="right">
                        Due &nbsp;&nbsp;   <b><?php echo $balance ?></b>
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
        window.onafterprint = function(e){
            closePrintView();
        };
        function myFunction(){
            window.print();
        }
        function closePrintView() {
           window.location.href = 'sales.php';
        }

    </script>

    </html>


<?php     }   ?>