<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php include 'layouts/config.php';

if(!isset($_SESSION['VJ']))
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
                       
                       <h3>Journals</h3>
                                           <fieldset>
                       <div class="row">
                           <div class="col-12">
                               <div class="card">
                                   <div class="card-body">
   
                                    <a class="btn btn-primary btn-lg waves-effect waves-light bx bx-add-to-queue" target="_blank" href="Journal_add.php">Add Journal</a> <br><br>
                 

<table id="datatable" class="display table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" role="grid">  
<?php
                    
               
                    $sql="SELECT * FROM Journals";
                    $stmt = $pdo->prepare($sql);
                    if($stmt->execute()){
               
                    ?>

<table id="datatable" class="display table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" role="grid">  
                                        <thead>
                                            <tr>
                                                <th>Journal Code</th>
                                                <th>Journal Title</th>
                                                <th>Journal Type</th>
                                                <th>ISSN(Online)</th>
                                                <th>ISSN(Print)</th>
                                                <th>Journal Impact Factor</th>
                                                <th>Journal URL</th>
                                                <!-- <th>Journal Aims & Scope</th> -->
                                                <th>Status</th>
                                                <th>Added By</th>
                                                <th>Action</th>
                                            
                                            </tr>
                                        </thead>

                                        <tbody>
                                    
      <tr>
                                             
                                              
      <?php while($row = $stmt->fetch()){
             ?>
                                                <td><?php echo $row["JournalCode"]." "; ?></td>
                                                <td><?php echo $row["JournalTitle"]; ?></td>
                                                <td><?php echo $row["JournalType"]; ?></td>
                                                <td><?php echo $row["ISSNOnline"]; ?></td>
                                                <td><?php echo $row["ISSNPrint"]; ?></td>
                                                <td><?php echo $row["JournalImpactFactor"]; ?></td>
                                                <td><?php echo $row["JournalURL"]; ?></td>
                                                <!-- <td><?php echo $row["JournalAimsandScope"]; ?></td> -->
                                                <td><?php echo $row["JournalStatus"]; ?></td>
                                                <td><?php echo $row["JournalAddedBy"]; ?></td>
                                                <td><a  class="btn btn-info btn-sm m-1" href="Journal_edit.php?id=<?php echo $row["JournalID"]; ?>">Modify</a>
                                                <?php $sql2= "SELECT * FROM Journals INNER JOIN Articles ON Journals.JournalID != Articles.JournalID ";
                                                $stmt2= $pdo->prepare($sql2);
                                                $stmt2->bindParam(':jid',$journalid);
                                                $stmt2->execute();
                                                $row2 = $stmt->fetch();
                                                $journalid=$row2['JournalID'];
                                                ?>
                                                <a  class="btn btn-danger btn-sm m-1" href="Journal_delete.php?id=<?php echo $row["JournalID"]; ?>">Delete</a>
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