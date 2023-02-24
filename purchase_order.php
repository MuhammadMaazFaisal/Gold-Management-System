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

    <title>List of Purchase Orders</title>
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
                       
                    <h3>List of Purchase Orders</h3>
                                        <fieldset>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                 <a class="btn btn-primary btn-lg waves-effect waves-light bx bx-add-to-queue" target="_blank" href="manage_po.php">Create New</a> <br><br>
                                <?php
                    
              $i = 1;
                    $sql="SELECT p.*, s.name as supplier FROM `purchase_order_list` p inner join supplier_list s on p.supplier_id = s.id order by p.`date_created` desc";
                    $stmt = $pdo->prepare($sql);
					
                    if($stmt->execute()){
               
                    ?>

<table id="datatable" class="display table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" role="grid">  
                                        <thead>
                                            <tr>
												<th>#</th>
												<th>Date Created</th>
												<th>PO Code</th>
												<th>Supplier</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
                                        </thead>

                                        <tbody>
                                    
      <tr>
                                             
                                              
      <?php while($row = $stmt->fetch()){
		  
             ?>
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo date("Y-m-d H:i",strtotime($row['date_created'])) ?></td>
                                                <td><?php echo $row['po_code'] ?></td>
                                                <td><?php echo $row['supplier'] ?></td>
												<td><?php if($row['status'] == 0): ?>
                                        <span class="btn btn-primary btn-rounded waves-effect waves-light">Pending</span>
                                    <?php elseif($row['status'] == 1): ?>
                                        <span class="btn btn-warning btn-rounded waves-effect waves-light">Partially received</span>
                                        <?php elseif($row['status'] == 2): ?>
                                        <span class="btn btn-success btn-rounded waves-effect waves-light">Received</span>
                                    <?php else: ?>
                                        <span class="btn btn-danger btn-rounded waves-effect waves-light">N/A</span>
                                    <?php endif; ?></td>
                                               
									<td>
                                    
									
									<div class="btn-group" role="group">
                                                    <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Action <i class="mdi mdi-chevron-down"></i>
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
													<?php if($row['status'] == 0): ?>
                                                        <li><a class="dropdown-item" href="<?php echo $row['id'] ?>"  data-id="<?php echo $row['id'] ?>">Receive</a></li>
                                                        <?php endif; ?>
														<li><a class="dropdown-item" href="<?php echo $row['id'] ?>" data-id="<?php echo $row['id'] ?>">View</a></li>
														<li><a class="dropdown-item" href="<?php echo $row['id'] ?>" data-id="<?php echo $row['id'] ?>">Edit</a></li>
														<li><a class="dropdown-item" href="<?php echo $row['id'] ?>" data-id="<?php echo $row['id'] ?>">Delete</a></li>
                                                    </ul>
                                                </div>
									
									</td>
                                              
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