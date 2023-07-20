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

                    <div class="col-xl-12">

                        <?php if (isset($_SESSION['additional_manu'])) { ?>

                            <div class="row">
                                <div class="col-lg-12">

                                    <div class="card ">
                                        <div class="card-header card border border-info">

                                            <h4 class="card-title">
                                                Issue Cash


                                            </h4>

                                        </div>
                                        <div class="col d-flex justify-content-end me-4">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" onclick="SelectMetal()" data-bs-target="#product-modal">
                                                Show History
                                            </button>
                                        </div>
                                        <div class="card-body p-4 ">


                                            <div class="row">

                                                <div class="col-lg-12 ms-lg-auto ">

                                                    <div class="mt-4 mt-lg-0">


                                                        <form id="form" method="POST" enctype="multipart/form-data">
                                                            <?php
                                                            $randomgold = random_int(0000000000, 929900000000);
                                                            echo "<input type='hidden' name='goldbarcode' value='$randomgold' class='form-control'>";
                                                            ?>
                                                            <input style="display: none;" type="number" step="any" name="product_id" id="product_id" class="form-control">
                                                            <div class="row mb-4">
                                                                <label for="date" class="col-sm-1 col-form-label">Date:</label>
                                                                <div class="col-sm-5">
                                                                    <input type="date" name="date" id="date" class="form-control" placeholder="Date">
                                                                </div>
                                                                <label for="vendor" class="col-sm-1 col-form-label">Name:</label>
                                                                <div class="col-sm-5">
                                                                    <select id="vendor" name="vendor" required class="form-control form-select"></select>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-4">
                                                                <label for="amount" class="col-sm-1 col-form-label">Amount:</label>
                                                                <div class="col-sm-11">
                                                                    <input type="number" step="any" name="amount" id="amount" class="form-control" placeholder="Amount">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-4">
                                                                <label for="detail" class="col-sm-1 col-form-label">Details:</label>
                                                                <div class="col-sm-11">
                                                                    <textarea type="text" name="detail" id="detail" class="form-control" style="height: 107px;" placeholder="Details"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-5">

                                                                <div class="row d-flex justify-content-end">
                                                                    <div class="d-flex justify-content-end">
                                                                        <button type="button" class="btn btn-primary mx-1" onclick="Print()">Print</button>
                                                                        <button type="button" class="btn btn-danger mx-1" onclick="Delete()">Delete</button>
                                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                                    </div>
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
                            <!-- end card -->

                        <?php } // Super Admin 
                        ?>
                    </div>
                </div>
                <!-- End Page-content -->


            <?php } // Super Admin 
            ?>





            <?php include 'layouts/footer.php'; ?>
            <!-- Modal -->
            <div class="modal fade" id="product-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">History</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <table id="product-table" class="table table-hover ">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Product ID</th>
                                        <th scope="col">Vendor ID</th>
                                        <th scope="col">Vendor Name</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="product-table-body">

                                </tbody>
                            </table>
                        </div>
                        <div id="input-div" class="row d-none">
                            <div class="col-3">
                                <label for="total_issued_weight" class="form-label">Total Pure Weight:</label>
                            </div>
                            <div class="col-3">
                                <input type="number" step="any" id="total_pure_weight" class="form-control" placeholder="Total Pure Weight">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- Right Sidebar -->
    <?php include 'layouts/right-sidebar.php'; ?>
    <!-- /Right-bar -->

    <!-- JAVASCRIPT -->
    <?php include 'layouts/vendor-scripts.php'; ?>

    <script>
        $(document).on('click', '.select-btn', function() {
            var productId = $(this).data('product-id');
            var vendorId = $(this).data('vendor-id');
            var date = $(this).data('date');
            var amount = parseFloat($(this).data('amount')); // Convert to a float value
            var details = $(this).data('details');

            // Set the values to the corresponding input elements by ID
            $('#product_id').val(productId);
            var select_manufacturer = $('#vendor')[0].selectize;
            select_manufacturer.setValue(vendorId);
            $('#date').val(date);
            $('#amount').val(amount);
            $('#detail').val(details);


            // Close the modal
            $('#product-modal').modal('hide');
        });

        function SelectMetal() {
            $.ajax({
                url: "functions.php",
                type: "POST",
                data: {
                    function: "SelectCash",
                    type: "issued"
                },
                success: function(data) {
                    console.log(data);  
                    data = JSON.parse(data);
                    console.log(data);
                    if (data.records.length > 0) {
                        let table_body = document.getElementById('product-table-body');
                        table_body.innerHTML = '';
                        for (i = 0; i < data.records.length; i++) {
                            let row = `
							<tr>
							<td>${data.records[i].id}</td>
							<td>${data.records[i].id}</td>
							<td>${data.records[i].vendor_id}</td>
							<td>${data.records[i].name}</td>
							<td>${data.records[i].amount}</td>
							<td>${data.records[i].date}</td>
							<td><button class="btn btn-primary select-btn" data-product-id="${data.records[i]['id']}" data-vendor-id="${data.records[i]['vendor_id']}" data-vendor-name="${data.records[i]['name']}" data-date="${data.records[i]['date']}" data-amount="${data.records[i]['amount']}" data-details="${data.records[i]['details']}">Select</button></td>
							</tr>
							`;
                            table_body.innerHTML += row;
                        }
                    } else {
                        let table_body = document.getElementById('product-table-body');
                        table_body.innerHTML = '';
                        let row = `
						<tr>
						<td colspan="9" class="text-center">No records found</td>
						</tr>
						`;
                        table_body.innerHTML += row;
                    }
                }
            });
        }

        function Delete() {
            let product = $('#product_id').val();
            if (product == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please select a product from history to delete!',
                })
                return;
            } else {
                $.ajax({
                    url: "functions.php",
                    type: "POST",
                    data: {
                        function: "DeleteCash",
                        id: product
                    },
                    success: function(data) {
                        console.log(data);
                        data = JSON.parse(data);
                        if (data.status == 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Cash Record deleted successfully!',
                            })
                            location.reload();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!',
                            })
                        }
                    }
                });
            }
        }

        function Print() {
            let printWindow = window.open("", "_blank");

            // Generate slip content
            let slipContent = `
                <!DOCTYPE html>
                <html>
                <head>
                <style>
                    @media print {
                        @page {
                            size: 80mm 200mm;
                            margin: 0;
                        }

                        body {
                            font-family: Arial, sans-serif;
                            font-size: 12px;
                            padding: 10px;
                        }

                        h1 {
                            font-size: 16px;
                            text-align: center;
                            margin: 10px 0;
                            color: #333;
                        }

                        p {
                            margin-bottom: 5px;
                        }

                        .label {
                            font-weight: bold;
                        }
                    }
                </style>
                </head>
                <body>
                <p><span class="label" style="margin-right:6px";>Date:</span><span>${$('#date').val()}</span></p>
                <p><span class="label" style="margin-right:6px";>Vendor ID:</span><span>${$("#vendor").selectize()[0].selectize.getValue()}</span></p>
                <p><span class="label" style="margin-right:6px";>Detail:</span><span>${$('#detail').val()}</span></p>
                <p><span class="label" style="margin-right:6px";>Amount:</span><span>${$('#amount').val()}</span></p>
                </body>
                </html>
            `;

            // Write slip content to the new tab
            printWindow.document.open();
            printWindow.document.write(slipContent);
            printWindow.print();
            printWindow.document.close();



        }

        function GetDate() {
            var date = new Date().toISOString().slice(0, 10);
            var dataInputs = document.querySelectorAll('input[type="date"]');
            for (let i = 0; i < dataInputs.length; i++) {
                if (dataInputs[i].id !== 'from-date' && dataInputs[i].id !== 'to-date') {
                    dataInputs[i].value = date;
                }
            }
        }


        $(document).ready(function() {
            GetDate();

            $('select').selectize({
                sortField: 'text'
            });

            $.ajax({
                url: "functions.php",
                method: "POST",
                data: {
                    function: "GetCashVendors"
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    var select = $('#vendor')[0].selectize;
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

        $('#form').on('submit', function(e) {
            e.preventDefault();
            var form = new FormData(this);
            form.append('function', 'CashRecord');
            form.append('type', 'issued');
            $.ajax({
                url: "functions.php",
                method: "POST",
                data: form,
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    var data = JSON.parse(response);
                    if (data[0] == "success") {
                        Swal.fire({
                            title: "Success!",
                            text: "Record Saved Successfully",
                            icon: "success",
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Something went wrong.',
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    }
                }
            });
        });
    </script>




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