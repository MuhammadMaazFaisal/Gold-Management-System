<?php

//   $user_id = $_SESSION['user_id'];

//   if(!isset($_SESSION['user_id']))
//   {
//     //User not logged in. Redirect them back to the login page.
//     header('Location: login.php');
//     exit; 
//   }
//   if (isset($_SESSION['RA']))  {
//     if ($_SESSION['RA']=="NO")  {

//         //User not logged in. Redirect them back to the login page.
//         header('Location: security.html');
//         exit;
//     }
//     }
?>


<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->

        <div class="row ">
            <div class="col-lg-8  mx-auto">
                <div class="card">
                    <div class="card-body">


                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Add Role</h4>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        <form class="custom-validation" action="UM_add_role_prev_db.php" method="post" enctype="multipart/form-data">

                            <div class="form-group ">
                                <label>Role Title *</label>
                                <input type="text" name="role_prev_title" class="form-control" required>

                            </div>
                            <div class="form-group ">
                                <label>Role Description *</label>
                                <textarea name="role_prev_desc" class="form-control"></textarea>

                            </div>
                           

                            <br>

                            <div class="form-group mb-0">
                                <div>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                        Submit
                                    </button>
                                    <button type="reset" class="btn btn-secondary waves-effect">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>
        <!-- end row -->
        <!-- End row -->

    