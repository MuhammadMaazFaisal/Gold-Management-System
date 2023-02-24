<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php include 'layouts/config.php';

// if(!isset($_SESSION['DJ']))
// {
//   //User not logged in. Redirect them back to the error page.
//   header('Location: pages-403.php');
//   exit; 
// }

?>

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

       <!-- ======= -->
       <div class="main-content">

<div class="page-content">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">HOLD ARTICLE</h4>

            </div>
        </div>
    </div>
    <!-- end page title -->


<div class="row">

<?php

$processingstagename=$articlecode=$assignmenttype="";
// $ps_id=2;
// $ar_id=2;
// $ast_id=1;
 $ps_id =  trim($_GET["psid"]);
 $ar_id =  trim($_GET["arid"]);
 $ast_id =  trim($_GET["astid"]);

$sql = "SELECT * FROM  ProcessingStages WHERE ProcessingStageID  =:id ";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":id",$ps_id);
$stmt->execute();
if ($stmt->rowCount() == 1) {
    $row = $stmt->fetch();
    $processingstagename = $row["ProcessingStageName"];
}
$sql1 = "SELECT * FROM  Articles WHERE ArticleID =:aid ";
$stmt1 = $pdo->prepare($sql1);
$stmt1->bindParam(":aid",$ar_id);
$stmt1->execute();
if ($stmt1->rowCount() == 1) {
    $row1 = $stmt1->fetch();
    $articlecode = $row1["ArticleCode"];
}

$sql2 = "SELECT * FROM  AssignmentTypes WHERE AssignmentTypeID =:id ";
$stmt2 = $pdo->prepare($sql2);
$stmt2->bindParam(":id",$ast_id);
$stmt2->execute();
if ($stmt2->rowCount() == 1) {
    $row2 = $stmt2->fetch();
    $assignmenttype = $row2["AssignmentTypeName"];

    $sql3 = "SELECT * FROM  UserAssignedArticles WHERE AssignmentTypeID =:id ";

}


?>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">

        

<form class="custom-validation" action="QA_Hold_db.php" method="post"> 




<input id="id" name="id" type="hidden" value="<?php echo $_GET['id']; ?>">


                   <div class="form-group mb-0">
                   <input id="psid" name="ps_id" type="hidden" value="<?php echo $ps_id; ?>">
                                    <input id="arid" name="ar_id" type="hidden" value="<?php echo $ar_id; ?>">
                                    <input id="astid" name="ast_id" type="hidden" value="<?php echo $ast_id; ?>">
                                    <label>Processing Stage Name </label>
                                    <input type="text" name="processingstagename" class="form-control" readonly value="<?php echo $processingstagename; ?>" required>

                                </div>
                                <div class="form-group ">
                                    <label>Article Code</label>
                                    <input type="text" name="articlecode" class="form-control" readonly value="<?php echo $articlecode; ?>" required>

                                </div>
                                <div class="form-group ">
                                    <label>Assignment Type</label>
                                    <input type="text" name="assignmenttype" class="form-control" readonly value="<?php echo $assignmenttype; ?>" required>

                                </div>
                                
                                <br>
                       <div>
                       <p>Are you sure you want to hold article? </p>

                           <button type="submit" class="btn btn-primary waves-effect waves-light">
                               HOLD
                           </button>
                          
                           <a class="btn btn-secondary waves-effect" href="QA-Dashboard-User.php">BACK</span></a>
                          
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
       
       <!-- ====== -->

        <!-- <?php include 'layouts/footer.php'; ?> -->
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