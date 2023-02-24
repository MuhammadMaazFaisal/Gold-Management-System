<?php include 'layouts/session.php';

// Include config file
require_once "layouts/config.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (!isset($_SESSION['ERSA'])) {
    //User not logged in. Redirect them back to the error page.
    header('Location: pages-403.php');
    exit;
}
?>
<?php include 'layouts/head-main.php'; ?>

<head>

    <title>System Activities | XML Workflow</title>
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


    <?php
    $sql_activity = "SELECT *  from SystemActivities";
    $stmt2 = $pdo->prepare($sql_activity);
    $stmt2->execute();
    $activities = $stmt2->fetchAll();

    ?>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">

        

            <!-- Start row -->
            <div class="row">


                <?php
                $role_id = $_GET['id'];
                $stmt = $pdo->prepare("SELECT SystemActivities.SystemActivityID, SystemActivityName FROM SystemActivities 
                INNER JOIN RoleSystemActivities ON SystemActivities.SystemActivityID = RoleSystemActivities.SystemActivityID 
                WHERE RoleSystemActivities.RoleID=$role_id ");
                $stmt->execute();
                $row = $stmt->fetchAll();

                $stmt = $pdo->prepare("SELECT SystemActivityID, SystemActivityName FROM SystemActivities Where SystemActivityID not in 
                (SELECT SystemActivities.SystemActivityID FROM SystemActivities 
                INNER JOIN RoleSystemActivities ON SystemActivities.SystemActivityID = RoleSystemActivities.SystemActivityID 
                WHERE RoleSystemActivities.RoleID=$role_id) ");
                $stmt->execute();
                $row2 = $stmt->fetchAll();
                ?>


            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <!-- <h4 class="card-title">Validation type</h4>
                                    <p class="card-title-desc">Parsley is a javascript form validation library. It helps you provide your users with feedback on their form submission before sending it to your server.</p> -->
                            <!-- start page title -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                        <h4 class="mb-sm-0 font-size-18">SELECT ACTIVITY FOR ROLE</h4>

                                    </div>
                                </div>
                            </div>
                            <!-- end page title -->
                            <form id='target' class="custom-validation" action="UM_edit_activity_db.php" method="post" enctype="multipart/form-data">

                                <div class="form-group mb-0">


                                    <div class="mb-3 <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">

                                        <label for="choices-multiple-default" class="form-label font-size-13 text-muted">Activities</label><br>
                                        <!-- <select class="form-control" data-trigger name="activities[]" id="choices-multiple-default" placeholder="This is a placeholder" multiple> -->
                                        <?php $i = 1;
                                        foreach ($row as $output) {
                                            // if($i%3==0){echo "<br>";}
                                        ?>

                                            <!-- <div class="col-4"> -->
                                            <div class="form-check form-check-inline">
                                                <input type="checkbox" class="form-check-input" name="activities<?php echo $i; ?>" checked value="<?php echo $output['SystemActivityID']; ?>"><label> <?php echo $output['SystemActivityName']; ?></label>
                                                <input type="text" hidden name="count" value="<?php echo $i ?>">
                                            </div>

                                            <!-- </div> -->
                                            <!-- <option value="<?php echo $output['SystemActivityID']; ?>" <?php echo ' selected="selected"'; ?>> <?php echo $output['SystemActivityName']; ?> </option> -->
                                        <?php $i++;
                                        }
                                        foreach ($row2 as $output) {
                                            // if($i%3==0){echo "<br>";}
                                        ?>
                                            <!-- <div class="col-3"> -->
                                            <div class="form-check form-check-inline">
                                                <input type="checkbox" class="form-check-input" name="activities<?php echo $i; ?>" value="<?php echo $output['SystemActivityID']; ?>"><label> <?php echo $output['SystemActivityName']; ?></label>
                                                <input type="text" hidden name="count" value="<?php echo $i ?>">
                                            </div>

                                            <!-- </div> -->
                                            <?php
                                            $i++;  ?>
                                            <!-- <option value="<?php echo $output['SystemActivityID']; ?>"> <?php echo $output['SystemActivityName']; ?> </option> -->
                                        <?php

                                        }
                                        ?>

                                        <!-- </select> -->

                                    </div>


                                    <input id="id" name="id" type="hidden" value="<?php echo $_GET['id']; ?>">
                                </div>

                                <br>

                                <div class="form-group mb-0">
                                    <div>
                                        <button type="button" id='complete' class="btn btn-primary waves-effect waves-light mr-1">
                                            Submit
                                        </button>
                                        <a type="reset" class="btn btn-secondary waves-effect" href="UM_roles.php">
                                            Cancel
                                        </a>
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

<script>
    $(document).on('click', '#complete', function() {
        //  var ps_id = $("#psid").val();
        var ar_id = $("#articleid").val();
        // var ar_id = $(this).parent().find('input[name="articleid"]').val();



        var from = 'selfAssign';

        Swal.fire({
            title: 'Are you sure?',
            text: "You want to submit!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, Submit!',
            cancelButtonText: 'No, cancel!',
            confirmButtonClass: 'btn btn-success mt-2',
            cancelButtonClass: 'btn btn-danger ms-2 mt-2',
            buttonsStyling: false
        }).then(function(result) {
            if (result.value) {
                $.ajax({

                    success: function(data) {
                        // location.replace("UM_edit_activity.php");
                        $("#target").submit();
                    },
                    error: function(xhr, status) {
                        alert("Sorry, there was a problem!");
                    },
                    complete: function(xhr, status) {}
                });
            }
        });
    });
</script>

</body>

</html>