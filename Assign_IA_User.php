<?php include 'layouts/session.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<?php include 'layouts/head-main.php'; ?>
<?php include 'layouts/config.php'; ?>

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

    <style>
        
.checkbox-lg .custom-control-label {
  padding-top: 13px;
  padding-left: 6px;
}

    </style>
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
                        <!-- <h4 class="page-title mb-0 font-size-18">ASSIGN USER ARTICLE</h4> -->
                        <?php

                        $processingstagename = $articlecode = $assignmenttype = "";
                        $ps_id = 2; //procesing stage id
                        $is_id = 3; // IssueID of Issue Table and IssueArticleTable
                        // $ar_id=2;
                        // $ast_id=1;
                        //$is_id =  trim($_GET["isid"]);
                        //  $ps_id =  trim($_GET["psid"]);
                        // $ar_id =  trim($_GET["arid"]);
                        // $ast_id =  trim($_GET["astid"]);

                        $sql = "SELECT * FROM  ProcessingStages WHERE ProcessingStageID  =:id ";
                        $stmt = $pdo->prepare($sql);
                        $stmt->bindParam(":id", $ps_id);
                        $stmt->execute();
                        if ($stmt->rowCount() == 1) {
                            $row = $stmt->fetch();
                            $processingstagename = $row["ProcessingStageName"];
                        }
                        // $sql1 = "SELECT * FROM  Articles WHERE ArticleID =:aid ";
                        // $stmt1 = $pdo->prepare($sql1);
                        // $stmt1->bindParam(":aid", $ar_id);
                        // $stmt1->execute();
                        // if ($stmt1->rowCount() == 1) {
                        //     $row1 = $stmt1->fetch();
                        //     $articlecode = $row1["ArticleCode"];
                        // }

                        $sql2 = "SELECT * FROM  AssignmentTypes WHERE AssignmentTypeID != 1 ";
                        $stmt2 = $pdo->prepare($sql2);
                        // $stmt2->bindParam(":id", $ast_id);
                        $stmt2->execute();
                        // if ($stmt2->rowCount() == 1) {
                            $row2 = $stmt2->fetchAll();
                            // $assignmenttype = $row2["AssignmentTypeName"];
                        // }


                        ?>
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

            <?php

            //Already existing user
            $stmt4 = $pdo->prepare("SELECT Users.UserName ,Users.UserID FROM UserProcessingStages 
INNER JOIN Users ON UserProcessingStages.UserID = Users.UserID WHERE UserProcessingStages.ProcessingStageID = :ps_id ");
            // $stmt4 = $pdo->prepare("SELECT UserID , UserName FROM Users
            // ");
            $stmt4->bindParam(":ps_id", $ps_id);
            $stmt4->execute();
            $row4 = $stmt4->fetchAll();


            $sql5 = "SELECT * FROM Issues INNER JOIN IssueArticles ON Issues.IssueID=IssueArticles.IssueID  ";
                        $stmt5 = $pdo->prepare($sql5);
                        $stmt5->execute();
                        $row5 = $stmt5->fetch();
                        $issue_id = $row5["IssueID"];


             $sql6="SELECT Articles.ArticleCode , Articles.ArticleID FROM Articles 
             INNER JOIN IssueArticles ON Articles.ArticleID = IssueArticles.ArticleID 
             WHERE IssueArticles.IssueID=:is_id AND Articles.ArticleID NOT IN
              ( SELECT ArticleID FROM UserAssignedArticles WHERE ProcessingStageID = :ps_id )";
                        $stmt6= $pdo->prepare($sql6);
                        $stmt6->bindParam(":ps_id", $ps_id);
                        $stmt6->bindParam(":is_id", $is_id);
                        $stmt6->execute();
                        $row6=$stmt6->fetchAll();

            ?>
            <div class="row">


            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="page-title mb-0 font-size-18"> ASSIGN USER ARTICLE</h4> <br>
                            <!-- <h4 class="card-title"></h4> -->

                            <!--    <p class="card-title-desc">Parsley is a javascript form validation library. It helps you provide your users with feedback on their form submission before sending it to your server.</p> -->
                            <form class="custom-validation" action="Assign_Article_User_db.php" method="post" enctype="multipart/form-data">

                                <div class="form-group ">
                                    <input id="psid" name="ps_id" type="hidden" value="<?php echo $ps_id; ?>">
                                    <input id="arid" name="ar_id" type="hidden" value="<?php echo $ar_id; ?>">
                                    <input id="astid" name="ast_id" type="hidden" value="<?php echo $ast_id; ?>">
                                    <input id="isid" name="is_id" type="hidden" value="<?php echo $is_id; ?>">

                                    <label>Processing Stage Name </label>
                                    <input type="text" name="processingstagename" class="form-control" readonly value="<?php echo $processingstagename; ?>" required>

                                </div>

                                <div class="form-group ">
                                    <label for="aricle_type">Assignment Type *</label>
                                    <!-- <input type="text" name="assignmenttype" class="form-control" readonly value="<?php echo $assignmenttype; ?>" required> -->
                                    <select id='changetype' name="article_type" class="form-control">
                                            <?php foreach ($row2 as $output) {
                                            ?>
                                                <option  selected value="<?php echo $output['AssignmentTypeID']; ?>"> <?php echo $output['AssignmentTypeName']; ?>
                                                </option>
                                            <?php
                                            } ?>
                                        </select>

                                </div>

                                <?php
                                if (!isset($_GET['userid'])) { ?>

                                    <div class="form-group ">
                                        <label for="user_id">Assign User Article *</label>
                                        <select name="user_id" class="form-control">
                                            <?php foreach ($row4 as $output) {
                                            ?>
                                                <option value="<?php echo $output['UserID']; ?>"> <?php echo $output['UserName']; ?>
                                                </option>
                                            <?php
                                            } ?>
                                        </select>

                                    </div>
                                <?php
                                } else {
                                    $select_user_stmt = $pdo->prepare("SELECT * FROM Users WHERE UserID = :uid");
                                    $select_user_stmt->bindParam(":uid", $_GET['userid']);
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
                                } ?>

                                <div class="form-group ">
                                    <h6 class="m-2">Article Codes *</h6>
                                    <?php foreach ($row6 as $output) {
                                            ?>
                                            <input type="checkbox" class="checkbox m-2" id='checkall' name="articlecode<?php echo $i;?>" value="<?php echo $output['ArticleID']; ?>" required>
                                     <label> <?php echo $output['ArticleCode']; ?></label> <br>
                                    
                                            <?php
                                            } ?>
                                </div>

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

            </div>
            <!-- end row -->
            <!-- End row -->
            
            <?php if (!isset($_GET['userid'])) { ?>
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="card">
                            <div class="card-body">
                            <h4 class="page-title mb-0 font-size-18">  Articles in User's Pool</h4> <br>
                                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100 align-items-center justify-content-between">
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

            <?php if (!isset($_GET['userid'])) { ?>
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="card">
                            <div class="card-body">
                            <h4 class="page-title mb-0 font-size-18"> Already Assigned Articles</h4> <br>
                                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100 align-items-center justify-content-between">
                                    <thead>
                                        <tr>
                                            <th>Article Code</th>
                                            <th>Username</th>
                                            <th>Assigned Article Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php 

                                            $UserID = $output['UserID'];
                                            $UserName = $output['UserName'];

                                            $sql7="SELECT Articles.ArticleCode, UserAssignedArticles.Date,  UserAssignedArticles.Status , 
                                            UserAssignedArticles.UserID FROM Articles 
                                            INNER JOIN IssueArticles ON Articles.ArticleID = IssueArticles.ArticleID 
                                            INNER JOIN UserAssignedArticles ON Articles.ArticleID = UserAssignedArticles.ArticleID 
                                            WHERE IssueArticles.IssueID=:is_id And UserAssignedArticles.ProcessingStageID = :ps_id
                                            AND Articles.ArticleID IN
                                             ( SELECT ArticleID FROM UserAssignedArticles WHERE ProcessingStageID = :ps_id ) ";
                                            $stmt7=$pdo->prepare($sql7);
                                            $stmt7->bindParam(':is_id',$is_id);
                                            $stmt7->bindParam(':ps_id',$ps_id);
                                            $stmt7->execute();
                                            $row7=$stmt7->fetchAll();
foreach ($row7 as $output7) {

                                            $articlecode=$output7['ArticleCode'];
                                            $a_date=$output7['Date'];
                                            $status=$output7['Status'];

                                            $sql8="SELECT Users.UserID FROM Users INNER JOIN UserAssignedArticles ON Users.UserID = UserAssignedArticles
                                            WHERE ProcessingStageID = :ps_id ";

                                        ?>
                                            <tr>
                                                <td><?php echo $articlecode; ?></td>
                                                <td><?php echo $UserName; ?></td>
                                                <td><?php echo $a_date; ?></td>
                                                <td><?php echo $status; ?></td>


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

<script type='text/javascript'>
 $(document).ready(function(){
   // Check or Uncheck All checkboxes
   $("#changetype").change(function(){
   // alert("changes");
      var checked = $("#changetype").find(":selected").val();
     // alert(checked);
      if(checked == 2 ){
       $(".checkbox").each(function(){
         $(".checkbox").prop("checked",true);
       });
     }else{
       $(".checkbox").each(function(){
         $(this).prop("checked",false);
       });
      }
   });
  

});
</script>
</body>

</html>