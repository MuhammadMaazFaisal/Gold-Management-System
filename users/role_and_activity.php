<?php include 'layouts/session.php'; 

// Include config file
require_once "layouts/config.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>
<?php include 'layouts/head-main.php'; ?>

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
                                    <h4 class="page-title mb-0 font-size-18">Roles and Activities</h4>
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
                        <form id="form-horizontal" class="form-horizontal form-wizard-wrapper">
                       
                    <h3>Users</h3>
                                        <fieldset>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                 <a class="btn btn-primary btn-lg waves-effect waves-light bx bxs-user-plus" target="_blank" href="auth-register.php">Add User</a> <br><br>
                                <?php
                    
               
                    $sql="SELECT  u.user_status As status, u.username AS username, u.user_id AS user_id, u.useremail AS email, 
                    GROUP_CONCAT( DISTINCT r.role_id SEPARATOR ',' ) AS role 
                    FROM tbl_user AS u LEFT JOIN tbl_user_role AS r ON u.user_id = r.user_id 
                    GROUP BY u.username
                    ";
                    $stmt = $pdo->prepare($sql);
                    if($stmt->execute()){
               
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
                                             
                                              
      <?php while($row = $stmt->fetch()){
             ?>
                                                <td><?php echo $row["username"]." "; ?></td>
                                               
                                         
                                                <td><?php echo $row["email"]; ?></td>
                                              
                                                <td>
                                                <?php      
                                                 if($row["role"]!=""){
                                         $role_ids=$row["role"];
                                         $role_ids_arr = explode(",",$role_ids);
                                        $res="";
                                         foreach($role_ids_arr as $id){
                                            $stmtr=$pdo->prepare("SELECT role_prev_title FROM tbl_role WHERE role_id =$id");
                                            $stmtr->execute();
                                            $rowr = $stmtr->fetch();
                                       
                                         $res.= $rowr["role_prev_title"].",";

                                      

                                          

                                         }
                                      
                                         echo $res =substr_replace($res, "", -1);

                                       
                                                
                                                
                                       }   ?>
                                                
                                                </td>
                                        
                                                    
                                     
                                                <td><?php echo $row["status"];?></td>
                                             
                                                <!-- <td><?php echo $row["added_by"]; ?></td> -->
                                                <td><a  class="btn btn-warning btn-sm" href="user_edit.php?id=<?php echo $row["user_id"]; ?>">Modify</a></td>
                                              
                                               
                                            
                                              
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
                                                <h3>Roles</h3>
                                        <fieldset>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                <a class="btn btn-primary btn-lg waves-effect waves-light bx bx-add-to-queue" href="auth-add-roles.php">Add Role</a> <br><br>
                                <?php
                    
               
                    $sql="SELECT * FROM  tbl_role";
                    $stmt = $pdo->prepare($sql);
                    if($stmt->execute()){
               
                    ?>

<table id="datatable" class="display table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" role="grid">  
                                        <thead>
                                            <tr>
                                            <th>Role</th>
                                                <th>Description</th>
                                                <th>Status</th>
                                                <th>Added By</th>
                                       
                                            </tr>
                                        </thead>

                                        <tbody>
                                        <?php while($row = $stmt->fetch()){
                                        
                                         
?>
      <tr>
                                             
                                              
                                          
                                                <td><?php echo $row["role_prev_title"]." "; ?></td>
                                                <td><?php echo $row["role_prev_desc"]; ?></td>
                                                <td><?php echo $row["role_prev_status"]; ?></td>
                                                <td><?php echo $row["added_by"]; ?></td>
                                     
                                               
                                            
                                              
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
                                        <h3>Add Activities to Roles</h3>
                                        <fieldset>
                        <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                
                                <?php
                    
               
                    $sql="  SELECT r.added_by, r.role_prev_title AS role_title, r.role_id AS role_id, ra.system_date AS sys_date,
                    GROUP_CONCAT( DISTINCT activity_id SEPARATOR ',' ) AS activity FROM tbl_role AS r LEFT JOIN tbl_role_activity AS ra 
                    ON r.role_id = ra.role_id GROUP BY r.role_id

                    ";
                    $stmt = $pdo->prepare($sql);
                    if($stmt->execute()){

               
                    ?>
                                    
                                    <table id="datatable" class="display table table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <!-- <table id="datatable" class="display table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" role="grid">    -->
                                    <thead>
                                            <tr>
                                        <th>Role </th> 
                                                <th>Activity</th>
                                                <th>Added By</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            
                                            </tr>
                                        </thead>

                                        <tbody>
                                        <?php while($row = $stmt->fetch()){

                                      
                                       
                                       

                                             
                                             
                                         
?>
      <tr>
                                             
                                              
                                          
                                              <td> <?php echo $row["role_title"]; ?> </td>
                                               
                                         
                                                <td><?php      
                                                 if($row["activity"]!=""){
                                         $role_ids=$row["activity"];
                                         $role_ids_arr = explode(",",$role_ids);
                                        $res="";
                                         foreach($role_ids_arr as $id){
                                            $stmtr=$pdo->prepare("SELECT activity_name FROM tbl_activity WHERE activity_id =$id");
                                            $stmtr->execute();
                                            $rowr = $stmtr->fetch();
                                       
                                         $res.= $rowr["activity_name"]." ,";

                                      

                                          

                                         }
                                      $final="";
                                       $res =substr_replace($res, "", -1);
                                     
                                       echo wordwrap($res,50,"<br>\n");
                                                
                                                
                                       }   ?></td>
                                              
                                                <td><?php echo $row["added_by"]; ?></td>
                                                <td><?php echo $row["sys_date"]; ?></td>
                                                <td><a  class="btn btn-warning btn-sm" href="edit_activity.php?id=<?php echo $row["role_id"]; ?>">Modify</a></td>
                                               
                                            
                                              
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
                                                </fieldset>
                    <!-- end row -->
                 
                                                <h3>User-Activity</h3>
                                        <fieldset>
                                        <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                 <!-- <a class="btn btn-primary btn-lg waves-effect waves-light bx bxs-user-plus" href="add_user.php">Add User</a> <br><br> -->
                                <?php
                    
               
                    $sql="SELECT u.added_by AS added_by, u.user_status As status, u.username AS username, u.user_id AS user_id, u.useremail AS email, 
                    GROUP_CONCAT( DISTINCT a.activity_id SEPARATOR ',' ) AS activity 
                    FROM tbl_user AS u LEFT JOIN tbl_user_activity AS a ON u.user_id = a.user_id GROUP BY u.username
                    ";
                    $stmt = $pdo->prepare($sql);
                    if($stmt->execute()){
               
                    ?>

<table id="datatable" class="display table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" role="grid">  
                                        <thead>
                                            <tr>
                                            <th>Name</th>
                                                <th>Email</th>
                                                <th>Activity</th>
                                                <th>Status</th>
                                                <th>Added By</th>
                                                <th>Action</th>
                                            
                                            </tr>
                                        </thead>

                                        <tbody>
                                    
      <tr>
                                             
                                              
      <?php while($row = $stmt->fetch()){
             ?>
                                                <td><?php echo $row["username"]." "; ?></td>
                                               
                                         
                                                <td><?php echo $row["email"]; ?></td>
                                              
                                                <td><?php      
                                                 if($row["activity"]!=""){
                                         $user_ids=$row["activity"];
                                         $user_ids_arr = explode(",",$user_ids);
                                        $res="";
                                         foreach($user_ids_arr as $id){
                                            $stmtr=$pdo->prepare("SELECT activity_name FROM tbl_activity WHERE activity_id =$id");
                                            $stmtr->execute();
                                            $rowr = $stmtr->fetch();
                                       
                                         $res.= $rowr["activity_name"]." ,";

                                      

                                          

                                         }
                                      $final="";
                                       $res =substr_replace($res, "", -1);
                                     
                                       echo wordwrap($res,50,"<br>\n");
                                                
                                                
                                       }   ?></td>
                                        
                                                    
                                     
                                                <td><?php echo $row["status"];?></td>
                                             
                                                <td><?php echo $row["added_by"]; ?></td>
                                                <td><a  class="btn btn-warning btn-sm" href="user_activity_edit.php?id=<?php echo $row["user_id"]; ?>">Modify</a></td>
                                              
                                               
                                            
                                              
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