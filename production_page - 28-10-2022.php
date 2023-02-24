<?php include 'layouts/session.php'; 


// Include config file
require_once "layouts/config.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


?>


<?php include 'layouts/head-main.php'; ?>


<head>
    <title><?php echo $language["Dashboard"]; ?>Production</title>

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
                            
							<div class="col-xl-12">
                               
								<?php if (isset($_SESSION['manufacturing_d'])) { ?>
								 <div class="row">
									<div class="col-lg-12">
										<div class="card ">
											<div class="card-header card border border-danger">
												<h4 class="card-title">
													MANUFACTURING DEPARTMENT
												</h4>
												
											</div>
											<div class="card-body p-4 ">
												
												<div class="row">
												
													<div class="col-lg-12 ms-lg-auto ">
														<div class="mt-4 mt-lg-0">
													   
															
															<form action="" method="POST" enctype="multipart/form-data">
															   
																<div class="row mb-4">
																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Name:</label>
																	<div class="col-sm-5">
																	  
																	  <input type="text" name="name" class="form-control" placeholder="Name">
																	</div>
																		  
															   
																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Bar Code:</label>
																	
																	<div class="col-sm-5">
																	   
																		<h6>code</h6>
																		<input type="hidden" name="sku" class="form-control" placeholder="Barcode" value="{{$randomNumber}}">
																	
																	</div>
																</div> 
																<div class="row mb-4">
																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Date:</label>
																	<div class="col-sm-5">
																	  
																	  <input type="date" name="date" class="form-control" placeholder="Name">
																	</div>
																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Image Upload:</label>
																	<div class="col-sm-5">
																	  
																	  <input type="file" name="image" class="form-control" placeholder="Name">
																	</div>
																</div> 
																<div class="row mb-4">
																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Details:</label>
																	<div class="col-sm-11">
																	  
																	  <textarea type="text" name="detail" class="form-control" style="height: 107px;" placeholder="Details"></textarea>
																	</div>
																</div> 
																<div class="row mb-4">
																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Type:</label>
																	<div class="col-sm-3">
																	  
																		<select required="" name="type" class="form-control form-select">
																			<option value="">Select Type</option>
																			<option value="wr">Writing</option>
																			<option value="ph">Photography</option>
																			<option value="cy">Cycling</option>
																		</select>
																	</div>
																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label">QTY:</label>
																	<div class="col-sm-3">
																	  
																	  <input type="text" name="qty" class="form-control" placeholder="QTY">
																	</div>
																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Purity:</label>
																	<div class="col-sm-3">
																	  
																	  <input type="text" name="purity" class="form-control" placeholder="Purity">
																	</div>
																</div>   
																<div class="row mb-4">
																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Unpolish Weight:</label>
																	<div class="col-sm-3">
																	  
																		<input type="text" name="unpolish_weight" class="form-control" placeholder="Unpolish Weight">
																	</div>
																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Polish Weight:</label>
																	<div class="col-sm-3">
																	  
																	  <input type="text" name="polish_weight" class="form-control" placeholder="Unpolish Weight">
																	</div>
																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Rate:</label>
																	<div class="col-sm-3">
																	  
																	  <input type="text" name="rate" class="form-control" placeholder="Rate">
																	</div>
																</div> 

																<div class="row mb-4">
																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Wastage:</label>
																	<div class="col-sm-3">
																	  
																		<input type="text" name="wastage" class="form-control" placeholder="Wastage">
																	</div>
																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Unpure Weight:</label>
																	<div class="col-sm-3">
																	  
																	  <input type="text" name="unpure_weight" class="form-control" placeholder="Unpure Weight">
																	</div>
																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Pure Weight:</label>
																	<div class="col-sm-3">
																	  
																	  <input type="text" name="pure_weight" class="form-control" placeholder="Pure Weight">
																	</div>
																</div> 
									

																<div class="row justify-content-end">
																	<div class="col-sm-9">
																	   
																		<div>
																			<a href="" class="btn btn-success waves-effect waves-light">Print</a>
																			<button type="submit" class="btn btn-primary">Save</button>
																		</div>
																	</div>
																</div>
															</form>
														</div>
													</div>
												</div>


												

											

											   
											</div>
										</div>
									</div>
								</div>
            <!-- End Form Layout -->
					
					
								<?php } // Super Admin 
												?>
								
								
								
							
                                <!-- end card -->
                            </div>
                            <!-- end col -->
							
			<!--2 -->
							<div class="col-xl-12">
										<?php if (isset($_SESSION['Polisher_panel'])) { ?>
									
								
									<div class="row">
									<div class="col-lg-12">
										<div class="card ">
										 <div class="card-header card border border-success">
												<h4 class="card-title">
													POLISHER
												</h4>
												
											</div>
											<div class="card-body p-4 ">
												
												<div class="row">
												
													<div class="col-lg-12 ms-lg-auto ">
														<div class="mt-4 mt-lg-0">
													   
															
															<form action="" method="POST">
															   
																<div class="row mb-4">
																   
																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Date:</label>
																	<div class="col-sm-5">
																	  
																	  <input type="date" name="date" class="form-control" placeholder="Date">
																	</div>
																   
																   
																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Bar Code:</label>
																	<div class="col-sm-5">
																		
																	
																	<img alt='testing' src='barcode/barcode.php?codetype=Code39&size=40&text=".100101111110000000000."&print=true'/>
																	<h6>code</h6>
																	  <input type="hidden" name="pbarcode" class="form-control" placeholder="Barcode" value="">
																	</div>
																</div> 
																<div class="row mb-4">
																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Name:</label>
																	<div class="col-sm-5">
																	  
																		<select required="" name="name"class="form-control form-select">
																			<option value="">Select Name</option>
																			<option value="wr">Muhammad Faisal</option>
																			<option value="ph">Shoaib</option>
																			<option value="cy">Ali</option>
																		</select>
																	</div>
																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Image Upload:</label>
																	<div class="col-sm-5">
																	  
																	  <input type="file" name="imgupload" class="form-control" placeholder="Name">
																	</div>
																</div> 
																<div class="row mb-4">
																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Details:</label>
																	<div class="col-sm-11">
																	  
																	  <textarea type="text" name="detail" class="form-control" style="height: 107px;" placeholder="Details"></textarea>
																	</div>
																</div> 
																
																<div class="row mb-4">
																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Unpolish Weight:</label>
																	<div class="col-sm-3">
																	  
																		<input type="text" name="unpolish_weight" class="form-control" placeholder="Unpolish Weight">
																	</div>
																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Polish Weight:</label>
																	<div class="col-sm-3">
																	  
																	  <input type="text" name="polish_weight" class="form-control" placeholder="Unpolish Weight">
																	</div>
																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Rate:</label>
																	<div class="col-sm-3">
																	  
																	  <input type="text" name="rate" class="form-control" placeholder="Rate">
																	</div>
																</div> 

																<div class="row mb-4">
																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Wastage:</label>
																	<div class="col-sm-3">
																	  
																		<input type="text" name="wastage" class="form-control" placeholder="Wastage">
																	</div>
																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Difference:</label>
																	<div class="col-sm-3">
																	  
																	  <input type="text" name="difference" class="form-control" placeholder="Difference">
																	</div>
																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label">=</label>
																	<div class="col-sm-3">
																	  
																	  <input type="text" name="pure Weight" class="form-control card bg-dark border-dark text-light" placeholder="Payable / Receivable">
																	</div>
																</div> 
									

																<div class="row justify-content-end">
																	<div class="col-sm-9">
																	   
																		<div>
																			<button type="" class="btn btn-success waves-effect waves-light">Print</button>
																			<button type="submit" class="btn btn-primary">Save</button>
																		</div>
																	</div>
																</div>
															</form>
														</div>
													</div>
												</div>


												

											

											   
											</div>
										</div>
									</div>
								</div>
								<!-- End Form Layout -->
								
									<?php } // Super Admin 
									?>
							</div>
							
							
				<!--2 end-->	


				<!--3-->	
							
							<div class="col-xl-12">
									<?php if (isset($_SESSION['Stone_setter'])) { ?>
									
									<div class="row">
										<div class="col-lg-12">
											<div class="card ">
												<div class="card-header card border border-warning">
													<h4 class="card-title">
														STONE SETTER
													</h4>
													
												</div>
												<div class="card-body p-4 ">
													
													<div class="row">
													
														<div class="col-lg-12 ms-lg-auto ">
															<div class="mt-4 mt-lg-0">
														   
																
																<form action="" method="POST">
																   
																	<div class="row mb-4">
																				<label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Date:</label>
																				<div class="col-sm-5">
																				
																				<input type="date" name="date" class="form-control" placeholder="Date">
																				</div>
																				
																   
																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Bar Code:</label>
																	<div class="col-sm-5">
																		
																	
																	
																	<h6></h6>
																	  <input type="hidden" name="pbarcode" class="form-control" placeholder="Barcode" value="">
																	</div> 
																	  <div class="col-sm-5">
																		  
																		  <input type="hidden" name="barcode" class="form-control" placeholder="Barcode">
																		</div>
																	</div> 
																	<div class="row mb-4">
																		<label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Name:</label>
																		<div class="col-sm-5">
																		  
																			<select required="" name="name"class="form-control form-select">
																				<option value="">Select Name</option>
																				<option value="wr">Muhammad Faisal</option>
																				<option value="ph">Shoaib</option>
																				<option value="cy">Ali</option>
																			</select>
																		</div>
																		<label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Image Upload:</label>
																		<div class="col-sm-5">
																		  
																		  <input type="file" name="imgupload" class="form-control" placeholder="image upload">
																		</div>
																	</div> 
																	<div class="row mb-4">
																		<label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Details:</label>
																		<div class="col-sm-11">
																		  
																		  <textarea type="text" name="detail" class="form-control" style="height: 107px;" placeholder="Details"></textarea>
																		</div>
																	</div> 
																	<div class="row mb-4">
																		<label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Issued Weight:</label>
																		<div class="col-sm-3">
																		  
																			<input type="text" name="Issued_weight" class="form-control" placeholder="Issued Weight">
																		</div>
																		<label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Retained Weight:</label>
																		<div class="col-sm-3">
																		  
																		  <input type="text" name="retained_weight" class="form-control" placeholder="Retained Weight">
																		</div>
																		<label for="horizontal-firstname-input" class="col-sm-1 col-form-label"></label>
																		<div class="col-sm-3">
																		  
																		  <input type="text" name="retained_weight" class="form-control form-control card bg-dark border-dark text-light" placeholder="Total Weight Issues">
																		</div>
																	</div> 
																	<table class="table table-bordered" id="dynamicTable">  
																		<tr>
																			<th>Stone Type:</th>
																			<th>Stone Weight:</th>
																			
																			<th>Action</th>
																		</tr>
																		<tr>  
																			<td>
																				<select required=""name="addmore[0][name]" class="form-control form-select">
																					<option value="">Select Stone</option>
																					<option value="wr">Rubi</option>
																					
																				</select>
																			  </td>  
																			<td>
																			   <input type="text" name="stone_weight" class="form-control" placeholder="Stone Weight">
																			</td>  
																			<td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>  
																		</tr>  
																	</table> 
																	<br/>
																  
																<hr/>
																<br/>
																<br/>
																	<div class="row mb-4">
																		<label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Date:</label>
																				<div class="col-sm-2">
																				
																				<input type="date" name="date" class="form-control" placeholder="Date">
																				</div>
																		
																		<label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Name:</label>
																		<div class="col-sm-2">
																		  
																			<select required="" name="name"class="form-control form-select">
																				<option value="">Select Name</option>
																				<option value="wr">Muhammad Faisal</option>
																				<option value="ph">Shoaib</option>
																				<option value="cy">Ali</option>
																			</select>
																		</div>
																		<label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Image Upload:</label>
																		<div class="col-sm-5">
																		  
																		  <input type="file" name="imgupload" class="form-control" placeholder="Name">
																		</div></div> 


																		<table class="table table-bordered" id="returnTable">  
																			<tr>
																				<th>Type:</th>
																				<th>Weight:</th>
																				
																				<th>Action</th>
																			</tr>
																			<tr>  
																				<td>
																					<select required=""name="addmore[0][name]" class="form-control form-select">
																						<option value="">Select Type</option>
																						<option value="wr">Rubi</option>
																						
																					</select>
																				  </td>  
																				<td>
																				   <input type="text" name="stone_weight" class="form-control" placeholder="Weight">
																				</td>  
																				<td><button type="button" name="return" id="return" class="btn btn-success">Add More</button></td>  
																			</tr>  
																		</table> 


																</form>
										

																	<div class="row justify-content-end">
																		<div class="col-sm-9">
																		   
																			<div>
																				<button type="" class="btn btn-success waves-effect waves-light">Print</button>
																				<button type="submit" class="btn btn-primary">Save</button>
																			</div>
																		</div>
																	</div>
																</form>
															</div>
														</div>
													</div>


													

												

												   
												</div>
											</div>
										</div>
                                <!-- end card -->
		
							<?php } // Super Admin 
									?>
							</div>
							</div>
							
				<!--3 end-->		
							
					

						<!--4-->	
							
							<div class="col-xl-12">
							<?php if (isset($_SESSION['additional_manu'])) { ?>
									
									<div class="row">
										<div class="col-lg-12">
										<div class="card ">
											<div class="card-header card border border-primary">
												<h4 class="card-title"> ADDITIONAL MANUFACTURING</h4>
												
											</div>
											<div class="card-body p-4 ">
												
												<div class="row">
												
													<div class="col-lg-12 ms-lg-auto ">
														<div class="mt-4 mt-lg-0">
													   
															
															<form action="#" method="POST">
															  
																<div class="row mb-4">
																	<table class="table table-bordered" id="additionalTable">  
																		<tr>
																			<th>Date:</th>
																			<th>Date:</th>
																			<th>Name:</th>
																			<th>Name:</th>
																			<th>Type:</th>
																			<th>Type:</th>
																			<th>Amount:</th>
																			<th>Amount:</th>
																			<th>Action</th>
																		</tr>
																		<tr>  
																			<td>
																				<input type="text" name="date" class="form-control" placeholder="Date">
																			  </td>  
																			<td>
																			   <input type="text" name="date1" class="form-control" placeholder="Date">
																			</td> 
																			<td>
																				<input type="text" name="Name" class="form-control" placeholder="Name">
																			  </td>  
																			<td>
																			   <input type="text" name="Name" class="form-control" placeholder="Name">
																			</td> 
																			<td>
																				<input type="text" name="type" class="form-control" placeholder="Type">
																			  </td>  
																			<td>
																			   <input type="text" name="type" class="form-control" placeholder="Type">
																			</td> 
																			<td>
																				<input type="text" name="amount" class="form-control" placeholder="Amount">
																			  </td>  
																			<td>
																			   <input type="text" name="amount" class="form-control" placeholder="Amount">
																			</td> 



																			<td><button type="button" name="additional" id="additional" class="btn btn-success">Add More</button></td>  
																		</tr>  
																	</table> 
																</div> 
																
									

																<div class="row justify-content-end">
																	<div class="col-sm-9">
																	   
																		<div>
																			<button type="" class="btn btn-success waves-effect waves-light">Print</button>
																			<button type="submit" class="btn btn-primary">Save</button>
																		</div>
																	</div>
																</div>
															</form>
														</div>
													</div>
												</div>


												

											

											   
											</div>
										</div>
										</div>
                                <!-- end card -->
		
							<?php } // Super Admin 
									?>
							</div>
							
							
				<!--4 end-->	




				<!--5-->	
							
							<div class="col-xl-12">
							<?php if (isset($_SESSION['additional_manu'])) { ?>
									
									<div class="row">
										<div class="col-lg-12">
										<div class="card ">
            <div class="card-header card border border-info">
                <h4 class="card-title">
                    GOLD ACCOUNT
                    
                  
                </h4>
                
            </div>
            <div class="card-body p-4 ">
                
                <div class="row">
                
                    <div class="col-lg-12 ms-lg-auto ">
                        <div class="mt-4 mt-lg-0">
                       
                            
                            <form action="#" method="POST">
                                
                                <div class="row mb-4">
                                    <label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Date:</label>
                                            <div class="col-sm-5">
                                            
                                            <input type="date" name="date" class="form-control" placeholder="Date">
                                            </div>
                                    <label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Name:</label>
                                    <div class="col-sm-5">
                                      
                                        <select required="" name="name"class="form-control form-select">
                                            <option value="">Select Name</option>
                                            <option value="wr">Muhammad Faisal</option>
                                            <option value="ph">Shoaib</option>
                                            <option value="cy">Ali</option>
                                        </select>
                                    </div>
                                  
                                </div> 
                                <div class="row mb-4">
                                    <label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Details:</label>
                                    <div class="col-sm-11">
                                      
                                      <textarea type="text" name="detail" class="form-control" style="height: 107px;" placeholder="Details"></textarea>
                                    </div>
                                </div> 
                                <div class="row mb-5">
                                    <label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Gold Issued Weight:</label>
                                    <div class="col-sm-2">
                                      
                                        <input type="text" name="gold_Issued_weight" class="form-control" placeholder="Gold Issued Weight">
                                    </div>
                                    <label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Purity:</label>
                                    <div class="col-sm-3">
                                      
                                      <input type="text" name="purity" class="form-control" placeholder="Purity">
                                    </div>
                                    <label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Pure Weight Issued:</label>
                                    <div class="col-sm-3">
                                      
                                      <input type="text" name="pure_weight_issued" class="form-control" placeholder="Pure Weight Issued">
                                    </div>
    

                                <div class="row justify-content-end">
                                    <div class="col-sm-9">
                                       
                                        <div>
                                            <button type="" class="btn btn-success waves-effect waves-light">Print</button>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                

            

               
            </div>
        </div>
    </div>
										</div>
                                <!-- end card -->
		
							<?php } // Super Admin 
									?>
							</div>
							
							
				<!--5 end-->	

















					
							
							
                            
                      
							
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