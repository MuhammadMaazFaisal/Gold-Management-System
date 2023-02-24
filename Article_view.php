    <?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php include 'layouts/config.php';

if(!isset($_SESSION['VA']))
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
                                    <h4 class="page-title mb-0 font-size-18">Articles</h4>
                                </div>
                            </div>
                        </div> -->
                        <!-- end page title	 -->

                            <!-- Start row -->
                            <form id="form-horizontal" class="form-horizontal form-wizard-wrapper">
                       
                       <h3>Articles</h3>
                                           <fieldset>
                       <div class="row">
                           <div class="col-12">
                               <div class="card">
                                   <div class="card-body">
   
                                    <a class="btn btn-primary btn-lg waves-effect waves-light bx bxs-user-plus" target="_blank" href="Article_add.php">Add Article</a> <br><br>
                 

<table id="datatable" class="display table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" role="grid">  
<?php
                    
               
                    $sql="SELECT * FROM Articles WHERE Status='Active'";
                    $stmt = $pdo->prepare($sql);
                    if($stmt->execute()){
               
                    ?>

<table id="datatable" class="display table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" role="grid">  
                                        <thead>
                                            <tr>
                                                <th>Journal Code</th>
                                                <th>Article Code</th>
                                                <th>Articles Title</th>
                                                <th>Articles DOI</th>
                                                <th>Added By</th>
                                                <th>Article PDF File</th>
                                                <th>Article WORD File</th>
                                                <th>Actions</th>
                                                
                                            </tr>
                                        </thead>

                                        <tbody>
                                    
                                            <tr>
                                                                                    
                                                                                    
                                                <?php while($row = $stmt->fetch()){
                                                    // fetch journal code volume issue
                                                    $j_sql = "SELECT JournalCode FROM Journals WHERE JournalID = :journal_id";
                                                    $j_stmt = $pdo->prepare($j_sql);
                                                    $j_stmt->bindValue(":journal_id", $row["JournalID"]);
                                                    $j_result = $j_stmt->execute();
                                                    $j_result = $j_stmt->fetch();
                                                    
                                                    // fetch username added by
                                                    $user_name = "SELECT UserName FROM Users WHERE UserID = :userId";
                                                    $user_stmt = $pdo->prepare($user_name);
                                                    $user_stmt->bindValue(":userId", $row["AddedBy"]);
                                                    $user_result = $user_stmt->execute();
                                                    $user_result = $user_stmt->fetch();

                                                    // fetch pdf files
                                                    $pdf_sql = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND FileType = 'pdf')";
                                                    $pdf_stmt = $pdo->prepare($pdf_sql);
                                                    $pdf_stmt->bindParam(":articleID", $row["ArticleID"]);
                                                    $pdf_result = $pdf_stmt->execute();
                                                    $pdf_result = $pdf_stmt->fetch();
                                                    
                                                    

                                                    // fetch docx files
                                                    $wordFile = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND FileType = 'docx')";
                                                    $word_stmt = $pdo->prepare($wordFile);
                                                    $word_stmt->bindParam(":articleID", $row["ArticleID"]);
                                                    $word_result = $word_stmt->execute();
                                                    $word_result = $word_stmt->fetch();
                                                    


                                                    

                                                ?>
                                                    <td><?php echo $j_result["JournalCode"]."-".$row["ArticleVolume"]."-".$row["ArticleIssue"]; ?></td>
                                                    <td><?php echo $row["ArticleCode"]; ?></td>
                                                    <td><?php echo $row["ArticleTitle"]; ?></td>
                                                    <td><?php echo $row["ArticleDOI"]; ?></td>
                                                    <td><?php echo $user_result["UserName"]; ?></td>
                                                    <td><a href="Download_file.php?file_id=<?php echo $pdf_result['ArticlesFilesRecordID']?>" class="btn btn-primary"><?php echo $pdf_result["FileName"]; ?></a></td>
                                                    <td><a href="Download_file.php?file_id=<?php echo $word_result['ArticlesFilesRecordID']?>" class="btn btn-primary"><?php echo $word_result["FileName"]; ?></a></td>
                                                
                                                    <td><a  class="btn btn-info btn-sm m-1 " href="Article_edit.php?ArticleId=<?php echo $row["ArticleID"]; ?>">Modify</a>
                                                    <?php
                                                         $file_sql = "SELECT COUNT(*) AS num FROM UserAssignedArticles WHERE ArticleID = :article_id";
                                                         $file_stmt = $pdo->prepare($file_sql);
                                                         $file_stmt->bindValue(":article_id", $row["ArticleID"]);
                                                         $file_stmt->execute();
                                                         $rowss = $file_stmt->fetch(PDO::FETCH_ASSOC);
                                                         $articleid = $row["ArticleID"];
                                                         if ($rowss['num'] == 0) 
                                                         {
                                                           //<a class="btn btn-danger btn-sm m-1"  href="Article_delete.php?id='.$row["ArticleID"].'">Delete</a>
                                                           echo '<a class="btn btn-danger btn-sm m-1"  href="Article_delete.php?id='.$articleid.'">Delete</a>';
                                                        }
                                                    
                                                    
                                                    ?>
                                                    
                                                    
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