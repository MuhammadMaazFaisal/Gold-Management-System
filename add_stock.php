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

<?php include 'layouts/body.php'; ?>

<!-- Begin page -->
<div id="layout-wrapper">

    <?php include 'layouts/menu.php'; ?>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
        <style>
            .hidden-row {
                display: none;
            }
        </style>

        <?php if (isset($_SESSION['prodp'])) { ?>


            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="card ">
                                <div class="card-header card border border-danger">
                                    <h4 class="card-title">
                                        Add Stock
                                    </h4>

                                </div>
                                <div class="card-body p-4 ">

                                    <div class="row">

                                        <div class="col-lg-12 ms-lg-auto ">
                                            <div class="mt-4 mt-lg-0">


                                                <form id="form" method="POST" enctype="multipart/form-data">
                                                    <div class="row mb-4">
                                                        <label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Date:</label>
                                                        <div class="col-sm-2">
                                                            <input type="date" name="date" id="date" class="form-control">
                                                        </div>
                                                        <label for="select-type" class="col-sm-1 col-form-label d-flex justify-content-end">Invoice:</label>
                                                        <div class="col-sm-2">


                                                            <input type="number" name="invoice" id="invoice" class="form-control" placeholder="Invoice" readonly>
                                                        </div>
                                                        <label for="vendor_id" class="col-sm-1 col-form-label d-flex justify-content-end">Vendor Id:</label>
                                                        <div class="col-sm-2">

                                                            <input type="text" value="" id="vendor_id" name="vendor_id" class="form-control" placeholder="Vendor Id" readonly>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#invoice-modal">
                                                                Select Invoice
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card ">
                                <div class="card-header card border">
                                    <h4 class="card-title">
                                        Existing Stock
                                    </h4>

                                </div>
                                <div class="card-body px-4 ">

                                    <div class="row">

                                        <div class="col-lg-12 ms-lg-auto ">
                                            <div class="mt-4 mt-lg-0">


                                                <form id="form" method="POST" enctype="multipart/form-data">
                                                    <div class="row mb-4">
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
                                                                    <th scope="col">Type</th>
                                                                    <th scope="col">Price Per</th>
                                                                    <th scope="col">Quantity</th>
                                                                    <th scope="col">Weight</th>
                                                                    <th scope="col">Rate</th>
                                                                    <th scope="col">Total Amount</th>
                                                                    <th scope="col">Barcode</th>
                                                                    <th scope="col"></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="tbody">
                                                                <tr>
                                                                    <th scope="row">1</th>
                                                                    <td><textarea type="text" name="detail[]" id="detail[]" class="form-control" style="height: 20px;" placeholder="Details"></textarea></td>
                                                                    <td><select id="type[]" name="type[]" placeholder="Type">
                                                                            <option value="">Type:</option>

                                                                        </select></td>
                                                                    <td><select id="type[]" name="type[]" placeholder="Type">
                                                                            <option value="">Type:</option>

                                                                        </select></td>
                                                                    <td> <input type="number" value="" id="weight[]" name="weight[]" class="form-control" placeholder="Quantity" required></td>
                                                                    <td> <input type="number" value="" id="weight[]" name="weight[]" class="form-control" placeholder="Weight" required></td>
                                                                    <td><input type="number" value="" id="rate[]" name="rate[]" class="form-control" placeholder="Rate" required></td>
                                                                    <td><input type="number" value="" id="total[]" name="total[]" class="form-control" placeholder="Total" required></td>
                                                                    <td><input id="barcode[]" name="barcode[]" type="text" class="form-control" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1"></td>
                                                                    <td><button class="btn btn-outline-secondary" type="button" id="button-addon1">B/C</button></td>
                                                                    <td><i onclick="AddProduct()" class="fa fa-plus-circle fa-1x p-3"></i></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <div class="row mb-4 d-flex justify-content-end">
                                                            <div class="d-flex justify-content-end col-sm-2 ">

                                                                <input type="text" name="invoice" id="invoice" class="form-control " placeholder="Grand Total" readonly required>
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

<!-- Modal -->
<div class="modal fade" id="invoice-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Select Invoice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="filter_data" method="POST" enctype="multipart/form-data">
                    <div class="row mb-4">
                        <label for="from-date" class="col-sm-1 col-form-label d-flex justify-content-end">From:</label>
                        <div class="col-sm-1">
                            <input type="date" name="from-date" id="from-date" class="form-control">
                        </div>
                        <label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">To:</label>
                        <div class="col-sm-1">
                            <input type="date" name="to-date" id="to-date" class="form-control">
                        </div>
                        <label for="select-type" class="col-sm-1 col-form-label d-flex justify-content-end">Invoice:</label>
                        <div class="col-sm-2">
                            <input type="number" name="invoice" id="invoice" class="form-control" placeholder="Invoice" readonly>
                        </div>
                        <label for="vendor_name" class="col-sm-1 col-form-label d-flex justify-content-end">Vendor:</label>
                        <div class="col-sm-2">
                            <input type="text" value="" id="vendor_name" name="vendor_name" class="form-control" placeholder="Vendor Id" readonly>
                        </div>
                        <div class="col-sm-2">
                            <button type="submit" name="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
                <table class="table table-hover ">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Invoice</th>
                            <th scope="col">Vendor ID</th>
                            <th scope="col">Vendor Name</th>
                            <th scope="col">Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="clickable-row" onclick="fn(this)">
                            <th scope="row">1</th>
                            <td>I-0001</td>
                            <td>RF001</td>
                            <td>Raees Fancy</td>
                            <td>Rs 45000</td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                            </td>
                        </tr>
                        <tr class="hidden-row">
                            <td colspan="4">
                                <table class="table table-hover ">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Invoice</th>
                                            <th scope="col">Vendor ID</th>
                                            <th scope="col">Vendor Name</th>
                                            <th scope="col">Total</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="clickable-row" onclick="fn(this)">
                                            <th scope="row">1</th>
                                            <td>I-0001</td>
                                            <td>RF001</td>
                                            <td>Raees Fancy</td>
                                            <td>Rs 45000</td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>

                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Extract</button>
            </div>
        </div>
    </div>
</div>

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
    function GetDate() {
        var date = new Date().toISOString().slice(0, 10);
        var dataInputs = document.querySelectorAll('input[type="date"]');
        for (let i = 0; i < dataInputs.length; i++) {
            dataInputs[i].value = date;
        }
    }

    function getFilteredData(form) {
        const fromDate = $("#from-date").val();
        const toDate = $("#to-date").val();

        if (fromDate > toDate) {
            alert("Start date cannot be greater than end date");
            return;
        }
        var formData = new FormData(form);
        formData.append("function", "GetFilterData");
        $.ajax({
            url: "get_data.php",
            method: "POST",
            data: formData,
            dataType: "json",
            success: function(response) {
                console.log(response);
            }
        });
    }

    $(document).ready(function() {
        GetDate();

        $('select').selectize({
            sortField: 'text'
        });

        $("#from-date").change(function() {
            const fromDate = $(this).val();
            $("#to-date").attr("min", fromDate);
        });
    });

    $(documnet).on("submit", "#filter-form", function(e) {
        e.preventDefault();
        getFilteredData(this);
    });

    $(document).ready(function() {
        $(".clickable-row").click(function() {
            console.log("clicked");
            $(this).next(".hidden-row").toggle();
        });
    });

    function fn(e) {
        console.log("clicked");
        console.log(e);
        e.nextElementSibling.style.display = "contents";
    }
</script>