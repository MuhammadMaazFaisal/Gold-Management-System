<?php include 'layouts/session.php';

// Include config file
require_once "layouts/config.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if(!isset($_SESSION['VU']))
{
  //User not logged in. Redirect them back to the error page.
  header('Location: pages-403.php');
  exit; 
}
?>
<?php include 'layouts/head-main.php'; ?>

<head>

    <title>View Cash Details</title>
    <?php include 'layouts/head.php'; ?>

    <!-- choices css -->
    <link href="assets/libs/choices.js/public/assets/styles/choices.min.css" rel="stylesheet" type="text/css" />

    <!-- color picker css -->
    <link rel="stylesheet" href="assets/libs/@simonwep/pickr/themes/classic.min.css" /> <!-- 'classic' theme -->
    <link rel="stylesheet" href="assets/libs/@simonwep/pickr/themes/monolith.min.css" /> <!-- 'monolith' theme -->
    <link rel="stylesheet" href="assets/libs/@simonwep/pickr/themes/nano.min.css" /> <!-- 'nano' theme -->

    <!-- datepicker css -->
    <link rel="stylesheet" href="assets/libs/flatpickr/flatpickr.min.css">

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

        <div class="page-content">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="page-title mb-0 font-size-18"> </h4>
                        <!-- <div class="page-title-right">
    										<ol class="breadcrumb m-0">
    											<li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
    											<li class="breadcrumb-item active">Profile</li>
    										</ol>
    									</div> -->
                    </div>
                </div>
            </div>
            <!-- end page title -->


            <!-- Start row -->
            <form id="form-horizontal" class="form-horizontal form-wizard-wrapper">

                <h3>CASH ACCOUNT DETAILS</h3>
                <fieldset>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    
                                    <?php


                                    $sql = "SELECT * FROM `cashaccount`";
                                    $stmt = $pdo->prepare($sql);
                                    if ($stmt->execute()) {

                                    ?>

                                        <table id="datatable" class="display table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" role="grid">
                                            <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Name</th>
                                                    <th>Amount</th>
                                                    <th>Action</th>

                                                </tr>
                                            </thead>

                                            <tbody>

                                                <tr>


                                                    <?php while ($row = $stmt->fetch()) {
                                                    ?>
                                                        <td><?php echo $row["date"] . " "; ?></td>
														<td><?php echo $row["name"]; ?></td>
														<td><?php echo $row["amount"]; ?></td>
														<td><a class="btn btn-info btn-sm" href="cash_account_edit.php?id=<?php echo $row["caID"]; ?>">Edit</a> | <a class="btn btn-danger btn-sm m-1" href="cash_account_delete.php?id=<?php echo $row["caID"]; ?>">Delete</a></td>




                                                </tr>



                                            <?php } ?>

                                            </tbody>
                                        </table>
                                </div>
                            <?php } ?>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                </fieldset>

             

                <!-- end yaha row -->

                <!-- end row -->

            </form>
            <!-- End row -->

        </div>
        <!-- End Page-content -->


        <!-- Footer Start -->
        <?php include 'layouts/footer.php'; ?>
        <!-- Footer End -->


    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->


<!-- Right Sidebar -->
<?php include 'layouts/right-sidebar.php'; ?>
<!-- /Right-bar -->

<!-- JAVASCRIPT -->

<?php include 'layouts/vendor-scripts.php'; ?>


<!-- Required datatable js -->
<script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="assets/libs/jszip/jszip.min.js"></script>
<script src="assets/libs/pdfmake/build/pdfmake.min.js"></script>
<script src="assets/libs/pdfmake/build/vfs_fonts.js"></script>
<script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

<!-- Responsive examples -->
<script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

<!-- Datatable init js -->
<script src="assets/js/pages/datatables.init.js"></script>




<!-- choices js -->
<script src="assets/libs/choices.js/public/assets/scripts/choices.min.js"></script>

<!-- color picker js -->
<script src="assets/libs/@simonwep/pickr/pickr.min.js"></script>
<script src="assets/libs/@simonwep/pickr/pickr.es5.min.js"></script>

<!-- datepicker js -->
<script src="assets/libs/flatpickr/flatpickr.min.js"></script>

<!-- init js -->
<script src="assets/js/pages/form-advanced.init.js"></script>

<script src="assets/js/app.js"></script>


<script>

$(document).ready(function() {

$('#datatable1').DataTable();
$('#datatable2').DataTable();
$('#datatable3').DataTable();
$('#datatable4').DataTable();
$('#datatable5').DataTable();
$('#datatable6').DataTable();
$('#datatable7').DataTable();

//Buttons examples
var table = $('#datatable-buttons').DataTable({
    lengthChange: false,
    buttons: ['copy', 'excel', 'pdf', 'colvis']
});

table.buttons().container()
    .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');

$(".dataTables_length select").addClass('form-select form-select-sm');
});
</script>

</body>

</html>