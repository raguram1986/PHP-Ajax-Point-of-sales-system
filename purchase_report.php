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



<div class="modal  fade" id="mdlProject">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="mdlhead">Make Payment</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="frmProject">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Invoice No</label>

                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="invoice" name="invoice"
                                       placeholder="Invoice No" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Vendor Name</label>

                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="vendor"
                                       name="vendor" placeholder="vendor name" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Due Amount</label>

                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="due"
                                       name="due" placeholder="Due" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Payment Amount</label>

                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="payamount"
                                       name="payamount" placeholder="Pay Amount" required>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class=" btn btn-info" id="save" onclick="addProject()">Save
                            changes
                        </button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal" id="close">Close
                        </button>

                    </div>
                </form>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
</div>


<div class="container-fluid bg-1 ">
    <div class="row">
        <div class="col-sm-12" >

            <form class="card" id="frmProject">
                <div class="card-body">
                    <h3 class="card-title">Purchase Report</h3>
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

    <div class="box" align="left">
        <div class="box-header" align="left">
            <h3 class="box-title"></h3>
            <button type="button" class="btn btn-primary pull-right" onclick="showModal()">
                Make Payment
            </button>
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
                        <th></th>
                    </tr>
                </table>
            </div>
        </div>

    </div>




    <!-- Bootstrap 3.3.7 -->

    <!-- DataTables -->



    <script type="application/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>

    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

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
    <script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="bower_components/fastclick/lib/fastclick.js"></script>
    <script src="bower_components/jquery-confirm-master/dist/jquery-confirm.min.js"></script>

    <script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="bower_components/fastclick/lib/fastclick.js"></script>
    <script src="bower_components/jquery.validate.min.js"></script>

    <script>
    getProduct();
    var isNew = true;
    var project_id = null;

    function getProduct() {
        $("#invoice").empty();
        $("#invoice").keyup(function(e) {

            var q = $("#invoice").val();
            if($('#invoice').val()== ''){
                $.alert({
                    title: 'Error!',
                    content: "Please Select No",
                    type: 'red',
                    autoClose: 'ok|2000'
                });
                return false;
            }
            $.ajax({
                type: "POST",
                url: "get_invoice.php",
                dataType: "JSON",
                data: {invoice: $("#invoice").val() },

                success: function(data) {
                    console.log(data);




                    $("#vendor").val(data[0].vendor_id);
                    $("#due").val(data[0].due);
                },
                error: function(xhr, status, error) {
                }
            });
        });
    }

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
        function showModal()
        {
            $('#mdlProject').modal('show');

        }
    </script>

    <script>
        function get_all() {
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            $('#tbl-projects').dataTable().fnDestroy();

            $.ajax({
                url:"all_purchase.php",
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
                            {"sTitle": "Invoice No", "mData": "Invoice_id"},
                            {"sTitle": "VendorName", "mData": "vendor_id"},
                            {"sTitle": "date", "mData": "date"},
                            {"sTitle": "total", "mData": "total"},
                            {"sTitle": "pay", "mData": "pay"},
                            {"sTitle": "due", "mData": "due"},
                            {"sTitle": "payment_type", "mData": "payment_type"},
                            {
                                "sTitle": "Payment Status","mData": "due", "render": function (mData, type, row, meta) {
                                if (mData != 0) {
                                    return '<span class="label label-info">Pending</span>';
                                }
                                else  {
                                    return '<span class="label label-warning">Complete</span>';
                                }
                            }
                            },

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

        function addProject() {
            if ($("#frmProject").valid()) {
                var _url = '';
                var _data = '';
                var _method;
                if (isNew == true) {
                    _url = 'payment_update.php';
                    _data = $('#frmProject').serialize();
                    _method = 'POST';
                }
                $.ajax({
                    type: _method,
                    url: _url,
                    dataType: 'JSON',
                    data: _data,
                    beforeSend: function () {
                        $('#save').prop('disabled', true);
                        $('#save').html('');
                        $('#save').append('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i>Saving</i>');
                    },
                    success: function (data) {
                        $('#frmProject')[0].reset();
                        $('#save').prop('disabled', false);
                        $('#save').html('');
                        $('#save').append('Save');
                        $('#mdlhead').html('Add New Project');
                        $('#mdlProject').modal('toggle');
                        get_all();
                        var msg;
                        if (isNew)
                        {
                            msg="Payment Completed";
                        }

                        $.alert({
                            title: 'Success!',
                            content: msg,
                            type: 'green',
                            autoClose: 'ok|2000'
                        });

                        isNew = true;
                    },
                    error: function (xhr, status, error) {
                        //alert(xhr);
                        console.log(xhr.responseText);
                        $.alert({
                            title: 'Fail!',
                            content: xhr.responseJSON.errors.product_code + '<br>' + xhr.responseJSON.msg,
                            type: 'red',
                            autoClose: 'ok|2000'

                        });
                        $('#save').prop('disabled', false);
                        $('#save').html('');
                        $('#save').append('Save');
                    }
                });
            }
        }
    </script>

</body>


</html>