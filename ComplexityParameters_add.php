<?php
include 'layouts/session.php';

error_reporting(E_ALL);

ini_set('display_errors', 1);

require_once "layouts/config.php";

include 'layouts/head-main.php';


if (!isset($_SESSION['ACP'])) {
    //User not logged in. Redirect them back to the error page.
    header('Location: pages-403.php');
    exit;
}

//For Edit

if (isset($_GET['from']) && ($_SERVER["REQUEST_METHOD"] == "GET" && $_GET['from'] == 'edit')) {

    $id = $_GET['id'] ?? '';

    $record = "SELECT * FROM ComplexityParameters WHERE ComplexityParameterID = $id";

    $queryRun = $pdo->prepare($record);

    $queryRun->execute();

    if ($queryRun->rowCount() == 1) {

        $row = $queryRun->fetch();

        $ComplexityParameterName = $row["ComplexityParameterName"] ?? '';
        $ComplexityParameterScore = $row["ComplexityParameterScore"] ?? '';
        $ComplexityParameterStatus = $row["ComplexityParameterStatus"] ?? '';
        $recordId = $row['ComplexityParameterID'] ?? '';
    }
}

?>

<head>

    <title>Form</title>
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
            <div class="container-fluid">
                <!-- start row -->
                <div class="row ">
                    <div class="col-lg-8  mx-auto">
                        <div class="card">
                            <div class="card-body">


                                <!-- start page title -->
                                <div class="row">
                                    <div class="col-12">
                                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                            <h4 class="mb-sm-0 font-size-18"><?php if (isset($recordId)) {
                                                                                    echo 'Update Complexity Parameter';
                                                                                } else {
                                                                                    echo 'Add Complexity Parameter';
                                                                                } ?></h4>
                                        </div>
                                    </div>
                                </div>
                                <!-- end page title -->


                                <form class="custom-validation" <?php if (isset($recordId) && ($_GET['id'] == $recordId && $_GET['from'] == 'edit')) {
                                                                    echo 'action="ComplexityParameters_database.php?id=' . $recordId . '&from=editPost"';
                                                                } else {
                                                                    echo 'action="ComplexityParameters_database.php?from=add"';
                                                                } ?> method="post" enctype="multipart/form-data">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="ComplexityParameterName">Complexity Parameter Name</label>
                                                <input type="text" class="form-control" id="ComplexityParameterName" name="ComplexityParameterName" value="<?php echo $ComplexityParameterName ?? ''; ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="ComplexityParameterScore">Complexity Parameter Score</label>
                                                <input type="number" class="form-control" id="ComplexityParameterScore" name="ComplexityParameterScore" value="<?php echo $ComplexityParameterScore ?? ''; ?>" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="ComplexityParameterStatus">Complexity Parameter Status</label>
                                                <input type="text" class="form-control" id="ComplexityParameterStatus" name="ComplexityParameterStatus" value="<?php echo $ComplexityParameterStatus ?? ''; ?>" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>

                </div>
            </div> <!-- container-fluid -->
        </div>
        <!-- End row -->


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

</script>

</body>

</html>