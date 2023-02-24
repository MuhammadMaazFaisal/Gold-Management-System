<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php include 'layouts/config.php'; ?>


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
                            <h4 class="mb-sm-0 font-size-18">Issue Assignment Dashboard</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">XML Workflow</a></li>
                                    <li class="breadcrumb-item active">Issue Assignment</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <!--- Start Code for PHP Queries for Small Boxes -->
                <?php
                $sql = "SELECT Count(ArticleID) as totalart FROM Articles";
                $stmt = $pdo->prepare($sql);
                if ($stmt->execute()) {
                    $row = $stmt->fetch();
                    $TotalArticles = $row['totalart'];
                }
                ?>
                <?php

                $week_assigned_sql = "SELECT Count(ArticleID) as lastWeekArticles FROM Articles where Date between date_sub(now(),INTERVAL 1 WEEK) and now()";
                $week_assigned_stmt =  $pdo->prepare($week_assigned_sql);

                if ($week_assigned_stmt->execute()) {
                    $week_assigned_row = $week_assigned_stmt->fetch();
                    $lastWeekArticles_total = $week_assigned_row['lastWeekArticles'];
                }

                // echo $TotalArticles >= 1 ? '+' . $TotalArticles - 5 . ' Articles' : '0 Articles'; 
                ?>
                <?php
                $sql = "SELECT Count(ArticleID) as arcart FROM Articles where Status='Archive'";
                $stmt = $pdo->prepare($sql);
                if ($stmt->execute()) {
                    $row = $stmt->fetch();
                    $ArchiveArt = $row['arcart'];
                }
                ?>
                <?php

                $week_assigned_sql = "SELECT Count(ArticleID) as lastWeekArticles FROM Articles where Status='Archive' 
                and Date between date_sub(now(),INTERVAL 1 WEEK) and now()";
                $week_assigned_stmt =  $pdo->prepare($week_assigned_sql);

                if ($week_assigned_stmt->execute()) {
                    $week_assigned_row = $week_assigned_stmt->fetch();
                    $lastWeekArticles_archive = $week_assigned_row['lastWeekArticles'];
                }

                ?>

                <?php

                $InProcessArticles = $TotalArticles - $ArchiveArt;
                $lastWeekArticles_inprocess = $lastWeekArticles_total - $lastWeekArticles_archive;
                ?>
                <?php
                $sql = "SELECT Count(ArticleID) as xmlconv FROM Articles where ArticleID not in 
                                        (Select ArticleID from `UserAssignedArticles`) and `Status`='Active'";
                $stmt = $pdo->prepare($sql);
                if ($stmt->execute()) {
                    $row = $stmt->fetch();
                    $xmlconv = $row['xmlconv'];
                }
                ?>
                <?php

                $week_assigned_sql = "SELECT Count(ArticleID) as lastWeekArticles FROM Articles where ArticleID not in 
                (Select ArticleID from `UserAssignedArticles`) and `Status`='Active' AND Date between date_sub(now(),INTERVAL 1 WEEK) and now()";
                $week_assigned_stmt =  $pdo->prepare($week_assigned_sql);

                if ($week_assigned_stmt->execute()) {
                    $week_assigned_row = $week_assigned_stmt->fetch();
                    $lastWeekArticles_xmlc = $week_assigned_row['lastWeekArticles'];
                }
                ?>
                <?php

                $PSIDxmlconv = 2;
                $PSIDxmlvalid = 3;
                $PSIDQA = 4;
                $PSIDartpkg = 5;
                $PSIDartdl = 6;

                $sql = "SELECT Count(ArticleID) as xmlval FROM UserAssignedArticles 
                where ArticleID not in (Select ArticleID from `UserAssignedArticles` where ProcessingStageID > '$PSIDxmlconv' ) 
                and `Status`='Completed' and ProcessingStageID= '$PSIDxmlconv' ;";
                $stmt = $pdo->prepare($sql);
                if ($stmt->execute()) {
                    $row = $stmt->fetch();
                    $xmlval = $row['xmlval'];
                }
                ?>
                <?php

                $week_assigned_sql = "SELECT Count(ArticleID) as lastWeekArticles FROM UserAssignedArticles 
                where ArticleID not in (Select ArticleID from `UserAssignedArticles` where ProcessingStageID > '$PSIDxmlconv' ) 
                and `Status`='Completed' and ProcessingStageID= '$PSIDxmlconv'  AND Date between date_sub(now(),INTERVAL 1 WEEK) and now()";
                $week_assigned_stmt =  $pdo->prepare($week_assigned_sql);

                if ($week_assigned_stmt->execute()) {
                    $week_assigned_row = $week_assigned_stmt->fetch();
                    $lastWeekArticles_xmlv = $week_assigned_row['lastWeekArticles'];
                }
                ?>
                <?php
                $sql = "SELECT Count(ArticleID) as QA FROM UserAssignedArticles 
                where ArticleID not in (Select ArticleID from `UserAssignedArticles` where ProcessingStageID > '$PSIDxmlvalid' )                         
                and `Status`='Completed' and ProcessingStageID= '$PSIDxmlvalid';";
                $stmt = $pdo->prepare($sql);
                if ($stmt->execute()) {
                    $row = $stmt->fetch();
                    $QA = $row['QA'];
                }
                ?>
                <?php

                $week_assigned_sql = "SELECT Count(ArticleID) as lastWeekArticles FROM UserAssignedArticles 
                where ArticleID not in (Select ArticleID from `UserAssignedArticles` where ProcessingStageID > '$PSIDxmlvalid' ) 
                and `Status`='Completed' and ProcessingStageID= '$PSIDxmlvalid' AND Date between date_sub(now(),INTERVAL 1 WEEK) and now()";
                $week_assigned_stmt =  $pdo->prepare($week_assigned_sql);

                if ($week_assigned_stmt->execute()) {
                    $week_assigned_row = $week_assigned_stmt->fetch();
                    $lastWeekArticles_QA = $week_assigned_row['lastWeekArticles'];
                }
                ?>
                <?php
                $sql = "SELECT Count(ArticleID) as apkg FROM UserAssignedArticles 
                 where ArticleID not in (Select ArticleID from `UserAssignedArticles` where ProcessingStageID > '$PSIDQA' ) 
                and `Status`='Completed' and ProcessingStageID= '$PSIDQA';";
                $stmt = $pdo->prepare($sql);
                if ($stmt->execute()) {
                    $row = $stmt->fetch();
                    $apkg = $row['apkg'];
                }
                ?>
                <?php

                $week_assigned_sql = "SELECT Count(ArticleID) as lastWeekArticles FROM UserAssignedArticles 
                where ArticleID not in (Select ArticleID from `UserAssignedArticles` where ProcessingStageID > '$PSIDQA' ) 
                and `Status`='Completed' and ProcessingStageID= '$PSIDQA' AND Date between date_sub(now(),INTERVAL 1 WEEK) and now()";
                $week_assigned_stmt =  $pdo->prepare($week_assigned_sql);

                if ($week_assigned_stmt->execute()) {
                    $week_assigned_row = $week_assigned_stmt->fetch();
                    $lastWeekArticles_apkg = $week_assigned_row['lastWeekArticles'];
                }
                ?>

                <?php
                $sql = "SELECT Count(ArticleID) as apkgdl FROM UserAssignedArticles 
                where ArticleID not in (Select ArticleID from `UserAssignedArticles` where ProcessingStageID > '$PSIDartpkg' ) 
                and `Status`='Completed' and ProcessingStageID= '$PSIDartpkg';";
                $stmt = $pdo->prepare($sql);
                if ($stmt->execute()) {
                    $row = $stmt->fetch();
                    $apkgdl = $row['apkgdl'];
                }
                ?>
                <?php

                $week_assigned_sql = "SELECT Count(ArticleID) as lastWeekArticles FROM UserAssignedArticles 
                where ArticleID not in (Select ArticleID from `UserAssignedArticles` where ProcessingStageID > '$PSIDartpkg' ) 
                and `Status`='Completed' and ProcessingStageID= '$PSIDartpkg' AND Date between date_sub(now(),INTERVAL 1 WEEK) and now()";
                $week_assigned_stmt =  $pdo->prepare($week_assigned_sql);

                if ($week_assigned_stmt->execute()) {
                    $week_assigned_row = $week_assigned_stmt->fetch();
                    $lastWeekArticles_apkgdl = $week_assigned_row['lastWeekArticles'];
                }
                ?>

                <!--- END Code for PHP Queries for Small Boxes -->

                <!--- Start Code for Small Boxes on top -->
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-h-100">
                            <!-- card body -->
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <span class="text-muted mb-3 lh-1 d-block text-truncate">Total Articles</span>

                                    <div class="col-6">
                                        <h4 class="mb-3"> <span class="counter-value" data-target="<?php echo $TotalArticles; ?>">0</span> </h4>
                                    </div>

                                    <div class="col-6">
                                        <div id="mini-chart1" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                    </div>
                                </div>
                                <div class="text-nowrap">

                                    <span class="badge bg-soft-success text-success"><?php echo $lastWeekArticles_total; ?> Articles </span>
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
                                    <span class="text-muted mb-3 lh-1 d-block text-truncate">Delivered Articles</span>

                                    <div class="col-6">
                                        <h4 class="mb-3"> <span class="counter-value" data-target="<?php echo $ArchiveArt; ?>">0</span> </h4>
                                    </div>
                                    <div class="col-6">
                                        <div id="mini-chart2" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                    </div>
                                </div>
                                <div class="text-nowrap">
                                    <span class="badge bg-soft-danger text-danger"><?php echo $lastWeekArticles_archive; ?> Articles </span>
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
                                    <span class="text-muted mb-1 lh-1 d-block text-truncate">In Process Articles</span>

                                    <div class="col-6">
                                        <h4 class="mb-3"> <span class="counter-value" data-target="<?php echo $InProcessArticles; ?>">0</span> </h4>
                                    </div>
                                    <div class="col-6">
                                        <div id="mini-chart3" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                    </div>
                                </div>
                                <div class="text-nowrap">
                                    <span class="badge bg-soft-success text-success"><?php echo $lastWeekArticles_inprocess; ?> Articles </span>
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
                                    <span class="text-muted mb-3 lh-1 d-block text-truncate">Available For XML Conversion</span>

                                    <div class="col-6">
                                        <h4 class="mb-3"> <span class="counter-value" data-target="<?php echo $xmlconv; ?>">0</span> </h4>
                                    </div>
                                    <div class="col-6">
                                        <div id="mini-chart4" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                    </div>
                                </div>

                                <div class="text-nowrap">
                                    <span class="badge bg-soft-success text-success"><?php echo $lastWeekArticles_xmlc; ?> Articles</span>
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
                                    <span class="text-muted mb-3 lh-1 d-block text-truncate">Available For XML Validation</span>

                                    <div class="col-6">
                                        <h4 class="mb-3"> <span class="counter-value" data-target="<?php echo $xmlval; ?>">0</span> </h4>
                                    </div>

                                    <div class="col-6">
                                        <div id="mini-chart1" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                    </div>
                                </div>
                                <div class="text-nowrap">
                                    <span class="badge bg-soft-success text-success"><?php echo $lastWeekArticles_xmlv; ?> Articles</span>
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
                                    <span class="text-muted mb-3 lh-1 d-block text-truncate">Available For QA</span>

                                    <div class="col-6">
                                        <h4 class="mb-3"> <span class="counter-value" data-target="<?php echo $QA; ?>">0</span> </h4>
                                    </div>
                                    <div class="col-6">
                                        <div id="mini-chart5" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                    </div>
                                </div>
                                <div class="text-nowrap">
                                    <span class="badge bg-soft-danger text-danger"><?php echo $lastWeekArticles_QA; ?> Articles</span>
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
                                    <span class="text-muted mb-3 lh-1 d-block text-truncate">Available For Packaging</span>

                                    <div class="col-6">
                                        <h4 class="mb-3"> <span class="counter-value" data-target="<?php echo $apkg; ?>">0</span> </h4>
                                    </div>
                                    <div class="col-6">
                                        <div id="mini-chart3" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                    </div>
                                </div>
                                <div class="text-nowrap">
                                    <span class="badge bg-soft-success text-success"><?php echo $lastWeekArticles_apkg; ?> Articles</span>
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
                                    <span class="text-muted mb-3 lh-1 d-block text-truncate">Available For Delivery</span>

                                    <div class="col-6">
                                        <h4 class="mb-3"><span class="counter-value" data-target="<?php echo $apkgdl; ?>">0</span> </h4>
                                    </div>
                                    <div class="col-6">
                                        <div id="mini-chart4" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                    </div>
                                </div>
                                <div class="text-nowrap">
                                    <span class="badge bg-soft-success text-success"><?php echo $lastWeekArticles_apkgdl; ?> Articles</span>
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

                // XML Conversion
                $ProcessingStageName = "XML Conversion";

                $sql = "SELECT *  FROM Articles where ArticleID not in 
                                        (Select ArticleID from `UserAssignedArticles`) and `Status`='Active'";
                $stmt = $pdo->prepare($sql);
                if ($stmt->execute()) {
                    $rows_xmlconv = $stmt->fetchAll();
                }

                // XML Validation
                $sql = "SELECT *  FROM Articles where ArticleID in
                (SELECT ArticleID as xmlval FROM UserAssignedArticles 
                where ArticleID not in (Select ArticleID from `UserAssignedArticles` where ProcessingStageID > '$PSIDxmlconv' ) 
                and `Status`='Completed' and ProcessingStageID= '$PSIDxmlconv' ) and `Status`='Active'";
                $stmt = $pdo->prepare($sql);
                if ($stmt->execute()) {
                    $rows_xmlvalid = $stmt->fetchAll();
                }

                // QA
                $sql = "SELECT *  FROM Articles where ArticleID in
                (SELECT ArticleID as xmlval FROM UserAssignedArticles 
                where ArticleID not in (Select ArticleID from `UserAssignedArticles` where ProcessingStageID > '$PSIDxmlvalid' ) 
                and `Status`='Completed' and ProcessingStageID= '$PSIDxmlvalid' ) and `Status`='Active'";
                $stmt = $pdo->prepare($sql);
                if ($stmt->execute()) {
                    $rows_xmlQA = $stmt->fetchAll();
                }

                // Article Packaging
                $sql = "SELECT *  FROM Articles where ArticleID in
               (SELECT ArticleID as xmlval FROM UserAssignedArticles 
                where ArticleID not in (Select ArticleID from `UserAssignedArticles` where ProcessingStageID > '$PSIDQA' ) 
                and `Status`='Completed' and ProcessingStageID= '$PSIDQA' ) and `Status`='Active'";
                $stmt = $pdo->prepare($sql);
                if ($stmt->execute()) {
                    $rows_artpkg = $stmt->fetchAll();
                }

                // Article Delivery
                $sql = "SELECT *  FROM Articles where ArticleID in
                                        (SELECT ArticleID as xmlval FROM UserAssignedArticles 
                                        where ArticleID not in (Select ArticleID from `UserAssignedArticles` where ProcessingStageID > '$PSIDartpkg' ) 
                                        and `Status`='Completed' and ProcessingStageID= '$PSIDartpkg' ) and `Status`='Active'";
                $stmt = $pdo->prepare($sql);
                if ($stmt->execute()) {
                    $rows_artdl = $stmt->fetchAll();
                }
                ?>
                <!-- END Php Queries For Tables -->

                <!-- Start code for XML Conversion tables -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header" style="background-color:#c1c3ee;">
                                <h4 class="card-title">Articles Available For XML Conversioning</h4>
                            </div>
                            <div class="card-body">

                                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                    <thead>
                                        <tr>

                                            <th>ArticleTitle</th>
                                            <th>ArticleCode</th>
                                            <th>Article Info</th>
                                            <th>Files</th>
                                            <th>AddedBy</th>
                                            <th>Date</th>
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

                                                <td><?php

                                                    $uid = $row_xmlc["AddedBy"];
                                                    $sql = "SELECT UserName FROM Users Where UserID=$uid";
                                                    $stmt = $pdo->prepare($sql);
                                                    if ($stmt->execute()) {
                                                        $row = $stmt->fetch();
                                                        echo  $user = $row['UserName'];
                                                    }

                                                    ?></td>
                                                <td><?php echo date("Y-m-d", strtotime($row_xmlc["Date"])); ?></td>
                                                <td><?php
                                                    $now = time(); // or your date as well
                                                    $your_date = strtotime($row_xmlc["Date"]);
                                                    $datediff = $now - $your_date;
                                                    echo "<span class='text-danger'>" . round($datediff / (60 * 60 * 24)) . "  Days </span>";

                                                    ?></td>
                                                <td><a href="Assign_Article_User.php?psid=<?php echo $PSIDxmlconv; ?>&arid=<?php echo $row_xmlc["ArticleID"]; ?>&astid=1" class="btn btn-info">Assign</a>
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

                <!-- Start code for XML Validation tables -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header" style="background-color:#c1c3ee;">
                                <h4 class="card-title">Articles Available For XML Validation</h4>
                            </div>
                            <div class="card-body">

                                <table id="datatable1" class="table table-bordered dt-responsive  nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>ArticleTitle</th>
                                            <th>ArticleCode</th>
                                            <th>Article Info</th>
                                            <th>Files</th>
                                            <th>AddedBy</th>
                                            <th>Date</th>
                                            <th>Delay</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        <?php foreach ($rows_xmlvalid as $row_xmlv) { ?>
                                            <tr>
                                                <td><?php echo wordwrap($row_xmlv["ArticleTitle"], 35, "<br>\n"); ?></td>
                                                <td><?php echo $row_xmlv["ArticleCode"]; ?></td>
                                                <td><?php
                                                    $jid = $row_xmlv["JournalID"];
                                                    $sql = "SELECT JournalCode FROM Journals Where JournalID=$jid";
                                                    $stmt = $pdo->prepare($sql);
                                                    if ($stmt->execute()) {
                                                        $row = $stmt->fetch();
                                                        echo "Journal: " . $jcode = $row['JournalCode'];
                                                    }
                                                    echo "<br>Volume: " . $jcode = $row_xmlv['ArticleVolume'];
                                                    echo "<br>Issue: " . $jcode = $row_xmlv['ArticleIssue'];
                                                    echo "<br>Year: " . $jcode = $row_xmlv['ArticleYear'];
                                                    ?></td>
                                                <td>
                                                    <?php

                                                    // fetch pdf files
                                                    $pdf_sql = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND ( FileType = 'pdf' or FileType = 'PDF' ))";
                                                    $pdf_stmt = $pdo->prepare($pdf_sql);
                                                    $pdf_stmt->bindParam(":articleID", $row_xmlv["ArticleID"]);
                                                    $pdf_result = $pdf_stmt->execute();
                                                    $pdf_result = $pdf_stmt->fetch();

                                                    // fetch docx files
                                                    $wordFile = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND (FileType = 'docx' or FileType = 'doc' or FileType = 'Word'))";
                                                    $word_stmt = $pdo->prepare($wordFile);
                                                    $word_stmt->bindParam(":articleID", $row_xmlv["ArticleID"]);
                                                    $word_result = $word_stmt->execute();
                                                    $word_result = $word_stmt->fetch();

                                                    // fetch inera files
                                                    $ineraFile = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND (FileType = 'Inera' or FileType = 'XML Converted'))";
                                                    $inera_stmt = $pdo->prepare($ineraFile);
                                                    $inera_stmt->bindParam(":articleID", $row_xmlv["ArticleID"]);
                                                    $inera_result = $inera_stmt->execute();
                                                    $inera_result = $inera_stmt->fetch();

                                                    ?>
                                                    <a href="Download_file.php?file_id=<?php echo $pdf_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm btn-primary">PDF File</a>
                                                    <br><a href="Download_file.php?file_id=<?php echo $word_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm btn-primary mt-1">Word File</a>
                                                    <br><a href="Download_file.php?file_id=<?php echo $word_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm btn-primary mt-1">XML Converted</a>
                                                </td>

                                                <td><?php

                                                    $uid = $row_xmlv["AddedBy"];
                                                    $sql = "SELECT UserName FROM Users Where UserID=$uid";
                                                    $stmt = $pdo->prepare($sql);
                                                    if ($stmt->execute()) {
                                                        $row = $stmt->fetch();
                                                        echo  $user = $row['UserName'];
                                                    }

                                                    ?></td>
                                                <td><?php echo date("Y-m-d", strtotime($row_xmlv["Date"])); ?></td>
                                                <td><?php
                                                    $now = time(); // or your date as well
                                                    $your_date = strtotime($row_xmlv["Date"]);
                                                    $datediff = $now - $your_date;
                                                    echo "<span class='text-danger'>" . round($datediff / (60 * 60 * 24)) . "  Days </span>";

                                                    ?></td>
                                                <td><a href="Assign_Article_User.php?psid=<?php echo $PSIDxmlvalid; ?>&arid=<?php echo $row_xmlv["ArticleID"]; ?>&astid=1" class="btn btn-info">Assign</a></td>
                                            </tr>
                                        <?php } ?>

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
                                <h4 class="card-title">Articles Available For QA</h4>
                            </div>
                            <div class="card-body">

                                <table id="datatable2" class="table table-bordered dt-responsive  nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>ArticleTitle</th>
                                            <th>ArticleCode</th>
                                            <th>Article Info</th>
                                            <th>Files</th>
                                            <th>AddedBy</th>
                                            <th>Date</th>
                                            <th>Delay</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        <?php foreach ($rows_xmlQA as $row_xmlv) { ?>
                                            <tr>
                                                <td><?php echo wordwrap($row_xmlv["ArticleTitle"], 35, "<br>\n"); ?></td>
                                                <td><?php echo $row_xmlv["ArticleCode"]; ?></td>
                                                <td><?php
                                                    $jid = $row_xmlv["JournalID"];
                                                    $sql = "SELECT JournalCode FROM Journals Where JournalID=$jid";
                                                    $stmt = $pdo->prepare($sql);
                                                    if ($stmt->execute()) {
                                                        $row = $stmt->fetch();
                                                        echo "Journal: " . $jcode = $row['JournalCode'];
                                                    }
                                                    echo "<br>Volume: " . $jcode = $row_xmlv['ArticleVolume'];
                                                    echo "<br>Issue: " . $jcode = $row_xmlv['ArticleIssue'];
                                                    echo "<br>Year: " . $jcode = $row_xmlv['ArticleYear'];
                                                    ?></td>
                                                <td>
                                                    <?php

                                                    // fetch pdf files
                                                    $pdf_sql = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND ( FileType = 'pdf' or FileType = 'PDF' ))";
                                                    $pdf_stmt = $pdo->prepare($pdf_sql);
                                                    $pdf_stmt->bindParam(":articleID", $row_xmlv["ArticleID"]);
                                                    $pdf_result = $pdf_stmt->execute();
                                                    $pdf_result = $pdf_stmt->fetch();

                                                    // fetch docx files
                                                    $wordFile = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND (FileType = 'docx' or FileType = 'doc' or FileType = 'Word'))";
                                                    $word_stmt = $pdo->prepare($wordFile);
                                                    $word_stmt->bindParam(":articleID", $row_xmlv["ArticleID"]);
                                                    $word_result = $word_stmt->execute();
                                                    $word_result = $word_stmt->fetch();

                                                    // fetch XML Conversion files
                                                    $inera_sql = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND ( FileType = 'Inera' or FileType = 'XML Converted'  ))";
                                                    $inera_stmt = $pdo->prepare($inera_sql);
                                                    $inera_stmt->bindParam(":articleID", $row_xmlv["ArticleID"]);
                                                    $inera_result = $inera_stmt->execute();
                                                    $inera_result = $inera_stmt->fetch();

                                                    // fetch XML Validation  files
                                                    $validFile = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND (FileType = 'XML Valid'))";
                                                    $valid_stmt = $pdo->prepare($validFile);
                                                    $valid_stmt->bindParam(":articleID", $row_xmlv["ArticleID"]);
                                                    $valid_result = $valid_stmt->execute();
                                                    $valid_result = $valid_stmt->fetch();

                                                    ?>
                                                    <a href="Download_file.php?file_id=<?php echo $pdf_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm btn-primary">PDF File</a>
                                                    <a href="Download_file.php?file_id=<?php echo $word_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm btn-primary mt-1">Word File</a>
                                                    <br><a href="Download_file.php?file_id=<?php echo $inera_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm ml-2 btn-primary mt-1">XML Converted File</a>
                                                    <br><a href="Download_file.php?file_id=<?php echo $valid_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm ml-2 btn-primary mt-1">XML Valid File</a>
                                                </td>

                                                <td><?php

                                                    $uid = $row_xmlv["AddedBy"];
                                                    $sql = "SELECT UserName FROM Users Where UserID=$uid";
                                                    $stmt = $pdo->prepare($sql);
                                                    if ($stmt->execute()) {
                                                        $row = $stmt->fetch();
                                                        echo  $user = $row['UserName'];
                                                    }

                                                    ?></td>
                                                <td><?php echo date("Y-m-d", strtotime($row_xmlv["Date"])); ?></td>
                                                <td><?php
                                                    $now = time(); // or your date as well
                                                    $your_date = strtotime($row_xmlv["Date"]);
                                                    $datediff = $now - $your_date;
                                                    echo "<span class='text-danger'>" . round($datediff / (60 * 60 * 24)) . "  Days </span>";

                                                    ?></td>
                                                <td><a href="Assign_Article_User.php?psid=<?php echo $PSIDQA; ?>&arid=<?php echo $row_xmlv["ArticleID"]; ?>&astid=1" class="btn btn-info">Assign</a></td>
                                            </tr>
                                        <?php } ?>

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
                                <h4 class="card-title">Articles Available For Packaging</h4>
                            </div>
                            <div class="card-body">

                                <table id="datatable3" class="table table-bordered dt-responsive  nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>ArticleTitle</th>
                                            <th>ArticleCode</th>
                                            <th>Article Info</th>
                                            <th>Files</th>
                                            <th>AddedBy</th>
                                            <th>Date</th>
                                            <th>Delay</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        <?php foreach ($rows_artpkg as $row_xmlv) { ?>
                                            <tr>
                                                <td><?php echo wordwrap($row_xmlv["ArticleTitle"], 35, "<br>\n"); ?></td>
                                                <td><?php echo $row_xmlv["ArticleCode"]; ?></td>
                                                <td><?php
                                                    $jid = $row_xmlv["JournalID"];
                                                    $sql = "SELECT JournalCode FROM Journals Where JournalID=$jid";
                                                    $stmt = $pdo->prepare($sql);
                                                    if ($stmt->execute()) {
                                                        $row = $stmt->fetch();
                                                        echo "Journal: " . $jcode = $row['JournalCode'];
                                                    }
                                                    echo "<br>Volume: " . $jcode = $row_xmlv['ArticleVolume'];
                                                    echo "<br>Issue: " . $jcode = $row_xmlv['ArticleIssue'];
                                                    echo "<br>Year: " . $jcode = $row_xmlv['ArticleYear'];
                                                    ?></td>
                                                <td>
                                                    <?php

                                                    // fetch pdf files
                                                    $pdf_sql = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND ( FileType = 'pdf' or FileType = 'PDF' ))";
                                                    $pdf_stmt = $pdo->prepare($pdf_sql);
                                                    $pdf_stmt->bindParam(":articleID", $row_xmlv["ArticleID"]);
                                                    $pdf_result = $pdf_stmt->execute();
                                                    $pdf_result = $pdf_stmt->fetch();

                                                    // fetch docx files
                                                    $wordFile = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND (FileType = 'docx' or FileType = 'doc' or FileType = 'Word'))";
                                                    $word_stmt = $pdo->prepare($wordFile);
                                                    $word_stmt->bindParam(":articleID", $row_xmlv["ArticleID"]);
                                                    $word_result = $word_stmt->execute();
                                                    $word_result = $word_stmt->fetch();

                                                    // fetch XML Conversion files
                                                    $inera_sql = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND ( FileType = 'Inera' or FileType = 'XML Converted'  ))";
                                                    $inera_stmt = $pdo->prepare($inera_sql);
                                                    $inera_stmt->bindParam(":articleID", $row_xmlv["ArticleID"]);
                                                    $inera_result = $inera_stmt->execute();
                                                    $inera_result = $inera_stmt->fetch();

                                                    // fetch XML Validation  files
                                                    $validFile = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND (FileType = 'XML Valid'))";
                                                    $valid_stmt = $pdo->prepare($validFile);
                                                    $valid_stmt->bindParam(":articleID", $row_xmlv["ArticleID"]);
                                                    $valid_result = $valid_stmt->execute();
                                                    $valid_result = $valid_stmt->fetch();

                                                    ?>
                                                    <a href="Download_file.php?file_id=<?php echo $pdf_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm btn-primary">PDF File</a>
                                                    <a href="Download_file.php?file_id=<?php echo $word_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm btn-primary mt-1">Word File</a>
                                                    <br><a href="Download_file.php?file_id=<?php echo $inera_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm ml-2 btn-primary mt-1">XML Converted File</a>
                                                    <br><a href="Download_file.php?file_id=<?php echo $valid_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm ml-2 btn-primary mt-1">XML Valid File</a>
                                                </td>

                                                <td><?php

                                                    $uid = $row_xmlv["AddedBy"];
                                                    $sql = "SELECT UserName FROM Users Where UserID=$uid";
                                                    $stmt = $pdo->prepare($sql);
                                                    if ($stmt->execute()) {
                                                        $row = $stmt->fetch();
                                                        echo  $user = $row['UserName'];
                                                    }

                                                    ?></td>
                                                <td><?php echo date("Y-m-d", strtotime($row_xmlv["Date"])); ?></td>
                                                <td><?php
                                                    $now = time(); // or your date as well
                                                    $your_date = strtotime($row_xmlv["Date"]);
                                                    $datediff = $now - $your_date;
                                                    echo "<span class='text-danger'>" . round($datediff / (60 * 60 * 24)) . "  Days </span>";

                                                    ?></td>
                                                <td><a href="Assign_Article_User.php?psid=<?php echo $PSIDartpkg; ?>&arid=<?php echo $row_xmlv["ArticleID"]; ?>&astid=1" class="btn btn-info">Assign</a></td>
                                            </tr>
                                        <?php } ?>


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
                                <h4 class="card-title">Articles Available For Delivery</h4>
                            </div>
                            <div class="card-body">

                                <table id="datatable4" class="table table-bordered dt-responsive  nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>ArticleTitle</th>
                                            <th>ArticleCode</th>
                                            <th>Article Info</th>
                                            <th>Files</th>
                                            <th>AddedBy</th>
                                            <th>Date</th>
                                            <th>Delay</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        <?php foreach ($rows_artdl as $row_xmlv) { ?>
                                            <tr>
                                                <td><?php echo wordwrap($row_xmlv["ArticleTitle"], 35, "<br>\n"); ?></td>
                                                <td><?php echo $row_xmlv["ArticleCode"]; ?></td>
                                                <td><?php
                                                    $jid = $row_xmlv["JournalID"];
                                                    $sql = "SELECT JournalCode FROM Journals Where JournalID=$jid";
                                                    $stmt = $pdo->prepare($sql);
                                                    if ($stmt->execute()) {
                                                        $row = $stmt->fetch();
                                                        echo "Journal: " . $jcode = $row['JournalCode'];
                                                    }
                                                    echo "<br>Volume: " . $jcode = $row_xmlv['ArticleVolume'];
                                                    echo "<br>Issue: " . $jcode = $row_xmlv['ArticleIssue'];
                                                    echo "<br>Year: " . $jcode = $row_xmlv['ArticleYear'];
                                                    ?></td>
                                                <td>
                                                    <?php

                                                    // fetch pdf files
                                                    $pdf_sql = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND ( FileType = 'pdf' or FileType = 'PDF' ))";
                                                    $pdf_stmt = $pdo->prepare($pdf_sql);
                                                    $pdf_stmt->bindParam(":articleID", $row_xmlv["ArticleID"]);
                                                    $pdf_result = $pdf_stmt->execute();
                                                    $pdf_result = $pdf_stmt->fetch();

                                                    // fetch docx files
                                                    $wordFile = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND (FileType = 'docx' or FileType = 'doc' or FileType = 'Word'))";
                                                    $word_stmt = $pdo->prepare($wordFile);
                                                    $word_stmt->bindParam(":articleID", $row_xmlv["ArticleID"]);
                                                    $word_result = $word_stmt->execute();
                                                    $word_result = $word_stmt->fetch();

                                                    // fetch XML Conversion files
                                                    $inera_sql = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND ( FileType = 'Inera' or FileType = 'XML Converted'  ))";
                                                    $inera_stmt = $pdo->prepare($inera_sql);
                                                    $inera_stmt->bindParam(":articleID", $row_xmlv["ArticleID"]);
                                                    $inera_result = $inera_stmt->execute();
                                                    $inera_result = $inera_stmt->fetch();

                                                    // fetch XML Validation  files
                                                    $validFile = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND (FileType = 'XML Valid'))";
                                                    $valid_stmt = $pdo->prepare($validFile);
                                                    $valid_stmt->bindParam(":articleID", $row_xmlv["ArticleID"]);
                                                    $valid_result = $valid_stmt->execute();
                                                    $valid_result = $valid_stmt->fetch();

                                                    // fetch Epub files
                                                    $epub_sql = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND ( FileType = 'epub'))";
                                                    $epub_stmt = $pdo->prepare($epub_sql);
                                                    $epub_stmt->bindParam(":articleID", $row_xmlv["ArticleID"]);
                                                    $epub_result = $epub_stmt->execute();
                                                    $epub_result = $epub_stmt->fetch();

                                                    // fetch HTML files
                                                    $htmlFile = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND (FileType = 'html'))";
                                                    $html_stmt = $pdo->prepare($htmlFile);
                                                    $html_stmt->bindParam(":articleID", $row_xmlv["ArticleID"]);
                                                    $html_result = $html_stmt->execute();
                                                    $html_result = $html_stmt->fetch();

                                                    ?>
                                                    <a href="Download_file.php?file_id=<?php echo $pdf_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm btn-primary">PDF File</a>
                                                    <a href="Download_file.php?file_id=<?php echo $word_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm btn-primary ml-2 mt-1">Word File</a>
                                                    <br><a href="Download_file.php?file_id=<?php echo $inera_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm btn-primary mt-1">XML Converted File</a>
                                                    <a href="Download_file.php?file_id=<?php echo $valid_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm btn-primary ml-2 mt-1">XML Valid File</a>
                                                    <br><a href="Download_file.php?file_id=<?php echo $epub_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm btn-primary mt-1">Epub File</a>
                                                    <a href="Download_file.php?file_id=<?php echo $html_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm btn-primary ml-2 mt-1">HTML File</a>
                                                </td>

                                                <td><?php

                                                    $uid = $row_xmlv["AddedBy"];
                                                    $sql = "SELECT UserName FROM Users Where UserID=$uid";
                                                    $stmt = $pdo->prepare($sql);
                                                    if ($stmt->execute()) {
                                                        $row = $stmt->fetch();
                                                        echo  $user = $row['UserName'];
                                                    }

                                                    ?></td>
                                                <td><?php echo date("Y-m-d", strtotime($row_xmlv["Date"])); ?></td>
                                                <td><?php
                                                    $now = time(); // or your date as well
                                                    $your_date = strtotime($row_xmlv["Date"]);
                                                    $datediff = $now - $your_date;
                                                    echo "<span class='text-danger'>" . round($datediff / (60 * 60 * 24)) . "  Days </span>";

                                                    ?></td>
                                                <td><a href="Assign_Article_User.php?psid=<?php echo $PSIDartdl; ?>&arid=<?php echo $row_xmlv["ArticleID"]; ?>&astid=1" class="btn btn-info">Assign</a></td>
                                            </tr>
                                        <?php } ?>


                                    </tbody>

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