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

    <title>Edit Stone Setter</title>
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
    
    $date= $name= $gold_received ="";
 
echo $id =  trim($_GET["id"]);

    $sql="SELECT * FROM stone_setter_step WHERE Ssid  = $id";

    $stmt = $pdo->prepare($sql);

    $stmt->execute();
    if($stmt->rowCount() == 1){
        $row = $stmt->fetch();
        $date = $row["date"];
        $name= $row["name"]; 
        $detail= $row["detail"];
		$Issued_weight= $row["Issued_weight"];
		$zircon= $row["zircon"];
		$stonetype= $row["stonetype"];
		$stone_weight= $row["stone_weight"];
		$total= $row["total"];
		$Received_weight= $row["Received_weight"];
		$Stone_received= $row["Stone_received"];
		$Qty= $row["Qty"];
		$Wastage= $row["Wastage"];
		$Total_valu= $row["Total_valu"];
		$Payable= $row["Payable"];
		
    }
  

?>

    <div class="main-content">

       <!-- ======= -->

       <div class="page-content">
                               <!-- start page title -->
                               <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="page-title mb-0 font-size-18">EDIT STONE SETTER</h4>
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
                                    <form class="custom-validation" action="stone_edit_db.php" method="post" enctype="multipart/form-data"> 

                                    
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
              <label>Name *</label>
              <input type="text" name="name" class="form-control" value="<?php echo $name; ?>"required>
           
          </div>
         
          <div class="form-group ">
              <label>Detail</label>
              <input type="text" name="detail" class="form-control" value="<?php echo $detail; ?>"required>
           
          </div>
          <div class="form-group ">
              <label>Issued Weight</label>
              <input type="text" name="Issued_weight" class="form-control" value="<?php echo $Issued_weight; ?>"required>
           
          </div>
		   <div class="form-group ">
              <label>Zircon</label>
              <input type="text" name="zircon" class="form-control" value="<?php echo $zircon; ?>"required>
           
          </div>
		   <div class="form-group ">
              <label>Stone Type</label>
              <input type="text" name="stonetype" class="form-control" value="<?php echo $stonetype; ?>"required>
           
          </div>
		   <div class="form-group ">
              <label>Stone Weight</label>
              <input type="text" name="stone_weight" class="form-control" value="<?php echo $stone_weight; ?>"required>
           
          </div>
		   <div class="form-group ">
              <label>Total</label>
              <input type="text" name="total" class="form-control" value="<?php echo $total; ?>"required>
           
          </div>
		   <div class="form-group ">
              <label>Received Weight</label>
              <input type="text" name="Received_weight" class="form-control" value="<?php echo $Received_weight; ?>"required>
           
          </div> <div class="form-group ">
              <label>Stone Received</label>
              <input type="text" name="Stone_received" class="form-control" value="<?php echo $Stone_received; ?>"required>
           
          </div>
		   <div class="form-group ">
              <label>Qty</label>
              <input type="text" name="Qty" class="form-control" value="<?php echo $Qty; ?>"required>
           
          </div><div class="form-group ">
              <label>Wastage</label>
              <input type="text" name="Wastage" class="form-control" value="<?php echo $Wastage; ?>"required>
           
          </div><div class="form-group ">
              <label>Total</label>
              <input type="text" name="Total_valu" class="form-control" value="<?php echo $Total_valu; ?>"required>
           
          </div><div class="form-group ">
              <label>Payable</label>
              <input type="text" name="Payable" class="form-control" value="<?php echo $Payable; ?>"required>
           
          </div>
		  
        

         <br>
       

   

                                        <div class="form-group mb-0">
                                            <div>
                                                <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                                    Submit
                                                </button>
                                                <a type="reset" class="btn btn-secondary waves-effect" href="UM_system_activities.php?id=<?php echo $row[""]; ?>">
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