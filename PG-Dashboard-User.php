<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php include 'layouts/config.php'; ?>
<?php if (!isset($_SESSION['Super Admin']) && !isset($_SESSION['APK'])) {
     header('Location: pages-403.php');
     exit; 
} ?>
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
                            <h4 class="mb-sm-0 font-size-18">Packaging Dashboard</h4>

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
                                    $PSIDxmlconv = 2;
                                    $PSIDxmlvalid = 3;
                                    $PSIDQA = 4;
                                    $PSIDartpkg = 5;
                                    $PSIDartdl = 6;

                                    $sql = "SELECT Count(ArticleID) as PG FROM UserAssignedArticles where ArticleID not in (Select ArticleID from `UserAssignedArticles` where ProcessingStageID > $PSIDQA )  
                                    and `Status`='Completed' and ProcessingStageID= $PSIDQA;";
                                    $stmt = $pdo->prepare($sql);
                                    if ($stmt->execute()) {
                                        $row = $stmt->fetch();
                                        $TotalArticles = $row['PG'];
                                    }
                                    ?>
                                    <div class="col-6">
                                        <h4 class="mb-3"> <span class="counter-value" data-target="<?php echo $TotalArticles; ?>">0</span> </h4>
                                    </div>

                                    <div class="col-6">
                                        <div id="mini-chart1" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                    </div>
                                </div>
                                <div class="text-nowrap">
                                    <?php
                                    $week_assigned_sql = "SELECT Count(ArticleID) as lastWeekArticles FROM UserAssignedArticles 
                                     where ArticleID not in (Select ArticleID from `UserAssignedArticles` where ProcessingStageID > '$PSIDQA' ) 
                                     and `Status`='Completed' and ProcessingStageID= '$PSIDQA'  AND Date between date_sub(now(),INTERVAL 1 WEEK) and now()";
                                    $week_assigned_stmt =  $pdo->prepare($week_assigned_sql);
                                    if ($week_assigned_stmt->execute()) {
                                        $week_assigned_row = $week_assigned_stmt->fetch();
                                        $lastWeekUnassignedArticles = $week_assigned_row['lastWeekArticles'];
                                    }
                                    ?>
                                    <span class="badge bg-soft-success text-success"><?php echo  $lastWeekUnassignedArticles . " Articles"; ?> </span>
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
                                    $User_ID = $_SESSION['id'];
                                    $PSIDxmlconv = 2;
                                    $PSIDxmlvalid = 3;
                                    $PSIDQA = 4;
                                    $PSIDartpkg = 5;
                                    $PSIDartdl = 6;
                                    $query = "SELECT Count(ArticleID) AS UserAssignedArticles FROM UserAssignedArticles WHERE UserID = :id AND Status = 'Assigned' AND ProcessingStageID = :ProcessingStage";
                                    $queryRun = $pdo->prepare($query);
                                    $queryRun->bindParam(":id", $User_ID);
                                    $queryRun->bindParam(":ProcessingStage", $PSIDartpkg);
                                    if ($queryRun->execute()) {
                                        $fetchRecord = $queryRun->fetch();
                                    }
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
                                    $week_assigned_stmt->bindParam(":ProcessingStage", $PSIDartpkg);
                                    if ($week_assigned_stmt->execute()) {
                                        $week_assigned_row = $week_assigned_stmt->fetch();
                                        $lastWeekAssignedArticles = $week_assigned_row['lastWeekAssignedArticles'];
                                    }
                                    ?>
                                    <span class="badge bg-soft-danger text-danger"><?php echo $lastWeekAssignedArticles . " Articles"; ?></span>
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
                                    $query = "SELECT Count(ArticleID) AS UserAcceptArticles FROM UserAssignedArticles 
                                    WHERE UserID = :id AND Status = 'InProgress' AND ProcessingStageID = :ProcessingStage";
                                    $queryRun = $pdo->prepare($query);
                                    $queryRun->bindParam(":id", $User_ID);
                                    $queryRun->bindParam(":ProcessingStage", $PSIDartpkg);
                                    if ($queryRun->execute()) {
                                        $accept_article_row = $queryRun->fetch();
                                    }
                                    ?>
                                    <div class="col-6">
                                        <h4 class="mb-3"> <span class="counter-value" data-target="<?php echo $accept_article_row['UserAcceptArticles']; ?>"></span> </h4>
                                    </div>
                                    <div class="col-6">
                                        <div id="mini-chart3" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                    </div>
                                </div>
                                <div class="text-nowrap">
                                    <?php
                                    $week_assigned_sql = "SELECT Count(UserID) AS lastWeekAcceptArticles FROM UserAssignedArticles WHERE UserID = :id AND Status = 'InProgress' AND ProcessingStageID = :ProcessingStage AND Date between date_sub(now(),INTERVAL 1 WEEK) and now()";
                                    $week_assigned_stmt =  $pdo->prepare($week_assigned_sql);
                                    $week_assigned_stmt->bindParam(":id", $User_ID);
                                    $week_assigned_stmt->bindParam(":ProcessingStage", $PSIDartpkg);
                                    if ($week_assigned_stmt->execute()) {
                                        $week_assigned_row = $week_assigned_stmt->fetch();
                                        $lastWeekAcceptArticles = $week_assigned_row['lastWeekAcceptArticles'];
                                    }
                                    ?>
                                    <span class="badge bg-soft-success text-success"><?php echo  $lastWeekAcceptArticles . " Articles"; ?></span>
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
                                    $User_ID = $_SESSION['id'];
                                    $ProcessingStage = 5;
                                    $hold_article_sql = "SELECT Count(UserID) AS UserHoldedArticles FROM UserAssignedArticles WHERE UserID = :id AND Status = 'Holded' AND ProcessingStageID = :ProcessingStage";
                                    $hold_article_stmt = $pdo->prepare($hold_article_sql);
                                    $hold_article_stmt->bindParam(":id", $User_ID);
                                    $hold_article_stmt->bindParam(":ProcessingStage", $ProcessingStage);
                                    if ($hold_article_stmt->execute()) {
                                        $hold_article_row = $hold_article_stmt->fetch();
                                    }
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
                                    if ($week_hold_stmt->execute()) {
                                        $week_hold_row = $week_hold_stmt->fetch();
                                        $lastWeekHoldedArticles = $week_hold_row['lastWeekHoldedArticles'];
                                    }
                                    ?>
                                    <span class="badge bg-soft-success text-success"><?php echo $lastWeekHoldedArticles; ?> Article</span>
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
                                    $User_ID = $_SESSION['id'];
                                    $ProcessingStage = 5;
                                    $complete_article_sql = "SELECT Count(UserID) AS UserCompletedArticles FROM UserAssignedArticles WHERE UserID = :id AND Status = 'Completed' AND ProcessingStageID = :ProcessingStage";
                                    $complete_article_stmt = $pdo->prepare($complete_article_sql);
                                    $complete_article_stmt->bindParam(":id", $User_ID);
                                    $complete_article_stmt->bindParam(":ProcessingStage", $ProcessingStage);
                                    if ($complete_article_stmt->execute()) {
                                        $complete_article_row = $complete_article_stmt->fetch();
                                    }
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
                                    if ($week_complete_stmt->execute()) {
                                        $week_complete_row = $week_complete_stmt->fetch();
                                        $lastWeekCompletedArticles = $week_complete_row['lastWeekCompletedArticles'];
                                    }
                                    ?>
                                    <span class="badge bg-soft-success text-success"><?php echo $lastWeekCompletedArticles; ?> Article</span>
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
                                    <span class="text-muted mb-3 lh-1 d-block text-truncate">Rejected Articles</span>
                                    <?php
                                    $User_ID = $_SESSION['id'];
                                    $ProcessingStage = 5;
                                    $complete_article_sql = "SELECT Count(UserID) AS RA FROM UserAssignedArticles WHERE UserID = :id AND 
                                    Status = 'Reassigned' AND ProcessingStageID = :ProcessingStage";
                                    $complete_article_stmt = $pdo->prepare($complete_article_sql);
                                    $complete_article_stmt->bindParam(":id", $User_ID);
                                    $complete_article_stmt->bindParam(":ProcessingStage", $ProcessingStage);
                                    if ($complete_article_stmt->execute()) {
                                        $rejected_article_row = $complete_article_stmt->fetch();
                                    }
                                    ?>
                                    <div class="col-6">
                                        <h4 class="mb-3"> <span class="counter-value" data-target="<?php echo $rejected_article_row['RA']; ?>">0</span> </h4>
                                    </div>
                                    <div class="col-6">
                                        <div id="mini-chart5" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                    </div>
                                </div>
                                <div class="text-nowrap">
                                    <?php
                                    $week_qa_accept_sql = "SELECT Count(UserID) AS lastWeekQAAcceptArticles FROM UserAssignedArticles WHERE UserID = :id AND
                                     Status = 'Reassigned' AND ProcessingStageID = :ProcessingStage AND Date between date_sub(now(),INTERVAL 1 WEEK) and now()";
                                    $week_qa_accept_stmt =  $pdo->prepare($week_qa_accept_sql);
                                    $week_qa_accept_stmt->bindParam(":id", $User_ID);
                                    $week_qa_accept_stmt->bindParam(":ProcessingStage", $PSIDartpkg);
                                    if ($week_qa_accept_stmt->execute()) {
                                        $week_qa_accept_row = $week_qa_accept_stmt->fetch();
                                        $lastWeekQAAcceptArticles = $week_qa_accept_row['lastWeekQAAcceptArticles'];
                                    }
                                    ?>
                                    <span class="badge bg-soft-danger text-danger"><?php echo $lastWeekQAAcceptArticles; ?> Articles</span>
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
                                    <span class="text-muted mb-3 lh-1 d-block text-truncate">XYZ</span>
                                    <?php
                                    $User_ID = $_SESSION['id'];
                                    $ProcessingStage = 5;
                                    $qa_accept_article_sql = "SELECT Count(UserID) AS UserQAAcceptArticles FROM UserAssignedArticles WHERE UserID = :id AND 
                                    Status = ' InProgress' AND ProcessingStageID = :ProcessingStage";
                                    $qa_accept_article_stmt = $pdo->prepare($qa_accept_article_sql);
                                    $qa_accept_article_stmt->bindParam(":id", $User_ID);
                                    $qa_accept_article_stmt->bindParam(":ProcessingStage", $ProcessingStage);
                                    if ($qa_accept_article_stmt->execute()) {
                                        $qa_accept_article_row = $qa_accept_article_stmt->fetch();
                                    }
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
                                    $week_qa_accept_sql = "SELECT Count(UserID) AS lastWeekQAAcceptArticles FROM UserAssignedArticles WHERE UserID = :id AND
                                    Status = 'InProgress' AND ProcessingStageID = :ProcessingStage AND Date between date_sub(now(),INTERVAL 1 WEEK) and now()";
                                    $week_qa_accept_stmt =  $pdo->prepare($week_qa_accept_sql);
                                    $week_qa_accept_stmt->bindParam(":id", $User_ID);
                                    $week_qa_accept_stmt->bindParam(":ProcessingStage", $QaProcessingStage);
                                    if ($week_qa_accept_stmt->execute()) {
                                        $week_qa_accept_row = $week_qa_accept_stmt->fetch();
                                        $lastWeekQAAcceptArticles = $week_qa_accept_row['lastWeekQAAcceptArticles'];
                                    }
                                    ?>
                                    <span class="badge bg-soft-success text-success"><?php echo $lastWeekQAAcceptArticles; ?> Article</span>
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
                                    <span class="text-muted mb-3 lh-1 d-block text-truncate">XYZ</span>
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

                <!-- Start Php Queries For Tables -->
                <?php
                $PSIDxmlconv = 2;
                $PSIDxmlvalid = 3;
                $PSIDQA = 4;
                $PSIDartpkg = 5;
                $PSIDartdl = 6;
                // Assign Articles
                $ProcessingStageName = "Assign Article";
                $sql = "SELECT *  FROM Articles where ArticleID in (SELECT ArticleID as artpkg FROM UserAssignedArticles where 
                ArticleID not in (Select ArticleID from `UserAssignedArticles` where ProcessingStageID > '$PSIDartpkg' ) 
                and `Status`='Assigned' and ProcessingStageID= '$PSIDartpkg' ) and `Status`='Active'";
                $stmt = $pdo->prepare($sql);
                if ($stmt->execute()) {
                    $rows_xmlconv = $stmt->fetchAll();
                }

                // Inprogress Articles
                $ProcessingStageName = "InProgress Article";
                $sql1 = "SELECT *  FROM Articles where ArticleID in (SELECT ArticleID as artpkg FROM UserAssignedArticles where 
                ArticleID not in (Select ArticleID from `UserAssignedArticles` where ProcessingStageID > '$PSIDartpkg' ) 
                and `Status`='InProgress' and ProcessingStageID= '$PSIDartpkg' ) and `Status`='Active'";
                $stmt1 = $pdo->prepare($sql1);
                if ($stmt1->execute()) {
                    $rows_xmlconv1 = $stmt1->fetchAll();
                }

                // Hold Articles
                $ProcessingStageName = "OnHold Article";
                $sql2 = "SELECT *  FROM Articles where ArticleID in (SELECT ArticleID as artpkg FROM UserAssignedArticles where 
                ArticleID not in (Select ArticleID from `UserAssignedArticles` where ProcessingStageID > '$PSIDartpkg' ) 
                and `Status`='Holded' and ProcessingStageID= '$PSIDartpkg' ) and `Status`='Active'";
                $stmt2 = $pdo->prepare($sql2);
                if ($stmt2->execute()) {
                    $rows_xmlconv2 = $stmt2->fetchAll();
                }

                // Completed Articles
                $ProcessingStageName = "Completed Article";
                $sql3 = "SELECT *  FROM Articles where ArticleID in (SELECT ArticleID as artpkg FROM UserAssignedArticles where 
                ArticleID not in (Select ArticleID from `UserAssignedArticles` where ProcessingStageID > '$PSIDartpkg' ) 
                and `Status`='Completed' and ProcessingStageID= '$PSIDartpkg' ) and `Status`='Active'";
                $stmt3 = $pdo->prepare($sql3);
                if ($stmt3->execute()) {
                    $rows_xmlconv3 = $stmt3->fetchAll();
                }

                // Reassigned Articles
                $ProcessingStageName = "Reassigned Article";
                $sql4 = "SELECT *  FROM Articles where ArticleID in (SELECT ArticleID as artpkg FROM UserAssignedArticles where 
                ArticleID not in (Select ArticleID from `UserAssignedArticles` where ProcessingStageID > '$PSIDartpkg' ) 
                and `Status`='Reassigned' and ProcessingStageID= '$PSIDartpkg' ) and `Status`='Active'";
                $stmt4 = $pdo->prepare($sql4);
                if ($stmt4->execute()) {
                    $rows_xmlconv4 = $stmt4->fetchAll();
                }

                //Unassign Articles
                $sql = "SELECT *  FROM Articles where ArticleID in(SELECT ArticleID as artpkg FROM UserAssignedArticles 
                where ArticleID not in (Select ArticleID from `UserAssignedArticles` where ProcessingStageID > '$PSIDQA' ) 
                and `Status`='Completed' and ProcessingStageID= '$PSIDQA' ) and `Status`='Active'";
                $stmt = $pdo->prepare($sql);
                if ($stmt->execute()) {
                    $rows_xmlQA = $stmt->fetchAll();
                }
                ?>
                <!-- END Php Queries For Tables -->

                <!-- Start code for tables -->

                <!-- Start code for Unassign Article tables -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header" style="background-color:#c1c3ee;">
                                <h4 class="card-title">Packaging: UnAssign Articles</h4>
                            </div>
                            <div class="card-body">
                                <table id="datatable1" class="table table-bordered dt-responsive  nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>Article Title</th>
                                            <th>Article Code</th>
                                            <th>Article Info</th>
                                            <th>Word/PDF Files</th>
                                            <th>XML Files</th>
                                            <th>Assign Date</th>
                                            <th>Delay</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($rows_xmlQA as $row_xmlc5) { ?>
                                            <tr>
                                                <td><?php echo wordwrap($row_xmlc5["ArticleTitle"], 35, "<br>\n"); ?></td>
                                                <td><?php echo $row_xmlc5["ArticleCode"]; ?></td>
                                                <td><?php
                                                    $jid = $row_xmlc5["JournalID"];
                                                    $sql = "SELECT JournalCode FROM Journals Where JournalID=$jid";
                                                    $stmt = $pdo->prepare($sql);
                                                    if ($stmt->execute()) {
                                                        $row = $stmt->fetch();
                                                        echo "Journal: " . $jcode = $row['JournalCode'];
                                                    }
                                                    echo "<br>Volume: " . $jcode = $row_xmlc5['ArticleVolume'];
                                                    echo "<br>Issue: " . $jcode = $row_xmlc5['ArticleIssue'];
                                                    echo "<br>Year: " . $jcode = $row_xmlc5['ArticleYear'];
                                                    ?></td>
                                                <td>
                                                    <?php
                                                    // fetch pdf files
                                                    $pdf_sql = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND 
                                                    (FileType = 'pdf' or FileType = 'PDF'))";
                                                    $pdf_stmt = $pdo->prepare($pdf_sql);
                                                    $pdf_stmt->bindParam(":articleID", $row_xmlc5["ArticleID"]);
                                                    $pdf_result = $pdf_stmt->execute();
                                                    $pdf_result = $pdf_stmt->fetch();

                                                    // fetch docx files
                                                    $wordFile = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND 
                                                    (FileType = 'docx' or FileType = 'doc' or FileType = 'Word'))";
                                                    $word_stmt = $pdo->prepare($wordFile);
                                                    $word_stmt->bindParam(":articleID", $row_xmlc5["ArticleID"]);
                                                    $word_result = $word_stmt->execute();
                                                    $word_result = $word_stmt->fetch();
                                                    ?>
                                                    <a href="Download_file.php?file_id=<?php echo $pdf_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm btn-primary">PDF File</a>
                                                    <br><a href="Download_file.php?file_id=<?php echo $word_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm btn-primary mt-1">Word File</a>
                                                </td>
                                                <td>
                                                    <?php
                                                    // fetch XML Converted files
                                                    $ineraFile = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND 
                                                    (FileType = 'Inera' or FileType = 'XML Converted' ))";
                                                    $inera_stmt = $pdo->prepare($ineraFile);
                                                    $inera_stmt->bindParam(":articleID", $row_xmlc5["ArticleID"]);
                                                    $inera_result = $inera_stmt->execute();
                                                    $inera_result = $inera_stmt->fetch();

                                                    // fetch XML Valid
                                                    $validFile = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND 
                                                    (FileType = 'XML Valid' ))";
                                                    $valid_stmt = $pdo->prepare($validFile);
                                                    $valid_stmt->bindParam(":articleID", $row_xmlc5["ArticleID"]);
                                                    $valid_result = $valid_stmt->execute();
                                                    $valid_result = $valid_stmt->fetch();
                                                    ?>
                                                    <a href="Download_file.php?file_id=<?php echo $inera_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm btn-primary">XML Converted File</a>
                                                    <br><a href="Download_file.php?file_id=<?php echo $valid_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm btn-primary mt-1">XML Valid File</a>
                                                </td>

                                                <td><?php echo date("Y-m-d", strtotime($row_xmlc5["Date"])); ?></td>
                                                <td><?php
                                                    $now = time(); // or your date as well
                                                    $your_date = strtotime($row_xmlc5["Date"]);
                                                    $datediff = $now - $your_date;
                                                    echo "<span class='text-danger'>" . round($datediff / (60 * 60 * 24)) . "  Days </span>";
                                                    ?></td>
                                                <td><a href="PG_Assign_Article_User.php?psid=<?php echo $PSIDartpkg; ?>&arid=<?php echo $row_xmlc5["ArticleID"]; ?>&astid=1" class="btn btn-info">Assign</a>
                                                    <!-- <a href="#" class="btn btn-info">Revoke</a> -->
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->

                <!-- End code for XML Conversion tables -->
                <!-- Start code for Packaging: Assigned Article tables -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header" style="background-color:#c1c3ee;">
                                <h4 class="card-title">Packaging: Assigned Articles</h4>
                            </div>
                            <div class="card-body">

                                <table id="datatable2" class="table table-bordered dt-responsive  nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>Article Title</th>
                                            <th>Article Code</th>
                                            <th>Article Info</th>
                                            <th>Word/PDF Files</th>
                                            <th>XML Files</th>
                                            <th>Assign Date</th>
                                            <th>Delay</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($rows_xmlconv as $row_xmlc) { ?>
                                            <tr>
                                                <td><?php echo wordwrap($row_xmlc["ArticleTitle"], 35, "<br>\n"); ?></td>
                                                <td><?php echo $row_xmlc["ArticleCode"]; ?></td>
                                                <td><?php
                                                    $jid = $row_xmlc["JournalID"];
                                                    $sql = "SELECT JournalCode FROM Journals Where JournalID=$jid";
                                                    $stmt = $pdo->prepare($sql);
                                                    if ($stmt->execute()) {
                                                        $row = $stmt->fetch();
                                                        echo "Journal: " . $jcode = $row['JournalCode'];
                                                    }
                                                    echo "<br>Volume: " . $jcode = $row_xmlc['ArticleVolume'];
                                                    echo "<br>Issue: " . $jcode = $row_xmlc['ArticleIssue'];
                                                    echo "<br>Year: " . $jcode = $row_xmlc['ArticleYear'];
                                                    ?></td>
                                                <td>
                                                    <?php

                                                    // fetch pdf files
                                                    $pdf_sql = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND (FileType = 'pdf' or FileType = 'PDF'))";
                                                    $pdf_stmt = $pdo->prepare($pdf_sql);
                                                    $pdf_stmt->bindParam(":articleID", $row_xmlc["ArticleID"]);
                                                    $pdf_result = $pdf_stmt->execute();
                                                    $pdf_result = $pdf_stmt->fetch();

                                                    // fetch docx files
                                                    $wordFile = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND (FileType = 'docx' or FileType = 'doc' or FileType = 'Word'))";
                                                    $word_stmt = $pdo->prepare($wordFile);
                                                    $word_stmt->bindParam(":articleID", $row_xmlc["ArticleID"]);
                                                    $word_result = $word_stmt->execute();
                                                    $word_result = $word_stmt->fetch();
                                                    ?>
                                                    <a href="Download_file.php?file_id=<?php echo $pdf_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm btn-primary">PDF File</a>
                                                    <br><a href="Download_file.php?file_id=<?php echo $word_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm btn-primary mt-1">Word File</a>
                                                </td>
                                                <td>
                                                    <?php
                                                    // fetch XML Converted files
                                                    $ineraFile = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND 
                                                    (FileType = 'Inera' or FileType = 'XML Converted'))";
                                                    $inera_stmt = $pdo->prepare($ineraFile);
                                                    $inera_stmt->bindParam(":articleID", $row_xmlc["ArticleID"]);
                                                    $inera_result = $inera_stmt->execute();
                                                    $inera_result = $inera_stmt->fetch();

                                                    // fetch XML Valid
                                                    $validFile = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND 
                                                    (FileType = 'XML Valid' ))";
                                                    $valid_stmt = $pdo->prepare($validFile);
                                                    $valid_stmt->bindParam(":articleID", $row_xmlc["ArticleID"]);
                                                    $valid_result = $valid_stmt->execute();
                                                    $valid_result = $valid_stmt->fetch();
                                                    ?>
                                                    <a href="Download_file.php?file_id=<?php echo $inera_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm btn-primary">XML Converted File</a>
                                                    <br><a href="Download_file.php?file_id=<?php echo $valid_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm btn-primary mt-1">XML Valid File</a>
                                                </td>
                                                <td><?php echo date("Y-m-d", strtotime($row_xmlc["Date"])); ?></td>
                                                <td><?php
                                                    $now = time(); // or your date as well
                                                    $your_date = strtotime($row_xmlc["Date"]);
                                                    $datediff = $now - $your_date;
                                                    echo "<span class='text-danger'>" . round($datediff / (60 * 60 * 24)) . "  Days </span>";
                                                    ?></td>
                                                <td><a href="PG_Accept.php?psid=<?php echo $PSIDartpkg; ?>&arid=<?php echo $row_xmlc["ArticleID"]; ?>&astid=1" class="btn btn-info">Accept</a>
                                                    <a href="PG_Reject.php?psid=<?php echo $PSIDartpkg; ?>&arid=<?php echo $row_xmlc["ArticleID"]; ?>&astid=1" class="btn  btn-danger">Reject</a>
                                                    <!-- <a href="#" class="btn btn-info">Revoke</a> -->
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
                <!-- End code for tables -->

                <!-- Start code for Packaging: Accepted Articles tables -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header" style="background-color:#c1c3ee;">
                                <h4 class="card-title">Packaging: Accepted Articles</h4>
                            </div>
                            <div class="card-body">
                                <table id="datatable3" class="table table-bordered dt-responsive  nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>Article Title</th>
                                            <th>Article Code</th>
                                            <th>Article Info</th>
                                            <th>Word/PDF Files</th>
                                            <th>XML Files</th>
                                            <th>Uploaded Files</th>
                                            <th>Assign Date</th>
                                            <th>Delay</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($rows_xmlconv1 as $row_xmlc1) { ?>
                                            <tr>
                                                <td><?php echo wordwrap($row_xmlc1["ArticleTitle"], 35, "<br>\n"); ?></td>
                                                <td><?php echo $row_xmlc1["ArticleCode"]; ?></td>
                                                <td><?php
                                                    $jid = $row_xmlc1["JournalID"];
                                                    $sql = "SELECT JournalCode FROM Journals Where JournalID=$jid";
                                                    $stmt = $pdo->prepare($sql);
                                                    if ($stmt->execute()) {
                                                        $row = $stmt->fetch();
                                                        echo "Journal: " . $jcode = $row['JournalCode'];
                                                    }
                                                    echo "<br>Volume: " . $jcode = $row_xmlc1['ArticleVolume'];
                                                    echo "<br>Issue: " . $jcode = $row_xmlc1['ArticleIssue'];
                                                    echo "<br>Year: " . $jcode = $row_xmlc1['ArticleYear'];
                                                    ?></td>
                                                <td>
                                                    <?php
                                                    // fetch pdf files
                                                    $pdf_sql = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND
                                                    (FileType = 'pdf' or FileType = 'PDF'))";
                                                    $pdf_stmt = $pdo->prepare($pdf_sql);
                                                    $pdf_stmt->bindParam(":articleID", $row_xmlc1["ArticleID"]);
                                                    $pdf_result = $pdf_stmt->execute();
                                                    $pdf_result = $pdf_stmt->fetch();

                                                    // fetch docx files
                                                    $wordFile = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND 
                                                    (FileType = 'docx' or FileType = 'doc' or FileType = 'Word'))";
                                                    $word_stmt = $pdo->prepare($wordFile);
                                                    $word_stmt->bindParam(":articleID", $row_xmlc1["ArticleID"]);
                                                    $word_result = $word_stmt->execute();
                                                    $word_result = $word_stmt->fetch();
                                                    ?>
                                                    <a href="Download_file.php?file_id=<?php echo $pdf_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm btn-primary">PDF File</a>
                                                    <br><a href="Download_file.php?file_id=<?php echo $word_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm btn-primary mt-1">Word File</a>
                                                </td>
                                                <td>
                                                    <?php
                                                    // fetch XML Converted files
                                                    $ineraFile = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND 
                                                    (FileType = 'Inera' or FileType = 'XML Converted'))";
                                                    $inera_stmt = $pdo->prepare($ineraFile);
                                                    $inera_stmt->bindParam(":articleID", $row_xmlc1["ArticleID"]);
                                                    $inera_result = $inera_stmt->execute();
                                                    $inera_result = $inera_stmt->fetch();

                                                    // fetch XML Valid
                                                    $validFile = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND 
                                                    (FileType = 'XML Valid' ))";
                                                    $valid_stmt = $pdo->prepare($validFile);
                                                    $valid_stmt->bindParam(":articleID", $row_xmlc1["ArticleID"]);
                                                    $valid_result = $valid_stmt->execute();
                                                    $valid_result = $valid_stmt->fetch();
                                                    ?>
                                                    <a href="Download_file.php?file_id=<?php echo $inera_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm btn-primary">XML Converted File</a>
                                                    <br><a href="Download_file.php?file_id=<?php echo $valid_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm btn-primary mt-1">XML Valid File</a>
                                                </td>
                                                <td>
                                                    <?php
                                                    // fetch Epub files
                                                    $epubFile = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND 
                                                    (FileType = 'epub'))";
                                                    $epub_stmt = $pdo->prepare($epubFile);
                                                    $epub_stmt->bindParam(":articleID", $row_xmlc1["ArticleID"]);
                                                    $epub_result = $epub_stmt->execute();
                                                    $epub_result = $epub_stmt->fetch();
                                                    $epub_path=$epub_result["FilePath"];

                                                    // fetch HTML files
                                                    $htmlFile = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND 
                                                    (FileType = 'html' ))";
                                                    $html_stmt = $pdo->prepare($htmlFile);
                                                    $html_stmt->bindParam(":articleID", $row_xmlc1["ArticleID"]);
                                                    $html_result = $html_stmt->execute();
                                                    $html_result = $html_stmt->fetch();
                                                    $html_path=$html_result["FilePath"];
                                                
                                                if(file_exists($epub_path) == 1) {?>
                                                   <a href="Download_file.php?file_id=<?php echo $epub_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm btn-primary">Epub File</a>
                                                    
                                               <?php } 

                                                if(file_exists($html_path)  == 1) {?>
                                                <br><a href="Download_file.php?file_id=<?php echo $html_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm btn-primary mt-1">HTML File</a>
                                                    
                                               <?php } ?>
                                              
                                                    
                                                </td>
                                                <td><?php echo date("Y-m-d", strtotime($row_xmlc1["Date"])); ?></td>
                                                <td><?php
                                                    $now = time(); // or your date as well
                                                    $your_date = strtotime($row_xmlc1["Date"]);
                                                    $datediff = $now - $your_date;
                                                    echo "<span class='text-danger'>" . round($datediff / (60 * 60 * 24)) . "  Days </span>";
                                                    ?></td>
                                                <td>

                                                <?php 
                                                if(file_exists($html_path) && file_exists($epub_path) == 1) {?>
                                                    <a href="PG_Complete.php?psid=<?php echo $PSIDartpkg; ?>&arid=<?php echo $row_xmlc1["ArticleID"]; ?>&astid=1" class="btn  btn-info">Complete</a>
                                                    <a href="PG_Upload_files.php?psid=<?php echo $PSIDartpkg; ?>&arid=<?php echo $row_xmlc1["ArticleID"]; ?>&astid=1" class="btn btn-danger">Reupload Files</a>

                                                   
                                               <?php } 
                                                else{?>
                                                    <a href="PG_Upload_files.php?psid=<?php echo $PSIDartpkg; ?>&arid=<?php echo $row_xmlc1["ArticleID"]; ?>&astid=1" class="btn btn-primary">Upload Files</a>
                                               <?php }
                                               
                                               
                                               ?>

                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
                <!-- End code for tables -->


                <!-- Start code for Packaging: Articles On Hold tables -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header" style="background-color:#c1c3ee;">
                                <h4 class="card-title">Packaging: Articles On Hold</h4>
                            </div>
                            <div class="card-body">
                                <table id="datatable4" class="table table-bordered dt-responsive  nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>Article Title</th>
                                            <th>Article Code</th>
                                            <th>Article Info</th>
                                            <th>Word/PDF Files</th>
                                            <th>XML Files</th>
                                            <th>Assign Date</th>
                                            <th>Delay</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($rows_xmlconv2 as $row_xmlc2) { ?>
                                            <tr>
                                                <td><?php echo wordwrap($row_xmlc2["ArticleTitle"], 35, "<br>\n"); ?></td>
                                                <td><?php echo $row_xmlc2["ArticleCode"]; ?></td>
                                                <td><?php
                                                    $jid = $row_xmlc2["JournalID"];
                                                    $sql = "SELECT JournalCode FROM Journals Where JournalID=$jid";
                                                    $stmt = $pdo->prepare($sql);
                                                    if ($stmt->execute()) {
                                                        $row = $stmt->fetch();
                                                        echo "Journal: " . $jcode = $row['JournalCode'];
                                                    }
                                                    echo "<br>Volume: " . $jcode = $row_xmlc2['ArticleVolume'];
                                                    echo "<br>Issue: " . $jcode = $row_xmlc2['ArticleIssue'];
                                                    echo "<br>Year: " . $jcode = $row_xmlc2['ArticleYear'];
                                                    ?></td>
                                                <td>
                                                    <?php
                                                    // fetch pdf files
                                                    $pdf_sql = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND 
                                                    (FileType = 'pdf' or FileType = 'PDF'))";
                                                    $pdf_stmt = $pdo->prepare($pdf_sql);
                                                    $pdf_stmt->bindParam(":articleID", $row_xmlc2["ArticleID"]);
                                                    $pdf_result = $pdf_stmt->execute();
                                                    $pdf_result = $pdf_stmt->fetch();

                                                    // fetch docx files
                                                    $wordFile = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND 
                                                    (FileType = 'docx' or FileType = 'doc' or FileType = 'Word'))";
                                                    $word_stmt = $pdo->prepare($wordFile);
                                                    $word_stmt->bindParam(":articleID", $row_xmlc2["ArticleID"]);
                                                    $word_result = $word_stmt->execute();
                                                    $word_result = $word_stmt->fetch();
                                                    ?>
                                                    <a href="Download_file.php?file_id=<?php echo $pdf_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm btn-primary">PDF File</a>
                                                    <br><a href="Download_file.php?file_id=<?php echo $word_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm btn-primary mt-1">Word File</a>
                                                </td>
                                                <td>
                                                    <?php
                                                    // fetch XML Converted files
                                                    $ineraFile = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND 
                                                    (FileType = 'Inera' or FileType = 'XML Converted'))";
                                                    $inera_stmt = $pdo->prepare($ineraFile);
                                                    $inera_stmt->bindParam(":articleID", $row_xmlc2["ArticleID"]);
                                                    $inera_result = $inera_stmt->execute();
                                                    $inera_result = $inera_stmt->fetch();

                                                    // fetch XML Valid
                                                    $validFile = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND 
                                                    (FileType = 'XML Valid' ))";
                                                    $valid_stmt = $pdo->prepare($validFile);
                                                    $valid_stmt->bindParam(":articleID", $row_xmlc2["ArticleID"]);
                                                    $valid_result = $valid_stmt->execute();
                                                    $valid_result = $valid_stmt->fetch();
                                                    ?>
                                                    <a href="Download_file.php?file_id=<?php echo $inera_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm btn-primary">XML Converted File</a>
                                                    <br><a href="Download_file.php?file_id=<?php echo $valid_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm btn-primary mt-1">XML Valid File</a>
                                                </td>
                                                <td><?php echo date("Y-m-d", strtotime($row_xmlc2["Date"])); ?></td>
                                                <td><?php
                                                    $now = time(); // or your date as well
                                                    $your_date = strtotime($row_xmlc2["Date"]);
                                                    $datediff = $now - $your_date;
                                                    echo "<span class='text-danger'>" . round($datediff / (60 * 60 * 24)) . "  Days </span>";

                                                    ?></td>
                                                <td><a href="PG_UnHold.php?psid=<?php echo $PSIDartpkg; ?>&arid=<?php echo $row_xmlc2["ArticleID"]; ?>&astid=1" class="btn btn-info">Unhold</a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->


                <!-- End code for tables -->

                <!-- Start code for Packaging: Completed Articles tables -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header" style="background-color:#c1c3ee;">
                                <h4 class="card-title">Packaging: Completed Articles</h4>
                            </div>
                            <div class="card-body">
                                <table id="datatable5" class="table table-bordered dt-responsive  nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>Article Title</th>
                                            <th>Article Code</th>
                                            <th>Article Info</th>
                                            <th>Word/PDF Files</th>
                                            <th>XML Files</th>
                                            <th>Assign Date</th>
                                            <th>Delay</th>
                                            <!-- <th>Action</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($rows_xmlconv3 as $row_xmlc3) { ?>
                                            <tr>
                                                <td><?php echo wordwrap($row_xmlc3["ArticleTitle"], 35, "<br>\n"); ?></td>
                                                <td><?php echo $row_xmlc3["ArticleCode"]; ?></td>
                                                <td><?php
                                                    $jid = $row_xmlc3["JournalID"];
                                                    $sql = "SELECT JournalCode FROM Journals Where JournalID=$jid";
                                                    $stmt = $pdo->prepare($sql);
                                                    if ($stmt->execute()) {
                                                        $row = $stmt->fetch();
                                                        echo "Journal: " . $jcode = $row['JournalCode'];
                                                    }
                                                    echo "<br>Volume: " . $jcode = $row_xmlc3['ArticleVolume'];
                                                    echo "<br>Issue: " . $jcode = $row_xmlc3['ArticleIssue'];
                                                    echo "<br>Year: " . $jcode = $row_xmlc3['ArticleYear'];
                                                    ?></td>
                                                <td>
                                                    <?php
                                                    // fetch pdf files
                                                    $pdf_sql = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND 
                                                    (FileType = 'pdf' or FileType = 'PDF'))";
                                                    $pdf_stmt = $pdo->prepare($pdf_sql);
                                                    $pdf_stmt->bindParam(":articleID", $row_xmlc3["ArticleID"]);
                                                    $pdf_result = $pdf_stmt->execute();
                                                    $pdf_result = $pdf_stmt->fetch();

                                                    // fetch docx files
                                                    $wordFile = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND 
                                                    (FileType = 'docx' or FileType = 'doc' or FileType = 'Word'))";
                                                    $word_stmt = $pdo->prepare($wordFile);
                                                    $word_stmt->bindParam(":articleID", $row_xmlc3["ArticleID"]);
                                                    $word_result = $word_stmt->execute();
                                                    $word_result = $word_stmt->fetch();
                                                    ?>
                                                    <a href="Download_file.php?file_id=<?php echo $pdf_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm btn-primary">PDF File</a>
                                                    <br><a href="Download_file.php?file_id=<?php echo $word_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm btn-primary mt-1">Word File</a>
                                                </td>
                                                <td>
                                                    <?php
                                                    // fetch XML Converted files
                                                    $ineraFile = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND 
                                                    (FileType = 'Inera' or FileType = 'XML Converted'))";
                                                    $inera_stmt = $pdo->prepare($ineraFile);
                                                    $inera_stmt->bindParam(":articleID", $row_xmlc3["ArticleID"]);
                                                    $inera_result = $inera_stmt->execute();
                                                    $inera_result = $inera_stmt->fetch();

                                                    // fetch XML Valid
                                                    $validFile = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND 
                                                    (FileType = 'XML Valid' ))";
                                                    $valid_stmt = $pdo->prepare($validFile);
                                                    $valid_stmt->bindParam(":articleID", $row_xmlc3["ArticleID"]);
                                                    $valid_result = $valid_stmt->execute();
                                                    $valid_result = $valid_stmt->fetch();
                                                    ?>
                                                    <a href="Download_file.php?file_id=<?php echo $inera_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm btn-primary">XML Converted File</a>
                                                    <br><a href="Download_file.php?file_id=<?php echo $valid_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm btn-primary mt-1">XML Valid File</a>
                                                </td>
                                                <td><?php echo date("Y-m-d", strtotime($row_xmlc3["Date"])); ?></td>
                                                <td><?php
                                                    $now = time(); // or your date as well
                                                    $your_date = strtotime($row_xmlc3["Date"]);
                                                    $datediff = $now - $your_date;
                                                    echo "<span class='text-danger'>" . round($datediff / (60 * 60 * 24)) . "  Days </span>";
                                                    ?></td>
                                                <!-- <td><a href="Assign_Article_.php?psid=<?php echo $PSIDartpkg; ?>&arid=<?php echo $row_xmlc3["ArticleID"]; ?>&astid=1" class="btn btn-success">Submit</a>
                                                     <a href="#" class="btn btn-info">Revoke</a> 
                                                </td> -->
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->


                <!-- End code for tables -->

                <!-- Start code for Packaging: Rejected Article tables -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header" style="background-color:#c1c3ee;">
                                <h4 class="card-title">Packaging: Rejected Articles</h4> <!-- By Packaging Stage -->
                            </div>
                            <div class="card-body">

                                <table id="datatable6" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>Article Title</th>
                                            <th>Article Code</th>
                                            <th>Article Info</th>
                                            <th>Word/PDF Files</th>
                                            <th>XML Files</th>
                                            <th>Assign Date</th>
                                            <th>Delay</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($rows_xmlconv4 as $row_xmlc4) { ?>
                                            <tr>
                                                <td><?php echo wordwrap($row_xmlc4["ArticleTitle"], 35, "<br>\n"); ?></td>
                                                <td><?php echo $row_xmlc4["ArticleCode"]; ?></td>
                                                <td><?php
                                                    $jid = $row_xmlc4["JournalID"];
                                                    $sql = "SELECT JournalCode FROM Journals Where JournalID=$jid";
                                                    $stmt = $pdo->prepare($sql);
                                                    if ($stmt->execute()) {
                                                        $row = $stmt->fetch();
                                                        echo "Journal: " . $jcode = $row['JournalCode'];
                                                    }
                                                    echo "<br>Volume: " . $jcode = $row_xmlc4['ArticleVolume'];
                                                    echo "<br>Issue: " . $jcode = $row_xmlc4['ArticleIssue'];
                                                    echo "<br>Year: " . $jcode = $row_xmlc4['ArticleYear'];
                                                    ?></td>
                                                <td>
                                                    <?php
                                                    // fetch pdf files
                                                    $pdf_sql = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND 
                                                    (FileType = 'pdf' or FileType = 'PDF'))";
                                                    $pdf_stmt = $pdo->prepare($pdf_sql);
                                                    $pdf_stmt->bindParam(":articleID", $row_xmlc4["ArticleID"]);
                                                    $pdf_result = $pdf_stmt->execute();
                                                    $pdf_result = $pdf_stmt->fetch();

                                                    // fetch docx files
                                                    $wordFile = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND 
                                                    (FileType = 'docx' or FileType = 'doc' or FileType = 'Word'))";
                                                    $word_stmt = $pdo->prepare($wordFile);
                                                    $word_stmt->bindParam(":articleID", $row_xmlc4["ArticleID"]);
                                                    $word_result = $word_stmt->execute();
                                                    $word_result = $word_stmt->fetch();
                                                    ?>
                                                    <a href="Download_file.php?file_id=<?php echo $pdf_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm btn-primary">PDF File</a>
                                                    <br><a href="Download_file.php?file_id=<?php echo $word_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm btn-primary mt-1">Word File</a>
                                                </td>
                                                <td>
                                                    <?php
                                                    // fetch XML Converted files
                                                    $ineraFile = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND 
                                                    (FileType = 'Inera' or FileType = 'XML Converted'))";
                                                    $inera_stmt = $pdo->prepare($ineraFile);
                                                    $inera_stmt->bindParam(":articleID", $row_xmlc4["ArticleID"]);
                                                    $inera_result = $inera_stmt->execute();
                                                    $inera_result = $inera_stmt->fetch();

                                                    // fetch XML Valid
                                                    $validFile = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND 
                                                    (FileType = 'XML Valid' ))";
                                                    $valid_stmt = $pdo->prepare($validFile);
                                                    $valid_stmt->bindParam(":articleID", $row_xmlc4["ArticleID"]);
                                                    $valid_result = $valid_stmt->execute();
                                                    $valid_result = $valid_stmt->fetch();
                                                    ?>
                                                    <a href="Download_file.php?file_id=<?php echo $inera_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm btn-primary">XML Converted File</a>
                                                    <br><a href="Download_file.php?file_id=<?php echo $valid_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm btn-primary mt-1">XML Valid File</a>
                                                </td>
                                                <td><?php echo date("Y-m-d", strtotime($row_xmlc4["Date"])); ?></td>
                                                <td><?php
                                                    $now = time(); // or your date as well
                                                    $your_date = strtotime($row_xmlc4["Date"]);
                                                    $datediff = $now - $your_date;
                                                    echo "<span class='text-danger'>" . round($datediff / (60 * 60 * 24)) . "  Days </span>";
                                                    ?></td>
                                                <td><a href="PG_Assign_Article_User.php?psid=<?php echo $PSIDartpkg; ?>&arid=<?php echo $row_xmlc4["ArticleID"]; ?>&astid=1" class="btn btn-info">Assign</a>
                                                    <!-- <a href="#" class="btn btn-info">Revoke</a> -->
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->


                <!-- End code for tables -->

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
        $('#datatable6').DataTable();
        $('#datatable7').DataTable();

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