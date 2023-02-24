<?php include 'layouts/session.php';

// Include config file
require_once "layouts/config.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if(!isset($_SESSION['VR']))
{
  //User not logged in. Redirect them back to the error page.
  header('Location: pages-403.php');
  exit; 
}
?>
<?php include 'layouts/head-main.php'; ?>

<head>

    <title>Roles | XML Workflow</title>
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
                        <!--
    									<div class="page-title-right">
    										<ol class="breadcrumb m-0">
    											<li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
    											<li class="breadcrumb-item active">Profile</li>
    										</ol>
    									</div>
    								-->
                    </div>
                </div>
            </div>
            <!-- end page title -->


            <!-- Start row -->
            <form id="form-horizontal" class="form-horizontal form-wizard-wrapper">


                <h3>Roles</h3>
                <fieldset>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <a class="btn btn-primary btn-lg waves-effect waves-light bx bx-add-to-queue" href="UM_auth-add-roles.php">Add Role</a> <br><br>
                                    <?php
                                    $sql = "SELECT * FROM  Roles";
                                    $stmt = $pdo->prepare($sql);
                                    if ($stmt->execute()) {  ?>
                                        <table id="datatable" class="display table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" role="grid">
                                            <thead>
                                                <tr>
                                                    <th>Role</th>
                                                    <th>Description</th>
                                                    <th>Status</th>
                                                    <th>Added By</th>

                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php while ($row = $stmt->fetch()) { ?>
                                                    <tr>
                                                        <td><?php echo $row["RoleName"] . " "; ?></td>
                                                        <td><?php echo $row["RoleDescription"]; ?></td>
                                                        <td><?php echo $row["Status"]; ?></td>
                                                        <td><?php echo $row["AddedBy"]; ?></td>
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
                <h3>Roles - Activities</h3>
                <fieldset>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <?php
                                    $sql = "  SELECT r.AddedBy, r.RoleName AS role_title, r.RoleID AS role_id, 
                    GROUP_CONCAT( DISTINCT SystemActivityID SEPARATOR ',' ) AS activity FROM Roles AS r LEFT JOIN RoleSystemActivities AS ra 
                    ON r.RoleID = ra.RoleID GROUP BY r.RoleID";
                                    $stmt = $pdo->prepare($sql);
                                    if ($stmt->execute()) {
                                    ?>
                                        <table id="datatable" class="display table table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <!-- <table id="datatable" class="display table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" role="grid">    -->
                                            <thead>
                                                <tr>
                                                    <th>Role </th>
                                                    <th>Activity</th>
                                                    <th>Added By</th>
                                                    <!-- <th>Date</th> -->
                                                    <th>Action</th>

                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php while ($row = $stmt->fetch()) { ?>
                                                    <tr>
                                                        <td> <?php echo $row["role_title"]; ?> </td>

                                                        <td><?php if ($row["activity"] != "") {
                                                                $role_ids = $row["activity"];
                                                                $role_ids_arr = explode(",", $role_ids);
                                                                $res = "";
                                                                foreach ($role_ids_arr as $id) {
                                                                    $stmtr = $pdo->prepare("SELECT SystemActivityName FROM SystemActivities WHERE SystemActivityID =$id");
                                                                    $stmtr->execute();
                                                                    $rowr = $stmtr->fetch();

                                                                    $res .= $rowr["SystemActivityName"] . " ,";
                                                                }
                                                                $final = "";
                                                                $res = substr_replace($res, "", -1);

                                                                echo wordwrap($res, 180, "<br>\n");
                                                            }   ?></td>

                                                        <td><?php echo $row["AddedBy"]; ?></td>
                                                        <!-- <td><?php echo $row["sys_date"]; ?></td> -->
                                                        <td><a class="btn btn-info btn-sm" href="UM_edit_activity.php?id=<?php echo $row["role_id"]; ?>">Modify</a></td>
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
                </fieldset>
                <!-- end row -->

                <h3>Roles - Processing Stages</h3>
                <fieldset>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <?php
                                    $sql = "  SELECT r.AddedBy, r.RoleName AS role_title, r.RoleID AS role_id, 
                    GROUP_CONCAT( DISTINCT ProcessingStageID SEPARATOR ',' ) AS activity FROM Roles AS r LEFT JOIN RoleProcessingStages AS ra 
                    ON r.RoleID = ra.RoleID GROUP BY r.RoleID";
                                    $stmt = $pdo->prepare($sql);
                                    if ($stmt->execute()) {
                                    ?>
                                        <table id="datatable" class="display table table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <!-- <table id="datatable" class="display table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" role="grid">    -->
                                            <thead>
                                                <tr>
                                                    <th>Role </th>
                                                    <th>Processing Stage</th>
                                                    <th>Added By</th>
                                                    <!-- <th>Date</th> -->
                                                    <th>Action</th>

                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php while ($row = $stmt->fetch()) { ?>
                                                    <tr>
                                                        <td> <?php echo $row["role_title"]; ?> </td>

                                                        <td><?php if ($row["activity"] != "") {
                                                                $role_ids = $row["activity"];
                                                                $role_ids_arr = explode(",", $role_ids);
                                                                $res = "";
                                                                foreach ($role_ids_arr as $id) {
                                                                    $stmtr = $pdo->prepare("SELECT ProcessingStageName FROM ProcessingStages WHERE ProcessingStageID =$id");
                                                                    $stmtr->execute();
                                                                    $rowr = $stmtr->fetch();

                                                                    $res .= $rowr["ProcessingStageName"] . " ,";
                                                                }
                                                                $final = "";
                                                                $res = substr_replace($res, "", -1);

                                                                echo wordwrap($res, 50, "<br>\n");
                                                            }   ?></td>

                                                        <td><?php echo $row["AddedBy"]; ?></td>
                                                        <!-- <td><?php echo $row["sys_date"]; ?></td> -->
                                                        <td><a class="btn btn-info btn-sm" href="UM_roles_processing_stage.php?id=<?php echo $row["role_id"]; ?>">Modify</a></td>
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
                </fieldset>
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

</body>

</html>