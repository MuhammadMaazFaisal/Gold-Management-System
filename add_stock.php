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
                                                <div class="row mb-4">
                                                    <label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">S-Invoice:</label>
                                                    <div class="col-sm-2">
                                                        <input type="text" name="s-invoice" id="s-invoice" class="form-control" placeholder="S-Invoice" readonly>
                                                    </div>
                                                    <label for="select-type" class="col-sm-1 col-form-label d-flex justify-content-end">P-Invoice:</label>
                                                    <div class="col-sm-2">


                                                        <input type="text" name="invoice" id="invoice" class="form-control" placeholder="P-Invoice" readonly>
                                                    </div>
                                                    <label for="vendor_id" class="col-sm-1 col-form-label d-flex justify-content-end">Vendor Id:</label>
                                                    <div class="col-sm-2">

                                                        <input type="text" value="" id="vendor_id" name="vendor_id" class="form-control" placeholder="Vendor Id" readonly>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <button id="select-invoice" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#invoice-modal">
                                                            Select Invoice
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="existing_stock" class="d-none col-lg-12 ms-lg-auto ">
                                            <div class="mt-4 mt-lg-0">


                                                <form id="stock-form" method="POST" enctype="multipart/form-data">

                                                    <div class="table-responsive">
                                                        <table class="table text-center">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">#</th>
                                                                    <th scope="col">Detail</th>
                                                                    <th colspan="2">Type</th>
                                                                    <th colspan="2">Price Per</th>
                                                                    <th scope="col">Quantity</th>
                                                                    <th scope="col">Weight</th>
                                                                    <th scope="col">Rate</th>
                                                                    <th scope="col">Total Amount</th>
                                                                    <th scope="col">Barcode</th>
                                                                    <th scope="col"></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="e-tbody">

                                                            </tbody>
                                                        </table>

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
                <form id="filter-form" method="POST" enctype="multipart/form-data">
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
                            <input type="text" name="invoice" id="m-invoice" value="" class="form-control" placeholder="Invoice" readonly>
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
                            <th scope="col">Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="modal-tbody">
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
            }
        });
    }

    function GetInvoices() {
        $.ajax({
            url: "functions.php",
            method: "POST",
            data: {
                function: "GetInvoices"
            },
            success: function(response) {
                data = JSON.parse(response);
                tbody = document.getElementById("modal-tbody");
                for (i = 0; i < data.length; i++) {
                    value = `<tr id="${data[i].id}">
                            <th scope="row">${i+1}</th>
                            <td>${data[i].id}</td>
                            <td>${data[i].vendor_id}</td>
                            <td>${data[i].name}</td>
                            <td>Rs ${data[i].total}</td>
                            <td>${data[i].date}</td>
                            <td>
                                <button type="button" onclick="SelectInvoice(this)" class="btn btn-primary" >
                                    Select
                            </td>
                        </tr>`
                    tbody.innerHTML += value;
                }

            }
        });
    }

    function SelectInvoice(btn) {
        invoice = btn.parentNode.parentNode.id;
        vendor_id = btn.parentNode.parentNode.children[2].innerHTML;
        $("#invoice-modal").modal("hide");
        document.getElementById("invoice").value = invoice;
        document.getElementById("vendor_id").value = vendor_id;
        document.getElementById("existing_stock").classList.remove("d-none");
        GetProductDetails(invoice);

    }

    function GetProductDetails(invoice) {
        $.ajax({
            url: "functions.php",
            method: "POST",
            data: {
                function: "GetStockCount"
            },
            success: function(response) {
                response = JSON.parse(response);
                document.getElementById("s-invoice").value = response;
            }
        });

        $.ajax({
            url: "functions.php",
            method: "POST",
            data: {
                function: "GetProductDetails",
                id: invoice
            },
            success: function(response) {
                data = JSON.parse(response);
                console.log(data);
                tbody = document.getElementById("e-tbody");
                tbody.innerHTML = "";
                for (i = 0; i < data.length; i++) {
                    value = `<tr>
                                <td scope="row">1</td>
                                <td><textarea type="text" name="detail[]" id="detail[]" class="form-control" style="height: 20px;" placeholder="Details">${data[i].detail}</textarea></td>
                                <td colspan="2"><input type="text" class="form-control" id="type[]" name="type[]" value="${data[i].type}" placeholder="Type" readonly></td>
                                <td colspan="2"><input type="text" class="form-control" id="price_per[]" name="price_per[]" value="${data[i].price_per}" readonly></td>
                                <td> <input type="number" placeholder="${data[i].remaining_quantity}" id="quantity[]" name="quantity[]" class="form-control"></td>
                                <td> <input type="number" step="any" placeholder="${data[i].remaining_weight}" id="weight[]" name="weight[]" class="form-control"></td>
                                <td><input type="number" step="any" value="${data[i].rate}" id="rate[]" name="rate[]" class="form-control" readonly></td>
                                <td><input type="number" step="any" placeholder="${data[i].remaining_total_amount}" id="total[]" name="total[]" class="form-control"></td>
                                <td><input id="barcode[]" name="barcode[]" value="" type="text" class="form-control" readonly></td>
                                <td><div class="pt-2 form-check">
                                    <input class="form-check-input" type="checkbox" name="checkbox[]" id="checkbox[]">
                                </div></td>
                                
                                <td class="d-none"><input type="number" class="form-control" id="pd_id[]" name="pd_id[]" value="${data[i].id}" readonly></td>
                            </tr>`
                    tbody.innerHTML += value;
                }
                const checkbox = document.querySelectorAll('input[id="checkbox[]"]');
                for (let i = 0; i < checkbox.length; i++) {
                    checkbox[i].addEventListener("change", function() {
                        if (this.checked) {
                            GenerateBarcode(this);
                        } else {
                            this.parentNode.parentNode.previousElementSibling.children[0].value = "";
                        }
                    });
                }

            }
        });
    }

    function GenerateBarcode(btn) {
        unique = Math.floor(new Date().getTime() + Math.random());
        btn.parentNode.parentNode.previousElementSibling.children[0].value = unique;

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

    // $(document).on("submit", "#filter-form", function(e) {
    //     e.preventDefault();
    //     getFilteredData(this);
    // });

    $(document).on("submit", "#stock-form", function(e) {
        e.preventDefault();
        checkbox = document.querySelectorAll('input[id="checkbox[]"]');
        checkbox_values = [];
        for (let i = 0; i < checkbox.length; i++) {
            if (checkbox[i].checked) {
                checkbox_values.push(i);
            }
        }
        s_invoice = document.getElementById("s-invoice").value;
        p_id = document.getElementById("invoice").value;
        var formData = new FormData(this);
        formData.append("function", "AddStock");
        formData.append("checkbox_values", JSON.stringify(checkbox_values));
        formData.append("s_invoice", s_invoice);
        formData.append("p_id", p_id);
        $.ajax({
            url: "functions.php",
            method: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log(response);
                data = JSON.parse(response);
                if (data[0] == "success" && data[0] == "success") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Stock Added Successfully',
                        showConfirmButton: false,
                        timer: 1500
                    })
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

    $(document).ready(function() {
        $(".clickable-row").click(function() {
            $(this).next(".hidden-row").toggle();
        });

        $("#select-invoice").click(GetInvoices());
    });
</script>