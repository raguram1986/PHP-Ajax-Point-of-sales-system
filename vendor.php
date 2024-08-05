<html>
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
<?php include("header.php")?>

<br><br>


<div class="container-fluid bg-1 ">
<div class="row">
    <div class="col-sm-12">

        <form class="card" id="frmProject">
            <div class="card-body">
                <h3 class="card-title">Vendor</h3>
                <div class="row">

                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-label">Vendor Name</label>
                            <input type="text" class="form-control" placeholder="Vendor Name" id="vendorName" name="vendorName"  required>

                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-label">Contact No</label>
                            <input type="text" class="form-control" placeholder="Contact No" id="contactno" name="contactno" required>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-label">E-mail</label>
                            <input type="text" class="form-control" placeholder="E-mail" id="email" name="email" required>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-label">Address</label>

                            <textarea class="form-control" rows="3" placeholder="Address" id="address" name="address" required></textarea>
                        </div>
                    </div>




                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Project Status</label>


                            <select class="form-control" id="status" name="status"
                                    placeholder="Project Status" required>
                                <option value="">Please Select</option>
                                <option value="1">Active</option>

                                <option value="2">DeActive</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class=" btn btn-info" id="save" onclick="addvendor()">Save</button>
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


                </tr>

            </table>
        </div>
    </div>

</div>


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
product();
var isNew=true;
var version_id=null;
// get_all();


function product() {

    $('#tbl-projects').dataTable().fnDestroy();
    $.ajax({
        url: "all_vendor.php",
        type: "GET",
        dataType: "JSON",

        success: function (data) {


            $('#tbl-projects').dataTable({
                "aaData": data
                ,
                "scrollX": true,
                "aoColumns": [
                    {"sTitle": "Vendor Name", "mData": "vname"},
                    {"sTitle": "Contactus", "mData": "contactno"},

                    {"sTitle": "Email", "mData": "email"},


                    {"sTitle": "Address", "mData": "address"},




                    {
                        "sTitle": "Status","mData": "status", "render": function (mData, type, row, meta) {
                        if (mData == 1) {
                            return '<span class="label label-info">Active</span>';
                        }
                        else if (mData == 2) {
                            return '<span class="label label-warning">Deactive</span>';
                        }


                    }
                    },
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
            //console.log('Request Status: ' + xhr.status  );
            //console.log('Status Text: ' + xhr.statusText );
            console.log(xhr.responseText);
            var text = $($.parseHTML(xhr.responseText)).filter('.trace-message').text();
            // console.log(text)


        }
    });
}





function addvendor() {

    if ($("#frmProject").valid())
    {
        var _url = '';
        var _data = '';
        var _method;
        if (isNew == true) {
            _url = 'add_vendor.php';
            _data = $('#frmProject').serialize();
            _method = 'POST';

        }
        else {
            _url = 'update_vendor.php',
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
                $('#save').append('Save');
                product();
                var msg;

                if (isNew)
                {
                    msg="Registation Successfully Created";
                }
                else{
                    msg="Registation Successfully Updated";
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

function RemoveTeam(id) {
    // if (confirm("Do you want to Delete the Record?")) {
    // Do it!
    $.confirm({
        theme: 'supervan',
        buttons: {

            Yes: function () {

                $.ajax({
                    type: 'POST',
                    url: 'product_remove.php',
                    dataType: 'JSON',
                    data: {id: id},
                    success: function (data) {


                        get_all();

                    },

                    error: function (xhr, status, error) {

                        alert(xhr.responseText);
                        //
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
        url: 'return_vendor.php',
        dataType: 'JSON',
        data: {project_id: id},
        success: function (data) {

            $("html, body").animate({scrollTop: 0}, "slow");
            isNew = false
            project_id = data.id
            $('#vendorName').val(data.vname);
            $('#contactno').val(data.contactno);
            $('#email').val(data.email);
            $('#address').val(data.address	);
            $('#status').val(data.status);

            $('#frmProject').modal('show');
            //  $('#mdlhead').html('Edit Project Details');
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