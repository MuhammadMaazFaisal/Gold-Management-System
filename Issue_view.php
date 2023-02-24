<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php include 'layouts/config.php';

if(!isset($_SESSION['VI']))
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
                        <!-- <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="page-title mb-0 font-size-18">Journals</h4>
                                </div>
                            </div>
                        </div> -->
                        <!-- end page title	 -->

                            <!-- Start row -->
                            <form id="form-horizontal" class="form-horizontal form-wizard-wrapper">
                       
                       <h3>Issues</h3>
                                           <fieldset>
                       <div class="row">
                           <div class="col-12">
                               <div class="card">
                                   <div class="card-body">
   
                                    <a class="btn btn-primary btn-lg waves-effect waves-light bx bx-add-to-queue" target="_blank" href="Issue_add.php">Add Issue</a> <br><br>
                 

<table id="datatable" class="display table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" role="grid">  
<?php
                    
               
                    $sql="SELECT * FROM Issues";
                    $stmt = $pdo->prepare($sql);
                    if($stmt->execute()){
               
                    ?>

<table id="datatable" class="display table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" role="grid">  
                                        <thead>
                                            <tr>
                                                <th>Issue</th>
                                                <th>Volume</th>
                                                <th>Year</th>
                                                <th>Date</th>
                                                <th>Journal</th>
                                                <th>Added By</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                    
      <tr>
                                             
                                              
      <?php while($row = $stmt->fetch()){
             ?>
                                                <td><?php echo $row["Issue"]." "; ?></td>
                                                <td><?php echo $row["Volume"]; ?></td>
                                                <td><?php echo $row["Year"]; ?></td>
                                                <td><?php echo $row["Date"]; ?></td>
                                                <td><?php
                                                $jid=$row["Journals_JournalID"];
                                                $sql2="SELECT * FROM Journals WHERE JournalID='$jid'";
                                                $stmt2 = $pdo->prepare($sql2);
                                                $stmt2->execute();
                                                $row2= $stmt2->fetch();
                                                
                                                echo $row2["JournalTitle"]; ?></td>
                                                <td><?php $uid= $row["AddedBy"]; 
                                                
                                                $sql3="SELECT * FROM Users WHERE UserID='$uid'";
                                                $stmt3 = $pdo->prepare($sql3);
                                                $stmt3->execute();
                                                $row3= $stmt3->fetch();
                                                
                                                echo $row3["UserName"]; ?>
                                            </td>
                                                <td><a  class="btn btn-info btn-sm m-1" href="Issue_edit.php?id=<?php echo $row["IssueID"]; ?>">Modify</a><a  class="btn btn-danger btn-sm m-1" href="Issue_delete.php?id=<?php echo $row["IssueID"]; ?>">Delete</a>
                                            </td>
                                              
                                              
                                            </tr>

                                      
                                          <?php } ?>
                                                  
                                        </tbody>
                                    </table>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                                                </fieldset>
    
        
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