<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Theme style -->
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->

    <link rel="stylesheet" href="bower_components/jquery-confirm-master/dist/jquery-confirm.min.css">

    <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
    <!-- DataTables -->

    <link type="text/css" rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.css">
    <link type="text/css" rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">

    <link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">

</head>

<body>

<?php include("header.php")  ?>


<br><br>




<div class="container-fluid bg-1 ">
<div class="row">
    <div class="col-sm-12" >

        <form class="card" id="frmProject">
            <div class="card-body">
                <h3 class="card-title">Sales Report</h3>
                <div class="row">

                    <div class="col-sm-6 col-md-3">

                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">From Date</label>
                            <input type="date" class="form-control" id="from_date" name="from_date" placeholder="From Date"  required>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">To Date</label>
                            <input type="date" class="form-control" id="to_date" name="to_date" placeholder="To Date"  required>
                        </div>
                    </div>
                </div>


                <div class="modal-footer">
                    <button type="button" class=" btn btn-info" id="save" onclick="get_all()">Search</button>
                    <button type="button"  class="btn btn-warning" data-dismiss="modal" id="close">Close</button>
                </div>
            </div>
    </div>
</div>



<div class="col-sm-12">
    <div class="col s12 m6 offset-m4">

        <div class="panel-body">
            <table id="tbl-projects" class="table table-striped table-bordered" cellspacing="0"
                   width="100%">
                <thead>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>

                </tr>
            </table>
        </div>
    </div>

</div>


<script type="application/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>

<script src="bower_components/jquery/dist/jquery.min.js"></script>


<script type="application/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="application/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script type="application/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script type="application/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="application/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="application/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="application/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script type="application/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script type="application/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>



<script>
    getProduct();
    var isNew = true;
    var project_id = null;

</script>

<script>
    $(document).ready(function() {
        $('#tbl-projects').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'excel', 'pdf', 'print'
            ]
        } );
    } );

</script>

<script>
    function get_all() {
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();
        $('#tbl-projects').dataTable().fnDestroy();

        $.ajax({
            url:"all_sales.php",
            type: "POST",
            dataType: 'JSON',
            data:{from_date:from_date, to_date:to_date},
            async:false,
            success: function (data) {
                console.log(data);

                $('#tbl-projects').dataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        , 'excel', 'pdf', 'print'
                    ],

                    "aaData": data
                    ,
                    "scrollX": true,
                    "aoColumns": [
                        {"sTitle": "Invoice No", "mData": "id"},
                        {"sTitle": "Date", "mData": "date"},
                        {"sTitle": "Subtotal", "mData": "subtotal"},
                        {"sTitle": "Discount_toal", "mData": "discount_toal"},
                        {"sTitle": "Grand_total", "mData": "grand_total"},
                        {"sTitle": "Pay", "mData": "pay"},
                        {"sTitle": "Balance", "mData": "balance"},

                    ]
                });
            },
            error: function (xhr) {
                console.log('Request Status: ' + xhr.status  );
                console.log('Status Text: ' + xhr.statusText );
                console.log(xhr.responseText);
                var text = $($.parseHTML(xhr.responseText)).filter('.trace-message').text();
                console.log(text)
            }
        });
    }


</script>

</body>


</html>