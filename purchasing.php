<?php include 'layouts/session.php';


// Include config file
require_once "layouts/config.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


?>


<?php include 'layouts/head-main.php'; ?>


<head>
    <title><?php echo $language["Dashboard"]; ?> Production</title>

    <?php include 'layouts/head.php'; ?>

    <link href="assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />

    <?php include 'layouts/head-style.php'; ?>
</head>
<style>
    .price_per.selectize-control {
        width: 100px;
    }
</style>

<?php include 'layouts/body.php'; ?>

<!-- Begin page -->
<div id="layout-wrapper">

    <?php include 'layouts/menu.php'; ?>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">


        <?php if (isset($_SESSION['prodp'])) { ?>


            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="card ">
                                <div class="card-header card border border-danger">
                                    <h4 class="card-title">
                                        PURCHASING
                                    </h4>

                                </div>
                                <div class="card-body px-4 ">

                                    <div class="row">

                                        <div class="col-lg-12 ms-lg-auto ">
                                            <div class="mt-4 mt-lg-0">


                                                <form id="form" method="POST" enctype="multipart/form-data">
                                                    <div class="row mb-4 justify-content-between">
                                                        <div class="col-sm-3">

                                                            <select id="select-manufacturer" class="vendor" name="vendor_id" placeholder="Pick a vendor..." required>
                                                                <option value="">Select a vendor...</option>

                                                            </select>
                                                        </div>
                                                        <div class="col-sm-2">

                                                            <input type="text" name="invoice" id="invoice" class="form-control" placeholder="Invoice" readonly required>
                                                        </div>


                                                    </div>

                                                    <div class="table-responsive">
                                                        <table class="table text-center">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">#</th>
                                                                    <th scope="col">Detail</th>
                                                                    <th>Type</th>
                                                                    <th colspan="2">Price Per</th>
                                                                    <th scope="col">Quantity</th>
                                                                    <th scope="col">Weight</th>
                                                                    <th scope="col">Rate</th>
                                                                    <th scope="col">Total Amount</th>
                                                                    <th scope="col">Barcode</th>
                                                                    <th scope="col">Action</th>
                                                                    <th scope="col"></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="tbody">
                                                                <tr>
                                                                    <td scope="row">1</td>
                                                                    <td><textarea type="text" name="detail[]" id="detail[]" class="form-control" style="height: 20px;" placeholder="Details"></textarea></td>
                                                                    <td> <input type="text" value="" id="type[]" name="type[]" placeholder="Type" class="form-control" required></td>
                                                                    <td colspan="2"><select class="form-control price_per" id="price_per[]" name="price_per[]" placeholder="Price per">
                                                                            <option value="">Select price per</option>
                                                                            <option value="Qty">Qty</option>
                                                                            <option value="Tola">Tola</option>
                                                                            <option value="K">K</option>

                                                                        </select></td>
                                                                    <td> <input type="number" value="" id="quantity[]" name="quantity[]" class="form-control" placeholder="Quantity" required></td>
                                                                    <td> <input type="number" step="any" value="" id="weight[]" name="weight[]" class="form-control" placeholder="Weight" required></td>
                                                                    <td><input type="number" step="any" value="" id="rate[]" name="rate[]" class="form-control" placeholder="Rate" required></td>
                                                                    <td><input type="number" step="any" value="" id="total[]" name="total[]" class="form-control" placeholder="Total" onchange="GrandTotal()" required></td>
                                                                    <td><input id="barcode[]" name="barcode[]" type="text" class="form-control" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1" readonly></td>
                                                                    <td><button class="btn btn-outline-secondary" type="button" id="button-addon1" onclick="GenerateBarcode(this)">B/C</button></td>
                                                                    <td><i onclick="AddProduct()" class="fa fa-plus-circle fa-1x p-3"></i></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <div class="row mb-4 d-flex justify-content-end">
                                                            <div class="d-flex justify-content-end col-sm-2 ">

                                                                <input type="text" id="grand_total" name="grand_total" class="form-control " placeholder="Grand Total" readonly required>
                                                            </div>

                                                        </div>

                                                        <div class="d-flex justify-content-end">
                                                            <button type="button" class="btn btn-success me-2">Print</button>
                                                            <button type="submit" name="submit" class="btn btn-primary">Save</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Page-content -->


        <?php } // Super Admin 
        ?>





        <?php include 'layouts/footer.php'; ?>
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->

<!-- Right Sidebar -->
<?php include 'layouts/right-sidebar.php'; ?>
<!-- /Right-bar -->

<!-- JAVASCRIPT -->
<?php include 'layouts/vendor-scripts.php'; ?>





<!-- apexcharts -->
<script src="assets/libs/apexcharts/apexcharts.min.js"></script>

<!-- Plugins js-->
<script src="assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js"></script>

<!-- dashboard init -->
<script src="assets/js/pages/dashboard.init.js"></script>

<!-- App js -->
<script src="assets/js/app.js"></script>

</body>

</html>

<script>
    function AddProduct() {
        let area = document.getElementById('tbody');
        let tr = document.createElement('tr');
        tr.innerHTML = `<th scope="row">1</th>
                            <td><textarea type="text" name="detail[]" id="detail[]" class="form-control" style="height: 20px;" placeholder="Details"></textarea></td>
                            <td> <input type="text" value="" id="type[]" name="type[]" placeholder="Type" class="form-control" required></td>
                            <td colspan="2"><select class="form-control" id="price_per[]" name="price_per[]" placeholder="Price per">
                                    <option value="">Select price per</option>
                                    <option value="Qty">Qty</option>
                                    <option value="Tola">Tola</option>
                                    <option value="K">K</option>
                                </select></td>
                            <td> <input type="number" value="" id="quantity[]" name="quantity[]" class="form-control" placeholder="Quantity" required></td>
                            <td> <input type="number" step="any" value="" id="weight[]" name="weight[]" class="form-control" placeholder="Weight" required></td>
                            <td><input type="number" step="any" value="" id="rate[]" name="rate[]" class="form-control" placeholder="Rate" required></td>
                            <td><input type="number" step="any" value="" id="total[]" name="total[]" class="form-control" placeholder="Total" required></td>
                            <td><input id="barcode[]" name="barcode[]" type="text" class="form-control" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1" readonly></td>
                            <td><button class="btn btn-outline-secondary" type="button" id="button-addon1" onclick="GenerateBarcode(this)">B/C</button></td>
                        <td><i onclick="DeleteProduct(this)" class="fa fa-minus-circle fa-1x p-3"></i></td>`;
        area.appendChild(tr);
        AddEventListeners();
    }

    function DeleteProduct(e) {
        e.parentNode.parentNode.remove();
    }

    function GrandTotal() {
        total = document.querySelectorAll('#total\\[\\]');
        let grand_total = 0;
        for (let i = 0; i < total.length; i++) {
            grand_total += parseInt(total[i].value);
        }
        document.getElementById('grand_total').value = grand_total;
    }

    function GenerateBarcode(btn) {
        unique = Math.floor(new Date().getTime() + Math.random());
        if (btn.parentNode.previousElementSibling.children[0].value == "") {
            btn.parentNode.previousElementSibling.children[0].value = unique;
        }else{
            btn.parentNode.previousElementSibling.children[0].value = "";
        }

    }

    function CalculateTotal(i) {
        price_per = document.querySelectorAll('#price_per\\[\\]')[i];
        qty = document.querySelectorAll('#quantity\\[\\]')[i];
        weight = document.querySelectorAll('#weight\\[\\]')[i];
        rate = document.querySelectorAll('#rate\\[\\]')[i];
        total = document.querySelectorAll('#total\\[\\]')[i];
        if (price_per.value == "K") {
            total.value = qty.value * rate.value * 5;
            GrandTotal();
        } else if (price_per.value == "Tola") {
            total.value = (weight.value / 11.664) * rate.value;
            GrandTotal();
        } else if (price_per.value == "Qty") {
            total.value = qty.value * rate.value;
            GrandTotal();
        }
    }

    function AddEventListeners() {
        price_per = document.querySelectorAll('#price_per\\[\\]');
        weight = document.querySelectorAll('#weight\\[\\]');
        qty = document.querySelectorAll('#quantity\\[\\]');
        rate = document.querySelectorAll('#rate\\[\\]');
        price_per.forEach((e, i) => {
            selectize = $(e).selectize()[0].selectize;
            selectize.on('change', function() {
                CalculateTotal(i);
            });
        });
        for (let i = 0; i < price_per.length; i++) {
            weight[i].addEventListener('change', function() {
                CalculateTotal(i);
            });
            qty[i].addEventListener('change', function() {
                CalculateTotal(i);
            });
            rate[i].addEventListener('change', function() {
                CalculateTotal(i);
            });
        }
        $('select').selectize({
            sortField: 'text'
        });
    }

    $(document).ready(function() {
        AddEventListeners();

        $.ajax({
            url: "functions.php",
            type: "POST",
            data: {
                function: "GetPurchasingCount"
            },
            success: function(data) {
                data = JSON.parse(data);
                document.getElementById('invoice').value = data;
            }
        });

        $.ajax({
            url: "functions.php",
            method: "POST",
            data: {
                function: "GetAllVendorData",
                type: "vendor"
            },
            success: function(response) {
                var data = JSON.parse(response);
                var select = $('#select-manufacturer')[0].selectize;
                for (var i = 0; i < data.length; i++) {
                    var newOption = {
                        value: data[i].id,
                        text: data[i].id + " | " + data[i].name
                    };
                    select.addOption(newOption);
                }

            }
        });

    });

    $("#form").submit(function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        formData.append('function', 'AddPurchasing');
        $.ajax({
            url: "functions.php",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                data = JSON.parse(data);
                if (data[0] == "success" && data[1] == "success") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Purchasing Added Successfully',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                    })
                }
            }
        });
    });
</script>