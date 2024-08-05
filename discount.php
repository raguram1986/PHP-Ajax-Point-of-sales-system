<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">


    <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

    <link rel="stylesheet" href="bower_components/jquery-confirm-master/dist/jquery-confirm.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css"/>

    <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">

    <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.css">
    <link type="text/css" rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">

</head>

<body>
<?php include("header.php")?>



<br><br>

<div class="container-fluid bg-2 text-center">
<div class="row">

    <div class="col-sm-4">

        <form class="card" id="frmProject">
            <div class="form-group" align="left">
                <label class="form-label">Barcode</label>
                <input type="text" class="form-control" placeholder="Brand Name" id="barcode" name="barcode" size="30px"  required>
            </div>

            <div class="form-group" align="left">
                <label class="form-label">Product Name</label>
                <input type="text" class="form-control" placeholder="Brand Name" id="productname" name="productname" size="30px"  required>
            </div>

            <div class="form-group" align="left">
                <label class="form-label">Price</label>
                <input type="text" class="form-control" placeholder="Discount Name" id="price" name="price" size="30px"  required>
            </div>

            <div class="form-group" align="left">
                <label class="form-label">Discount Name</label>
                <input type="text" class="form-control" placeholder="Discount Name" id="discountname" name="discountname" size="30px"  required>
            </div>
            <div class="form-group" align="left">
                <label class="form-label">Amount</label>
                <input type="text" class="form-control" placeholder="Discount Name" id="amount" name="amount" size="30px"  required>
            </div>



            <div class="form-group" align="left">
                <label class="col-sm-2 control-label">Discount type</label>


                <select class="form-control" id="discount" name="discount"
                        placeholder="Discount" required>
                    <option value="">Please Select</option>
                    <option value="1">Amount</option>

                    <option value="2">Percentage</option>
                </select>
            </div>

            <div class="form-group" align="left">
                <label class="form-label">Calculate Amount</label>
                <input type="text" class="form-control" placeholder="calamount" id="calamount" name="calamount" size="30px"  required>
            </div>

            <div class="card" align="right">

                <button type="button" id="save" class="btn btn-info" onclick="addProject()">Add
                </button>
                <button type="button" id="clear" class="btn btn-warning" onclick="reSet()">Reset</button>
            </div>


    </div>
    </form>

    <div class="col-sm-8">
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
</div><br><br>

<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->

<!-- DataTables -->

<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<script src="bower_components/jquery.validate.min.js"></script>


<!-- SlimScroll -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="bower_components/jquery.validate.min.js"></script>
<script src="bower_components/jquery-confirm-master/dist/jquery-confirm.min.js"></script>



<script>
get_all();
var isNew = true;


var project_id = null;
getProductcode();
function reSet()
{
    //  alert("Hiii");

    $('#frmProject')[0].reset();


}
function getProductcode() {
    $("#barcode").empty();

    $("#barcode").keyup(function(e) {
        var q = $("#barcode").val();

        $.ajax({
            type: "POST",
            url: "get_prod.php",
            dataType: "JSON",
            data: { barcode: $("#barcode").val() },
            success: function(data) {

                $("#productname").val(data[0].p_name);
                $("#price").val(data[0].retail_price);
            },
            error: function(xhr, status, error) {
               // alert(xhr);
              //  console.log(xhr.responseText);

            }
        });
    });
}



$(function() {

    $('#discount').change(function() {

        if ($(this).val() == 2){
                     var calamount = (
                     Number($("#price").val()) * Number($("#amount").val())/100);

                    $("#calamount").val(calamount);

        }

        if ($(this).val() == 1){
            var calamount = $("#amount").val();
            $("#calamount").val(calamount);


            }

    });
});

function addProject() {

    if ($("#frmProject").valid())
    {
        var _url = '';
        var _data = '';
        var _method;
        if (isNew == true) {
            _url = 'add_barcode.php';
            _data = $('#frmProject').serialize();
            _method = 'POST';

        }
        else {
            _url = 'update_discount.php',
                _data = $('#frmProject').serialize() + "&project_id=" + project_id;
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
                $('#save').append('Add');
             get_all();
                var msg;

                if (isNew)
                {
                    msg="Discount Created";

                }
                else{
                    msg="Discount Updated";
                }
                $.alert({
                    title: 'Success!',
                    content: msg,
                    type: 'green',
                    boxWidth: '400px',
                    theme: 'light',
                    useBootstrap: false,
                    autoClose: 'ok|2000'

                });
                isNew = true;
            },
            error: function (xhr, status, error) {
                alert(xhr);
                console.log(xhr.responseText);

                $.alert({
                    title: 'Fail!',
                    //            content: xhr.responseJSON.errors.product_code + '<br>' + xhr.responseJSON.msg,
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
function get_all() {

    $('#tbl-projects').dataTable().fnDestroy();
    $.ajax({
        url: "all_discount.php",
        type: "GET",
        dataType: "JSON",

        success: function (data) {

            $('#tbl-projects').dataTable({
                "aaData": data
                ,
                "scrollX": true,
                "aoColumns": [
                    {"sTitle": "Barcode", "mData": "barcode_id"},
                    {"sTitle": "Product Name", "mData": "product_name"},
                    {"sTitle": "Price", "mData": "price"},
                    {"sTitle": "Discount", "mData": "discount_name"},
                    {"sTitle": "Discount_type", "mData": "discount_type"},
                    {"sTitle": "Amount", "mData": "amount"},
                    {"sTitle": "CalAmount", "mData": "cal_amount"},
                    {
                        "sTitle": "Edit",
                        "mData": "id",
                        "render": function (mData, type, row, meta) {

                            return '<button class="btn btn-xs btn-success" onclick="get_project_details(' + mData + ')">Edit</button>';
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
            // console.log(text)

        }
    });
}

function RemoveTeam(id) {

    $.confirm({
        theme: 'supervan',
        buttons: {

            Yes: function () {

                $.ajax({
                    type: 'POST',
                    url: 'bremove.php',
                    dataType: 'JSON',
                    data: {id: id},
                    success: function (data) {
                        get_all();

                    },

                    error: function (xhr, status, error) {
                        alert(xhr.responseText);

                    }

                });


            },

            No: function() {
                console.log('the user clicked cancel');
            }
        }
    });
}







function get_project_details(id) {
    $.ajax({
        type: 'POST',
        url: 'discount_return.php',
        dataType: 'JSON',
        data: {project_id: id},
        success: function (data) {

            $("html, body").animate({scrollTop: 0}, "slow");
            isNew = false

            $("#barcode").attr("disabled", "disabled");
            $("#productname").attr("disabled", "disabled");
            $("#price").attr("disabled", "disabled");

            project_id = data.id
            $('#barcode').val(data.barcode_id);
            $('#productname').val(data.product_name);
            $('#price').val(data.price);
            $('#discountname').val(data.discount_name);
            $('#amount').val(data.amount);
            $('#discount').val(data.discount_type);
            $('#calamount').val(data.cal_amount);

            $('#frmProject').modal('show');


        },

        error: function (xhr, status, error) {

            alert(xhr.responseText);
//
        }

    });
}

</script>




</body>


</html>