<?php include 'layouts/session.php';

// Include config file
require_once "layouts/config.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>
<?php include 'layouts/head-main.php'; ?>

<head>

    <title>Manage Role For User</title>
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
                        <h4 class="page-title mb-0 font-size-18">SELECT ACTIVITY FOR ROLE</h4>
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
            <div class="row">


                <?php
                $user_id = $_GET['id'];

                //Already existing roles
                $stmt = $pdo->prepare("SELECT tbl_role.role_id, role_prev_title 
                    FROM tbl_role INNER JOIN tbl_user_role ON tbl_role.role_id = tbl_user_role.role_id WHERE tbl_user_role.user_id = $user_id");
                $stmt->execute();
                $row = $stmt->fetchAll();


                $stmt = $pdo->prepare("SELECT role_id, role_prev_title FROM tbl_role");
                $stmt->execute();
                $row2 = $stmt->fetchAll();
                ?>


            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <!-- <h4 class="card-title">Validation type</h4>
                                    <p class="card-title-desc">Parsley is a javascript form validation library. It helps you provide your users with feedback on their form submission before sending it to your server.</p> -->

                            <form class="custom-validation" action="user_edit_db.php" method="post" enctype="multipart/form-data">

                                <div class="form-group mb-0">


                                    <div class="mb-3 <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">

                                        <label for="choices-multiple-default" class="form-label font-size-13 text-muted">Roles</label>
                                        <select class="form-control" data-trigger name="roles[]" id="choices-multiple-default" placeholder="This is a placeholder" multiple>
                                            <?php foreach ($row as $output) { ?>
                                                <option value="<?php echo $output['role_id']; ?>" <?php echo ' selected="selected"'; ?>> <?php echo $output['role_prev_title']; ?>
                                                </option>
                                            <?php
                                            } ?>

                                            <?php foreach ($row2 as $output) { ?>
                                                <option value="<?php echo $output['role_id']; ?>"> <?php echo $output['role_prev_title']; ?> </option>
                                            <?php
                                            } ?>



                                        </select>

                                    </div>


                                    <input id="id" name="id" type="hidden" value="<?php echo $_GET['id']; ?>">

                                </div>

                                <br>

                                <div class="form-group mb-0">
                                    <div>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                            Submit
                                        </button>
                                        <button type="reset" class="btn btn-secondary waves-effect">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

            </div>
            <!-- end row -->
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