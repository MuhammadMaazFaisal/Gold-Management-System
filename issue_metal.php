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
					<div class="col-xl-12">
						<?php if (isset($_SESSION['additional_manu'])) { ?>

							<div class="row">
								<div class="col-lg-12">
									<div class="card ">
										<div class="card-header card border border-info">
											<h4 class="card-title">
												Issue Metal


											</h4>

										</div>
										<div class="card-body p-4 ">

											<div class="row">

												<div class="col-lg-12 ms-lg-auto ">
													<div class="mt-4 mt-lg-0">


														<form id="form" method="POST" enctype="multipart/form-data">
															<?php

															$randomgold = random_int(0000000000, 929900000000);
															echo "<input type='hidden' name='goldbarcode' value='$randomgold' class='form-control'>";
															?>
															<div class="row mb-4">
																<label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Date:</label>
																<div class="col-sm-5">

																	<input type="date" name="date" class="form-control" placeholder="Date">
																</div>
																<label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Name:</label>
																<div class="col-sm-5">

																	<select id="vendor" required="" name="vendor" required class="form-control form-select">

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
																<label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Issued Weight:</label>
																<div class="col-sm-2">

																	<input type="number" step="any" name="issued_weight" class="form-control" placeholder="Gold Issued Weight">
																</div>
																<label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Purity:</label>
																<div class="col-sm-3">
																	<select id="purity" required="" name="purity" required class="form-control form-select">
																		<option value="18k">18k</option>
																		<option value="21k">21k</option>
																		<option value="22k">22k</option>
																	</select>
																</div>
																<label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Pure Weight Issued:</label>
																<div class="col-sm-3">

																	<input type="number" step="any" name="pure_weight" class="form-control" placeholder="Pure Weight Issued">
																</div>


																<div class="row d-flex justify-content-end">


																	<div class=" d-flex justify-content-end">
																		<button type="submit" class="btn btn-primary" value="Save">Save</button>
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
		function GetDate() {
			var date = new Date().toISOString().slice(0, 10);
			var dataInputs = document.querySelectorAll('input[type="date"]');
			for (let i = 0; i < dataInputs.length; i++) {
				if (dataInputs[i].id !== 'from-date' && dataInputs[i].id !== 'to-date') {
					dataInputs[i].value = date;
				}
			}
		}

		$(document).ready(function() {
			GetDate();

			$('select').selectize({
				sortField: 'text'
			});

			$.ajax({
				url: "functions.php",
				method: "POST",
				data: {
					function: "GetMetalVendors"
				},
				success: function(response) {
					var data = JSON.parse(response);
					var select = $('#vendor')[0].selectize;
					for (var i = 0; i < data.length; i++) {
						var newOption = {
							value: data[i].id,
							text: data[i].id + " | " + data[i].name
						};
						select.addOption(newOption);
					}

				}
			});
		});

		$('#form').on('submit', function(e) {
			e.preventDefault();
			var form = new FormData(this);
			form.append('function', 'MetalRecord');
			form.append('type', 'issued');
			$.ajax({
				url: "functions.php",
				method: "POST",
				data: form,
				contentType: false,
				cache: false,
				processData: false,
				success: function(response) {
					console.log(response);
					var data = JSON.parse(response);
					if (data[0] == "success") {
						Swal.fire({
							title: "Success!",
							text: "Record Saved Successfully",
							icon: "success",
							confirmButtonText: 'Ok'
						}).then((result) => {
							if (result.isConfirmed) {
								location.reload();
							}
						});
					} else {
						Swal.fire({
							title: 'Error!',
							text: 'Something went wrong.',
							icon: 'error',
							confirmButtonText: 'Ok'
						}).then((result) => {
							if (result.isConfirmed) {
								location.reload();
							}
						});
					}
				}
			});
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