<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php include 'layouts/config.php'; 


if(!isset($_SESSION['EPS']))
{
  //User not logged in. Redirect them back to the error page.
  header('Location: pages-403.php');
  exit; 
}
  

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

    <?php   
    
    $processing_stage_name= $processing_stage_code= $processing_stage_description = $score_calculation_status = $score_calculation_rationale ="";
 
echo $id =  trim($_GET["id"]);

    $sql="SELECT * FROM ProcessingStages WHERE ProcessingStageID = $id";

    $stmt = $pdo->prepare($sql);

    $stmt->execute();
    if($stmt->rowCount() == 1){
        $row = $stmt->fetch();
        $processing_stage_name = $row["ProcessingStageName"];
        $processing_stage_code= $row["ProcessingStageCode"]; 
        $processing_stage_description= $row["ProcessingStageDescription"]; 
        $score_calculation_status=$row["ScoreCalculationStatus"]; 
        $score_calculation_rationale= $row["ScoreCalculationRationale"]; 
    }
  

?>

    <div class="main-content">

       <!-- ======= -->

       <div class="page-content">
                               <!-- start page title -->
                               <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="page-title mb-0 font-size-18">EDIT PROCESSING STAGE</h4>
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
                           
                       
                    </div>
                    <!-- end row -->
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <!-- <h4 class="card-title">Validation type</h4>
                                    <p class="card-title-desc">Parsley is a javascript form validation library. It helps you provide your users with feedback on their form submission before sending it to your server.</p> -->
                                    <form class="custom-validation" action="UM_processing-stage_edit_db.php" method="post" enctype="multipart/form-data"> 

                                    
                                    <!-- <?php 
                       
                       if(isset($_POST['msg'])) {
                        $msg = $_POST['msg'];
                        echo "<span style='color:red;'>".$msg."</span>";
                        $msg="";

                       }
                       ?>                    -->
          <div class="form-group ">
          <input id="id" name="id" type="hidden" value="<?php echo $_GET['id']; ?>">
              <label>Processing Stage Name *</label>
              <input type="text" name="processing_stage_name"  class="form-control" value="<?php echo $processing_stage_name; ?>"required>
           
          </div>
          <div class="form-group ">
              <label>Processing Stage Code *</label>
              <input type="text" name="processing_stage_code" class="form-control" value="<?php echo $processing_stage_code; ?>"required>
           
          </div>
         
          <div class="form-group ">
              <label>Processing Stage Description *</label>
              <input type="text" name="processing_stage_description" class="form-control" value="<?php echo $processing_stage_description; ?>"required>
           
          </div>
          <div class="form-group ">
              <label>Score Calculation Status *</label>
              <input type="text" name="score_calculation_status" class="form-control" value="<?php echo $score_calculation_status; ?>"required>
           
          </div>
          <div class="form-group ">
              <label>Score Calculation Rationale *</label>
              <input type="text" name="score_calculation_rationale" class="form-control" value="<?php echo $score_calculation_rationale; ?>" required>
           
          </div>
        

         <br>
       

   

                                        <div class="form-group mb-0">
                                            <div>
                                                <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                                    Submit
                                                </button>
                                                <a type="reset" class="btn btn-secondary waves-effect" href="UM_processing-stage.php?id=<?php echo $row[""]; ?>">
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