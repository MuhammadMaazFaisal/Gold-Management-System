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

                <!-- start dropdown -->
                <div class="row">
                    <div class="col-12">

                        <form class="custom-validation" action="InProcess_Report_dashboard_db.php" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <?php
                                 $userid = trim($_GET["userid"]);
                                // $userid=$_GET['userid'];
                                //Already existing users
                                $stmt = $pdo->prepare("SELECT * FROM Users");
                                $stmt->execute();
                                $row = $stmt->fetchAll();

                                //already existing stages
                                $stmt1 = $pdo->prepare("SELECT ProcessingStages.ProcessingStageID, ProcessingStages.ProcessingStageName FROM ProcessingStages INNER JOIN UserProcessingStages ON UserProcessingStages.ProcessingStageID=ProcessingStages.ProcessingStageID WHERE UserProcessingStages.UserID=$userid");
                                $stmt1->execute();
                                $row1 = $stmt1->fetchAll();

                                //SELECT Roles.RoleID, Roles.RoleName FROM Roles INNER JOIN UserRoles ON UserRoles.RoleID=Roles.RoleID
                                /// WHERE UserRoles.UserID=$userid"
                                //SELECT ProcessingStages.ProcessingStageID, ProcessingStages.ProcessingStageName FROM ProcessingStages INNER JOIN RoleProcessingStages ON RoleProcessingStages.ProcessingStageID=ProcessingStages.ProcessingStageID WHERE RoleProcessingStages.RoleID=$userid"
                                
                                ?>
                                <div class="form-group col-5 ">
                                    <label for="user_id">Users</label>
                                    <select name="user_id" class="form-control">

                                        <?php foreach ($row as $output) { ?>
                                            <option value="<?php echo $output['UserID'];?>"> <?php echo $output['UserName']; ?>
                                            </option>
                                        <?php
                                        } ?>

                                    </select>

                                </div>
                                <div class="form-group col-5 ">
                                    <label for="p_id">Processing Stage</label>
                                    <select name="p_id" class="form-control">

                                        <?php foreach ($row1 as $output) { ?>
                                            <option value="<?php echo $output['']; ?>"> <?php echo $output['ProcessingID']; ?>
                                            </option>
                                        <?php
                                        } ?>





                                    </select>

                                </div>

                                <div class="form-group mt-4 col-2">
                                    <div>

                                        <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                            Submit
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </form>


                    </div>
                </div>
                <br>
                <!-- end dropdown -->

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Article Assignment Dashboard</h4>

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

                                    $sql = "SELECT COUNT(ArticleID) AS 'totalUnassignedArticles' FROM Articles WHERE ArticleID NOT IN (SELECT ArticleID FROM UserAssignedArticles) AND Status = 'Active'";

                                    $stmt = $pdo->prepare($sql);

                                    if ($stmt->execute()) {
                                        $row = $stmt->fetch();
                                        $totalUnassignedArticles = $row['totalUnassignedArticles'];
                                    }
                                    ?>
                                    <div class="col-6">
                                        <h4 class="mb-3"> <span class="counter-value" data-target="<?php echo $totalUnassignedArticles; ?>">0</span> </h4>
                                    </div>

                                    <div class="col-6">
                                        <div id="mini-chart1" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                    </div>
                                </div>
                                <div class="text-nowrap">
                                    <span class="badge bg-soft-success text-success"><?php echo $totalUnassignedArticles >= 1 ? '+' . $totalUnassignedArticles - 5 . ' Articles' : '0 Articles'; ?> </span>
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

                                    $ProcessingStage = $_SESSION["ProcessingStage"];

                                    $query = "SELECT Count(UserID) AS UserAssignedArticles FROM UserAssignedArticles WHERE UserID = :id AND Status = 'Assigned' AND ProcessingStageID = :ProcessingStage";

                                    $queryRun = $pdo->prepare($query);

                                    $queryRun->bindParam(":id", $User_ID);

                                    $queryRun->bindParam(":ProcessingStage", $ProcessingStage);

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
                                    <span class="text-muted mb-1 lh-1 d-block text-truncate">Accepted Articles</span>
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

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-h-100">
                            <!-- card body -->
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <span class="text-muted mb-3 lh-1 d-block text-truncate">Articles On Hold</span>
                                    <div class="col-6">
                                        <h4 class="mb-3"> <span class="counter-value" data-target="1257">0</span> </h4>
                                    </div>
                                    <div class="col-6">
                                        <div id="mini-chart4" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                    </div>
                                </div>
                                <div class="text-nowrap">
                                    <span class="badge bg-soft-success text-success">+95 Articles</span>
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
                                    <div class="col-6">
                                        <h4 class="mb-3"> <span class="counter-value" data-target="862">0</span> </h4>
                                    </div>

                                    <div class="col-6">
                                        <div id="mini-chart1" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                    </div>
                                </div>
                                <div class="text-nowrap">
                                    <span class="badge bg-soft-success text-success">+20</span>
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
                                    <span class="text-muted mb-3 lh-1 d-block text-truncate">Rejected By XML</span>
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
                                    <span class="text-muted mb-3 lh-1 d-block text-truncate">Available For Packaging</span>
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

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-h-100">
                            <!-- card body -->
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <span class="text-muted mb-3 lh-1 d-block text-truncate">Available For Delivery</span>
                                    <div class="col-6">
                                        <h4 class="mb-3"><span class="counter-value" data-target="557">0</span> </h4>
                                    </div>
                                    <div class="col-6">
                                        <div id="mini-chart4" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                    </div>
                                </div>
                                <div class="text-nowrap">
                                    <span class="badge bg-soft-success text-success">+29 Articles</span>
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
                                <h4 class="card-title">Articles Available For XML Conversioning</h4>
                            </div>
                            <div class="card-body">
                                <?php
                                $ProcessingStageName = "XML Conversion";
                                // All Articles NOT in (Articles in Assigned Table for XML Conversion) and word and pdf files present in Record FIles table

                                $sql1 = "SELECT * From Articles Where ArticleID NOT IN (SELECT ArticleID From UserAssignedArticles ,ProcessingStages 
where ProcessingStages.ProcessingStageID = UserAssignedArticles.ProcessingStageID and ProcessingStageName='$ProcessingStageName') 
";

                                ?>
                                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>ArticleCode</th>
                                            <th>ArticleTitle</th>
                                            <th>Word/PDF Files</th>
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
                                            <th>ArticleCode</th>
                                            <th>ArticleTitle</th>
                                            <th>Word/PDF Files</th>
                                            <th>Inera File</th>
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
                                            <td>System Architect</td>
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