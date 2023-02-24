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



 					<div class="row mb-2">
 						<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Product:</label>
 						<div class="col-sm-3">

 							<select id="select-product" placeholder="Pick a Product...">
 								<option value="">Select a Product...</option>

 							</select>
 						</div>
 						<div class="col d-flex justify-content-end me-4">
 							<button type="button" onclick="DeleteProduct()" class="btn btn-danger" id="delete-product">Delete Product</button>
 						</div>
 					</div>

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


 															<form id="stepone" method="POST" enctype="multipart/form-data">
 																<?php

																	$randomNumber = random_int(0000000000, 669900000000);
																	echo "<input type='hidden' name='barcode' value='$randomNumber' class='form-control'>";
																	?>
 																<div id="manufacturer-div">
 																	<div class="row mb-4">
 																		<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Name:</label>
 																		<div class="col-sm-5">

 																			<select id="select-manufacturer" name="vendor_id" placeholder="Pick a manufacturer..." required>
 																				<option value="">Select a manufacturer...</option>

 																			</select>
 																		</div>


 																		<label for="horizontal-firstname-input" name="product_id" class="bar-code col-sm-1 col-form-label d-flex justify-content-end">Bar Code:</label>

 																		<div class="col-sm-5">


 																			<input type="text" name="code" id="code" value="" class="form-control code" placeholder="code" readonly>

 																		</div>
 																	</div>
 																	<div class="row mb-4">
 																		<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Date:</label>
 																		<div class="col-sm-5">

 																			<input type="date" name="date" id="date" class="form-control">
 																		</div>
 																		<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Image Upload:</label>
 																		<div class="col-sm-5">

 																			<input type="file" id="image" name="image" value="" class="form-control" accept="image/*">
 																		</div>
 																	</div>
 																	<div class="row mb-4">
 																		<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Details:</label>
 																		<div class="col-sm-11">

 																			<textarea type="text" id="details" name="details" value="" class="form-control" style="height: 107px;" placeholder="Details"></textarea>
 																		</div>
 																	</div>
 																	<div class="row mb-4">
 																		<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Type:</label>
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
 																		<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Quantity:</label>
 																		<div class="col-sm-3">

 																			<input type="number" value="" id="quantity" name="quantity" class="form-control" placeholder="QTY" required>
 																		</div>
 																		<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Purity:</label>
 																		<div class="col-sm-3">
 																			<select required="" name="purity" id="select-manufacturer-purity" class="form-control form-select" placeholder="Purity" required>
 																			</select>
 																		</div>
 																	</div>
 																	<div class="row mb-4">
 																		<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Unpolish Weight:</label>
 																		<div class="col-sm-3">

 																			<input type="number" step="any" name="unpolish_weight" value="" id="unpolish_weight" class="form-control" placeholder="Unpolish Weight" required>
 																		</div>
 																		<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Polish Weight:</label>
 																		<div class="col-sm-3">

 																			<input type="number" step="any" name="polish_weight" id="polish_weight" value="" class="form-control" placeholder="polish Weight" required>
 																		</div>
 																		<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Rate:</label>
 																		<div class="col-sm-3">

 																			<input type="number" step="any" name="rate" id="manufacturer-rate" value="" class="form-control" placeholder="Rate" required>
 																		</div>
 																	</div>

 																	<div class="row mb-4">
 																		<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Wastage:</label>
 																		<div class="col-sm-3">

 																			<input type="number" step="any" name="wastage" id="wastage" value="" class="form-control" placeholder="Wastage" readonly>
 																		</div>
 																		<!-- <label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Unpure Weight:</label>
																	<div class="col-sm-3">
																	  
																	  <input type="text" name="unpure_weight"  id="unpure_weight" class="form-control" placeholder="Unpure Weight">
																	</div> -->
 																		<!-- <label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Pure Weight:</label> -->
 																		<!-- <div class="col-sm-3">
																	  
																	  <input type="text" name="pure_weight" id="pure_weight" class="form-control" placeholder="Pure Weight">
																	</div> -->

 																		<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">24K:</label>
 																		<div class="col-sm-3">

 																			<input type="number" step="any" name="tValues" id="tValues" value="" class="form-control" readonly>
 																		</div>
 																	</div>
 																</div>


 																<div class="row justify-content-end">
 																	<div class="col-sm-9">

 																		<div>

 																			<!-- <button type="submit" class="btn btn-primary">Save</button> -->
 																			<button type="" class="btn btn-success waves-effect waves-light" >Print</button>
 																			<button type="submit" class="btn btn-primary" value="Save">Save</button>
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


 															<form id="steptwo" method="POST" enctype="multipart/form-data">
 																<?php

																	$randompolisher = random_int(0000000000, 999900000000);
																	echo "<input type='hidden' name='polisherbarcode' value='$randompolisher' class='form-control'>";
																	?>
 																<div class="row mb-4">

 																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Name:</label>
 																	<div class="col-sm-5">

 																		<select id="select-polisher" name="vendor_id" placeholder="Pick a polisher..." required>
 																			<option value="">Select a polisher...</option>

 																		</select>
 																	</div>
 																	<label for="horizontal-firstname-input" class="bar-code col-sm-1 col-form-label d-flex justify-content-end">Bar Code:</label>

 																	<div class="col-sm-5">


 																		<input type="text" name="product_id" value="" class="form-control code" placeholder="code" readonly>

 																	</div>


 																</div>
 																<div class="row mb-4">

 																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Date:</label>
 																	<div class="col-sm-5">

 																		<input type="date" name="date" id="p_date" class="form-control" placeholder="Date">
 																	</div>

 																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Image Upload:</label>
 																	<div class="col-sm-5">

 																		<input type="file" id="image" name="image" value="" class="form-control" accept="image/*">
 																	</div>
 																</div>
 																<div class="row mb-4">
 																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Details:</label>
 																	<div class="col-sm-11">

 																		<textarea type="text" name="detail" id="p_details" class="form-control" style="height: 107px;" placeholder="Details"></textarea>
 																	</div>
 																</div>

 																<div class="row mb-4">
 																	<label for="horizontal-firstname-input" for="difference" class="col-sm-1 col-form-label d-flex justify-content-end">Difference:</label>
 																	<div class="col-sm-2">

 																		<input type="number" step="any" value="" id="difference" name="difference" readonly class="form-control" placeholder="Difference">
 																	</div>
 																	<label for="horizontal-firstname-input" for="p_rate" class="col-sm-1 col-form-label d-flex justify-content-end">Rate:</label>
 																	<div class="col-sm-2">

 																		<input type="number" step="any" value="" id="p_rate" name="p_rate" class="form-control" placeholder="Rate" required>
 																	</div>

 																	<label for="horizontal-firstname-input" for="poWas" class="col-sm-1 col-form-label d-flex justify-content-end">Wastage:</label>
 																	<div class="col-sm-2">

 																		<input type="number" step="any" value="" id="poWas" name="poWas" class="form-control" placeholder="Wastage" readonly>
 																	</div>

 																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">=</label>
 																	<div class="col-sm-2">
 																		<input type="number" step="any" value="" id="payable" name="payable" readonly class="form-control card bg-dark border-dark text-light" placeholder="Payable / Receivable">
 																	</div>
 																</div>


 																<div class="row justify-content-end">
 																	<div class="col-sm-9">

 																		<div>
 																			<button type="button" id="polisher_print_btn" class="btn btn-success waves-effect waves-light">Print</button>
 																			<button type="submit" id="polisher_save_btn" class="btn btn-primary" value="Save">Save</button>
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


 															<form id="stepthree" method="POST" enctype="multipart/form-data">
 																<?php

																	$randomstone = random_int(0000000000, 779900000000);
																	echo "<input type='hidden' name='stonebarcode' value='$randomstone' class='form-control'>";
																	?>

 																<div class="row mb-4">
 																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Name:</label>
 																	<div class="col-sm-5">

 																		<select id="select-stone_setter" name="vendor" placeholder="Pick a stone setter..." required>
 																			<option value="">Select a stone setter...</option>

 																		</select>
 																	</div>


 																	<label for="horizontal-firstname-input" class="bar-code col-sm-1 col-form-label d-flex justify-content-end">Bar Code:</label>

 																	<div class="col-sm-5">


 																		<input type="text" name="code" value="" class="form-control code" placeholder="code" readonly>

 																	</div>

 																</div>
 																<div class="row mb-4">

 																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Date:</label>
 																	<div class="col-sm-5">

 																		<input type="date" name="date" id="s_date" class="form-control" placeholder="Date">
 																	</div>

 																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Image Upload:</label>
 																	<div class="col-sm-5">

 																		<input type="file" id="image" name="image" value="" class="form-control" accept="image/*">
 																	</div>
 																</div>
 																<div class="row mb-4">
 																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Details:</label>
 																	<div class="col-sm-11">

 																		<textarea type="text" name="detail" id="s_details" class="form-control" style="height: 107px;" placeholder="Details"></textarea>
 																	</div>
 																</div>
 																<div class="row mb-4">
 																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Issued Weight:</label>
 																	<div class="col-sm-3">

 																		<input type="number" step="any" name="Issued_weight" id="stepIssueweight" class="form-control" placeholder="Issued Weight" readonly>
 																	</div>
 																</div>
 																<div class="row mb-4">
 																	<h5>Zircon:</h6>
 																		<label for="horizontal-firstname-input" class="col-sm-1 col-form-label  d-flex justify-content-end">Code:</label>
 																		<div class="col-sm-2">

 																			<input type="text" name="zircon_code[]" id="zircon_code[]" value="" class="form-control" placeholder="Zircon" required>

 																		</div>
 																		<div class="col-sm-1 p-0">
 																			<i class="fa fa-barcode fa-3x" onclick="BarCode(this)"></i>
 																		</div>
 																		<label for="horizontal-firstname-input" class="col-sm-1 col-form-label  d-flex justify-content-end">Weight:</label>
 																		<div class="col-sm-2">

 																			<input type="number" step="any" name="zircon_weight[]" id="zircon_weight[]" value="" class="form-control" placeholder="Zircon" required>
 																		</div>
 																		<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Quantity:</label>
 																		<div class="col-sm-2">

 																			<input type="number" step="any" name="zircon_quantity[]" id="zircon_quantity[]" value="" class="form-control" placeholder="Zircon" required>
 																		</div>
 																		<div class="col-sm-2">

 																			<i onclick="Add()" class="fa fa-plus-circle p-2"></i>
 																		</div>
 																</div>
 																<div id="area">

 																</div>
 																<div class="row mb-4">
 																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Total Weight:</label>
 																	<div class="col-sm-2">

 																		<input type="number" step="any" name="zircon_total_weight" value="" id="zircon_total_weight" class="form-control form-control card bg-dark border-dark text-light" placeholder="Total">
 																	</div>
 																	<div class="col-sm-1"></div>
 																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Total Quantity:</label>
 																	<div class="col-sm-2">

 																		<input type="number" step="any" name="zircon_total_quantity" value="" id="zircon_total_quantity" class="form-control form-control card bg-dark border-dark text-light" placeholder="Total">
 																	</div>
 																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-none">Total Price:</label>
 																	<div class="col-sm-3">

 																		<input type="number" step="any" name="zircon_total" value="" id="zircon_total" class="d-none form-control form-control card bg-dark border-dark text-light" placeholder="Total">
 																	</div>
 																</div>
 																<div class="row mb-4">
 																	<h5>Stone:</h5>
 																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Code:</label>
 																	<div class="col-sm-2">

 																		<input type="text" name="stone_code[]" id="stone_code[]" value="" class="form-control" placeholder="Stone Code" required>

 																	</div>
 																	<div class="col-sm-1 p-0">
 																		<i class="fa fa-barcode fa-3x" onclick="BarCode(this)"></i>
 																	</div>
 																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Weight:</label>
 																	<div class="col-sm-2">

 																		<input type="number" step="any" name="stone_weight[]" id="stone_weight[]" value="" class="form-control" placeholder="Stone Weight" required>
 																	</div>
 																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Quantity:</label>
 																	<div class="col-sm-2">

 																		<input type="number" step="any" name="stone_quantity[]" id="stone_quantity[]" value="" class="form-control" placeholder="Stone Quantity" required>
 																	</div>
 																	<div class="col-sm-2">

 																		<i onclick="AddStone()" class="fa fa-plus-circle p-2"></i>
 																	</div>


 																</div>
 																<div id="area2">

 																</div>
 																<div class="row mb-4">
 																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Total Weight:</label>
 																	<div class="col-sm-2">

 																		<input type="number" step="any" name="stone_total_weight" value="" id="stone_total_weight" class="form-control form-control card bg-dark border-dark text-light" placeholder="Total">
 																	</div>
 																	<div class="col-sm-1"></div>
 																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Total Quantity:</label>
 																	<div class="col-sm-2">

 																		<input type="number" step="any" name="stone_total_quantity" value="" id="stone_total_quantity" class="form-control form-control card bg-dark border-dark text-light" placeholder="Total">
 																	</div>
 																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-none">Total Price:</label>
 																	<div class="col-sm-3">

 																		<input type="number" step="any" name="stone_total" value="" id="stone_total" class="d-none form-control form-control card bg-dark border-dark text-light" placeholder="Total">
 																	</div>
 																</div>
 																<div class="row mb-4">
 																	<h5 class="d-none">Grand Total:</h5>
 																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-none">Total Price:</label>
 																	<div class="col-sm-3">

 																		<input type="number" step="any" name="grand_total" value="" id="grand_total" class="d-none form-control form-control card bg-dark border-dark text-light" placeholder="Total">
 																	</div>
 																</div>

 																<hr />
 																<div class="row justify-content-end mb-3">
 																	<div class="col-sm-9">

 																		<div>
 																			<button type="" class="btn btn-success waves-effect waves-light">Print</button>
 																			<button type="submit" class="btn btn-primary">Save</button>
 																		</div>
 																	</div>
 																</div>

 																<table class="table table-bordered" id="returnTable">
 																	<tr>
 																		<th>Received weight:</th>
 																		<th>Stone received:</th>
 																		<th>Qty:</th>
 																		<th>Rate:</th>
 																		<th>Wastage:</th>
 																	</tr>
 																	<tr>
 																		<td>
 																			<input type="number" step="any" name="received_weight" value="" id="received_weight" class="form-control" placeholder="Received weight">
 																		</td>
 																		<td>
 																			<input type="number" step="any" name="stone_received" value="" id="stone_received" class="form-control" placeholder="Stone Received">
 																		</td>
 																		<td>
 																			<input type="number" step="any" name="Qty" value="" id="Qty" class="form-control" placeholder="Qty">
 																		</td>
 																		<td>
 																			<input type="number" step="any" value="" id="s_rate" class="form-control" placeholder="Rate">
 																		</td>
 																		<td>
 																			<input type="number" step="any" name="wastage" value="" id="wastage1" class="form-control" placeholder="Wastage">
 																		</td>
 																	</tr>
 																</table>

 																<table class="table table-bordered" id="returnTable">
 																	<tr>
 																		<th>Total:</th>
 																		<th>Payable:</th>
 																	</tr>
 																	<tr>
 																		<td>
 																			<input type="number" step="any" name="Total" id="Total" class="form-control" placeholder="Received weight+Stone received+Wastage">
 																		</td>
 																		<td>
 																			<input type="number" step="any" name="Payable" id="Payable" class="form-control" placeholder="Total-Total">
 																		</td>


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
 															<?php

																$randomadditional = random_int(0000000000, 819900000000);
																echo "<input type='hidden' name='additionalbarcode' value='$randomadditional' class='form-control'>";
																?>
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
 																			<input type="date" name="date" class="form-control" placeholder="Date">
 																		</td>
 																		<td>

 																			<select id="select-vendor" placeholder="Pick a vendor...">
 																				<option value="">Select a vendor...</option>

 																			</select>
 																		</td>
 																		<td>
 																			<select required="" name="type" class="form-control form-select">
 																				<option value="">Select Type</option>
 																				<option value="Stone ">Stone</option>
 																				<option value="Dull">Dull</option>
 																				<option value="Meena">Meena</option>
 																				<option value="Ruby">Ruby</option>
 																				<option value="Green">Green</option>
 																				<option value="Sapphire">Sapphire</option>
 																				<option value="Topas">Topas</option>
 																				<option value="Turmaline">Turmaline</option>
 																				<option value="Lekar">Lekar</option>
 																				<option value="Cubic Baquets">Cubic Baquets</option>
 																				<option value="Korean Baquets">Korean Baquets</option>
 																				<option value="Color Stones">Color Stones</option>
 																				<option value="Blue">Blue</option>
 																				<option value="Pearl">Pearl</option>
 																				<option value="Packet">Packet</option>

 																			</select>
 																		</td>
 																		<td>
 																			<input type="number" step="any" name="amount" class="form-control" placeholder="Amount">
 																		</td>



 																		<td><button type="submit" class="btn btn-primary">Save</button>


 																		</td>
 																	</tr>
 																</table>
 															</div>



 															<div class="row justify-content-end">
 																<div class="col-sm-9">

 																	<div>

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
 								<!-- end card
		
							<?php } // Super Admin 
							?>
							</div> -->


 								<!--4 end-->


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
 		function printDiv(id) {

 			var printContents = document.getElementById(id);
 			console.log(printContents);
 			printContents.innerHTML;

 			var cssFiles = [
 				"assets/css/preloader.min.css",
 				"assets/css/bootstrap.min.css",
 				"assets/css/icons.min.css",
 				"assets/css/app.min.css",
 				"assets/libs/sweetalert2/sweetalert2.min.css",
 				"https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css"
 			];

 			// Print the contents of the div
 			printJS({
 				printable: printContents,
 				type: 'html',
 				css: cssFiles,
 				onPrintDialogClose: restoreDiv
 			});
 		}

 		function restoreDiv() {
 			// Restore the original content of the div
 			document.getElementById("print-div").innerHTML = originalContent;
 		}

 		function BarCode(btn) {
 			var inputElement = btn.parentNode.parentNode.childNodes[5].childNodes[1];
 			const event = new KeyboardEvent('keydown', {
 				keyCode: 13
 			});
 			inputElement.dispatchEvent(event);

 			const barcode = inputElement.value;
 		}

 		function GetManufacturerData(id) {
 			$.ajax({
 				url: "functions.php",
 				type: "POST",
 				data: {
 					function: "GetManufacturerData",
 					id: id
 				},
 				success: function(data) {
 					data = JSON.parse(data);
 					$.ajax({
 						url: "functions.php",
 						method: "POST",
 						data: {
 							function: "GetVendor",
 							id: data[0].vendor_id
 						},
 						success: function(response) {
 							var data1 = JSON.parse(response);
 							var select_manufacturer_purity = $('#select-manufacturer-purity')[0].selectize;
 							for (var i = 0; i < data1.length; i++) {
 								var newOption = {
 									value: data1[i]['18k'],
 									text: "18k"
 								};
 								var newOption1 = {
 									value: data1[i]['21k'],
 									text: "21k"
 								};
 								var newOption2 = {
 									value: data1[i]['22k'],
 									text: "22k"
 								};
 								select_manufacturer_purity.addOption(newOption);
 								select_manufacturer_purity.addOption(newOption1);
 								select_manufacturer_purity.addOption(newOption2);
 							}

 							select_manufacturer_purity.setValue(data[0].purity);
 							CalculateDifference()
 						}
 					});
 					var select_manufacturer = $('#select-manufacturer')[0].selectize;
 					select_manufacturer.setValue(data[0].vendor_id);
 					var code = document.getElementsByClassName('code');
 					for (var i = 0; i < code.length; i++) {
 						code[i].value = data[0].product_id;
 					}
 					var dateString = data[0].date;
 					var date = new Date(dateString);
 					var year = date.getFullYear();
 					var month = ("0" + (date.getMonth() + 1)).slice(-2);
 					var day = ("0" + date.getDate()).slice(-2);
 					var formattedDate = year + "-" + month + "-" + day;
 					document.getElementById("date").value = formattedDate;
 					var details = document.getElementById('details').value = data[0].details;
 					const selectElement = document.getElementById('type');
 					const selectValue = data[0].type;
 					selectElement.selectize.setValue(selectValue);

 					var qunatity = document.getElementById('quantity').value = data[0].quantity;
 					var unpolish_weight = document.getElementById('unpolish_weight').value = data[0].unpolish_weight;
 					var polish_weight = document.getElementById('polish_weight').value = data[0].polish_weight;
 					var manufacturer_rate = document.getElementById('manufacturer-rate').value = data[0].rate;
 					var wastage = document.getElementById('wastage').value = data[0].wastage;
 					var tValues = document.getElementById('tValues').value = data[0].tValues;
 					GetPolsherData(id);
 					GetStoneSetterData(id);

 				}
 			});
 		}

 		function GetPolsherData(id) {

 			$.ajax({
 				url: "functions.php",
 				type: "POST",
 				data: {
 					function: "GetPolisherData",
 					id: id
 				},
 				success: function(data) {
 					if (data !== "[]") {
 						data = JSON.parse(data);
 						var select_manufacturer = $('#select-polisher')[0].selectize;
 						select_manufacturer.setValue(data[0].vendor_id);
 						var dateString = data[0].date;
 						var date = new Date(dateString);
 						var year = date.getFullYear();
 						var month = ("0" + (date.getMonth() + 1)).slice(-2);
 						var day = ("0" + date.getDate()).slice(-2);
 						var formattedDate = year + "-" + month + "-" + day;
 						document.getElementById("p_date").value = formattedDate;
 						var details = document.getElementById('p_details').value = data[0].details;
 						var unpolish_weight = document.getElementById('unpolish_weight').value;
 						var polish_weight = document.getElementById('polish_weight').value;
 						var stepTwoDifference = document.getElementById('difference');
 						stepTwoDifference.value = unpolish_weight - polish_weight;
 						var poWas = document.getElementById('poWas')
 						if (stepTwoDifference === 0) {
 							poWas.value = 0;
 						} else {
 							(unpolish_weight / 1) / 96;
 						}

 					}
 				}
 			});
 		}

 		function GetStoneSetterData(id) {


 			$.ajax({
 				url: "functions.php",
 				type: "POST",
 				data: {
 					function: "GetStoneSetterData",
 					id: id
 				},
 				success: function(data) {
 					if (data !== "[]") {
 						data = JSON.parse(data);
 						var select_manufacturer = $('#select-stone_setter')[0].selectize;
 						select_manufacturer.setValue(data[0].vendor_id);
 						var dateString = data[0].date;
 						var date = new Date(dateString);
 						var year = date.getFullYear();
 						var month = ("0" + (date.getMonth() + 1)).slice(-2);
 						var day = ("0" + date.getDate()).slice(-2);
 						var formattedDate = year + "-" + month + "-" + day;
 						document.getElementById("s_date").value = formattedDate;
 						var details = document.getElementById('s_details').value = data[0].detail;
 						var stepIssueweight = document.getElementById('stepIssueweight').value = data[0].Issued_weight;
 						var zircon_total = document.getElementById('zircon_total').value = data[0].z_total_price;
 						var zircon_total_weight = document.getElementById('zircon_total_weight').value = data[0].z_total_weight;
 						var zircon_total_quantity = document.getElementById('zircon_total_quantity').value = data[0].z_total_quantity;
 						var stone_total = document.getElementById('stone_total').value = data[0].s_total_price;
 						var stone_total_weight = document.getElementById('stone_total_weight').value = data[0].s_total_weight;
 						var stone_total_quantity = document.getElementById('stone_total_quantity').value = data[0].s_total_quantity;
 						var grand_total = document.getElementById('grand_total').value = data[0].grand_total;
 						var received_weight = document.getElementById('received_weight').value = data[0].Received_weight;
 						var stone_received = document.getElementById('stone_received').value = data[0].Stone_received;
 						var Qty = document.getElementById('Qty').value = data[0].Qty;
 						var wastage1 = document.getElementById('wastage1').value = data[0].Wastage;
 						var Total = document.getElementById('Total').value = data[0].Total_valu;
 						var Payable = document.getElementById('Payable').value = data[0].Payable;
 						var selectElement = $('#select-stone_setter').selectize()[0].selectize;
 						var selectedValues = selectElement.getValue();

 						for (var i = 0; i < selectedValues.length; i++) {
 							var selectedValue = selectedValues[i];
 							var selectedOption = selectElement.options[selectedValue];
 							var selectedText = selectedOption.text;
 						}

 						$.ajax({
 							url: "functions.php",
 							method: "POST",
 							data: {
 								function: "GetStoneSetterRate",
 								column: selectedText,
 								id: code
 							},
 							success: function(response) {
 								var data = JSON.parse(response);
 								var s_rate = document.getElementById('s_rate').value = data[0]['18k'];
 							}
 						});
 					}
 					var polish_weight = document.getElementById('polish_weight');
 					var stepIssueweight = document.getElementById('stepIssueweight').value = polish_weight.value;
 				}
 			});

 			let input = document.getElementById('code');
 			var value = input.value;

 			$.ajax({
 				url: "functions.php",
 				type: "POST",
 				data: {
 					function: "GetZircons",
 					id: value

 				},
 				success: function(data) {
 					if (data !== "[]") {
 						data = JSON.parse(data);
 						var zircon_code = document.querySelector('input[name="zircon_code[]"]:first-of-type').value = data[0].id;
 						var zircon_weight = document.querySelector('input[name="zircon_weight[]"]:first-of-type').value = data[0].weight;
 						var zircon_quantity = document.querySelector('input[name="zircon_quantity[]"]:first-of-type').value = data[0].quantity;
 						for (var i = 1; i < data.length; i++) {
 							var area = document.getElementById('area');
 							var div = document.createElement('div');
 							div.setAttribute('class', 'row mb-4');
 							div.innerHTML = `<label for="horizontal-firstname-input" class="col-sm-1 col-form-label ps-5">Code:</label>
				<div class="col-sm-3">

					<input type="text" name="zircon_code[]" id="zircon_code[]" value="${data[0].id}" class="form-control" placeholder="Zircon" required>
				</div>
				<label for="horizontal-firstname-input" class="col-sm-1 col-form-label ps-5">Weight:</label>
				<div class="col-sm-2">

					<input type="text" name="zircon_weight[]" id="zircon_weight[]" value="${data[0].weight}" class="form-control" placeholder="Zircon" required>
				</div>
				<label for="horizontal-firstname-input" class="col-sm-1 col-form-label ps-5">Quantity:</label>
				<div class="col-sm-2">

					<input type="text" name="zircon_quantity[]" id="zircon_quantity[]" value="${data[0].quantity}" class="form-control" placeholder="Zircon" required>
				</div>
				<div class="col-sm-2">

					<i class="delete-zircon fa fa-minus-circle p-2"></i>
				</div>`;
 							area.appendChild(div);
 						}
 					}
 				}
 			});

 			$.ajax({
 				url: "functions.php",
 				type: "POST",
 				data: {
 					function: "GetStones",
 					id: value

 				},
 				success: function(data) {
 					if (data !== "[]") {
 						data = JSON.parse(data);
 						var stone_code = document.querySelector('input[name="stone_code[]"]:first-of-type').value = data[0].id;
 						var stone_weight = document.querySelector('input[name="stone_weight[]"]:first-of-type').value = data[0].weight;
 						var stone_quantity = document.querySelector('input[name="stone_quantity[]"]:first-of-type').value = data[0].quantity;
 						for (var i = 1; i < data.length; i++) {
 							var area2 = document.getElementById('area2');
 							var div2 = document.createElement('div');
 							div2.setAttribute('class', 'row mb-4');
 							div2.innerHTML = `<label for="horizontal-firstname-input" class="col-sm-1 col-form-label ps-5">Code:</label>
									<div class="col-sm-3">

										<input type="text" name="stone_code[]" id="stone_code[]" value="${data[0].id}" class="form-control" placeholder="Stone Code" required>
									</div>
									<label for="horizontal-firstname-input" class="col-sm-1 col-form-label ps-5">Weight:</label>
									<div class="col-sm-2">

										<input type="text" name="stone_weight[]" id="stone_weight[]" value="${data[0].weight}" class="form-control" placeholder="Stone Weight" required>
									</div>
									<label for="horizontal-firstname-input" class="col-sm-1 col-form-label ps-5">Quantity:</label>
									<div class="col-sm-2">

										<input type="text" name="stone_quantity[]" id="stone_quantity[]" value="${data[0].quantity}" class="form-control" placeholder="Zircon" required>
									</div>
									<div class="col-sm-2">

										<i class="delete-stone fa fa-minus-circle p-2"></i>
									</div>`;
 							area2.appendChild(div2);
 							var stone_weight = document.querySelectorAll('input[id="stone_weight[]"]');
 							var stone_quantity = document.querySelectorAll('input[id="stone_quantity[]"]');
 							stone_quantity.forEach(function(input) {
 								input.addEventListener('input', StoneQuantity);
 							})
 							stone_weight.forEach(function(input) {
 								input.addEventListener('input', StoneWeight);
 							})
 						}
 					}
 				}
 			});

 		}

 		function CalculateWastage() {
 			var manufacturer_rate = parseFloat(document.getElementById('manufacturer-rate').value);
 			var unpolish_weight = parseFloat(document.getElementById('unpolish_weight').value);
 			if (!isNaN(manufacturer_rate) && !isNaN(unpolish_weight)) {
 				var wastage = unpolish_weight * manufacturer_rate / 96;
 				wastage = parseFloat(wastage.toFixed(3));
 				document.getElementById('wastage').value = wastage;
 			}
 			var selectElement = $('#select-manufacturer-purity').selectize()[0].selectize;
 			var selectedValues = selectElement.getValue();

 			for (var i = 0; i < selectedValues.length; i++) {
 				var selectedValue = selectedValues[i];
 				var selectedOption = selectElement.options[selectedValue];
 				var selectedText = selectedOption.text;
 			}
 			if (selectedText == '18k') {
 				var tValues = document.getElementById('tValues');
 				var total = (unpolish_weight + wastage) * 0.75;
 				tValues.value = total.toFixed(3);
 			} else if (selectedText == '21k') {
 				var tValues = document.getElementById('tValues');
 				tValues.value = (unpolish_weight + wastage) * 0.875;
 			} else if (selectedText == '22k') {
 				var tValues = document.getElementById('tValues');
 				tValues.value = (unpolish_weight + wastage) * 0.916;
 			}
 			CalculateDifference()


 		}

 		function DeleteProduct() {
 			const mySelect = $('#select-product')[0].selectize;

 			// Get the selected value
 			const selectedValue = mySelect.getValue();
 			if (selectedValue == '') {
 				alert('Please Select Product');
 			} else {
 				$.ajax({
 					url: "functions.php",
 					method: "POST",
 					data: {
 						function: "DeleteProduct",
 						id: selectedValue
 					},
 					success: function(response) {
 						var data = JSON.parse(response);
 						if (data.status == 'success') {
 							location.reload();
 						}
 					}
 				});
 			}
 		}

 		function GrandTotal() {
 			var zircon_total = parseFloat(document.getElementById('zircon_total').value);
 			if (isNaN(zircon_total)) {
 				zircon_total = 0;
 			}
 			var stone_total = parseFloat(document.getElementById('stone_total').value);
 			if (isNaN(stone_total)) {
 				stone_total = 0;
 			}
 			var total = zircon_total + stone_total;
 			document.getElementById('grand_total').value = total;

 		}

 		function ZirconQuantity() {
 			var zircon_quantity = document.querySelectorAll('input[id="zircon_quantity[]"]');
 			var total = 0;
 			zircon_quantity.forEach(function(input) {
 				if (input.value) {
 					total += parseFloat(input.value);
 				}
 				document.getElementById('zircon_total_quantity').value = total;

 			});
 		}

 		function ZirconWeight() {
 			var zircon_weight = document.querySelectorAll('input[id="zircon_weight[]"]');
 			total = 0;
 			zircon_weight.forEach(function(input) {
 				if (input.value) {
 					total += parseFloat(input.value);
 				}
 				document.getElementById('zircon_total_weight').value = total;
 			});

 		}

 		function StoneQuantity() {
 			var stone_quantity = document.querySelectorAll('input[id="stone_quantity[]"]');
 			var total = 0;
 			stone_quantity.forEach(function(input) {
 				if (input.value) {
 					total += parseFloat(input.value);
 				}
 				document.getElementById('stone_total_quantity').value = total;

 			});
 		}

 		function StoneWeight() {
 			var stone_weight = document.querySelectorAll('input[id="stone_weight[]"]');
 			total = 0;
 			stone_weight.forEach(function(input) {
 				if (input.value) {
 					total += parseFloat(input.value);
 				}
 				document.getElementById('stone_total_weight').value = total;
 			});

 		}

 		function CalculatePayable() {

 			var total_weight_issue = parseFloat($(document).find('#total-weight-issue').val());
 			var received_weight = parseFloat($(document).find('#received_weight').val());
 			var stone_received = parseFloat($(document).find('#stone_received').val());
 			var wastage = parseFloat($(document).find('#wastage1').val());
 			if (total_weight_issue !== "" && received_weight !== "" && stone_received !== "" && wastage !== "") {


 				var total = received_weight + stone_received + wastage;
 				$(document).find('#Total').val(total);
 				var payable = (total_weight_issue - total).toFixed(2);
 				$(document).find('#Payable').val(payable);
 			}
 		}

 		function CalculateTotal() {
 			var stepIssueweight = parseFloat($(document).find('#stepIssueweight').val());
 			var Zircon = parseFloat($(document).find('#Zircon').val());
 			var stone_weight = parseFloat($(document).find('#stone_weight').val());
 			if (stepIssueweight != '' && Zircon != '' && stone_weight != '') {
 				var total = (stepIssueweight + Zircon + stone_weight).toFixed(2);
 				$(document).find('#total-weight-issue').val(total);
 			}
 		}

 		function AddStone() {
 			var area2 = document.getElementById('area2');
 			var div2 = document.createElement('div');
 			div2.setAttribute('class', 'row mb-4');
 			div2.innerHTML = `<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Code:</label>
									<div class="col-sm-2">

									<input type="text" name="stone_code[]" id="stone_code[]" value="" class="form-control" placeholder="Stone Code" required>

									</div>
									<div class="col-sm-1 p-0">
									<i class="fa fa-barcode fa-3x" onclick="BarCode(this)"></i>
									</div>
									<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Weight:</label>
									<div class="col-sm-2">

										<input type="text" name="stone_weight[]" id="stone_weight[]" value="" class="form-control" placeholder="Stone Weight" required>
									</div>
									<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Quantity:</label>
									<div class="col-sm-2">

										<input type="text" name="stone_quantity[]" id="stone_quantity[]" value="" class="form-control" placeholder="Zircon" required>
									</div>
									<div class="col-sm-2">

										<i class="delete-stone fa fa-minus-circle p-2"></i>
									</div>`;
 			area2.appendChild(div2);
 			var stone_weight = document.querySelectorAll('input[id="stone_weight[]"]');
 			var stone_quantity = document.querySelectorAll('input[id="stone_quantity[]"]');
 			stone_quantity.forEach(function(input) {
 				input.addEventListener('input', StoneQuantity);
 			})
 			stone_weight.forEach(function(input) {
 				input.addEventListener('input', StoneWeight);
 			})

 		}

 		function Add() {
 			area = document.getElementById('area');
 			var div = document.createElement('div');
 			div.setAttribute('class', 'row mb-4');
 			div.innerHTML = `<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Code:</label>
				<div class="col-sm-2">

					<input type="text" name="zircon_code[]" id="zircon_code[]" value="" class="form-control" placeholder="Zircon" required>
				</div>
				<div class="col-sm-1 p-0">
				<i class="fa fa-barcode fa-3x" onclick="BarCode(this)"></i>
				</div>
				<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Weight:</label>
				<div class="col-sm-2">

					<input type="text" name="zircon_weight[]" id="zircon_weight[]" value="" class="form-control" placeholder="Zircon" required>
				</div>
				<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Quantity:</label>
				<div class="col-sm-2">

					<input type="text" name="zircon_quantity[]" id="zircon_quantity[]" value="" class="form-control" placeholder="Zircon" required>
				</div>
				<div class="col-sm-2">

					<i class="delete-zircon fa fa-minus-circle p-2"></i>
				</div>`;
 			area.appendChild(div);
 			var zircon_weight = document.querySelectorAll('input[id="zircon_weight[]"]');
 			var zircon_quantity = document.querySelectorAll('input[id="zircon_quantity[]"]');
 			zircon_quantity.forEach(function(input) {
 				input.addEventListener('input', ZirconQuantity);
 			})
 			zircon_weight.forEach(function(input) {
 				input.addEventListener('input', ZirconWeight);
 			})

 		}

 		function CalculateDifference() {
 			var unpolished_weight = parseFloat($(document).find('#unpolish_weight').val());
 			var polished_weight = parseFloat($(document).find('#polish_weight').val());
 			var stepIssueweight = document.getElementById('stepIssueweight').value = polished_weight;
 			if (unpolished_weight != '' && polished_weight != '') {
 				var difference = (unpolished_weight - polished_weight).toFixed(2);
 				if (difference == 0) {
 					console.log('disabled');
 					var polisher_save_btn = document.getElementById('polisher_save_btn');
 					var polisher_print_btn = document.getElementById('polisher_print_btn');
 					polisher_print_btn.disabled = true;
 					polisher_save_btn.disabled = true;
 				}
 				$(document).find('#difference').val(difference);
 			}

 		}

 		function CalculatePolisherWastage() {
 			var code = $('#select-polisher').selectize()[0].selectize
 			var code = code.getValue();
 			var selectElement = $('#select-manufacturer-purity').selectize()[0].selectize;
 			var selectedValues = selectElement.getValue();

 			for (var i = 0; i < selectedValues.length; i++) {
 				var selectedValue = selectedValues[i];
 				var selectedOption = selectElement.options[selectedValue];
 				var selectedText = selectedOption.text;
 			}

 			$.ajax({
 				url: "functions.php",
 				method: "POST",
 				data: {
 					function: "GetPolisherRate",
 					column: selectedText,
 					id: code
 				},
 				success: function(response) {
 					var data = JSON.parse(response);
 					var difference = document.getElementById('difference').value;
 					if (selectedText == '18k') {
 						var p_rate = document.getElementById('p_rate').value = data[0]['18k'];
 					} else if (selectedText == '21k') {
 						var p_rate = document.getElementById('p_rate').value = data[0]['21k'];
 					} else if (selectedText == '22k') {
 						var p_rate = document.getElementById('p_rate').value = data[0]['22k'];
 					}
 					var poWas = document.getElementById('poWas');
 					var payable = document.getElementById('payable');
 					if (difference == 0) {
 						poWas.value = 0;
 					} else {
 						poWas.value = ((difference / p_rate) / 96).toFixed(2);
 					}
 					payable.value = (difference - poWas.value).toFixed(2);
 				}
 			});
 		}

 		function CalculateNewPayable(rate) {
 			var difference = document.getElementById('difference').value;
 			var poWas = document.getElementById('poWas');
 			var payable = document.getElementById('payable');
 			if (difference == 0) {
 				poWas.value = 0;
 			} else {
 				poWas.value = ((difference / rate) / 96).toFixed(2);
 			}
 			payable.value = (difference - poWas.value).toFixed(2);

 		}

 		function GetDate() {
 			var date = new Date().toISOString().slice(0, 10);
 			var dataInputs = document.querySelectorAll('input[type="date"]');
 			for (let i = 0; i < dataInputs.length; i++) {
 				dataInputs[i].value = date;
 			}
 		}

 		image.onchange = evt => {
 			const [file] = image.files
 			if (file) {
 				preview.src = URL.createObjectURL(file);
 				$('#preview').css("display", "block");
 			}
 		}

 		$(document).on('submit', '#stepone', function(e) {
 			e.preventDefault();
 			var form = new FormData(this);
 			form.append('function', 'StepOne');
 			$.ajax({
 				url: "functions.php",
 				type: "POST",
 				data: form,
 				contentType: false,
 				processData: false,
 				success: function(data) {}
 			});

 		})

 		$(document).on('submit', '#steptwo', function(e) {
 			e.preventDefault();
 			var form = new FormData(this);
 			form.append('function', 'StepTwo');
 			$.ajax({
 				url: "functions.php",
 				type: "POST",
 				data: form,
 				contentType: false,
 				processData: false,
 				success: function(data) {}
 			});

 		})

 		$(document).on('submit', '#stepthree', function(e) {
 			e.preventDefault();
 			var form = new FormData(this);
 			form.append('function', 'StepThree');
 			$.ajax({
 				url: "functions.php",
 				type: "POST",
 				data: form,
 				contentType: false,
 				processData: false,
 				success: function(data) {}
 			});

 		})

 		$(document).on('click', '.delete-stone', function() {
 			$(this).parent().parent().remove();
 			StoneQuantity();
 			StoneWeight();
 		});

 		$(document).on('click', '.delete-zircon', function() {
 			$(this).parent().parent().remove();
 			ZirconQuantity();
 			ZirconWeight();
 		});

 		$(document).ready(function() {
 			var zircon_weight = document.querySelectorAll('input[id="zircon_weight[]"]');
 			var zircon_quantity = document.querySelectorAll('input[id="zircon_quantity[]"]');
 			var stone_weight = document.querySelectorAll('input[id="stone_weight[]"]');
 			var stone_quantity = document.querySelectorAll('input[id="stone_quantity[]"]');
 			stone_quantity.forEach(function(input) {
 				input.addEventListener('input', StoneQuantity);
 			})
 			stone_weight.forEach(function(input) {
 				input.addEventListener('input', StoneWeight);
 			})
 			zircon_quantity.forEach(function(input) {
 				input.addEventListener('input', ZirconQuantity);
 			})
 			zircon_weight.forEach(function(input) {
 				input.addEventListener('input', ZirconWeight);
 			})

 			$('select').selectize({
 				sortField: 'text'
 			});

 			$.ajax({
 				url: "functions.php",
 				method: "POST",
 				data: {
 					function: "GetAllVendorData",
 					type: "manufacturer"
 				},
 				success: function(response) {
 					var data = JSON.parse(response);
 					var select = $('#select-manufacturer')[0].selectize;
 					for (var i = 0; i < data.length; i++) {
 						var newOption = {
 							value: data[i].id,
 							text: data[i].id + " | " + data[i].name
 						};
 						select.addOption(newOption);
 					}

 				}
 			});

 			$.ajax({
 				url: "functions.php",
 				method: "POST",
 				data: {
 					function: "GetAllVendorData",
 					type: "polisher"
 				},
 				success: function(response) {
 					var data = JSON.parse(response);
 					var select = $('#select-polisher')[0].selectize;
 					for (var i = 0; i < data.length; i++) {
 						var newOption = {
 							value: data[i].id,
 							text: data[i].id + " | " + data[i].name
 						};
 						select.addOption(newOption);
 					}

 				}
 			});

 			$.ajax({
 				url: "functions.php",
 				method: "POST",
 				data: {
 					function: "GetAllVendorData",
 					type: "stone setter"
 				},
 				success: function(response) {
 					var data = JSON.parse(response);
 					var select = $('#select-stone_setter')[0].selectize;
 					for (var i = 0; i < data.length; i++) {
 						var newOption = {
 							value: data[i].id,
 							text: data[i].id + " | " + data[i].name
 						};
 						select.addOption(newOption);
 					}

 				}
 			});

 			$.ajax({
 				url: "functions.php",
 				method: "POST",
 				data: {
 					function: "GetAllVendorData",
 					type: "vendor"
 				},
 				success: function(response) {
 					var data = JSON.parse(response);
 					var select = $('#select-vendor')[0].selectize;
 					for (var i = 0; i < data.length; i++) {
 						var newOption = {
 							value: data[i].id,
 							text: data[i].id + " | " + data[i].name
 						};
 						select.addOption(newOption);
 					}

 				}
 			});

 			$.ajax({
 				url: "functions.php",
 				method: "POST",
 				data: {
 					function: "GetAllProduct"
 				},
 				success: function(response) {
 					var data = JSON.parse(response);
 					var select = $('#select-product')[0].selectize;
 					for (var i = 0; i < data.length; i++) {
 						var newOption = {
 							value: data[i].id,
 							text: data[i].id
 						};
 						select.addOption(newOption);
 					}

 				}
 			});
 		});

 		$(document).on('change', '#select-product', function(e) {
 			e.preventDefault();
 			const inputs = document.querySelectorAll('input');
 			const selects = document.querySelectorAll('select');
 			const textareas = document.querySelectorAll('textarea');

 			inputs.forEach(input => input.value = '');
 			textareas.forEach(textarea => textarea.value = '');
 			const selectToKeep = 'select-product';
 			const selects1 = document.querySelectorAll('select');

 			selects1.forEach(select => {
 				if (select.id !== selectToKeep && !select.classList.contains(selectToKeep)) {
 					select.selectize.clear(); // clear the selectize value
 				}
 			});
 			GetDate();
 			GetManufacturerData($(this).val());

 		})

 		$(document).on('change', '#select-manufacturer', function(e) {
 			e.preventDefault();
 			var select = $('#select-product').selectize(); // initialize Selectize.js on your select input
 			var selectize = select[0].selectize; // get the Selectize.js instance

 			if (selectize.items.length <= 0) {
 				var select1 = $(this).val();
 				code = document.getElementsByClassName("code")
 				$.ajax({
 					url: "functions.php",
 					method: "POST",
 					data: {
 						function: "ProductCount",
 					},
 					success: function(response) {
 						var data = JSON.parse(response);
 						for (var i = 0; i < code.length; i++) {
 							code[i].value = select1 + data[0];
 						}
 					}
 				});


 				var select_manufacturer_purity = $('#select-manufacturer-purity')[0].selectize;
 				$.ajax({
 					url: "functions.php",
 					method: "POST",
 					data: {
 						function: "GetVendor",
 						id: select1
 					},
 					success: function(response) {
 						var data = JSON.parse(response);
 						for (var i = 0; i < data.length; i++) {
 							var newOption = {
 								value: data[i]['18k'],
 								text: "18k"
 							};
 							var newOption1 = {
 								value: data[i]['21k'],
 								text: "21k"
 							};
 							var newOption2 = {
 								value: data[i]['22k'],
 								text: "22k"
 							};
 							select_manufacturer_purity.addOption(newOption);
 							select_manufacturer_purity.addOption(newOption1);
 							select_manufacturer_purity.addOption(newOption2);
 						}

 					}
 				});
 			}
 		});

 		$(document).on('change', '#select-polisher', function(e) {
 			e.preventDefault();
 			CalculatePolisherWastage();
 		});

 		$(document).on('change', '#select-manufacturer-purity', function(e) {
 			e.preventDefault();
 			var manufacturer_rate = document.getElementById('manufacturer-rate');
 			manufacturer_rate.value = this.value;
 			CalculateWastage();
 		});

 		$(document).on('change', '#select-polisher-purity', function(e) {
 			e.preventDefault();
 			var polisher_rate = document.getElementById('polisher-rate');
 			polisher_rate.value = this.value;
 		});

 		$(document).on('input', '#rate', function(e) {
 			e.preventDefault();
 			var constantValue = 96;
 			var rFlowValue = parseInt($(this).val());
 			var upEmail = parseFloat($(document).find('#unpolish_weight').val());
 			var pValues = [];
 			$.each($("#pValue option:selected"), function() {
 				pValues.push($(this).val());
 			});
 			var sPValue = pValues[0];

 			if (isNaN(upEmail)) {
 				alert('Please Insert The unpolish_weight Value');
 				$(document).find('#rate').val('');
 				return false;
 			} else {


 				var wtgValue = (upEmail * rFlowValue / constantValue).toFixed(2);

 				$(document).find('#wastage').val(wtgValue);

 				var wtgValue1 = wtgValue = (upEmail * rFlowValue / constantValue);

 				var rr = parseFloat(upEmail + wtgValue1).toFixed(2);

 				var rr2 = parseFloat(sPValue).toFixed(2);

 				//var rr3=parseFloat(wtgValue).toFixed(2);
 				//var rr3 = parseFloat(sPValue).toFixed(2);


 				var tValues = (rr * sPValue).toFixed(2);

 				$(document).find('#tValues').val(tValues);


 			}
 		});

 		$(document).on('change', '#stepTwoCode', function(e) {
 			e.preventDefault();
 			$.ajax({
 				url: "external-work-db.php?ajax=getData",
 				method: "POST",
 				data: {
 					code: $(this).val()
 				},
 				success: function(response) {
 					var data = JSON.parse(response);
 					var name = data[0].name;
 					var upEmail = parseFloat(data[0].unpolish_weight, 10);
 					var pemail = parseFloat(data[0].polish_weight, 10);
 					var constantValue = 96;
 					var difference = (upEmail - pemail);
 					var poWas = (upEmail / 1);


 					polisherWastage = (poWas / constantValue).toFixed(0);

 					var psEmail = (difference - polisherWastage);

 					$(document).find('#stepTwoName').val(name);
 					$(document).find('#stepTwoDifference').val(difference);
 					$(document).find('#poWas').val(polisherWastage);
 					$(document).find('#psEmail').val(psEmail);




 				},
 				error: function(xhr, status) {
 					alert("Sorry, there was a problem!");
 				},
 				complete: function(xhr, status) {
 					//$('#showresults').slideDown('slow')
 				}
 			})
 		});

 		$(document).ready(function() {
 			GetDate();
 		});

 		$(document).on('input', '#Zircon', function(e) {
 			e.preventDefault();
 			CalculateTotal();
 		});

 		$(document).on('input', '#stone_weight', function(e) {
 			e.preventDefault();
 			CalculateTotal();
 		});

 		$(document).on('input', '#received_weight', function(e) {
 			e.preventDefault();
 			CalculatePayable();
 		});

 		$(document).on('input', '#stone_received', function(e) {
 			e.preventDefault();
 			CalculatePayable();
 		});

 		$(document).on('input', '#wastage1', function(e) {
 			e.preventDefault();
 			CalculatePayable();
 		});

 		$(document).on('change', '#stepThreeCode', function(e) {
 			e.preventDefault();
 			$.ajax({
 				url: "external-work-db.php?ajax=getData",
 				method: "POST",
 				data: {
 					code: $(this).val()
 				},
 				success: function(response) {
 					var data = JSON.parse(response);
 					var name = data[0].name;
 					var constantwestage = 0.0035;
 					var upEmail = parseFloat(data[0].unpolish_weight, 10);
 					var pemail = parseFloat(data[0].polish_weight, 10);

 					var Zircon = parseFloat($(document).find('#Zircon').val());
 					var stone_weight = parseFloat($(document).find('#stone_weight').val());
 					var totalweightissue = (pemail + Zircon + stone_weight).toFixed(2);


 					var received_weight = parseFloat($(document).find('#received_weight').val());
 					var stone_received = parseFloat($(document).find('#stone_received').val());
 					var Qty = parseFloat($(document).find('#Qty').val());

 					var wastageqty = (Qty * constantwestage).toFixed(2);



 					$(document).find('#stepThreeName').val(name);
 					$(document).find('#stepIssueweight').val(pemail);
 					$(document).find('#total-weight-issue').val(totalweightissue);

 					$(document).find('#wastage1').val(wastageqty);





 				},
 				error: function(xhr, status) {
 					alert("Sorry, there was a problem!");
 				},
 				complete: function(xhr, status) {
 					//$('#showresults').slideDown('slow')
 				}
 			})

 		});

 		var zircon_total = document.getElementById('zircon_total');
 		var stone_total = document.getElementById('stone_total');
 		var select_manufacturer_purity = document.getElementById('select-manufacturer-purity');
 		var select_polisher_purity = document.getElementById('select-polisher-purity');
 		var unpolish_weight = document.getElementById('unpolish_weight');
 		var polish_weight = document.getElementById('polish_weight');
 		var p_rate = document.getElementById('p_rate');

 		zircon_total.addEventListener('change', GrandTotal);
 		stone_total.addEventListener('change', GrandTotal);
 		unpolish_weight.addEventListener('change', CalculateWastage);
 		unpolish_weight.addEventListener('change', CalculateDifference);
 		polish_weight.addEventListener('change', CalculateDifference);
 		p_rate.addEventListener('change', function() {
 			CalculateNewPayable($(this).val());
 		});
 	</script>













 	<script type="text/javascript">
 		var i = 0;

 		$("#add").click(function() {

 			++i;

 			$("#dynamicTable").append('<tr><td><select required=""name="addmore[' + i + '][name]" class="form-control form-select"><option value="">Select Stone</option><option value="wr">Rubi</option></select></td><td><input type="text" name="addmore[' + i + '][stone_weight]" placeholder="Stone Weight" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
 		});

 		$(document).on('click', '.remove-tr', function() {
 			$(this).parents('tr').remove();
 		});
 	</script>

 	<script type="text/javascript">
 		var i = 0;

 		$("#return").click(function() {

 			++i;

 			$("#returnTable").append('<tr><td><select required=""name="addmore[' + i + '][type]" class="form-control form-select"><option value="">Select Type</option><option value="wr">Rubi</option></select></td><td><input type="text" name="addmore[' + i + '][weight]" placeholder="Weight" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
 		});

 		$(document).on('click', '.remove-tr', function() {
 			$(this).parents('tr').remove();
 		});
 	</script>






 	<script type="text/javascript">
 		var i = 0;

 		$("#additional").click(function() {

 			++i;

 			$("#additionalTable").append('<tr><td><input type="text" name="addmore[' + i + '][date]" placeholder="Date" class="form-control" /></td><td><input type="text" name="addmore[' + i + '][name]" placeholder="Name" class="form-control" /></td><td><input type="text" name="addmore[' + i + '][name]" placeholder="Type" class="form-control" /></td><td><input type="text" name="addmore[' + i + '][amount]" placeholder="Amount" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
 		});

 		$(document).on('click', '.remove-tr', function() {
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