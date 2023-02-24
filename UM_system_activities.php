<?php include 'layouts/session.php'; 

// Include config file
require_once "layouts/config.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(!isset($_SESSION['VSA']))
{
  //User not logged in. Redirect them back to the error page.
  header('Location: pages-403.php');
  exit; 
}

?>
<?php include 'layouts/head-main.php'; ?>

<head>

    <title>System Activities</title>
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
                       
                    <h3>System Activities</h3>
                                        <fieldset>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                 <a class="btn btn-primary btn-lg waves-effect waves-light bx bx-add-to-queue" target="_blank" href="UM_system_activities_add.php">Add System Activity</a> <br><br>
                                <?php
                    
               
                    $sql="SELECT * FROM SystemActivities";
                    $stmt = $pdo->prepare($sql);
                    if($stmt->execute()){
               
                    ?>

<table id="datatable" class="display table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" role="grid">  
                                        <thead>
                                            <tr>
                                            <th>System Activity Name</th>
                                                <th>System Activity Code</th>
                                                <th>System Activity Description</th>
                                               
                                                

                                                <!-- <th>Added By</th> -->
                                                <th>Action</th>
                                            
                                            </tr>
                                        </thead>

                                        <tbody>
                                    
      <tr>
                                             
                                              
      <?php while($row = $stmt->fetch()){
             ?>
                                                <td><?php echo $row["SystemActivityName"]." "; ?></td>
                                                <td><?php echo $row["SystemActivityCode"]; ?></td>
                                                <td><?php echo $row["SystemActivityDescription"]; ?></td>
                                                
                                               
                                                <!-- <td>
                                                <?php      
                                                 if($row["role"]!=""){
                                         $role_ids=$row["role"];
                                         $role_ids_arr = explode(",",$role_ids);
                                        $res="";
                                         foreach($role_ids_arr as $id){
                                            $stmtr=$pdo->prepare("SELECT RoleName FROM Roles WHERE RoleID =$id");
                                            $stmtr->execute();
                                            $rowr = $stmtr->fetch();
                                       
                                         $res.= $rowr["RoleName"].",";

                                      

                                          

                                         }
                                      
                                         echo $res =substr_replace($res, "", -1);

                                       
                                                
                                                
                                       }   ?>
                                                
                                                </td>
                                         -->
                                                    
                                     
                                                <!-- <td><?php echo $row["status"];?></td> -->
                                             
                                                <!-- <td><?php echo $row["added_by"]; ?></td> -->
                                                <td><a  class="btn btn-info btn-sm m-1" href="UM_system_activities_edit.php?id=<?php echo $row["SystemActivityID"]; ?>">Modify</a><a  class="btn btn-danger btn-sm m-1" href="UM_system_activities_delete.php?id=<?php echo $row["SystemActivityID"]; ?>">Delete</a></td>
                                              
                                               
                                            
                                              
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