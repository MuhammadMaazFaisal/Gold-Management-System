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

    .column-border {
        border-left: 2px solid black;
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
                                        Manufacturer Report
                                    </h4>

                                </div>
                                <div class="card-body px-4 ">

                                    <div class="row">
                                        <label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Name:</label>
                                        <div class="col-sm-5">

                                            <select id="select-vendor" name="vendor_id" placeholder="Pick a manufacturer..." required>
                                                <option value="">Select a manufacturer...</option>

                                            </select>
                                        </div>
                                        <div class="col-lg-12 ms-lg-auto ">
                                            <div class="mt-4 mt-lg-0 table-responsive">

                                                <table id="manufacturer-table" class="table table-hover">
                                                    <thead class="table-dark">
                                                    </thead>
                                                    <tbody id="tbody">
                                                    </tbody>
                                                </table>

                                            </div>
                                            <div class="row mb-4 justify-content-end">
                                                <div class="col-sm-2">

                                                    <input type="number" step="any" name="total_metal_issued" value="" id="total_metal_issued" class="form-control form-control card d-none" placeholder="Total Metal">
                                                </div>
                                                <div class="col-sm-2">

                                                    <input type="number" name="total_metal_recieved" value="" id="total_metal_recieved" class="form-control form-control card d-none" placeholder="Total Jewellery">
                                                </div>
                                                <div class="col-sm-2">

                                                    <input type="number" name="payable" value="" id="payable" class="form-control form-control card bg-dark border-dark text-light d-none" placeholder="payable">
                                                </div>
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
    function CalculateTotal() {
        jewellery = document.getElementsByClassName('jewellery');
        metal = document.getElementsByClassName('metal');
        var total_jewellery = 0;
        var total_metal = 0;
        for (var i = 1; i < jewellery.length; i++) {
            if (jewellery[i].innerHTML != "") {
                total_jewellery += parseFloat(jewellery[i].innerHTML);
            }

        }
        for (var i = 1; i < metal.length; i++) {
            if (metal[i].innerHTML != "") {
                total_metal += parseFloat(metal[i].innerHTML);
            }
        }
        total_metal1 = document.getElementById('total_metal_issued');
        total_metal1.value = total_metal;
        total_jewellery1 = document.getElementById('total_metal_recieved');
        total_jewellery1.value = total_jewellery;
        payable = document.getElementById('payable');
        payable.value = total_jewellery - total_metal;
        total_metal1.classList.remove('d-none');
        total_jewellery1.classList.remove('d-none');
        payable.classList.remove('d-none');


    }

    function GetData(vendor_id) {
        if ($.fn.DataTable.isDataTable('#manufacturer-table')) {
            $('#manufacturer-table').DataTable().destroy();
        }
        $.ajax({
            url: "functions.php",
            type: "POST",
            data: {
                function: "GetManufacturerReportData",
                id: vendor_id
            },
            success: function(data) {
                data = JSON.parse(data);
                var table = $('#manufacturer-table').DataTable({
                    data: data,
                    columns: [{
                            data: 'date',
                            title: 'Date'
                        },
                        {
                            data: 'image',
                            title: 'Pic',
                            render: function(data, type, row, meta) {
                                return '<img src="' + data + '" width="50" height="50"/>';
                            }
                        },
                        {
                            data: 'barcode',
                            title: 'Barcode'
                        },
                        {
                            data: 'name',
                            title: 'Vendor Name'
                        },
                        {
                            data: 'details',
                            title: 'Detail'
                        },
                        {
                            data: 'type',
                            title: 'Type'
                        },
                        {
                            data: 'quantity',
                            title: 'Quantity'
                        },
                        {
                            data: 'purity',
                            title: 'purity'
                        },
                        {
                            data: 'rate',
                            title: 'Rate'
                        },
                        {
                            data: 'tValues',
                            title: '24k',
                            className: 'metal',
                        },
                        {
                            data: 'metal_pure_weight',
                            title: '24K',
                            className: 'jewellery column-border',
                            render: function(data, type, row, meta) {
                                if (row.metal_type === 'issued') {
                                    return (data);
                                } else {
                                    return (-data);
                                }
                            }
                        }
                    ]
                });
                CalculateTotal();
            }
        });
    }

    $(document).ready(function() {
        $('select').selectize({
            sortField: 'text'
        })

        $.ajax({
            url: "functions.php",
            method: "POST",
            data: {
                function: "GetAllVendorData",
                type: "manufacturer"
            },
            success: function(response) {
                var data = JSON.parse(response);
                var select = $('#select-vendor')[0].selectize;
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

    $(document).on('change', '#select-vendor', function(e) {
        e.preventDefault();
        var select1 = $(this).val();
        GetData(select1);
    });
</script>