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
                            <div class="row mb-2">
                                <label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Vendor:</label>
                                <div class="col-sm-3">

                                    <select id="select-vendor" placeholder="Pick a vendor...">
                                        <option value="">Select a vendor...</option>

                                    </select>
                                </div>
                            </div>
                            <div class="card ">
                                <div class="card-header card border border-danger">
                                    <h4 class="card-title">
                                        STONE SETTER DEPARTMENT
                                    </h4>

                                </div>
                                <div class="card-body p-4 ">

                                    <div class="row">

                                        <div class="col-lg-12 ms-lg-auto ">
                                            <div class="mt-4 mt-lg-0">


                                                <form id="form" method="POST" enctype="multipart/form-data">
                                                    <?php

                                                    $randomNumber = random_int(0000000000, 669900000000);
                                                    echo "<input type='hidden' name='barcode' value='$randomNumber' class='form-control'>";
                                                    ?>
                                                    <div class="row mb-4">
                                                        <label for="date" class="ps-md-5 col-sm-1 col-form-label">Date:</label>
                                                        <div class="col-sm-5">

                                                            <input type="date" id="date" name="date" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-4">

                                                        <label for="name" class="ps-md-5 col-sm-1 col-form-label">Name:</label>
                                                        <div class="col-sm-5">

                                                            <input type="text" name="name" id="name" value="" class="form-control" placeholder="Name" required>
                                                        </div>


                                                        <label for="id" class="ps-md-5 col-sm-1 col-form-label">Id:</label>

                                                        <div class="col-sm-5">


                                                            <input type="text" name="id" id="id" value="" class="form-control" placeholder="Id" readonly>

                                                        </div>
                                                    </div>
                                                    <h6>By Default</h6>
                                                    <div class="ms-md-5">
                                                        <div class="row mb-4 ms-md-3">
                                                            <label for="18k" class="ps-md-5 col-sm-1 col-form-label">18k:</label>
                                                            <div class="col-sm-5">

                                                                <input type="number" name="18k" id="18k" step="any" class="form-control" required>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-4 ms-md-3">
                                                            <label for="21k" class="ps-md-5 col-sm-1 col-form-label">21k:</label>
                                                            <div class="col-sm-5">

                                                                <input type="number" name="21k" id="21k" step="any" class="form-control" required>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-4 ms-md-3">
                                                            <label for="22k" class="ps-md-5 col-sm-1 col-form-label">22k:</label>
                                                            <div class="col-sm-5">

                                                                <input type="number" name="22k" id="22k" step="any" class="form-control" required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row justify-content-end">
                                                        <div class="col-sm-9 d-flex justify-content-end me-4">


                                                            <button type="button" id="delete" class="btn btn-danger px-3 me-3 disabled" onclick="Delete()">Delete</button>
                                                            <button type="submit" class="btn btn-success px-4">Save</button>

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

    <script>
        function GetValue(id) {
            var delete1=document.getElementById("delete");
            $.ajax({
                url: "functions.php",
                method: "POST",
                data: {
                    function: "GetVendor",
                    id: id
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    delete1.classList.remove("disabled");
                    document.getElementById("id").value = data[0].id;
                    document.getElementById("name").value = data[0].name;
                    document.getElementById("18k").value = data[0]['18k'];
                    document.getElementById("21k").value = data[0]['21k'];
                    document.getElementById("22k").value = data[0]['22k'];
                    document.getElementById("name").readOnly = true;
                }
            });
        }

        function Delete() {
            var id = document.getElementById("id").value;
            $.ajax({
                url: "functions.php",
                method: "POST",
                data: {
                    function: "VendorDelete",
                    id: id
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    if (data[0] == "success") {
                        Swal.fire({
                            title: 'Deleted!',
                            text: 'Stone Setter Deleted Successfully',
                            icon: 'success',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "stone-setter.php";
                            }
                        })
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Something went wrong.',
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        })
                    }
                }
            });
        }

        function getInitials() {
            var fullName = document.getElementById("name").value;
            const words = fullName.trim().split(" ");

            for (let i = 0; i < words.length; i++) {
                words[i] = words[i][0].toUpperCase() + words[i].slice(1);
            }

            // join the capitalized words back into a single string
            const capitalizedFullName = words.join(" ");
            document.getElementById("name").value = capitalizedFullName;

            var nameParts = fullName.split(" ");
            var initials = "";
            for (var i = 0; i < nameParts.length; i++) {
                if (nameParts[i]) {
                    initials += nameParts[i].charAt(0);
                }
            }
            $.ajax({
                url: "functions.php",
                method: "POST",
                data: {
                    function: "VendorCount"
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    var code = data[0];
                    document.getElementById("id").value = initials.toUpperCase() + code;

                }
            })

        }
        $(document).ready(function() {
            $('select').selectize({
                sortField: 'text'
            });
            $.ajax({
                url: "functions.php",
                method: "POST",
                data: {
                    function: "GetAllVendorData",
                    type:"stone setter"
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
            })


            var date = new Date().toISOString().slice(0, 10);
            var dataInputs = document.querySelectorAll('input[type="date"]');
            for (let i = 0; i < dataInputs.length; i++) {
                dataInputs[i].value = date;
            }
        });
        $(document).on('blur', '#name', function(e) {
            e.preventDefault();
            getInitials();
        });

        $(document).on('change', '#select-vendor', function(e) {
            e.preventDefault();
            GetValue($(this).val());
        });

        var form = document.getElementById("form");
        form.addEventListener("submit", function(event) {
            event.preventDefault();
            var select = $('#select-vendor')[0].selectize;
            var id1 = select.getValue();
            var id = document.getElementById("id").value;
            if (id1 === id) {
                var data = new FormData(form);
                data.append("function", "UpdateVendor");
                data.append("type", "stone setter");
                $.ajax({
                    url: "functions.php",
                    method: "POST",
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        var data = JSON.parse(response);
                        if (data[0] == "success") {
                            Swal.fire({
                                title: 'Success!',
                                text: 'Stone Setter Updated Successfully',
                                icon: 'success',
                                confirmButtonText: 'Ok'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "stone-setter.php";
                                }
                            })
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Something Went Wrong',
                                icon: 'error',
                                confirmButtonText: 'Ok'
                            })
                        }
                    }
                })
            } else {

                var data = new FormData(form);
                data.append("function", "AddVendor");
                data.append("type", "stone setter");
                $.ajax({
                    url: "functions.php",
                    method: "POST",
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        var data = JSON.parse(response);
                        if (data[0] == "success") {
                            Swal.fire({
                                title: 'Success!',
                                text: 'Stone Setter Added Successfully',
                                icon: 'success',
                                confirmButtonText: 'Ok'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "stone-setter.php";
                                }
                            })
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Something Went Wrong',
                                icon: 'error',
                                confirmButtonText: 'Ok'
                            })
                        }
                    }
                })
            }
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