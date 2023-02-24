<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php include 'layouts/config.php'; 

if(!isset($_SESSION['ESA']))
{
  //User not logged in. Redirect them back to the error page.
  header('Location: pages-403.php');
  exit; 
}

?>

<head>

    <title>Edit Gold Account</title>
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
    
    $date= $name=  $details= $gold_Issued_weight= $purity= $pure_weight_issued= "";
 
	$id =  trim($_GET["id"]);

    $sql="SELECT * FROM gold_accont_step WHERE id  = $id";

    $stmt = $pdo->prepare($sql);

    $stmt->execute();
    if($stmt->rowCount() == 1){
        $row = $stmt->fetch();
		$date = $row["date"];
        $name= $row["name"]; 
        $detail= $row["detail"];
		$gold_Issued_weight= $row["gold_Issued_weight"];
		$purity= $row["purity"];
		$pure_weight_issued= $row["pure_weight_issued"];
		

    }
  

?>

    <div class="main-content">

       <!-- ======= -->

       <div class="page-content">
                               <!-- start page title -->
                               <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="page-title mb-0 font-size-18">EDIT Gold Account ACTIVITY</h4>
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
                        <div class="col-lg-11">
                            <div class="card">
                                <div class="card-body">
                                    <!-- <h4 class="card-title">Validation type</h4>
                                    <p class="card-title-desc">Parsley is a javascript form validation library. It helps you provide your users with feedback on their form submission before sending it to your server.</p> -->
                                    <form class="custom-validation" action="gold_edit_db.php" method="post" enctype="multipart/form-data"> 

                                    
                                    <!-- <?php 
                       
                       if(isset($_POST['msg'])) {
                        $msg = $_POST['msg'];
                        echo "<span style='color:red;'>".$msg."</span>";
                        $msg="";

                       }
                       ?>                    -->
          <div class="form-group ">
          <input id="id" name="id" type="hidden" value="<?php echo $_GET['id']; ?>">
              <label>Date:</label>
              <input type="text" name="date"  class="form-control" value="<?php echo $date; ?>"required>
           
          </div>
		  <div class="form-group ">
              <label>Name</label>
              <input type="text" name="name" class="form-control" value="<?php echo $name; ?>"required>
           
          </div>
		  <div class="form-group ">
              <label>Details</label>
              <input type="text" name="detail" class="form-control" value="<?php echo $detail; ?>"required>
           
          </div>
		  <div class="form-group ">
              <label>Gold Issued Weight</label>
              <input type="text" name="gold_Issued_weight" class="form-control" value="<?php echo $gold_Issued_weight; ?>"required>
           
          </div>
		  <div class="form-group ">
              <label>Purity</label>
              <input type="text" name="purity" class="form-control" value="<?php echo $purity; ?>"required>
           
          </div>
          <div class="form-group ">
              <label>Pure Weight Issued</label>
              <input type="text" name="pure_weight_issued" class="form-control" value="<?php echo $pure_weight_issued; ?>"required>
           
          </div>
         
         <br>
       

   

                                        <div class="form-group mb-0">
                                            <div>
                                                <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                                    Update
                                                </button>
                                                
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