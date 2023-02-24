<?php
include 'layouts/session.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once "layouts/config.php";
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

    <?php
    $id = trim($_GET["ArticleId"]);

    $sql = "SELECT *
        FROM
        ArticlesFilesRecord
        WHERE
        ArticleID = :article_ID";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":article_ID", $id);

    $stmt->execute();
    echo "row count";
    if ($stmt->rowCount() == 1 || $stmt->rowCount() == 2) {
        $row = $stmt->fetch();
        $FileType = $row['FileType'];
        $FileName = $row["FileName"];
        $FilePath = $row["FilePath"];
        $FileID = $row["ArticlesFilesRecordID"];
    }

    ?>

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
                    <div class="col-lg-8 mx-auto">
                        <div class="card">
                            <div class="card-body">

                                <!-- start page title -->
                                <div class="row">
                                    <div class="col-12">
                                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                            <h4 class="mb-sm-0 font-size-18">Update Files</h4>

                                        </div>
                                    </div>
                                </div>
                                <!-- end page title -->

                                <form class="custom-validation" action="Files_update_db.php" method="post" enctype="multipart/form-data">

                                <div class="row">
                                        <div class="col-md-6">
                                        <input name="articleid" type="hidden" value="<?php echo $id; ?>">
                                            <div class="mb-3">
                                                <label class="form-label" for="pdfFile">Upload Pdf File</label>
                                                <input type="file" class="form-control" id="formrow-pdffile-input" accept = ".pdf" name = "pdfFile" value="<?php echo $FileName; ?>" required><?php echo $FileName; ?>
                                                <input name="pdffilename" type="hidden" value="<?php echo $FileName; ?>">
                                                <input name="pdfID" type="hidden" value="<?php echo $FileID; ?>">
                                                <input name="oldpdfpath" type="hidden" value="<?php echo $FilePath; ?>">
                                            </div>
                                        </div> 
                                         <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="wordFile">Upload Word File</label>
                                                <?php 
                                               
                                                    $doc_sqls = "SELECT * FROM ArticlesFilesRecord WHERE ((FileType = 'docx' OR FileType = 'doc') AND ArticleID = :articleid)";
                                                    $docx_stmt = $pdo->prepare($doc_sqls);
                                                    $docx_stmt->bindParam(":articleid", $id);
                                                    $docx_stmt->execute();
                                                    $docx_result = $docx_stmt->fetch();
                                                ?>
                                                
                                                <input type="file" class="form-control" id="formrow-wordfile-input" accept = ".doc, .docx" name = "wordFile" required><?php echo $docx_result['FileName']; ?>
                                                <input name="wordfilename" type="hidden" value="<?php echo $docx_result['FileName']; ?>">
                                                <input name="wordID" type="hidden" value="<?php echo $docx_result['ArticlesFilesRecordID']; ?>">
                                                <input name="oldwordpath" type="hidden" value="<?php echo $docx_result['FilePath']; ?>">
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

</body>

</html>