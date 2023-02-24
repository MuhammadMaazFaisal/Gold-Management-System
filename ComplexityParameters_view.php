<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php include 'layouts/config.php';

if (!isset($_SESSION['VCP'])) {
    //User not logged in. Redirect them back to the error page.
    header('Location: pages-403.php');
    exit;
}

?>

<head>
    <title>View</title>
    <?php include 'layouts/head.php'; ?>

    <!-- choices css -->
    <link href="assets/libs/choices.js/public/assets/styles/choices.min.css" rel="stylesheet" type="text/css" />

    <!-- color picker css -->
    <link rel="stylesheet" href="assets/libs/@simonwep/pickr/themes/classic.min.css" /> <!-- 'classic' theme -->
    <link rel="stylesheet" href="assets/libs/@simonwep/pickr/themes/monolith.min.css" /> <!-- 'monolith' theme -->
    <link rel="stylesheet" href="assets/libs/@simonwep/pickr/themes/nano.min.css" /> <!-- 'nano' theme -->

    <!-- datepicker css -->
    <link rel="stylesheet" href="assets/libs/flatpickr/flatpickr.min.css">

    <?php include(root . '/layouts/head-style.php'); ?>

</head>

<?php include(root . '/layouts/body.php'); ?>

<!-- Begin page -->
<div id="layout-wrapper">

    <?php include 'layouts/menu.php'; ?>
    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
        <!-- ======= -->
        <div class="page-content">
            <form id="form-horizontal" class="form-horizontal form-wizard-wrapper">
                <h3>Complexity Parameters</h3>
                <fieldset>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <a class="btn btn-primary btn-lg waves-effect waves-light bx bx-add-to-queue" target="_blank" href="ComplexityParameters_add.php">Add Setting</a> <br><br>
                                    <?php
                                    $sql = "SELECT * FROM ComplexityParameters";
                                    $systemRecord = $pdo->prepare($sql);
                                    if ($systemRecord->execute()) {

                                    ?>
                                        <table id="datatable" class="display table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" role="grid">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Complexity Parameter Name</th>
                                                    <th>Complexity Parameter Score</th>
                                                    <th>Complexity Parameter Status</th>
                                                    <!-- <th>Complexity Parameter Date</th> -->
                                                    <th>Added By</th>
                                                    <th>Action</th>

                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php $iteration = 1;
                                                while ($row = $systemRecord->fetch()) { ?>
                                                    <tr>
                                                        <td><?php echo $iteration . ""; ?></td>
                                                        <td><?php echo $row["ComplexityParameterName"] ?? 'N/A'; ?></td>
                                                        <td><?php echo $row["ComplexityParameterScore"] ?? 'N/A'; ?></td>
                                                        <td><?php echo $row["ComplexityParameterStatus"] ?? 'N/A'; ?></td>
                                                        <!-- <td> -->
                                                        <?php
                                                        // echo $row["ComplexityParameterDate"]??'N/A';
                                                        ?>
                                                        <!-- </td> -->
                                                        <td>
                                                            <?php
                                                            $userId = $row['AddedBy'] ?? '';

                                                            $queryRun = $pdo->prepare("SELECT UserName FROM Users WHERE UserID = $userId");

                                                            $queryRun->execute();

                                                            $userName = $queryRun->fetch();

                                                            echo $userName['UserName'] ?? 'N/A';
                                                            ?>
                                                        </td>

                                                        <td>
                                                            <a class="btn btn-primary btn-sm" href="ComplexityParameters_add.php?id=<?php echo $row["ComplexityParameterID"];
                                                                                                                                    if (!isset($_SESSION['ECP'])) {
                                                                                                                                        //User not logged in. Redirect them back to the error page.
                                                                                                                                        header('Location: pages-403.php');
                                                                                                                                        exit;
                                                                                                                                    }

                                                                                                                                    ?>&from=edit">Modify</a>

                                                            <input type="button" class="btn btn-danger btn-sm deleteRecord" value="Delete" data-url="ComplexityParameters_database.php?id=<?php echo $row["ComplexityParameterID"];
                                                                                                                                                                                            if (!isset($_SESSION['DCP'])) {
                                                                                                                                                                                                //User not logged in. Redirect them back to the error page.
                                                                                                                                                                                                header('Location: pages-403.php');
                                                                                                                                                                                                exit;
                                                                                                                                                                                            }

                                                                                                                                                                                            ?>&from=delete">

                                                        </td>
                                                    </tr>
                                                    <?php $iteration = $iteration + 1; ?>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                </fieldset>
            </form>
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

    <?php
    session_start();
    if (isset($_SESSION['msgDelete']) && $_SESSION['msgDelete'] != "") {

        echo '<script type="text/javascript">
                $(document).ready(function() {
                    Swal.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success",
                        confirmButtonColor: "#5156be",
                      });
                });
            </script>';

        unset($_SESSION['msgDelete']);
    }
    ?>
    </body>

    </html>