<?php include 'layouts/session.php';

// Include config file
require_once "layouts/config.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if(!isset($_SESSION['VU']))
{
  //User not logged in. Redirect them back to the error page.
  header('Location: pages-403.php');
  exit; 
}
?>
<?php include 'layouts/head-main.php'; ?>

<head>

    <title>Manage Users</title>
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


            <!-- Start row -->
            <form id="form-horizontal" class="form-horizontal form-wizard-wrapper">

                <h3>Users</h3>
                <fieldset>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <a class="btn btn-primary btn-lg waves-effect waves-light bx bxs-user-plus" target="_blank" href="UM_auth-register.php">Add User</a> <br><br>
                                    <?php


                                    $sql = "SELECT  u.UserStatus As status, u.UserName AS username, u.UserID AS user_id, u.UserEmail AS email, 
                    GROUP_CONCAT( DISTINCT r.RoleID SEPARATOR ',' ) AS role 
                    FROM Users AS u LEFT JOIN UserRoles AS r ON u.UserID = r.UserID 
                    GROUP BY u.UserID
                    ";
                                    $stmt = $pdo->prepare($sql);
                                    if ($stmt->execute()) {

                                    ?>

                                        <table id="datatable" class="display table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" role="grid">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Role</th>
                                                    <th>Status</th>
                                                    <!-- <th>Added By</th> -->
                                                    <th>Action</th>

                                                </tr>
                                            </thead>

                                            <tbody>

                                                <tr>


                                                    <?php while ($row = $stmt->fetch()) {
                                                    ?>
                                                        <td><?php echo $row["username"] . " "; ?></td>


                                                        <td><?php echo $row["email"]; ?></td>

                                                        <td>
                                                            <?php
                                                            if ($row["role"] != "") {
                                                                $role_ids = $row["role"];
                                                                $role_ids_arr = explode(",", $role_ids);
                                                                $res = "";
                                                                foreach ($role_ids_arr as $id) {
                                                                    $stmtr = $pdo->prepare("SELECT RoleName FROM Roles WHERE RoleID =$id");
                                                                    $stmtr->execute();
                                                                    $rowr = $stmtr->fetch();

                                                                    $res .= $rowr["RoleName"] . ",";
                                                                }

                                                                echo $res = substr_replace($res, "", -1);
                                                            }   ?>

                                                        </td>



                                                        <td><?php echo $row["status"]; ?></td>

                                                        <!-- <td><?php echo $row["added_by"]; ?></td> -->
                                                        <td><a class="btn btn-info btn-sm" href="user_edit.php?id=<?php echo $row["user_id"]; ?>">Modify</a></td>




                                                </tr>



                                            <?php } ?>

                                            </tbody>
                                        </table>
                                </div>
                            <?php } ?>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                </fieldset>

                <h3>User-Activity</h3>
                <fieldset>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <?php
                                    $sql = "SELECT u.AddedBy AS added_by, u.UserStatus As status, u.UserName AS username, u.UserID AS user_id, u.UserEmail AS email, 
                    GROUP_CONCAT( DISTINCT a.SystemActivityID SEPARATOR ',' ) AS activity 
                    FROM Users AS u LEFT JOIN UserSystemActivities AS a ON u.UserID = a.UserID GROUP BY u.UserID
                    ";
                                    $stmt = $pdo->prepare($sql);
                                    if ($stmt->execute()) {

                                    ?>
                                        <table id="datatable" class="display table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" role="grid">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Activity</th>
                                                    <th>Status</th>
                                                    
                                                    <th>Action</th>

                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr> <?php while ($row = $stmt->fetch()) { ?>
                                                        <td><?php echo $row["username"] . " "; ?></td>
                                                        <td><?php echo $row["email"]; ?></td>
                                                        <td><?php
                                                            if ($row["activity"] != "") {
                                                                $user_ids = $row["activity"];
                                                                $user_ids_arr = explode(",", $user_ids);
                                                                $res = "";
                                                                foreach ($user_ids_arr as $id) {
                                                                    $stmtr = $pdo->prepare("SELECT SystemActivityName FROM SystemActivities WHERE SystemActivityID =$id");
                                                                    $stmtr->execute();
                                                                    $rowr = $stmtr->fetch();

                                                                    $res .= $rowr["SystemActivityName"] . " ,";
                                                                }
                                                                $final = "";
                                                                $res = substr_replace($res, "", -1);

                                                                echo wordwrap($res, 50, "<br>\n");
                                                            }   ?></td>

                                                        <td><?php echo $row["status"]; ?></td>
                                                        
                                                        <td><a class="btn btn-info btn-sm" href="user_activity_edit.php?id=<?php echo $row["user_id"]; ?>">Modify</a></td>
                                                </tr>
                                            <?php } ?>

                                            </tbody>
                                        </table>
                                </div>
                            <?php } ?>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->

                </fieldset>

                <!-- end yaha row -->

               

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