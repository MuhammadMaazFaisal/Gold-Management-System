<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php include 'layouts/config.php';?>

<head>
    <title><?php echo $language["Dashboard"]; ?> Assign Articles | XML Workflow</title>

    <?php include 'layouts/head.php'; ?>

    <link href="assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />

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

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">XML Validator Dashboard</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">XML Workflow</a></li>
                                    <li class="breadcrumb-item active">Article Assignment</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <!--- Start Code for Small Boxes on top -->
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-h-100">
                            <!-- card body -->
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <span class="text-muted mb-3 lh-1 d-block text-truncate">Unassign Article</span>
                                    <?php
                                        
                                        $sql="SELECT COUNT(ArticleID) AS 'totalUnassignedArticles' FROM Articles 
                                        WHERE ArticleID NOT IN (SELECT ArticleID FROM UserAssignedArticles) AND Status = 'Active'";
                                        
                                        $stmt = $pdo->prepare($sql);
                                        
                                        if($stmt->execute()){ $row = $stmt->fetch(); $totalUnassignedArticles=$row['totalUnassignedArticles'];}
                                    ?>
                                    <div class="col-6">
                                        <h4 class="mb-3"> <span class="counter-value" data-target="<?php echo $totalUnassignedArticles;?>">0</span> </h4>
                                    </div>

                                    <div class="col-6">
                                        <div id="mini-chart1" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                    </div>
                                </div>
                                <div class="text-nowrap">
                                    <?php
                                    $week_unassigned_sql = "SELECT COUNT(ArticleID) AS 'lastWeekUnassignedArticles' FROM Articles 
                                    WHERE ArticleID NOT IN (SELECT ArticleID FROM UserAssignedArticles) 
                                    AND Status = 'Active' AND Date between date_sub(now(),INTERVAL 1 WEEK) and now()";
                                    $week_unassigned_stmt=  $pdo->prepare($week_unassigned_sql);
                                    if($week_unassigned_stmt->execute()){ $week_unassigned_row = $week_unassigned_stmt->fetch(); $lastWeekUnassignedArticles=$week_unassigned_row['lastWeekUnassignedArticles'];}
                                    
                                    ?>
                                    <span class="badge bg-soft-success text-success"><?php echo "+".$lastWeekUnassignedArticles. " Articles";?> </span>
                                    <span class="ms-1 text-muted font-size-13">Since last week</span>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-h-100">
                            <!-- card body -->
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <span class="text-muted mb-3 lh-1 d-block text-truncate">Assign Articles</span>
                                    <?php
                                        $User_ID=$_SESSION['id'];

$PSIDxmlconv=2;
$PSIDxmlvalid=3;
$PSIDQA=4;
$PSIDartpkg=5;
$PSIDartdl=6;
                                        
                                        $ProcessingStage = 3;

                                        $query = "SELECT Count(ArticleID) AS UserAssignedArticles FROM UserAssignedArticles 
                                        WHERE UserID = :id AND Status = 'Assigned' AND ProcessingStageID = :ProcessingStage";
                                        
                                        $queryRun = $pdo->prepare($query);
                                        
                                        $queryRun->bindParam(":id", $User_ID);

                                        $queryRun->bindParam(":ProcessingStage", $PSIDxmlvalid);
                                        
                                        if($queryRun->execute()){ $fetchRecord = $queryRun->fetch();  }
                                    ?> 
                                    <div class="col-6">
                                        <h4 class="mb-3"> <span class="counter-value" data-target="<?php echo $fetchRecord['UserAssignedArticles']; ?>">0</span> </h4>
                                    </div>
                                    <div class="col-6">
                                        <div id="mini-chart2" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                    </div>
                                </div>
                                <div class="text-nowrap">
                                    <?php
                                    
                                    $week_assigned_sql = "SELECT Count(UserID) AS lastWeekAssignedArticles FROM UserAssignedArticles WHERE UserID = :id AND Status = 'Assigned' AND ProcessingStageID = :ProcessingStage AND Date between date_sub(now(),INTERVAL 1 WEEK) and now()";
                                    $week_assigned_stmt =  $pdo->prepare($week_assigned_sql);
                                    $week_assigned_stmt->bindParam(":id", $User_ID);
                                    $week_assigned_stmt->bindParam(":ProcessingStage", $ProcessingStage);
                                    if($week_assigned_stmt->execute()){ $week_assigned_row = $week_assigned_stmt->fetch(); $lastWeekAssignedArticles=$week_assigned_row['lastWeekAssignedArticles'];}
                                    ?>
                                    <span class="badge bg-soft-danger text-danger"><?php echo "+".$lastWeekAssignedArticles. " Articles";?></span>
                                    <span class="ms-1 text-muted font-size-13">Since last week</span>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col-->

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-h-100">
                            <!-- card body -->
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <span class="text-muted mb-1 lh-1 d-block text-truncate">Accepted Articles</span>
                                    <?php
                                        $ProcessingStage = 3;
                                        
                                        $ProcessingStage = $_SESSION["ProcessingStage"];

                                       $accept_article_sql = "SELECT Count(UserID) AS UserAcceptArticles FROM UserAssignedArticles WHERE UserID = :id AND Status = 'InProgress' AND ProcessingStageID = :ProcessingStage";
                                        
                                        $accept_article_stmt = $pdo->prepare($accept_article_sql);
                                        
                                        $accept_article_stmt->bindParam(":id", $User_ID);

                                        $accept_article_stmt->bindParam(":ProcessingStage", $ProcessingStage);
                                        
                                        if($accept_article_stmt->execute()){ $accept_article_row = $accept_article_stmt->fetch();  }
                                    ?> 
                                    <div class="col-6">
                                        <h4 class="mb-3"> <span class="counter-value" data-target="<?php echo $accept_article_row['UserAcceptArticles']; ?>">0</span> </h4>
                                    </div>
                                    <div class="col-6">
                                        <div id="mini-chart3" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                    </div>
                                </div>
                                <div class="text-nowrap">
                                <?php
                                    
                                    $week_accept_sql = "SELECT Count(UserID) AS lastWeekAcceptArticles FROM UserAssignedArticles WHERE UserID = :id AND Status = 'InProgress' AND ProcessingStageID = :ProcessingStage AND Date between date_sub(now(),INTERVAL 1 WEEK) and now()";
                                    $week_accept_stmt =  $pdo->prepare($week_accept_sql);
                                    $week_accept_stmt->bindParam(":id", $User_ID);
                                    $week_accept_stmt->bindParam(":ProcessingStage", $ProcessingStage);
                                    if($week_accept_stmt->execute()){ $week_accept_row = $week_accept_stmt->fetch(); $lastWeekAcceptArticles=$week_accept_row['lastWeekAcceptArticles'];}
                                    ?>
                                    <span class="badge bg-soft-success text-success"><?php echo "+".$lastWeekAcceptArticles. " Articles";?></span>
                                    <span class="ms-1 text-muted font-size-13">Since last week</span>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-h-100">
                            <!-- card body -->
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <span class="text-muted mb-3 lh-1 d-block text-truncate">Articles On Hold</span>
                                    <?php
                                        $User_ID=$_SESSION['id'];
                                        
                                        $ProcessingStage = 3;

                                        $hold_article_sql = "SELECT Count(UserID) AS UserHoldedArticles FROM UserAssignedArticles WHERE UserID = :id AND Status = 'Holded' AND ProcessingStageID = :ProcessingStage";
                                        
                                        $hold_article_stmt = $pdo->prepare($hold_article_sql);
                                        
                                        $hold_article_stmt->bindParam(":id", $User_ID);

                                        $hold_article_stmt->bindParam(":ProcessingStage", $ProcessingStage);
                                        
                                        if($hold_article_stmt->execute()){ $hold_article_row = $hold_article_stmt->fetch();  }
                                    ?> 
                                    <div class="col-6">
                                        <h4 class="mb-3"> <span class="counter-value" data-target="<?php echo $hold_article_row['UserHoldedArticles']; ?>">0</span> </h4>
                                    </div>
                                    <div class="col-6">
                                        <div id="mini-chart4" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                    </div>
                                </div>
                                <div class="text-nowrap">
                                <?php
                                    
                                    $week_hold_sql = "SELECT Count(UserID) AS lastWeekHoldedArticles FROM UserAssignedArticles WHERE UserID = :id AND Status = 'Holded' AND ProcessingStageID = :ProcessingStage AND Date between date_sub(now(),INTERVAL 1 WEEK) and now()";
                                    $week_hold_stmt =  $pdo->prepare($week_hold_sql);
                                    $week_hold_stmt->bindParam(":id", $User_ID);
                                    $week_hold_stmt->bindParam(":ProcessingStage", $ProcessingStage);
                                    if($week_hold_stmt->execute()){ $week_hold_row = $week_hold_stmt->fetch(); $lastWeekHoldedArticles=$week_hold_row['lastWeekHoldedArticles'];}
                                    ?>
                                    <span class="badge bg-soft-success text-success"><?php echo $lastWeekHoldedArticles; ?></span>
                                    <span class="ms-1 text-muted font-size-13">Since last week</span>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                </div><!-- end row-->



                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-h-100">
                            <!-- card body -->
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <span class="text-muted mb-3 lh-1 d-block text-truncate">Complete Article</span>
                                    <?php
                                        $User_ID=$_SESSION['id'];
                                        
                                        $ProcessingStage = 3;

                                        $complete_article_sql = "SELECT Count(UserID) AS UserCompletedArticles FROM UserAssignedArticles WHERE UserID = :id AND Status = 'Completed' AND ProcessingStageID = :ProcessingStage";
                                        
                                        $complete_article_stmt = $pdo->prepare($complete_article_sql);
                                        
                                        $complete_article_stmt->bindParam(":id", $User_ID);

                                        $complete_article_stmt->bindParam(":ProcessingStage", $ProcessingStage);
                                        
                                        if($complete_article_stmt->execute()){ $complete_article_row = $complete_article_stmt->fetch();  }
                                    ?> 
                                    <div class="col-6">
                                        <h4 class="mb-3"> <span class="counter-value" data-target="<?php echo $complete_article_row['UserCompletedArticles']; ?>">0</span> </h4>
                                    </div>

                                    <div class="col-6">
                                        <div id="mini-chart1" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                    </div>
                                </div>
                                <div class="text-nowrap">
                                <?php
                                    
                                    $week_complete_sql = "SELECT Count(UserID) AS lastWeekCompletedArticles FROM UserAssignedArticles WHERE UserID = :id AND Status = 'Completed' AND ProcessingStageID = :ProcessingStage AND Date between date_sub(now(),INTERVAL 1 WEEK) and now()";
                                    $week_complete_stmt =  $pdo->prepare($week_complete_sql);
                                    $week_complete_stmt->bindParam(":id", $User_ID);
                                    $week_complete_stmt->bindParam(":ProcessingStage", $ProcessingStage);
                                    if($week_complete_stmt->execute()){ $week_complete_row = $week_complete_stmt->fetch(); $lastWeekCompletedArticles=$week_complete_row['lastWeekCompletedArticles'];}
                                    ?>
                                    <span class="badge bg-soft-success text-success"><?php echo $lastWeekCompletedArticles; ?></span>
                                    <span class="ms-1 text-muted font-size-13">Since last week</span>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-h-100">
                            <!-- card body -->
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <span class="text-muted mb-3 lh-1 d-block text-truncate">Rejected By QA Stage</span>
                                    <div class="col-6">
                                        <h4 class="mb-3"> <span class="counter-value" data-target="6258">0</span> </h4>
                                    </div>
                                    <div class="col-6">
                                        <div id="mini-chart5" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                    </div>
                                </div>
                                <div class="text-nowrap">
                                    <span class="badge bg-soft-danger text-danger">-29 Articles</span>
                                    <span class="ms-1 text-muted font-size-13">Since last week</span>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col-->
                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-h-100">
                            <!-- card body -->
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <span class="text-muted mb-3 lh-1 d-block text-truncate">Articles Accepted by QA Stage</span>
                                    <?php
                                        $User_ID=$_SESSION['id'];
                                        
                                        $QaProcessingStage = 4;

                                        $qa_accept_article_sql = "SELECT Count(UserID) AS UserQAAcceptArticles FROM UserAssignedArticles WHERE UserID = :id AND Status = ' InProgress' AND ProcessingStageID = :ProcessingStage";
                                        
                                        $qa_accept_article_stmt = $pdo->prepare($qa_accept_article_sql);
                                        
                                        $qa_accept_article_stmt->bindParam(":id", $User_ID);

                                        $qa_accept_article_stmt->bindParam(":ProcessingStage", $QaProcessingStage);
                                        
                                        if($qa_accept_article_stmt->execute()){ $qa_accept_article_row = $qa_accept_article_stmt->fetch();  }
                                    ?> 
                                    <div class="col-6">
                                        <h4 class="mb-3"><span class="counter-value" data-target="<?php echo $qa_accept_article_row['UserQAAcceptArticles']; ?>">0</span> </h4>
                                    </div>
                                    <div class="col-6">
                                        <div id="mini-chart4" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                    </div>
                                </div>
                                <div class="text-nowrap">
                                <?php
                                    
                                    $week_qa_accept_sql = "SELECT Count(UserID) AS lastWeekQAAcceptArticles FROM UserAssignedArticles WHERE UserID = :id AND Status = 'InProgress' AND ProcessingStageID = :ProcessingStage AND Date between date_sub(now(),INTERVAL 1 WEEK) and now()";
                                    $week_qa_accept_stmt =  $pdo->prepare($week_qa_accept_sql);
                                    $week_qa_accept_stmt->bindParam(":id", $User_ID);
                                    $week_qa_accept_stmt->bindParam(":ProcessingStage", $QaProcessingStage);
                                    if($week_qa_accept_stmt->execute()){ $week_qa_accept_row = $week_qa_accept_stmt->fetch(); $lastWeekQAAcceptArticles=$week_qa_accept_row['lastWeekQAAcceptArticles'];}
                                    ?>
                                    <span class="badge bg-soft-success text-success"><?php echo $lastWeekQAAcceptArticles; ?></span>
                                    <span class="ms-1 text-muted font-size-13">Since last week</span>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-h-100">
                            <!-- card body -->
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <span class="text-muted mb-3 lh-1 d-block text-truncate">Total Articles</span>
                                    <div class="col-6">
                                        <h4 class="mb-3"> <span class="counter-value" data-target="432">0</span> </h4>
                                    </div>
                                    <div class="col-6">
                                        <div id="mini-chart3" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                    </div>
                                </div>
                                <div class="text-nowrap">
                                    <span class="badge bg-soft-success text-success">+28 Articles</span>
                                    <span class="ms-1 text-muted font-size-13">Since last week</span>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    
                </div><!-- end row-->

                <!-- END code for Small Boxes on top -->

                  <!-- Start code for XML Conversion tables -->
                  <div class="row">
                        <div class="col-12">
                              <div class="card">
                                    <div class="card-header" style="background-color:#c1c3ee;">
                                          <h4 class="card-title" >UnAssign Articles Available For XML Validation</h4> 
                                    </div>
                                    <div class="card-body">
                                          <?php 
                                          $DefaultProcessingStageName="XML Validation";
                                          // All Articles NOT in (Articles in Assigned Table for XML Conversion) and word and pdf files present in Record FIles table

                                          $sql1="SELECT *  FROM Articles where ArticleID in
                                          (SELECT ArticleID as xmlval FROM UserAssignedArticles 
                                          where ArticleID not in (Select ArticleID from `UserAssignedArticles` where ProcessingStageID > '$PSIDxmlconv' ) 
                                          and `Status`='Completed' and ProcessingStageID= '$PSIDxmlconv' ) and `Status`='Active'";
                                         

                                          $stmt1 = $pdo->prepare($sql1);
                                                                              
                                         

                                          //$stmt1->bindParam(":ProcessingStageName", $DefaultProcessingStageName);
                                          
                                          //$xml_con_user = 
                                          ?>

                                         
                                          <table id="datatable1" class="table table-bordered dt-responsive  nowrap w-100">
                                                <thead>
                                                <tr>  <th>ArticleTitle</th>
                                                      <th>ArticleCode</th>
                                                      <th>Journal/Vol/Issue/Year/</th>
                                                      <th>Date</th>
                                                      <th>Delay</th>
                                                      <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                      <?php
                                                      if($stmt1->execute())
                                                      { 
                                                            while($row1 = $stmt1->fetch())
                                                            {  
                                                      ?>
                                                      <tr>
                                                            <td><?php echo wordwrap($row1["ArticleTitle"], 35, "<br>\n");?></td>
                                                            <td><?php echo $row1['ArticleCode'] ?></td>
                                                            <td><?php
                                                                $jid1 = $row1["JournalID"];
                                                                $jsql1 = "SELECT JournalCode FROM Journals Where JournalID=$jid1";
                                                                $jstmt1 = $pdo->prepare($jsql1);
                                                                if ($jstmt1->execute()) {
                                                                    $jrow1 = $jstmt1->fetch();
                                                                    echo "Journal: " . $jcode1 = $jrow1['JournalCode'];
                                                                }
                                                                echo "<br>Volume: " . $jcode1 = $row1['ArticleVolume'];
                                                                echo "<br>Issue: " . $jcode1 = $row1['ArticleIssue'];
                                                                echo "<br>Year: " . $jcode1 = $row1['ArticleYear'];
                                                                ?></td>
                                                                <td><?php
                                                                    $now = time(); // or your date as well
                                                                    $your_date = strtotime($row1["Date"]);
                                                                    $datediff = $now - $your_date;
                                                                    echo "<span class='text-danger'>" . round($datediff / (60 * 60 * 24)) . "  Days </span>";

                                                                    ?></td>
                                                                <td><?php echo date("Y-m-d", strtotime($row1["Date"])); ?></td>
                                                            
                                                            <td><a href="Assign_Article_User.php?psid=3&arid=<?php echo $row1["ArticleID"]; ?>&astid=1&userid=<?php echo $_SESSION['id']; ?>" class="btn btn-info">Assign</a></td>                                                         
                                                      </tr>

                                                      <?php }}?>
                                    
                                          
                                                </tbody>
                                          </table>

                                    </div>
                              </div>
                        </div> <!-- end col -->
                  </div> <!-- end row -->


                   <!-- End code for XML Conversion tables -->
                                     <!-- Start code for XML Validation tables -->
                  <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header" style="background-color:#c1c3ee;">
                                <h4 class="card-title">Assigned Articles For XML Validation</h4> 
                            </div>
                            <div class="card-body">

                              <?php 
                                    $DefaultProcessingStageName="XML Validation";
                                    // All Articles NOT in (Articles in Assigned Table for XML Conversion) and word and pdf files present in Record FIles table
                                                
                                    $sql2 = "SELECT * From Articles Where ArticleID IN (SELECT ArticleID From UserAssignedArticles ,ProcessingStages 
                                          where ProcessingStages.ProcessingStageID = UserAssignedArticles.ProcessingStageID and ProcessingStageName=:ProcessingStageName AND UserAssignedArticles.UserID = :id AND UserAssignedArticles.Status = 'Assigned')";

                                    //$sql2="SELECT * From Articles Where ArticleID  IN (SELECT ArticleID From UserAssignedArticles  
                                          //WHERE UserID = :id AND Status = 'Assigned' AND ProcessingStageID = :ProcessingStage)";

                                    $stmt2 = $pdo->prepare($sql2);
                                                                        
                                    $stmt2->bindParam(":id", $User_ID);

                                    $stmt2->bindParam(":ProcessingStageName", $DefaultProcessingStageName);?>
                                    <table id="datatable2" class="table table-bordered dt-responsive  nowrap w-100">
                                          <thead>
                                          <tr>
                                            <th>ArticleTitle</th>
                                            <th>ArticleCode</th>
                                            <th>Journal/Vol/Issue/Year/</th>
                                            <th>Word/PDF Files</th>
                                            <th>XML Files</th>
                                            <th>Assign Date</th>
                                            <th>Delay</th>
                                            <th>Action</th>
                                          </tr>
                                          </thead>
                                          <tbody>
                                                <?php
                                                if($stmt2->execute())
                                                { 
                                                      while($row2 = $stmt2->fetch())
                                                      {  
                                                ?>
                                                <tr>
                                                <td><?php echo wordwrap($row2["ArticleTitle"], 35, "<br>\n");?></td>
                                                      <td><?php echo $row2['ArticleCode'] ?></td>
                                                      <td><?php
                                                            $jid2 = $row2["JournalID"];
                                                            $jsql2 = "SELECT JournalCode FROM Journals Where JournalID=$jid2";
                                                            $jstmt2 = $pdo->prepare($jsql2);
                                                            if ($jstmt2->execute()) {
                                                                $jrow2 = $jstmt2->fetch();
                                                                echo "Journal: " . $jcode2 = $jrow2['JournalCode'];
                                                            }
                                                            echo "<br>Volume: " . $jcode2 = $row2['ArticleVolume'];
                                                            echo "<br>Issue: " . $jcode2 = $row2['ArticleIssue'];
                                                            echo "<br>Year: " . $jcode2 = $row2['ArticleYear'];
                                                            ?>
                                                        </td>
                                                        <td>
                                                    <?php

                                                    // fetch pdf files
                                                    $pdf_sql = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND FileType = 'pdf')";
                                                    $pdf_stmt = $pdo->prepare($pdf_sql);
                                                    $pdf_stmt->bindParam(":articleID", $row2["ArticleID"]);
                                                    $pdf_result = $pdf_stmt->execute();
                                                    $pdf_result = $pdf_stmt->fetch();

                                                    // fetch docx files
                                                    $wordFile = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND (FileType = 'docx' or FileType = 'doc'))";
                                                    $word_stmt = $pdo->prepare($wordFile);
                                                    $word_stmt->bindParam(":articleID", $row2["ArticleID"]);
                                                    $word_result = $word_stmt->execute();
                                                    $word_result = $word_stmt->fetch();
                                                    
                                                    // fetch docx files
                                                    $xmlFile = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND (FileType = 'xml' or FileType = 'XML'))";
                                                    $xml_stmt = $pdo->prepare($xmlFile);
                                                    $xml_stmt->bindParam(":articleID", $row2["ArticleID"]);
                                                    $xml_result = $xml_stmt->execute();
                                                    $xml_result = $xml_stmt->fetch();
                                                    ?>
                                                    <a href="Download_file.php?file_id=<?php echo $pdf_result['ArticlesFilesRecordID'] ?>" class="btn btn-primary">PDF File</a>
                                                    <br><a href="Download_file.php?file_id=<?php echo $word_result['ArticlesFilesRecordID'] ?>" class="btn btn-primary mt-1">Word File</a>
                                                </td>
                                                <td><a href="Article_XML_View.php?file_id=<?php echo $xml_result['ArticlesFilesRecordID'] ;?>&file_name=<?php echo $xml_result['FileName'] ?>" class="btn btn-primary">XML Converted File</a></td>
                                                        <td><?php 
                                                        $date_sql = "SELECT * FROM UserAssignedArticles WHERE  ArticleID = :articleID AND Status = 'Assigned' AND ProcessingStageID =:psid ";
                                                        $date_stmt = $pdo->prepare($date_sql);
                                                        $date_stmt->bindParam(":articleID", $row2["ArticleID"]);
                                                        $date_stmt->bindParam(":psid", $PSIDxmlvalid);
                                                        $date_result = $date_stmt->execute();
                                                        $date_result = $date_stmt->fetch();
                                                        echo date("Y-m-d", strtotime($date_result["Date"])); ?></td>
                                                        <td><?php                                                            $now = time(); // or your date as well
                                                            $your_date = strtotime($date_result["Date"]);
                                                            $datediff = $now - $your_date;
                                                            echo "<span class='text-danger'>" . round($datediff / (60 * 60 * 24)) . "  Days </span>";

                                                            ?></td>

                                                      
                                                      <td><a href="Assign_Article_Accept.php?psid=<?php echo $PSIDxmlvalid; ?>&arid=<?php echo $row2["ArticleID"]; ?>&astid=1"class="btn btn-info btn-sm m-1 " disabled>Accept</a> <a class="btn btn-danger btn-sm m-1 " disabled>Reject</a></td>                                                            
                                                </tr>

                                                <?php }}?>
                              
                                    
                                          </tbody>
                                    </table>

                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->


                   <!-- End code for XML Validation tables -->
                    <!-- Start code for QA tables -->
                  <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header" style="background-color:#c1c3ee;">
                                <h4 class="card-title" >XML Validation: Accepted Articles</h4> 
                            </div>
                            <div class="card-body">

                               <?php 
                                    $DefaultProcessingStageName="XML Validation";
                                    // All Articles NOT in (Articles in Assigned Table for XML Conversion) and word and pdf files present in Record FIles table
                                                
                                    $sql3="SELECT * From Articles Where ArticleID IN (SELECT ArticleID From UserAssignedArticles ,ProcessingStages 
                                    where ProcessingStages.ProcessingStageID = UserAssignedArticles.ProcessingStageID and ProcessingStageName=:ProcessingStageName AND UserAssignedArticles.UserID = :id AND UserAssignedArticles.Status = 'InProgress')";

                                    $stmt3 = $pdo->prepare($sql3);
                                                                        
                                    $stmt3->bindParam(":id", $User_ID);

                                    $stmt3->bindParam(":ProcessingStageName", $DefaultProcessingStageName);?>
                                    <table id="datatable3" class="table table-bordered dt-responsive  nowrap w-100">
                                          <thead>
                                          <tr>
                                            <th>ArticleTitle</th>
                                            <th>ArticleCode</th>
                                            <th>Journal/Vol/Issue/Year/</th>
                                            <th>Word/PDF Files</th>
                                            <th>XML Files</th>
                                            <th>Assign Date</th>
                                            <th>Delay</th>
                                            <th>Action</th>
                                          </tr>
                                          </thead>
                                          <tbody>
                                                <?php
                                                if($stmt3->execute())
                                                { 
                                                      while($row3 = $stmt3->fetch())
                                                      {  
                                                ?>
                                                <tr>
                                                    <td><?php echo wordwrap($row3["ArticleTitle"], 35, "<br>\n");?></td>
                                                    <td><?php echo $row3['ArticleTitle'] ?></td>
                                                    <td><?php
                                                            $jid3 = $row3["JournalID"];
                                                            $jsql3 = "SELECT JournalCode FROM Journals Where JournalID=$jid3";
                                                            $jstmt3 = $pdo->prepare($jsql3);
                                                            if ($jstmt3->execute()) {
                                                                $jrow3 = $jstmt3->fetch();
                                                                echo "Journal: " . $jcode3 = $jrow3['JournalCode'];
                                                            }
                                                            echo "<br>Volume: " . $jcode3 = $row3['ArticleVolume'];
                                                            echo "<br>Issue: " . $jcode3 = $row3['ArticleIssue'];
                                                            echo "<br>Year: " . $jcode3 = $row3['ArticleYear'];
                                                            ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        // fetch pdf files
                                                        $pdf_sql = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND FileType = 'pdf')";
                                                        $pdf_stmt = $pdo->prepare($pdf_sql);
                                                        $pdf_stmt->bindParam(":articleID", $row3["ArticleID"]);
                                                        $pdf_result = $pdf_stmt->execute();
                                                        $pdf_result = $pdf_stmt->fetch();

                                                        // fetch docx files
                                                        $wordFile = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND (FileType = 'docx' or FileType = 'doc'))";
                                                        $word_stmt = $pdo->prepare($wordFile);
                                                        $word_stmt->bindParam(":articleID", $row3["ArticleID"]);
                                                        $word_result = $word_stmt->execute();
                                                        $word_result = $word_stmt->fetch();
                                                        
                                                        // fetch docx files
                                                        
                                                        ?>
                                                        <a href="Download_file.php?file_id=<?php echo $pdf_result['ArticlesFilesRecordID'] ?>" class="btn btn-primary">PDF File</a>
                                                        <br><a href="Download_file.php?file_id=<?php echo $word_result['ArticlesFilesRecordID'] ?>" class="btn btn-primary mt-1">Word File</a>
                                                    </td>
                                                    <td>
                                                        <?php
                                                            $ineraFile = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND FileType = 'XML Converted')";
                                                            $inera_stmt = $pdo->prepare($ineraFile);
                                                            $inera_stmt->bindParam(":articleID", $row3["ArticleID"]);
                                                            $inera_result = $inera_stmt->execute();
                                                            $inera_result = $inera_stmt->fetch();

                                                            // fetch XML Valid
                                                            $validFile = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND (FileType = 'XML Valid'))";
                                                            $valid_stmt = $pdo->prepare($validFile);
                                                            $valid_stmt->bindParam(":articleID", $row3["ArticleID"]);
                                                            $valid_result = $valid_stmt->execute();
                                                            $valid_result = $valid_stmt->fetch();
                                                     
                                                        ?>
                                                        <a href="Article_XML_View.php?file_id=<?php echo $inera_result["ArticlesFilesRecordID"]; ?>&file_name=<?php echo $inera_result['FileName'];?>" class="btn btn-primary">XML Conversion File</a><br>
                                                    <a style="margin-top: 5px;" href="Article_XML_View.php?file_id=<?php echo $valid_result["ArticlesFilesRecordID"]; ?>&file_name=<?php echo $valid_result['FileName']?>" class="btn btn-primary">XML Compilation File</a></td>
                                                        
                                                      
                                                    <td><a  class="btn btn-info btn-sm m-1" disabled>Accept</a> <a class="btn btn-danger btn-sm m-1 " disabled>Reject</a></td>                                                            
                                                </tr>

                                                <?php }}?>
                              
                                    
                                          </tbody>
                                    </table>

                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->


                   <!-- End code for QA tables -->

                   <!-- Start code for Articles Available For Packaging tables -->
                  <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header" style="background-color:#c1c3ee;">
                                <h4 class="card-title" >XML Validation: Rejected Articles</h4> 
                            </div>
                            <div class="card-body">

                            <?php 
                                    $DefaultProcessingStageName="XML Validation";
                                    // All Articles NOT in (Articles in Assigned Table for XML Conversion) and word and pdf files present in Record FIles table
                                                
                                    $sql4="SELECT * From Articles Where ArticleID IN (SELECT ArticleID From UserAssignedArticles ,ProcessingStages 
                                    where ProcessingStages.ProcessingStageID = UserAssignedArticles.ProcessingStageID and ProcessingStageName=:ProcessingStageName AND UserAssignedArticles.UserID = :id AND UserAssignedArticles.Status = 'Holded')";

                                    $stmt4 = $pdo->prepare($sql4);
                                                                        
                                    $stmt4->bindParam(":id", $User_ID);

                                    $stmt4->bindParam(":ProcessingStageName", $DefaultProcessingStageName);?>
                                    <table id="datatable4" class="table table-bordered dt-responsive  nowrap w-100">
                                          <thead>
                                          <tr>
                                                <th>ArticleCode</th>
                                                <th>ArticleTitle</th>
                                                <th>Action</th>
                                          </tr>
                                          </thead>
                                          <tbody>
                                                <?php
                                                if($stmt4->execute())
                                                { 
                                                      while($row4 = $stmt4->fetch())
                                                      {  
                                                ?>
                                                <tr>
                                                      <td><?php echo $row4['ArticleCode'] ?></td>
                                                      <td><?php echo $row4['ArticleTitle'] ?></td>
                                                      
                                                      <td><a  class="btn btn-info btn-sm m-1 " disabled>Accept</a> <a class="btn btn-danger btn-sm m-1 " disabled>Reject</a></td>                                                            
                                                </tr>

                                                <?php }}?>
                              
                                    
                                          </tbody>
                                    </table>

                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->


                   <!-- End code for Articles Available For Packaging tables -->
                    <!-- Start code for Articles Available For Delivery tables -->
                  <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header" style="background-color:#c1c3ee;">
                                <h4 class="card-title" >Articles Available For Delivery</h4> 
                            </div>
                            <div class="card-body">

                                <table id="datatable5" class="table table-bordered dt-responsive  nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>ArticleCode</th>
                                            <th>ArticleTitle</th>
                                            <th>AddedBy</th>
                                            <th>Date</th>
                                            <th>Delay</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        <tr>
                                            <td>Tiger Nixon</td>
                                            <td>System Architect</td>
                                            <td>Edinburgh</td>
                                            <td>61</td>
                                            <td>2011/04/25</td>
                                            <td>Assign</td>
                                        </tr>
                                         
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->


                   <!-- End code for Articles Available For Delivery tables -->



            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

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




<!-- apexcharts -->
<script src="assets/libs/apexcharts/apexcharts.min.js"></script>

<!-- Plugins js-->
<script src="assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js"></script>

<!-- dashboard init -->
<script src="assets/js/pages/dashboard.init.js"></script>

<!-- App js -->
<script src="assets/js/app.js"></script>
<script>

$(document).ready(function() {
    $('#datatable1').DataTable();
    $('#datatable2').DataTable();
    $('#datatable3').DataTable();
    $('#datatable4').DataTable();
    $('#datatable5').DataTable();

    //Buttons examples
    var table = $('#datatable-buttons').DataTable({
        lengthChange: false,
        buttons: ['copy', 'excel', 'pdf', 'colvis']
    });

    table.buttons().container()
        .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');

    $(".dataTables_length select").addClass('form-select form-select-sm');
});
</script>

</body>

</html>