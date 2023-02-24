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
                                <div class="card-body p-4 ">

                                    <div class="row">

                                        <div class="col-lg-12 ms-lg-auto ">
                                            <div class="mt-4 mt-lg-0">


                                                <form id="form" method="POST" enctype="multipart/form-data">
                                                    <div class="row mb-4">

                                                        <label for="select-type" class="col-sm-1 col-form-label d-flex justify-content-end">Product:</label>
                                                        <div class="col-sm-1">

                                                            <select id="select-type" placeholder="Type">
                                                                <option value="">Type:</option>

                                                            </select>
                                                        </div>
                                                        <label for="weight" class="col-sm-1 col-form-label d-flex justify-content-end">Weight:</label>
                                                        <div class="col-sm-1">

                                                            <input type="number" value="" id="weight[]" name="weight[]" class="form-control" placeholder="Weight" required>
                                                        </div>
                                                        <label for="rate" class="col-sm-1 col-form-label d-flex justify-content-end">Rate:</label>
                                                        <div class="col-sm-1">

                                                            <input type="number" value="" id="rate[]" name="rate[]" class="form-control" placeholder="Rate" required>
                                                        </div>
                                                        <label for="total" class="col-sm-1 col-form-label d-flex justify-content-end">Total:</label>
                                                        <div class="col-sm-1">

                                                            <input type="number" value="" id="total[]" name="total[]" class="form-control" placeholder="Total" required>
                                                        </div>

                                                        <label for="barcode" class="col-sm-1 col-form-label d-flex justify-content-end">Barcode:</label>
                                                        <div class="col-sm-2">

                                                            <div class="input-group mb-3">
                                                                <button class="btn btn-outline-secondary" type="button" id="button-addon1">Button</button>
                                                                <input id="barcode" type="text" class="form-control" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-1 m-0 p-0">

                                                            <i onclick="AddProduct()" class="fa fa-plus-circle fa-1x p-3"></i>

                                                        </div>
                                                        <div class="row mb-4">
                                                            <label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Details:</label>
                                                            <div class="col-sm-10">

                                                                <textarea type="text" name="detail" id="p_details" class="form-control" style="height: 60px;" placeholder="Details"></textarea>
                                                            </div>
                                                        </div>
                                                        <div id="area"></div>
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
                <p>
                    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        Add Stock
                    </button>
                </p>
                <div class="collapse" id="collapseExample">
                    <div class="card card-body">
                        <div class="row mb-4">
                            <label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Date:</label>
                            <div class="col-sm-2">
                                <input type="date" name="date" id="date" class="form-control">
                            </div>
                            <label for="select-type" class="col-sm-1 col-form-label d-flex justify-content-end">Select Invoice:</label>
                            <div class="col-sm-2">

                                <select id="select-invoice" placeholder="Invoice">
                                    <option value="">Invoice:</option>

                                </select>
                            </div>
                            <label for="vendor_name" class="col-sm-1 col-form-label d-flex justify-content-end">Vendor Name:</label>
                            <div class="col-sm-2">

                                <input type="text" value="" id="vendor_name" name="vendor_name" class="form-control" placeholder="vendor_name" required>
                            </div>
                        </div>
                        <div class="row mb-4">

                            <label for="select-type" class="col-sm-1 col-form-label d-flex justify-content-end">Product:</label>
                            <div class="col-sm-1">

                                <select id="select-type" placeholder="Type">
                                    <option value="">Type:</option>

                                </select>
                            </div>
                            <label for="weight" class="col-sm-1 col-form-label d-flex justify-content-end">Weight:</label>
                            <div class="col-sm-1">

                                <input type="number" value="" id="weight[]" name="weight[]" class="form-control" placeholder="Weight" required>
                            </div>
                            <label for="rate" class="col-sm-1 col-form-label d-flex justify-content-end">Rate:</label>
                            <div class="col-sm-1">

                                <input type="number" value="" id="rate[]" name="rate[]" class="form-control" placeholder="Rate" required>
                            </div>
                            <label for="total" class="col-sm-1 col-form-label d-flex justify-content-end">Total:</label>
                            <div class="col-sm-1">

                                <input type="number" value="" id="total[]" name="total[]" class="form-control" placeholder="Total" required>
                            </div>

                            <label for="barcode" class="col-sm-1 col-form-label d-flex justify-content-end">Barcode:</label>
                            <div class="col-sm-2">

                                <div class="input-group mb-3">
                                    <button class="btn btn-outline-secondary" type="button" id="button-addon1">Button</button>
                                    <input id="barcode" type="text" class="form-control" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                                </div>
                            </div>
                            <div class="col-sm-1 m-0 p-0">

                                <i onclick="AddProduct()" class="fa fa-plus-circle fa-1x p-3"></i>

                            </div>
                            <div class="row mb-4">
                                <label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Details:</label>
                                <div class="col-sm-10">

                                    <textarea type="text" name="detail" id="p_details" class="form-control" style="height: 60px;" placeholder="Details"></textarea>
                                </div>
                            </div>
                            <div id="area"></div>
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
        let area = document.getElementById('area');
        let div = document.createElement('div');
        div.className = 'row mb-4';
        div.innerHTML = `<hr><label for="select-type" class="col-sm-1 col-form-label d-flex justify-content-end">Product:</label>
        <div class="col-sm-1">

            <select id="select-type" placeholder="Type">
                <option value="">Type:</option>

            </select>
        </div>
        <label for="weight" class="col-sm-1 col-form-label d-flex justify-content-end">Weight:</label>
        <div class="col-sm-1">

            <input type="number" value="" id="weight[]" name="weight[]" class="form-control" placeholder="Weight" required>
        </div>
        <label for="rate" class="col-sm-1 col-form-label d-flex justify-content-end">Rate:</label>
        <div class="col-sm-1">

            <input type="number" value="" id="rate[]" name="rate[]" class="form-control" placeholder="Rate" required>
        </div>
        <label for="total" class="col-sm-1 col-form-label d-flex justify-content-end">Total:</label>
        <div class="col-sm-1">

            <input type="number" value="" id="total[]" name="total[]" class="form-control" placeholder="Total" required>
        </div>

        <label for="barcode" class="col-sm-1 col-form-label d-flex justify-content-end">Barcode:</label>
        <div class="col-sm-2">

            <div class="input-group mb-3">
                <button class="btn btn-outline-secondary" type="button" id="button-addon1">Button</button>
                <input id="barcode" type="text" class="form-control" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
            </div>
        </div>
        <div class="col-sm-1 m-0 p-0">

            <i onclick="DeleteProduct(this)" class="fa fa-minus-circle fa-1x p-3"></i>

        </div>
        <div class="row mb-4">
        <label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Details:</label>
        <div class="col-sm-10">

            <textarea type="text" name="detail" id="p_details" class="form-control" style="height: 60px;" placeholder="Details"></textarea>
        </div>`;
        area.appendChild(div);
    }

    function DeleteProduct(e) {
        e.parentNode.parentNode.remove();
    }

    $(document).ready(function() {
        $('select').selectize({
            sortField: 'text'
        });
    });
</script>