<?php include 'layouts/session.php'; 


// Include config file
require_once "layouts/config.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


?>


<?php include 'layouts/head-main.php'; ?>


<head>
    <title><?php echo $language["Dashboard"]; ?> | Sinomax - Production leads</title>

    <?php include 'layouts/head.php'; ?>

    <link href="assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    
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
	
	
		<?php if (isset($_SESSION['prodp'])) { ?>
							
							
			<div class="page-content">
            <div class="container-fluid">

               
			   <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                           

                        </div>
                    </div>
                </div>
                <!-- end page title -->
					
					
                <div class="row">
                            
						<?php if (isset($_SESSION['counter_widget'])) { ?>	
						<div class="col-xl-3 col-md-6">
                                <!-- card -->
                                <div class="card card-h-100">
                                    <!-- card body -->
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-6">
                                                <span class="text-muted mb-3 lh-1 d-block text-truncate">My Wallet</span>
                                                <h4 class="mb-3">
                                                    $<span class="counter-value" data-target="865.2">0</span>k
                                                </h4>
                                            </div>
        
                                            <div class="col-6">
                                                <div id="mini-chart1" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                            </div>
                                        </div>
                                        <div class="text-nowrap">
                                            <span class="badge bg-soft-success text-success">+$20.9k</span>
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
                                            <div class="col-6">
                                                <span class="text-muted mb-3 lh-1 d-block text-truncate">Number of Trades</span>
                                                <h4 class="mb-3">
                                                    <span class="counter-value" data-target="6258">0</span>
                                                </h4>
                                            </div>
                                            <div class="col-6">
                                                <div id="mini-chart2" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                            </div>
                                        </div>
                                        <div class="text-nowrap">
                                            <span class="badge bg-soft-danger text-danger">-29 Trades</span>
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
                                            <div class="col-6">
                                                <span class="text-muted mb-3 lh-1 d-block text-truncate">Invested Amount</span>
                                                <h4 class="mb-3">
                                                    $<span class="counter-value" data-target="4.32">0</span>M
                                                </h4>
                                            </div>
                                            <div class="col-6">
                                                <div id="mini-chart3" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                            </div>
                                        </div>
                                        <div class="text-nowrap">
                                            <span class="badge bg-soft-success text-success">+ $2.8k</span>
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
                                            <div class="col-6">
                                                <span class="text-muted mb-3 lh-1 d-block text-truncate">Profit Ration</span>
                                                <h4 class="mb-3">
                                                    <span class="counter-value" data-target="12.57">0</span>%
                                                </h4>
                                            </div>
                                            <div class="col-6">
                                                <div id="mini-chart4" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                            </div>
                                        </div>
                                        <div class="text-nowrap">
                                            <span class="badge bg-soft-success text-success">+2.95%</span>
                                            <span class="ms-1 text-muted font-size-13">Since last week</span>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div><!-- end col -->    
                
				<?php } // Super Admin 
												?>
				
				</div><!-- end row-->

                       

                 

                        <div class="row">
                            
							<div class="col-xl-9">
                               <?php if (isset($_SESSION['SCHEDULE_set'])) { ?> 
							   <h3>SCHEDUL SET</h3>
								<div class="card">
								 
								<div class="card-header align-items-center d-flex">
                                       
									   		<div class="form-group mb-0" style="width: 100%; margin-right: 1%;">
                                                     <form class="custom-validation" action="schedule_set_db.php" method="post" enctype="multipart/form-data">
													 <input class="form-control" name="Product_name" list="datalistOptions" id="exampleDataList" placeholder="Product Name...">
                                                    </div>
													<div class="form-group mb-0" style="width: 100%; margin-right: 1%;">
                                                    <input class="form-control" name="target_no" list="datalistOptions" id="exampleDataList" placeholder="Target Nuber...">
                                                    </div>
													<div class="form-group mb-0" style="width: 10%; margin-right: 1%;">
                                                  <button type="submit" class="btn btn-outline-success waves-effect waves-light">SUBMIT</button>
                                                    </div>
													</form>
													
                                        <div class="flex-shrink-0">
                                           
											 
                                        </div>
                                    </div><!-- end card header -->

                                   
                                    <!-- end card body -->
                                </div>
								
								<?php } // Super Admin 
												?>
								
								
								
								
								
								
								
								<?php if (isset($_SESSION['lead_form'])) { ?>
								
								<div class="card">
                                    <div class="card-header align-items-center d-flex">
                                       
									   <div class="form-group mb-0" style="width: 20%;margin-right: 1%;">
                                                     <input class="form-control" type="text" name="date" value="10/15/2022" disabled> 
                                                    </div>
												<div class="form-group mb-0" style="width: 20%; margin-right: 1%;">
                                                     <select class="form-select" name="shift_name" disabled>
                                                            <option value="1">FIRST SHIFT</option>
                                                            <option value="2">SECOND SHIFT</option>
															<option value="3">THIRD SHIFT</option>
															<option>SELECT SHIFT</option>
                                                        </select>
                                                    </div>
													<div class="form-group mb-0" style="width: 20%; margin-right: 1%;">
                                                     <select class="form-select" name="ees" disabled>
                                                            
                                                            <option value="11">11</option>
                                                            <option value="12">13</option>
															<option value="15">15</option>
															<option value="16">16</option>
															<option>SELECT EEs</option>
                                                        </select>
                                                    </div>
													<div class="form-group mb-0" style="width: 20%; margin-right: 1%;">
                                                      <select class="form-select" name="lines" disabled>
                                                            
                                                            <option value="M-1">M 1</option>
															<option value="M-2">M 2</option>
															<option value="M-3">M 3</option>
															<option value="M-4">M 4</option>
															<option value="M-5">M 5</option>
															<option value="M-6">M 6</option>
                                                            <option value="P-1">P 1</option>
															<option value="P-2">P 2</option>
															<option value="P-3">P 3</option>
															<option value="P-4">P 4</option>
															<option value="P-5">P 5</option>
															<option value="P-6">P 6</option>
															<option>SELECT LINE</option>
															
                                                        </select>
                                                    </div>
													<div class="form-group mb-0" style="width: 20%; margin-right: 1%;margin-right: 1%;">
                                                     <input class="form-control" type="text" placeholder="LEAD" disabled> 
                                                    </div>
                                        <div class="flex-shrink-0">
                                           
											 
                                        </div>
                                    </div><!-- end card header -->

                                    <div class="card">
                                       <div class="card-header align-items-center d-flex">
											 
											   <div class="form-group mb-0" style="width: 14%;margin-right: 1%;">
                                                     <input class="form-control" type="text" name="time" placeholder="6-7-AM" disabled> 
                                                    </div>
													  <div class="form-group mb-0" style="width: 18%;margin-right: 1%;">
                                                     <input class="form-control" type="text" name="date" placeholder="EZ TOTE" disabled> 
                                                    </div>
													  <div class="form-group mb-0" style="width: 8%;margin-right: 1%;">
                                                     <input class="form-control" type="text" name="date" placeholder="K" disabled> 
                                                    </div>
													  <div class="form-group mb-0" style="width: 11%;margin-right: 1%;">
                                                     <input class="form-control" type="text" name="date" placeholder="60" disabled> 
                                                    </div>
													  <div class="form-group mb-0" style="width: 13%;margin-right: 1%;">
                                                     <input class="form-control" type="text" name="date" placeholder="49" disabled> 
                                                    </div>
													  <div class="form-group mb-0" style="width: 18%;margin-right: 1%;">
                                                     <input class="form-control" type="text" name="date" placeholder="49" disabled> 
                                                    </div>
													  <div class="form-group mb-0" style="width: 12%;margin-right: 1%;">
                                                     <input class="form-control" type="text" name="date" placeholder="11" disabled> 
                                                    </div>
													<div class="form-group mb-0" style="width: 14%;margin-right: 1%;">
                                                     <input class="form-control" type="text" name="date" placeholder="% 88.1%" disabled> 
                                                    </div>
												 <div class="form-group mb-0" style="width: 12%;margin-right: 1%;">
														 <input class="form-control" type="text" name="date" placeholder="10" disabled> 
														</div>
														<div class="form-group mb-0" style="width: 12%;margin-right: 1%;">
														 <input class="form-control" type="text" name="date" placeholder="1" disabled> 
														</div>
											 
											 </div>
                                           
                                                
                                            
											 <div class="card-header align-items-center d-flex">
											 
											   <div class="form-group mb-0" style="width: 14%;margin-right: 1%;">
                                                     <input class="form-control" type="text" name="time" placeholder="Time"> 
                                                    </div>
													  <div class="form-group mb-0" style="width: 18%;margin-right: 1%;">
                                                     <input class="form-control" type="text" name="date" placeholder="Product Name"> 
                                                    </div>
													  <div class="form-group mb-0" style="width: 8%;margin-right: 1%;">
                                                     <input class="form-control" type="text" name="date" placeholder="Size"> 
                                                    </div>
													  <div class="form-group mb-0" style="width: 11%;margin-right: 1%;">
                                                     <input class="form-control" type="text" name="date" placeholder="Target"> 
                                                    </div>
													  <div class="form-group mb-0" style="width: 13%;margin-right: 1%;">
                                                     <input class="form-control" type="text" name="date" placeholder="Running"> 
                                                    </div>
													  <div class="form-group mb-0" style="width: 18%;margin-right: 1%;">
                                                     <input class="form-control" type="text" name="date" placeholder="Running Total"> 
                                                    </div>
													  <div class="form-group mb-0" style="width: 12%;margin-right: 1%;">
                                                     <input class="form-control" type="text" name="date" placeholder="Balance"> 
                                                    </div>
													<div class="form-group mb-0" style="width: 14%;margin-right: 1%;">
                                                     <input class="form-control" type="text" name="date" placeholder="% Achieved"> 
                                                    </div>
												 <div class="form-group mb-0" style="width: 12%;margin-right: 1%;">
														 <input class="form-control" type="text" name="date" placeholder="D/Time"> 
														</div>
														<div class="form-group mb-0" style="width: 12%;margin-right: 1%;">
														 <input class="form-control" type="text" name="date" placeholder="D/Code"> 
														</div>
											 
											 </div>
											 <div class="card-header align-items-center d-flex">
											 
											   <div class="form-group mb-0" style="width: 14%;margin-right: 1%;">
                                                     <input class="form-control" type="text" name="time" placeholder="Time"> 
                                                    </div>
													  <div class="form-group mb-0" style="width: 18%;margin-right: 1%;">
                                                     <input class="form-control" type="text" name="date" placeholder="Product Name"> 
                                                    </div>
													  <div class="form-group mb-0" style="width: 8%;margin-right: 1%;">
                                                     <input class="form-control" type="text" name="date" placeholder="Size"> 
                                                    </div>
													  <div class="form-group mb-0" style="width: 11%;margin-right: 1%;">
                                                     <input class="form-control" type="text" name="date" placeholder="Target"> 
                                                    </div>
													  <div class="form-group mb-0" style="width: 13%;margin-right: 1%;">
                                                     <input class="form-control" type="text" name="date" placeholder="Running"> 
                                                    </div>
													  <div class="form-group mb-0" style="width: 18%;margin-right: 1%;">
                                                     <input class="form-control" type="text" name="date" placeholder="Running Total"> 
                                                    </div>
													  <div class="form-group mb-0" style="width: 12%;margin-right: 1%;">
                                                     <input class="form-control" type="text" name="date" placeholder="Balance"> 
                                                    </div>
													<div class="form-group mb-0" style="width: 14%;margin-right: 1%;">
                                                     <input class="form-control" type="text" name="date" placeholder="% Achieved"> 
                                                    </div>
												 <div class="form-group mb-0" style="width: 12%;margin-right: 1%;">
														 <input class="form-control" type="text" name="date" placeholder="D/Time"> 
														</div>
														<div class="form-group mb-0" style="width: 12%;margin-right: 1%;">
														 <input class="form-control" type="text" name="date" placeholder="D/Code"> 
														</div>
											 
											 </div>
											  
											  
                                                     
                                                    <div class="text-center" >
                                                        <button type="button" class="btn btn-outline-dark waves-effect waves-light">SEND</button> <button type="button" class="btn btn-outline-info waves-effect waves-light">SAVE</button> <button type="button" class="btn btn-outline-success waves-effect waves-light">SUBMIT</button>
                                                    </div>
                                               
                                           
                                            <!-- end tab pane -->
                                            
                                            <!-- end tab pane -->
                                       
                                        <!-- end tab content -->
                                    </div>
                                    <!-- end card body -->
                                </div>
					
					
					
								<?php } // Super Admin 
												?>
								
								
								
							
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                            
                            <div class="col-xl-3">
                                
								<?php if (isset($_SESSION['status_panel'])) { ?>
									
								<div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">STATUS</h4>
                                        <div class="flex-shrink-0">
                                            <i class="mdi mdi-circle text-success align-middle font-size-10 ms-1"></i><i class="mdi mdi-circle text-danger align-middle font-size-10 ms-1"></i>
                                        </div>
                                    </div><!-- end card header -->

                                    <div class="card-body px-0">
									
                                        <div class="px-3" data-simplebar style="max-height: 352px;">
                                             <table class="table table-sm m-0">
                                            <thead>
                                                <tr>
                                                    <th>LINE</th>
                                                    <th>RUNNING</th>
                                                    <th>PROJECTED</th>
                                                    <th>U/D</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row">M1</th>
                                                    <td>22</td>
                                                    <td>450</td>
                                                    <td><i class="mdi mdi-circle text-success align-middle font-size-10 ms-1"></i>
													
													</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">M6</th>
                                                    <td>169</td>
                                                    <td>359</td>
                                                    <td><i class="mdi mdi-circle text-success align-middle font-size-10 ms-1"></i></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">TOOPERS</th>
                                                    <td>1800</td>
                                                    <td>4500</td>
                                                    <td><i class="mdi mdi-circle text-success align-middle font-size-10 ms-1"></i></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">CLUSTER</th>
                                                    <td>2450</td>
                                                    <td>4500</td>
                                                    <td><i class="mdi mdi-circle text-danger align-middle font-size-10 ms-1"></i></td>
                                                </tr>
												<tr>
                                                    <th scope="row">M2</th>
                                                    <td>169</td>
                                                    <td>359</td>
                                                    <td><i class="mdi mdi-circle text-success align-middle font-size-10 ms-1"></i></td>
                                                </tr>
												<tr>
                                                    <th scope="row">P1</th>
                                                    <td>22</td>
                                                    <td>450</td>
                                                    <td><i class="mdi mdi-circle text-success align-middle font-size-10 ms-1"></i></td>
                                                </tr>
                                            </tbody>
                                        </table>
										<br/>
										
                                    <h4 class="card-title mb-0 flex-grow-1">TODAY'S TOTAL</h4>
									<table class="table table-sm m-0">

                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>TOOPERS</td>
                                                    <td>3500</td>
                                                    <td>100%</td>
                                                </tr>
                                                <tr>
                                                    <td>LAMINATIONS</td>
                                                    <td>600</td>
                                                    <td>100%</td>
                                                </tr>
                                                <tr>
                                                    <td>CLUSTER P</td>
                                                    <td>4500</td>
                                                    <td>95%</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                   
										
										
											
                                        </div>    
                                    </div>
                                    <!-- end card body -->
									
                                </div>
								
								
									<?php } // Super Admin 
									?>
								
								
								
								
								
								
								<?php if (isset($_SESSION['AB_CD_EE_SCHEDU'])) { ?>
									
									<div class="card">
                                 <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">AB/CD/EEE SCHEDULE</h4>
										
                                        <div class="flex-shrink-0">
                                            <i class="text-success align-middle  spinner-grow text-warning m-1 waves-effect waves-light"></i>
                                        </div>
                                    </div><!-- end card header -->
									
									
                                <div class="card-body">
                                    <div class="table-responsive">
                                        
										<?php
                                    $sql = "SELECT * FROM  sechedule_set";
                                    $stmt = $pdo->prepare($sql);
                                    if ($stmt->execute()) {  ?>
									
										<table class="table table-hover mb-0">

                                            <thead>
                                               
                                            </thead>
                                            <tbody>
                                                <?php while ($row = $stmt->fetch()) { ?>
                                                    <tr>
                                                        <td><?php echo $row["Product_name"] . " "; ?></td>
                                                        <td><span class="badge rounded-pill bg-warning"><?php echo $row["target_no"]; ?></span></td>
                                                        
                                                    </tr>
                                                <?php } ?>
												
												<?php
										$sqlsum = "SELECT SUM(`target_no`) as sum FROM sechedule_set;";
										$stmtsum = $pdo->prepare($sqlsum);
										if ($stmtsum->execute()) {  ?>
												 <?php while ($rowsum = $stmtsum->fetch()) { ?>
												<tr>
                                                        <td>SUM</td>
                                                        <td><span class="badge rounded-pill bg-success"><?php echo $rowsum["sum"]; ?></span></td>
                                                        
                                                    </tr>
											 <?php } ?>

											  <?php } ?>
												
												
                                            </tbody>
                                        </table>
										 <?php } ?>
										<br/>
										<div class="alert alert-info alert-dismissible alert-outline fade show mb-0" role="alert">
                                     HOURLY TARGET: <strong>60</strong> MIBs
                                    
                                </div>
                                    </div>
                                </div>
                                <!-- end card body -->
                            </div>
                                <!-- end card -->
		
							<?php } // Super Admin 
									?>
		
								
							
								
								
                            </div>
							
                            <!-- end col -->
                        </div>
                <!-- end row -->
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
							
							
						   <?php } // Super Admin 
                ?>	
					
	
	
        

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

<!-- apexcharts -->
<script src="assets/libs/apexcharts/apexcharts.min.js"></script>

<!-- Plugins js-->
<script src="assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js"></script>

<!-- dashboard init -->
<script src="assets/js/pages/dashboard.init.js"></script>

<!-- App js -->
<script src="assets/js/app.js"></script>

</body>

</html>