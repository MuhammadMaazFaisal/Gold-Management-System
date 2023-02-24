<?php
include 'layouts/session.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "layouts/config.php";

if (!isset($_SESSION['AA'])) {
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
                                            <h4 class="mb-sm-0 font-size-18">Add Article</h4>

                                        </div>
                                    </div>
                                </div>
                                <!-- end page title -->

                                <?php

                                if (isset($_GET['Message'])) {
                                    echo '<div class="alert alert-danger alert-border-left alert-dismissible fade show my-2" role="alert" style="width: 40%;">Article Already exist</div>';
                                    echo '<meta http-equiv="refresh" content="2;URL=Article_add.php">';
                                    exit();
                                }
                                ?>
                                <form class="custom-validation" action="Article_add_db.php" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Select Journal</label>
                                               
                                                <select id="onchangejournal" name="journal-name" class="form-control" data-trigger>
                                                    <option value="">Choose a Journal</option>
                                                    <?php
                                                    $select_sql = "SELECT JournalID, JournalTitle, JournalCode 
                                                        FROM Journals 
                                                        WHERE JournalStatus = 'active'";
                                                    $select_stmt = $pdo->prepare($select_sql);
                                                    $result = $select_stmt->execute();
                                                    $result = $select_stmt->fetchAll();
                                                    foreach ($result as $row) {
                                                        $journal_id = $row['JournalID'];
                                                        echo "<option value='" . $journal_id . "'>" . strtoupper($row['JournalCode']) . "---" . $row['JournalTitle'] . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div></div>
                                            <div class="col-lg-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="article-type">Article Type</label>
                                                <select  name="article-type" class="form-control">
                                                    <option   value="abstract">Abstract</option>
                                                    <option value="addendum">Addendum</option>
                                                    <option   value="announcement">Announcement</option>
                                                    <option   value="article-commentary">Article-Commentary</option>
                                                    <option   value="book-review">Book-Review</option>
                                                    <option   value="books-received">Books-Received</option>
                                                    <option   value="brief-report">Brief-report</option>
                                                    <option   value="calendar">Calendar</option>
                                                    <option   value="case-report">Case-Report</option>
                                                    <option   value="collection">Collection</option>
                                                    <option   value="correction">Correction</option>
                                                    <option   value="discussion">Discussion</option>
                                                    <option   value="dissertation">Dissertation</option>
                                                    <option   value="editorial">Editorial</option>
                                                    <option   value="in-brief">In-Brief</option>
                                                    <option   value="introduction">Introduction</option>
                                                    <option   value="letter">Letter</option>
                                                    <option   value="meeting-report">Meeting-Report</option>
                                                    <option   value="news">News</option>
                                                    <option   value="obituary">Obituary</option>
                                                    <option   value="oration">Oration</option>
                                                    <option   value="partial-retraction">Partial-Retraction</option>
                                                    <option   value="product-review">Product-Review</option>
                                                    <option   value="rapid-communication">Rapid-Communication</option>
                                                    <option   value="reply">Reply</option>
                                                    <option   value="reprint">Reprint</option>
                                                    <option   value="research-article">Research-Article</option>
                                                    <option   value="retraction">Retraction</option>
                                                    <option   value="review-article">Review-Article</option>
                                                    <option   value="translation">Translation</option>
                                                    </select>
                                            </div>
                                        </div>
                                        </div>
                                        
                                        <?php if(isset($_SESSION["AAA"])&& isset($_SESSION["APA"])){
                                        
                                        ?>
                                        <div class="mb-3 mt-2">
                                            <div class="mb-3">
                                                <label class="form-label ">Article Processing Type</label>
                                                <select id='changetype' name="article-procesing-type" class="form-control">
                                                    <option  selected value="published">Published</option>
                                                    <option value="accepted">Accepted</option>
                                                    </select>
                                            </div>
                                        </div><?php } 
                                        elseif(isset($_SESSION["AAA"])&& !isset($_SESSION["APA"])){ ?>
                                         <div class="mb-3">
                                                <!-- <label class="form-label font-size-13">Article Processing Type</label> -->
                                                <select hidden id='changetype' name="article-procesing-type" class="form-control">
                                                    <option   value="published">Published</option>
                                                    <option selected  value="accepted">Accepted</option>
                                                    </select>
                                            </div><?php } 
                                             elseif(!isset($_SESSION["AAA"])&& isset($_SESSION["APA"])){ ?>
                                         <div class="mb-3">
                                                <!-- <label class="form-label font-size-13">Article Processing Type</label> -->
                                                <select hidden id='changetype' name="article-procesing-type" class="form-control">
                                                    <option  selected value="published">Published</option>
                                                    <option value="accepted">Accepted</option>
                                                    </select>
                                            </div><?php } ?>

                                        <?php if(isset($_SESSION["AAA"])){ ?>
                                        <div class="mb-3 mt-2">
                                            <div class="mb-3">
                                                <label class="form-label" for="article-code">Article JMS Code</label>
                                                <input type="text" class="form-control jmscode" id="formrow-firstname-input" name="article-jmscode" >
                                            </div>
                                        </div>
                                    <?php } ?>

                                    <?php 
                                    if(isset($_SESSION["APA"])){ ?>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="article-volume">Article Volume</label>
                                                <input type="text" class="form-control" id="onchangevol" name="article-volume" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="article-issue">Article Issue</label>
                                                <input type="text" class="form-control" id="onchangeissue" name="article-issue" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="article-year">Year</label>
                                                <input type="text" class="form-control" id="formrow-firstname-input" name="articleyear" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="first-page">Article First Page</label>
                                                <input type="text" class="form-control" id="onchangefpage" name="first-page">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="last-page">Article Last Page</label>
                                                <input type="text" class="form-control" id="formrow-firstname-input" name="last-page">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="article-code">Article Code</label>
                                                <input type="text" class="form-control  arcode" id="arcode" readonly name="article-code" required>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <div class="mb-3 mt-2">
                                        <label class="form-label" for="article-title">Article Title</label>
                                        <input type="text" class="form-control" id="formrow-firstname-input" name="article-title" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="article-author">Article Authors</label>
                                        <input type="text" class="form-control" id="formrow-firstname-input" name="article-author">
                                    </div>

                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="mb-3">
                                                <label class="form-label" for="article-doi">Article DOI</label>
                                                <input type="text" class="form-control" id="formrow-firstname-input" name="article-doi" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="elocator">Article Elocator</label>
                                                <input type="text" class="form-control" id="formrow-firstname-input" name="elocator">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="article-abstract">Article Abstract</label>
                                        <textarea name="article-abstract" class="form-control" id="formrow-firstname-input"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="article-keyword">Article Keywords</label>
                                        <input type="text" class="form-control" id="formrow-firstname-input" name="article-keyword">
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="pdfFile">Upload Pdf File</label>
                                                <input type="file" class="form-control" id="formrow-firstname-input" accept=".pdf" name="pdfFile" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="wordFile">Upload Word File</label>
                                                <input type="file" class="form-control" id="formrow-firstname-input" accept=".docx, .doc" name="wordFile" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-4">
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

<script src="assets/js/app.js"></script>

<script type='text/javascript'>
 $(document).ready(function(){
   // Check or Uncheck All checkboxes
   $("#changetype").change(function(){
   // alert("changes");
      var processingtype = $("#changetype").find(":selected").val();
     // alert(checked);
      if(processingtype == "published" ){
       $(".arcode").each(function(){
         $(".arcode").prop("required",true);
         $(".jmscode").prop("required",false);
       });
     }else{
       $(".jmscode").each(function(){
         $(".jmscode").prop("required",true);
         $(".arcode").prop("required",false);
       });
      }
   });
  

});
</script>

<script type='text/javascript'>
 $(document).ready(function(){
   // Check or Uncheck All checkboxes
   $("#onchangejournal, #onchangeissue, #onchangefpage, #onchangevol").change(function(){
    // alert("changes");
      var journal_code = $("#onchangejournal").find(":selected").text();
      var arr=journal_code.split("---");
    //   alert(arr[0]);
      var volume = $("#onchangevol").val();
    //   alert(volume);
      var issue = $("#onchangeissue").val();
    //   alert(issue);
      var fpage = $("#onchangefpage").val();
    //   alert(fpage);
      var articlecode = arr[0] + "-" + volume + "-" + issue + "-" + fpage;
    //   alert (articlecode);
      $("#arcode").val(articlecode);
   });
  

});
</script>

</body>

</html>