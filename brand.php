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


    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"/>

</head>

<body>
<?php include("header.php")?>



<br><br>

<div class="container-fluid bg-2 text-center">
<div class="row">
    <div class="col-sm-4">
        <form class="card" id="frmProject">
            <div class="form-group" align="left">
                <label class="form-label">Brand Name</label>
                <input type="text" class="form-control" placeholder="Brand Name" id="brandname" name="brandname" size="30px"  required>

            </div>
            <div class="form-group" align="left">
                <label class="col-sm-2 control-label">Status</label>


                <select class="form-control" id="status" name="status"
                        placeholder="Project Status" required>
                    <option value="">Please Select</option>
                    <option value="1">Active</option>

                    <option value="2">DeActive</option>
                </select>
            </div>


            <div class="card" align="right">

                <button type="button" id="save" class="btn btn-info" onclick="addProject()">Add
                </button>
                <button type="button" id="clear" class="btn btn-warning" onclick="reSet()">Reset</button>
            </div>
        </form>

    </div>





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

                    </tr>

                </table>
            </div>
        </div>

    </div>
</div><br><br>

<script src="bower_components/jquery/dist/jquery.js"></script>

<script src="bower_components/jquery/dist/jquery.min.js"></script>

<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>

<script src="bower_components/jquery.validate.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>

<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="bower_components/jquery.validate.min.js"></script>

<script src="bower_components/jquery-confirm-master/dist/jquery-confirm.min.js"></script>

<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>

<script src="bower_components/jquery.validate.min.js"></script>

<script>
get_all();
var isNew = true;
var project_id = null;

function reSet()
{
    //  alert("Hiii");

    $('#frmProject')[0].reset();


}






function addProject() {

    if ($("#frmProject").valid())
    {
        var _url = '';
        var _data = '';
        var _method;
        if (isNew == true) {
            _url = 'add_brand.php';
            _data = $('#frmProject').serialize();
            _method = 'POST';

        }
        else {
            _url = 'bupdate_project.php',
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
                console.log(data);
                if (isNew)
                {
                    msg="Brand Created";
                }
                else{
                    msg="Brand Updated";
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
        url: "all_brand.php",
        type: "GET",
        dataType: "JSON",

        success: function (data) {
            $('#tbl-projects').html(data);

            $('#tbl-projects').dataTable({
                "aaData": data
                ,
                "scrollX": true,
                "aoColumns": [
                    {"sTitle": "Brand", "mData": "brand_name"},
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
                    {
                        "sTitle": "Delete",
                        "mData": "id",
                        "render": function (mData, type, row, meta) {

                            return '<button class="btn btn-xs btn-primary" onclick="RemoveTeam(' +  mData + ')">Delete</button>';



                        }
                    }

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
    // if (confirm("Do you want to Delete the Record?")) {
    // Do it!
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
        url: 'bedit_return.php',
        dataType: 'JSON',
        data: {project_id: id},
        success: function (data) {


            $("html, body").animate({scrollTop: 0}, "slow");
            isNew = false
            project_id = data.id
            $('#brandname').val(data.brand_name);

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