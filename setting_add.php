<?php    
    include 'layouts/session.php'; 
    
    error_reporting(E_ALL);
    
    ini_set('display_errors', 1);

    require_once "layouts/config.php";
    
    include 'layouts/head-main.php'; 


    if (!isset($_SESSION['ASS'])) {
        //User not logged in. Redirect them back to the error page.
        header('Location: pages-403.php');
        exit;
    }
    
    //For Edit
  
    if(isset($_GET['from']) && ($_SERVER["REQUEST_METHOD"] == "GET" && $_GET['from'] == 'edit')){
        
        $id = $_GET['id']??'';
        
        $record = "SELECT * FROM SystemSettings WHERE SystemSettingID = $id";
            
        $queryRun = $pdo->prepare($record);
        $queryRun->execute();
        if($queryRun->rowCount() == 1){
        
        $row = $queryRun->fetch();

        $stageRejectionTimeOut = $row["StageRejectionTimeout"]??'';
        $inProcessThreshold = $row["InProcessThreshold"]??'';
        $positiveIndicatorScore = $row["PositiveIndicatorScore"]??'';
        $negativeIndicatorScore = $row["NegativeIndicatorScore"]??'';
        $recordId = $row['SystemSettingID']??'';
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
                                            <h4 class="mb-sm-0 font-size-18">Add System Setting</h4>
                                        </div>
                                    </div>
                                </div>
                                <!-- end page title -->

                                
                                <form class="custom-validation" <?php if(isset($recordId) && ($_GET['id'] == $recordId && $_GET['from'] == 'edit')){ echo 'action="setting_database.php?id='.$recordId.'&from=editPost"';}else{ echo 'action="setting_database.php?from=add"'; } ?> method="post" enctype="multipart/form-data">
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="stageRejectionTimeOut">Stage Rejection Time Out</label>
                                                <input type="number" class="form-control" id="stageRejectionTimeOut" name="stageRejectionTimeOut" value="<?php echo $stageRejectionTimeOut??''; ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="inProcessThreshold">In Process Threshold</label>
                                                <input type="text" class="form-control" id="inProcessThreshold" name = "inProcessThreshold" value="<?php echo $inProcessThreshold??''; ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="positiveIndicatorScore">Positive Indicator Score</label>
                                                <input type="text" class="form-control" id="positiveIndicatorScore" name = "positiveIndicatorScore" value="<?php echo $positiveIndicatorScore??''; ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="negativeIndicatorScore">Negative Indicator Score</label>
                                                <input type="text" class="form-control" id="negativeIndicatorScore" name = "negativeIndicatorScore" value="<?php echo $negativeIndicatorScore??''; ?>" required>
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