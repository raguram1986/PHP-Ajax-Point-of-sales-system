<html xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>

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

<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<?php include("header.php")?>

<br><br>

<div class="container-fluid bg-2 text-center">
<div class="row">
    <div class="col-sm-8">
        <form class="form-horizontal" id="frmInvoice">

            <table class="table table-bordered">
                <caption> Add Products  </caption>
                <tr>
                    <th>Product Code</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Discount</th>
                    <th>Amount</th>
                    <th>Option</th>
                </tr>
                <tr>
                    <td>
                        <input type="text" class="form-control" placeholder="barcode" id="barcode" name="barcode"  size="25px"  required>
                    </td>
                    <td>
                        <label id="pro_name" name="pname" id="pname"></label>
                        <input  type="text" class="form-control" placeholder="barcode" id="pname" name="pname" size="50px"  disabled >
                    </td>
                    <td>
                        <input type="text" class="form-control pro_price" id="pro_price" size="25px"   name="pro_price"
                               placeholder="price" disabled>
                    </td>
                    <td>
                        <input type="number" class="form-control pro_price" id="qty" name="qty"
                               placeholder="qty" min="1" value="1" size="10px" required>
                    </td>
                    <td>
                        <input type="text" class="form-control pro_price" id="discount" name="discount"
                               placeholder="discount" disabled>
                    </td>
                    <td>
                        <input type="text" class="form-control" placeholder="total_cost" size="35px" id="total_cost" name="total_cost" disabled>
                    </td>
                    <td>
                        <button class="btn btn-success" type="button" onclick="addproduct()">Add
                        </button>
                    </td>
                </tr>
            </table>
        </form>
            <table class="table table-bordered" id="product_list">
                <caption> Products</caption>
                <thead>
                <tr>
                    <th style="width: 40px">Remove</th>
                    <th>Product Code</th>
                    <th>Product Name</th>
                    <th>Unit price</th>
                    <th>Qty</th>
                    <th>Discount</th>
                    <th>Amount</th>
                </tr>
                </thead>

                <tbody></tbody>
            </table>
    </div>





    <div class="col-sm-4">
        <div class="col s12 m6 offset-m4">



            <div class="form-group" align="left">
                <label class="form-label">Total</label>
                <input type="text" class="form-control" placeholder="Total" id="total" name="total" size="30px" required disabled>
            </div>

            <div class="form-group" align="left">
                <label class="form-label">Discount</label>
                <input type="text" class="form-control" placeholder="Total" id="discounttotal" name="discounttotal" size="30px" required disabled>
            </div>

            <div class="form-group" align="left">
                <label class="form-label">Grand Total</label>
                <input type="text" class="form-control" placeholder="Grand Total" id="grandtotal" name="grandtotal" size="30px" required disabled>
            </div>

            <div class="form-group" align="left">
                <label class="form-label">Pay</label>
                <input type="text" class="form-control" placeholder="Pay" id="pay" name="pay" size="30px" required>
            </div>

            <div class="form-group" align="left">
                <label class="form-label">Balance</label>
                <input type="text" class="form-control" placeholder="Balance" id="balance" name="balance" size="30px" required disabled>
            </div>

            <div class="form-group" align="left">
                <label class="col-sm-2 control-label">Status</label>
                <select class="form-control" id="payment" name="payment"
                        placeholder="Project Status" required>
                    <option value="">Please Select</option>
                    <option value="1">Cash</option>
                    <option value="2">Cheque</option>
                </select>
            </div>


            <div class="card" align="right">

                <button type="button" id="save" class="btn btn-info" onclick="addProject()">Print Invoice
                </button>
                <button type="button" id="clear" class="btn btn-warning" onclick="reSet()">Reset</button>

            </div>
        </div>
        </form>
    </div>

</div>

<br><br>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->

<!-- DataTables -->

<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<script src="bower_components/jquery.validate.min.js"></script>


<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="bower_components/jquery.validate.min.js"></script>
<script src="bower_components/jquery-confirm-master/dist/jquery-confirm.min.js"></script>
<script>


    var isNew=true;
    var version_id=null;
    var current_stock=0;
    var product_no =0;

    getProductcode();

    getCategory();

    function getProductcode() {

        $("#barcode").empty();
        $("#barcode").keyup(function(e) {
            var q = $("#barcode").val();
            if($('#barcode').val().length == 0 ){
                $.alert({
                    title: 'Error!',
                    content: "Please Enter the Barcode",
                    type: 'red',
                    autoClose: 'ok|2000'
                });
                return false;
            }
            $.ajax({
                type: "POST",
                url: "get_product.php",
                dataType: "JSON",
                data: { barcode: $("#barcode").val() },
                success: function(data) {

                    $("#pname").val(data[0].p_name);
                    $("#pro_price").val(data[0].retail_price);
                    $("#discount").val(data[0].cal_amount);
                    $("#qty").focus();
                    current_stock=Number(data[0].qty);

                    console.log(data.qty);
                },
                error: function(xhr, status, error) {

                }
            });
        });
    }
    $(function() {
        $("#pro_price, #qty").on("keydown keyup click", qty);

        function qty() {
            var sum = (
            Number($("#pro_price").val()) * Number($("#qty").val())
            );
            $('#total_cost').val(sum);
            console.log(sum);
        }
    });

    $(function() {
        $("#qty, #discount").on("keydown keyup click", discount);
        function discount() {
            var sum1 = (
            Number($("#qty").val()) * Number($("#discount").val())
            );

            console.log(sum1);
        }
    });

    $(function() {
        $("#grandtotal, #pay").on("keydown keyup", per);

        function per() {
            var totalamount = (
            Number($("#pay").val()) - Number($("#grandtotal").val())
            );
            $("#balance").val(totalamount);
        }
    });

    function getCategory(){
        $.ajax({
            type: 'GET',
            url: 'all_vendor.php' ,
            dataType: 'JSON',
            success: function (data) {
                for (var i = 0; i < data.length; i++) {
                    $('#vendor').append($("<option/>", {
                        value: data[i].id,
                        text: data[i].vname ,
                    }));
                }
            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
            }

        });
    }

    function addproduct() {
        var sum1 = (Number($("#qty").val()) * Number($("#discount").val()));
        var product = {
            barcode: $("#barcode").val(),
            pname: $("#pname").val(),
            pro_price: $("#pro_price").val(),
            qty: $("#qty").val(),
            discount:   sum1,
            total_cost: $("#total_cost").val(),
            button: '<button  type="button" class="btn btn-warning btn-xs")">delete</button>'
        };
        addRow(product);
        $('#frmInvoice')[0].reset();
    }
    var total=0;
    var discount=0;
    var grosstotal=0;
    var qtye=0;
    var barcode = 0;


    function addRow(product) {
        if (current_stock < Number($("#qty").val())) {
            $.alert({
                title: 'Error!',
                content: "Product stock is not enough",
                type: 'red',
                autoClose: 'ok|2000'
            });
        }
        else {
            console.log(product.total_cost);
            var $tableB = $('#product_list tbody');
            var $row = $("<tr><td><Button type='button' name = 'record'  class='btn btn-warning btn-xs' name='record' onclick='deleterow(this)' >Delete</td>" +
            "<td>" + product.barcode + "</td><td class=\"price\">" + product.pname + "</td><td>" + product.pro_price + "</td>  <td>" + product.qty + "</td>  <td>" + product.discount + "</td> <td>" + product.total_cost + "</td></tr>");
            $row.data("barcode", product.product_code);
            $row.data("pname", product.product_name);
            $row.data("pro_price", product.price);
            $row.data("qty", product.qty);
            $row.data("discount", product.discount);
            $row.data("total_cost", product.total_cost);
            total += Number(product.total_cost);
            $('#total').val(total);
            discount += Number(product.discount);
            $('#discounttotal').val(discount);
            console.log(product.total_cost);
            grandtotal = total - discount;
            $('#grandtotal').val(grandtotal);
            qtye += Number(product.qty);
            $row.find('deleterow').click(function (event) {
                deleteRow($(event.currentTarget).parent('tr'));
            });
            $tableB.append($row);
        }
    }



    function deleterow(e){

        qty_cost=parseInt($(e).parent().parent().find('td:nth-child(5)').text(),10);
        qtye-=qty_cost;

        product_total_cost=parseInt($(e).parent().parent().find('td:last').text(),10);
        total-=product_total_cost;

        $('#total').val(total);

        dis_total_cost=parseInt($(e).parent().parent().find('td:nth-child(6)').text(),10);
        discount-=dis_total_cost;

        console.log(discount);

        $("#discounttotal").val(discount);

        grandtotal = total - discount;
        $('#grandtotal').val(grandtotal);
        $(e).parent().parent().remove();

    }
    function deleteRow(row) {
        console.log(product.total_cost);
        total -= Number(product.total_cost);
        $("#tot").val(tot);
        $(row).remove();
        console.log(product.total_cost);
        $(row).remove();
        onRowRemoved();
    }

    function addProject() {
            var table_data = [];
            $('#product_list tbody tr').each(function (row, tr){
                var sub = {
                    'barcode': $(tr).find('td:eq(1)').text(),
                    'pname': $(tr).find('td:eq(2)').text(),
                    'pro_price': $(tr).find('td:eq(3)').text(),
                    'qty': $(tr).find('td:eq(4)').text(),
                    'discount': $(tr).find('td:eq(5)').text(),
                    'total_cost': $(tr).find('td:eq(6)').text(),
                };
                table_data.push(sub);
            });
            console.log(table_data);
            var _url = '';
            var _data = '';
            var _method;
            var total = $("#total").val();
            var discounttotal = $("#discounttotal").val();
            var grandtotal = $("#grandtotal").val();
            var pay = $("#pay").val();
            var balance = $("#balance").val();
            $.ajax({
                type: "POST",
                url: "sales_add.php",
                dataType: 'JSON',
                data: {
                    total: $('#total').val(),
                    discounttotal: $('#discounttotal').val(),
                    grandtotal: $('#grandtotal').val(),
                    pay: $('#pay').val(),
                    balance: $('#balance').val(),
                    payment: $('#payment').val(),
                    data: table_data
                },
                success: function (data) {
                    console.log(_data);
                    //    $('#frmProject')[0].reset();
                    $('#save').prop('disabled', false);
                    $('#save').html('');
                    $('#save').append('Add');
                    var msg;
                    if (isNew) {
                        msg = "Sales Completed";
                    }

                    last_id = data.last_id
                    window.location.href = "print.php?last_id=" + last_id;

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

</script>



</body>


</html>