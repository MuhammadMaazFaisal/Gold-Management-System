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
 						<div class="col-sm-2">
 							<input type="text" class="form-control" id="product" name="product" placeholder="Product ID" value="">

 						</div>
 						<div class="col d-flex justify-content-end me-4">
 							<button type="button" onclick="DeleteProduct()" class="btn btn-danger me-3" id="delete-product" disabled>Delete Product</button>
 							<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#product-modal">
 								Select Product
 							</button>
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
 																			<button type="button" class="btn btn-success waves-effect waves-light" onclick="PrintManufacturer()">Print</button>
 																			<button type="submit" class="btn btn-primary" id="m_save" value="Save">Save</button>
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

 												<div class="col-lg-12 ms-lg-auto ">

 													<div class="mb-2 d-flex justify-content-end" style="margin-top: -30px;">
 														<button type="button" class="btn btn-primary" onclick="AddStoneSetter()">
 															Add Stone Setter
 														</button>
 													</div>
 													<div id="stone-setter-area" class="mt-4 mt-lg-0">


 														<form id="stepthree" method="POST" enctype="multipart/form-data">
 															<?php

																$randomstone = random_int(0000000000, 779900000000);
																echo "<input type='hidden' name='stonebarcode' value='$randomstone' class='form-control'>";
																?>

 															<div class="row mb-4">
 																<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Name:</label>
 																<div class="col-sm-5">

 																	<select id="select-stone_setter[]" name="vendor[]" placeholder="Pick a stone setter..." required>
 																		<option value="">Select a stone setter...</option>

 																	</select>
 																</div>


 																<label for="horizontal-firstname-input" class="bar-code col-sm-1 col-form-label d-flex justify-content-end">Bar Code:</label>

 																<div class="col-sm-5">


 																	<input type="text" name="code[]" value="" class="form-control code" placeholder="code" readonly>

 																</div>

 															</div>
 															<div class="row mb-4">

 																<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Date:</label>
 																<div class="col-sm-5">

 																	<input type="date" name="date[]" id="s_date" class="form-control" placeholder="Date">
 																</div>

 																<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Image Upload:</label>
 																<div class="col-sm-5">

 																	<input type="file" id="image[]" name="image[]" value="" class="form-control" accept="image/*">
 																</div>
 															</div>
 															<div class="row mb-4">
 																<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Details:</label>
 																<div class="col-sm-11">

 																	<textarea type="text" name="detail[]" id="s_details[]" class="form-control" style="height: 107px;" placeholder="Details"></textarea>
 																</div>
 															</div>
 															<div class="row mb-4">
 																<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Total Weight:</label>
 																<div class="col-sm-3">

 																	<input type="number" step="any" name="s_total_weight[]" id="s_total_weight[]" class="form-control" placeholder="Total Weight" readonly>
 																</div>
 																<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">- Retained Weight:</label>
 																<div class="col-sm-3">

 																	<input type="number" step="any" name="retained_weight[]" id="retained_weight[]" class="form-control" placeholder="Retained Weight">
 																</div>
 																<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">= Issued Weight:</label>
 																<div class="col-sm-3">

 																	<input type="number" step="any" name="Issued_weight[]" id="stepIssueweight[]" class="form-control" placeholder="Issued Weight" readonly>
 																</div>
 															</div>
 															<div class="row mb-4">
 																<h5>Zircon:</h6>
 																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label  d-flex justify-content-end">Code:</label>
 																	<div class="col-sm-2">
 																		<select name="zircon_code[]" id="zircon_code[]" value="" class="form-control" placeholder="Zircon">
 																			<option value="">Select a zircon...</option>

 																		</select>

 																	</div>
 																	<div class="col-sm-1 p-0">
 																		<i class="fa fa-barcode fa-3x" onclick="BarCode(this)"></i>
 																	</div>
 																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label  d-flex justify-content-end">Weight:</label>
 																	<div class="col-sm-2">

 																		<input type="number" step="any" name="zircon_weight[]" id="zircon_weight[]" value="" class="form-control" placeholder="Zircon">
 																	</div>
 																	<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Quantity:</label>
 																	<div class="col-sm-2">

 																		<input type="number" name="zircon_quantity[]" id="zircon_quantity[]" value="" class="form-control" placeholder="Zircon">
 																	</div>
 																	<div class="col-sm-2">

 																		<i onclick="Add(this)" class="fa fa-plus-circle p-2"></i>
 																	</div>
 															</div>
 															<div id="area">

 															</div>
 															<div class="row mb-4">
 																<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Total Weight:</label>
 																<div class="col-sm-2">

 																	<input type="number" step="any" name="zircon_total_weight[]" value="" id="zircon_total_weight[]" class="form-control form-control card bg-dark border-dark text-light" placeholder="Total">
 																</div>
 																<div class="col-sm-1"></div>
 																<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Total Quantity:</label>
 																<div class="col-sm-2">

 																	<input type="number" name="zircon_total_quantity[]" value="" id="zircon_total_quantity[]" class="form-control form-control card bg-dark border-dark text-light" placeholder="Total">
 																</div>
 																<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-none">Total Price:</label>
 																<div class="col-sm-3">

 																	<input type="number" step="any" name="zircon_total[]" value="" id="zircon_total[]" class="d-none form-control form-control card bg-dark border-dark text-light" placeholder="Total">
 																</div>
 															</div>
 															<div class="row mb-4">
 																<h5>Stone:</h5>
 																<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Code:</label>
 																<div class="col-sm-2">


 																	<select name="stone_code[]" id="stone_code[]" value="" class="form-control" placeholder="Stone Code">
 																		<option value="">Select a stone...</option>

 																	</select>

 																</div>
 																<div class="col-sm-1 p-0">
 																	<i class="fa fa-barcode fa-3x" onclick="BarCode(this)"></i>
 																</div>
 																<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Weight:</label>
 																<div class="col-sm-2">

 																	<input type="number" step="any" name="stone_weight[]" id="stone_weight[]" value="" class="form-control" placeholder="Stone Weight">
 																</div>
 																<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Quantity:</label>
 																<div class="col-sm-2">

 																	<input type="number" name="stone_quantity[]" id="stone_quantity[]" value="" class="form-control" placeholder="Stone Quantity">
 																</div>
 																<div class="col-sm-2">

 																	<i onclick="AddStone(this)" class="fa fa-plus-circle p-2"></i>
 																</div>


 															</div>
 															<div id="area2">

 															</div>
 															<div class="row mb-4">
 																<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Total Weight:</label>
 																<div class="col-sm-2">

 																	<input type="number" step="any" name="stone_total_weight[]" value="" id="stone_total_weight[]" class="form-control form-control card bg-dark border-dark text-light" placeholder="Total">
 																</div>
 																<div class="col-sm-1"></div>
 																<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Total Quantity:</label>
 																<div class="col-sm-2">

 																	<input type="number" name="stone_total_quantity[]" value="" id="stone_total_quantity[]" class="form-control form-control card bg-dark border-dark text-light" placeholder="Total">
 																</div>
 																<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-none">Total Price:</label>
 																<div class="col-sm-3">

 																	<input type="number" step="any" name="stone_total[]" value="" id="stone_total[]" class="d-none form-control form-control card bg-dark border-dark text-light" placeholder="Total">
 																</div>
 															</div>
 															<div class="row mb-4">
 																<label for="horizontal-firstname-input" class="col-sm-1 col-form-label ">Grand Total Weight:</label>
 																<div class="col-sm-3">

 																	<input type="number" step="any" name="grand_total_weight[]" value="" id="grand_total_weight[]" class=" form-control form-control card bg-dark border-dark text-light" placeholder="Total">
 																</div>
 															</div>
 															<div class="row mb-4">
 																<h5 class="d-none">Grand Total:</h5>
 																<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-none">Total Price:</label>
 																<div class="col-sm-3">

 																	<input type="number" step="any" name="grand_total[]" value="" id="grand_total[]" class="d-none form-control form-control card bg-dark border-dark text-light" placeholder="Total">
 																</div>
 															</div>

 															<hr />
 															<div class="row justify-content-end mb-3">
 																<div class="col-sm-9">

 																	<div>
 																		<button type="" class="btn btn-success waves-effect waves-light">Print</button>
 																		<button type="submit" class="btn btn-primary" id="s_save">Save</button>
 																	</div>
 																</div>
 															</div>
 														</form>



 														<form id="r_stepthree" method="POST" enctype="multipart/form-data">

 															<div class="row">
 																<label for="received_weight">Recieved Weight:</label>
 																<div class="col-sm-4 mb-4">
 																	<input type="number" step="any" name="received_weight" value="" id="received_weight" class="form-control" placeholder="Received weight">
 																</div>
 																<div id="returned-area[]" class="row">
 																	<h5>Zircon/Stone Return:</h5>
 																	<div class="row mb-4"><label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Code:</label>
 																		<div class="col-sm-2">

 																			<input type="text" name="r_code[]" id="r_code[]" value="" class="form-control" placeholder="Code">

 																		</div>
 																		<div class="col-sm-1 p-0">
 																			<i class="fa fa-barcode fa-3x" onclick="BarCode(this)"></i>
 																		</div>
 																		<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Weight:</label>
 																		<div class="col-sm-2">

 																			<input type="number" step="any" name="r_weight[]" id="r_weight[]" value="" class="form-control" placeholder="Weight">
 																		</div>
 																		<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Quantity:</label>
 																		<div class="col-sm-2">

 																			<input type="number" name="r_quantity[]" id="r_quantity[]" value="" class="form-control" placeholder="Quantity">
 																		</div>
 																		<div class="col-sm-2">

 																			<i class="fa fa-plus-circle p-2" onclick="AddReturned(this)"></i>
 																		</div>
 																	</div>
 																</div>
 															</div>
 															<div class="row">
 																<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Stone Weight:</label>
 																<div class="col-sm-3">

 																	<input type="number" step="any" name="r_stone_weight" value="" id="r_stone_weight" class="form-control form-control card bg-dark border-dark text-light" placeholder="Total">
 																</div>
 																<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Stone Quantity:</label>
 																<div class="col-sm-3">

 																	<input type="number" name="r_stone_quantity" value="" id="r_stone_quantity" class="form-control form-control card bg-dark border-dark text-light" placeholder="Total">
 																</div>
 															</div>
 															<div class="row mb-4">
 																<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Total Weight Return:</label>
 																<div class="col-sm-3">
 																	<input type="number" step="any" name="r_total_weight" value="" id="r_total_weight" class="form-control" placeholder="Total">
 																</div>
 																<label for="horizontal-firstname-input" for="r_rate" class="col-sm-1 col-form-label d-flex justify-content-end">Rate:</label>
 																<div class="col-sm-3">

 																	<input type="number" step="any" value="" id="r_rate" name="r_rate" class="form-control" placeholder="Rate" required>
 																</div>

 																<label for="horizontal-firstname-input" for="sh_qty" class="col-sm-1 col-form-label d-flex justify-content-end">S-Quantity:</label>
 																<div class="col-sm-3">

 																	<input type="number" step="any" value="" id="sh_qty" name="sh_qty" class="form-control" placeholder="Shruded Quantity">
 																</div>
 															</div>
 															<div class="row mb-4">
 																<label for="horizontal-firstname-input" for="r_wastage" class="col-sm-1 col-form-label d-flex justify-content-end">Wastage:</label>
 																<div class="col-sm-3">

 																	<input type="number" step="any" value="" id="r_wastage" name="r_wastage" class="form-control" placeholder="Wastage" readonly>
 																</div>
 																<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Grand Weight:</label>
 																<div class="col-sm-3">
 																	<input type="number" step="any" name="r_grand_weight" value="" id="r_grand_weight" class="form-control card bg-dark border-dark text-light" placeholder="Total">
 																</div>
 																<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Payable:</label>
 																<div class="col-sm-3">
 																	<input type="number" step="any" name="r_payable" value="" id="r_payable" class="form-control" placeholder="Total">
 																</div>
 															</div>






 															<div class="row justify-content-end">
 																<div class="col-sm-9">

 																	<div>
 																		<button type="" class="btn btn-success waves-effect waves-light">Print</button>
 																		<button type="submit" class="btn btn-primary" id="r_save">Save</button>
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


 													<form id="stepfour" method="POST" enctype="multipart/form-data">
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
 																		<input type="date" id="a_date" name="date" class="form-control" placeholder="Date">
 																	</td>
 																	<td>

 																		<select id="select-vendor" name="vendor_id" placeholder="Pick a vendor...">
 																			<option value="">Select a vendor...</option>

 																		</select>
 																	</td>
 																	<td>
 																		<select required="" id="a_type" name="type" class="form-control form-select">
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
 																		<input type="number" step="any" id="amount" name="amount" class="form-control" placeholder="Amount">
 																	</td>



 																	<td><button type="submit" id="a_save" class="btn btn-primary">Save</button>


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

 <!-- Modal -->
 <div class="modal fade" id="product-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
 	<div class="modal-dialog modal-dialog-scrollable modal-xl">
 		<div class="modal-content">
 			<div class="modal-header">
 				<h5 class="modal-title" id="exampleModalLabel">Select Product</h5>
 				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
 			</div>
 			<div class="modal-body">
 				<form id="filter-data" method="POST" enctype="multipart/form-data">
 					<div class="card">
 						<div class="row my-4">
 							<label for="from-date" class="col-sm-1 col-form-label d-flex justify-content-end">From:</label>
 							<div class="col-sm-1">
 								<input type="date" name="from-date" id="from-date" class="form-control">
 							</div>
 							<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">To:</label>
 							<div class="col-sm-1">
 								<input type="date" name="to-date" id="to-date" class="form-control">
 							</div>
 							<label for="product_id" class="col-sm-1 col-form-label d-flex justify-content-end">Product ID:</label>
 							<div class="col-sm-2">
 								<input type="text" name="product_id" id="product_id" class="form-control" placeholder="Product ID">
 							</div>
 							<label for="vendor_id" class="col-sm-1 col-form-label d-flex justify-content-end">Vendor ID:</label>
 							<div class="col-sm-2">
 								<input type="text" value="" id="vendor_id" name="vendor_id" class="form-control" placeholder="Vendor ID">
 							</div>
 							<div class="col-sm-2">
 								<button type="submit" name="submit" class="btn btn-primary">Save</button>
 							</div>
 						</div>
 					</div>
 				</form>
 				<table id="product-table" class="table table-hover ">
 					<thead>
 						<tr>
 							<th scope="col">#</th>
 							<th scope="col">Product ID</th>
 							<th scope="col">Vendor ID</th>
 							<th scope="col">Vendor Name</th>
 							<th scope="col">Date</th>
 							<th scope="col">Action</th>
 						</tr>
 					</thead>
 					<tbody id="product-table-body">

 					</tbody>
 				</table>
 			</div>
 			<div class="modal-footer">
 				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
 			</div>
 		</div>
 	</div>
 </div>

 <!-- Right Sidebar -->
 <?php include 'layouts/right-sidebar.php'; ?>
 <!-- /Right-bar -->

 <!-- JAVASCRIPT -->
 <?php include 'layouts/vendor-scripts.php'; ?>

 <script>
 	function GetAllZircons() {
 		$.ajax({
 			url: "functions.php",
 			type: "POST",
 			data: {
 				function: "GetAllZircons"
 			},
 			success: function(data) {
 				data = JSON.parse(data);
 				let zircon = document.querySelectorAll('select[id="zircon_code[]"]');
 				let delete_area = zircon[0].parentElement;
 				var selectizeControls = delete_area.querySelectorAll('.selectize-control');
 				if (selectizeControls[0] != undefined) {
 					if (zircon.length > 1) {
 						// Get the first selectize control (index 0)
 						selectizeControls[0].remove();
 					}
 				}
 				// Start the loop from the second element (index 1)
 				for (var i = 1; i < selectizeControls.length; i++) {
 					var selectizeControl = selectizeControls[i];

 				}
 				for (let i = 0; i < zircon.length; i++) {
 					var selectElement = zircon[i];
 					var selectizeInstance = $(selectElement).selectize()[0].selectize;

 					var options = selectizeInstance.options;

 					if (Object.keys(options).length === 0) {
 						for (let j = 0; j < data.length; j++) {
 							var newOption = {
 								value: data[j].detail,
 								text: data[j].detail
 							};
 							if (selectizeInstance != undefined) {
 								selectizeInstance.addOption(newOption);
 							}
 						}

 						selectizeInstance.refreshOptions();
 					}else if (Object.keys(options).length === 1) {
 						option1 = Object.keys(options)[0];
 						selectizeInstance.removeOption(option1);
 						for (let j = 0; j < data.length; j++) {
 							var newOption = {
 								value: data[j].detail,
 								text: data[j].detail
 							};
 							if (selectizeInstance != undefined) {
 								selectizeInstance.addOption(newOption);
 							}
 						}
 						selectizeInstance.setValue(option1);


 						selectizeInstance.refreshOptions();
 					}else if (Object.keys(options).length > 1) {
						if (selectizeInstance.getValue() != ""){
							var selctedValue = selectizeInstance.getValue();
						}
						selectizeInstance.clearOptions();
						selectizeInstance.destroy();
						selectizeInstance = $(selectElement).selectize()[0].selectize;
						for (let j = 0; j < data.length; j++) {
 							var newOption = {
 								value: data[j].detail,
 								text: data[j].detail
 							};
 							if (selectizeInstance != undefined) {
 								selectizeInstance.addOption(newOption);
 							}
 						}
						if (selctedValue != undefined && selctedValue != "" && selctedValue != null){
							selectizeInstance.setValue(selctedValue);
							selctedValue = "";
						}
 						selectizeInstance.refreshOptions();
						
 					
 					
					}

 				}
 				const divsWithSiblings = document.querySelectorAll('div.selectize-control.single + div.selectize-control.single');

 				// Loop through the selected div elements
 				divsWithSiblings.forEach(div => {
 					// Remove each div element
 					div.remove();
 				});

 			}
 		});
 	}

 	function GetAllStones() {

 		$.ajax({
 			url: "functions.php",
 			type: "POST",
 			data: {
 				function: "GetAllStones"
 			},
 			success: function(data) {
 				data = JSON.parse(data);
 				let stone = document.querySelectorAll('select[id="stone_code[]"]');
 				let delete_area = stone[0].parentElement;
 				var selectizeControls = delete_area.querySelectorAll('.selectize-control');
 				if (selectizeControls[0] != undefined) {
 					// Get the first selectize control (index 0)
 					if (stone.length > 1) {
 						selectizeControls[0].remove();
 					}
 				}
 				// Start the loop from the second element (index 1)
 				for (var i = 1; i < selectizeControls.length; i++) {
 					var selectizeControl = selectizeControls[i];
 				}
 				for (let i = 0; i < stone.length; i++) {
 					var selectElement = stone[i];
 					var selectizeInstance = $(selectElement).selectize()[0].selectize;

 					var options = selectizeInstance.options;

 					if (Object.keys(options).length === 0) {
 						for (let j = 0; j < data.length; j++) {
 							var newOption = {
 								value: data[j].detail,
 								text: data[j].detail
 							};
 							if (selectizeInstance != undefined) {
 								selectizeInstance.addOption(newOption);
 							}
 						}

 						selectizeInstance.refreshOptions();
 					}else if (Object.keys(options).length === 1) {
 						option1 = Object.keys(options)[0];
 						selectizeInstance.removeOption(option1);
 						for (let j = 0; j < data.length; j++) {
 							var newOption = {
 								value: data[j].detail,
 								text: data[j].detail
 							};
 							if (selectizeInstance != undefined) {
 								selectizeInstance.addOption(newOption);
 							}
 						}
 						selectizeInstance.setValue(option1);


 						selectizeInstance.refreshOptions();
 					}else if (Object.keys(options).length > 1) {
						if (selectizeInstance.getValue() != ""){
							var selctedValue = selectizeInstance.getValue();
						}
						selectizeInstance.clearOptions();
						selectizeInstance.destroy();
						selectizeInstance = $(selectElement).selectize()[0].selectize;
						for (let j = 0; j < data.length; j++) {
 							var newOption = {
 								value: data[j].detail,
 								text: data[j].detail
 							};
 							if (selectizeInstance != undefined) {
 								selectizeInstance.addOption(newOption);
 							}
 						}
						if (selctedValue != undefined && selctedValue != "" && selctedValue != null){
							selectizeInstance.setValue(selctedValue);
							selctedValue = "";
						}
 						selectizeInstance.refreshOptions();
 					
					}


 				}
 				const divsWithSiblings = document.querySelectorAll('div.selectize-control.single + div.selectize-control.single');

 				// Loop through the selected div elements
 				divsWithSiblings.forEach(div => {
 					// Remove each div element
 					div.remove();
 				});

 			}
 		});
 	}

 	function AddStoneSetter() {
 		var product_id = document.getElementsByClassName('code')[0].value;
 		let area = document.getElementById("stone-setter-area");
 		const retainedWeightInputs = document.querySelectorAll('input[id="retained_weight[]"]');
 		const lastRetainedWeightInput = retainedWeightInputs[retainedWeightInputs.length - 1];
 		const lastRetainedWeightValue = lastRetainedWeightInput.value;

 		var date = new Date().toISOString().slice(0, 10);
 		area.innerHTML += `<hr>	<div class="mt-4 mt-lg-0">
									<form id="stepthree" method="POST" enctype="multipart/form-data">
										<?php

										$randomstone = random_int(0000000000, 779900000000);
										echo "<input type='hidden' name='stonebarcode' value='$randomstone' class='form-control'>";
										?>

										<div class="row mb-4">
											<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Name:</label>
											<div class="col-sm-5">

												<select id="select-stone_setter[]" name="vendor[]" placeholder="Pick a stone setter..." required>
													<option value="">Select a stone setter...</option>

												</select>
											</div>


											<label for="horizontal-firstname-input" class="bar-code col-sm-1 col-form-label d-flex justify-content-end">Bar Code:</label>

											<div class="col-sm-5">


												<input type="text" name="code[]" value="${product_id}"" class="form-control code" placeholder="code" readonly>

											</div>

										</div>
										<div class="row mb-4">

											<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Date:</label>
											<div class="col-sm-5">

												<input type="date" name="date[]" id="s_date" value="${date}" class="form-control" placeholder="Date">
											</div>

											<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Image Upload:</label>
											<div class="col-sm-5">

												<input type="file" id="image[]" name="image[]" value="" class="form-control" accept="image/*">
											</div>
										</div>
										<div class="row mb-4">
											<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Details:</label>
											<div class="col-sm-11">

												<textarea type="text" name="detail[]" id="s_details[]" class="form-control" style="height: 107px;" placeholder="Details"></textarea>
											</div>
										</div>
										<div class="row mb-4">
											<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Total Weight:</label>
											<div class="col-sm-3">

												<input type="number" step="any" name="s_total_weight[]" id="s_total_weight[]" value="${lastRetainedWeightValue}" class="form-control" placeholder="Total Weight" readonly>
											</div>
											<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">- Retained Weight:</label>
											<div class="col-sm-3">

												<input type="number" step="any" name="retained_weight[]" id="retained_weight[]" class="form-control" placeholder="Retained Weight">
											</div>
											<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">= Issued Weight:</label>
											<div class="col-sm-3">

												<input type="number" step="any" name="Issued_weight[]" id="stepIssueweight[]" class="form-control" placeholder="Issued Weight" readonly>
											</div>
										</div>
										<div class="row mb-4">
											<h5>Zircon:</h6>
												<label for="horizontal-firstname-input" class="col-sm-1 col-form-label  d-flex justify-content-end">Code:</label>
												<div class="col-sm-2">
													<select name="zircon_code[]" id="zircon_code[]" value="" class="form-control" placeholder="Zircon">
														<option value="">Select a zircon...</option>

													</select>

												</div>
												<div class="col-sm-1 p-0">
													<i class="fa fa-barcode fa-3x" onclick="BarCode(this)"></i>
												</div>
												<label for="horizontal-firstname-input" class="col-sm-1 col-form-label  d-flex justify-content-end">Weight:</label>
												<div class="col-sm-2">

													<input type="number" step="any" name="zircon_weight[]" id="zircon_weight[]" value="" class="form-control" placeholder="Zircon">
												</div>
												<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Quantity:</label>
												<div class="col-sm-2">

													<input type="number" name="zircon_quantity[]" id="zircon_quantity[]" value="" class="form-control" placeholder="Zircon">
												</div>
												<div class="col-sm-2">

													<i onclick="Add(this)" class="fa fa-plus-circle p-2"></i>
												</div>
										</div>
										<div id="area">

										</div>
										<div class="row mb-4">
											<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Total Weight:</label>
											<div class="col-sm-2">

												<input type="number" step="any" name="zircon_total_weight[]" value="" id="zircon_total_weight[]" class="form-control form-control card bg-dark border-dark text-light" placeholder="Total">
											</div>
											<div class="col-sm-1"></div>
											<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Total Quantity:</label>
											<div class="col-sm-2">

												<input type="number" name="zircon_total_quantity[]" value="" id="zircon_total_quantity[]" class="form-control form-control card bg-dark border-dark text-light" placeholder="Total">
											</div>
											<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-none">Total Price:</label>
											<div class="col-sm-3">

												<input type="number" step="any" name="zircon_total[]" value="" id="zircon_total[]" class="d-none form-control form-control card bg-dark border-dark text-light" placeholder="Total">
											</div>
										</div>
										<div class="row mb-4">
											<h5>Stone:</h5>
											<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Code:</label>
											<div class="col-sm-2">


												<select name="stone_code[]" id="stone_code[]" value="" class="form-control" placeholder="Stone Code">
													<option value="">Select a stone...</option>

												</select>

											</div>
											<div class="col-sm-1 p-0">
												<i class="fa fa-barcode fa-3x" onclick="BarCode(this)"></i>
											</div>
											<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Weight:</label>
											<div class="col-sm-2">

												<input type="number" step="any" name="stone_weight[]" id="stone_weight[]" value="" class="form-control" placeholder="Stone Weight">
											</div>
											<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Quantity:</label>
											<div class="col-sm-2">

												<input type="number" name="stone_quantity[]" id="stone_quantity[]" value="" class="form-control" placeholder="Stone Quantity">
											</div>
											<div class="col-sm-2">

												<i onclick="AddStone(this)" class="fa fa-plus-circle p-2"></i>
											</div>


										</div>
										<div id="area2">

										</div>
										<div class="row mb-4">
											<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Total Weight:</label>
											<div class="col-sm-2">

												<input type="number" step="any" name="stone_total_weight[]" value="" id="stone_total_weight[]" class="form-control form-control card bg-dark border-dark text-light" placeholder="Total">
											</div>
											<div class="col-sm-1"></div>
											<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Total Quantity:</label>
											<div class="col-sm-2">

												<input type="number" name="stone_total_quantity[]" value="" id="stone_total_quantity[]" class="form-control form-control card bg-dark border-dark text-light" placeholder="Total">
											</div>
											<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-none">Total Price:</label>
											<div class="col-sm-3">

												<input type="number" step="any" name="stone_total[]" value="" id="stone_total[]" class="d-none form-control form-control card bg-dark border-dark text-light" placeholder="Total">
											</div>
										</div>
										<div class="row mb-4">
											<label for="horizontal-firstname-input" class="col-sm-1 col-form-label ">Grand Total Weight:</label>
											<div class="col-sm-3">

												<input type="number" step="any" name="grand_total_weight[]" value="" id="grand_total_weight[]" class=" form-control form-control card bg-dark border-dark text-light" placeholder="Total">
											</div>
										</div>
										<div class="row mb-4">
											<h5 class="d-none">Grand Total:</h5>
											<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-none">Total Price:</label>
											<div class="col-sm-3">

												<input type="number" step="any" name="grand_total[]" value="" id="grand_total[]" class="d-none form-control form-control card bg-dark border-dark text-light" placeholder="Total">
											</div>
										</div>

										<hr />
										<div class="row justify-content-end mb-3">
											<div class="col-sm-9">

												<div>
													<button type="" class="btn btn-success waves-effect waves-light">Print</button>
													<button type="submit" class="btn btn-primary" id="s_save">Save</button>
												</div>
											</div>
										</div>
									</form>



									<form id="r_stepthree" method="POST" enctype="multipart/form-data">

										<div class="row">
											<label for="received_weight">Recieved Weight:</label>
											<div class="col-sm-4 mb-4">
												<input type="number" step="any" name="received_weight" value="" id="received_weight" class="form-control" placeholder="Received weight">
											</div>
											<div id="returned-area[]" class="row">
												<h5>Zircon/Stone Return:</h5>
												<div class="row mb-4"><label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Code:</label>
													<div class="col-sm-2">

														<input type="text" name="r_code[]" id="r_code[]" value="" class="form-control" placeholder="Code">

													</div>
													<div class="col-sm-1 p-0">
														<i class="fa fa-barcode fa-3x" onclick="BarCode(this)"></i>
													</div>
													<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Weight:</label>
													<div class="col-sm-2">

														<input type="number" step="any" name="r_weight[]" id="r_weight[]" value="" class="form-control" placeholder="Weight">
													</div>
													<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Quantity:</label>
													<div class="col-sm-2">

														<input type="number" name="r_quantity[]" id="r_quantity[]" value="" class="form-control" placeholder="Quantity">
													</div>
													<div class="col-sm-2">

														<i class="fa fa-plus-circle p-2" onclick="AddReturned(this)"></i>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Stone Weight:</label>
											<div class="col-sm-3">

												<input type="number" step="any" name="r_stone_weight" value="" id="r_stone_weight" class="form-control form-control card bg-dark border-dark text-light" placeholder="Total">
											</div>
											<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Stone Quantity:</label>
											<div class="col-sm-3">

												<input type="number" name="r_stone_quantity" value="" id="r_stone_quantity" class="form-control form-control card bg-dark border-dark text-light" placeholder="Total">
											</div>
										</div>
										<div class="row mb-4">
											<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Total Weight Return:</label>
											<div class="col-sm-3">
												<input type="number" step="any" name="r_total_weight" value="" id="r_total_weight" class="form-control" placeholder="Total">
											</div>
											<label for="horizontal-firstname-input" for="r_rate" class="col-sm-1 col-form-label d-flex justify-content-end">Rate:</label>
											<div class="col-sm-3">

												<input type="number" step="any" value="" id="r_rate" name="r_rate" class="form-control" placeholder="Rate" required>
											</div>

											<label for="horizontal-firstname-input" for="sh_qty" class="col-sm-1 col-form-label d-flex justify-content-end">S-Quantity:</label>
											<div class="col-sm-3">

												<input type="number" step="any" value="" id="sh_qty" name="sh_qty" class="form-control" placeholder="Shruded Quantity">
											</div>
										</div>
										<div class="row mb-4">
											<label for="horizontal-firstname-input" for="r_wastage" class="col-sm-1 col-form-label d-flex justify-content-end">Wastage:</label>
											<div class="col-sm-3">

												<input type="number" step="any" value="" id="r_wastage" name="r_wastage" class="form-control" placeholder="Wastage" readonly>
											</div>
											<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Grand Weight:</label>
											<div class="col-sm-3">
												<input type="number" step="any" name="r_grand_weight" value="" id="r_grand_weight" class="form-control card bg-dark border-dark text-light" placeholder="Total">
											</div>
											<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Payable:</label>
											<div class="col-sm-3">
												<input type="number" step="any" name="r_payable" value="" id="r_payable" class="form-control" placeholder="Total">
											</div>
										</div>






										<div class="row justify-content-end">
											<div class="col-sm-9">

												<div>
													<button type="" class="btn btn-success waves-effect waves-light">Print</button>
													<button type="submit" class="btn btn-primary" id="r_save">Save</button>
												</div>
											</div>
										</div>
									</form>
								</div>`;
 		var retained_weight = document.querySelectorAll('input[id="retained_weight[]"]');

 		for (var i = 0; i < retained_weight.length; i++) {
 			retained_weight[i].addEventListener("change", function() {
 				CalculateIssuedWeight(this);
 			});
 		};

 		async function runLoop2() {

 			await ReturnedStoneListeners();
 			await StoneSetterListeners();
 			await GetStoneSetterNames();
 			await GetAllZircons();
 			await GetAllStones();

 		}

 		runLoop2();
 	}


 	function GetProductId(btn) {
 		var id = btn.parentNode.parentNode.id;
 		$('#product-modal').modal('hide');
 		var remove = document.getElementsByClassName("remove");
 		Array.from(remove).forEach(function(element) {
 			element.remove();
 		});
 		var delete_btn = document.getElementById("delete-product");
 		delete_btn.disabled = false;
 		var product = document.getElementById("product");
 		product.value = id;
 		$("#product").trigger('input');
 	}

 	function ReturnedPayable(element) {
 		var payable = element.querySelector("input[id='r_payable']");
 		var r_grand_weight = element.querySelector("input[id='r_grand_weight']");
 		var grand_total_weight = element.previousElementSibling.querySelector("input[id='grand_total_weight[]']");
 		payable.value = (parseFloat(grand_total_weight.value) - parseFloat(r_grand_weight.value)).toFixed(2) + "0";

 	}

 	function SGrandWeight(current) {
 		var total = current.querySelector("input[id='grand_total_weight[]']");
 		var stone_total_weight = current.querySelector("input[id='stone_total_weight[]']");
 		var zircon_total_weight = current.querySelector("input[id='zircon_total_weight[]']");
 		var stepIssueweight = current.querySelector("input[id='stepIssueweight[]']");
 		if (stepIssueweight.value == "") {
 			stepIssueweight.value = 0;
 		}
 		if (stone_total_weight.value == "") {
 			stone_total_weight.value = 0;
 		}
 		if (zircon_total_weight.value == "") {
 			zircon_total_weight.value = 0;
 		}
 		value = parseFloat(stone_total_weight.value) + parseFloat(zircon_total_weight.value) + parseFloat(stepIssueweight.value);
 		total.value = value.toFixed(2) + '0';

 	}

 	function ReturnTotalWeight(element) {
 		let total = element.querySelector("input[id='r_total_weight']");
 		let received_weight = element.querySelector("input[id='received_weight']");
 		let r_stone_weight = element.querySelector("input[id='r_stone_weight']");
 		if (r_stone_weight.value == "") {
 			r_stone_weight.value = 0;
 		}
 		total.value = parseFloat(received_weight.value) + parseFloat(r_stone_weight.value);

 	}

 	function CalculateReturnedWastage(element) {
 		var quantity = element.querySelector("input[id='sh_qty']");
		console.log("wastageelement",element);
		var select_stone_setter = element.previousElementSibling.querySelectorAll('select[id="select-stone_setter[]"]')[0].selectize;
 		if (select_stone_setter == undefined) {
 			select_stone_setter = element.previousElementSibling.querySelectorAll('select[id="select-stone_setter[]"]')[0];
 			var vendor_id = select_stone_setter.value;
 		} else {
 			var vendor_id = select_stone_setter.getValue();

 		}
 		var selectElement = $('#select-manufacturer-purity').selectize()[0].selectize;
 		var selectedValues = selectElement.getValue();
 		var unpolish_weight = document.getElementById('unpolish_weight').value;

 		for (var i = 0; i < selectedValues.length; i++) {
 			var selectedValue = selectedValues[i];
 			var selectedOption = selectElement.options[selectedValue];
 			if (selectedOption) {
 				var selectedText = selectedOption.text;
 			} else {
 				var selectedText = '18k';
 			}
 		}

 		$.ajax({
 			url: "functions.php",
 			method: "POST",
 			data: {
 				function: "GetStoneSetterRate",
 				column: selectedText,
 				id: vendor_id
 			},
 			success: function(response) {
 				var data = JSON.parse(response);
 				var stone_setter_rate = element.querySelector('input[id="r_rate"]').value = data[0][selectedText];
 			}
 		});
 		var rate = element.querySelector("input[id='r_rate']");
 		var wastage = element.querySelector("input[id='r_wastage']");
 		wastage.value = ((quantity.value * rate.value) / 100).toFixed(2) + '0';
 		GrandWeight(element);
 	}

 	function TotalWeight(element) {
 		var total_weight = element.querySelector("input[id='r_total_weight']");
 		var stone_weight = element.querySelector("input[id='r_stone_weight']");
 		if (stone_weight.value == "") {
 			stone_weight.value = 0;
 		}
 		var received_weight = element.querySelector("input[id='received_weight']");
 		total_weight.value = parseFloat(stone_weight.value) + parseFloat(received_weight.value);
 		GrandWeight(element);
 		ReturnedPayable(element);
 	}

 	function GrandWeight(element) {
 		var total_weight = element.querySelector("input[id='r_total_weight']");
 		var wastage = element.querySelector("input[id='r_wastage']");
 		var received_weight = element.querySelector("input[id='received_weight']");
 		var grand_total_weight = element.querySelector("input[id='r_grand_weight']");
 		grand_total_weight.value = parseFloat(total_weight.value) + parseFloat(wastage.value);
 		ReturnedPayable(element);
 	}

 	function PrintManufacturer() {
		let id = document.getElementsByClassName("code")[0].value;
		$.ajax({
			url: "functions.php",
			type: "POST",
			data: {
				function: "PrintManufacturer",
				id: id
			},
			success: function(data) {
				data = JSON.parse(data);
				console.log(data);
				newContent =``;

			}
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
 						GetAdditionalVendorData(id);
 						CalculateDifference();
 						GetPolisherData(id);


 					}
 				});

 			}
 		});
 	}

 	function GetPolisherData(id) {
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
 					stepTwoDifference.value = data[0].difference;
 					var poWas = document.getElementById('poWas');
 					poWas.value = data[0].Wastage;

 				}
 				GetStoneSetterData(id);
 			}
 		});
 	}

 	async function GetStoneSetterData(id) {
 		var selectElement = $('#select-manufacturer-purity').selectize()[0].selectize;
 		var selectedValues = selectElement.getValue();
 		var selectedText;
 		var code = id;

 		for (var i = 0; i < selectedValues.length; i++) {
 			var selectedValue = selectedValues[i];
 			var selectedOption = selectElement.options[selectedValue];
 			if (selectedOption) {
 				selectedText = selectedOption.text;
 			} else {
 				selectedText = '18k';
 			}
 		}

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
 					let form = document.querySelectorAll("#stepthree")[0];
 					let form2 = document.querySelectorAll("#r_stepthree")[0];
 					form.remove();
 					form2.remove();
 					async function runLoop() {
 						for (var i = 0; i < data.length; i++) {
 							var dateString = data[i].date;
 							var date = new Date(dateString);
 							var year = date.getFullYear();
 							var month = ("0" + (date.getMonth() + 1)).slice(-2);
 							var day = ("0" + date.getDate()).slice(-2);
 							var date = year + "-" + month + "-" + day;
 							let content = `<div class="stone-setter${i}">
								<form id="stepthree" class="" method="POST" enctype="multipart/form-data">
									<?php

									$randomstone = random_int(0000000000, 779900000000);
									echo "<input type='hidden' name='stonebarcode' value='$randomstone' class='form-control'>";
									?>

									<div class="row mb-4">
										<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Name:</label>
										<div class="col-sm-5">

											<select id="select-stone_setter[]" name="vendor[]" placeholder="Pick a stone setter..." required>
												<option value="${data[i].vendor_id}">${data[i].vendor_id}</option>

											</select>
										</div>


										<label for="horizontal-firstname-input" class="bar-code col-sm-1 col-form-label d-flex justify-content-end">Bar Code:</label>

										<div class="col-sm-5">


											<input type="text" name="code[]" value="${id}" class="form-control code" placeholder="code" readonly>

										</div>

									</div>
									<div class="row mb-4">

										<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Date:</label>
										<div class="col-sm-5">

											<input type="date" value="${date}" name="date[]" id="s_date" class="form-control" placeholder="Date">
										</div>

										<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Image Upload:</label>
										<div class="col-sm-5">

											<input type="file" id="image[]" name="image[]" value="" class="form-control" accept="image/*">
										</div>
									</div>
									<div class="row mb-4">
										<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Details:</label>
										<div class="col-sm-11">

											<textarea type="text" name="detail[]" id="s_details[]" value="${data[i].detail}" class="form-control" style="height: 107px;" placeholder="Details"></textarea>
										</div>
									</div>
									<div class="row mb-4">
										<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Total Weight:</label>
										<div class="col-sm-3">

											<input type="number" step="any" name="s_total_weight[]" value="${data[i].total_weight}" id="s_total_weight[]" class="form-control" placeholder="Total Weight" readonly>
										</div>
										<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">- Retained Weight:</label>
										<div class="col-sm-3">

											<input type="number" step="any" name="retained_weight[]" value="${data[i].retained_weight}" id="retained_weight[]" class="form-control" placeholder="Retained Weight">
										</div>
										<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">= Issued Weight:</label>
										<div class="col-sm-3">

											<input type="number" step="any" name="Issued_weight[]" value="${data[i].Issued_weight}" id="stepIssueweight[]" class="form-control" placeholder="Issued Weight" readonly>
										</div>
									</div>
									<div class="row mb-4">
										<h5>Zircon:</h6>
											<label for="horizontal-firstname-input" class="col-sm-1 col-form-label  d-flex justify-content-end">Code:</label>
											<div class="col-sm-2">
												<select name="zircon_code[]" id="zircon_code[]" value="" class="form-control" placeholder="Zircon">
													<option value="${data[0].zircons[0].code}">${data[0].zircons[0].code}</option>

												</select>

											</div>
											<div class="col-sm-1 p-0">
												<i class="fa fa-barcode fa-3x" onclick="BarCode(this)"></i>
											</div>
											<label for="horizontal-firstname-input" class="col-sm-1 col-form-label  d-flex justify-content-end">Weight:</label>
											<div class="col-sm-2">

												<input type="number" value="${data[0].zircons[0].weight}" step="any" name="zircon_weight[]" id="zircon_weight[]" value="" class="form-control" placeholder="Zircon">
											</div>
											<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Quantity:</label>
											<div class="col-sm-2">

												<input type="number" value="${data[0].zircons[0].quantity}" name="zircon_quantity[]" id="zircon_quantity[]" value="" class="form-control" placeholder="Zircon">
											</div>
											<div class="col-sm-2">

												<i onclick="Add(this)" class="fa fa-plus-circle p-2"></i>
											</div>
									</div>
									<div  class="area${data[i].vendor_id}">

									</div>
									<div class="row mb-4">
										<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Total Weight:</label>
										<div class="col-sm-2">

											<input type="number" step="any" name="zircon_total_weight[]" value="${data[i].z_total_weight}" id="zircon_total_weight[]" class="form-control form-control card bg-dark border-dark text-light" placeholder="Total">
										</div>
										<div class="col-sm-1"></div>
										<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Total Quantity:</label>
										<div class="col-sm-2">

											<input type="number" name="zircon_total_quantity[]" value="${data[i].z_total_quantity}" id="zircon_total_quantity[]" class="form-control form-control card bg-dark border-dark text-light" placeholder="Total">
										</div>
										<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-none">Total Price:</label>
										<div class="col-sm-3">

											<input type="number" step="any" name="zircon_total[]" value="${data[i].z_total_price}" id="zircon_total[]" class="d-none form-control form-control card bg-dark border-dark text-light" placeholder="Total">
										</div>
									</div>
									<div class="row mb-4">
										<h5>Stone:</h5>
										<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Code:</label>
										<div class="col-sm-2">


											<select name="stone_code[]" id="stone_code[]" value="" class="form-control" placeholder="Stone Code">
												<option value="${data[0].stones[0].code}">${data[0].stones[0].code}</option>

											</select>

										</div>
										<div class="col-sm-1 p-0">
											<i class="fa fa-barcode fa-3x" onclick="BarCode(this)"></i>
										</div>
										<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Weight:</label>
										<div class="col-sm-2">

											<input type="number" value="${data[0].stones[0].quantity}" step="any" name="stone_weight[]" id="stone_weight[]" value="" class="form-control" placeholder="Stone Weight">
										</div>
										<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Quantity:</label>
										<div class="col-sm-2">

											<input type="number" name="stone_quantity[]" value="${data[0].stones[0].weight}" id="stone_quantity[]" value="" class="form-control" placeholder="Stone Quantity">
										</div>
										<div class="col-sm-2">

											<i onclick="AddStone(this)" class="fa fa-plus-circle p-2"></i>
										</div>


									</div>
									<div id="area2">

									</div>
									<div class="row mb-4">
										<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Total Weight:</label>
										<div class="col-sm-2">

											<input type="number" step="any" name="stone_total_weight[]" value="${data[i].s_total_weight}" id="stone_total_weight[]" class="form-control form-control card bg-dark border-dark text-light" placeholder="Total">
										</div>
										<div class="col-sm-1"></div>
										<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Total Quantity:</label>
										<div class="col-sm-2">

											<input type="number" name="stone_total_quantity[]" value="${data[i].s_total_quantity}" id="stone_total_quantity[]" class="form-control form-control card bg-dark border-dark text-light" placeholder="Total">
										</div>
										<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-none">Total Price:</label>
										<div class="col-sm-3">

											<input type="number" step="any" name="stone_total[]" value="${data[i].s_total_price}" id="stone_total[]" class="d-none form-control form-control card bg-dark border-dark text-light" placeholder="Total">
										</div>
									</div>
									<div class="row mb-4">
										<label for="horizontal-firstname-input" class="col-sm-1 col-form-label ">Grand Total Weight:</label>
										<div class="col-sm-3">

											<input type="number" step="any" name="grand_total_weight[]" value="${data[i].grand_weight}" id="grand_total_weight[]" class=" form-control form-control card bg-dark border-dark text-light" placeholder="Total">
										</div>
									</div>
									<div class="row mb-4">
										<h5 class="d-none">Grand Total:</h5>
										<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-none">Total Price:</label>
										<div class="col-sm-3">

											<input type="number" step="any" name="grand_total[]" value="${data[i].grand_total}" id="grand_total[]" class="d-none form-control form-control card bg-dark border-dark text-light" placeholder="Total">
										</div>
									</div>

									<hr />
									<div class="row justify-content-end mb-3">
										<div class="col-sm-9">

											<div>
												<button type="" class="btn btn-success waves-effect waves-light">Print</button>
												<button type="submit" class="btn btn-primary" id="s_save">Save</button>
											</div>
										</div>
									</div>
								</form>
							</div>`;



 							document.getElementById("stone-setter-area").innerHTML += content;


 							await GetReturnedData(id, data[i].vendor_id, i);
 							await GetStoneSetterNames();
 							await GetZirconData(id, data[i].vendor_id, i);
 							await GetStoneData(id, data[i].vendor_id, i);


 						}

 					}

 					runLoop();
 					setTimeout(function() {
 						newrunLoop();
 					}, 1000);
 				}




 			}
 		});


 	}

 	async function newrunLoop() {
 		await GetStoneSetterNames();
 		await GetAllZircons();
 		await GetAllStones();
 		await ReturnedStoneListeners();
 		await StoneSetterListeners();

 	}

 	function GetZirconData(id, vendor_id, si) {
 		return new Promise((resolve, reject) => {
 			let stonesetter = document.querySelectorAll('select[id="select-stone_setter[]"]');
 			let element = document.getElementsByClassName('stone-setter' + si)[0];
 			$.ajax({
 				url: "functions.php",
 				type: "POST",
 				data: {
 					function: "GetZircons",
 					id: id,
 					vendor_id: vendor_id
 				},
 				success: function(data) {
 					if (data !== "[]") {
 						data = JSON.parse(data);
 						var option = document.createElement("option");
 						option.text = data[0].code;
 						option.value = data[0].code;
 						var zircon_code = element.querySelectorAll('select[name="zircon_code[]"]')[0];
 						while (zircon_code.options.length > 0) {
 							zircon_code.remove(0);
 						}
 						zircon_code.add(option);
 						zircon_code.value = data[0].code;
 						var zircon_weight = element.querySelectorAll('input[name="zircon_weight[]"]')[0].value = data[0].weight;
 						var zircon_quantity = element.querySelectorAll('input[name="zircon_quantity[]"]')[0].value = data[0].quantity;
 						for (var i = 1; i < data.length; i++) {


 							var div = document.createElement('div');
 							div.setAttribute('class', 'zi row mb-4 remove');
 							div.innerHTML = `
								<label for="horizontal-firstname-input" class="col-sm-1 col-form-label  d-flex justify-content-end">Code:</label>
								<div class="col-sm-2">
								<select name="zircon_code[]" id="zircon_code[]" value="" class="form-control" placeholder="Zircon">
													<option value="${data[i].code}">${data[i].code}</option>

												</select>
									

								</div>
								<div class="col-sm-1 p-0">
									<i class="fa fa-barcode fa-3x" onclick="BarCode(this)"></i>
								</div>
								<label for="horizontal-firstname-input" class="col-sm-1 col-form-label  d-flex justify-content-end">Weight:</label>
								<div class="col-sm-2">

									<input type="number" step="any" name="zircon_weight[]" id="zircon_weight[]" value="${data[i].weight}" class="form-control" placeholder="Zircon" required>
								</div>
								<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Quantity:</label>
								<div class="col-sm-2">

									<input type="number" step="any" name="zircon_quantity[]" id="zircon_quantity[]" value="${data[i].quantity}" class="form-control" placeholder="Zircon" required>
								</div>
								<div class="col-sm-2">

									<i class="delete-zircon fa fa-minus-circle p-2"></i>
								</div>
								`;

 							var area = element.querySelectorAll('.area' + vendor_id)[0];
 							area.appendChild(div);
 						}
 					}

 					resolve();
 				}
 			});
 		});
 	}

 	function GetStoneData(id, vendor_id, si) {
 		return new Promise((resolve, reject) => {
 			let stonesetter = document.querySelectorAll('select[id="select-stone_setter[]"]');
 			let element = document.getElementsByClassName('stone-setter' + si)[0];
 			$.ajax({
 				url: "functions.php",
 				type: "POST",
 				data: {
 					function: "GetStones",
 					id: id,
 					vendor_id: vendor_id
 				},
 				success: function(data) {
 					if (data !== "[]") {
 						data = JSON.parse(data);
 						var option = document.createElement("option");
 						option.text = data[0].code;
 						option.value = data[0].code;
 						var stone_code = element.querySelectorAll('select[name="stone_code[]"]')[0];
 						while (stone_code.options.length > 0) {
 							stone_code.remove(0);
 						}
 						stone_code.add(option);
 						stone_code.value = data[0].code;
 						var stone_weight = element.querySelectorAll('input[name="stone_weight[]"]')[0].value = data[0].weight;
 						var stone_quantity = element.querySelectorAll('input[name="stone_quantity[]"]')[0].value = data[0].quantity;
 						for (var i = 1; i < data.length; i++) {
 							var area2 = element.querySelectorAll('#area2')[0];
 							var div2 = document.createElement('div');
 							div2.setAttribute('class', 'row mb-4 remove');
 							div2.innerHTML = `
									<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Code:</label>
									<div class="col-sm-2">

									<select name="stone_code[]" id="stone_code[]" value="" class="form-control" placeholder="Stone Code">
												<option value="${data[i].code}">${data[i].code}</option>

											</select>

									</div>
									<div class="col-sm-1 p-0">
										<i class="fa fa-barcode fa-3x" onclick="BarCode(this)"></i>
									</div>
									<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Weight:</label>
									<div class="col-sm-2">

										<input type="number" step="any" name="stone_weight[]" id="stone_weight[]" value="${data[i].weight}" class="form-control" placeholder="Stone Weight" required>
									</div>
									<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Quantity:</label>
									<div class="col-sm-2">

										<input type="number" step="any" name="stone_quantity[]" id="stone_quantity[]" value="${data[i].quantity}" class="form-control" placeholder="Stone Quantity" required>
									</div>
									<div class="col-sm-2">

									<i class="delete-stone fa fa-minus-circle p-2"></i>
									</div>`;
 							area2.appendChild(div2);
 							var stone_weight = element.querySelectorAll('input[id="stone_weight[]"]');
 							var stone_quantity = element.querySelectorAll('input[id="stone_quantity[]"]');
 							stone_quantity.forEach(function(input) {
 								input.addEventListener('input', function() {
 									let current = this.parentNode.parentNode.parentNode;
 									StoneQuantity(current);
 								});
 							})
 							stone_weight.forEach(function(input) {
 								input.addEventListener('input', function() {
 									let current = this.parentNode.parentNode.parentNode;
 									StoneWeight(current);
 								});
 							})
 						}
 					}

 					resolve();
 				}
 			});
 		});
 	}

 	async function GetReturnedData(id, vendor_id, si) {
 		let stonesetter = document.querySelectorAll('select[id="select-stone_setter[]"]');
 		$.ajax({
 			url: "functions.php",
 			type: "POST",
 			data: {
 				function: "GetReturnedData",
 				id: id,
 				vendor_id: vendor_id
 			},
 			success: function(data) {
 				data = JSON.parse(data);
 				let element = document.getElementsByClassName('stone-setter' + si)[0];

 				if (data.length > 0) {
 					for (var i = 0; i < data.length; i++) {
 						var content = `
								<form id="r_stepthree" method="POST" enctype="multipart/form-data">

									<div class="row">
										<label for="received_weight">Recieved Weight:</label>
										<div class="col-sm-4 mb-4">
											<input type="number" step="any" name="received_weight" value="${data[i].received_weight}" id="received_weight" class="form-control" placeholder="Received weight">
										</div>
										<div id="returned-area[]" class="row">
											<h5>Zircon/Stone Return:</h5>
											<div class="row mb-4"><label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Code:</label>
												<div class="col-sm-2">

													<input type="text" name="r_code[]" id="r_code[]" value="" class="form-control" placeholder="Code">

												</div>
												<div class="col-sm-1 p-0">
													<i class="fa fa-barcode fa-3x" onclick="BarCode(this)"></i>
												</div>
												<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Weight:</label>
												<div class="col-sm-2">

													<input type="number" step="any" name="r_weight[]" id="r_weight[]" value="" class="form-control" placeholder="Weight">
												</div>
												<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Quantity:</label>
												<div class="col-sm-2">

													<input type="number" name="r_quantity[]" id="r_quantity[]" value="" class="form-control" placeholder="Quantity">
												</div>
												<div class="col-sm-2">

													<i class="fa fa-plus-circle p-2" onclick="AddReturned(this)"></i>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Stone Weight:</label>
										<div class="col-sm-3">

											<input type="number" step="any" name="r_stone_weight" value="${data[i].stone_weight}" id="r_stone_weight" class="form-control form-control card bg-dark border-dark text-light" placeholder="Total">
										</div>
										<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Stone Quantity:</label>
										<div class="col-sm-3">

											<input type="number" name="r_stone_quantity" value="${data[i].stone_quantity}" id="r_stone_quantity" class="form-control form-control card bg-dark border-dark text-light" placeholder="Total">
										</div>
									</div>
									<div class="row mb-4">
										<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Total Weight Return:</label>
										<div class="col-sm-3">
											<input type="number" step="any" name="r_total_weight" value="${data[i].total_weight}" id="r_total_weight" class="form-control" placeholder="Total">
										</div>
										<label for="horizontal-firstname-input" for="r_rate" class="col-sm-1 col-form-label d-flex justify-content-end">Rate:</label>
										<div class="col-sm-3">

											<input type="number" step="any" value="${data[i].rate}" id="r_rate" name="r_rate" class="form-control" placeholder="Rate" required>
										</div>

										<label for="horizontal-firstname-input" for="sh_qty" class="col-sm-1 col-form-label d-flex justify-content-end">S-Quantity:</label>
										<div class="col-sm-3">

											<input type="number" step="any" value="${data[i].shruded_quantity}" id="sh_qty" name="sh_qty" class="form-control" placeholder="Shruded Quantity">
										</div>
									</div>
									<div class="row mb-4">
										<label for="horizontal-firstname-input" for="r_wastage" class="col-sm-1 col-form-label d-flex justify-content-end">Wastage:</label>
										<div class="col-sm-3">

											<input type="number" step="any" value="${data[i].wastage}" id="r_wastage" name="r_wastage" class="form-control" placeholder="Wastage" readonly>
										</div>
										<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Grand Weight:</label>
										<div class="col-sm-3">
											<input type="number" step="any" name="r_grand_weight" value="${data[i].grand_weight}" id="r_grand_weight" class="form-control card bg-dark border-dark text-light" placeholder="Total">
										</div>
										<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Payable:</label>
										<div class="col-sm-3">
											<input type="number" step="any" name="r_payable" value="${data[i].payable}" id="r_payable" class="form-control" placeholder="Total">
										</div>
									</div>






									<div class="row justify-content-end">
										<div class="col-sm-9">

											<div>
												<button type="" class="btn btn-success waves-effect waves-light">Print</button>
												<button type="submit" class="btn btn-primary" id="r_save">Save</button>
											</div>
										</div>
									</div>
									</form>`;


 					}
 				} else {
 					var content = `
							<form id="r_stepthree" method="POST" enctype="multipart/form-data">

								<div class="row">
									<label for="received_weight">Recieved Weight:</label>
									<div class="col-sm-4 mb-4">
										<input type="number" step="any" name="received_weight" value="" id="received_weight" class="form-control" placeholder="Received weight">
									</div>
									<div id="returned-area[]" class="row">
										<h5>Zircon/Stone Return:</h5>
										<div class="row mb-4"><label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Code:</label>
											<div class="col-sm-2">

												<input type="text" name="r_code[]" id="r_code[]" value="" class="form-control" placeholder="Code">

											</div>
											<div class="col-sm-1 p-0">
												<i class="fa fa-barcode fa-3x" onclick="BarCode(this)"></i>
											</div>
											<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Weight:</label>
											<div class="col-sm-2">

												<input type="number" step="any" name="r_weight[]" id="r_weight[]" value="" class="form-control" placeholder="Weight">
											</div>
											<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Quantity:</label>
											<div class="col-sm-2">

												<input type="number" name="r_quantity[]" id="r_quantity[]" value="" class="form-control" placeholder="Quantity">
											</div>
											<div class="col-sm-2">

												<i class="fa fa-plus-circle p-2" onclick="AddReturned(this)"></i>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Stone Weight:</label>
									<div class="col-sm-3">

										<input type="number" step="any" name="r_stone_weight" value="" id="r_stone_weight" class="form-control form-control card bg-dark border-dark text-light" placeholder="Total">
									</div>
									<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Stone Quantity:</label>
									<div class="col-sm-3">

										<input type="number" name="r_stone_quantity" value="" id="r_stone_quantity" class="form-control form-control card bg-dark border-dark text-light" placeholder="Total">
									</div>
								</div>
								<div class="row mb-4">
									<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Total Weight Return:</label>
									<div class="col-sm-3">
										<input type="number" step="any" name="r_total_weight" value="" id="r_total_weight" class="form-control" placeholder="Total">
									</div>
									<label for="horizontal-firstname-input" for="r_rate" class="col-sm-1 col-form-label d-flex justify-content-end">Rate:</label>
									<div class="col-sm-3">

										<input type="number" step="any" value="" id="r_rate" name="r_rate" class="form-control" placeholder="Rate" required>
									</div>

									<label for="horizontal-firstname-input" for="sh_qty" class="col-sm-1 col-form-label d-flex justify-content-end">S-Quantity:</label>
									<div class="col-sm-3">

										<input type="number" step="any" value="" id="sh_qty" name="sh_qty" class="form-control" placeholder="Shruded Quantity">
									</div>
								</div>
								<div class="row mb-4">
									<label for="horizontal-firstname-input" for="r_wastage" class="col-sm-1 col-form-label d-flex justify-content-end">Wastage:</label>
									<div class="col-sm-3">

										<input type="number" step="any" value="" id="r_wastage" name="r_wastage" class="form-control" placeholder="Wastage" readonly>
									</div>
									<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Grand Weight:</label>
									<div class="col-sm-3">
										<input type="number" step="any" name="r_grand_weight" value="" id="r_grand_weight" class="form-control card bg-dark border-dark text-light" placeholder="Total">
									</div>
									<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Payable:</label>
									<div class="col-sm-3">
										<input type="number" step="any" name="r_payable" value="" id="r_payable" class="form-control" placeholder="Total">
									</div>
								</div>






								<div class="row justify-content-end">
									<div class="col-sm-9">

										<div>
											<button type="" class="btn btn-success waves-effect waves-light">Print</button>
											<button type="submit" class="btn btn-primary" id="r_save">Save</button>
										</div>
									</div>
								</div>
								</form>
					`;
 				}
 				element.innerHTML += content;
 				ReturnedStoneListeners();
 			}
 		});
 		await GetReturnedStoneData(id, vendor_id, si);
 	}

 	function GetReturnedStoneData(id, vendor_id, si) {
 		let stonesetter = document.querySelectorAll('select[id="select-stone_setter[]"]');
 		let element = document.getElementsByClassName('stone-setter' + si)[0];
 		$.ajax({
 			url: "functions.php",
 			type: "POST",
 			data: {
 				function: "GetReturnedStoneData",
 				id: id,
 				vendor_id: vendor_id
 			},
 			success: function(data) {
 				if (data !== "[]") {
 					data = JSON.parse(data);
 					var returned_area = element.querySelectorAll('div[id="returned-area[]"]')[0];
 					if (element.querySelectorAll('input[name="r_code[]"]').length > 0) {
 						var r_code = element.querySelectorAll('input[name="r_code[]"]')[0].value = data[0].code;
 						var r_weight = element.querySelectorAll('input[name="r_weight[]"]')[0].value = data[0].weight;
 						var r_quantity = element.querySelectorAll('input[name="r_quantity[]"]')[0].value = data[0].quantity;
 					}
 					for (i = 1; i < data.length; i++) {
 						var div = document.createElement('div');
 						div.setAttribute('class', 'row mb-4 remove');
 						div.innerHTML = `<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Code:</label>
									<div class="col-sm-2">

										<input type="text" name="r_code[]" id="r_code[]" value="${data[i].code}" class="form-control" placeholder="Code" required>

									</div>
									<div class="col-sm-1 p-0">
										<i class="fa fa-barcode fa-3x" onclick="BarCode(this)"></i>
									</div>
									<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Weight:</label>
									<div class="col-sm-2">

										<input type="number" step="any" name="r_weight[]" id="r_weight[]" value="${data[i].weight}" class="form-control" placeholder="Weight" required>
									</div>
									<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Quantity:</label>
									<div class="col-sm-2">

										<input type="number" step="any" name="r_quantity[]" id="r_quantity[]" value="${data[i].quantity}" class="form-control" placeholder="Quantity" required>
									</div>
									<div class="col-sm-2">

										<i class="delete-returned fa fa-minus-circle p-2""></i>
									</div>`;
 						returned_area.appendChild(div);


 					}
 				}
 			}
 		});



 	}

 	function GetAdditionalVendorData(id) {
 		$.ajax({
 			url: "functions.php",
 			type: "POST",
 			data: {
 				function: "GetAdditionalData",
 				id: id
 			},
 			success: function(data) {
 				if (data !== "[]") {
 					data = JSON.parse(data);
 					var date = document.getElementById('a_date').value = data[0].date;
 					var vendor = $('#select-vendor')[0].selectize;
 					vendor.setValue(data[0].vendor_id);
 					var type = $('#a_type')[0].selectize;
 					type.setValue(data[0].type);
 					var amount = document.getElementById('amount').value = data[0].amount;

 				}
 			}
 		});
 	}

 	function CalculateWastage() {
 		var manufacturer_rate = parseFloat(document.getElementById('manufacturer-rate').value);
 		var unpolish_weight = parseFloat(document.getElementById('unpolish_weight').value);
 		if (!isNaN(manufacturer_rate) && !isNaN(unpolish_weight)) {
 			var wastage = (unpolish_weight * manufacturer_rate) / 96;
 			wastage = parseFloat(wastage.toFixed(2));
 			document.getElementById('wastage').value = wastage;
 		}
 		var selectElement = $('#select-manufacturer-purity').selectize()[0].selectize;
 		var selectedValues = selectElement.getValue();

 		for (var i = 0; i < selectedValues.length; i++) {
 			var selectedValue = selectedValues[i];
 			var selectedOption = selectElement.options[selectedValue];
 			if (selectedOption) {
 				var selectedText = selectedOption.text;
 			} else {
 				var selectedText = '18k';
 			}
 		}
 		if (selectedText == '18k') {
 			var tValues = document.getElementById('tValues');
 			var total = (unpolish_weight + wastage) * 0.75;
 			tValues.value = total.toFixed(2) + '0';
 		} else if (selectedText == '21k') {
 			var tValues = document.getElementById('tValues');
 			tValues.value = ((unpolish_weight + wastage) * 0.875).toFixed(2) + '0';
 		} else if (selectedText == '22k') {
 			var tValues = document.getElementById('tValues');
 			tValues.value = ((unpolish_weight + wastage) * 0.916).toFixed(2) + '0';
 		}
 		CalculateDifference()


 	}

 	function DeleteProduct() {
 		var product = document.getElementById('product');
 		if (product.value == '') {
 			alert('Please Select Product');
 		} else {
 			$.ajax({
 				url: "functions.php",
 				method: "POST",
 				data: {
 					function: "DeleteProduct",
 					id: product.value
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

 	function ZirconQuantity(current) {
 		var zircon_quantity = current.querySelectorAll('input[id="zircon_quantity[]"]');
 		var total = 0;
 		zircon_quantity.forEach(function(input) {
 			if (input.value) {
 				total += parseFloat(input.value);
 			}
 		});

 		current.querySelector('input[id="zircon_total_quantity[]"]').value = total;
 		ZirconWeight(current);
 		SGrandWeight(current)
 	}

 	function ZirconWeight(current) {
 		var zircon_weight = current.querySelectorAll('input[id="zircon_weight[]"]');
 		total = 0;
 		for (var i = 0; i < zircon_weight.length; i++) {
 			if (zircon_weight[i].value) {
 				total += parseFloat(zircon_weight[i].value);
 			}
 		}
 		current.querySelector('input[id="zircon_total_weight[]"]').value = total;
 		SGrandWeight(current)

 	}

 	function StoneQuantity(current) {
 		var stone_quantity = current.querySelectorAll('input[id="stone_quantity[]"]');
 		var total = 0;
 		stone_quantity.forEach(function(input) {
 			if (input.value) {
 				total += parseFloat(input.value);
 			}
 		});
 		current.querySelector('input[id="stone_total_quantity[]"]').value = total;

 		StoneWeight(current);
 		SGrandWeight(current)
 	}

 	function StoneWeight(current) {
 		var stone_weight = current.querySelectorAll('input[id="stone_weight[]"]');
 		total = 0;
 		for (var i = 0; i < stone_weight.length; i++) {
 			if (stone_weight[i].value) {
 				total += parseFloat(stone_weight[i].value);
 			}
 		}
 		current.querySelector('input[id="stone_total_weight[]"]').value = total;
 		SGrandWeight(current)

 	}

 	function ReturnedQuantity(element) {
 		var r_quantity = element.querySelectorAll('input[id="r_quantity[]"]');
 		var total = 0;
 		r_quantity.forEach(function(input) {
 			if (input.value) {
 				total += parseFloat(input.value);
 			}
 		});
 		element.querySelector('input[id="r_stone_quantity"]').value = total;
 		var r_rate = element.querySelector('input[id="r_rate"]');
 		var event = new Event('change');
 		r_rate.dispatchEvent(event);
 		ReturnedWeight(element);
 	}

 	function ReturnedWeight(element) {
 		var r_weight = element.querySelectorAll('input[id="r_weight[]"]');
 		var r_quantity = element.querySelectorAll('input[id="r_quantity[]"]');
 		total = 0;
 		for (var i = 0; i < r_weight.length; i++) {
 			if (r_weight[i].value) {
 				total += parseFloat(r_weight[i].value);
 			}
 		}
 		element.querySelector('input[id="r_stone_weight"]').value = total;

 	}

 	function CalculatePayable() {

 		var total_weight_issue = parseFloat($(document).find('#total-weight-issue').val());
 		var received_weight = parseFloat($(document).find('#received_weight').val());
 		var stone_received = parseFloat($(document).find('#stone_received').val());
 		var wastage = parseFloat($(document).find('#wastage1').val());
 		if (total_weight_issue !== "" && received_weight !== "" && stone_received !== "" && wastage !== "") {


 			var total = received_weight + stone_received + wastage;
 			$(document).find('#Total').val(total);
 			var payable = (total_weight_issue - total).toFixed(2) + '0';
 			$(document).find('#Payable').val(payable);
 		}
 	}

 	function CalculateTotal() {
 		var stepIssueweight = parseFloat($(document).find('#stepIssueweight').val());
 		var Zircon = parseFloat($(document).find('#Zircon').val());
 		var stone_weight = parseFloat($(document).find('#stone_weight').val());
 		if (stepIssueweight != '' && Zircon != '' && stone_weight != '') {
 			var total = (stepIssueweight + Zircon + stone_weight).toFixed(2) + '0';
 			$(document).find('#total-weight-issue').val(total);
 		}
 	}

 	function AddStone(element) {
 		var area2 = element.parentNode.parentNode.nextElementSibling;
 		var div2 = document.createElement('div');
 		div2.setAttribute('class', 'row mb-4 remove');
 		div2.innerHTML = `<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Code:</label>
									<div class="col-sm-2">

									<select name="stone_code[]" id="stone_code[]" value="" class="form-control" placeholder="Stone Code">
 																			<option value="">Select a stone...</option>

 																		</select>

									</div>
									<div class="col-sm-1 p-0">
									<i class="fa fa-barcode fa-3x" onclick="BarCode(this)"></i>
									</div>
									<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Weight:</label>
									<div class="col-sm-2">

										<input type="text" name="stone_weight[]" id="stone_weight[]" value="" class="form-control" placeholder="Stone Weight">
									</div>
									<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Quantity:</label>
									<div class="col-sm-2">

										<input type="text" name="stone_quantity[]" id="stone_quantity[]" value="" class="form-control" placeholder="Stone Quantity">
									</div>
									<div class="col-sm-2">

										<i class="delete-stone fa fa-minus-circle p-2"></i>
									</div>`;
 		area2.appendChild(div2);
 		var stone_weight = document.querySelectorAll('input[id="stone_weight[]"]');
 		var stone_quantity = document.querySelectorAll('input[id="stone_quantity[]"]');
 		stone_quantity.forEach(function(input) {
 			input.addEventListener('input', function() {
 				let current = this.parentNode.parentNode.parentNode.parentNode;
 				StoneQuantity(current);
 			});
 		})
 		stone_weight.forEach(function(input) {
 			input.addEventListener('input', function() {
 				let current = this.parentNode.parentNode.parentNode.parentNode;
 				StoneWeight(current);
 			});
 		})

 		GetAllStones();

 	}

 	function Add(element) {
 		area = element.parentNode.parentNode.nextElementSibling;
 		var div = document.createElement('div');
 		div.setAttribute('class', 'row mb-4 remove');
 		div.innerHTML = `<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Code:</label>
				<div class="col-sm-2">

				<select name="zircon_code[]" id="zircon_code[]" value="" class="form-control" placeholder="Zircon" required>
 																			<option value="">Select a zircon...</option>

 																		</select>

				</div>
				<div class="col-sm-1 p-0">
				<i class="fa fa-barcode fa-3x" onclick="BarCode(this)"></i>
				</div>
				<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Weight:</label>
				<div class="col-sm-2">

					<input type="text" name="zircon_weight[]" id="zircon_weight[]" value="" class="form-control" placeholder="Zircon" >
				</div>
				<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Quantity:</label>
				<div class="col-sm-2">

					<input type="text" name="zircon_quantity[]" id="zircon_quantity[]" value="" class="form-control" placeholder="Zircon" >
				</div>
				<div class="col-sm-2">

					<i class="delete-zircon fa fa-minus-circle p-2"></i>
				</div>`;
 		area.appendChild(div);
 		var zircon_weight = document.querySelectorAll('input[id="zircon_weight[]"]');
 		var zircon_quantity = document.querySelectorAll('input[id="zircon_quantity[]"]');
 		zircon_quantity.forEach(function(input) {
 			input.addEventListener('input', function() {
 				let current = this.parentNode.parentNode.parentNode.parentNode;
 				ZirconQuantity(current);
 			});
 		})
 		zircon_weight.forEach(function(input) {
 			input.addEventListener('input', function() {
 				let current = this.parentNode.parentNode.parentNode.parentNode;
 				ZirconWeight(current);
 			});
 		})
 		GetAllZircons();


 	}

 	function AddReturned(element) {
 		var returned_area = element.parentNode.parentNode.parentNode;
 		var div2 = document.createElement('div');
 		div2.setAttribute('class', 'row mb-4 remove');
 		div2.innerHTML = `<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Code:</label>
									<div class="col-sm-2">
										<input type="text" name="r_code[]" id="r_code[]" value="" class="form-control" placeholder="Code" required>
									</div>
									<div class="col-sm-1 p-0">
										<i class="fa fa-barcode fa-3x" onclick="BarCode(this)"></i>
									</div>
									<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Weight:</label>
									<div class="col-sm-2">
										<input type="number" step="any" name="r_weight[]" id="r_weight[]" value="" class="form-control" placeholder="Weight" required>
									</div>
									<label for="horizontal-firstname-input" class="col-sm-1 col-form-label d-flex justify-content-end">Quantity:</label>
									<div class="col-sm-2">
										<input type="number" step="any" name="r_quantity[]" id="r_quantity[]" value="" class="form-control" placeholder="Quantity" required>
									</div>
									<div class="col-sm-2">
										<i class="delete-returned fa fa-minus-circle p-2"></i>
									</div>`;
 		returned_area.appendChild(div2);
 		var r_weight = document.querySelectorAll('input[id="r_weight[]"]');
 		var r_quantity = document.querySelectorAll('input[id="r_quantity[]"]');
 		r_quantity.forEach(function(input) {
 			input.addEventListener('input', function() {
 				let current = this.parentNode.parentNode.parentNode.parentNode.parentNode;
 				ReturnedQuantity(current);
 			});
 		})
 		r_weight.forEach(function(input) {
 			input.addEventListener('input', function() {
 				let current = this.parentNode.parentNode.parentNode.parentNode.parentNode;
 				ReturnedWeight(current);
 			});
 		})
 	}

 	function CalculateDifference() {
 		var unpolished_weight = parseFloat($(document).find('#unpolish_weight').val());
 		var polished_weight = parseFloat($(document).find('#polish_weight').val());
 		var stepIssueweight = document.getElementById('s_total_weight[]').value = polished_weight;
 		if (unpolished_weight != '' && polished_weight != '') {
 			var difference = (unpolished_weight - polished_weight).toFixed(2) + '0';
 			if (difference == 0) {
 				var polisher_save_btn = document.getElementById('polisher_save_btn');
 				var polisher_print_btn = document.getElementById('polisher_print_btn');
 				polisher_print_btn.disabled = true;
 				polisher_save_btn.disabled = true;
 			} else {
 				var polisher_save_btn = document.getElementById('polisher_save_btn');
 				var polisher_print_btn = document.getElementById('polisher_print_btn');
 				polisher_print_btn.disabled = false;
 				polisher_save_btn.disabled = false;
 			}
 			$(document).find('#difference').val(difference);
 		}

 	}

 	function CalculateIssuedWeight(retained_weight) {
 		total_weight = retained_weight.parentNode.previousElementSibling.previousElementSibling.children[0].value;
 		total_weight = parseInt(total_weight);
		if (total_weight < retained_weight.value) {
 			alert('Retained weight cannot be greater than total weight');
 			retained_weight.value = '';
 		} else if (total_weight == '' || total_weight == null || total_weight == undefined) {
 			alert('Please enter total weight');
 			retained_weight.value = '';
 		} else {
 			value = total_weight - retained_weight.value;
 			retained_weight.parentNode.nextElementSibling.nextElementSibling.children[0].value = value;
 		}



 	}

 	function CalculatePolisherWastage() {
 		var code = $('#select-polisher').selectize()[0].selectize
 		var code = code.getValue();
 		var selectElement = $('#select-manufacturer-purity').selectize()[0].selectize;
 		var selectedValues = selectElement.getValue();
 		var unpolish_weight = document.getElementById('unpolish_weight').value;

 		for (var i = 0; i < selectedValues.length; i++) {
 			var selectedValue = selectedValues[i];
 			var selectedOption = selectElement.options[selectedValue];
 			if (selectedOption) {
 				var selectedText = selectedOption.text;
 			} else {
 				var selectedText = '18k';
 			}
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
 					poWas.value = ((unpolish_weight / 96) * p_rate).toFixed(2) + '0';
 				}
 				payable.value = (difference - poWas.value).toFixed(2) + '0';
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
 			poWas.value = ((difference / rate) / 96).toFixed(2) + '0';
 		}
 		payable.value = (difference - poWas.value).toFixed(2) + '0';

 	}

 	function GetDate() {
 		var date = new Date().toISOString().slice(0, 10);
 		var dataInputs = document.querySelectorAll('input[type="date"]');
 		for (let i = 0; i < dataInputs.length; i++) {
 			if (dataInputs[i].id !== 'from-date' && dataInputs[i].id !== 'to-date') {
 				dataInputs[i].value = date;
 			}
 		}
 	}

 	function GetStoneSetterRate(element) {
 		var select_stone_setter = element.querySelectorAll('select[id="select-stone_setter[]"]')[0].selectize;
 		if (select_stone_setter == undefined) {
 			select_stone_setter = element.querySelectorAll('select[id="select-stone_setter[]"]')[0];
 			var vendor_id = select_stone_setter.value;
 		} else {
 			var vendor_id = select_stone_setter.getValue();

 		}
 		var selectElement = $('#select-manufacturer-purity').selectize()[0].selectize;
 		var selectedValues = selectElement.getValue();
 		var unpolish_weight = document.getElementById('unpolish_weight').value;

 		for (var i = 0; i < selectedValues.length; i++) {
 			var selectedValue = selectedValues[i];
 			var selectedOption = selectElement.options[selectedValue];
 			if (selectedOption) {
 				var selectedText = selectedOption.text;
 			} else {
 				var selectedText = '18k';
 			}
 		}

 		$.ajax({
 			url: "functions.php",
 			method: "POST",
 			data: {
 				function: "GetStoneSetterRate",
 				column: selectedText,
 				id: vendor_id
 			},
 			success: function(response) {
 				var data = JSON.parse(response);
 				var stone_setter_rate = element.nextElementSibling.querySelector('input[id="r_rate"]').value = data[0][selectedText];
 			}
 		});
 	}

 	function GetStoneSetterNames() {
 		let stonesetters = document.querySelectorAll('select[id="select-stone_setter[]"]');
 		let delete_area = stonesetters[0].parentElement;
 		var selectizeControls = delete_area.querySelectorAll('.selectize-control');
 		if (selectizeControls[0] != undefined) {
 			// Get the first selectize control (index 0)
 			selectizeControls[0].remove();
 		}
 		// Start the loop from the second element (index 1)
 		for (var i = 1; i < selectizeControls.length; i++) {
 			var selectizeControl = selectizeControls[i];
 		}

 		$.ajax({
 			url: "functions.php",
 			method: "POST",
 			data: {
 				function: "GetStoneSetterNames"
 			},
 			success: function(response) {
 				var data = JSON.parse(response);

 				for (let i = 0; i < stonesetters.length; i++) {
 					var selectElement = stonesetters[i];
 					var selectizeInstance = $(selectElement).selectize()[0].selectize;

 					var options = selectizeInstance.options;

 					if (Object.keys(options).length === 0) {
 						for (let j = 0; j < data.length; j++) {
 							var newOption = {
 								value: data[j].id,
 								text: data[j].name
 							};
 							if (selectizeInstance != undefined) {
 								selectizeInstance.addOption(newOption);
 							}
 						}

 						selectizeInstance.refreshOptions();
 					}else if (Object.keys(options).length === 1) {
 						option1 = Object.keys(options)[0];
 						selectizeInstance.removeOption(option1);
 						for (let j = 0; j < data.length; j++) {
 							var newOption = {
 								value: data[j].id,
 								text: data[j].name
 							};
 							if (selectizeInstance != undefined) {
 								selectizeInstance.addOption(newOption);
 							}
 						}
 						selectizeInstance.setValue(option1);


 						selectizeInstance.refreshOptions();
 					}else if (Object.keys(options).length > 1) {
						selectizeInstance.clearOptions();
						selectizeInstance.destroy();
						selectizeInstance = $(selectElement).selectize()[0].selectize;
 						for (let j = 0; j < data.length; j++) {
 							var newOption = {
 								value: data[j].id,
 								text: data[j].name
 							};
 							if (selectizeInstance != undefined) {
 								selectizeInstance.addOption(newOption);
 							}
 						}
 						selectizeInstance.refreshOptions();
					}
 				}
 			}
 		});

 		const divsWithSiblings = document.querySelectorAll('div.selectize-control.single + div.selectize-control.single');

 		// Loop through the selected div elements
 		divsWithSiblings.forEach(div => {
 			// Remove each div element
 			div.remove();
 		});


 	}

 	function ReturnedStoneListeners() {
 		var r_quantity = document.querySelectorAll('input[id="r_quantity[]"]');
 		var r_weight = document.querySelectorAll('input[id="r_weight[]"]');
 		var zircon_weight = document.querySelectorAll('input[id="zircon_weight[]"]');
 		var zircon_quantity = document.querySelectorAll('input[id="zircon_quantity[]"]');
 		var stone_weight = document.querySelectorAll('input[id="stone_weight[]"]');
 		var stone_quantity = document.querySelectorAll('input[id="stone_quantity[]"]');
 		var r_quantity = document.querySelectorAll('input[id="r_quantity[]"]');
 		var grand_total_weight = document.querySelectorAll("#r_total_weight");
 		var received_weight = document.querySelectorAll("#received_weight");
 		var r_stone_weight = document.querySelectorAll("#r_stone_weight");
 		var zircon_total = document.querySelectorAll('#zircon_total');
 		var stone_total = document.querySelectorAll('#stone_total');
 		var select_manufacturer_purity = document.querySelectorAll('#select-manufacturer-purity');
 		var select_polisher_purity = document.querySelectorAll('#select-polisher-purity');
 		var unpolish_weight = document.querySelectorAll('#unpolish_weight');
 		var polish_weight = document.querySelectorAll('#polish_weight');
 		var p_rate = document.querySelectorAll('#p_rate');
 		var r_stone_quantity = document.querySelectorAll("#r_stone_quantity");
 		var r_rate = document.querySelectorAll("#r_rate");
 		var r_wastage = document.querySelectorAll("#r_wastage");
 		var manufacturer_rate = document.querySelectorAll("#manufacturer-rate");
 		var r_grand_weight = document.querySelectorAll("#r_grand_weight");
 		var retained_weight = document.querySelectorAll('input[id="retained_weight[]"]');
		var sh_qty = document.querySelectorAll('input[id="sh_qty"]');
		for (var i = 0; i < sh_qty.length; i++) {
			sh_qty[i].addEventListener("change", function() {
				let current = this.parentNode.parentNode.parentNode;
 				CalculateReturnedWastage(current);
				ReturnedPayable(current);
 			});
 		};



 		for (var i = 0; i < retained_weight.length; i++) {
 			retained_weight[i].addEventListener("change", function() {
 				CalculateIssuedWeight(this);
 			});
 		};

 		r_grand_weight.forEach(function(element) {
 			element.addEventListener("change", function() {
 				let current = this.parentNode.parentNode.parentNode;
 				ReturnedPayable(current);
 			});
 		});
 		r_rate.forEach(function(element) {
 			element.addEventListener("change", function() {
 				let current = this.parentNode.parentNode.parentNode;
 				CalculateReturnedWastage(current);
 			});
 		});
 		r_stone_weight.forEach(function(element) {
 			element.addEventListener("change", function() {
 				let current = this.parentNode.parentNode.parentNode.parentNode;
 				TotalWeight(current);
 			});
 		});
 		r_wastage.forEach(function(element) {
 			element.addEventListener("change", function() {
 				let current = this.parentNode.parentNode.parentNode;
 				TotalWeight(current);
 			});
 		});
 		r_stone_quantity.forEach(function(element) {
 			element.addEventListener("change", function() {
 				let current = this.parentNode.parentNode.parentNode;
 				CalculateReturnedWastage(current);
 			});
 		});
 		received_weight.forEach(function(element) {
 			element.addEventListener("change", function() {
 				current = this.parentNode.parentNode.parentNode;
 				ReturnTotalWeight(current);
 			});
 		});
 		r_stone_weight.forEach(function(element) {
 			element.addEventListener("change", function() {
 				current = this.parentNode.parentNode.parentNode;
 				ReturnTotalWeight(current);
 			});
 		});
 		received_weight.forEach(function(element) {
 			element.addEventListener("change", function() {
 				let current = this.parentNode.parentNode.parentNode;
 				TotalWeight(current);
 			});
 		});
 		grand_total_weight.forEach(function(element) {
 			element.addEventListener("change", function() {
 				let current = this.parentNode.parentNode.parentNode.nextSibling;
 				ReturnedPayable(current);
 			});
 		});

 		for (let i = 0; i < r_quantity.length; i++) {
 			r_quantity[i].addEventListener('change', function() {
 				let current = this.parentNode.parentNode.parentNode.parentNode.parentNode;
 				ReturnedQuantity(current);
 			});
 			r_quantity[i].addEventListener('change', function() {
 				let current = this.parentNode.parentNode.parentNode.parentNode.parentNode;
 				TotalWeight(current);
 			});
 		}

 		for (let i = 0; i < r_weight.length; i++) {
 			r_weight[i].addEventListener('change', function() {
 				let current = this.parentNode.parentNode.parentNode.parentNode.parentNode;
 				ReturnedWeight(current);
 			});
 			r_weight[i].addEventListener('change', function() {
 				let current = this.parentNode.parentNode.parentNode.parentNode.parentNode;
 				TotalWeight(current);
 			});
 		}
 	}

 	function StoneSetterListeners() {
 		var zircon_weight = document.querySelectorAll('input[id="zircon_weight[]"]');
 		var zircon_quantity = document.querySelectorAll('input[id="zircon_quantity[]"]');
 		var stone_weight = document.querySelectorAll('input[id="stone_weight[]"]');
 		var stone_quantity = document.querySelectorAll('input[id="stone_quantity[]"]');
 		stone_quantity.forEach(function(input) {
 			input.addEventListener('change', function() {
 				let current = this.parentNode.parentNode.parentNode;
 				StoneQuantity(current);
 			});
 		})
 		stone_weight.forEach(function(input) {
 			input.addEventListener('change', function() {
 				let current = this.parentNode.parentNode.parentNode;
 				StoneWeight(current);
 			});
 		})
 		zircon_quantity.forEach(function(input) {
 			input.addEventListener('change', function() {
 				let current = this.parentNode.parentNode.parentNode;
 				ZirconQuantity(current);
 			});
 		})
 		zircon_weight.forEach(function(input) {
 			input.addEventListener('change', function() {
 				let current = this.parentNode.parentNode.parentNode;
 				ZirconWeight(current);
 			});
 		})
 	}

 	image.onchange = evt => {
 		const [file] = image.files
 		if (file) {
 			preview.src = URL.createObjectURL(file);
 			$('#preview').css("display", "block");
 		}
 	}

 	async function runLoop1() {
 		await GetDate();
 		await GetAllZircons();
 		await GetAllStones();
 		await GetStoneSetterNames();

 	}

 	window.addEventListener('load', runLoop1());

 	$(document).ready(function() {


 		$('select').selectize({
 			sortField: 'text'
 		});

 		$.ajax({
 			url: "functions.php",
 			method: "POST",
 			data: {
 				function: "GetModalProducts"
 			},
 			success: function(response) {
 				var data = JSON.parse(response);
 				var tbody = document.getElementById("product-table-body");
 				for (var i = 0; i < data.length; i++) {
 					var tr = document.createElement("tr");
 					var td1 = document.createElement("td");
 					var td2 = document.createElement("td");
 					var td3 = document.createElement("td");
 					var td4 = document.createElement("td");
 					var td5 = document.createElement("td");
 					var td6 = document.createElement("td");
 					var btn = document.createElement("button");
 					btn.innerHTML = "Select";
 					btn.className = "btn btn-primary";
 					btn.addEventListener("click", function() {
 						GetProductId(this);
 					});
 					tr.id = data[i].product_id;
 					td1.innerHTML = i + 1;
 					td2.innerHTML = data[i].product_id;
 					td3.innerHTML = data[i].vendor_id;
 					td4.innerHTML = data[i].vendor_name;
 					date = data[i].date;
 					td5.innerHTML = date.slice(0, 10);
 					td6.classList.add("p-1");
 					td6.appendChild(btn);
 					tr.appendChild(td1);
 					tr.appendChild(td2);
 					tr.appendChild(td3);
 					tr.appendChild(td4);
 					tr.appendChild(td5);
 					tr.appendChild(td6);
 					tbody.appendChild(tr);
 				};
 			}
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


 		var zircon_weight = document.querySelectorAll('input[id="zircon_weight[]"]');
 		var zircon_quantity = document.querySelectorAll('input[id="zircon_quantity[]"]');
 		var stone_weight = document.querySelectorAll('input[id="stone_weight[]"]');
 		var stone_quantity = document.querySelectorAll('input[id="stone_quantity[]"]');
 		var r_quantity = document.querySelectorAll('input[id="r_quantity[]"]');
 		var grand_total_weight = document.querySelector("#r_total_weight");
 		var received_weight = document.querySelector("#received_weight");
 		var r_stone_weight = document.querySelector("#r_stone_weight");
 		var zircon_total = document.querySelector('#zircon_total');
 		var stone_total = document.querySelector('#stone_total');
 		var select_manufacturer_purity = document.querySelector('#select-manufacturer-purity');
 		var select_polisher_purity = document.querySelector('#select-polisher-purity');
 		var unpolish_weight = document.querySelector('#unpolish_weight');
 		var polish_weight = document.querySelector('#polish_weight');
 		var p_rate = document.querySelector('#p_rate');
 		var r_stone_quantity = document.querySelector("#r_stone_quantity");
 		var r_rate = document.querySelector("#r_rate");
 		var r_wastage = document.querySelector("#r_wastage");
 		var manufacturer_rate = document.querySelector("#manufacturer-rate");
 		var r_grand_weight = document.querySelector("#r_grand_weight");
 		var retained_weight = document.querySelectorAll('input[id="retained_weight[]"]');
		



 		manufacturer_rate.addEventListener("change", function() {
 			CalculateWastage();
 		});
 		// zircon_total.addEventListener('change', GrandTotal);
 		// stone_total.addEventListener('change', GrandTotal);
 		unpolish_weight.addEventListener('change', CalculateWastage);
 		unpolish_weight.addEventListener('change', CalculateDifference);
 		polish_weight.addEventListener('change', CalculateDifference);
 		p_rate.addEventListener('change', function() {
 			CalculateNewPayable($(this).val());
 		});
 		// var stepIssueweight = document.getElementById("stepIssueweight");
 		// stepIssueweight.addEventListener("change", function() {
 		// 	ReturnedPayable();
 		// });
 		ReturnedStoneListeners();
 		StoneSetterListeners();


 	});

 	$(document).on('submit', '#stepone', function(e) {
 		e.preventDefault();
 		var save = document.getElementById("m_save");
 		save.disabled = true;
 		var form = new FormData(this);
 		form.append('function', 'StepOne');
 		$.ajax({
 			url: "functions.php",
 			type: "POST",
 			data: form,
 			contentType: false,
 			processData: false,
 			success: function(data) {
 				data = JSON.parse(data);
 				if (data[0] == "success" && data[1] == "success") {
 					Swal.fire({
 						title: 'Success!',
 						text: 'Manufacturer Record Saved Successfully',
 						icon: 'success',
 						confirmButtonText: 'Ok'
 					})
 				} else {
 					Swal.fire({
 						title: 'Error!',
 						text: 'Something went wrong.',
 						icon: 'error',
 						confirmButtonText: 'Ok'
 					})
 				}
 			}
 		});

 	})

 	$(document).on('submit', '#steptwo', function(e) {
 		e.preventDefault();
 		var save = document.getElementById("polisher_save_btn");
 		save.disabled = true;
 		var form = new FormData(this);
 		form.append('function', 'StepTwo');
 		$.ajax({
 			url: "functions.php",
 			type: "POST",
 			data: form,
 			contentType: false,
 			processData: false,
 			success: function(data) {
 				data = JSON.parse(data);
 				if (data[0] == "success") {
 					Swal.fire({
 						title: 'Success!',
 						text: 'Polisher Record Saved Successfully',
 						icon: 'success',
 						confirmButtonText: 'Ok'
 					})
 				} else {
 					Swal.fire({
 						title: 'Error!',
 						text: 'Something went wrong.',
 						icon: 'error',
 						confirmButtonText: 'Ok'
 					})
 				}
 			}
 		});

 	})

 	$(document).on('submit', '#stepthree', function(e) {
 		e.preventDefault();
 		var save = document.getElementById("s_save");
 		var form = new FormData(this);
 		for (var pair of form.entries()) {}
 		form.append('function', 'StepThree');
 		$.ajax({
 			url: "functions.php",
 			type: "POST",
 			data: form,
 			contentType: false,
 			processData: false,
 			success: function(data) {
 				data = JSON.parse(data);
 				if (data[0] == "success" && data[1] == "success") {
 					Swal.fire({
 						title: 'Success!',
 						text: 'Stone Setter Record Saved Successfully',
 						icon: 'success',
 						confirmButtonText: 'Ok'
 					})
 				} else {
 					Swal.fire({
 						title: 'Error!',
 						text: 'Something went wrong.',
 						icon: 'error',
 						confirmButtonText: 'Ok'
 					})
 				}
 			}
 		});

 	})

 	$(document).on('submit', '#r_stepthree', function(e) {
 		e.preventDefault();
 		var save = document.getElementById("r_save");
 		save.disabled = true;
 		var product_id = document.getElementsByClassName('code');
 		product_id = product_id[0].value;
 		area = this.previousElementSibling;
 		let stonesetter = area.querySelectorAll('select[id="select-stone_setter[]"]')[0];
 		let vendor_id = stonesetter.value;
 		var form = new FormData(this);
 		form.append('function', 'ReturnedStepThree');
 		form.append('product_id', product_id);
 		form.append('vendor_id', vendor_id);
 		$.ajax({
 			url: "functions.php",
 			type: "POST",
 			data: form,
 			contentType: false,
 			processData: false,
 			success: function(data) {
 				data = JSON.parse(data);
 				if (data[0] == "success" && data[1] == "success") {
 					Swal.fire({
 						title: 'Success!',
 						text: 'Stone Setter Record Saved Successfully',
 						icon: 'success',
 						confirmButtonText: 'Ok'
 					})
 				} else {
 					Swal.fire({
 						title: 'Error!',
 						text: 'Something went wrong.',
 						icon: 'error',
 						confirmButtonText: 'Ok'
 					})
 				}
 			}
 		});
 	});

 	$(document).on('submit', '#stepfour', function(e) {
 		e.preventDefault();
 		var save = document.getElementById("a_save");
 		save.disabled = true;
 		var product = document.getElementById('product').value;
 		var form = new FormData(this);
 		form.append('function', 'StepFour');
 		form.append('product_id', product);
 		$.ajax({
 			url: "functions.php",
 			type: "POST",
 			data: form,
 			contentType: false,
 			processData: false,
 			success: function(data) {
 				data = JSON.parse(data);
 				if (data[0] == "success") {
 					Swal.fire({
 						title: 'Success!',
 						text: 'Additional Vendor Record Saved Successfully',
 						icon: 'success',
 						confirmButtonText: 'Ok'
 					})
 				} else {
 					Swal.fire({
 						title: 'Error!',
 						text: 'Something went wrong.',
 						icon: 'error',
 						confirmButtonText: 'Ok'
 					})
 				}
 			}
 		});

 	})

 	$(document).on('submit', '#filter-data', function(e) {
 		e.preventDefault();
 		var form = new FormData(this);
 		var tbody = document.getElementById('product-table-body');
 		form.append('function', 'GetFilteredProducts');
 		$.ajax({
 			url: "functions.php",
 			type: "POST",
 			data: form,
 			contentType: false,
 			processData: false,
 			success: function(data) {
 				data = JSON.parse(data);
 				if (data[0] == "error") {
 					Swal.fire({
 						title: 'Error!',
 						text: 'Something went wrong.',
 						icon: 'error',
 						confirmButtonText: 'Ok'
 					})
 				} else if (data.length == 0) {
 					alert("No Data Found");

 				} else {
 					tbody.innerHTML = "";
 					for (var i = 0; i < data.length; i++) {
 						var tr = document.createElement('tr');
 						var td1 = document.createElement('td');
 						var td2 = document.createElement('td');
 						var td3 = document.createElement('td');
 						var td4 = document.createElement('td');
 						var td5 = document.createElement('td');
 						var td6 = document.createElement('td');
 						var btn = document.createElement("button");
 						btn.innerHTML = "Select";
 						btn.className = "btn btn-primary";
 						btn.addEventListener("click", function() {
 							GetProductId(this);
 						});
 						td1.innerHTML = i + 1;
 						td2.innerHTML = data[i].product_id;
 						td3.innerHTML = data[i].vendor_id;
 						td4.innerHTML = data[i].vendor_name;
 						td5.innerHTML = data[i].date;
 						tr.id = data[i].product_id;
 						td6.appendChild(btn);
 						tr.appendChild(td1);
 						tr.appendChild(td2);
 						tr.appendChild(td3);
 						tr.appendChild(td4);
 						tr.appendChild(td5);
 						tr.appendChild(td6);
 						tbody.appendChild(tr);

 					}
 				}
 			}
 		});
 	});

 	$(document).on('click', '.delete-stone', function() {
 		let current = this.parentNode.parentNode.parentNode.parentNode;
 		$(this).parent().parent().remove();
 		StoneQuantity(current);
 		StoneWeight(current);
 	});

 	$(document).on('click', '.delete-zircon', function() {
 		let current = this.parentNode.parentNode.parentNode.parentNode;
 		$(this).parent().parent().remove();
 		ZirconQuantity(current);
 		ZirconWeight(current);
 	});

 	$(document).on('click', '.delete-returned', function() {
 		let current = this.parentNode.parentNode.parentNode.parentNode.parentNode;
 		$(this).parent().parent().remove();
 		ReturnedQuantity(current);
 		ReturnedWeight(current);
 	});

 	$(document).on('change', '#select-manufacturer', function(e) {
 		e.preventDefault();
 		var product = document.getElementById('product');

 		if (product.value === "") {
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

 	$(document).on('change', '#select-stone_setter', function(e) {
 		e.preventDefault();
 		let current = this.parentNode.parentNode.parentNode.parentNode;
 		GetStoneSetterRate(current);
 	});

 	$(document).on('change', '#select-polisher-purity', function(e) {
 		e.preventDefault();
 		var polisher_rate = document.getElementById('polisher-rate');
 		polisher_rate.value = this.value;
 	});

 	$(document).on('input', '#product', function(e) {
 		e.preventDefault();
 		const inputs = document.querySelectorAll('input');
 		const selects = document.querySelectorAll('select');
 		const textareas = document.querySelectorAll('textarea');

 		inputs.forEach(input => {
 			if (input.id !== 'product') {
 				input.value = '';
 			}
 		});
 		textareas.forEach(textarea => textarea.value = '');
 		selects.forEach(select => select.selectize.clear());

 		GetDate();
 		GetManufacturerData($(this).val());

 	})

 	$(document).on('input', '#rate', function(e) {
 		e.preventDefault();
 		var constantValue = 96;
 		var rFlowValue = parseFloat($(this).val());
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


 			var wtgValue = (upEmail * rFlowValue / constantValue).toFixed(2) + '0';

 			$(document).find('#wastage').val(wtgValue);

 			var wtgValue1 = wtgValue = (upEmail * rFlowValue / constantValue);

 			var rr = parseFloat(upEmail + wtgValue1).toFixed(2) + '0';

 			var rr2 = parseFloat(sPValue).toFixed(2) + '0';

 			//var rr3=parseFloat(wtgValue).toFixed(2) + '0';
 			//var rr3 = parseFloat(sPValue).toFixed(2) + '0';


 			var tValues = (rr * sPValue).toFixed(2) + '0';

 			$(document).find('#tValues').val(tValues);


 		}
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
		let current = this.parentNode.parentNode.parentNode.previousElementSibling;
 		GetStoneSetterRate(current);
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