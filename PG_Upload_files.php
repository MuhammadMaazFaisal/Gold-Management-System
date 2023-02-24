<?php
include 'layouts/session.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "layouts/config.php";

// if (!isset($_SESSION['AA'])) {
//     //User not logged in. Redirect them back to the error page.
//     header('Location: pages-403.php');
//     exit;
// }

?>



<?php include 'layouts/head-main.php'; ?>

<head>

    <title>Advanced Plugins | Minia - Admin & Dashboard Template</title>
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

                <!-- start page title -->
                <!-- <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Role Management</h4>

                            <div class="page-title-center">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">User Management</a></li>
                                    <li class="breadcrumb-item active">Roles</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div> -->
                <!-- end page title -->

                <!-- start row -->
                <div class="row ">
                    <div class="col-lg-8  mx-auto">
                        <div class="card">
                            <div class="card-body">


                                <!-- start page title -->
                                <div class="row">
                                    <?php
                                    $processingstagename = $articlecode = $assignmenttype = "";
                                    // $ps_id=5;
                                    // $ar_id=21;
                                    // $ast_id=1;
                                    $ps_id =  trim($_GET["psid"]);
                                    $ar_id =  trim($_GET["arid"]);

                                    $sql1 = "SELECT * FROM  Articles WHERE ArticleID =:aid ";
                                    $stmt1 = $pdo->prepare($sql1);
                                    $stmt1->bindParam(":aid", $ar_id);
                                    $stmt1->execute();
                                    if ($stmt1->rowCount() == 1) {
                                        $row1 = $stmt1->fetch();
                                        $articlecode = $row1["ArticleCode"];
                                    }
                                    ?>
                                    <div class="col-12">
                                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                            <h4 class="mb-sm-0 font-size-18">Upload Files For Article: <?php echo $articlecode; ?> </h4>

                                        </div>
                                    </div>
                                </div>
                                <!-- end page title -->

                                <!-- <?php

                                if (isset($_GET['Message'])) {
                                    echo '<div class="alert alert-danger alert-border-left alert-dismissible fade show my-2" role="alert" style="width: 40%;">Article Already exist</div>';
                                    echo '<meta http-equiv="refresh" content="2;URL=Article_add.php">';
                                    exit();
                                }
                                ?> -->
                                <form class="custom-validation" action="PG_Upload_files_db.php" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <input type="text" name="article_code" hidden value="<?php echo $articlecode; ?>" >
                                                <input type="text" name="article_id" hidden value="<?php echo $ar_id; ?>" >
                                                <label class="form-label" for="epubFile">Upload Epub File</label>
                                                <input type="file" class="form-control" id="formrow-firstname-input" accept=".epub" name="epubFile" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="htmlFile">Upload HTML File</label>
                                                <input type="file" class="form-control" id="formrow-firstname-input" accept=".html" name="htmlFile" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        <button type="submit" class="btn btn-primary ">Submit</button>
                                        <a type="reset" class="btn btn-secondary waves-effect" href="PG-Dashboard-User.php">Cancel</a>
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

</body>

</html>