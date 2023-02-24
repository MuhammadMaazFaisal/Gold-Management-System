<?php 
include 'layouts/session.php'; 
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "layouts/config.php";

if(!isset($_SESSION['EA']))
{
  //User not logged in. Redirect them back to the error page.
  header('Location: pages-403.php');
  exit; 
}

?>



<?php include 'layouts/head-main.php'; ?>

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
    
        
      
        $id =  trim($_GET["ArticleId"]);

        $sql= "SELECT *
            FROM
                Articles

            WHERE
                ArticleID = :article_ID";
                               

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":article_ID", $id);

        $stmt->execute();
        echo "row count";
        if($stmt->rowCount() == 1)
        {
            $row = $stmt->fetch();
            $ArticleCode = $row["ArticleCode"];
            $ArticleTitle = $row["ArticleTitle"];
            $ArticleAuthors = $row["ArticleAuthors"]; 
            $ArticleKeywords = $row["ArticleKeywords"]; 
            $ArticleDOI = $row["ArticleDOI"]; 
            $ArticleType = $row["ArticleType"]; 
            $ArticleLastPage = $row["ArticleLastPage"]; 
            $ArticleFirstPage = $row["ArticleFirstPage"]; 
            $Elocator = $row["Elocator"]; 
            $ArticleIssue = $row["ArticleIssue"]; 
            $ArticleVolume = $row["ArticleVolume"];
            $ArticleYear = $row["ArticleYear"];
            $ArticleAbstract = $row["ArticleAbstract"];
            $JournalID = $row["JournalID"];
            $ArticleJMSCode = $row["ArticleJMSCode"];
            $ArticleProcessingType = $row["ArticleProcessingType"];
        }
?>


    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <!-- <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Role Management</h4>

                            <div class="page-title-center">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">User Management</a></li>
                                    <li class="breadcrumb-item active">Roles</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div> -->
                <!-- end page title -->

                <!-- start row -->
                <div class="row ">
                    <div class="col-lg-8  mx-auto">
                        <div class="card">
                            <div class="card-body">


                                <!-- start page title -->
                                <div class="row">
                                    <div class="col-12">
                                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                            <h4 class="mb-sm-0 font-size-18">Update Article</h4>

                                        </div>
                                    </div>
                                </div>
                                <!-- end page title -->
                                    
                                
                                <form class="custom-validation" action="Article_edit_db.php" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label font-size-13">Select Journal</label>
                                            <select name="journal-name" class="form-control" data-trigger >
                                                <option value="">Choose a Journal</option>
                                                <?php 
                                                    // $select_sql = "SELECT JournalID, JournalTitle, JournalCode 
                                                    //     FROM Journals 
                                                    //     WHERE JournalID = $JournalID";
                                                    // $select_stmt = $pdo->prepare($select_sql);
                                                    // $select_result = $select_stmt->execute();
                                                    // $select_result = $select_stmt->fetch();
                                                    // echo "<option selected = selected value='".$select_result['JournalID']."'>".strtoupper($select_result['JournalCode'])." --- ".$select_result['JournalTitle']."</option>";
                                                    $select_sql = "SELECT JournalID, JournalTitle, JournalCode 
                                                        FROM Journals 
                                                        WHERE JournalStatus = 'active'";
                                                    $select_stmt = $pdo->prepare($select_sql);
                                                    $result = $select_stmt->execute();
                                                    $result = $select_stmt->fetchAll();
                                                    foreach ($result as $rows)
                                                    {
                                                        $journal_id = $rows['JournalID'];
                                                        if($journal_id == $JournalID){echo "<option selected = selected value='".$journal_id."'>".strtoupper($rows['JournalCode'])." --- ".$rows['JournalTitle']."</option>";}
                                                        if($journal_id != $JournalID){echo "<option value='".$journal_id."'>".strtoupper($rows['JournalCode'])." --- ".$rows['JournalTitle']."</option>";}
                                                        //echo "<option value='".$journal_id."'>".strtoupper($rows['JournalCode'])." --- ".$rows['JournalTitle']."</option>";
                                                    }
                                                    
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                </div>
                                    <input id="id" name="articleid" type="hidden" value="<?php echo $_GET['ArticleId']; ?>">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="article-volume">Article Volume</label>
                                                <input type="text" class="form-control" id="formrow-firstname-input" name = "article-volume" value="<?php echo $ArticleVolume; ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="article-issue">Article Issue</label>
                                                <input type="text" class="form-control" id="formrow-firstname-input" name = "article-issue" value="<?php echo $ArticleIssue; ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="article-year">Year</label>
                                                <input type="text" class="form-control" id="formrow-firstname-input" name = "article-year" value="<?php echo $ArticleYear; ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 mt-2">
                                        <label class="form-label" for="article-code">Article Code</label>
                                        <input type="text" class="form-control" id="formrow-firstname-input" name = "article-code" value="<?php echo $ArticleCode; ?>" required>
                                    </div>
                                    <div class="mb-3 mt-2">
                                        <label class="form-label" for="article-title">Article Title</label>
                                        <input type="text" class="form-control" id="formrow-firstname-input" name = "article-title" value="<?php echo $ArticleTitle; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="article-author">Article Authors</label>
                                        <input type="text" class="form-control" id="formrow-firstname-input" name = "article-author" value="<?php echo $ArticleAuthors; ?>">
                                    </div>

                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="mb-3">
                                            <label class="form-label" for="article-doi">Article DOI</label>
                                        <input type="text" class="form-control" id="formrow-firstname-input" name = "article-doi" value="<?php echo $ArticleDOI; ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                            <label class="form-label" for="elocator">Article Elocator</label>
                                        <input type="text" class="form-control" id="formrow-firstname-input" name = "elocator" value="<?php echo $Elocator; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="article-abstract">Article Abstract</label>
                                        <textarea name = "article-abstract" class="form-control" id="formrow-firstname-input" value="<?php echo $ArticleAbstract; ?>" ></textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                            <label class="form-label" for="first-page">Article First Page</label>
                                        <input type="text" class="form-control" id="formrow-firstname-input" name = "first-page" value="<?php echo $ArticleLastPage; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                            <label class="form-label" for="last-page">Article Last Page</label>
                                                <input type="text" class="form-control" id="formrow-firstname-input" name = "last-page" value="<?php echo $ArticleLastPage; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                            <label class="form-label" for="article-type">Article Type</label>
                                                <input type="text" class="form-control" id="formrow-firstname-input" name = "article-type" value="<?php echo $ArticleType; ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="article-keyword">Article Keywords</label>
                                        <input type="text" class="form-control" id="formrow-firstname-input" name = "article-keyword" value="<?php echo $ArticleKeywords; ?>" >
                                    </div>

                                    <?php 
                                        //echo "article id".$id;
                                        // echo $ArticleDOI;
                                        // die();
                                          $file_sql = "SELECT COUNT(*) AS num FROM UserAssignedArticles WHERE ArticleID = :article_id";
                                          $file_stmt = $pdo->prepare($file_sql);
                                          $file_stmt->bindValue(":article_id", $id);
                                          $file_stmt->execute();
                                          $row = $file_stmt->fetch(PDO::FETCH_ASSOC);
                                          if ($row['num'] == 0) 
                                          {
                                            echo '<div class="alert alert-success my-2" role="alert" style="width: 40%;">
                                            Do you want to Update Article Files?<a class = "alert-link" href="Files_update.php?ArticleId='. $id.'">Click Here</a></div>';
                                          }else{
                                            echo '<div class="alert alert-danger alert-border-left alert-dismissible fade show my-2" role="alert" style="width: 60%;"><i class="mdi mdi-block-helper me-2"></i>
                                            <strong>'. $ArticleCode.'</strong> Article is in process. You can not update files for this article </div>';
                                          }

                                    
                                    ?>
                                    <div class="mt-2 mr-6">
                                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                                        <a type="reset" class="btn btn-secondary waves-effect" href="Article_view.php">Cancel</a>
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

</body>

</html>