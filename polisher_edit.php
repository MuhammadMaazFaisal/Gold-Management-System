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

    <title>Edit Polisher</title>
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
    
    $name=  $details= $difference= $Wastage= $Payable= $code ="";
 
 $id =  trim($_GET["id"]);

    $sql="SELECT * FROM polisher_step WHERE id  = $id";

    $stmt = $pdo->prepare($sql);

    $stmt->execute();
    if($stmt->rowCount() == 1){
        $row = $stmt->fetch();
		 $code = $row["code"];
        $name= $row["name"]; 
        $details= $row["details"];
		$difference= $row["difference"];
		$Payable= $row["Payable"];
		$Wastage= $row["Wastage"];
		
		
		

    }
  

?>

    <div class="main-content">

       <!-- ======= -->

       <div class="page-content">
                               <!-- start page title -->
                               <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="page-title mb-0 font-size-18">EDIT POLISHER ACTIVITY</h4>
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
                                    <form class="custom-validation" action="polisher_edit_db.php" method="post" enctype="multipart/form-data"> 

                                    
                                    <!-- <?php 
                       
                       if(isset($_POST['msg'])) {
                        $msg = $_POST['msg'];
                        echo "<span style='color:red;'>".$msg."</span>";
                        $msg="";

                       }
                       ?>                    -->
          <div class="form-group ">
          <input id="id" name="id" type="hidden" value="<?php echo $_GET['id']; ?>">
             
           
          </div>
		  <div class="form-group ">
              <label>Code</label>
              <input type="text" name="code" class="form-control" value="<?php echo $code; ?>"required>
           
          </div>
		  <div class="form-group ">
              <label>Name</label>
              <input type="text" name="name" class="form-control" value="<?php echo $name; ?>"required>
           
          </div>
		  <div class="form-group ">
              <label>Details</label>
              <input type="text" name="details" class="form-control" value="<?php echo $details; ?>"required>
           
          </div>
		  <div class="form-group ">
              <label>Difference</label>
              <input type="text" name="difference" class="form-control" value="<?php echo $difference; ?>"required>
           
          </div>
		 
		  <div class="form-group ">
              <label>Wastage</label>
              <input type="text" name="Wastage" class="form-control" value="<?php echo $Wastage; ?>"required>
           
          </div>
		  
		   <div class="form-group ">
              <label>Payable</label>
              <input type="text" name="Payable" class="form-control" value="<?php echo $Payable; ?>"required>
           
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