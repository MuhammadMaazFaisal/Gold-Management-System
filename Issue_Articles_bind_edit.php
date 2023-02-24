<?php include 'layouts/session.php';

// Include config file
require_once "layouts/config.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if(!isset($_SESSION['EBIA']))
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
    <div class="main-content">
        <div class="page-content">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="page-title mb-0 font-size-18">SELECT ARTICLES</h4>
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
$Issue_id = $_GET['id'];

//Already existing roles
$stmt = $pdo->prepare("SELECT Articles.ArticleID, ArticleCode FROM Articles INNER JOIN IssueArticles 
ON Articles.ArticleID = IssueArticles.ArticleID WHERE IssueArticles.IssueID = '$Issue_id'");
$stmt->execute();
$row = $stmt->fetchAll();


$stmt = $pdo->prepare("SELECT IssueID, Issue, Volume, Journals_JournalID FROM Issues WHERE IssueID='$Issue_id'");
$stmt->execute();
$row2 = $stmt->fetch();
$Issue=$row2["Issue"];
$Volume=$row2["Volume"];
$Journal=$row2["Journals_JournalID"];

$stmt = $pdo->prepare("SELECT ArticleID, ArticleCode FROM Articles WHERE ArticleIssue=:Issue
 AND ArticleVolume=:Volume AND JournalID=:journalid");
$stmt->bindParam(":Issue",$Issue);
$stmt->bindParam(":Volume",$Volume);
$stmt->bindParam(":journalid",$Journal);

$stmt->execute();
$row2 = $stmt->fetchAll();
?>


</div>
<!-- end row -->
<div class="row">
<div class="col-lg-6">
    <div class="card">
        <div class="card-body">
            <!-- <h4 class="card-title">Validation type</h4>
                    <p class="card-title-desc">Parsley is a javascript form validation library. It helps you provide your Issues with feedback on their form submission before sending it to your server.</p> -->

            <form class="custom-validation" action="Issue_Articles_bind_edit_db.php" method="post" enctype="multipart/form-data">

                <div class="form-group mb-0">
                    <label class="control-label">Article Code</label>

                    <select class="form-control" data-trigger name="article_code[]" id="choices-multiple-default" placeholder="This is a placeholder" multiple>

                        <?php foreach ($row as $output) { ?>
                            <option value="<?php echo $output['ArticleID']; ?>" <?php echo ' selected="selected"'; ?>> <?php echo $output['ArticleCode']; ?>
                            </option>
                        <?php
                        } ?>

                        <?php foreach ($row2 as $output) { ?>
                            <option value="<?php echo $output['ArticleID']; ?>"> <?php echo $output['ArticleCode']; ?> </option>
                        <?php
                        } ?>


                    </select>
                    <input id="id" name="id" type="hidden" value="<?php echo $_GET['id']; ?>">

                </div>

                <br>

                <div class="form-group mb-0">
                    <div>
                        <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                            Submit
                        </button>
                        <a type="reset" class="btn btn-secondary waves-effect" href="Issue_Articles_bind.php">
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


        <!-- Footer Start -->
        <?php include 'layouts/footer.php'; ?>
        <!-- Footer End -->


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