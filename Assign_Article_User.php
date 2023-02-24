<?php include 'layouts/session.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if(!isset($_SESSION['id']))
{
  //User not logged in. Redirect them back to the login page.
  header('Location: auth-login.php');
  exit; 
}
?>
<?php include 'layouts/head-main.php'; ?>
<?php include 'layouts/config.php'; ?>

<head>

    <title>Assign Article | XML Workflow</title>
    <?php include 'layouts/head.php'; ?>

    <!-- choices css -->
    <link href="assets/libs/choices.js/public/assets/styles/choices.min.css" rel="stylesheet" type="text/css" />

    <!-- color picker css -->
    <link rel="stylesheet" href="assets/libs/@simonwep/pickr/themes/classic.min.css" /> <!-- 'classic' theme -->
    <link rel="stylesheet" href="assets/libs/@simonwep/pickr/themes/monolith.min.css" /> <!-- 'monolith' theme -->
    <link rel="stylesheet" href="assets/libs/@simonwep/pickr/themes/nano.min.css" /> <!-- 'nano' theme -->

    <!-- datepicker css -->
    <link rel="stylesheet" href="assets/libs/flatpickr/flatpickr.min.css">

     <!-- DataTables -->
     <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />


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
                        <h4 class="page-title mb-0 font-size-18">ASSIGN USER ARTICLE</h4>
                        <?php

$processingstagename=$articlecode=$assignmenttype="";
// $ps_id=2;
// $ar_id=2;
// $ast_id=1;
 $ps_id =  trim($_GET["psid"]);
 $ar_id =  trim($_GET["arid"]);
 $ast_id =  trim($_GET["astid"]);

$sql = "SELECT * FROM  ProcessingStages WHERE ProcessingStageID  =:id ";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":id",$ps_id);
$stmt->execute();
if ($stmt->rowCount() == 1) {
    $row = $stmt->fetch();
    $processingstagename = $row["ProcessingStageName"];
}
$sql1 = "SELECT * FROM  Articles WHERE ArticleID =:aid ";
$stmt1 = $pdo->prepare($sql1);
$stmt1->bindParam(":aid",$ar_id);
$stmt1->execute();
if ($stmt1->rowCount() == 1) {
    $row1 = $stmt1->fetch();
    $articlecode = $row1["ArticleCode"];
}

$sql2 = "SELECT * FROM  AssignmentTypes WHERE AssignmentTypeID =:id ";
$stmt2 = $pdo->prepare($sql2);
$stmt2->bindParam(":id",$ast_id);
$stmt2->execute();
if ($stmt2->rowCount() == 1) {
    $row2 = $stmt2->fetch();
    $assignmenttype = $row2["AssignmentTypeName"];
}


?>
                        
    									<div class="page-title-right">
    										<ol class="breadcrumb m-0">
    											<li class="breadcrumb-item"><a href="javascript: void(0);">File Assignment</a></li>
                                                <li class="breadcrumb-item"><a href="Assign-Dashboard-Article.php">Article wise Assignment</a></li>
    											<li class="breadcrumb-item active">Assign</li>
    										</ol>
    									</div>
    								
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <!-- Start row -->

            <?php

//Already existing user
$stmt4 = $pdo->prepare("SELECT Users.UserName ,Users.UserID FROM UserProcessingStages 
INNER JOIN Users ON UserProcessingStages.UserID = Users.UserID WHERE UserProcessingStages.ProcessingStageID = :ps_id
");
// $stmt4 = $pdo->prepare("SELECT UserID , UserName FROM Users
// ");
$stmt4->bindParam(":ps_id",$ps_id);
$stmt4->execute();
$row4 = $stmt4->fetchAll();

?>
            <div class="row">


            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-lg-5 mx-auto">
                    <div class="card ">
                        <div class="card-body">
                        <h4 class="page-title mb-0 font-size-18">  Assign Article to User</h4> <br>
                            <!-- <h4 class="card-title">Validation type</h4>
                                    <p class="card-title-desc">Parsley is a javascript form validation library. It helps you provide your users with feedback on their form submission before sending it to your server.</p> -->
                            <form class="custom-validation" action="Assign_Article_User_db.php" method="post" enctype="multipart/form-data">

                                <div class="form-group ">
                                    <input id="psid" name="ps_id" type="hidden" value="<?php echo $ps_id; ?>">
                                    <input id="arid" name="ar_id" type="hidden" value="<?php echo $ar_id; ?>">
                                    <input id="astid" name="ast_id" type="hidden" value="<?php echo $ast_id; ?>">
                                    <label>Processing Stage Name </label>
                                    <input type="text" name="processingstagename" class="form-control" readonly value="<?php echo $processingstagename; ?>" required>

                                </div>
                                <div class="form-group ">
                                    <label>Article Code</label>
                                    <input type="text" name="articlecode" class="form-control" readonly value="<?php echo $articlecode; ?>" required>

                                </div>
                                <div class="form-group ">
                                    <label>Assignment Type</label>
                                    <input type="text" name="assignmenttype" class="form-control" readonly value="<?php echo $assignmenttype; ?>" required>

                                </div>

                               <?php 
                                    if(!isset($_GET['userid']))
                                    {?>
                                        
                                        <div class="form-group ">
                                    <label for="user_id">Assign User Article *</label>
                                    <select name="user_id" class="form-control">

                                        <?php foreach ($row4 as $output) { ?>
                                            <option value="<?php echo $output['UserID']; ?>"> <?php echo $output['UserName']; ?>
                                            </option>
                                        <?php
                                        } ?>
                                    </select>

                                </div>
                                <?php 
                                    }else {
                                        $select_user_stmt = $pdo->prepare("SELECT * FROM Users WHERE UserID = :uid") ;
                                        $select_user_stmt->bindParam(":uid",$_GET['userid']);
                                            $select_user_stmt->execute();
                                            $select_user_row = $select_user_stmt->fetch();
                                            $userName = $select_user_row['UserName'];
                                            $userID = $select_user_row['UserID'];
                                           ?>
                                
                               
                                <div class="form-group ">
                                    <label for="user_id">Assign User Article *</label>
                                    <select name="user_id" class="form-control">

                                        <option value="<?php echo $userID; ?>"> <?php echo $userName; ?>
                                        </option>
                                      
                                    </select>

                                </div>
                                <input type="hidden" name="userID" value="<?php echo $_GET['userid']; ?>">
                                <?php 
                                    }?>

                                <br>

                                


                                <div class="form-group mb-0">
                                    <div>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                            Submit
                                        </button>
                                        <a type="reset" class="btn btn-secondary waves-effect" href="QA-Dashboard-User.php">
                                            Cancel
                                        </a>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

            <!-- </div> -->
            <!-- end row -->
            <!-- End row -->

              
            <?php if (!isset($_GET['userid'])) { ?>
                <!-- <div class="row"> -->
                    <div class="col-lg-7 mx-auto">
                        <div class="card bg-soft-primary">
                            <div class="card-body">
                            <h4 class="page-title mb-0 font-size-18">  Articles in User's Pool</h4> <br>
                                <table id="datatable" class="table table-bordered dt-responsive  nowrap  align-items-center justify-content-between">
                                    <thead>
                                        <tr>
                                            <th>Username </th>
                                            <th>Total Articles in User's Pool</th>
                                            <th>Assigned Articles</th>
                                            <th>InProgress Articles</th>
                                            <th>Reassigned Articles</th>
                                            <th>Articles on Hold</th>
                                            <th>Completed Articles</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php foreach ($row4 as $output) {

                                            $UserID = $output['UserID'];
                                            $UserName = $output['UserName'];
                                            $a_count = "SELECT  COUNT(Case When Status='Assigned' then 1 end) as Assigned,
                                 COUNT(Case When Status='InProgress' then 1 end) as InProgress,
                                 COUNT(Case When Status='Completed' then 1 end) as Completed,
                                 COUNT(Case When Status='Reassigned' then 1 end) as Reassigned,
                                 COUNT(Case When Status='Holded' then 1 end) as Holded
                                 FROM `UserAssignedArticles` WHERE UserID=:uid GROUP by UserID;";
                                            $a_count = $pdo->prepare($a_count);
                                            $a_count->bindParam(':uid', $UserID);
                                            $a_count->execute();
                                            $sa_count = $a_count->fetch();

                                            $Assigned = $sa_count['Assigned'];
                                            $InProgress = $sa_count['InProgress'];
                                            $Completed = $sa_count['Completed'];
                                            $Reassigned = $sa_count['Reassigned'];
                                            $Holded = $sa_count['Holded'];
                                            $total = $Assigned + $InProgress + $Holded + $Reassigned;
                                        ?>
                                            <tr>
                                                <td><?php echo $UserName; ?></td>
                                                <td><?php echo $total; ?></td>
                                                <td><?php echo $Assigned; ?></td>
                                                <td><?php echo $InProgress; ?></td>
                                                <td><?php echo $Reassigned; ?></td>
                                                <td><?php echo $Holded; ?></td>
                                                <td><?php echo $Completed; ?></td>


                                            </tr>
                                        <?php    }             ?>



                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- end row -->
                <!-- End row -->
            <?php } ?>

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

<!-- Required datatable js -->
<script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="assets/libs/jszip/jszip.min.js"></script>
<script src="assets/libs/pdfmake/build/pdfmake.min.js"></script>
<script src="assets/libs/pdfmake/build/vfs_fonts.js"></script>
<script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

<!-- Responsive examples -->
<script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

<!-- Datatable init js -->
<script src="assets/js/pages/datatables.init.js"></script>

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