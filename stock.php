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
                                        Stock
                                    </h4>

                                </div>
                                <div class="card-body px-4 ">

                                    <div class="row">

                                        <div class="col-lg-12 ms-lg-auto ">
                                            <div class="mt-4 mt-lg-0 table-responsive">

                                                <table id="stock-table" class="table table-hover">
                                                    <thead class="table-dark">
                                                    </thead>
                                                    <tbody id="tbody">
                                                    </tbody>
                                                </table>

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
    function GetData() {
        $.ajax({
            url: "functions.php",
            type: "POST",
            data: {
                function: "GetStockData"
            },
            success: function(data) {
                data = JSON.parse(data);
                console.log(data);
                var table = $('#stock-table').DataTable({
                    data: data,
                    columns: [{
                            data: 'stock_date',
                            title: 'Date',
                            render: function(data, type, row) {
                                if (type === 'display' || type === 'filter') {
                                    return data.slice(0, 10);
                                } else {
                                    return data;
                                }
                            }
                        },
                        {
                            data: 'barcode',
                            title: 'Barcode'
                        },
                        {
                            data: 'p_id',
                            title: 'P-Invoice'
                        },
                        {
                            data: 'name',
                            title: 'Vendor Name'
                        },
                        {
                            data: 'detail',
                            title: 'Detail'
                        },
                        {
                            data: 'type',
                            title: 'Type'
                        },
                        {
                            data: 'price_per',
                            title: 'Price Per'
                        },
                        {
                            data: 'total_quantity',
                            title: 'Quantity'
                        },
                        {
                            data: 'total_weight',
                            title: 'Weight'
                        },
                        {
                            data: 'rate',
                            title: 'Rate'
                        },
                        {
                            data: 'total_amount',
                            title: 'Total'
                        }
                    ],
                    responsive: true
                });
            }
        });
    }

    $(document).ready(function() {
        GetData();
    });
</script>