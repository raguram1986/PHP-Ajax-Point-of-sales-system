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


    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"/>

</head>

<body>
<?php include("header.php")?>



<br><br>

<div class="container-fluid">
<div class="row">
    <div class="col-sm-4">
        <form class="card" id="frmProject">
            <div class="bg-2form-group" align="left">
                <label class="form-label">Category Name</label>
                <input type="text" class="form-control" placeholder="Category Name" id="categoryname" name="categoryname" size="30px"  required>

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

                <table id="tbl-projects" class="table table-responsive table-bordered" cellspacing="0"
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




<script src="bower_components/jquery.validate.min.js"></script>
<!-- SlimScroll -->


<script src="bower_components/jquery-confirm-master/dist/jquery-confirm.min.js"></script>

<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>



<script src="bower_components/jquery.validate.min.js"></script>

<script>
        get_all();
    var isNew = true;
    var project_id = null;

function reSet()
{
    $('#frmProject').trigger("reset");
}

    function addProject() {

        if ($("#frmProject").valid())
        {
            var _url = '';
            var _data = '';
            var _method;
            if (isNew == true) {
                _url = 'add_category.php';
                _data = $('#frmProject').serialize();
                _method = 'POST';

            }
            else {
                _url = 'update_project.php',
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





                       get_all();
                    var msg;

                    if (isNew)
                    {
                        msg="Category Created";
                    }
                    else{
                        msg="Category Updated";
                        $('#frmProject').trigger("reset");
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
            url: "all_category.php",
            type: "GET",
            dataType: "JSON",


            success: function (data) {
                      console.log(data);

                $('#tbl-projects').dataTable({
                    "aaData": data
                    ,
                    "scrollX": true,

                    "aoColumns": [
                        {"sTitle": "Category", "mData": "catname"},
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
                            url: 'remove.php',
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
                url: 'edit_return.php',
                dataType: 'JSON',
                data: {project_id: id},
                success: function (data) {


                    $("html, body").animate({scrollTop: 0}, "slow");
                    isNew = false
                    project_id = data.id
                    $('#categoryname').val(data.catname);

                    $('#status').val(data.status);
                   // $('#frmProject').modal('show');

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