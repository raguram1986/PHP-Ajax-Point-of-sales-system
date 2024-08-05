
    <html>
    <head>
        <title>Printind dive using jquery</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">


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
                <div class='print' style="border: 1px solid #a1a1a1; width: 300px; background: white; padding: 10px; margin: 0 auto; text-align: center;">

                    <div class="invoice-title" align="center">

                        <h1>Pepsi Cola</h1>
                    </div>

                    <div class="invoice-title" align="left">
                        Order #  &nbsp; &nbsp;<b> 11111</b>
                    </div>


                    <div class="invoice-title" align="right">
                        Invoice   <b>22344</b>
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

                                <tr>
                                    <td class="text-center">
                                        1
                                    </td >
                                    <td class="text-center">
                                        Cake
                                    </td >
                                    <td class="text-center">
                                        2
                                    </td >
                                        <td class="text-center">120</td>
                                        <td class="text-right">240</td>
                                    </tr>
                            </table>
                        </div>
                    </div>
                    <div  align="right">
                        Sub Total &nbsp;&nbsp;<b>240</b>
                    </div>
                    <div align="right">
                        Pay  &nbsp;&nbsp; <b>220</b>
                    </div>
                    <div align="right">
                        Due &nbsp;&nbsp;   <b>20</b>
                    </div>
                    <input style="padding:5px;" value="Print Document" type="button" onclick="myFunction()"></input>
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
        function myFunction()
        {
            window.print();
        }
    </script>

    <script>
        // here we will write our custom code for printing our div
        $(function(){
            $('#print').on('click', function() {
                //Print ele2 with default options
                $.print("print");
            });
        });


    </script>
    </html>


