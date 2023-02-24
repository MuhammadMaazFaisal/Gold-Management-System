<?php
// Initialize the session
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check if the user is already logged in, if yes then redirect him to index page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: index");
    exit;
}
// Include config file
require_once "layouts/config.php";

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if username is empty
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter username.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if (empty($username_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = "SELECT UserID, UserName, Password FROM Users WHERE UserName = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password)) {
                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
 // COde FOr Session of User - Activities

 $USA = "SELECT SystemActivityCode, UserSystemActivities.SystemActivityID FROM SystemActivities,UserSystemActivities 
 WHERE UserSystemActivities.SystemActivityID = SystemActivities.SystemActivityID and UserID=:id";
     $USA = $pdo->prepare($USA);
     $USA->bindParam(":id", $id);
     $USA->execute();
     $USA_session = $USA->fetchAll();

     foreach ($USA_session as $rsa) {
         $rsaname = $rsa["SystemActivityCode"];
         $_SESSION[$rsaname] = $rsaname;
     }

     // COde FOr Session of User - Processing Stages

     $UPS = "SELECT ProcessingStageCode, UserProcessingStages.ProcessingStageID FROM ProcessingStages,UserProcessingStages 
 WHERE UserProcessingStages.ProcessingStageID = ProcessingStages.ProcessingStageID and UserID=:id";
     $UPS = $pdo->prepare($UPS);
     $UPS->bindParam(":id", $id);
     $UPS->execute();
     $UPS_session = $UPS->fetchAll();

     foreach ($UPS_session as $RPS) {
         $RPSname = $RPS["ProcessingStageCode"];
         $RPSid = $RPS["ProcessingStageID"];
         $_SESSION["ProcessingStage"] = $RPSid;
         $_SESSION[$RPSname] = $RPSid;
     }

                            // COde FOr Session of User - Roles
                            $roles = "SELECT RoleName, UserRoles.RoleID FROM Roles,UserRoles WHERE UserRoles.RoleID = Roles.RoleID and UserID=:id";
                            $roles = $pdo->prepare($roles);
                            $roles->bindParam(":id", $id);
                            $roles->execute();
                            $roles_session = $roles->fetchAll();

                            foreach ($roles_session as $role) {
                                $rolename = $role["RoleName"];
                                $roleid = $role["RoleID"];

                                $_SESSION[$rolename] = $rolename;
                                $_SESSION["role"] = $rolename;

                                // COde FOr Session of Role - Activities

                                $RSA = "SELECT SystemActivityCode, RoleSystemActivities.SystemActivityID FROM SystemActivities,RoleSystemActivities 
                            WHERE RoleSystemActivities.SystemActivityID = SystemActivities.SystemActivityID and RoleID=:id";
                                $RSA = $pdo->prepare($RSA);
                                $RSA->bindParam(":id", $roleid);
                                $RSA->execute();
                                $RSA_session = $RSA->fetchAll();

                                foreach ($RSA_session as $rsa) {
                                    $rsaname = $rsa["SystemActivityCode"];
                                    $_SESSION[$rsaname] = $rsaname;
                                }

                                // COde FOr Session of Role - Processing Stages

                                $RPS = "SELECT ProcessingStageCode, RoleProcessingStages.ProcessingStageID FROM ProcessingStages,RoleProcessingStages 
                            WHERE RoleProcessingStages.ProcessingStageID = ProcessingStages.ProcessingStageID and RoleID=:id";
                                $RPS = $pdo->prepare($RPS);
                                $RPS->bindParam(":id", $roleid);
                                $RPS->execute();
                                $RPS_session = $RPS->fetchAll();

                                foreach ($RPS_session as $RPS) {
                                    $RPSname = $RPS["ProcessingStageCode"];
                                    $RPSid = $RPS["ProcessingStageID"];
                                    $_SESSION["ProcessingStage"] = $RPSid;
                                    $_SESSION[$RPSname] = $RPSid;
                                }
                            }




                            // Redirect user to welcome page
                            header("location: index.php");
                        } else {
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else {
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($link);
}
?>
<?php include 'layouts/head-main.php'; ?>

<head>

    <title>Login |</title>
    <?php include 'layouts/head.php'; ?>

    <?php include 'layouts/head-style.php'; ?>

</head>

<?php include 'layouts/body.php'; ?>
<div class="auth-page">
    <div class="container-fluid p-0">
        <div class="row g-0">
            <div class="col-xxl-3 col-lg-4 col-md-5">
                <div class="auth-full-page-content d-flex p-sm-5 p-4">
                    <div class="w-100">
                        <div class="d-flex flex-column h-100">
                            <div class="mb-4 mb-md-5 text-center">
                                <a href="index.php" class="d-block auth-logo">
                                    <!-- <img src="assets/images/logo.png" alt="">-->
                                </a>
                            </div>
                            <div class="auth-content my-auto">
                                <div class="text-center">
                                    <p class="text-muted mt-2">Sign in to continue.</p>
                                </div>
                                <form class="custom-form mt-4 pt-2" action="auth-login.php" method="post">
                                    <div class="mb-3 <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                                        <label class="form-label" for="username">Username</label>
                                        <input type="text" class="form-control" id="username" placeholder="Enter username" name="username">
                                        <span class="text-danger"><?php echo $username_err; ?></span>
                                    </div>
                                    <div class="mb-3 <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                                        <div class="d-flex align-items-start">
                                            <div class="flex-grow-1">
                                                <label class="form-label" for="password">Password</label>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <div class="">
                                                    <a href="auth-recoverpw.php" class="text-muted">Forgot password?</a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="input-group auth-pass-inputgroup">
                                            <input type="password" class="form-control" placeholder="Enter password" name="password" aria-label="Password" aria-describedby="password-addon">
                                            <span class="text-danger"><?php echo $password_err; ?></span>
                                            <button class="btn btn-light ms-0" type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col">
                                            <!-- <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="remember-check">
                                                <label class="form-check-label" for="remember-check">
                                                    Remember me
                                                </label>
                                            </div> -->
                                        </div>

                                    </div>
                                    <div class="mb-3">
                                        <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Log In</button>
                                    </div>
                                </form>

                                <div class="mt-4 pt-2 text-center">
                                    <!-- <div class="signin-other-title">
                                        <h5 class="font-size-14 mb-3 text-muted fw-medium">- Sign in with -</h5>
                                    </div>

                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item">
                                            <a href="javascript:void()" class="social-list-item bg-primary text-white border-primary">
                                                <i class="mdi mdi-facebook"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="javascript:void()" class="social-list-item bg-info text-white border-info">
                                                <i class="mdi mdi-twitter"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="javascript:void()" class="social-list-item bg-danger text-white border-danger">
                                                <i class="mdi mdi-google"></i>
                                            </a>
                                        </li>
                                    </ul> -->
                                </div>

                                <div class="mt-5 text-center">
                                    <!-- <p class="text-muted mb-0">Don't have an account ? <a href="auth-register.php" class="text-primary fw-semibold"> Signup now </a> </p> -->
                                </div>
                            </div>
                            <div class="mt-4 mt-md-5 text-center">
                                <p class="mb-0">© <script>
                                        document.write(new Date().getFullYear())
                                    </script> <!--Esolace Tech--></p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end auth full page content -->
            </div>
            <!-- end col -->
            <div class="col-xxl-9 col-lg-8 col-md-7">
                <div class="auth-bg pt-md-5 p-4 d-flex">
                    <div class="bg-overlay bg-primary"></div>
                    <ul class="bg-bubbles">
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                    <!-- end bubble effect -->
                    <div class="row justify-content-center align-items-center">
                        <div class="col-xl-7">
                            <div class="p-0 p-sm-4 px-xl-0">
                                <div id="reviewcarouselIndicators" class="carousel slide" data-bs-ride="carousel">
                                    
                                    <!-- end carouselIndicators -->
                                   
                                    <!-- end carousel-inner -->
                                </div>
                                <!-- end review carousel -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container fluid -->
</div>


<!-- JAVASCRIPT -->

<?php include 'layouts/vendor-scripts.php'; ?>
<!-- password addon init -->
<script src="assets/js/pages/pass-addon.init.js"></script>

</body>

</html>