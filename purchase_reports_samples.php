<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>DMS | Projects</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="bower_components/jquery-confirm-master/dist/jquery-confirm.min.css">
    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body>
<?php include("header.php")  ?>


<br><br>

<div>
    <div class="modal  fade" id="mdlProject">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="mdlhead">Add New Project</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="frmProject">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Project Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="project_name" name="project_name"
                                           placeholder="Project Name" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Project Description</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="project_description"
                                           name="project_description" placeholder="Project Description" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Client Name</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="project_client"
                                           name="project_client" placeholder="Client Name" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Client Email</label>

                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="project_client_email"
                                           name="project_client_email" placeholder="Client Email" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Project Status</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="project_status" name="project_status"
                                            placeholder="Project Status" required>
                                        <option value="">Please Select</option>
                                        <option value="1">On Going</option>
                                        <option value="2">On Hold</option>
                                        <option value="3">Completed</option>
                                        <option value="4">Canceled</option>
                                    </select>
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
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <button type="button" class="btn btn-primary pull-right" onclick="showModal()">Add New
            Project </button>
    </div>
</div>
















<div class="container-fluid bg-1 ">
    <div class="row">
        <div class="col-sm-12" >

            <form class="card" id="frmProject">
                <div class="card-body">
                    <h3 class="card-title">Category</h3>
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



<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<script src="bower_components/jquery.validate.min.js"></script>

<script src="bower_components/jquery-confirm-master/dist/jquery-confirm.min.js"></script>

<!-- page script -->
<script>

var isNew = true;
var project_id = null;

function showModal()
{
    $('#mdlProject').modal('show');
}

</script>
</body>
</html>
