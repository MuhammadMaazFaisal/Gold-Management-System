<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php include 'layouts/config.php'; 

if(!isset($_SESSION['EJ']))
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
    
    $journal_title= $journal_url= $journal_code= $journal_type= $issn_online= $issn_print= $aims_scope=$journal_impact_factor=$journal_status="";
 
echo $id =  trim($_GET["id"]);

    $sql="SELECT * FROM Journals WHERE JournalID = $id";

    $stmt = $pdo->prepare($sql);

    $stmt->execute();
    if($stmt->rowCount() == 1){
        $row = $stmt->fetch();
        $journal_code = $row["JournalCode"];
        $journal_title= $row["JournalTitle"]; 
        $journal_type= $row["JournalType"]; 
        $issn_online=$row["ISSNOnline"]; 
        $issn_print= $row["ISSNPrint"]; 
        $journal_impact_factor= $row["JournalImpactFactor"]; 
        $journal_url=$row["JournalURL"]; 
        $aims_scope= $row["JournalAimsandScope"]; 
        $journal_status=$row["JournalStatus"]; 


    }
  

?>

    <div class="main-content">

       <!-- ======= -->

       <div class="page-content">
                               <!-- start page title -->
                               <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="page-title mb-0 font-size-18">EDIT JOURNAL</h4>
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
                                    <form class="custom-validation" action="Journal_edit_db.php" method="post" enctype="multipart/form-data"> 

                                    
                                    <!-- <?php 
                       
                       if(isset($_POST['msg'])) {
                        $msg = $_POST['msg'];
                        echo "<span style='color:red;'>".$msg."</span>";
                        $msg="";

                       }
                       ?>                    -->
          <div class="form-group ">
          <input id="id" name="id" type="hidden" value="<?php echo $_GET['id']; ?>">
              <label>Journal Title *</label>
              <input type="text" name="journal_title" readonly class="form-control" value="<?php echo $journal_title; ?>"required>
           
          </div>
          <div class="form-group ">
              <label>Journal Code *</label>
              <input type="text" name="journal_code" readonly class="form-control" value="<?php echo $journal_code; ?>"required>
           
          </div>
          <div class="form-group ">
          <label for="journal_type">Journal Type *</label>
<select name="journal_type"  class="form-control" value="<?php echo $journal_type; ?>">
<option value="Open Access" <?php if ($journal_type == "Open Access") { echo ' selected="selected"'; } ?>>Open Access</option>
<option value="Subscription Journal" <?php if ($journal_type == "Subscription Journal") { echo ' selected="selected"'; } ?>>Subscription Journal</option>


</select>

          </div>
         
          <div class="form-group ">
              <label>ISSN (ONLINE) *</label>
              <input type="text" name="issn_online" class="form-control" value="<?php echo $issn_online; ?>"required>
           
          </div>
          <div class="form-group ">
              <label>ISSN (PRINT) *</label>
              <input type="text" name="issn_print" class="form-control" value="<?php echo $issn_print; ?>"required>
           
          </div>
          <div class="form-group ">
              <label>Journal URL</label>
              <input type="text" name="journal_url" class="form-control" value="<?php echo $journal_url; ?>" required>
           
          </div>
          <div class="form-group ">
              <label>Journal Impact Factor *</label>
              <input type="text" name="journal_impact_factor" class="form-control" value="<?php echo $journal_impact_factor; ?>"required>
           
          </div>
          <div class="form-group ">
          <label for="journal_status">Status *</label>
           <select name="journal_status"  class="form-control" value="<?php echo $journal_status; ?>">
           
           <option value="Active" <?php if ($journal_status == "Active") { echo ' selected="selected"'; } ?>>Active</option>
           <option value="Inactive" <?php if ($journal_status == "Inactive") { echo ' selected="selected"'; } ?>>Inactive</option>

</select>

          </div>
          <div class="form-group" >
                <label>Aims and Scope *</label>
                 <textarea name="aims_scope" class="form-control" required><?php echo $aims_scope; ?></textarea>
                                                    
          </div>

         <br>
       

   

                                        <div class="form-group mb-0">
                                            <div>
                                                <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                                    Submit
                                                </button>
                                                <a type="reset" class="btn btn-secondary waves-effect" href="Journal_view.php?id=<?php echo $row[""]; ?>">
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