<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php include 'layouts/config.php';

if(!isset($_SESSION['AI']))
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
    <div class="main-content">

       <!-- ======= -->
       <div class="page-content">
                               <!-- start page title -->
                               <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="page-title mb-0 font-size-18">ADD ISSUE</h4>
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
                        
                    <?php

                //Already existing journals
                $stmt = $pdo->prepare("SELECT JournalID, JournalTitle
                    FROM Journals");
                $stmt->execute();
                $row = $stmt->fetchAll();

                ?>

                       
                       
                    </div>
                    <!-- end row -->
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <!-- <h4 class="card-title">Validation type</h4>
                                    <p class="card-title-desc">Parsley is a javascript form validation library. It helps you provide your users with feedback on their form submission before sending it to your server.</p> -->
                                    <?php 
                       
                       if(isset($_POST['msg'])) {
echo "<span style='color:red;'>".$_POST['msg']."</span>";

                       }
                       ?>
                                    <form class="custom-validation" action="Issue_add_db.php" method="post" enctype="multipart/form-data"> 
                                   
          <div class="form-group ">
              <label>Issue *</label>
              <input type="text" name="issue" class="form-control" value="<?php echo $issue; ?>"required>
           
          </div>
          <div class="form-group ">
              <label>Volume *</label>
              <input type="text" name="volume" class="form-control" value="<?php echo $volume; ?>"required>
           
          </div>
          <div class="form-group ">
              <label>Year *</label>
              <input type="text" name="year" class="form-control" value="<?php echo $year; ?>"required>
           
          </div>
          <div class="form-group ">
              <label>Date *</label>
              <input type="date" name="date" class="form-control" value="<?php echo $date; ?>"required>
           
          </div>
          
          <div class="form-group ">
          <label for="journal_id">Journal *</label>
           <select name="journal_id"  class="form-control">

                                            <?php foreach ($row as $output) { ?>
                                                <option value="<?php echo $output['JournalID']; ?>"> <?php echo $output['JournalTitle']; ?>
                                                </option>
                                            <?php
                                            } ?>



                                      

</select>

          </div>
         <br>
       

   

                                        <div class="form-group mb-0">
                                            <div>
                                                <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                                    Submit
                                                </button>
                                                <a type="reset" class="btn btn-secondary waves-effect" href="Issue_view.php">
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