<?php include 'layouts/session.php'; 


// Include config file
require_once "layouts/config.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


?>


<?php include 'layouts/head-main.php'; ?>


<head>
    <title><?php echo $language["Dashboard"]; ?> Production</title>

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
													   
															
															<form action="external-work-db.php?from=stepOne" method="POST" enctype="multipart/form-data">
															   
																<div class="row mb-4">
																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Name:</label>
																	<div class="col-sm-5">
																	  
																	  <input type="text" name="name" id="name" value="" class="form-control" placeholder="Name">
																	</div>
																		  
															   
																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Bar Code:</label>
																	
																	<div class="col-sm-5">
																	   
																		
																		<input type="text" name="code" id="code" value="" class="form-control" placeholder="code">
																	
																	</div>
																</div> 
																<div class="row mb-4">
																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Date:</label>
																	<div class="col-sm-5">
																	  
																	  <input type="date" name="date" class="form-control">
																	</div>
																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Image Upload:</label>
																	<div class="col-sm-5">
																	  
																	  <input type="file" id="image" name="image" value="" class="form-control" accept="image/*">
																	</div>
																</div> 
																<div class="row mb-4">
																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Details:</label>
																	<div class="col-sm-11">
																	  
																	  <textarea type="text" name="details" value="" class="form-control" style="height: 107px;" placeholder="Details"></textarea>
																	</div>
																</div> 
																<div class="row mb-4">
																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Type:</label>
																	<div class="col-sm-3">
																	  
																		<select required="" name="type" id="type" class="form-control form-select">
																			<option>Select Type</option>
																			<option value="Set">Set</option>
																			<option value="Tops">Tops</option>
																			<option value="Ring">Ring</option>
																			<option value="Braclet">Braclet</option>
																			<option value="Safety Chain">Safety Chain</option>
																			<option value="Clip">Clip</option>
																			<option value="Kariyan">Kariyan</option>
																			<option value="Locket">Locket</option>
																			<option value="Locket Set">Locket Set</option>
																			<option value="Bangles">Bangles</option>
																			<option value="Kara">Kara</option>
																			<option value="Bindia">Bindia</option>
																			<option value="Kara + Locket set">Kara + Locket set</option>
																			<option value="Order">Order</option>
																			<option value="Latkan">Latkan</option>
																			<option value="Bangles Set">Bangles Set</option>
																			<option value="Set+ring">Set+ring</option>
																			<option value="Repairing">Repairing</option>
																			<option value="Natt">Natt</option>
																			<option value="Cap">Cap</option>
																			<option value="Polish paid">Polish paid</option>
																			<option value="Jhumar">Jhumar</option>
																		</select>
																	</div>
																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Quantity:</label>
																	<div class="col-sm-3">
																	  
																	  <input type="number" value="" id="quantity" name="quantity" class="form-control" placeholder="QTY">
																	</div>
																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Purity:</label>
																	<div class="col-sm-3">
																		<select required="" name="purity" id="pValue"  class="form-control form-select">
																			<option>Select Purity</option>
																			<option value="0.75" data-id="0.75">18K</option>
																			<option value="0.875" data-id="0.875">21K</option>
																			<option value="0.916" data-id="0.916">22K</option>
																		</select>
																	</div>
																</div>   
																<div class="row mb-4">
																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Unpolish Weight:</label>
																	<div class="col-sm-3">
																	  
																		<input type="text" name="unpolish_weight" value="" id="unpolish_weight" class="form-control" placeholder="Unpolish Weight">
																	</div>
																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Polish Weight:</label>
																	<div class="col-sm-3">
																	  
																	  <input type="text" name="polish_weight" id="polish_weight" value="" class="form-control" placeholder="polish Weight">
																	</div>
																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Rate:</label>
																	<div class="col-sm-3">
																	  
																	  <input type="text" name="rate" id="rate" value="" class="form-control" placeholder="Rate">
																	</div>
																</div> 

																<div class="row mb-4">
																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Wastage:</label>
																	<div class="col-sm-3">
																	  
																		<input type="text" name="wastage" id="wastage" value="" class="form-control" placeholder="Wastage" readonly>
																	</div>
																	<!-- <label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Unpure Weight:</label>
																	<div class="col-sm-3">
																	  
																	  <input type="text" name="unpure_weight"  id="unpure_weight" class="form-control" placeholder="Unpure Weight">
																	</div> -->
																	<!-- <label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Pure Weight:</label> -->
																	<!-- <div class="col-sm-3">
																	  
																	  <input type="text" name="pure_weight" id="pure_weight" class="form-control" placeholder="Pure Weight">
																	</div> -->
																	
																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label">24K</label>
																	<div class="col-sm-3">
																	  
																	  <input type="text" name="tValues" id="tValues"  value="" class="form-control" readonly>
																	</div>
																</div> 
									

																<div class="row justify-content-end">
																	<div class="col-sm-9">
																	   
																		<div>
																			
																			<!-- <button type="submit" class="btn btn-primary">Save</button> -->
																			<input type="submit" class="btn btn-success" value="Save">
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
													   
															
															<form action="external-work-db.php?from=stepTwo" method="POST">
															   
																<div class="row mb-4">
																   
																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Date:</label>
																	<div class="col-sm-5">
																	  
																	  <input type="date" name="date" class="form-control" placeholder="Date">
																	</div>
																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Code:</label>
																	<div class="col-sm-5">
																	  
																		<select required="" name="stepTwoCode" id="stepTwoCode" required class="form-control form-select">
																			<option value="">Select Name</option>
																			<?php 
																			$getQuery = "SELECT * FROM `manufacturing_step` WHERE `status` = 'Active'";
																			$queryStatement = $pdo->prepare($getQuery);
																			if($queryStatement->execute()){
																				$getRows = $queryStatement->fetchAll();
																				foreach ($getRows as $key => $value) {
																					echo "<option value='".$value['code']."'>".$value['code']."</option>";
																				}
																			}
																		?>
																		</select>
																	</div>
																   
																	
																</div> 
																<div class="row mb-4">
																<label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Name:</label>
																	<div class="col-sm-5">
																		
																	 <input type="text" class="form-control" id="stepTwoName" name="name" value="" readonly>
																	</div>
																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Image Upload:</label>
																	<div class="col-sm-5">
																	  
																	  <input type="file" id="image" name="image" value="" class="form-control" accept="image/*">
																	</div>
																</div> 
																<div class="row mb-4">
																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Details:</label>
																	<div class="col-sm-11">
																	  
																	  <textarea type="text" name="detail" class="form-control" style="height: 107px;" placeholder="Details"></textarea>
																	</div>
																</div> 
																
																<div class="row mb-4">
																<label for="horizontal-firstname-input" for="difference" class="col-sm-1 col-form-label">Difference:</label>
																	<div class="col-sm-3">
																	  
																	  <input type="text" type="number" value="" id="stepTwoDifference" name="difference" readonly class="form-control" placeholder="Difference">
																	</div>
																
																	<label for="horizontal-firstname-input" for="poWas" class="col-sm-1 col-form-label">Wastage:</label>
																	<div class="col-sm-3">
																	  
																		<input type="text" type="number" value="" id="poWas" name="poWas" class="form-control" placeholder="Wastage" readonly>
																	</div>
																	
																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label">=</label>
																	<div class="col-sm-3">
																	  <input type="text" type="number" value="" id="psEmail" name="psEmail" readonly class="form-control card bg-dark border-dark text-light" placeholder="Payable / Receivable">
																	</div>
																</div> 
									

																<div class="row justify-content-end">
																	<div class="col-sm-9">
																	   
																		<div>
																			<input type="submit" class="btn btn-success" value="Save">
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
													   
															
															<form action="external-work-db.php?from=additional" method="POST">
															  
																<div class="row mb-4">
																	<table class="table table-bordered" id="additionalTable">  
																		<tr>
																			<th>Date:</th>
																			<th>Name:</th>
																			<th>Type:</th>
																			<th>Amount:</th>
																			<th>Action</th>
																		</tr>
																		<tr>  
																			<td>
																				<input type="text" name="date" class="form-control" placeholder="Date">
																			  </td>  
																			<td>
																			   <input type="text" name="name" class="form-control" placeholder="Name">
																			</td> 
																			<td>
																				<input type="text" name="type" class="form-control" placeholder="Type">
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
																			<input type="submit" class="btn btn-success" value="Save">
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
                       
                            
                            <form action="external-work-db.php?from=goldaccount" method="POST">
                                
                                <div class="row mb-4">
                                    <label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Date:</label>
                                            <div class="col-sm-5">
                                            
                                            <input type="date" name="date" class="form-control" placeholder="Date">
                                            </div>
                                    <label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Name:</label>
                                    <div class="col-sm-5">
                                      
                                        <select required="" name="name" class="form-control form-select">
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
                                           <input type="submit" class="btn btn-success" value="Save">
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

<script>
    image.onchange = evt => {
    const [file] = image.files
        if (file) {
            preview.src = URL.createObjectURL(file);
            $('#preview').css("display", "block");
        }
    }
</script>
<script>
    $(document).on('keyup', '#rate', function(e){
        e.preventDefault();
        var constantValue = 96;
        var rFlowValue = parseInt($(this).val());
       var upEmail = parseFloat($(document).find('#unpolish_weight').val());
		var pValues = []; $.each($("#pValue option:selected"), function(){            
            pValues.push($(this).val());
        });
        var sPValue = pValues[0];
        
        if(isNaN(upEmail)){
            alert('Please Insert The unpolish_weight Value');
            $(document).find('#rate').val('');
            return false;
        }else{
            

            var wtgValue = (upEmail * rFlowValue / constantValue).toFixed(2);

			$(document).find('#wastage').val(wtgValue);
            
			var wtgValue1 = wtgValue = (upEmail * rFlowValue / constantValue);

			var rr = parseFloat(upEmail + wtgValue1).toFixed(2);

			var rr2 = parseFloat(sPValue).toFixed(2);

			//var rr3=parseFloat(wtgValue).toFixed(2);
			//var rr3 = parseFloat(sPValue).toFixed(2);
			
			
            var tValues = (rr * sPValue).toFixed(2);
            
            $(document).find('#tValues').val(tValues);
            
			
            console.log(tValues);
        }
    });
</script>


<!-- 2-->
<script>
    $(document).on('change', '#stepTwoCode', function(e){
        e.preventDefault();
            $.ajax({
            url: "external-work-db.php?ajax=getData",
            method: "POST",
            data: {
                code: $(this).val()
            },
            success: function (response) {
                var data = JSON.parse(response);
                var name = data[0].name;
                var upEmail = parseFloat(data[0].unpolish_weight, 10);
                var pemail = parseFloat(data[0].polish_weight, 10);
                var constantValue =  96;
                var difference = (upEmail-pemail);
                var poWas = (upEmail / 1);


                polisherWastage = (poWas / constantValue).toFixed(0);
               
				var psEmail = (difference - polisherWastage);

                $(document).find('#stepTwoName').val(name);
                $(document).find('#stepTwoDifference').val(difference);
                $(document).find('#poWas').val(polisherWastage);
                $(document).find('#psEmail').val(psEmail);

                console.log(psEmail);


            },
            error: function (xhr, status) {
                alert("Sorry, there was a problem!");
            },
            complete: function (xhr, status) {
                //$('#showresults').slideDown('slow')
            }
        })
    });
</script>







<script type="text/javascript">
   
    var i = 0;
       
    $("#add").click(function(){
   
        ++i;
   
        $("#dynamicTable").append('<tr><td><select required=""name="addmore['+i+'][name]" class="form-control form-select"><option value="">Select Stone</option><option value="wr">Rubi</option></select></td><td><input type="text" name="addmore['+i+'][stone_weight]" placeholder="Stone Weight" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
    });
   
    $(document).on('click', '.remove-tr', function(){  
         $(this).parents('tr').remove();
    });  
   
</script>

<script type="text/javascript">
   
    var i = 0;
       
    $("#return").click(function(){
   
        ++i;
   
        $("#returnTable").append('<tr><td><select required=""name="addmore['+i+'][type]" class="form-control form-select"><option value="">Select Type</option><option value="wr">Rubi</option></select></td><td><input type="text" name="addmore['+i+'][weight]" placeholder="Weight" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
    });
   
    $(document).on('click', '.remove-tr', function(){  
         $(this).parents('tr').remove();
    });  
   
</script>






<script type="text/javascript">
   
    var i = 0;
       
    $("#additional").click(function(){
   
        ++i;
   
        $("#additionalTable").append('<tr><td><input type="text" name="addmore['+i+'][date]" placeholder="Date" class="form-control" /></td><td><input type="text" name="addmore['+i+'][name]" placeholder="Name" class="form-control" /></td><td><input type="text" name="addmore['+i+'][name]" placeholder="Type" class="form-control" /></td><td><input type="text" name="addmore['+i+'][amount]" placeholder="Amount" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
    });
   
    $(document).on('click', '.remove-tr', function(){  
         $(this).parents('tr').remove();
    });  
   
</script>














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