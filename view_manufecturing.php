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

    <title>View  | Manufecturing</title>
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

                <h3>MANUFACTURING DETAILS</h3>
                <fieldset>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    
                                    <?php


                                    $sql = "SELECT * FROM `manufacturing_step` WHERE `status`='Active'";
                                    $stmt = $pdo->prepare($sql);
                                    if ($stmt->execute()) {

                                    ?>

                                        <table id="datatable" class="display table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" role="grid">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Code</th>
                                                    <th>Image</th>
                                                    <th>Details</th>
                                                    <th>Type</th>
                                                    <th>Quantity</th>
													<th>Purity </th>
													<th>Unpolish Weight</th>
													<th>Polish Weight </th>
													<th>Rate</th>
													<th>Wastage</th>
													<th>24K</th>
													<th>Action</th>

                                                </tr>
                                            </thead>

                                            <tbody>

                                                <tr>


                                                    <?php while ($row = $stmt->fetch()) {
                                                    ?>
                                                        <td><?php echo $row["name"] . " "; ?></td>


                                                        <td><?php echo $row["code"]; ?></td>

                                                        <td><img style="width: 100px;" src="<?php echo $row["image"]; ?>"/></td>
														<td><?php echo $row["details"]; ?></td>
														<td><?php echo $row["type"]; ?></td>
														<td><?php echo $row["quantity"]; ?></td>
														<td><?php echo $row["purity"]; ?></td>
														<td><?php echo $row["unpolish_weight"]; ?></td>
														<td><?php echo $row["polish_weight"]; ?></td>
														<td><?php echo $row["rate"]; ?></td>
														<td><?php echo $row["wastage"]; ?></td>
														<td><?php echo $row["tValues"]; ?></td>
													<td><a class="btn btn-info btn-sm" href="manufecturing_edit.php?id=<?php echo $row["id"]; ?>">Modify</a> | <a class="btn btn-success waves-effect waves-light me-1" href="manu-invo-print.php?id=<?php echo $row["id"]; ?>"><i class="fa fa-print"></i></a> | <a class="btn btn-danger btn-sm m-1" href="manufecturing_delete.php?id=<?php echo $row["id"]; ?>">Delete</a></td>




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

                <h3>POLISHER DETAILS</h3>
                <fieldset>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <?php
                                    $sql = "SELECT * FROM `polisher_step` WHERE `status`='Active'";
                                    $stmt = $pdo->prepare($sql);
                                    if ($stmt->execute()) {

                                    ?>
                                        <table id="datatable" class="display table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" role="grid">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Code</th>
                                                    <th>Image</th>
                                                    <th>Details</th>
                                                    <th>Difference</th>
													<th>Wastage</th>
													<th>Payable</th>
													<th>Action</th>

                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr> <?php while ($row = $stmt->fetch()) { ?>
                                                        <td><?php echo $row["name"] . " "; ?></td>
                                                        <td><?php echo $row["code"]; ?></td>
                                                        <td><img style="width: 100px;" src="<?php echo $row["image"]; ?>"/></td>
														<td><?php echo $row["details"]; ?></td>
														<td><?php echo $row["difference"]; ?></td>
														<td><?php echo $row["Wastage"]; ?></td>
														<td><?php echo $row["Payable"]; ?></td>
                                                        
												<td><a class="btn btn-info btn-sm" href="polisher_edit.php?id=<?php echo $row["id"]; ?>">Modify</a> | <a class="btn btn-success waves-effect waves-light me-1" href="polisher-invo-print.php?id=<?php echo $row["id"]; ?>"><i class="fa fa-print"></i></a> | <a class="btn btn-danger btn-sm m-1" href="polisher_delete.php?id=<?php echo $row["id"]; ?>">Delete</a></td>
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
					
					
					<h3>STONE SETTER</h3>
                <fieldset>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <?php
                                    $sql = "SELECT * FROM `stone_setter_step` WHERE `status`='Active'";
                                    $stmt = $pdo->prepare($sql);
                                    if ($stmt->execute()) {

                                    ?>
                                        <table id="datatable" class="display table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" role="grid">
                                            <thead>
                                                <tr>
                                                    <th>Date:</th>
													<th>Name:</th>
													<th>Image:</th>
													<th>Detail</th>
													<th>Issued Weight</th>
													<th>Zircon</th>
													<th>Stone Type</th>
													<th>stone_weight</th>
													<th>total</th>
													<th>Received_weight</th>
													<th>Stone_received</th>
													<th>Qty</th>
													<th>Wastage</th>
													<th>Total</th>
													<th>Payable</th>
													<th>Action</th>

                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr> <?php while ($row = $stmt->fetch()) { ?>
                                                        <td><?php echo $row["date"] . " "; ?></td>
                                                        <td><?php echo $row["name"]; ?></td>
                                                        <td><img style="width: 100px;" src="<?php echo $row["image"]; ?>"/></td>
														<td><?php echo $row["detail"]; ?></td>
														<td><?php echo $row["Issued_weight"]; ?></td>
														<td><?php echo $row["zircon"]; ?></td>
														<td><?php echo $row["stonetype"]; ?></td>
														<td><?php echo $row["stone_weight"]; ?></td>
														<td><?php echo $row["total"]; ?></td>
														<td><?php echo $row["Received_weight"]; ?></td>
														<td><?php echo $row["Stone_received"]; ?></td>
														<td><?php echo $row["Qty"]; ?></td>
														<td><?php echo $row["Wastage"]; ?></td>
														<td><?php echo $row["Total_valu"]; ?></td>
														<td><?php echo $row["Payable"]; ?></td>
												<td><a class="btn btn-info btn-sm" href="stone_edit.php?id=<?php echo $row["Ssid"]; ?>">Modify</a> | <a class="btn btn-success waves-effect waves-light me-1" href="stone_setter-invo-print.php?id=<?php echo $row["Ssid"]; ?>"><i class="fa fa-print"></i></a> | <a class="btn btn-danger btn-sm m-1" href="stone_delete.php?id=<?php echo $row["Ssid"]; ?>">Delete</a></td>
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
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
               
					<h3>ADDITIONAL MANUFACTURING</h3>
                <fieldset>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <?php
                                    $sql = "SELECT * FROM `additional_step` WHERE `status`='Active'";
                                    $stmt = $pdo->prepare($sql);
                                    if ($stmt->execute()) {

                                    ?>
                                        <table id="datatable" class="display table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" role="grid">
                                            <thead>
                                                <tr>
                                                    <th>Date:</th>
													<th>Name:</th>
													<th>Type:</th>
													<th>Amount:</th>
													<th>Action</th>

                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr> <?php while ($row = $stmt->fetch()) { ?>
                                                        <td><?php echo $row["date"] . " "; ?></td>
                                                        <td><?php echo $row["name"]; ?></td>
                                                        <td><?php echo $row["type"]; ?></td>
														<td><?php echo $row["amount"]; ?></td>
												<td><a class="btn btn-info btn-sm" href="additional_edit.php?id=<?php echo $row["id"]; ?>">Modify</a> | <a class="btn btn-success waves-effect waves-light me-1" href="additional-invo-print.php?id=<?php echo $row["id"]; ?>"><i class="fa fa-print"></i></a> | <a class="btn btn-danger btn-sm m-1" href="additional_delete.php?id=<?php echo $row["id"]; ?>">Delete</a></td>
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
                <!-- end yaha row -->
					<h3>GOLD ACCOUNT DETAILS</h3>
                <fieldset>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <?php
                                    $sql = "SELECT * FROM `gold_accont_step` WHERE `status`='Active'";
                                    $stmt = $pdo->prepare($sql);
                                    if ($stmt->execute()) {

                                    ?>
                                        <table id="datatable" class="display table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" role="grid">
                                            <thead>
                                                <tr>
                                                    <th>Date:</th>
													<th>Name:</th>
													<th>Detail:</th>
													<th>Gold Issued Weight:</th>
													<th>Purity</th>
													<th>Pure Weight issued</th>
													<th>Action</th>

                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr> <?php while ($row = $stmt->fetch()) { ?>
                                                        <td><?php echo $row["date"] . " "; ?></td>
                                                        <td><?php echo $row["name"]; ?></td>
                                                        <td><?php echo $row["detail"]; ?></td>
														<td><?php echo $row["gold_Issued_weight"]; ?></td>
														<td><?php echo $row["purity"]; ?></td>
														<td><?php echo $row["pure_weight_issued"]; ?></td>
												<td><a class="btn btn-info btn-sm" href="gold_edit.php?id=<?php echo $row["id"]; ?>">Modify</a>  | <a class="btn btn-success waves-effect waves-light me-1" href="gold-invo-print.php?id=<?php echo $row["id"]; ?>"><i class="fa fa-print"></i></a> | <a class="btn btn-danger btn-sm m-1" href="gold_delete.php?id=<?php echo $row["id"]; ?>">Delete</a></td>
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