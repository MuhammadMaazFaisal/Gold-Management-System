<?php include 'layouts/session.php';

// Include config file
require_once "layouts/config.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(!isset($_SESSION['VBIA']))
{
  //User not logged in. Redirect them back to the error page.
  header('Location: pages-403.php');
  exit; 
}
  

?>
<?php include 'layouts/head-main.php'; ?>

<head>

    <title>Bind Issue Articles | XML Workflow </title>
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
                        <h4 class="page-title mb-0 font-size-18"> </h4>
                        <!-- <div class="page-title-right">
    										<ol class="breadcrumb m-0">
    											<li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
    											<li class="breadcrumb-item active">Profile</li>
    										</ol>
    									</div> -->
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <h3>Bind Issue Articles</h3>
            <fieldset>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">


                                <?php

                                //Already existing journals

                                //SELECT IssueID , GROUP_CONCAT(ArticleID SEPARATOR ',') AS aid FROM `IssueArticles` WHERE 1 GROUP BY IssueID

                                $stmt1 = $pdo->prepare("SELECT Issues.IssueID , GROUP_CONCAT(ArticleID SEPARATOR ',') AS aid 
                                FROM Issues LEFT JOIN `IssueArticles` ON Issues.IssueID=IssueArticles.IssueID WHERE 1 GROUP BY Issues.IssueID");
                                $stmt1->execute();
                                //$row1=$stmt1->fetchAll();



                                ?>


                                <table id="datatable" class="display table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" role="grid">
                                    <thead>
                                        <tr>
                                            <th>Journal Code</th>
                                            <th>Volume</th>
                                            <th>Year</th>
                                            <th>Issue</th>
                                            <th>Article Codes</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr> <?php while ($row1 = $stmt1->fetch()) {
                                                    $i_ids = $row1["IssueID"];
                                                    $stmt2 = $pdo->prepare("SELECT * FROM Issues WHERE IssueID=:i_id");
                                                    $stmt2->bindParam(":i_id", $i_ids);
                                                    $stmt2->execute();
                                                    $row2 = $stmt2->fetch();
                                                    $j_id = $row2["Journals_JournalID"];

                                                    $stmt = $pdo->prepare("SELECT * FROM Journals WHERE JournalID=:j_id");
                                                    $stmt->bindParam(":j_id", $j_id);
                                                    $stmt->execute();
                                                    $row = $stmt->fetch();
                                                ?>
                                                <td><?php echo $row["JournalCode"]; ?></td>
                                                <td><?php echo $row2["Volume"]; ?></td>
                                                <td><?php echo $row2["Year"]; ?></td>
                                                <td><?php echo $row2["Issue"]; ?></td>
                                                <td><?php
                                                    if ($row1["aid"] != "") {
                                                        $a_ids = $row1["aid"];
                                                        $a_ids_arr = explode(",", $a_ids);
                                                        $res = "";
                                                        foreach ($a_ids_arr as $id) {
                                                            $stmtr = $pdo->prepare("SELECT ArticleCode FROM Articles WHERE ArticleID =$id");
                                                            $stmtr->execute();
                                                            $rowr = $stmtr->fetch();

                                                            $res .= $rowr["ArticleCode"] . " ,";
                                                        }
                                                        $final = "";
                                                        $res = substr_replace($res, "", -1);

                                                        echo wordwrap($res, 50, "<br>\n");
                                                    }   ?></td>
                                                    <td><a class="btn btn-info btn-sm m-1" href="Issue_Articles_bind_edit.php?id=<?php echo $row2["IssueID"]; ?>">Modify</a> </td>
                                        </tr>
                                    <?php } ?>

                                    </tbody>
                                </table>
                            </div>
                            <?php ?>
                        </div>
                    </div>
                    <!-- end col -->
                 </div>
               <!-- end row -->

            </fieldset>

            <!-- end row -->

            </form>
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