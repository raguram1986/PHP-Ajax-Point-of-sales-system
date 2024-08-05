<html>

<head>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>

<body>
<form class="card" id="frmProject">

    <input type="number" class="form-control" placeholder="total_cost" id="total_cost" name="total_cost">


    <button class="btn btn-success" type="button" onclick="addproduct()">Add
    </button>

</form>
<label class="form-label">Total</label>
<input type="text" class="form-control" placeholder="Total" id="total" name="total" size="30px" required="">

<table class="table table-bordered" id="product_list">

    <thead>
    <tr>
        <th style="width: 40px">Remove</th>
          <th>Amount</th>
    </tr>
    </thead>
    <tbody></tbody>
</table>





<script>
    function addproduct() {
        var product = {

            total_cost: $("#total_cost").val(),
            button: '<button  type="button" class="btn btn-warning btn-xs")">delete</button>'
        };
        addRow(product);
    }

    function addRow(product) {
        var $tableB = $('#product_list tbody');
        var $row = $("<tr><td><Button type='button' name = 'record'  class='btn btn-warning btn-xs' name='record' onclick='deleterow(this)' >Delete</td>" +
        "<td>" + product.total_cost + "</td></tr>");

        $row.data("total_cost", product.total_cost);


        $tableB.append($row);
        onRowAdded($row);
    }

    function deleterow(e)
    {
        e.parentNode.parentNode.parentNode.removeChild(e.parentNode.parentNode);
        updateTotal();
    }

    function deleteRow(row) {
        $(row).remove();
        onRowRemoved();
    }

    function updateTotal() {
        var total = $('table tbody tr').toArray().reduce(function(pre, post) {
            return pre + parseFloat($(post).data('total_cost'));
        }, 0);
        console.log(total);
        $('#total').val(total);
    }

    function onRowAdded(row) {
        updateTotal();
    }

    function onRowRemoved(roe) {
        updateTotal();
    }
</script>


</body>

</html>