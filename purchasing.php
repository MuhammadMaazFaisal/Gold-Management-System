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
                            <td><select id="type[]" name="type[]" placeholder="Type">
                                    <option value="">Type:</option>

                                </select></td>
                            <td><select id="type[]" name="type[]" placeholder="Type">
                                    <option value="">Type:</option>

                                </select></td>
                            <td> <input type="number" value="" id="weight[]" name="weight[]" class="form-control" placeholder="Weight" required></td>
                            <td> <input type="number" value="" id="weight[]" name="weight[]" class="form-control" placeholder="Weight" required></td>
                            <td><input type="number" value="" id="rate[]" name="rate[]" class="form-control" placeholder="Rate" required></td>
                            <td><input type="number" value="" id="total[]" name="total[]" class="form-control" placeholder="Total" required></td>
                            <td><input id="barcode[]" name="barcode[]" type="text" class="form-control" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1"></td>
                            <td><button class="btn btn-outline-secondary" type="button" id="button-addon1">Button</button></td>
                            <td><i onclick="DeleteProduct(this)" class="fa fa-minus-circle fa-1x p-3"></i></td>`;
        area.appendChild(tr);
        $('select').selectize({
            sortField: 'text'
        });
    }

    function DeleteProduct(e) {
        e.parentNode.parentNode.remove();
    }

    $(document).ready(function() {
        $('select').selectize({
            sortField: 'text'
        });

        $.ajax({
            url: "functions.php",
            type: "POST",
            data: {
                function: "GetPurchasingCount"
            },
            success: function(data) {
                console.log(data);
            }
        });
    });
</script>